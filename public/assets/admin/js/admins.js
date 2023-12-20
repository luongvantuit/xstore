window.addEventListener("DOMContentLoaded", () => {
  (async function () {
    ("use strict");
    var formAddNewAAdmin = document.getElementById("form-add-new-a-admin");
    // Loop over them and prevent submission
    formAddNewAAdmin.addEventListener(
      "submit",
      async function (event) {
        if (!formAddNewAAdmin.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          event.preventDefault();
          const btnFormAddNewAAdmin = document.getElementById(
            "btn-form-add-new-a-admin"
          );
          btnFormAddNewAAdmin.disable = true;
          const inputUsername = document.getElementById("input-username");
          const inputEmail = document.getElementById("input-email");
          const inputPassword = document.getElementById("input-password");
          let body = {
            username: inputUsername.value,
            password: inputPassword.value,
          };
          if (inputEmail.value != "") {
            body["email"] = inputEmail.value;
          }
          const response = await fetch("/api/admins", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(body),
          });
          if (response.ok) {
            window.location.reload();
          } else {
            btnFormAddNewAAdmin.disable = false;
            const resJson = await response.json();
            document.getElementById(
              "form-add-new-a-admin-alert-message"
            ).textContent = resJson["message"];
            document
              .getElementById("form-add-new-a-admin-alert")
              .classList.remove("d-none");
          }
        }
        formAddNewAAdmin.classList.add("was-validated");
      },
      false
    );
    const inputPassword = document.getElementById("input-password");
    inputPassword.addEventListener("invalid", function (event) {
      event.preventDefault();
      const inputPasswordInvalidFeedbackMessage = document.getElementById(
        "input-password-invalid-feedback-message"
      );
      if (inputPassword.validity.valueMissing) {
        inputPasswordInvalidFeedbackMessage.textContent =
          "Please enter your password!";
      } else if (inputPassword.validity.tooShort) {
        inputPasswordInvalidFeedbackMessage.textContent =
          "Require password length greater than 6!";
      }
    });
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

async function deleteAdmin(adminId) {
  const response = await fetch("/api/admins", {
    method: "DELETE",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      id: adminId,
    }),
  });
  if (response.ok) {
    window.location.reload();
  }
}
