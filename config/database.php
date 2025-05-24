<?php
// Configuración de conexión a la base de datos MySQL
define('DB_HOST', 'localhost');
define('DB_NAME', 'nuevodayara');
define('DB_USER', 'root');   // Cambia esto por tu usuario de MySQL
define('DB_PASS', '');       // Cambia esto por tu contraseña de MySQL

function db_connect() {
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($mysqli->connect_error) {
        die('Error de conexión a la base de datos: ' . $mysqli->connect_error);
    }
    $mysqli->set_charset("utf8mb4");
    return $mysqli;
}