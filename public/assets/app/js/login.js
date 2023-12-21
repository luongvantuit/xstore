window.addEventListener("DOMContentLoaded", () => {
  (async function () {
    ("use strict");
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var formLogin = document.getElementById("form-login");
    // Loop over them and prevent submission
    formLogin.addEventListener(
      "submit",
      async function (event) {
        if (!formLogin.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          event.preventDefault();
          const btnFormLogin = document.getElementById("btn-form-login");
          btnFormLogin.disable = true;
          const inputIdentify = document.getElementById("input-identify");
          const inputPassword = document.getElementById("input-password");
          const response = await fetch("/api/login", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              identify: inputIdentify.value,
              password: inputPassword.value,
            }),
          });
          if (response.ok) {
            const resJson = await response.json();
            const accessToken = resJson["data"]["jwt"];
            if (accessToken) {
              localStorage.setItem("accessToken", accessToken);
              document.cookie = `accessToken=${accessToken};`;
              window.location.replace("/");
            }
          } else {
            btnFormLogin.disable = false;
            const resJson = await response.json();
            document.getElementById("form-login-alert-message").textContent =
              resJson["message"];
            document
              .getElementById("form-login-alert")
              .classList.remove("d-none");
          }
        }
        formLogin.classList.add("was-validated");
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
