<?php


$host = 'localhost'; // Replace with your host name
$dbname = 'myfirstdatabase';
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>