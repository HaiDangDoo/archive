<?php
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="user";
    $conn=new mysqli($servername,$username,$password,$dbname);

    if($conn->connect_error){
        die("Kết nối thất bại!!!".$conn->connect_error);
    }
    $name=$_POST['name'];
    $email=$_POST['email'];
    $psw=$_POST['psw'];
    $year=$_POST['year'];
    $gender=$_POST['gender'];

    $sha1_psw=sha1($psw);

    $stm_check=$conn->prepare("Select * from users where email=?");
    $stm_check->bind_param("s",$email);
    $stm_check->execute();
    $stm_result=$stm_check->get_result();

    include('nav.php');
    
    if($stm_result->num_rows>0){
        echo "Email đã tồn tại!!!";
    }else{
        $stm_insert=$conn->prepare("Insert into users (hoten,email,password,namsinh,gioitinh)"."value(?,?,?,?,?)");
        $stm_insert->bind_param("sssis",$name,$email,$sha1_psw,$year,$gender);

        if($stm_insert->execute()){
            echo "Đăng kí thành công !!!";
        }else{
            echo "Lỗi".$stm_insert->error;
        }
        $stm_insert->close();
    }
    $stm_result->close();
    $stm_check->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kí</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <main>
    </main>
</body>
</html>
