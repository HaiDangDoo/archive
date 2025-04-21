<?php
session_start();
if ($_SESSION['login'] && $_SESSION['login'] === true) {
    $_SESSION = array();
    session_destroy();
    header('Location: login_form.php');
    exit();
} else {
    header('Location: login_form.php');
    exit();
}
