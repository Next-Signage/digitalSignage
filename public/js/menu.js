document.addEventListener("DOMContentLoaded", async() => {
    const logoSrc = document.body?.dataset?.logoSrc || "";

    document.querySelector("head").insertAdjacentHTML("afterbegin", `
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    `);

    if (logoSrc) {
        document.querySelectorAll(".systemlogo").forEach((element) => {
            element.src = logoSrc;
        });
    }
});
