<?php
session_start();
require_once 'db.php';

$_SESSION['signUp'] = true;
$_SESSION['chfirst_name'] = true;
$_SESSION['last_name'] = true;
$_SESSION['email'] = true;
$_SESSION['title'] = true;
$_SESSION['password'] = true;
$_SESSION['repassword'] = true;

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];
$title = strtolower($_POST['title']);

if ($first_name == null) $_SESSION['chfirst_name'] = false;
if ($last_name == null) $_SESSION['last_name'] = false;
if (strlen($password) < 6) $_SESSION['password'] = false;
if ($email == null) $_SESSION['email'] = false;
if ($password !== $repassword) $_SESSION['repassword'] = false;
if ($title != "admin" and $title != "user") $_SESSION['title'] = false;


if ($_SESSION['chfirst_name'] != false and $_SESSION['last_name'] != false and $_SESSION['email'] != false and $_SESSION['password'] != false and $_SESSION['repassword'] != false and $_SESSION['title'] != false) {
    $sql = "INSERT INTO users (id, first_name, last_name, email, password) VALUES (Null, '$first_name', '$last_name', '$email', '$password')";
    $rol = "INSERT INTO roles (id, title) VALUES (Null, '$title')";
    if (mysqli_query($conn, $sql) != false and mysqli_query($conn, $rol) != false) {
        if ($_SESSION['signIn'] != false) {
            header('Location: guestPage.php');
        } else {
            header('Location: home.php');
        }
    } else {
        $_SESSION['signUp'] = false;
        header('Location: registerPage.php');
    }
} else {
    $_SESSION['signUp'] = false;
    header('Location: registerPage.php');
}
mysqli_close($conn);
?>