<!DOCTYPE html>
<html>
<head>
  <title>Edit Page</title>
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
    table {
      margin: 20px auto;
      border-collapse: collapse;
      width: 80%;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    form {
      margin: 20px auto;
      max-width: 400px;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    input[type="text"],
    input[type="checkbox"],
    input[type="submit"] {
      width: calc(100% - 22px);
      margin-bottom: 10px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }
    input[type="checkbox"] {
      margin-top: 5px;
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
    a.button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }
    a.button:hover {
      background-color: #0056b3;
    }
    a {
      color: #007bff;
      text-decoration: none;
    }
  </style>
</head>
<body>
<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location:index.php"); // Redirect if user is not logged in
}

$id_exists = false;

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $_SESSION['id'] = $id;
    $id_exists = true;

    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $db_name = "first_db";

    // Create connection
    $conn = mysqli_connect($servername, $username_db, $password_db, $db_name);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = mysqli_query($conn, "SELECT * FROM list_tbl WHERE id='$id'"); // SQL Query
    $count = mysqli_num_rows($query);

    if ($count > 0) {
        while ($row = mysqli_fetch_array($query)) {
            $id = $row['id'];
            $details = $row['details'];
            $date_posted = $row['date_posted'];
            $time_posted = $row['time_posted'];
            $date_edited = $row['date_edited'];
            $time_edited = $row['time_edited'];
            $public = $row['public'];
        }
    } else {
        $id_exists = false;
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
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

    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $public = "no";
    $id = $_SESSION['id'];
    $time = strftime("%X"); // Time
    $date = strftime("%B %d, %Y"); // Date

    if (isset($_POST['public']) && $_POST['public'] == 'yes') {
        $public = "yes";
    }

    $sql = "UPDATE list_tbl SET details='$details', public='$public', date_edited='$date', time_edited='$time' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("location: home.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<h2>Edit Page</h2>
<p>Hello <?php echo $_SESSION['user']; ?>!</p> <!-- Display user's name -->

<?php if ($id_exists): ?>
  <h2>Currently Selected</h2>
  <table>
    <tr>
      <th>Id</th>
      <th>Details</th>
      <th>Post Time</th>
      <th>Edit Time</th>
      <th>Public Post</th>
    </tr>
    <tr>
      <td><?php echo $id; ?></td>
      <td><?php echo $details; ?></td>
      <td><?php echo $date_posted . " - " . $time_posted; ?></td>
      <td><?php echo $date_edited . " - " . $time_edited; ?></td>
      <td><?php echo $public; ?></td>
    </tr>
  </table>

  <br/>
  <form action="edit.php?id=<?php echo $id; ?>" method="POST">
    Enter new detail: <input type="text" name="details" value="<?php echo $details; ?>"/><br/>
    Public post? <input type="checkbox" name="public" value="yes" <?php if ($public == 'yes') echo 'checked'; ?> /><br/>
    <input type="submit" value="Update List"/>
  </form>
<?php else: ?>
  <p>There is no data to be edited.</p>
<?php endif; ?>

<a href="home.php" class="button">Return to Home page</a><br><br>
<a href="logout.php" class="button">Click here to logout</a><br/><br/>

</body>
</html>
