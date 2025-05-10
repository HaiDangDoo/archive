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
} else {
    echo "Successfully connect to database.<br>";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = $_POST['email'];
        $pwd = $_POST['password'];
    }
    $stm = $mysqli->prepare("SELECT name, year_old, sex, pwd FROM users WHERE email = ?");
    $stm->bind_param("s", $email);
    $stm->execute();
    $stm->store_result();

    if ($stm->num_rows > 0) {
        $stm->bind_result($name, $year_old, $sex, $pwd);
        $stm->fetch();
        // lưu thông tin vào stm
        if (sha1($_POST["password"]) === $pwd) {
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['year_old'] = $year_old;
            $_SESSION['sex'] = $sex;
            $_SESSION['login'] = true;
            echo '<p class="noti"><strong>Đăng nhập thành công!</strong>';
            echo '<script>
            setTimeout(function() {
                window.location.href = "profile.php";
            }, 3000); // Chuyển hướng sau 2 giây
          </script>';
        } else {
            echo '<p><strong>Mật khẩu không đúng vui lòng nhập lại!</strong></p>';
        }
    } else {
        $error = "Email không đúng";
        echo '<p class="noti"><strong>Email không đúng, vui lòng nhập lại!</strong></p>';
    }
    $stm->close();
}
$mysqli->close();
