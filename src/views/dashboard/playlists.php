<?php
require_once __DIR__ . '/../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Playlists</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/variaveis.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/leftnav.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/dashboardstyle.css" />
  </head>
  <body data-page="playlists" data-logo-src="<?= BASE_URL ?>/images/others/logo.png">
    <main>
      <?php 
       include  __DIR__.'/../components/menu.php';
      ?>
      <div class="right-painel">
        <div class="up">
          <div class="information">
            <div class="right-info">
              <div class="title">
                <h1>Todas as Playlists</h1>
              </div>
            </div>
            <div class="left-info">
              <button type="button" class="stylisedbutton" id="newplaylist">
                <i class="fa-solid fa-plus"></i>
                <p>Nova Playlist</p>
              </button>
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
              <div class="table-body" id="playlists-table-body"></div>
            </div>
          </div>
        </div>
        <div class="bottom">
          <button type="button"><</button>
          <p>1</p>
          <button type="button">></button>
        </div>
      </div>
    </main>
  </body>
<!--mover playlists-data bara baixo-->
  <script>
    window.PlaylistsPageData = <?=json_encode($pageData,JSON_UNESCAPED_UNICODE) ?>
  </script>

  <script src="<?= BASE_URL ?>/js/viewforms.js"></script>
  <script src="<?= BASE_URL ?>/js/pages/playlists.js"></script>

  <style>
    .left-painel .playlists-menu-button {
        background-color: var(--background4);
    }
  </style>
</html>