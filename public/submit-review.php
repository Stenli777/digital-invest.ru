<?php
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    $author = $_POST['author'];
    $text = $_POST['text'];

    $sqlInsertReview = "INSERT INTO reviews (product_id, author, text) VALUES ('$productId', '$author', '$text')";
    if (mysqli_query($connection, $sqlInsertReview)) {
        header("Location: product.php?id=$productId&success=1");
        exit();
    } else {
        echo "Ошибка добавления отзыва: " . mysqli_error($connection);
    }
}