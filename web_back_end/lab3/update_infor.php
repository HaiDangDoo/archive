<?php
    //session_start();
    include('nav.php'); 
    if(!isset($_SESSION['login'])||$_SESSION['login']!==true){
        echo "Lỗi";
        header("Location: dangnhap.php");
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
            $stm=$conn->prepare("Select hoten,namsinh,gioitinh from users where email=?");
            $stm->bind_param("s",$email);
            $stm->execute();
            $stm->bind_result($hoten,$namsinh,$gioitinh);
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
        <link rel="stylesheet" type="text/css" href="style.css">
        <style>
        .update_infor{
            color:blue;
        }
    </style>
    </head>
    <body>
        <main>
            <div class="main">
                <div class="wapper">
                    <div><h1>Cập nhật thông tin tài khoản</h1></div>
                    <form action="process_update_infor.php" method="POST" enctype="application/x-www-form-urlencoded" id="registerForm">
                        <div class="input_control">
                            <label for="name">Họ tên: </label>
                            <input name="name" type="text" class="input_infor" value="<?php echo "$hoten";?>"/>    
                        </div>
                        <div class="input_control">
                            <label for="psw">Mật khẩu: </label>
                            <input type="password" name="psw" class="input_infor" value="<?php echo htmlspecialchars($password);?>"/>
                        </div>
                        <div class="input_control">
                            <label for="year">Năm sinh:</label>
                            <select name="year" id="year" class="input_infor select">
                                <?php
                                    $currentYear=date('Y');
                                    for($i=$currentYear-30;$i<=$currentYear;$i++){
                                        $selected = ($i == $namsinh) ? 'selected' : '';
                                        echo "<option value='$i' $selected>$i</option>";
                                    }

                                ?>
                            </select>
                        </div>
                        <div class="input_control">
                            <label>Giới tính: </label>
                            <div class="btn_gender">
                                <input type="radio" value="male" id="male" name="gender" <?php echo ($gioitinh === 'male') ? 'selected' : ''; ?>>
                                <label for="gender">Nam</label>
                                <input type="radio" value="female" id="female" name="gender" <?php echo ($gioitinh === 'female') ? 'selected' : ''; ?>>
                                <label for="gender">Nữ</label>
                            </div>  
                        </div>
                        <div class="input_control btn" id="btn">
                            <button type="submit" class="btn1">Cập nhật</button>                         
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </body>
</html>