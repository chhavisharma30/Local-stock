<?php
class Logout {
   public function __construct() {
      session_start();
      if(!isset($_SESSION["loggedin"])) {
         header("Location: /");
      }
   }
   public function loggingout() {
      session_unset();
      session_destroy();
      header('Refresh: 1; URL = /');
   }
}

$lo = new Logout();
$lo->loggingout();
