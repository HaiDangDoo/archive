<?php
    session_start();
    if(!isset($_SESSION['login'])||$_SESSION['login']!==true){
        // echo "Lỗi";
        header("Location: login.php");
    }else{
        $servername="localhost";
        $username="root";
        $password="";
        $dbname="user";

        $conn=new mysqli($servername,$username,$password,$dbname);

        if($conn->connect_error){
            echo "Không thể kết nối với cơ sở dữ liệu".$conn->connect_error;
        }else{
            $name=$_POST["name"];
            $year_old=$_POST['year_old'];
            $sex=$_POST['sex'];
            $pwd=$_POST['pwd'];
            $email=$_SESSION['email'];
            $pwd=sha1($pwd);
            $stm=$conn->prepare("Update users Set name=?,year_old=?,pwd=?,sex=? WHERE email=?");
            $stm->bind_param("sisss",$name,$year_old,$password,$sex,$email);
            if($stm->execute()){
                $_SESSION['name'] = $name;
                $_SESSION['year_old'] = $year_old;
                $_SESSION['sex'] = $sex;
                echo "Cập nhật thông tin thành công!";
                header("Location: profile.php");
                exit();
            }else{
                echo "Lỗi ".$stm->error;
            }
        }
        $stm->close();
        $conn->close();
    }
?>