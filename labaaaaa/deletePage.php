<?php
session_start();
require_once 'db.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE  FROM users WHERE id='" . $id . "';") or die('Error querying database.');
mysqli_query($conn, "DELETE  FROM roles WHERE id='" . $id . "';") or die('Error querying database.');

if($id == $_SESSION['id']) header('Location: home.php');
else header('Location: guestPage.php');

