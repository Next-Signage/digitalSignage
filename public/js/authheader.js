document.addEventListener("DOMContentLoaded", () => {
    const logoSrc = document.body?.dataset?.logoSrc || "";

    document.querySelector("head").insertAdjacentHTML("afterbegin", `
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    `);
    document.querySelector("body").insertAdjacentHTML("afterbegin", `
        <nav>
        <div class="logo">
            <h1>Next Signage</h1>
        </div>
        <div class="items">
            <a href="">Sobre n&oacute;s</a>
            <p>|</p>
            <a href="">Conhecer a ferramenta</a>
            <p>|</p>
            <a href="">Encarregados</a>
            <p>|</p>
            <a href="https://github.com/digitalsignageifc/digitalSignage">Github</a>
        </div>
        </nav>
    `);
    document.querySelector("nav").insertAdjacentHTML("afterbegin",
    `
    <div class="menu onlyresponsive">
        <i class="fa-solid fa-bars"></i>
        <div class="menubar">
            <div class="superior">
                <img class="systemlogo" alt="Digital Signage">
                <h1>Digital Signage</h1>
            </div>
            <div class="inferior">
                <div>
                    <a href="">Sobre n&oacute;s</a>
                </div>
                <div>
                    <a href="">Conhecer a ferramenta</a>
                </div>
                <div>
                    <a href="">Encarregados</a>
                </div>
                <div>
                    <a href="https://github.com/digitalsignageifc/digitalSignage">Github</a>
                </div>
            </div>
        </div>
    </div>
    `);

    if (logoSrc) {
        document.querySelectorAll(".systemlogo").forEach((element) => {
            element.src = logoSrc;
        });
    }
});
