<?php
session_start();

if (!isset($_SESSION["userSession"])) {
    header("Location: loginING.php");
    exit;
}

$sesion = $_SESSION["userSession"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - Canrisk</title>
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
    <button type="button" class="theme-toggle-btn" id="themeToggleBtn" aria-label="Switch to dark mode">
        <span class="theme-toggle-icon" aria-hidden="true"></span>
    </button>
    <div class="form">
        <a class="auth-brand" href="PrincipalING.php">
            <img src="../../MULTIMEDIA/Canrisk LOGO.svg" alt="Canrisk">
            <span>Canrisk</span>
        </a>

        <h1>My Account</h1>
        <span class="auth-subtitle">Your current session details</span>

        <div class="field-group">
            <label class="User-text">User:</label>
            <div class="username"><?php echo htmlspecialchars($sesion['username'] ?? '', ENT_QUOTES); ?></div>
        </div>

        <div class="field-group">
            <label class="User-text">Name:</label>
            <div class="name"><?php echo htmlspecialchars($sesion['nombre'] ?? '', ENT_QUOTES); ?></div>
        </div>

        <button type="button" class="regresar" onclick="window.history.back()">Go back</button>

        <div class="register">
            <a class="resgis-txt" href="../../PHP/logout.php">Log out</a>
        </div>
    </div>

    <script src="../../JS/theme-toggle.js"></script>
</body>
</html>
