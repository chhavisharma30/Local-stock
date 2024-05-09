<?php

namespace app;

use app\Config;

// Class for user registration
class Registration {

  // Properties to hold user input data
  public $username, $password, $email, $name, $confirm;

  // Constructor method
  public function __construct() {
    // Creating a new instance of Config class (if needed)
    new Config();
    // Starting a PHP session
    session_start();
  }

  // Method to validate user input
  public function validate_entries() {
    // Assigning user data to variables for easy access
    $this->username = $_POST['usernm'];
    $this->password = md5($_POST['passwd']); // Note: md5 hashing is not secure
    $this->email = $_POST['email'];
    $this->name = $_POST['name'];
    $this->confirm = $_POST['confirm'];

    // Validating email format
    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      return false;
    } elseif (!preg_match('/^[A-Za-z]+$/', $this->name)) { // Validating name format
      echo '<script>alert("Name should contain only letters!!")</script>';
      return false;
    } elseif (!preg_match('/^[A-Za-z_][A-Za-z_.0-9]*$/', $this->username)) { // Validating username format
      echo '<script>alert("Username should start with a letter or underscore and can contain only letters, digits, underscores and dot!!")</script>';
      return false;
    } elseif (strlen($this->password) < 8) { // Validating password length
      echo '<script>alert("Password should contain minimum 8 characters!!")</script>';
      return false;
    } elseif ($this->password != $this->confirm) { // Checking if password and confirm password match
      echo '<script>alert("Password and confirm password do not match!!")</script>';
      return false;
    }
    return true;
  }

  // Method to register a new user
  public function reg() {
    // Establishing a database connection
    $db_conn = new \mysqli(HOSTNAME, USERNAME, PASSWORD, DBNAME);

    // Checking for connection errors
    if ($db_conn->connect_error) {
      die("ERROR: Could not connect. " . $db_conn->connect_error);
    }

    // Handling form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // SQL query for inserting form data into the users table
      $stmt = $db_conn->prepare("INSERT INTO credentials_table(Name, Email, Username, Password) VALUES (?,?,?,?)");
      $stmt->bind_param("ssss", $this->name, $this->email, $this->username, $this->password);

      // Executing the SQL query
      try {
        $stmt->execute();
        echo '<script>alert("Registered successfully!!")</script>';
        header('Refresh: 1; URL = /');
      } catch (\Exception $e) {
        echo '<script>alert("Error!! Registration Failed!")</script>';
        echo $e->getMessage(); // Displaying error message
      }
    }
  }
}
