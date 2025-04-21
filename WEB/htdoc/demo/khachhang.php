<?php
session_start();
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "bookstore";
$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_error) {
    die("connect fadled: " . $mysqli->connect_error);
}
$quocgia = isset($_POST['quocgia']) ? $_POST['quocgia'] : '';
$sql = "SELECT ten,email,namsinh,quocgia FROM customers";
if ($quocgia != '') {
    $sql .= " WHERE quocgia = ?";
}
$stmt = $mysqli->prepare($sql);
if ($quocgia != '') {
    $stmt->bind_param("s", $quocgia);
}
$stmt->execute();
$result = $stmt->get_result();
$data = "";
while ($row = $result->fetch_assoc()) {
    $data .= "<tr><td>{$row['ten']}</td>
                <td>{$row['email']}</td>
                <td>{$row['namsinh']}</td>
                <td>{$row['quocgia']}</td></tr>";
}
echo $data;
$stmt->close();
$mysqli->close();
