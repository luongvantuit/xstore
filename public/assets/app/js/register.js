window.addEventListener("DOMContentLoaded", () => {
  (async function () {
    ("use strict");
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var formRegister = document.getElementById("form-register");
    // Loop over them and prevent submission
    formRegister.addEventListener(
      "submit",
      async function (event) {
        if (!formRegister.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          event.preventDefault();
          const btnFormRegister = document.getElementById("btn-form-register");
          btnFormRegister.disable = true;
          const inputEmail = document.getElementById("input-email");
          const inputUsername = document.getElementById("input-username");
          const inputPassword = document.getElementById("input-password");
          const response = await fetch("/api/register", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              username: inputUsername.value,
              email: inputEmail.value,
              password: inputPassword.value,
            }),
          });
          if (response.ok) {
            $("#goToLoginModal").modal("show");
          } else {
            btnFormRegister.disable = false;
            const resJson = await response.json();
            document.getElementById("form-register-alert-message").textContent =
              resJson["message"];
            document
              .getElementById("form-register-alert")
              .classList.remove("d-none");
          }
        }
        formRegister.classList.add("was-validated");
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
  })();
});
