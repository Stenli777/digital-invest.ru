<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'digital-invest';

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die('Ошибка пподключения:' . mysqli_connect_error());
};

$sqlProducts = "CREATE TABLE product (
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

$sqlReviews = "CREATE TABLE reviews (
   id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   product_id INT(11) UNSIGNED,
   author VARCHAR(255) NOT NULL,
   content TEXT NOT NULL,
   created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
   FOREIGN KEY (product_id) REFERENCES products(id)
)";
