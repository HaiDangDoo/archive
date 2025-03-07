<?php
include('nav.php');

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: dangki.php');
    exit();
} else {
    $hoten = $_SESSION['name'];
    $email = $_SESSION['email'];
    $namsinh = $_SESSION['year'];
    $gioitinh = $_SESSION['gender'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .infor{
            color:blue;
        }
    </style>
</head>
<body>
    <main>
        <div class="main">
            <section class="wapper">
                <div>
                    <h1>Thông tin tài khoản</h1>
                </div>
                <p><strong>Họ và tên:</strong> <?php echo htmlspecialchars($hoten); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                <p><strong>Năm sinh:</strong> <?php echo htmlspecialchars($namsinh); ?></p>
                <p><strong>Giới tính:</strong>
                <?php 
                    if($gioitinh=='male')
                        echo "Nam";
                    else
                        echo "Nữ";?></p>    
            </section> 
        </div>
    </main>
</body>
</html>
