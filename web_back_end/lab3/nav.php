<nav>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="menu">
        <ul class="list">
            <?php 
            session_start();
            if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
                echo '<li><a href="logout.php">Đăng kí</a></li>';
                echo '<li><a href="infor.php">Đăng nhập</a></li>';
                echo '<li><a href="logout.php" class="dangxuat">Đăng xuất</a></li>';
                echo '<li><a href="infor.php" class="infor">Xem thông tin cá nhân</a></li>';
                echo '<li><a href="update_infor.php" class="update_infor">Cập nhật thông tin cá nhân</a></li>';
                echo '<li class="name_id_web">'. htmlspecialchars($_SESSION['name']) . ' <i class="fa fa-user-circle"></i></li>';
            } else {
                echo '<li><a href="dangki.php" class="dangki">Đăng kí</a></li>';
                echo '<li><a href="dangnhap.php" class="dangnhap">Đăng nhập</a></li>';
                echo '<li><a href="logout.php">Đăng xuất</a></li>';
                echo '<li><a href="dangnhap.php">Xem thông tin cá nhân</a></li>';
                echo '<li><a href="dangnhap.php">Cập nhật thông tin cá nhân</a></li>';
            }
            ?>
        </ul>
    </div>
</nav>

