<?php
session_start();

if (!isset($_SESSION["userSession"])) {
    $isEnglish   = strpos($_SERVER["REQUEST_URI"], "/INGLES/") !== false;
    $redirectUrl = $isEnglish ? "loginING.php" : "login.php";

    header("Location: " . $redirectUrl);
    exit;
}

$sesion = $_SESSION["userSession"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Cuenta - Canrisk</title>
    <script>
        (function () {
            try {
                var saved = localStorage.getItem("canrisk-theme");
                if (saved === "dark" || (!saved && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
                    document.documentElement.setAttribute("data-theme", "dark");
                }
            } catch (e) {}
        })();
    </script>
    <link rel="stylesheet" href="../../CSS/register.css">
    <link rel="icon" type="image/png" href="../../MULTIMEDIA/Canrisk LOGO.svg">
</head>
<body>
    <button type="button" class="theme-toggle-btn" id="themeToggleBtn" aria-label="Cambiar a modo oscuro">
        <span class="theme-toggle-icon" aria-hidden="true"></span>
    </button>
    <div class="form">
        <a class="auth-brand" href="Principal.php">
            <img src="../../MULTIMEDIA/Canrisk LOGO.svg" alt="Canrisk">
            <span>Canrisk</span>
        </a>

        <h1>Mi Cuenta</h1>
        <span class="auth-subtitle">Datos de tu sesión actual</span>

        <div class="field-group">
            <label class="User-text">Usuario:</label>
            <div class="username"><?php echo htmlspecialchars($sesion['username'] ?? '', ENT_QUOTES); ?></div>
        </div>

        <div class="field-group">
            <label class="User-text">Nombre:</label>
            <div class="name"><?php echo htmlspecialchars($sesion['nombre'] ?? '', ENT_QUOTES); ?></div>
        </div>

        <button type="button" class="regresar" onclick="window.history.back()">Regresar</button>

        <div class="register">
            <a class="resgis-txt" href="../../PHP/logout.php">Cerrar sesión</a>
        </div>
    </div>

    <script src="../../JS/theme-toggle.js"></script>
</body>
</html>
