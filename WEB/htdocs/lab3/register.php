<?php
    $host = "127.0.0.1";
    $user = "root";
    $password = "";
    $database = "user";
    $mysqli = new mysqli($host, $user, $password, $database);
    //check connect
    if($mysqli->connect_error){
        die("Connection failed: ".$mysqli->connect_error);
    } else{
        echo "Successfully connect to database.<br>";
    }
        $name = $_POST["name"];
        $email = $_POST["email"];
        $pwd = sha1($_POST["pwd"]);
        $year_old = $_POST["year_old"];
        $sex = $_POST["sex"];
        $stmt = $mysqli->prepare("INSERT INTO users ( name , email, pwd, year_old, sex)"."VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $name, $email, $pwd, $year_old, $sex);

    if ($stmt->execute()) {
        echo "Đăng ký thành công!";
        echo '<script>
        setTimeout(function() {
            window.location.href = "profile.php";
        }, 3000); // Chuyển hướng sau 2 giây
      </script>';
    } else {
        echo "Lỗi: " . $stmt->error;
    }
    $stmt->close();
$mysqli->close();
?>