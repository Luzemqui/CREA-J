<?php
/* ============================================================
   CANRISK — Conexión a la base de datos (Actualizada PHP 8)
   ============================================================ */

// Obligamos a PHP a mostrarnos el error real en vez de colapsar
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Usamos 127.0.0.1 en lugar de localhost para evitar errores de socket en Linux
    // El cuarto parámetro ya selecciona la base de datos automáticamente
    $conectar = mysqli_connect('localhost', 'root', '', 'canrisk');
    
} catch (mysqli_sql_exception $e) {
    // Si la conexión falla, detenemos todo y mostramos el motivo exacto
    die("Error crítico al conectar a la base de datos: " . $e->getMessage());
}
?>