<?php
session_start();
$_SESSION = array();
require_once 'db.php';

$sql = "SELECT id,first_name, last_name, email, photo FROM users";
$rol = "SELECT title FROM roles";
$result = $conn->query($sql);
$result_rol = $conn->query($rol);

$_SESSION['id'] = false;
$_SESSION['first_name'] = true;
$_SESSION['last_name'] = true;
$_SESSION['email'] = true;
$_SESSION['title'] = true;
$_SESSION['password'] = true;
$_SESSION['repassword'] = true;

$_SESSION['user_title'] = false;
$_SESSION['signIn'] = false;
$_SESSION['signUp'] = true;
$_SESSION['edit'] = true;
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
        .a {
            color: black;
        }
    </style>
</head>
<body>
<div class="home">
    <div class="scope"></div>
    <div class="scope"></div>
    <div class="scope"></div>
    <p class="text">Best tankers of 2020</p>
</div>
<div>
    <img class="photo" src="assets/img/logo_Alex.png" alt="logo" width="125" height="100">

    <a class="link" href="#openModal">Sign In</a>
    <p class="line">|</p>
    <a class="link" href="registerPage.php">Sign Up</a>
</div>
<div id="openModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-home">
                <p></p>
                <a href="home.php" class="close">×</a>
            </div>
            <div class="modal-body">
                <form action="signInPage.php" method="POST">
                    <table class="sg">
                        <tr>
                            <td>
                                Email
                            </td>
                            <td>
                                <input type="email" name="email"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Password
                            </td>
                            <td>
                                <input type="password" name="password"><br>
                            </td>
                        </tr>
                    </table>
                    <div class = "modal-footer">
                        <p></p>
                        <input class="btn" type="submit" value="Sign In">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div align = "center">
    <article>
        <?php
        if ($result->num_rows > 0 and $result_rol->num_rows > 0) {
            // output data of each row
            echo '<table class="tg">';
            echo '<tr>
                <td class="tg-top">ID</td> 
                <td class="tg-top">First name</td> 
                <td class="tg-top">Last name</td> 
                <td class="tg-top">Email</td> 
                <td class="tg-top">Role</td> 
            </tr>';

            while ($row = $result->fetch_assoc() and $row_rol = $result_rol->fetch_assoc()) {
                echo '<tr>';
                echo "<td><a class='a' href='userPage.php?id=" . $row['id'] . "'>" . $row["id"] . "</a></td>";
                echo '<td>' . $row["first_name"] . '</td>';
                echo '<td>' . $row["last_name"] . '</td>';
                echo '<td>' . $row["email"] . '</td>';
                echo '<td>' . $row_rol["title"] . '</td>';

                echo '</tr>';

            }
            echo '</table>';
        }
        ?>

    </article>
</div>
</body>
</html>
