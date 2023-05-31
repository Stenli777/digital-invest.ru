<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'digital-invest';

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die('Ошибка пподключения:' . mysqli_connect_error());
};