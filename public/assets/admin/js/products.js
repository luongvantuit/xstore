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
          const btnFormAddNewAProduct = document.getElementById(
            "btn-form-add-new-a-product"
          );
          btnFormAddNewAProduct.disable = true;
          const inputName = document.getElementById("input-name");
          const inputDescription = document.getElementById("input-description");
          const inputPhoto = document.getElementById("input-photo");
          const formData = new FormData();
          if (inputDescription.value != "") {
            formData.append("description", inputDescription.value);
          }
          formData.append("name", inputName.value);
          formData.append("file", inputPhoto.files[0]);
          const response = await fetch("/api/admin/products", {
            method: "POST",
            body: formData,
          });
          if (response.ok) {
            window.location.reload();
          } else {
            btnFormAddNewAProduct.disable = false;
            const resJson = await response.json();
            document.getElementById(
              "form-add-new-a-product-alert-message"
            ).textContent = resJson["message"];
            document
              .getElementById("form-add-new-a-product-alert")
              .classList.remove("d-none");
          }
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
