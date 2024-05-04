<!DOCTYPE html>
<html>
<head>
  <title>Home Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      text-align: center;
      padding-top: 50px;
    }
    h2 {
      color: #333;
    }
    p {
      color: #555;
    }
    form {
      margin: 20px auto;
      max-width: 400px;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    input[type="text"],
    input[type="submit"] {
      width: calc(100% - 22px);
      margin-bottom: 10px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }
    input[type="checkbox"] {
      margin-right: 5px;
      vertical-align: middle;
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
    table {
      width: 80%;
      margin: 20px auto;
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
    }
    th {
      background-color: #007bff;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    tr:hover {
      background-color: #ddd;
    }
    a {
      color: #007bff;
      text-decoration: none;
    }
  </style>
</head>
<body>
<?php
session_start(); // starts the session
if(!$_SESSION['user']) { // checks if the user is not logged in
    header("location: index.php"); // redirect to login page if not logged in
}
$user = $_SESSION['user']; // assigns user value
?>
<h2>Home Page</h2>
<p>Hello <?php echo $user; ?>!</p> <!-- Display user's name -->

<form action="add.php" method="POST">
    Add more to list: <input type="text" name="details" /> <br>
    Public post? <input type="checkbox" name="public[]" value="yes" /> <br>
    <input type="submit" value="Add to list"/>
</form>
<h2>My list</h2>
<table>
    <tr>
        <th>Id</th>
        <th>Details</th>
        <th>Post Time</th>
        <th>Edit Time</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Public Post</th>
    </tr>
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
    $query = mysqli_query($conn, "SELECT * FROM list_tbl"); // SQL Query
    while ($row = mysqli_fetch_array($query)) { // Display all the rows from query
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['details']."</td>";
        echo "<td>".$row['date_posted']. "-". $row['time_posted']."</td>";
        echo "<td>".$row['date_edited']. "-". $row['time_edited']."</td>";
        echo "<td><a href='edit.php?id=".$row['id']."'>edit</a></td>";
        echo "<td><a href='delete.php?id=".$row['id']."'>delete</a></td>";
        echo "<td>".$row['public']."</td>";
        echo "</tr>";
    }
    ?>
</table>
<br><br><a href="logout.php">Click here to logout</a><br><br>
</body>
</html>
