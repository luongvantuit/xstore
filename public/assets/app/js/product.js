function goToLogin() {
  window.location.href = "/login";
}

$(document).ready(function () {
  $("#goToCartModal").on("hidden.bs.modal", function () {
    window.location.reload();
  });
});

async function addToCart(propertyId, number = 1) {
  const accessToken = localStorage.getItem("accessToken");
  const response = await fetch("/api/cart-product", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Authorization: `Bearer ${accessToken}`,
    },
    body: JSON.stringify({
      property_id: propertyId,
      number: number,
    }),
  });

  if (response.ok) {
    $("#goToCartModal").modal("show");
  } else {
    const json = await response.json();
    document.getElementById("toast-notify-failed-message").textContent =
      json["message"];
    let toastDeleteAdminFailed = document.getElementById("toast-notify-failed");
    if (toastDeleteAdminFailed) {
      var toast = new bootstrap.Toast(toastDeleteAdminFailed);
      toast.show();
    }
  }
}
