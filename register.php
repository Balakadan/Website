<!DOCTYPE html>
<html>
<head>
  <title>My first PHP Website - Registration</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      text-align: center;
      padding-top: 50px;
    }
    h2 {
      color: #333;
    }
    a {
      color: #007bff;
      text-decoration: none;
    }
    form {
      margin: 0 auto;
      max-width: 300px;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    input[type="text"],
    input[type="password"],
    input[type="submit"] {
      width: 100%;
      margin-bottom: 10px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }
    input[type="submit"] {
      background-color: #007bff;
      color: #fff;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    input[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <h2>Registration Page</h2>

  <form action="register.php" method="POST">
    <label for="username">Enter Username:</label>
    <input type="text" id="username" name="username" required="required" /> <br/>
    <label for="password">Enter Password:</label>
    <input type="password" id="password" name="password" required="required" /> <br/>
    <input type="submit" value="Register"/>
  </form>
   <br><a href="index.php">Click here to go back</a><br><br>
</body>
</html>

<?php
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
//echo "Connected successfully<br>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $bool = true;

    $query = mysqli_query($conn, "SELECT * FROM users_tbl"); // Query the users table

    while ($row = mysqli_fetch_array($query)) { // Display all rows from query
        $table_users = $row['username']; // The first username row is passed on to $table_users, and so on until the query is finished
        if ($username == $table_users) {// Checks if there are any matching fields
            $bool = false; // Set bool to false
            echo '<script>alert("Username is not available!");</script>'; // Prompt the user
            echo '<script>window.location.assign("register.php");</script>'; // Redirects to register.php
        }
    }

    if ($bool) {
        mysqli_query($conn,"INSERT INTO users_tbl (username, password) VALUES ('$username','$password')"); // Insert the value to the table users_tbl
        echo '<script>alert("Successfully Registered");</script>'; // Prompt the user
        echo '<script>window.location.assign("register.php");</script>'; // Redirects to register.php
    }
}
?>
