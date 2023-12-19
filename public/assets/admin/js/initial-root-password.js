window.addEventListener("DOMContentLoaded", () => {
  (function () {
    ("use strict");
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var formSetupRootPassword = document.getElementById(
      "form-setup-root-password"
    );
    // Loop over them and prevent submission
    formSetupRootPassword.addEventListener(
      "submit",
      async function (event) {
        if (!formSetupRootPassword.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          event.preventDefault();
          const btnFormSetupRootPassword = document.getElementById(
            "btn-form-setup-root-password"
          );
          btnFormSetupRootPassword.disable = true;
          const inputPassword = document.getElementById("input-password");
          const response = await fetch("/api/admin/initial-root-password", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              password: inputPassword.value,
            }),
          });
          btnFormSetupRootPassword.disable = false;
          if (response.ok) {
            window.location.href = "/admin/login";
          } else {
            const resJson = await response.json();
            document.getElementById(
              "form-setup-root-password-alert-message"
            ).textContent = resJson["message"];
            document
              .getElementById("form-setup-root-password-alert")
              .classList.remove("d-none");
          }
        }
        formSetupRootPassword.classList.add("was-validated");
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
