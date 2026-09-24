<?php
// Obligamos a PHP a mostrarnos el error real en vez de colapsar
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// --- Datos de conexión (local: XAMPP/LAMPP/WAMP) ---
// Orden: servidor, usuario, contraseña, base de datos
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';        // root no tiene contraseña por defecto en XAMPP/WAMP
$DB_NAME = 'canrisk';

try {
    $conectar = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    mysqli_set_charset($conectar, 'utf8mb4');
} catch (mysqli_sql_exception $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
