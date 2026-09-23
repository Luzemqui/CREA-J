<?php
session_start();
if (!isset($_SESSION["userSession"])) {
    $isEnglish   = strpos($_SERVER["REQUEST_URI"], "/INGLES/") !== false;
    $redirectUrl = $isEnglish ? "loginING.php" : "login.php";

    header("Location: " . $redirectUrl);
    exit;
}

$sesion    = $_SESSION["userSession"] ?? null;
$isEnglish = strpos($_SERVER["REQUEST_URI"], "/INGLES/") !== false;
?><!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Healthy Recipes - Canrisk</title>
    <link rel="stylesheet" href="../../CSS/Style-Info.css" />
    <link rel="stylesheet" href="../../CSS/help.css" />
    <link rel="stylesheet" href="../../CSS/recetas.css" />
    <link
      rel="icon"
      type="image/png"
      href="../../MULTIMEDIA/Canrisk LOGO.svg"
    />
  </head>
  <body>
    <div class="navbar-brand">
      <button
        class="hamburger-sidebar-btn"
        id="sidebarBtn"
        aria-label="Open sidebar menu"
      >
        <span></span>
        <span></span>
        <span></span>
      </button>
      <h1>Canrisk</h1>
      <img src="../../MULTIMEDIA/Canrisk LOGO.svg" alt="Canrisk" class="C-L" />
    </div>

    <nav class="sidebar-menu" id="sidebarMenu">
      <div class="sidebar-decoracion">
        <span></span>
        <span></span>
        <span></span>
      </div>

      <ul class="sidebar-list">
        <li><a href="cancer-introING.php">Introduction to Cancer &rarr;</a></li>
        <li><a href="CancerING.php">Cancer Types &rarr;</a></li>
        <li><a href="psycho-helpING.php">Psychological Support &rarr;</a></li>
        <li><a href="helpING.php">Help Center &rarr;</a></li>
        <li><a href="recetasING.php">Healthy Recipes &rarr;</a></li>
        <li><a href="quizzING.php">Quiz &rarr;</a></li>
        <li><a href="faqING.php">Frequently Asked Questions &rarr;</a></li>
      </ul>
    </nav>

    <div class="overlay-menu" id="menuOverlay"></div>

    <nav class="navbar" id="mainNav">

      <ul class="Info-nav">
        <li class="box-II">
          <h4><a href="../INGLES/PrincipalING.php">Home</a></h4>
        </li>
        <li class="box-II">
          <a href="../INGLES/aboutusENG.php"><h4>About Us</h4></a>
        </li>
        <li class="box-II">
          <a href="../INGLES/ContactoING.php"><h4>Contact Us</h4></a>
        </li>
      </ul>

      <div class="right-group">
        <a
          id="langSwitch"
          class="lang-switch"
          href="<?php echo $isEnglish ? '../ESPANOL/Principal.php' : '../INGLES/PrincipalING.php'; ?>"
          aria-label="Cambiar idioma / Switch language"
          ><?php echo $isEnglish ? 'ES' : 'EN'; ?></a
        >

        <?php if ($sesion): ?>
          <div class="Photo user-session">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="48"
              height="48"
              fill="currentColor"
              class="bi bi-person-circle"
              viewBox="0 0 16 16"
            >
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
              <path
                fill-rule="evenodd"
                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"
              />
            </svg>
            <div class="user-info">
              <span class="session-label">
                <?php echo $isEnglish ? 'Signed in as' : 'Sesión iniciada como'; ?>
              </span>
              <a class="username-link" href="usuariosING.php">
                <strong><?php echo htmlspecialchars($sesion['username'], ENT_QUOTES); ?></strong>
              </a>
              <a class="logout-link" href="../../PHP/logout.php">
                <?php echo $isEnglish ? 'Log out' : 'Cerrar sesión'; ?>
              </a>
            </div>
          </div>
        <?php else: ?>
          <div class="Photo">
            <a
              href="loginING.php"
              aria-label="Iniciar sesión / Login"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="48"
                height="48"
                fill="currentColor"
                class="bi bi-person-circle"
                viewBox="0 0 16 16"
              >
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                <path
                  fill-rule="evenodd"
                  d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"
                />
              </svg>
            </a>
          </div>
        <?php endif; ?>
      </div>
    </nav>

    <div class="Titulos">
      <br />
      <h1>Healthy recipes for the fight against cancer</h1>
    </div>

    <p class="recetas-aviso">
      These recipes are general healthy-eating suggestions and DO NOT
      replace guidance from an oncology dietitian or your treating doctor.
      Always check with your medical team before changing your diet during
      treatment.
    </p>

    <div class="recetas-filtros" id="recetasFiltros"></div>

    <div class="recetas-grid" id="recetasGrid">
      <!-- Filled in by JS -->
    </div>

    <footer>
      <div class="footer-container">
        <div class="footer-content">
          <div class="footer-col">
            <h2 class="Title">COPYRIGHT</h2>
            <ul class="Advice">
              <li>&copy; Canrisk 2026</li>
              <li>&copy; All rights reserved to the Canrisk team</li>
              <li>Special thanks to the Canrisk team</li>
              <li>who made this page possible.</li>
            </ul>
          </div>
          <div class="footer-col">
            <h2 class="Title_1">IMPORTANT INFORMATION</h2>
            <ul class="Advice_1">
              <li>This page DOES NOT replace professional medical advice.</li>
              <li>In case of an emergency or symptom, you can</li>
              <li>rely on the various hospital numbers we provide,</li>
              <li>or call 911 directly.</li>
            </ul>
          </div>
        </div>
        <div class="footer-social">
          <h2 class="Title_2">Canrisk Social Media!</h2>
          <ul class="Social">
            <li>
              <a href="https://www.instagram.com/canrisk/" target="_blank"
                ><img
                  src="../../MULTIMEDIA/instagram.png"
                  class="Inst-IMG"
                  alt="Instagram logo"
                />
                <p class="Inst-txt">Instagram</p></a
              >
            </li>
            <li>
              <a
                href="https://www.facebook.com/Canrisk-110882646091155"
                target="_blank"
                ><img
                  src="../../MULTIMEDIA/facebook.png"
                  class="Face-IMG"
                  alt="Facebook logo"
                />
                <p class="Face-txt">Facebook</p></a
              >
            </li>
            <li>
              <a href="https://twitter.com/Canrisk1" target="_blank"
                ><img
                  src="../../MULTIMEDIA/gorjeo.png"
                  class="Twit-IMG"
                  alt="Twitter"
                />
                <p class="Twit-txt">Twitter</p></a
              >
            </li>
          </ul>
        </div>
      </div>
    </footer>

    <script>
      const sidebarBtn = document.getElementById("sidebarBtn");
      const sidebarMenu = document.getElementById("sidebarMenu");
      const menuOverlay = document.getElementById("menuOverlay");

      const toggleSidebar = () => {
        const isOpen = sidebarMenu.classList.toggle("open");
        sidebarBtn.classList.toggle("open", isOpen);
        menuOverlay.classList.toggle("show", isOpen);
      };

      sidebarBtn.addEventListener("click", toggleSidebar);
      menuOverlay.addEventListener("click", toggleSidebar);
    </script>

    <script src="../../JS/recetasdata.js"></script>
    <script>
      const grid = document.getElementById("recetasGrid");
      const filtrosContenedor = document.getElementById("recetasFiltros");
      const categorias = ["All", ...new Set(recetasSaludables.map((r) => r.categoria))];

      function pintarReceta(receta) {
        return `
          <div class="receta-card" onclick="window.location.href = 'recetas-detalleING.php?id=${receta.id}'">
            <div class="receta-foto">${receta.icono}</div>
            <div class="receta-info">
              <span class="receta-categoria">${receta.categoria}</span>
              <h3>${receta.nombre}</h3>
              <p class="receta-desc">${receta.descripcion}</p>
              <div class="receta-meta">
                <span>⏱ ${receta.tiempo}</span>
                <span>🍽 ${receta.porciones} serving(s)</span>
              </div>
            </div>
          </div>
        `;
      }

      function pintarGrid(categoria) {
        const listado =
          categoria === "All"
            ? recetasSaludables
            : recetasSaludables.filter((r) => r.categoria === categoria);
        grid.innerHTML = listado.map(pintarReceta).join("");
      }

      filtrosContenedor.innerHTML = categorias
        .map(
          (cat, i) =>
            `<button class="filtro-btn${i === 0 ? " active" : ""}" data-categoria="${cat}">${cat}</button>`
        )
        .join("");

      filtrosContenedor.querySelectorAll(".filtro-btn").forEach((boton) => {
        boton.addEventListener("click", () => {
          filtrosContenedor
            .querySelectorAll(".filtro-btn")
            .forEach((b) => b.classList.remove("active"));
          boton.classList.add("active");
          pintarGrid(boton.dataset.categoria);
        });
      });

      pintarGrid("All");
    </script>

    <script src="../../JS/site.js" defer></script>
  </body>
</html>
