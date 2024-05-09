<?php
namespace app;

use app\Config;
class Connection {
  public $db_conn;
  public function __construct() {
    new Config();
  }
  public function connect(){
    # Database Connection credentialsDB is the Database name.
    $this->db_conn = new \mysqli(HOSTNAME, USERNAME, PASSWORD, DBNAME);

    if ($this->db_conn->connect_error) {
      die("ERROR: Could not connect. "
        . $this->db_conn->connect_error);
    }
    else{
      return $this->db_conn;
    }
  }
}
