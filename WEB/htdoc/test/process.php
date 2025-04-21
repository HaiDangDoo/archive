<?php
session_start();
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "user";
$mysqli = new mysqli($host, $user, $password, $database);

//check connect
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
// else {
//     echo "Successfully connect to database.<br>";
// }

// Đăng ký
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['pwd'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pwd = sha1($_POST["pwd"]);
    $year_old = $_POST["year_old"];
    $sex = $_POST["sex"];

    // Kiểm tra nếu email đã tồn tại
    $stmt = $mysqli->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Email đã tồn tại! Vui lòng chọn email khác.";
    } else {
        // Nếu email chưa tồn tại, tiến hành đăng ký


        $stmt = $mysqli->prepare("INSERT INTO users ( name , email, pwd, year_old, sex)" . "VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $name, $email, $pwd, $year_old, $sex);

        if ($stmt->execute()) {
            echo "Đăng ký thành công!";
            echo '<script>
        setTimeout(function() {
            window.location.href = "thongtincanhan.php";
        }, 3000); // Chuyển hướng sau 2 giây
      </script>';
        } else {
            echo "Lỗi: " . $stmt->error;
        }
    }
}
// Đăng nhập
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['email']) && isset($_POST['pwd'])) {
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
}
// Kiểm tra email và mật khẩu
$stm = $mysqli->prepare("SELECT name, year_old, sex, pwd FROM users WHERE email = ?");
$stm->bind_param("s", $email);
$stm->execute();
$stm->store_result();

if ($stm->num_rows > 0) {
    $stm->bind_result($name, $year_old, $sex, $pwd);
    $stm->fetch();
    // lưu thông tin vào stm
    if (sha1($_POST["pwd"]) === $pwd) {
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['year_old'] = $year_old;
        $_SESSION['sex'] = $sex;
        $_SESSION['login'] = true;
        echo '<p class="noti"><strong>Đăng nhập thành công!</strong>';
        echo '<script>
            setTimeout(function() {
                window.location.href = "thongtincanhan.php";
            }, 3000); // Chuyển hướng sau 2 giây
          </script>';
    } else {
        echo '<p><strong>Mật khẩu không đúng vui lòng nhập lại!</strong></p>';
    }
} else {
    $error = "Email không đúng";
    echo '<p class="noti"><strong>Email không đúng, vui lòng nhập lại!</strong></p>';
}

//Cập nhật thông tin cá nhân
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: dangnhap.php');
    exit();
} else {
    if (isset($_POST["name"]) && isset($_POST['year_old']) && isset($_POST['sex']) && isset($_POST['pwd'])) {
        $name = $_POST["name"];
        $year_old = $_POST['year_old'];
        $sex = $_POST['sex'];
        $pwd = $_POST['pwd'];
        $email = $_SESSION['email'];
        $pwd = sha1($pwd);
        $stm = $mysqli->prepare("Update users Set name=?,year_old=?,pwd=?,sex=? WHERE email=?");
        $stm->bind_param("sisss", $name, $year_old, $pwd, $sex, $email);
        if ($stm->execute()) {
            $_SESSION['name'] = $name;
            $_SESSION['year_old'] = $year_old;
            $_SESSION['sex'] = $sex;
            echo "Cập nhật thông tin thành công!";
            header("Location: thongtincanhan.php");
            exit();
        } else {
            echo "Lỗi " . $stm->error;
        }
    }
}
// Đóng kết nối
// $stmt->close();
$mysqli->close();
