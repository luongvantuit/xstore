window.addEventListener("DOMContentLoaded", () => {
  (async function () {
    ("use strict");
    var fromEditProduct = document.getElementById("form-edit-product");
    // Loop over them and prevent submission
    fromEditProduct.addEventListener(
      "submit",
      async function (event) {
        if (!fromEditProduct.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          event.preventDefault();
          const btnFormEdit = document.getElementById("btn-form-edit-product");
          btnFormEdit.disable = true;
          const inputName = document.getElementById("input-name");
          const inputDescription = document.getElementById("input-description");
          const inputPhoto = document.getElementById("input-photo");
          const urlParams = new URLSearchParams(window.location.search);
          const formData = new FormData();
          if (inputDescription.value != "") {
            formData.append("description", inputDescription.value);
          }
          formData.append("name", inputName.value);
          formData.append("id", urlParams.get("id"));
          if (inputPhoto.files?.length > 0) {
            formData.append("file", inputPhoto.files[0]);
          }
          const response = await fetch("/api/admin/product/update", {
            method: "POST",
            body: formData,
          });
          if (response.ok) {
            window.location.reload();
          } else {
            btnFormEdit.disable = false;
            const resJson = await response.json();
            document.getElementById("toast-notify-failed-message").textContent =
              resJson["message"];
            document
              .getElementById("toast-notify-failed")
              .classList.remove("d-none");
          }
        }
        fromEditProduct.classList.add("was-validated");
      },
      false
    );
    var fromAddProperty = document.getElementById("form-add-property");
    // Loop over them and prevent submission
    fromAddProperty.addEventListener(
      "submit",
      async function (event) {
        if (!fromAddProperty.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          event.preventDefault();
          const url = new URL(window.location.href);
          const queryParams = new URLSearchParams(url.search);
          const btnFormAddProperty = document.getElementById(
            "btn-form-add-property"
          );
          btnFormAddProperty.disable = true;
          const inputColor = document.getElementById("input-color");
          const inputNumber = document.getElementById("input-number");
          const inputSizeId = document.getElementById("input-size-id");
          const inputPrice = document.getElementById("input-price");
          const inputPhoto = document.getElementById(
            "input-photo-add-property"
          );
          const formDate = new FormData();
          formDate.append("color", inputColor.value);
          formDate.append("product_id", Number(queryParams.get("id")));
          formDate.append("number", Number(inputNumber.value));
          formDate.append("size_id", Number(inputSizeId.value));
          formDate.append("price", Number(inputPrice.value));
          if (inputPhoto.files?.length > 0) {
            formDate.append("file", inputPhoto.files[0]);
          }
          const response = await fetch("/api/admin/properties", {
            method: "POST",
            body: formDate,
          });
          if (response.ok) {
            window.location.reload();
          } else {
            btnFormAddProperty.disable = false;
            const resJson = await response.json();
            document.getElementById(
              "form-add-property-alert-message"
            ).textContent = resJson["message"];
            document
              .getElementById("form-add-property-alert")
              .classList.remove("d-none");
          }
        }
        fromAddProperty.classList.add("was-validated");
      },
      false
    );
    $("#addPropertyModal").on("hidden.bs.modal", function () {
      $("#addPropertyModal input").val("");
      $("#addPropertyModal select").val("0");
      fromAddProperty.classList.remove("was-validated");
    });
  })();
});

async function deleteProperty(propertyId) {
  let model = bootstrap.Modal.getInstance(
    document.getElementById(`deletePropertyModal${propertyId}`)
  );
  model.hide();
  const response = await fetch("/api/admin/properties", {
    method: "DELETE",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      id: propertyId,
    }),
  });
  if (response.ok) {
    window.location.reload();
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
