<?php
session_start();

$servername = "localhost";
$username_db = "root";
$password_db = "";
$db_name = "first_db";

$conn = mysqli_connect($servername, $username_db, $password_db, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $query = mysqli_query($conn, "SELECT * FROM users_tbl WHERE username='$username' AND password='$password'");

        if(mysqli_num_rows($query) > 0) {
            $_SESSION['user'] = $username;
            header("location: home.php");
            exit();
        } else {
            echo '<script>alert("Invalid username or password!");</script>';
            echo '<script>window.location.assign("login.php");</script>'; // Redirect back to login.php
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My first PHP Website</title>
</head>
<body>
    <h2>Login Page</h2>
    <a href="index.php">Click here to go back</a><br/><br/>
    <form action="checklogin.php" method="POST">
        Enter Username: <input type="text" name="username" required="required" /> <br/>
        Enter password: <input type="password" name="password" required="required" /> <br/>
        <input type="submit" value="Login"/>
    </form>
</body>
</html>
