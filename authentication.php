<?php

session_start();



$_SESSION['user'] = $_POST['user'];
$_SESSION['pwd'] = $_POST['pwd'];
$pwd = $_POST['pwd'];

if ($pwd == 'secret') {
    $_SESSION['user'] = $_POST['user'];
    header("location: index.php");
    exit();
} else {
    $_SESSION['msg'] = "Invalid username/password";
    header("location: login.php");
    exit();
}
