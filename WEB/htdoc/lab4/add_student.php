<?php
    $hostname="localhost";
    $username="root";
    $psw="";
    $db="user";

    $conn= new mysqli($hostname,$username,$psw,$db);

    if($conn->connect_error){
        die ("Không thể kết nối với CSDL ".$conn->connect_error);
    }
    
    $mssv=$_POST['mssv'];
    $hoten=$_POST['hoten'];

    $stm=$conn->prepare("INSERT INTO sinhvien (mssv,hoten) values (?,?)");

    $stm->bind_param("ss",$mssv,$hoten);

    if($stm->execute()){
        echo "Thêm thành công";
    }else{
        echo "Lỗi ". $stm->error;
    }
    $stm->close();
    $conn->close();

?>