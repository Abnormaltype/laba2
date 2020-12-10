<?php
session_start()
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
        .rbtn {
            text-decoration: none;
            background: #2bec79;
            font-size: 18px;
            padding: 10px 17px;
            border: 1px solid;
            color: white;
            position: fixed;
            right: 32.61em;
            cursor: pointer;
        }

        .lbtn {
            background: #2bec79;
            font-size: 20px;
            padding: 10px 17px;
            border: 1px solid;
            color: white;
            position: relative;
            right: 7.1em;
            top: 0.53em;
            text-decoration: none;
        }

    </style>
</head>
<body>
<div class="home">
    <div class="scope"></div>
    <div class="scope"></div>
    <div class="scope"></div>
    <p class="text">Sign Up</p>
</div>
<div>
    <img class="photo" src="assets/img/logo.png" alt="logo" width="150" height="50">
</div>
<div align="center">
    <?php
    if ($_SESSION['signUp'] == false) {
        echo '<p class="er">An error has occurred. Try again.</p>';
    }
    echo '<form action="signUpPage.php" method="post">';
    if ($_SESSION['chfirst_name'] == false) {
        echo '  <input class="register" type="text" name="first_name" placeholder="Fill first name">';
    } else {
        echo '<input class="register" type="text" name="first_name" placeholder="First Name">';
    }
    if ($_SESSION['last_name'] == false) {
        echo '  <input class="register" type="text" name="last_name" placeholder="Fill last name">';
    } else {
        echo '<input class="register" type="text" name="last_name" placeholder="Last Name">';
    }
    if ($_SESSION['title'] == false) {
        echo ' <input class="register" list="Role" name="title" placeholder="Incorrect Role">
            <datalist id="Role">
                <option value="Admin">
                <option value="User">
            </datalist>';
    } else {
        echo '<input class="register" list="Role" name="title" placeholder="Select Role">
            <datalist id="Role">
                <option value="Admin">
                <option value="User">
            </datalist>';
    }
    if ($_SESSION['email'] == false) {
        echo '  <input class="register" type="email" name="email" placeholder="Fill email">';
    } else {
        echo '<input class="register" type="email" name="email" placeholder="Email">';
    }
    if ($_SESSION['password'] == false) {
        echo '  <input class="register" type="password" name="password" placeholder="Password must be at least 6 symbols">';
    } else {
        echo ' <input class="register" type="password" name="password" placeholder="Password">';
    }
    if ($_SESSION['repassword'] == false) {
        echo ' <input class="register" type="password" name="repassword" placeholder="Incorrect repeated password">';
    } else {
        echo '<input class="register" type="password" name="repassword" placeholder="Repeat Password">';
    }
    echo ' <input type="submit" name="submit" value="Sign Up" class="rbtn">';
    echo '</form>';
    if ($_SESSION['signIn'] != false) {
        echo '<a class="lbtn" href="guestPage.php" >Back</a>';
    } else
        echo '<a class="lbtn" href="home.php" >Back</a>';
    ?>
</div>
</body>
</html>
