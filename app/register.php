<?php
use app\Registration;

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    header("location: /");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $r = new Registration();
    if ($r->validate_entries()) {
        $r->reg();
    }
}

?>
<html>

<head>
    <title>Registration page</title>
    <link rel="stylesheet" type="text/css" href="../css/register.css">
</head>

<body>

    <h2>Register as new user</h2>

    <form action="/register" method="post">
        <label for="usernm">Username: </label>
        <input type="text" name="usernm" required autofocus></br><br>
        <label for="passwd">Password: </label>
        <input type="password" name="passwd" required></br><br>
        <label for="confirm">Confirm Password: </label>
        <input type="password" name="confirm" required></br><br>
        <label for="name">Name: </label>
        <input type="text" name="name" required></br><br>
        <label for="email">Email: </label>
        <input type="email" name="email" required></br><br>
        <button type="submit" name="register">Register</button>
    </form>

</body>

</html>