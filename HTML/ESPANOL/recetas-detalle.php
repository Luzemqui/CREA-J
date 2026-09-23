<?php
session_start();
// Esta página es accesible sin sesión: las recetas marcadas como públicas
// se pueden ver libremente; el resto requiere sesión iniciada (ver JS más abajo).
$sesion    = $_SESSION["userSession"] ?? null;
$isEnglish = strpos($_SERVER["REQUEST_URI"], "/INGLES/") !== false;
?><!doctype html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detalle de Receta - Canrisk</title>
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

    <div class="detalle-wrapper">
      <a
        href="<?php echo $sesion ? 'recetas.php' : '../../Recetas.N.php'; ?>"
        class="detalle-volver"
        >&larr; Volver al menú de recetas</a
      >
      <div class="receta-detalle-card" id="recetaDetalleCard">
        <!-- Se llena con JS -->
      </div>
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
      const sesionIniciada = <?php echo $sesion ? "true" : "false"; ?>;
      const params = new URLSearchParams(window.location.search);
      const id = parseInt(params.get("id"));
      const receta = recetasSaludables.find((r) => r.id === id);
      const contenedor = document.getElementById("recetaDetalleCard");

      if (receta && !receta.publico && !sesionIniciada) {
        document.title = "Receta con sesión requerida - Canrisk";
        contenedor.innerHTML = `
          <div class="receta-bloqueada">
            <div class="icono">🔒</div>
            <h1>${receta.nombre}</h1>
            <p>
              Esta receta completa está disponible solo para usuarios con
              sesión iniciada. Inicia sesión o regístrate gratis para ver
              todos los ingredientes y la preparación paso a paso.
            </p>
            <div class="acciones">
              <a class="btn-login-recetas" href="login.php">Iniciar Sesión</a>
              <a class="btn-login-recetas btn-secundario" href="register.php">Registrarse</a>
            </div>
          </div>
        `;
      } else if (receta) {
        document.title = receta.nombre + " - Canrisk";
        contenedor.innerHTML = `
          <div class="receta-detalle-header">
            <div class="receta-detalle-icono">${receta.icono}</div>
            <div class="receta-detalle-titulo">
              <span class="receta-detalle-categoria">${receta.categoria}</span>
              <h1>${receta.nombre}</h1>
            </div>
          </div>

          <div class="receta-detalle-meta">
            <div>
              <span class="label">Tiempo</span>
              <span class="valor">⏱ ${receta.tiempo}</span>
            </div>
            <div>
              <span class="label">Porciones</span>
              <span class="valor">🍽 ${receta.porciones}</span>
            </div>
            <div>
              <span class="label">Dificultad</span>
              <span class="valor">👩‍🍳 ${receta.dificultad}</span>
            </div>
          </div>

          <p class="receta-beneficio">
            <strong>Beneficio nutricional:</strong> ${receta.beneficio}
          </p>

          <div class="receta-detalle-cuerpo">
            <div class="receta-ingredientes">
              <h2>Ingredientes</h2>
              <ul class="lista-ingredientes">
                ${receta.ingredientes.map((ing) => `<li>${ing}</li>`).join("")}
              </ul>
            </div>
            <div class="receta-pasos">
              <h2>Preparación paso a paso</h2>
              <ol class="lista-pasos">
                ${receta.pasos.map((paso) => `<li>${paso}</li>`).join("")}
              </ol>
            </div>
          </div>
        `;
      } else {
        contenedor.innerHTML = `<p style="padding: 40px;">No se encontró la receta solicitada.</p>`;
      }
    </script>

    <script src="../../JS/site.js" defer></script>
  </body>
</html>
