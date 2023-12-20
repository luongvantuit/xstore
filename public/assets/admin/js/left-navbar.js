window.addEventListener("DOMContentLoaded", () => {
  (function () {
    ("use strict");
    const showNavbar = (toggleId, navId, bodyId, headerId) => {
      const toggle = document.getElementById(toggleId),
        nav = document.getElementById(navId),
        bodypd = document.getElementById(bodyId),
        headerpd = document.getElementById(headerId);
      // Validate that all variables exist
      if (toggle && nav && bodypd && headerpd) {
        toggle.addEventListener("click", () => {
          // show navbar
          nav.classList.toggle("xstore-show");
          // add padding to body
          bodypd.classList.toggle("xstore-body-pd");
          // add padding to header
          headerpd.classList.toggle("xstore-body-pd");
        });
      }
    };
    showNavbar("header-toggle", "nav-bar", "body-pd", "header");
    $("#btn-sign-out").on("click", () => {
      localStorage.clear();
      var cookies = document.cookie.split(";");
      // set past expiry to all cookies
      for (var i = 0; i < cookies.length; i++) {
        document.cookie =
          cookies[i] + "=; expires=" + new Date(0).toUTCString();
      }
      window.location.href = "/admin/login";
    });
  })();
});
