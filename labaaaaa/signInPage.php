<?php
// Start the session
session_start();
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "laba"; //повинна бути створена в субд
$_SESSION['signIn'] = false;

// Встановлення з'єднання
$conn = new mysqli($servername, $username, $password, $database);

// Перевірка з'єднання
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$email = $_POST['email'];
$password = $_POST['password'];

$user = mysqli_query($conn, "SELECT * FROM users WHERE email='" . $email . "' and password='" . $password . "';");
$check_user = mysqli_fetch_array($user) or die("Incorrect password or login!");

if (is_array($check_user)) {
    $_SESSION['signIn'] = true;
    $_SESSION['first_name'] = $check_user['first_name'];
    $_SESSION['id'] = $check_user['id'];
    $rol = mysqli_query($conn, "SELECT * FROM roles WHERE id='" . $_SESSION['id'] . "' ;");
    $check_rol = mysqli_fetch_array($rol);
    $_SESSION['user_title'] = $check_rol['title'];
    header('Location: guestPage.php');
}
else{
    header('Location: home.php');
}

mysqli_close($conn);
?>


