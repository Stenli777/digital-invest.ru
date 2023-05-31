<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Плитка с товарами</title>
</head>
<body>
<div class="product-tiles-container">
<?php

require_once '../db.php';

$sqlSelectProducts = "SELECT * FROM products";
$result = mysqli_query($connection, $sqlSelectProducts);

while ($row = mysqli_fetch_assoc($result)) {
    $productId = $row['id'];
    $productName = $row['name'];
    $productPrice = $row['price'];
    $productImage = $row['image'];

    echo '<div class="product-tile">';
    echo '<div class="img-center"><img class="product-image" src="' . $productImage . '" alt="' . $productName . '"></div>';
    echo '<h3 class="product-title">' . $productName . '</h3>';
    echo '<p class="product-price">Цена: $ ' . number_format($productPrice,2,',',' ') . '</p>';
    echo '<a class="product-link" href="product.php?id=' . $productId . '">Подробнее</a>';
    echo '</div>';
  }
 ?>
</div>
</body>
</html>


