<?php
$hostname = "localhost";
$username = "root";
$psw = "";
$db = "user";

$conn = new mysqli($hostname, $username, $psw, $db);

if ($conn->connect_error) {
    die("Không thể kết nối với CSDL " . $conn->connect_error);
}
$mssv = $_POST['mssv'];
$id = $_POST['id'];
$stm = $conn->prepare("DELETE FROM sinhvien WHERE mssv = ? AND id = ?");
$stm->bind_param("si", $mssv, $id);

if ($stm->execute()) {
    echo "Xóa thành công";
} else {
    echo "Lỗi: " . $stm->error;
}

$stm->close();
$conn->close();
?>
