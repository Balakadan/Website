<!DOCTYPE html>
<html>
<head>
  <title>My first PHP Website</title>
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
      display: inline-block;
      margin: 10px;
      padding: 10px 20px;
      text-decoration: none;
      color: #fff;
      background-color: #007bff;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }
    a:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <?php
    echo "<h2>My First PHP Website</h2>";
  ?>
  <a href="login.php"> Click here to login </a>
  <a href="register.php"> Click here to register </a>
</body>
</html>
