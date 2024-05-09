<?php 
namespace app;

use app\Connection;

// Class for handling display-related operations
class Display{

  // Database connection and username properties
  public $db_conn, $username;

  // Constructor method
  public function __construct(){ 
    // Establishing a database connection
    $conn = new Connection();
    $this->db_conn = $conn->connect();
    // Retrieving username from session
    $this->username = $_SESSION['username'];
  }

  // Method to retrieve all stocks
  public function showStocks() {
    // Query to fetch all stocks
    $query = "SELECT * from stocks_table";
    // Executing the query
    $result = mysqli_query($this->db_conn, $query);
    return $result;
  }

  // Method to retrieve stocks owned by the current user
  public function showUserStocks() {
    // Query to fetch stocks for the current user
    $username = $_SESSION['username'];
    $query = "SELECT * from stocks_table WHERE Username = '$username'";
    // Executing the query
    $result = mysqli_query($this->db_conn, $query);
    return $result;
  }

  // Method to add a new stock entry
  public function addStock() {
    // Retrieving data from form submission
    $username = $_SESSION['username'];
    $time =  date("Y-m-d H:i:s");
    $stockName = $_POST['stockName'];
    $stockPrice = $_POST['stockPrice'];
    // Query to insert new stock entry
    $query = "INSERT INTO stocks_table(Username, Name, Price, CreationTime, UpdationTime) VALUES('$username', '$stockName', '$stockPrice', '$time', '$time' )";
    // Executing the query
    mysqli_query($this->db_conn, $query);
    // Redirecting after adding the stock
    header('Refresh: 1; URL = /stock-entry');
  }

  // Method to retrieve data of a specific stock
  public function getStockData($id) {
    // Query to fetch data of a specific stock by its ID
    $query = "SELECT * FROM stocks_table WHERE StockId = $id";
    // Executing the query
    $result = mysqli_query($this->db_conn, $query);

    // Initialize an empty array to store the results
    $stocksArray = array();

    // Fetching each row from the result set and appending it to the array
    while ($row = mysqli_fetch_assoc($result)) {
        $stocksArray[] = $row;
    }
    return $stocksArray;
  }

  // Method to edit an existing stock entry
  public function editStock() {
    // Retrieving data from form submission
    $id = $_POST['stockId'];
    $time =  date("Y-m-d H:i:s");
    $stockName = $_POST['stockName'];
    $stockPrice = $_POST['stockPrice'];
    // Query to update an existing stock entry
    $query = "UPDATE stocks_table SET Name = '$stockName', Price = '$stockPrice', UpdationTime = '$time' WHERE StockId = $id AND Username = '$this->username'";
    // Executing the query
    mysqli_query($this->db_conn, $query);
    // Showing success message
    echo "Stock edited successfully!";
    // Redirecting after editing the stock
    header('Refresh: 1; URL = /stock-entry');
  }

  // Method to delete an existing stock entry
  public function deleteStock() {
    // Retrieving data from form submission
    $id = $_POST['stockId'];
    // Query to delete an existing stock entry
    $query = "DELETE FROM stocks_table WHERE StockId = $id AND Username = '$this->username'";
    // Executing the query
    mysqli_query($this->db_conn, $query);
    // Redirecting after deleting the stock
    header('Refresh: 1; URL = /home');
  }
}
