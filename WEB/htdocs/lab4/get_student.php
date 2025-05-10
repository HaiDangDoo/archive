<?php
$host = "localhost";
$db_name = "user";
$username = "root"; 
$password = "";

$conn = new mysqli($host, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$sql = "SELECT * FROM sinhvien";
$result = $conn->query($sql);

$output = '';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $output .= '<tr>
                        <td>' . $row['id'] . '</td>
                        <td>' . $row['mssv'] . '</td>
                        <td>' . $row['hoten'] . '</td>
                        <td><button class="deleteBtn" data-mssv="' . $row['mssv'] . '" data-id="' . $row['id'] . '"><i class="fa fa-times" style="font-size:15px"></i></button></td>
                    </tr>';
    }
} else {
    $output .= '<tr><td colspan="4">Không có dữ liệu</td></tr>';
}

echo $output;

$conn->close();
?>
