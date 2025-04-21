<?php
    session_start();
    if(!isset($_SESSION['login'])||$_SESSION['login']!==true){
        echo "Lỗi";
        header("Location: login_form.php");
        exit();
    }else{
        $servername="localhost";
        $username="root";
        $password="";
        $dbname="user";

        $conn=new mysqli($servername,$username,$password,$dbname);

        if($conn->connect_error){
            echo "Không thể kết nối với cơ sở dữ liệu".$conn->connect_error;
        }else{
            $email=$_SESSION['email'];
            $stm=$conn->prepare("Select name,year_old,sex from users where email=?");
            $stm->bind_param("s",$email);
            $stm->execute();
            $stm->bind_result($name,$year_old,$sex);
            $stm->fetch();
            $stm->close();
            $conn->close();
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cập nhật thông tin cá nhân</title>
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
    padding-top: 25px;  
    display: block;
  margin-left: auto;
  margin-right: auto;
  width: 60%;}
    </style>
    <?php
    include('nav.php');
    ?>
    </head>
    <body>
        <main>
            <section>
                <div id="div">
                    <div><h1>Cập nhật thông tin tài khoản</h1></div>
                    <form action="update_profile.php" method="POST" enctype="application/x-www-form-urlencoded" id="register">
                    <table>
            <tr>
                <td><b><label for="name">Họ Tên:</label></b></td>
            <td><input type="text" name="name"></td>
        </tr>
        <!-- <tr>
                <td><b><label for="email">Địa chỉ Email:</label></b></td>
            <td><input type="email" name="email"></td>
        </tr> -->
        <tr>
                <td><b><label for="pwd">Mật Khẩu:</label></b></td>
            <td><input type="password" name="pwd"></td>
        </tr>
        <tr>
                <td><b><label for="year_old">Năm Sinh:</label></b></td>
            <td><select name="year_old" id="year"><?php
            $year_old = date('Y');
            for($i=$year_old-50; $i<=$year_old;$i++){
                echo "<option>$i</option>";
            }
            ?></select></td>
        </tr>
        <tr>
                <td><b><label for="sex">Giới Tính:</label></b></td>
            <td><input type="radio" value="Nam" name="sex"><label>Nam</label>
            <input type="radio" value="Nữ" name="sex"><label>Nữ</label></td>
        </tr>
        </table>
        <button type="submit" class="btn1">Cập nhật</button>                       
                        </div>  
                    </form>
                </div>
            </div>
        </main>
    </body>
</html>