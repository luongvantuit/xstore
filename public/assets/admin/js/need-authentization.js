window.addEventListener("DOMContentLoaded", () => {
  (function () {
    ("use strict");
    const accessToken = localStorage.getItem("access-token");
    if (!accessToken) {
      window.location.href = "/admin/login";
    }
  })();
});
