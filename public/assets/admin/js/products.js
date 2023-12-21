window.addEventListener("DOMContentLoaded", () => {
  (async function () {
    ("use strict");
    var formAddNewAProduct = document.getElementById("form-add-new-a-product");
    // Loop over them and prevent submission
    formAddNewAProduct.addEventListener(
      "submit",
      async function (event) {
        if (!formAddNewAProduct.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          event.preventDefault();
          //   const btnFormAddNewAAdmin = document.getElementById(
          //     "btn-form-add-new-a-admin"
          //   );
          //   btnFormAddNewAAdmin.disable = true;
          //   const inputUsername = document.getElementById("input-username");
          //   const inputEmail = document.getElementById("input-email");
          //   const inputPassword = document.getElementById("input-password");
          //   let body = {
          //     username: inputUsername.value,
          //     password: inputPassword.value,
          //   };
          //   if (inputEmail.value != "") {
          //     body["email"] = inputEmail.value;
          //   }
          //   const response = await fetch("/api/admins", {
          //     method: "POST",
          //     headers: {
          //       "Content-Type": "application/json",
          //     },
          //     body: JSON.stringify(body),
          //   });
          //   if (response.ok) {
          //     window.location.reload();
          //   } else {
          //     btnFormAddNewAAdmin.disable = false;
          //     const resJson = await response.json();
          //     document.getElementById(
          //       "form-add-new-a-product-alert-message"
          //     ).textContent = resJson["message"];
          //     document
          //       .getElementById("form-add-new-a-product-alert")
          //       .classList.remove("d-none");
          //   }
        }
        formAddNewAProduct.classList.add("was-validated");
      },
      false
    );
  })();
});

async function deleteProduct(productId) {
  const response = await fetch("/api/admin/products", {
    method: "DELETE",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      id: productId,
    }),
  });
  if (response.ok) {
    window.location.reload();
  }
}
