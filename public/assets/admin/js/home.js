window.addEventListener("DOMContentLoaded", () => {
  (async function () {
    ("use strict");
    const accessToken = await localStorage.getItem("access-token");
    if (accessToken) {
      //
    } else {
      window.location.href = "/admin/login";
    }
  })();
});
