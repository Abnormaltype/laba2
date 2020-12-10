<?php
session_start();
require_once 'db.php';

$_SESSION['signUp'] = true;
$_SESSION['edit'] = true;
$_SESSION['photo'] = true;

$sql = "SELECT id,first_name, last_name, email FROM users";
$rol = "SELECT title FROM roles";
$result = $conn->query($sql);
$result_rol = $conn->query($rol);

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
        .ad{
            background: #ef32e5;
            font-size: 20px;
            margin: 2em;
            border-radius: 5%;
            padding: 10px 17px;
            border: 1px solid;
            color: white;
            position: fixed;
            right: 20.85em;
            text-decoration: none;
        }
        .a{
            color: black;
        }
    </style>
</head>
<body>
<div class="home">
    <div class="scope"></div>
    <div class="scope"></div>
    <div class="scope"></div>
    <p class="text">Important users</p>
</div>
<div>
    <img class="photo" src="assets/img/logo.png" alt="logo" width="150" height="50">
    <?php
    echo '<p class="link">'.$_SESSION['first_name'].'</p>';
    ?>
    <p class="line">|</p>
    <a class="link" href="home.php">Sign Out</a>
</div>
<div align="center">
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
                if($row['id'] == $_SESSION['id']){
                    echo '<tr class="tg-user">';

                    echo "<td><a class='a' href='userPage.php?id=".$row['id']."'>" . $row["id"] . "</a></td>";
                    echo '<td>' . $row["first_name"] . '</td>';
                    echo '<td>' . $row["last_name"] . '</td>';
                    echo '<td>' . $row["email"] . '</td>';
                    echo '<td>' . $row_rol["title"] . '</td>';

                    echo '</tr>';
                }
                else{
                    echo '<tr>';

                    echo "<td><a class='a' href='userPage.php?id=".$row['id']."'>" . $row["id"] . "</a></td>";
                    echo '<td>' . $row["first_name"] . '</td>';
                    echo '<td>' . $row["last_name"] . '</td>';
                    echo '<td>' . $row["email"] . '</td>';
                    echo '<td>' . $row_rol["title"] . '</td>';

                    echo '</tr>';
                }
            }
            echo '</table>';
        }
        if($_SESSION['title'] == 'admin'){
            echo '<a class="ad" href="registerPage.php">Add user</a>';
        }
        ?>
    </article>
</div>
</body>
</html>
