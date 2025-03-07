<?php
    session_start();
    if(!isset($_SESSION['login'])||$_SESSION['login']!==true){
        echo "Lỗi";
    }else{
        $servername="localhost";
        $username="root";
        $password="";
        $dbname="user";

        $conn=new mysqli($servername,$username,$password,$dbname);

        if($conn->connect_error){
            echo "Không thể kết nối với cơ sở dữ liệu".$conn->connect_error;
        }else{
            $hoten=$_POST["name"];
            $namsinh=$_POST['year'];
            $gioitinh=$_POST['gender'];
            $psw=$_POST['psw'];
            $email=$_SESSION['email'];
            $new_psw=sha1($psw);
            $stm=$conn->prepare("Update users Set hoten=?,namsinh=?,password=?,gioitinh=? WHERE email=?");
            $stm->bind_param("sisss",$hoten,$namsinh,$new_psw,$gioitinh,$email);
            if($stm->execute()){
                $_SESSION['name'] = $hoten;
                $_SESSION['year'] = $namsinh;
                $_SESSION['gender'] = $gioitinh;
                echo "Cập nhật thông tin thành công!";
                header("Location: infor.php");
                exit();
            }else{
                echo "Lỗi ".$stm->error;
            }
        }
        $stm->close();
        $conn->close();
    }
?>