<?php
session_start();
require_once 'db.php';

$id = $_GET['id'];
$user = mysqli_query($conn, "SELECT * FROM users WHERE id='" . $id . "' ;");
$rol = mysqli_query($conn, "SELECT * FROM roles WHERE id='" . $id . "' ;");
$check_user = mysqli_fetch_array($user);
$check_rol = mysqli_fetch_array($rol);

//admin
$first_name = $check_user['first_name'];
$last_name = $check_user['last_name'];
$email = $check_user['email'];
$password = $check_user['password'];
$photo = $check_user['photo'];
$title = $check_rol['title'];
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .sel {
            font-size: 20px;
        }
        .photo{
            position: relative;
            bottom: 100px;
            padding-right:350px;
        }
    </style>
</head>
<body>
<div class="home">
    <div class="scope"></div>
    <div class="scope"></div>
    <div class="scope"></div>
    <p class="text">User page</p>
</div>
<div>
    <img class="photo" src="assets/img/logo_Alex.png" alt="logo" width="125" height="100">
</div>
<div>
    <?php
    echo '<table align="center">';
    echo '<tr>';
    echo '<td>';
    echo "<img src = " . $photo . " alt='User photo' width='250' height='200' class='photo'>";
    echo '</td>';
    if ($_SESSION['user_title'] == 'admin' or $id == $_SESSION['id']) {
        echo '<td>';
        echo '<form action="editPage.php?id=' . $id . '" method="post" enctype="multipart/form-data">';
        echo '<input class="admin_inform" type="text" name="first_name" value=' . $first_name . '>';
        echo '<input class="admin_inform" type="text" name="last_name" value=' . $last_name . '>';
        if ($_SESSION['title'] == 'admin') {
            echo '<input class="admin_inform" list="Role" name="title" value=' . $title . '>
            <datalist id="Role">
                <option value="Admin">
                <option value="User">
            </datalist>';
        }
        echo '<input class="admin_inform" type="email" name="email" value=' . $email . '>';
        echo ' <input class="admin_inform" type="password" name="password" value=' . $password . '>';
        echo '<input class="admin_inform" type="password" name="repassword" value=' . $password . '>';
        echo ' <p class="sel" align="center">Select image to upload</p>
                    <input class="admin_inform" type="file" name="fileToUpload">';
        if ($_SESSION['title'] == 'admin') {
            echo '<a class="ubtn" href="guestPage.php" >Back</a>';
            echo '<a class="ubtn" href="deletePage.php?id=' . $id . '" >Delete</a>';
        }
        if ($_SESSION['title'] == 'user') {
            echo '<a class="ubtn" href="guestPage.php" >Back</a>';
        }
        echo ' <input class="ubtn" type="submit" name="submit" value="Edit">';
        echo '</form>';
        echo '</td>';
    } else {
        echo '<td>';
        echo '<p class="inform">' . $check_user["first_name"] . '</p>';
        echo '<p class="inform"> ' . $check_user["last_name"] . '</p>';
        echo '<p class="inform">' . $check_user["email"] . '</p>';
        echo '<p class="inform">' . $check_rol["title"] . '</p>';
        if ($_SESSION['user_title'] == 'user') {
            echo '<a class="back_btn" href="guestPage.php">Back</a>';
        } else echo '<a class="back_btn" href="home.php">Back</a>';
        echo '</td>';
    }
    echo '</tr>';
    echo '</table>';
    ?>
</div>
<?php
if ($_SESSION['edit'] == false) {
    echo '<p class="er">An error has occurred.</p>';
    if ($_SESSION['chfirst_name'] == false) echo '<p class="er">Fill in the first_name.</p>';
    if ($_SESSION['last_name'] == false) echo '<p class="er">Fill in the last_name.</p>';
    if ($_SESSION['email'] == false) echo '<p class="er">Fill in the email.</p>';
    if ($_SESSION['password'] == false) echo '<p class="er">Password must be at least 6 symbols.</p>';
    if ($_SESSION['repassword'] == false) echo '<p class="er">Incorrect repassword.</p>';
    if ($_SESSION['title'] == false) echo '<p class="er">Choose the role.</p>';
    if ($_SESSION['photo'] == false) echo '<p class="er">Choose the photo. Size < 500kb. Format jpeg, png, jpg, gif.</p>';
}
?>
</body>
</html>

