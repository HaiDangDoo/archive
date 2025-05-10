<?php
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "bookstore";
$mysqli = new mysqli($host, $user, $password, $database);
//check connect
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} else {
    echo "Successfully connect to database";
}
//nhúng tệp chứa kết nối đến MySQL($mysysqli).
// require_once("mysqlConnect.php");
//chọn cơ sở dữ liệu.
// $mysqli->select_db("bookstore");
