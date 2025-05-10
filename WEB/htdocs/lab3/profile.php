<?php
include('nav.php');

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: login_form.php');
    exit();
} else {
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $year_old = $_SESSION['year_old'];
    $sex = $_SESSION['sex'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <style>
h1{
    color: blue;
    text-align: center;
}
#div{
    border: solid 1px;
    padding: 8px;
}
section{  
    padding-top: 29px;
    display: block;
  margin-left: auto;
  margin-right: auto;
  width: 60%;}

    </style>
</head>
<body>
    <main>
        <div >
            <section>
                <div id="div">
                    
                    <h1>Thông Tin Tài Khoản</h1>
               <table>
                <tr><td>
                    <b>Họ Và Tên:</b>
                </td>
                <td> <?php echo htmlspecialchars($name); ?></td></tr>
            
                <tr><td>
                    <b>Email:</b>
                </td>
                <td><?php echo htmlspecialchars($email); ?></td></tr>   
                
                <tr><td>
                    <b>Năm Sinh:</b>
                </td>
                <td><?php echo htmlspecialchars($year_old); ?></td></tr>
                
                <tr><td>
                    <b>Giới Tính:</b>
                </td>
                <td> <?php 
                    if($sex=='Nam')
                        echo "Nam";
                    else
                        echo "Nữ";?></td></tr>
            </table>
</section> 
        </div>
    </main>
</body>
</html>