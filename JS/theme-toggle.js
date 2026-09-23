/* ============================================================
   CANRISK — theme-toggle.js
   Botón de modo oscuro para páginas independientes sin navbar
   (login / registro). Usa la misma llave de localStorage que
   site.js ("canrisk-theme") para mantener el tema en sintonía
   con el resto del sitio.
   ============================================================ */

(function () {
  "use strict";

  var THEME_KEY = "canrisk-theme";
  var btn = document.getElementById("themeToggleBtn");
  if (!btn) return;

  var isEnglish = (document.documentElement.lang || "es").toLowerCase().indexOf("en") === 0;

  var SUN_ICON =
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" ' +
    'stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"></circle>' +
    '<path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2' +
    'M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"></path></svg>';
  var MOON_ICON =
    '<svg viewBox="0 0 24 24" fill="currentColor" stroke="none">' +
    '<path d="M20.5 14.5A8.5 8.5 0 1 1 9.5 3.5a7 7 0 0 0 11 11z"></path></svg>';

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
      document.documentElement.setAttribute("data-theme", next);
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
})();
