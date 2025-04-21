<?php
session_start();
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "bookstore";
$mysqli = new mysqli($host, $user, $password, $database);
//check connect
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
// Khởi tạo biến đếm trong session nếu chưa có
if (!isset($_SESSION['customer_count'])) {
    $_SESSION['customer_count'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['ten']) && isset($_POST['email'])) {
    $ten = $_POST["ten"];
    $email = $_POST["email"];
    $quocgia = $_POST["quocgia"];
    $namsinh = $_POST["namsinh"];
    // $ngaycapnhat =
    $stmt = $mysqli->prepare("INSERT INTO customers ( ten , email, quocgia,namsinh)" . "VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $ten, $email, $quocgia, $namsinh);

    if ($stmt->execute()) {
        $_SESSION['customer_count']++;
        echo "Đã thêm khách hàng thành công với mã khách hàng (makh)=" . $mysqli->insert_id . "<br>";
        echo "Bạn đã thêm " . $_SESSION['customer_count'] . " khách hàng trong phiên làm việc này.";
        echo '<script>
            setTimeout(function() {
                window.location.href = "themkhachhang.php";
            }, 3000); // Chuyển hướng sau 2 giây
          </script>';
    } else {
        echo "Thêm thất Bại" . $stmt->error . "<br>";
        echo "Vui lòng nhập lại";
        echo '<script>
            setTimeout(function() {
                window.location.href = "themkhachhang.php";
            }, 3000); // Chuyển hướng sau 2 giây
          </script>';
    }
    $stmt->close();
} else {
    echo "Lỗi: " . $mysqli->error;
}
$mysqli->close();
