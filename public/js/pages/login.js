document.addEventListener("DOMContentLoaded", () => {
    if (document.body?.dataset?.page !== "login") {
        return;
    }

    document.getElementById("login-email")?.focus();
});
