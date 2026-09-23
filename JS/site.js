/* ============================================================
   CANRISK — site.js
   Funciones compartidas por todas las páginas informativas:
   - Resalta la página actual en la navbar y en el sidebar.
   - Muestra un texto junto a la foto de perfil cuando el
     usuario ya inició sesión (lee "userSession" de localStorage).
   - Configura el botón de cambio de idioma (ES <-> EN).
   ============================================================ */

(function () {
  "use strict";

  var THEME_KEY = "canrisk-theme";

  /* ---------- 0. Modo oscuro ---------- */
  function getPreferredTheme() {
    try {
      var saved = localStorage.getItem(THEME_KEY);
      if (saved === "dark" || saved === "light") return saved;
    } catch (e) {
      /* noop */
    }
    return window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches
      ? "dark"
      : "light";
  }

  function applyTheme(theme) {
    document.documentElement.setAttribute("data-theme", theme);
    document.dispatchEvent(
      new CustomEvent("canrisk:theme-change", { detail: { theme: theme } })
    );
  }

  // Se aplica de inmediato (antes de DOMContentLoaded) para reducir el
  // parpadeo de tema claro al cargar la página.
  applyTheme(getPreferredTheme());

  var SUN_ICON =
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" ' +
    'stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"></circle>' +
    '<path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2' +
    'M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"></path></svg>';
  var MOON_ICON =
    '<svg viewBox="0 0 24 24" fill="currentColor" stroke="none">' +
    '<path d="M20.5 14.5A8.5 8.5 0 1 1 9.5 3.5a7 7 0 0 0 11 11z"></path></svg>';

  function setupThemeToggle() {
    var navRight = document.querySelector(".right-group");
    if (!navRight || document.getElementById("themeToggleBtn")) return;

    var btn = document.createElement("button");
    btn.type = "button";
    btn.id = "themeToggleBtn";
    btn.className = "theme-toggle-btn";
    btn.innerHTML = '<span class="theme-toggle-icon" aria-hidden="true">' + SUN_ICON + "</span>";

    var isEnglish = currentIsEnglish();

    function updateBtn(theme) {
      var isDark = theme === "dark";
      btn.classList.toggle("is-dark", isDark);
      btn.setAttribute("aria-pressed", String(isDark));
      var label = isDark
        ? (isEnglish ? "Switch to light mode" : "Cambiar a modo claro")
        : (isEnglish ? "Switch to dark mode" : "Cambiar a modo oscuro");
      btn.setAttribute("aria-label", label);
      btn.title = label;
      btn.querySelector(".theme-toggle-icon").innerHTML = isDark ? MOON_ICON : SUN_ICON;
    }

    updateBtn(document.documentElement.getAttribute("data-theme") || "light");

    btn.addEventListener("click", function (event) {
      var next = document.documentElement.getAttribute("data-theme") === "dark" ? "light" : "dark";

      var rect = btn.getBoundingClientRect();
      var x = event.clientX || rect.left + rect.width / 2;
      var y = event.clientY || rect.top + rect.height / 2;
      document.documentElement.style.setProperty("--theme-x", x + "px");
      document.documentElement.style.setProperty("--theme-y", y + "px");

      function commit() {
        applyTheme(next);
        try {
          localStorage.setItem(THEME_KEY, next);
        } catch (e) {
          /* noop */
        }
        updateBtn(next);
      }

      if (document.startViewTransition) {
        document.startViewTransition(commit);
      } else {
        commit();
      }
    });

    var langBtn = navRight.querySelector(".lang-switch, .lang-switchNL");
    if (langBtn) {
      navRight.insertBefore(btn, langBtn);
    } else {
      navRight.insertBefore(btn, navRight.firstChild);
    }
  }

  // Mapa ES <-> EN. Las rutas son relativas a la raíz del proyecto.
  var LANG_MAP = {
    // Páginas en español -> inglés
    "principal.php": "HTML/INGLES/PrincipalING.php",
    "aboutus.php": "HTML/INGLES/aboutusENG.php",
    "contacto.php": "HTML/INGLES/ContactoING.php",
    "contacto-detalle.php": "HTML/INGLES/Contacto-detalleING.php",
    "cancer-intro.php": "HTML/INGLES/cancer-introING.php",
    "cancer.php": "HTML/INGLES/CancerING.php",
    "psycho-help.php": "HTML/INGLES/psycho-helpING.php",
    "help.php": "HTML/INGLES/helpING.php",
    "help-detalle.php": "HTML/INGLES/help-detalleING.php",
    "ficha1.php": "HTML/INGLES/helpING.php",
    "recetas.php": "HTML/INGLES/recetasING.php",
    "recetas-detalle.php": "HTML/INGLES/recetas-detalleING.php",
    "quizz.php": "HTML/INGLES/quizzING.php",
    "faq.php": "HTML/INGLES/faqING.php",
    "index.php": "IndexING.php",
    "faq.n.php": "Faq.N-ING.php",
    "recetas.n.php": "HTML/INGLES/recetasING.php",

    // Páginas en inglés -> español
    "principaling.php": "HTML/ESPANOL/Principal.php",
    "aboutuseng.php": "HTML/ESPANOL/aboutus.php",
    "contactoing.php": "HTML/ESPANOL/Contacto.php",
    "contacto-detalleing.php": "HTML/ESPANOL/Contacto-Detalle.php",
    "cancer-introing.php": "HTML/ESPANOL/cancer-intro.php",
    "cancering.php": "HTML/ESPANOL/cancer.php",
    "psycho-helping.php": "HTML/ESPANOL/psycho-help.php",
    "helping.php": "HTML/ESPANOL/help.php",
    "help-detalleing.php": "HTML/ESPANOL/help-detalle.php",
    "recetasing.php": "HTML/ESPANOL/recetas.php",
    "recetas-detalleing.php": "HTML/ESPANOL/recetas-detalle.php",
    "quizzing.php": "HTML/ESPANOL/quizz.php",
    "faqing.php": "HTML/ESPANOL/faq.php",
    "indexing.php": "index.php",
    "faq.n-ing.php": "Faq.N.php",
  };

  function currentBasename() {
    var path = window.location.pathname;
    var last = path.substring(path.lastIndexOf("/") + 1);
    try {
      last = decodeURIComponent(last);
    } catch (e) {
      /* noop */
    }
    return last.toLowerCase() || "index.php";
  }

  function rootPrefix() {
    var path = window.location.pathname;
    if (/\/HTML\/(ESPANOL|INGLES)\//i.test(path)) return "../../";
    return "";
  }

  function currentIsEnglish() {
    return (
      (document.documentElement.lang || "es").toLowerCase().indexOf("en") === 0
    );
  }

  /* ---------- 1. Resaltar la página actual (navbar + sidebar) ---------- */
  function highlightActivePage() {
    var current = currentBasename();

    document
      .querySelectorAll(".Info-nav a, .sidebar-list a")
      .forEach(function (a) {
        var href = a.getAttribute("href");
        if (!href) return;
        var base = href.substring(href.lastIndexOf("/") + 1).toLowerCase();
        if (base === current) {
          a.classList.add("active");
          var boxII = a.closest(".box-II");
          if (boxII) boxII.classList.add("active");
        }
      });
  }

  /* ---------- 2. Texto de sesión junto a la foto de perfil ---------- */
  function setupSessionIndicator() {
    var photo = document.querySelector(".Photo");
    if (!photo) return;

    var session = null;
    try {
      session = JSON.parse(localStorage.getItem("userSession"));
    } catch (e) {
      /* noop */
    }
    if (!session || !session.username) return;

    var isEnglish = currentIsEnglish();

    var wrapper = document.createElement("button");
    wrapper.type = "button";
    wrapper.className = "session-text show";
    wrapper.title = isEnglish
      ? "Click to log out"
      : "Haz clic para cerrar sesión";

    var greeting = document.createElement("span");
    greeting.className = "session-greeting";
    greeting.textContent = isEnglish ? "Signed in as" : "Sesión iniciada como";

    var user = document.createElement("span");
    user.className = "session-user";
    user.textContent = session.username;

    var logout = document.createElement("span");
    logout.className = "session-logout";
    logout.textContent = isEnglish ? "Log out" : "Cerrar sesión";

    wrapper.appendChild(greeting);
    wrapper.appendChild(user);
    wrapper.appendChild(logout);

    wrapper.addEventListener("click", function () {
      localStorage.removeItem("userSession");
      window.location.reload();
    });

    photo.appendChild(wrapper);
  }

  /* ---------- 3. Menú en móvil ----------
     En pantallas angostas, .Info-nav (Inicio, Faq, etc.) se queda
     visible en su propia barra bajo el logo, igual que en escritorio.
     Lo que se traslada dentro del panel lateral (#sidebarMenu) es solo
     .right-group (idioma y login/perfil), para no repetir un tercer
     bloque de navegación y que el hamburger abra un único panel con
     el resto de accesos. Al volver a un ancho de escritorio, el
     contenido regresa a su lugar original en la navbar. */
  function setupUnifiedMobileMenu() {
    var navbar = document.getElementById("mainNav");
    var sidebarMenu = document.getElementById("sidebarMenu");
    var sidebarBtn = document.getElementById("sidebarBtn");
    var menuOverlay = document.getElementById("menuOverlay");
    if (!navbar || !sidebarMenu) return;

    var rightGroup = navbar.querySelector(".right-group");
    if (!rightGroup) return;

    var sidebarList = sidebarMenu.querySelector(".sidebar-list");

    var rightGroupAnchor = document.createComment("right-group-anchor");
    rightGroup.parentNode.insertBefore(rightGroupAnchor, rightGroup);

    var divider = document.createElement("hr");
    divider.className = "sidebar-menu-divider";
    divider.setAttribute("aria-hidden", "true");

    var mq = window.matchMedia("(max-width: 900px)");
    var merged = false;

    function closeMenu() {
      if (sidebarMenu) sidebarMenu.classList.remove("open");
      if (sidebarBtn) sidebarBtn.classList.remove("open");
      if (menuOverlay) menuOverlay.classList.remove("show");
    }

    function mergeIntoSidebar() {
      if (merged) return;
      merged = true;
      // Idioma y login/perfil van hasta arriba del panel, antes de las secciones.
      sidebarMenu.insertBefore(rightGroup, sidebarList || sidebarMenu.firstChild);
      sidebarMenu.insertBefore(divider, sidebarList || null);
    }

    function restoreToNavbar() {
      if (!merged) return;
      merged = false;
      closeMenu();
      rightGroupAnchor.parentNode.insertBefore(rightGroup, rightGroupAnchor.nextSibling);
      if (divider.parentNode) divider.parentNode.removeChild(divider);
    }

    function applyLayout(e) {
      if (e.matches) {
        mergeIntoSidebar();
      } else {
        restoreToNavbar();
      }
    }

    applyLayout(mq);
    if (mq.addEventListener) {
      mq.addEventListener("change", applyLayout);
    } else if (mq.addListener) {
      // Safari antiguo
      mq.addListener(applyLayout);
    }

    // Cerrar el menú al elegir cualquier enlace dentro del panel.
    sidebarMenu.addEventListener("click", function (event) {
      if (!mq.matches) return;
      if (event.target.closest("a")) closeMenu();
    });
  }

  /* ---------- 4. Arrastrar con el mouse la barra de enlaces (.Info-nav) ----------
     En móvil esta barra ya se desliza con el dedo (overflow-x: auto),
     pero con mouse no hay forma nativa de arrastrarla. Esto agrega ese
     gesto de "click y arrastrar" típico de escritorio, sin afectar el
     scroll táctil ni romper el clic normal sobre cada enlace. */
  function setupDraggableNav() {
    var nav = document.querySelector(".Info-nav");
    if (!nav) return;

    var isDown = false;
    var dragging = false;
    var startX = 0;
    var scrollStart = 0;

    function endDrag() {
      isDown = false;
      if (dragging) {
        dragging = false;
        nav.classList.remove("dragging");
      }
    }

    nav.addEventListener("mousedown", function (e) {
      isDown = true;
      startX = e.pageX;
      scrollStart = nav.scrollLeft;
    });

    window.addEventListener("mouseup", endDrag);
    nav.addEventListener("mouseleave", endDrag);

    nav.addEventListener("mousemove", function (e) {
      if (!isDown) return;
      var dx = e.pageX - startX;
      if (!dragging && Math.abs(dx) > 4) {
        dragging = true;
        nav.classList.add("dragging");
      }
      if (dragging) {
        e.preventDefault();
        nav.scrollLeft = scrollStart - dx;
      }
    });
  }

  /* ---------- 5. Botón de cambio de idioma ---------- */
  function setupLangSwitch() {
    var btn =
      document.getElementById("langSwitch") ||
      document.getElementById("langSwitchNL");
    if (!btn) return;

    var current = currentBasename();
    var target = LANG_MAP[current];

    if (!target) {
      var isEnglish = currentIsEnglish();
      target = isEnglish
        ? "HTML/ESPANOL/Principal.php"
        : "HTML/INGLES/PrincipalING.php";
    }

    btn.setAttribute("href", rootPrefix() + target);
    btn.textContent = currentIsEnglish() ? "ES" : "EN";
  }

  document.addEventListener("DOMContentLoaded", function () {
    highlightActivePage();
    setupSessionIndicator();
    setupUnifiedMobileMenu();
    setupDraggableNav();
    setupLangSwitch();
    setupThemeToggle();
  });
})();
