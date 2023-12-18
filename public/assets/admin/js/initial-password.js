window.addEventListener("DOMContentLoaded", () => {
  (function () {
    "use strict";
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var formSetupRootPassword = document.getElementById(
      "form-setup-root-password"
    );
    // Loop over them and prevent submission
    formSetupRootPassword.addEventListener(
      "submit",
      function (event) {
        if (!formSetupRootPassword.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
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
    // Close alert
    $("#bth-close-alert").click(() => {
      $("#form-setup-root-password-alert").alert("close");
    });
  })();
});
