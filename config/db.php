<?php
include("../env.php");

try {
    $conexion = new  PDO("mysql:host=$host;dbname=$db", $user, $pwd);
} catch (Exception $e) {
    echo $e->getMessage();
}
