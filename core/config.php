<?php
$username = "root";
$password = "";
$host = "localhost";
$database = "test";
$charset = "utf8";
$default_attributes = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
);
$dsn = "mysql:host=$host;dbname=$database;charset=$charset";