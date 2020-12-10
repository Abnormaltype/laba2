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
$_SESSION['edit'] = true;
$_SESSION['photo'] = true;
$uploadOk = 1;

$id = $_GET['id'];

$target_dir = "public/images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

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
if ($_FILES["fileToUpload"]["tmp_name"] == null) {
    $_SESSION['photo'] = false;
    $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 500000) {
    $uploadOk = 0;
    $_SESSION['photo'] = false;
}

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
    $uploadOk = 0;
    $_SESSION['photo'] = false;
}

if ($_SESSION['chfirst_name'] != false and $_SESSION['last_name'] != false and $_SESSION['email'] != false and $_SESSION['password'] != false and $_SESSION['repassword'] != false and $_SESSION['title'] != false and $uploadOk != 0) {
    $user = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', password='$password', photo='$target_file' WHERE id='$id'";
    $rol = "UPDATE roles SET title='$title' WHERE id='$id'";
    mysqli_query($conn, $user) or die('Error querying database.');
    mysqli_query($conn, $rol) or die('Error querying database.');
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) or die('Error while uploading a photo.');
} else {
    $_SESSION['edit'] = false;
}
header('Location: userPage.php?id=' . $id . '');
mysqli_close($conn);
?>