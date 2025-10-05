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
              <div class="stylisedbutton disps" style="background-color: var(--primario);">
                <i class="fa-solid fa-desktop"></i>
                <span id="CountDispositivo">20</span>
                <p>Dispositivos</p>
              </div>
              <div class="stylisedbutton disps" style="background-color: #3DA86A;">
                <i class="fa-solid fa-globe"></i>
                <span id="CountDispOnline">15</span>
                <p>Onlines</p>
              </div>
              <div class="stylisedbutton disps">
                <i class="fa-solid fa-plane-circle-xmark"></i>
                <span id="CountDispOffline">5</span>
                <p>Offlines</p>
              </div>
            </div>
            <div class="left-info">
              <div class="onhover stylisedbutton justicon">
                <i class="fa-solid fa-plus"></i>
                <div class="show">
                  <div id="newdisp" class="stylisedbutton">
                    <p>Novo Dipositivo</p>
                  </div>
                  <div id="newplaylist" class="stylisedbutton">
                    <p>Nova Playlist</p>
                  </div>
                </div>
              </div>
              <div class="stylisedbutton disps refresh">
                <i class="fa-solid fa-arrows-rotate"></i>
                <p>Refresh</p>
              </div>
            </div>
          </div>
          <div class="main">
            <p class="title">Todos os Dispositivos</p>
            <div class="table">
              <div class="linha-info">
                <div><p>Nome</p></div>
                <div><p>Descrição</p></div>
                <div><p>Status</p></div>
                <div class="center"><p>Playlist</p></div>
                <div class="end"><p>#</p></div>
              </div>
              <div class="linha" id="copy-dispositivo">
                <div><p id="name">Lorem Nome longo</p></div>
                <div><p id="locali">ipsum</p></div>
                <div><p id="status" class="offline">Offline</p></div>
                <div class="center">
                  <select class="selectplaylist">
                      <option selected>Esporte 1</option>
                      <option>Playlist da Cozinha</option>
                      <option>Nenhum</option>
                  </select>
                </div>
                <div class="end"><p id="idnumber">1</p></div>
              </div>
              <div class="linha">
                <div><p id="name">Lorem</p></div>
                <div><p id="locali">ipsum Nome longo</p></div>
                <div><p id="status" class="online">Online</p></div>
                <div class="center">
                  <select class="selectplaylist">
                      <option selected>Esporte 1</option>
                      <option>Playlist da Cozinha</option>
                      <option>Nenhum</option>
                  </select>
                </div>
                <div class="end"><p id="idnumber">1</p></div>
              </div>
              <div class="linha">
                <div><p id="name">Lorem</p></div>
                <div><p id="locali">ipsum</p></div>
                <div><p id="status" class="offline">Offline</p></div>
                <div class="center">
                  <select class="selectplaylist">
                      <option>Esporte 1</option>
                      <option selected>Playlist da Cozinha</option>
                      <option>Nenhum</option>
                  </select>
                </div>
                <div class="end"><p id="idnumber">2</p></div>
              </div>
              <div class="linha">
                <div><p id="name">Lorem</p></div>
                <div><p id="locali">ipsum</p></div>
                <div><p id="status" class="online">Online</p></div>
                <div class="center">
                  <select class="selectplaylist">
                      <option>Esporte 1</option>
                      <option>Playlist da Cozinha</option>
                      <option selected>Nenhum Nome longo</option>
                  </select>
                </div>
                <div class="end"><p id="idnumber">3</p></div>
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
    <div id="AddDispositivo" style="display: none;">
      <div class="blackscreen">
        <h1>Adicionar Dispositivo</h1>
        <form id="addDispForm">
          <label for="nome">Nome</label>
          <input type="text" maxlength="30" name="nome" placeholder="Dispositivo..." required>
          <label for="desc">Descrição</label>
          <input type="text" maxlength="50" name="desc" placeholder="Descrição..." required>
          <label for="desc">Endereço IPv4 or IPv6</label>
          <input type="text" maxlength="15" name="ipv4" placeholder="192.168.X.X ou fe80::1c3b:2eff:fe4f:1234" required>
          <label for="desc">Localização</label>
          <input type="text" maxlength="50" name="ipv4" placeholder="Sala de estar..." required>
          <label for="playlist">Playlist</label>
          <select>
            <option value="">Nenhuma</option>
            <option value="Esporte 1">Esporte 1</option>
            <option value="TV primária">TV primária</option>
            <option value="Shopping">Shopping</option>
          </select>
          <div class="status">
            <label for="desc">O dispositivo está online?</label>
            <input type="checkbox" name="status">
          </div>
          <div>
            <button class="cancelar" id="cancelPlaylist">Cancelar</button>
            <button class="confirm" id="createPlaylist">Confirmar</button>
          </div>
        </form>
      </div>
    </div>
  </body>
  <script src="<?= BASE_URL ?>/js/dashboardjs.js"></script>
  <script>dashboard()</script>
  <script>
    document.getElementById("newplaylist").addEventListener("click",()=>{
      window.location.href = "playlistconfig.php"
    })
  </script>
</html>
