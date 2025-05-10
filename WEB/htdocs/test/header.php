<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<style>
    nav {
        background-color: #333;
        overflow: hidden;
    }

    nav a {
        float: left;
        display: block;
        color: white;
        padding: 14px 20px;
        text-align: center;
        text-decoration: none;
    }

    nav a:hover {
        background-color: #ddd;
        color: black;
    }

    .user-info {
        float: right;
        color: white;
        padding: 14px 20px;
    }
</style>

<nav>
    <a href="dangky.php">Đăng Ký</a>
    <a href="dangnhap.php">Đăng Nhập</a>
    <a href="capnhat.php">Cập Nhật</a>
    <a href="thongtincanhan.php">Thông Tin Cá Nhân</a>
    <!-- <a href="/dangxuat.php">Đăng xuất</a> -->
    <div class="user-info">
        <?php
        if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
            echo "Hello, " . $_SESSION['name'] . "!";
        }
        ?>
    </div>

</nav>