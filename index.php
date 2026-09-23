<?php
session_start();
//Verificar si la sesion esta iniciada
if (isset($_SESSION["userSession"])) {
    $isEnglish   = strpos($_SERVER["REQUEST_URI"], "/INGLES/") !== false;
    $redirectUrl = $isEnglish ? "../HTML/INGLES/PrincipalING.php" : "../HTML/ESPANOL/Principal.php";
    
    header("Location: " . $redirectUrl);
    exit; 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canrisk - Información y apoyo sobre el cáncer</title>
    <link rel="stylesheet" href="CSS/Style-Info.css">
    <link rel="stylesheet" href="CSS/principal.css">
    <link rel="icon" type="image/png" href="MULTIMEDIA/Canrisk LOGO.svg">
</head>
<body>
    <!--  LOGO Y BOTÓN DEL MENÚ LATERAL  -->
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
      <img src="MULTIMEDIA/Canrisk LOGO.svg" alt="Canrisk" class="C-L" />
    </div>

    <!--  MENÚ LATERAL (SIDEBAR)  -->
    <nav class="sidebar-menu" id="sidebarMenu">
      <div class="sidebar-decoracion">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <ul class="sidebar-list">
        <li><a href="index.php">Inicio &rarr;</a></li>
        <li><a href="Recetas.N.php">Recetas saludables &rarr;</a></li>
      </ul>
    </nav>

    <!-- FONDO OSCURO AL ABRIR EL SIDEBAR  -->

    <div class="overlay-menu" id="menuOverlay"></div>

    <!-- BARRA DE NAVEGACIÓN SUPERIOR  -->
    <nav class="navbar" id="mainNav">

      <ul class="Info-nav">
        <li class="box-II">
          <a href="Faq.N.php"><h4>Preguntas frecuentes</h4></a>
        </li>
        <li class="box-II">
          <a href="index.php"><h4>Inicio</h4></a>
        </li>
      </ul>

        <div class="right-group">
            <ul class="Index">
                <li class="box-I"><a href="HTML/ESPANOL/login.php"><h4>Iniciar Sesión</h4></a></li>
                <li class="box-I"><a href="HTML/ESPANOL/register.php"><h4>Registrarse</h4></a></li>
            </ul>
            <a id="langSwitchNL" class="lang-switchNL" href="IndexING.php" aria-label="Cambiar idioma / Switch language">EN</a>

            <div class="Photo">
                <img src="MULTIMEDIA/profile.png" class="PP-default" alt="Foto de perfil del usuario">

        </div>
      </div>
    </nav>
    <!-- ENCABEZADO PRINCIPAL (HERO) --> 
    <header class="hero-section">
    <!-- CAROUSEL DE IMAGENES -->
    <div class="carousel">
        <div class="carousel-track" id="track">
        <div class="carousel-slide"><img src="MULTIMEDIA/1.jpg" alt="Canrisk - imagen 1"></div>
        <div class="carousel-slide"><img src="MULTIMEDIA/2.jpg" alt="Canrisk - imagen 2"></div>
        <div class="carousel-slide"><img src="MULTIMEDIA/3.jpg" alt="Canrisk - imagen 3"></div>
        </div>
        <div class="carousel-container">
            <button class="carousel-button prev" onclick="prevSlide()">❮</button>
            <button class="carousel-button next" onclick="nextSlide()">❯</button>

            <!-- NUEVO: Contenedor de indicadores de línea (abajo del carrusel) -->
            <div class="carousel-indicators-lines">
                <!-- Agrega un botón por cada imagen/slide que tengas en tu carrusel -->
                <button class="indicator-line active" onclick="currentSlide(0)"></button>
                <button class="indicator-line" onclick="currentSlide(1)"></button>
                <button class="indicator-line" onclick="currentSlide(2)"></button>
            </div>
        </div>
    </div>
    <br>
        <div class="hero-container">
            <div class="Titulos-DEG">
                <h1 class="hero-title">Canrisk, tu sitio informativo sobre el cáncer</h1>
            </div>
            <p class="hero-subtitle">
                Herramientas de prevención, apoyo emocional y acompañamiento para jóvenes y familias
                que enfrentan un proceso oncológico.
                <br>
                <strong>
                    <span class="Negrita">Esta plataforma NO reemplaza la ayuda médica de un profesional.</span>
                </strong>
            </p>
        </div>
             
</div>
<br>
</div>
    </div>
        <div class="action-container" style="padding-top: 0;">
                <a href="HTML/ESPANOL/register.php" class="btn-quizz">Regístrate hoy y sé parte del cambio</a>
    </div>
    </header>


    <!-- SECCIÓN "¿CUÁL ES NUESTRO OBJETIVO?" -->
    <section class="info-row-container">
        <br>
        <h2 class="info-row-title">¿Cuál es nuestro objetivo?</h2>
        <div class="info-grid">
            <div class="info-card">
                <h3>Concientización</h3>
                <p>Damos a conocer los distintos tipos de cáncer y cómo acompañar a un familiar que
                    atraviesa la enfermedad.</p>
            </div>
            <div class="info-card">
                <h3>Apoyo real</h3>
                <p>Ofrecemos orientación económica y psicológica a quienes no tienen muchos recursos
                    para costear sus tratamientos.</p>
            </div>
            <div class="info-card">
                <h3>Privacidad ante todo</h3>
                <p>Respetamos la privacidad de cada persona que busca ayuda en nuestro sitio, sin
                    excepción.</p>
            </div>
        </div>
    </section>

    <script>
        /* Sidebar (solo existe en páginas internas) */
        const sidebarBtn = document.getElementById('sidebarBtn');
        const sidebarMenu = document.getElementById('sidebarMenu');
        const menuOverlay = document.getElementById('menuOverlay');

        if (sidebarBtn && sidebarMenu && menuOverlay) {
            const toggleSidebar = () => {
                const isOpen = sidebarMenu.classList.toggle('open');
                sidebarBtn.classList.toggle('open', isOpen);
                menuOverlay.classList.toggle('show', isOpen);
                sidebarBtn.setAttribute('aria-expanded', isOpen);
            };
            sidebarBtn.addEventListener('click', toggleSidebar);
            menuOverlay.addEventListener('click', toggleSidebar);
        }

        /* ---- Carousel ---- */
        var LIGHT_CAROUSEL_IMAGES = ['MULTIMEDIA/1.jpg', 'MULTIMEDIA/2.jpg', 'MULTIMEDIA/3.jpg'];
        var DARK_CAROUSEL_IMAGES = ['MULTIMEDIA/9.jpg', 'MULTIMEDIA/10.jpg', 'MULTIMEDIA/11.jpg', 'MULTIMEDIA/12.jpg'];

        var currentSlideIndex = 0;
        var track = document.getElementById('track');
        var indicatorsWrap = document.querySelector('.carousel-indicators-lines');
        var carousel = document.querySelector('.carousel');
        var slides = document.querySelectorAll('.carousel-slide');
        var indicators = document.querySelectorAll('.indicator-line');

        function showSlide(index) {
            if (!track || slides.length === 0) return;
            // Wrap around
            if (index >= slides.length) index = 0;
            if (index < 0) index = slides.length - 1;
            currentSlideIndex = index;

            // Move the track
            track.style.transform = 'translateX(-' + (currentSlideIndex * 100) + '%)';

            // Update indicator lines
            indicators.forEach(function(ind) { ind.classList.remove('active'); });
            if (indicators[currentSlideIndex]) {
                indicators[currentSlideIndex].classList.add('active');
            }
        }

        function nextSlide() { showSlide(currentSlideIndex + 1); }
        function prevSlide() { showSlide(currentSlideIndex - 1); }
        function currentSlide(index) { showSlide(index); }

        // Reconstruye el carrusel con el set de imágenes del tema activo.
        function buildCarousel(images) {
            if (!track || !indicatorsWrap) return;
            track.innerHTML = '';
            indicatorsWrap.innerHTML = '';
            images.forEach(function (src, i) {
                var slide = document.createElement('div');
                slide.className = 'carousel-slide';
                var img = document.createElement('img');
                img.src = src;
                img.alt = 'Canrisk - imagen ' + (i + 1);
                slide.appendChild(img);
                track.appendChild(slide);

                var dot = document.createElement('button');
                dot.className = 'indicator-line' + (i === 0 ? ' active' : '');
                dot.setAttribute('onclick', 'currentSlide(' + i + ')');
                indicatorsWrap.appendChild(dot);
            });
            slides = document.querySelectorAll('.carousel-slide');
            indicators = document.querySelectorAll('.indicator-line');
            currentSlideIndex = 0;
            showSlide(0);
        }

        function applyCarouselTheme(theme) {
            buildCarousel(theme === 'dark' ? DARK_CAROUSEL_IMAGES : LIGHT_CAROUSEL_IMAGES);
        }

        // El HTML ya trae el set claro por defecto; solo se reconstruye si el
        // tema activo es oscuro, para no repintar el carrusel sin necesidad.
        if (document.documentElement.getAttribute('data-theme') === 'dark') {
            applyCarouselTheme('dark');
        }
        document.addEventListener('canrisk:theme-change', function (e) {
            applyCarouselTheme(e.detail && e.detail.theme);
        });

        // Auto-play: avanza cada 15 s, se pausa al pasar el cursor
        var autoPlay = setInterval(nextSlide, 15000);
        if (carousel) {
            carousel.addEventListener('mouseenter', function() { clearInterval(autoPlay); });
            carousel.addEventListener('mouseleave', function() {
                autoPlay = setInterval(nextSlide, 15000);
            });
        }
    </script>
    <script src="JS/site.js" defer></script>

    <!-- PIE DE PÁGINA -->
    <footer>
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-col">
                    <h2 class="Title">DERECHOS DE AUTOR</h2>
                    <ul class="Advice">
                        <li>&copy; Canrisk 2026</li>
                        <li>Todos los derechos reservados al equipo de Canrisk.</li>
                        <li>Agradecimientos especiales a todo el equipo que ha hecho esta página posible.</li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h2 class="Title_1">INFORMACIÓN IMPORTANTE</h2>
                    <ul class="Advice_1">
                        <li>Esta página NO reemplaza la ayuda de un profesional médico.</li>
                        <li>En caso de emergencia o síntoma, apóyate en los números de hospitales
                            que proporcionamos, o llama directamente al 911.</li>
                    </ul>
                </div>
            </div>
        <div class="footer-social">
            <h2 class="Title_2">Redes sociales de Canrisk!</h2>
            <ul class="Social">
                <li><a href="https://www.instagram.com/canrisk/" target="_blank"><img src="MULTIMEDIA/instagram.png" class="Inst-IMG" alt="Instagram logo"><p class="Inst-txt">Instagram</p></a></li>
                <li><a href="https://www.facebook.com/Canrisk-110882646091155" target="_blank"><img src="MULTIMEDIA/facebook.png" class="Face-IMG" alt="Facebook logo"><p class="Face-txt">Facebook</p></a></li>
                <li><a href="https://twitter.com/Canrisk1" target="_blank"><img src="MULTIMEDIA/gorjeo.png" class="Twit-IMG" alt="Twitter"><p class="Twit-txt">Twitter</p></a></li>
            </ul>
        </div>
        </div>
    </footer>
</body>
</html>
