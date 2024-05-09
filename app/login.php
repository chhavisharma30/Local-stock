<?php
use app\Authentication;

session_start();

if (isset($_SESSION["loggedin"])) {
  header("LOCATION:/home");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $a = new Authentication();
  $a->authenticate();
}

?>
<html>

<head>
  <title>Login page</title>
  <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>

<body>

  <h2>Enter Username and Password</h2>


  <form action="/" method="post">
    <label for="username">Username: </label>
    <input type="text" name="username" required autofocus></br>
    <label for="password">Password: </label>
    <input type="password" name="password" required></br>
    <button type="submit" name="login">Login</button><br><br>
  </form>

  <a href="/register">Register</a>

</body>

</html>
