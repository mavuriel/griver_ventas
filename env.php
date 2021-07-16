<?php
require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_SERVER['DB_HOST'];
$db = $_SERVER['DB_DATABASE'];
$user = $_SERVER['DB_USER'];
$pwd = $_SERVER['DB_PASSWORD'];
