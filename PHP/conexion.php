<?php
/* ============================================================
   CANRISK — Conexión a la base de datos (Actualizada PHP 8)
   ------------------------------------------------------------
   IMPORTANTE al desplegar en InfinityFree:
   InfinityFree NO usa 'localhost' ni el usuario 'root'. Debes
   reemplazar los 4 valores de abajo con los que aparecen en tu
   panel (vPanel) -> MySQL Databases, tienen esta forma:
     Host:     sqlXXX.infinityfree.com
     Usuario:  ifX_XXXXXXXX_canrisk
     Password: la que definiste al crear la base de datos
     Base:     ifX_XXXXXXXX_canrisk
   ============================================================ */

// Obligamos a PHP a mostrarnos el error real en vez de colapsar
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// --- Datos de conexión (edita estos 4 valores para InfinityFree) ---
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'canrisk';

try {
    $conectar = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
} catch (mysqli_sql_exception $e) {
    // Si la conexión falla, detenemos todo y mostramos el motivo exacto
    die("Error crítico al conectar a la base de datos: " . $e->getMessage());
}
?>