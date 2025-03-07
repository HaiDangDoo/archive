<?php
        $servername="localhost";
        $username="root";
        $password="";
        $dbname="user";
        $conn=new mysqli($servername,$username,$password,$dbname);

        if($conn->connect_error){
            echo "Không thể kết nối với cơ sở dữ liệu".$conn->connect_error;
        }else{
            //session_start();
            include('nav.php');
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $email=$_POST['email'];
                $psw=$_POST['psw'];
            }

            $stm = $conn->prepare("SELECT hoten, namsinh, gioitinh, password FROM users WHERE email = ?");
            $stm->bind_param("s",$email);
            $stm->execute();
            $stm->store_result();

            if($stm->num_rows>0){
                $stm->bind_result($hoten, $namsinh, $gioitinh, $password);
                $stm->fetch();
                if(sha1($psw)===$password){
                    $_SESSION['name'] = $hoten;
                    $_SESSION['email']=$email;
                    $_SESSION['year'] = $namsinh;
                    $_SESSION['gender'] = $gioitinh;
                    $_SESSION['login']=true;
                    echo '<p class="noti"><strong>Đăng nhập thành công!</strong>';
                    echo '<script>
                    setTimeout(function() {
                        window.location.href = "infor.php";
                    }, 3000); // Chuyển hướng sau 2 giây
                  </script>';
                }else{
                    echo '<p class="noti"><strong>Mật khẩu không đúng vui lòng nhập lại!</strong></p>';
                }
            }else{
                $error="Email không đúng";
                echo '<p class="noti"><strong>Email không đúng, vui lòng nhập lại!</strong></p>';
            }
            $stm->close();
            
        }
        $conn->close();
        ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main> 
        <div class="main">
        </div> 
    </main>
</body>
</html>