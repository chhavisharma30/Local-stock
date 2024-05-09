<?php

use app\Display;

session_start();

if (!isset($_SESSION['loggedin'])) {
  header("LOCATION:/");
}

$d = new Display();
$result = $d->getStockData($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $d->editStock();
}

?>

<html>

<head>
  <title>Edit Stock</title>
  <link rel="stylesheet" type="text/css" href="../css/edit.css">
</head>

<body>
  <form action="/edit" method="post">
    <input type="hidden" name="stockId" value="<?php echo $_GET['id'] ?>">
    <label for="stockName">Stock Name</label>
    <input type="text" name="stockName" value="<?php echo $result[0]['Name'] ?>"><br>
    <label for="stockPrice">Stock Price</label>
    <input type="text" name="stockPrice" value="<?php echo $result[0]['Price'] ?>"><br>
    <input type="submit" name="submit" value="Submit">
  </form>
</body>

</html>