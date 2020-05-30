<?php

$config = require_once __DIR__ . '/../config.php';

$servername = $config['host'];
$username = $config['username'];
$password = $config['password'];
$database = $config['database'];

$conn = new PDO("mysql:host=$servername", $username,$password);

try {
    $sql = "CREATE DATABASE $database";
    $conn->exec($sql);
    echo "Database Sucessfully created" .PHP_EOL;
    $conn->query("use $database");

    $sql = "CREATE TABLE users (
    userid int,
    firstname varchar(255),
    lastname varchar(255),
    email varchar(255),
    password varchar(255))";

    $conn->exec($sql);
    echo "Table \"users\" created succesfully" . PHP_EOL;
} catch (PDOException $exception){
    echo "Failed due to  " . $exception;
}