<?php

namespace app;

use app\Connection;

// Authentication class definition
class Authentication {
  
  // Property to hold the database connection
  public $db_conn;

  // Constructor method
  public function __construct() {
    // Starting a PHP session
    session_start();
    // Creating a new instance of the Connection class
    $conn = new Connection();
    // Establishing a database connection and assigning it to the $db_conn property
    $this->db_conn = $conn->connect();
  }

  // Method to authenticate user
  public function authenticate() {
    // Checking if form data is submitted
    if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {

      // Getting username and encrypting password
      $un = $_POST['username'];
      $pw = md5($_POST['password']);

      // Query to check if username and password match
      $sql = "SELECT * FROM credentials_table WHERE Username ='$un' AND Password = '$pw'";

      // Executing the query
      $result = mysqli_query($this->db_conn, $sql);

      // If a row is returned, credentials are correct
      if (mysqli_num_rows($result)) {
        // Setting session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $un;
        // Redirecting to home page
        header("LOCATION: /home");
      } else {
        // If no matching credentials found, showing error message and redirecting back to login page
        echo '<script>alert("Wrong username or password!")</script>';
        header('Refresh: 1; URL = /');
      }
    } else {
      // If username or password is not provided, showing error message
      echo '<script>alert("Please enter username and password!")</script>';
    }
  }
}
