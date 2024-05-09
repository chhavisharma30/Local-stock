<?php

use app\Display;

session_start();

if (!isset($_SESSION['loggedin'])) {
  header("LOCATION:/");
}

$d = new Display();
$stocks = $d->showUserStocks();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $d = new Display();
  $d->addStock();
}

?>

<html>

<head>
  <title>Stock Entry</title>
  <link rel="stylesheet" type="text/css" href="../css/entry.css">
</head>

<body>
  <a href="/home">Home</a><br>

  <form action="/stock-entry" method="post">
    <label for="stockName">Stock Name</label>
    <input type="text" name="stockName"><br>
    <label for="stockPrice">Stock Price</label>
    <input type="text" name="stockPrice"><br>
    <input type="submit" name="submit" value="Submit">
  </form>

  <body>
    <table border="1">
      <tr>
        <th>Stock Name</th>
        <th>Stock Price</th>
        <th>Created Date</th>
        <th>Last Updated</th>
      </tr>
      <?php
      foreach ($stocks as $stock) {
        ?>
        <tr>
          <td><?php echo $stock['Name'] ?></td>
          <td><?php echo $stock['Price'] ?></td>
          <td><?php echo $stock['CreationTime'] ?></td>
          <td><?php echo $stock['UpdationTime'] ?></td>
          <td><a href="/edit?id=<?php echo $stock['StockId'] ?>">Edit</a></td>
        </tr>
        <?php
      }
      ?>

  </body>

</html>