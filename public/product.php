<?php
require_once '../db.php';

$productId = $_GET['id'];

$sqlGetProduct = "SELECT * FROM products WHERE id = $productId";
$result = mysqli_query($connection, $sqlGetProduct);
$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $product['name']; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="product-page-container">
    <h1 class="product-title"><?php echo $product['name']; ?></h1>
    <img class="product-image" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
    <p>Цена: $ <?php echo number_format($product['price'],2,',',' '); ?></p>
    <div class="reviews-container">
        <h2>Отзывы</h2>
        <?php
        $sqlGetReviews = "SELECT * FROM reviews WHERE product_id = $productId";
        $reviewResult = mysqli_query($connection, $sqlGetReviews);
        $reviews = mysqli_fetch_all($reviewResult, MYSQLI_ASSOC);

        if (empty($reviews)) {
            echo '<p>Пока нет отзывов.</p>';
        } else {
            echo '<ul>';
            foreach ($reviews as $review) {
                echo '<li>';
                echo '<p>' . $review['text'] . '</p>';
                echo '<p>Автор: ' . $review['author'] . '</p>';
                echo '</li>';
            }
            echo '</ul>';
        }
        ?>
    </div>

    <?php
    if (isset($_GET['success']) && $_GET['success'] === '1') {
        echo '<p class="success-message">Отзыв успешно добавлен.</p>';
    }
    ?>

    <h3>Оставить отзыв</h3>
    <form class="product-review-form" method="POST" action="submit-review.php">
        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
        <label for="author">Автор:</label>
        <input type="text" name="author" id="author">
        <label for="text">Отзыв:</label>
        <textarea name="text" id="text"></textarea>
        <button type="submit">Отправить отзыв</button>
    </form>
</div>
</body>
</html>
