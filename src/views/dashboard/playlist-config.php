<?php
require_once __DIR__ . '/../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Configurar Playlist</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/variaveis.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/leftnav.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/dashboardstyle.css" />
    <script src="<?= BASE_URL ?>/js/menu.js"></script>
  </head>
  <body data-page="playlistconfig" data-logo-src="<?= BASE_URL ?>/images/others/logo.png">
    <main>
      <?php 
       include  __DIR__.'/../components/menu.php';
      ?>
      <div class="right-painel">
        <div class="up">
          <form
            id="playlistMainForm"
            class="panel-form"
            method="POST"
            action="update"
            data-endpoint="update"
            data-before-submit="preparePlaylistConfigSubmission"
            data-reload-after-submit="true"
          >
            <div class="information">
              <div class="right-info">
                <div class="title playlist-title-wrap">
                  <input
                    type="text"
                    maxlength="40"
                    id="title"
                    class="playlist-title-input"
                    name="playlist_name"
                    required
                  />
                </div>
              </div>
              <div class="left-info">
                <button type="button" class="stylisedbutton" id="addfile">
                  <i class="fa-solid fa-plus"></i>
                  <p>Carregar arquivo</p>
                </button>
                <button type="button" class="stylisedbutton" id="associarPlaylist">
                  <i class="fa-solid fa-link"></i>
                  <p>Associar Playlist</p>
                </button>
                <button type="submit" class="stylisedbutton refresh" id="updatePlaylist" disabled>
                  <i class="fa-solid fa-rotate"></i>
                  <p>Atualizar Playlist</p>
                </button>
              </div>
            </div>
            <div class="main">
              <div class="table">
                <p class="title">Todas as M&iacute;dias</p>
                <div class="linha-info">
                  <div><p>Nome</p></div>
                  <div><p>Descri&ccedil;&atilde;o</p></div>
                  <div class="center"><p>Data de Adi&ccedil;&atilde;o</p></div>
                  <div class="center"><p>Dura&ccedil;&atilde;o</p></div>
                  <button type="button" style="opacity: 0;"><img src="<?= BASE_URL ?>/images/icons/trash.svg" class="svg-branco" /></button>
                </div>
                <div class="table-body" data-media-body></div>
                <p id="nomidia">Sem m&iacute;dia</p>
              </div>
            </div>
          </form>



          
        </div>
        <div class="bottom">
          <button type="button"><</button>
          <p>1</p>
          <button type="button">></button>
        </div>
      </div>
    </main>

    <div id="associarPlaylistMSG" style="display: none">
      <div class="blackscreen">
        <form
          id="associarPlaylistForm"
          class="association-form"
          method="POST"
          action="associate"
          data-endpoint="associate"
          data-reload-after-submit="true"
        >
          <h2>Associe essa playlist aos seus dispositivos</h2>
          <div class="dispositivos">
            <div class="linha-info">
              <div><p>Nome</p></div>
              <div>
                <input type="checkbox" data-select-all-devices />
              </div>
            </div>
            <div id="associated-devices-body"></div>
          </div>
          <div>
            <button type="button" class="cancelar" id="cancelAssociate">Cancelar</button>
            <button type="submit" id="confirmAssociate" class="confirm">Confirmar</button>
          </div>
        </form>
      </div>
    </div>

    <input type="file" style="display: none;" id="sendfile" accept=".png,.jpg,.jpeg,.mp4,.avif,.webp,.ico" multiple />
  </body>
  <script>
    // O PHP imprime o array do Service transformado em objeto JavaScript
    window.PlaylistConfigPageData = <?= json_encode($pageData, JSON_UNESCAPED_UNICODE) ?>;
</script>
  
  <script src="<?= BASE_URL ?>/js/viewforms.js"></script>
  <script src="<?= BASE_URL ?>/js/pages/playlist-config.js"></script>
  <script src="<?= BASE_URL ?>/js/data/playlist-config-data.js"></script>
</html>
