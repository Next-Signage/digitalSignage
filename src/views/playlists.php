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
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/leftnav.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/dashboardstyle.css" />
    <script src="<?= BASE_URL ?>/js/dashboardheader.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", ()=>{
        document.querySelectorAll(".systemlogo").forEach(element => {
          element.src = "<?= BASE_URL ?>/images/others/logo.png";
        });
      })
    </script>
  </head>
  <body>
    <main>
      <div class="right-painel">
        <div class="up">
          <div class="information">
            <div class="right-info">
              <div class="title">
                <h1>Todas as Playlists</h1>
              </div>
            </div>
            <div class="left-info">
              <div class="stylisedbutton">
                <i class="fa-solid fa-plus"></i>
                <p>Nova Playlist</p>
              </div>
            </div>
          </div>
          <div class="main">
            <div class="table">
              <div class="linha-info">
                <div><p>Nome</p></div>
                <div><p>Descrição</p></div>
                <div class="end invisible">
                  <i class="fa-solid fa-gear"></i>
                  <i class="fa-solid fa-trash"></i>
                </div>
              </div>
              <div class="linha" id="copy-playlist">
                <div><p>Incêndio</p></div>
                <div><p>Colocar quando tiver incêndio</p></div>
                <div class="end">
                  <i onclick="GoEditPlaylist()" class="fa-solid fa-gear"></i>
                  <i class="fa-solid fa-trash"></i>
                </div>
              </div>
              <div class="linha">
                <div><p>Esporte 1</p></div>
                <div><p>Colocar em ocasiões normais</p></div>
                <div class="end">
                  <i onclick="GoEditPlaylist()" class="fa-solid fa-gear"></i>
                  <i class="fa-solid fa-trash"></i>
                </div>
              </div>
              <div class="linha">
                <div><p>Playlist da Cozinha</p></div>
                <div><p>Colocar quando tiver visita</p></div>
                <div class="end">
                  <i onclick="GoEditPlaylist()" class="fa-solid fa-gear"></i>
                  <i class="fa-solid fa-trash"></i>
                </div>
              </div>
              <div class="linha">
                <div><p>Incêndio</p></div>
                <div><p>Colocar quando tiver incêndio</p></div>
                <div class="end">
                  <i onclick="GoEditPlaylist()" class="fa-solid fa-gear"></i>
                  <i class="fa-solid fa-trash"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="bottom">
          <button><</button>
          <p>1</p>
          <button>></button>
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