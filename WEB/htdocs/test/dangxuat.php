<?php
session_start();
if ($_SESSION['login'] && $_SESSION['login'] === true) {
    $_SESSION = array();
    session_destroy();
    header('Location: dangnhap.php');
    exit();
} else {
    header('Location: dangnhap.php');
    exit();
}
