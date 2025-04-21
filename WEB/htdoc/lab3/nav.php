<?php 
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color:rgb(21, 112, 181);
}

li { float: left; }

li a {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: red;
}
</style>

    <ul>
        <li><a  href="register_form.php">Tạo tài khoản</a></li>
        <li><a  href="login_form.php">Đăng nhập</a></li>
        <li><a  href="logout.php">Đăng xuất</a></li>
        <li><a  href="profile.php">Xem thông tin cá nhân</a></li>
        <li><a href="update_profile_form.php">Cập nhật thông tin cá nhân</a></li>
        <li><?php
    if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
        echo "<p>Hello, " . $_SESSION['name'] . "!</p>";
    }
    ?></li>
    </ul>
    
            