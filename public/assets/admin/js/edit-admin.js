window.addEventListener("DOMContentLoaded", () => {
  (async function () {
    ("use strict");
    var fromEditAdmin = document.getElementById("form-edit-admin");
    // Loop over them and prevent submission
    fromEditAdmin.addEventListener(
      "submit",
      async function (event) {
        if (!fromEditAdmin.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          event.preventDefault();
          const btnEditAdmin = document.getElementById("btn-edit-admin");
          btnEditAdmin.disable = true;
          const inputUsername = document.getElementById("input-username");
          const inputEmail = document.getElementById("input-email");
          const urlParams = new URLSearchParams(window.location.search);
          let body = {
            username: inputUsername.value,
            id: Number(urlParams.get("id")),
          };
          if (inputEmail.value != "") {
            body["email"] = inputEmail.value;
          }
          const response = await fetch("/api/admins", {
            method: "PUT",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(body),
          });
          if (response.ok) {
            window.location.href = "/admin/admins";
          } else {
            btnEditAdmin.disable = false;
            const resJson = await response.json();
            document.getElementById(
              "form-edit-admin-alert-message"
            ).textContent = resJson["message"];
            document
              .getElementById("form-edit-admin-alert")
              .classList.remove("d-none");
          }
        }
        fromEditAdmin.classList.add("was-validated");
      },
      false
    );
    const inputUsername = document.getElementById("input-username");
    inputUsername.addEventListener("invalid", function (event) {
      event.preventDefault();
      const inputUsernameInvalidFeedbackMessage = document.getElementById(
        "input-username-invalid-feedback-message"
      );
      if (inputUsername.validity.valueMissing) {
        inputUsernameInvalidFeedbackMessage.textContent =
          "Please username of admin!";
      } else if (inputUsername.validity.tooShort) {
        inputUsernameInvalidFeedbackMessage.textContent =
          "Require username length greater than 6!";
      }
    });
  })();
});
