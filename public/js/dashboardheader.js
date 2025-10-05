document.addEventListener("DOMContentLoaded", ()=>{
    document.querySelector("head").insertAdjacentHTML("afterbegin", `
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    `)
    document.querySelector("main").insertAdjacentHTML("afterbegin",
    `
      <div class="left-painel">
        <div class="mini-profilelogo">
            <div>
              <div>
                <img class="systemlogo">
                <p>Digital Signage</p>
              </div>
              <a class="avatar" href="dashboard.php"><p>P</p></a>
            </div>
        </div>
        <div class="botoes">
          <div class="cima">
            <a class="botao" href="dashboard.php">
              <i class="fa-solid fa-plug"></i>
              <p>Conexões</p>
            </a>
            <a class="botao" href="playlists.php">
              <i class="fa-solid fa-list"></i>
              <p>Playlists</p>
            </a>
          </div>
          <div class="baixo">
            <a class="botao">
              <i class="fa-solid fa-align-left"></i>
              <p>Documentação</p>
            </a>
            <a class="botao">
              <i class="fa-solid fa-people-group"></i>
              <p>Sobre a nós</p>
            </a>
            <a class="botao" target="_blank" href="https://github.com/digitalsignageifc/digitalSignage">
              <i class="fa-brands fa-github"></i>
              <p>Github</p>
            </a>
          </div>
        </div>
      </div>
    `)
})