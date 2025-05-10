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
if (!isset($_SESSION['customer_count'])) {
    $_SESSION['customer_count'] = 0;
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['ten']) && isset($_POST['email'])) {
    $ten = $_POST["ten"];
    $email = $_POST["email"];
    $quocgia = $_POST["quocgia"];
    $namsinh = $_POST["namsinh"];
    $stmt = $mysqli->prepare("INSERT INTO customers (ten, email, quocgia, namsinh)" . "VALUES(?,?,?,?)");
    $stmt->bind_param("sssi", $ten, $email, $quocgia, $namsinh);
    if ($stmt->execute()) {
        $_SESSION['customer_count']++;
        echo '<div style="display: flex; justify-content: center;">Da them khach hang thanh cong voi ma khach hang: ' . $mysqli->insert_id . "<br>";
        echo "Ban da them " . $_SESSION['customer_count'] . " khach hang trong phien lam viec nay.</div>";
    } else {
        echo "Them that bai" . $stmt->error . "<br>";
        echo "Vui long nhap lai!";
    }
    $stmt->close();
}
// else {
//     echo "loi: " . $mysqli->error;
// }
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Khách Hàng</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function clearForm() {
            document.getElementById("themkhachhang").reset();
        }
    </script>
    <style>
        table tr th {
            display: block;
            float: left;
        }

        main {
            display: flex;
            justify-content: center;
        }

        fieldset {
            width: 65%;
        }
    </style>
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
                        <th><label for="ten">Tên Khách Hàng</label></th>
                        <td><input type="text" name="ten" id="ten"></td>
                    </tr>
                    <tr>
                        <th><label for="email">Email</label></th>
                        <td><input type="email" id="email" name="email">
                            <span id="emailMessage"></span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="quocgia">Quốc Gia:</label></th>
                        <td><select name="quocgia" id="quocgia">
                                <option value="vietnam">Việt Nam</option>
                                <option value="usa">USA</option>
                                <option value="khac">Khác</option>
                            </select></td>
                    </tr>
                    <tr>
                        <th><label for="namsinh">Năm Sinh:</label></th>
                        <td><select name="namsinh" id="namsinh">
                                <script>
                                    const currentYear = new Date().getFullYear();
                                    for (let i = currentYear - 50; i < currentYear; i++) {
                                        document.write(`<option value = ${i}>${i}</option>`);
                                    }
                                </script>
                            </select></td>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let emailInput = document.getElementById("email");
        let emailMessage = document.getElementById("emailMessage");

        emailInput.addEventListener("blur", function() {
            let email = emailInput.value.trim();

            if (email === "") {
                emailMessage.textContent = "";
                return;
            }

            fetch("http://localhost/demo/checkmail.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        email: email
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        emailMessage.textContent = "❌ Email này đã tồn tại!";
                        emailMessage.style.color = "red";
                    } else {
                        emailMessage.textContent = "✅ Email hợp lệ.";
                        emailMessage.style.color = "green";
                    }
                })
                .catch(error => console.error("Lỗi:", error));
        });
    });
</script>

</html>