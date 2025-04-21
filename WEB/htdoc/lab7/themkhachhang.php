<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Khách Hàng</title>
    <link rel="stylesheet" href="style.css">
    <style>

    </style>
    <script>
        function clearForm() {
            document.getElementById("themkhachhang").reset();
        }
    </script>
</head>

<body>

    <main>
        <fieldset>
            <legend>
                <h1>Thêm Khách Hàng</h1>
            </legend>
            <form action="" method="POST" enctype="application/x-www-form-urlencoded" id="themkhachhang">
                <table>
                    <tr>
                        <th><label for="ten">Tên Khách Hàng:</label></th>
                        <td><input type="text" id="ten" name="ten"></td>
                    </tr>
                    <tr>
                        <th><label for="email">Địa chỉ email:</label></th>
                        <td><input type="email" id="email" name="email"></td>
                    </tr>
                    <tr>
                        <th><label for="quocgia">Quốc gia:</label></th>
                        <td><select name="quocgia" id="quocgia">
                                <option value="vietnam">Vietnam</option>
                                <option value="usa">USA</option>
                                <option value="khac">Khác</option>
                            </select></td>
                    </tr>
                    <tr>
                        <th><label for="namsinh">Năm Sinh:</label></th>
                        <td>
                            <select name="namsinh" id="namsinh">
                                <script>
                                    const currentYear = new Date().getFullYear();
                                    for (let i = currentYear - 50; i < currentYear; i++) {
                                        document.write(`<option value=${i}>${i}</option>`);
                                    }
                                </script>
                            </select>
                        </td>
                    </tr>

                </table>
                <div class="button">
                    <button type="submit" class="submit">Lưu</button>
                    <button type="button" class="clear" onclick="clearForm()">Xóa</button>
                </div>
            </form>
        </fieldset>
    </main>

</body>

</html>
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
        // echo '<script>
        //     setTimeout(function() {
        //         window.location.href = "themkhachhang.php";
        //     }, 3000); // Chuyển hướng sau 2 giây
        //   </script>';
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




?>