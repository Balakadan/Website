<!DOCTYPE html>
<html>
<head>
  <title>My first PHP Website - Login</title>
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
  <h2>Login Page</h2>
<br>
  <form action="checklogin.php" method="POST">
    <label for="username">Enter Username:</label>
    <input type="text" id="username" name="username" required="required" /> <br/>
    <label for="password">Enter Password:</label>
    <input type="password" id="password" name="password" required="required" /> <br/>
    <input type="submit" value="Login"/>
  </form>
  <br>
    <a href="index.php">Click here to go back</a><br/><br/>
</body>
</html>
