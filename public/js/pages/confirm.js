document.addEventListener("DOMContentLoaded", () => {
    if (document.body?.dataset?.page !== "confirm") {
        return;
    }

    const codeInput = document.getElementById("Code");

    codeInput?.addEventListener("input", () => {
        codeInput.value = codeInput.value.replace(/\D/g, "").slice(0, 6);
    });

    codeInput?.focus();
});
