<?php

use app\Display;

session_start();

if (!isset($_SESSION['loggedin'])) {
  header("LOCATION:/");
}

$d = new Display();
$stocks = $d->showStocks();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $d->deleteStock();
}

?>

<html>

<head>
  <title>Stock Entry</title>
  <link rel="stylesheet" type="text/css" href="../css/home.css">
</head>

<body>

  <a href="/logout">Logout</a><br>
  <a href="/stock-entry">Add Stock</a>

  <?php
  if ($stocks) {
    ?>
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
          <?php
          if ($stock['Username'] == $_SESSION['username']) {
            ?>
            <td>
              <form action="/home" method="post">
                <input type="hidden" name="stockId" value="<?php echo $stock['StockId'] ?>">
                <input type="submit" name="delete" value="Delete">
              </form>
            </td>
            <?php
          }
          echo "</tr>";
      }
  }
  ?>

</body>

</html>