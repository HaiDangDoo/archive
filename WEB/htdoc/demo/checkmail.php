<?php
header("Content-Type: application/json");

// Kết nối cơ sở dữ liệu
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "bookstore";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Lỗi kết nối cơ sở dữ liệu"]));
}

// Nhận dữ liệu từ request
$data = json_decode(file_get_contents("php://input"), true);
$email = $data["email"] ?? "";

if (empty($email)) {
    echo json_encode(["error" => "Email không được để trống"]);
    exit;
}

// Truy vấn kiểm tra email
$sql = "SELECT email FROM customers WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(["exists" => true]);
} else {
    echo json_encode(["exists" => false]);
}

$stmt->close();
$conn->close();
