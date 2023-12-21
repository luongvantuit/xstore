window.addEventListener("DOMContentLoaded", () => {
  (function () {
    ("use strict");
    const accessToken = localStorage.getItem("adminAccessToken");
    if (!accessToken) {
      window.location.href = "/admin/login";
    }
  })();
});
