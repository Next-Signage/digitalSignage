document.addEventListener("DOMContentLoaded", () => {
    if (document.body?.dataset?.page !== "signup") {
        return;
    }

    const form = document.getElementById("signupForm");
    const stepOne = document.getElementById("signup-step-one");
    const stepTwo = document.getElementById("signup-step-two");
    const nextButton = document.getElementById("signup-next-step");
    const emailInput = document.getElementById("signup-email");
    const passwordInput = document.getElementById("signup-password");
    const confirmInput = document.getElementById("signup-password-confirm");

    if (!form || !stepOne || !stepTwo || !nextButton || !emailInput || !passwordInput || !confirmInput) {
        return;
    }

    function setStepVisibility(showSecondStep) {
        stepOne.style.display = showSecondStep ? "none" : "block";
        stepTwo.style.display = showSecondStep ? "block" : "none";

        if (showSecondStep) {
            document.getElementById("signup-name")?.focus();
        } else {
            emailInput.focus();
        }
    }

    function resetPasswordStyles() {
        passwordInput.style.color = "black";
        confirmInput.style.color = "black";
        passwordInput.parentElement.querySelector("label").style.color = "black";
        confirmInput.parentElement.querySelector("label").style.color = "black";
    }

    function validateFirstStep() {
        const fieldsAreFilled = emailInput.reportValidity() &&
            passwordInput.reportValidity() &&
            confirmInput.reportValidity();

        if (!fieldsAreFilled) {
            return false;
        }

        if (passwordInput.value === confirmInput.value) {
            return true;
        }

        alert("As senhas não coincidem!");
        passwordInput.style.color = "red";
        confirmInput.style.color = "red";
        passwordInput.parentElement.querySelector("label").style.color = "red";
        confirmInput.parentElement.querySelector("label").style.color = "red";
        confirmInput.focus();
        return false;
    }

    nextButton.addEventListener("click", () => {
        if (!validateFirstStep()) {
            return;
        }

        setStepVisibility(true);
    });

    passwordInput.addEventListener("input", resetPasswordStyles);
    confirmInput.addEventListener("input", resetPasswordStyles);

    window.handleSignupAfterSubmit = function handleSignupAfterSubmit() {
        window.location.href = "../dashboard/dashboard.php";
    };

    setStepVisibility(false);
});
