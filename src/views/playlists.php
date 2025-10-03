<?php
require_once __DIR__ . '/../../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="widp=device-widp, initial-scale=1.0" />
    <title>Dashboard</title>
    
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/variaveis.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/dashboardheader.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/playlists.css" />
    <script src="<?= BASE_URL ?>/js/dashboardheader.js"></script>
  </head>
  <body>
    <main>
      <div class="right-painel">
        <div class="title" style="display: none;">
          <h2>Playlists</h2>
          <div class="search">
            <img src="<?= BASE_URL ?>/images/icons/search.svg" />
            <input placeholder="Procurar por playlist" />
          </div>
        </div>
        <div class="main">
          <div class="titlemain">
            <div>
              <h1>Todas as Playlists</h1>
            </div>
            <div>
              <button id="newplaylist">
                <img src="<?= BASE_URL ?>/images/icons/plus.svg" />
                <p>Nova playlist</p>
              </button>
            </div>
          </div>
          <div class="playlists">
            <div class="linha-info">
              <div><p>Nome</p></div>
              <div><p>Descrição</p></div>
            </div>
            <!-- a mesma coisa dita no comentario acima do elemento do ID "copy-dispositivo" no arquivo conections.html
             a única diferença é que é para a playlist -->
            <div class="linha" id="copy-playlist">
              <div><p>Esporte 1</p></div>
              <div><p>Colocar em ocasiões normais</p></div>
              <button onclick="GoEditPlaylist()"><img src="<?= BASE_URL ?>/images/icons/config.svg"></button>
              <button><img src="<?= BASE_URL ?>/images/icons/trash.svg" /></button>
            </div>
            <div class="linha">
              <div><p>Esporte 1</p></div>
              <div><p>Colocar em ocasiões normais</p></div>
              <button onclick="GoEditPlaylist()"><img src="<?= BASE_URL ?>/images/icons/config.svg"></button>
              <button><img src="<?= BASE_URL ?>/images/icons/trash.svg" /></button>
            </div>
            <div class="linha">
              <div><p>Playlist da Cozinha</p></div>
              <div><p>Colocar quando tiver visita</p></div>
              <button onclick="GoEditPlaylist()"><img src="<?= BASE_URL ?>/images/icons/config.svg"></button>
              <button><img src="<?= BASE_URL ?>/images/icons/trash.svg" /></button>
            </div>
            <div class="linha">
              <div><p>Incêndio</p></div>
              <div><p>Colocar quando tiver incêndio</p></div>
              <button onclick="GoEditPlaylist()"><img src="<?= BASE_URL ?>/images/icons/config.svg"></button>
              <button><img src="<?= BASE_URL ?>/images/icons/trash.svg" /></button>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
  <script>
    document.getElementById("newplaylist").addEventListener("click",()=>{
      window.location.href = "playlistconfig.php"
    })
  </script>
  <script>
    function GoEditPlaylist() {
      window.location.href = "playlistconfig.php?<nome da playlist>"
    }
  </script>
</html>