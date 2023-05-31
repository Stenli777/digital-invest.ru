<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'digital-invest';

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die('Ошибка пподключения:' . mysqli_connect_error());
};

$sqlCheckProductsTable = "SHOW TABLES LIKE 'products'";

$productsAlreadyExist = mysqli_query($connection, $sqlCheckProductsTable);

if ($productsAlreadyExist && mysqli_num_rows($productsAlreadyExist) > 0) {
    echo "Таблица products уже существует.";
} else {
    $sqlProducts = "CREATE TABLE products (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        image VARCHAR(255)
    )";

    if (mysqli_query($connection, $sqlProducts)) {
        echo "Таблица product создана успешно.";
    } else {
        echo "Ошибка создания таблицы products" . mysqli_error($connection);
    }
}

$sqlCheckReviewsTable = "SHOW TABLES LIKE 'reviews'";

$reviewsAlreadyExist = mysqli_query($connection, $sqlCheckReviewsTable);

if ($reviewsAlreadyExist && mysqli_num_rows($reviewsAlreadyExist) > 0) {
    echo "Таблица reviews уже существует.";
} else {
    $sqlReviews = "CREATE TABLE reviews (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            product_id INT(11) UNSIGNED,
            author VARCHAR(255) NOT NULL,
            text TEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (product_id) REFERENCES products(id)
        )";

    if (mysqli_query($connection, $sqlReviews)) {
        echo "Таблица reviews создана успешно.";
    } else {
        echo "Ошибка создания таблицы reviews" . mysqli_error($connection);
    }
}
$sqlCheckFilled = 'SELECT COUNT(*) as count FROM products';
$productAlreadyFilled = mysqli_query($connection,$sqlCheckFilled);
$row = mysqli_fetch_assoc($productAlreadyFilled);
$isFilled = $row['count'] > 0;

if (!$isFilled) {
    $sqkInsertProducts = "INSERT INTO products (name, price, image) VALUES 
        ('Bitcoin', 27902.88, '/images/bitcoin.jpg'),
        ('Etherium',1902.2, '/images/etherium.jpg'),
        ('Litecoin', 91.17, '/images/litecoin.jpg'),
        ('Dogecoin', 0.07, '/images/dogecoin.jpg'),
        ('Dash',43.41, '/images/dash.jpg')";

    if (mysqli_query($connection, $sqkInsertProducts)) {
        echo "Таблица products заполнена данными.";
    } else {
        echo "Ошибка создания таблицы products" . mysqli_error($connection);
    }
}
