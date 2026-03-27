document.addEventListener("DOMContentLoaded", () => {
    if (document.body?.dataset?.page !== "passwordrecover") {
        return;
    }

    document.querySelector("input[name='email']")?.focus();
});
