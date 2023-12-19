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
    $("#btn-signout").on("click", () => {
      localStorage.clear();
      window.location.href = "/admin/login";
    });
  })();
});
