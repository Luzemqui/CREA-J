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
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Recetas Saludables - Canrisk</title>
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
    <!-- LOGO Y BOTÓN DEL MENÚ LATERAL -->
    <div class="navbar-brand">
      <button
        class="hamburger-sidebar-btn"
        id="sidebarBtn"
        aria-label="Abrir menú lateral"
      >
        <span></span>
        <span></span>
        <span></span>
      </button>
      <h1>Canrisk</h1>
      <img src="../../MULTIMEDIA/Canrisk LOGO.svg" alt="Canrisk" class="C-L" />
    </div>

    <!-- MENÚ LATERAL (SIDEBAR) -->
    <nav class="sidebar-menu" id="sidebarMenu">
      <div class="sidebar-decoracion">
        <span></span>
        <span></span>
        <span></span>
      </div>

      <ul class="sidebar-list">
        <li><a href="cancer-intro.php">Introducción al cáncer &rarr;</a></li>
        <li><a href="cancer.php">Tipos de Cáncer &rarr;</a></li>
        <li><a href="psycho-help.php">Apoyo psicológico &rarr;</a></li>
        <li><a href="help.php">Centro de ayuda &rarr;</a></li>
        <li><a href="recetas.php">Recetas saludables &rarr;</a></li>
        <li><a href="quizz.php">Cuestionario &rarr;</a></li>
        <li><a href="faq.php">Preguntas frecuentes &rarr;</a></li>
      </ul>
    </nav>

    <!-- FONDO OSCURO AL ABRIR EL SIDEBAR -->
    <div class="overlay-menu" id="menuOverlay"></div>

    <!-- BARRA DE NAVEGACIÓN SUPERIOR -->
    <nav class="navbar" id="mainNav">

      <ul class="Info-nav">
        <li class="box-II">
          <h4><a href="../ESPANOL/Principal.php">Inicio</a></h4>
        </li>
        <li class="box-II">
          <a href="../ESPANOL/aboutus.php"><h4>Sobre nosotros</h4></a>
        </li>
        <li class="box-II">
          <a href="../ESPANOL/Contacto.php"><h4>Contáctanos</h4></a>
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
              <a class="username-link" href="usuarios.php">
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
              href="login.php"
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

    <!-- ENCABEZADO DE LA PÁGINA -->
    <div class="Titulos">
      <br />
      <h1>Recetas saludables para el camino contra el cáncer</h1>
    </div>

    <p class="recetas-aviso">
      Estas recetas son sugerencias generales de alimentación saludable y NO
      sustituyen la orientación de un nutricionista oncológico o médico
      tratante. Consulta siempre a tu equipo médico antes de modificar tu
      dieta durante el tratamiento.
    </p>

    <!-- FILTROS POR CATEGORÍA -->
    <div class="recetas-filtros" id="recetasFiltros"></div>

    <!-- GRID DE RECETAS -->
    <div class="recetas-grid" id="recetasGrid">
      <!-- Se llena con JS -->
    </div>

    <!-- PIE DE PÁGINA -->
    <footer>
      <div class="footer-container">
        <div class="footer-content">
          <div class="footer-col">
            <h2 class="Title">DERECHOS DE AUTOR</h2>
            <ul class="Advice">
              <li>&copy; Canrisk 2026</li>
              <li>&copy; Todos los derechos reservados al equipo de Canrisk</li>
              <li>Agradecimientos especiales al equipo de Canrisk</li>
              <li>que han hecho esta pagina algo posible.</li>
            </ul>
          </div>
          <div class="footer-col">
            <h2 class="Title_1">INFORMACIÓN IMPORTANTE</h2>
            <ul class="Advice_1">
              <li>
                Esta pagina NO reemplaza la ayuda de un profesional medico.
              </li>
              <li>
                En caso de tener algun tipo de emergencia o un sintoma puede
              </li>
              <li>
                apoyarse en los diferentes números de hospitales que nosotros
              </li>
              <li>proporcionamos, o llame directamente al 911.</li>
            </ul>
          </div>
        </div>
        <div class="footer-social">
          <h2 class="Title_2">Redes sociales de Canrisk!</h2>
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
      const categorias = ["Todas", ...new Set(recetasSaludables.map((r) => r.categoria))];

      function pintarReceta(receta) {
        return `
          <div class="receta-card" onclick="window.location.href = 'recetas-detalle.php?id=${receta.id}'">
            <div class="receta-foto">${receta.icono}</div>
            <div class="receta-info">
              <span class="receta-categoria">${receta.categoria}</span>
              <h3>${receta.nombre}</h3>
              <p class="receta-desc">${receta.descripcion}</p>
              <div class="receta-meta">
                <span>⏱ ${receta.tiempo}</span>
                <span>🍽 ${receta.porciones} porción(es)</span>
              </div>
            </div>
          </div>
        `;
      }

      function pintarGrid(categoria) {
        const listado =
          categoria === "Todas"
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

      pintarGrid("Todas");
    </script>

    <script src="../../JS/site.js" defer></script>
  </body>
</html>
