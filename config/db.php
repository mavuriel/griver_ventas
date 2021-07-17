<?php
include("../env.php");

try {
    $conexion = new  PDO("mysql:host=$host;dbname=$db", $user, $pwd);
    /* if ($conexion) {
        echo 'conectado';
    } */
} catch (Exception $e) {
    echo $e->getMessage();
}
