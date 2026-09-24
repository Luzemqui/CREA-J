<?php
// Obligamos a PHP a mostrarnos el error real en vez de colapsar
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// --- Datos de conexión (local: XAMPP/LAMPP) ---
$conectar = mysqli_connect("localhost", "root", "canrisk");

if (!$conectar) {
  echo "No se pudo conectar";
} else {
  $base = mysqli_select_db($conectar, "canrisk");

  if(!$base) { 
    echo "No se puedo realizar la conexión con la base de datos";
  }
}
