<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location:index.php");
}

$servername = "localhost";
$username_db = "root";
$password_db = "";
$db_name = "first_db";

// Create connection
$conn = mysqli_connect($servername, $username_db, $password_db, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL query to delete the item with the given ID
    $sql = "DELETE FROM list_tbl WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        // If deletion is successful, redirect back to home.php
        header("location: home.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    // Redirect to home.php if the request method is not GET or if the ID is not provided
    header("location: home.php");
}

?>
