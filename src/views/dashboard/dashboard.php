<?php
require_once __DIR__ . '/../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/variaveis.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/leftnav.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/dashboardstyle.css" />
  </head>
  <body data-page="dashboard" data-logo-src="<?= BASE_URL ?>/images/others/logo.png">
  <!---<a width = '500' href="src/views/components/menu.php"></a> -->
  <main>
      <?php 
        include  __DIR__.'/../components/menu.php';
      ?>
      <div class="right-painel">
        <div class="up">
          <form
            id="dashboardUpdateForm"
            class="panel-form"
            method="POST"
            action="/mock-api/dashboard/devices/update"
            data-endpoint="/mock-api/dashboard/devices/update"
            data-before-submit="prepareDashboardUpdateSubmission"
            data-reload-after-submit="true"
          >
            <div class="information">
              <div class="right-info">
                <button class="stylisedbutton disps" style="background-color: var(--primario);">
                  <i class="fa-solid fa-desktop"></i>
                  <span id="CountDispositivo">0</span>
                  <p>Dispositivos</p>
                </button>
                <button class="stylisedbutton disps" style="background-color: #3DA86A;">
                  <i class="fa-solid fa-globe"></i>
                  <span id="CountDispOnline">0</span>
                  <p>Onlines</p>
                </button>
                <button class="stylisedbutton disps">
                  <i class="fa-solid fa-plane-circle-xmark"></i>
                  <span id="CountDispOffline">0</span>
                  <p>Offlines</p>
                </button>
              </div>
              <div class="left-info">
                <button type="button" id="newdisp" class="stylisedbutton">
                  <i class="fa-solid fa-plus"></i>
                  <p>Novo Dispositivo</p>
                </button>
                <button type="button" id="newplaylist" class="stylisedbutton">
                  <i class="fa-solid fa-plus"></i>
                  <p>Nova Playlist</p>
                </button>
                <button type="submit" class="stylisedbutton refresh" id="dashboardUpdateButton" disabled>
                  <i class="fa-solid fa-arrows-rotate"></i>
                  <p>Atualizar Dispositivos</p>
                </button>
              </div>
            </div>
            <div class="main">
              <p class="title">Todos os Dispositivos</p>
              <div class="table">
                <div class="linha-info">
                  <div><p>Nome</p></div>
                  <div><p>Status</p></div>
                  <div class="center"><p>Playlist</p></div>
                  <div class="center"><p>IP</p></div>
                  <div><p>Descrição</p></div>
                </div>
                <div class="table-body" id="dashboard-table-body"></div>
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

    <div id="AddDispositivo" style="display: none;">
      <div class="blackscreen">
        <h1>Adicionar Dispositivo</h1>
        <form
          id="addDispForm"
          method="POST"
          action="registerplayer"
          data-endpoint="registerplayer"
          data-reload-after-submit="true"
        >
          <label for="device_name">Nome</label>
          <input id="device_name" type="text" maxlength="30" name="device_name" placeholder="Dispositivo..." required />
          <label for="device_description">Descrição</label>
          <input id="device_description" type="text" maxlength="50" name="device_description" placeholder="Descrição..." required />
          <label for="device_ip">Endereço IPv4 ou IPv6</label>
          <input id="device_ip" type="text" maxlength="45" name="device_ip" placeholder="192.168.X.X ou fe80::1c3b:2eff:fe4f:1234" required />
          <label for="device_location">Localização</label>
          <input id="device_location" type="text" maxlength="50" name="device_location" placeholder="Sala de estar..." required />
          <label for="device_playlist">Playlist</label>
          <select id="device_playlist" name="device_playlist"></select>
          <div>
            <button type="button" class="cancelar" id="cancelPlaylist">Cancelar</button>
            <button type="submit" class="confirm" id="createPlaylist">Confirmar</button>
          </div>
        </form>
      </div>
    </div>
  </body>

  <script>
    window.DashboardPageData = <?= json_encode($pageData, JSON_UNESCAPED_UNICODE) ?>;
  </script>
  
  <script src="<?= BASE_URL ?>/js/viewforms.js"></script>
  <script src="<?= BASE_URL ?>/js/pages/dashboard.js"></script>
  <script src="<?= BASE_URL ?>/js/data/dashboard-data.js"></script>

  <style>
    .left-painel .conections-menu-button {
        background-color: var(--background4);
    }
  </style>
</html>
