<?php
require_once __DIR__ . '/../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title class="projecttitle"></title>
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/css/responsive.css" />

    <link rel="stylesheet" href="<?= BASE_URL ?>/css/signup.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/variaveis.css" />

    <link rel="stylesheet" href="<?= BASE_URL ?>/css/header.css" />
    <script src="<?= BASE_URL ?>/js/authheader.js"></script>
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
      <div class="about-content">
        <div class="content">
          <img class="circular-image" src="<?= BASE_URL ?>/images/others/logo.png" />
        </div>
      </div>

      <div class="form-container">
        <div class="content">
          <h1>Bem-vindo</h1>
          <h3>Cadastre-se agora para usar o sistema</h3>
          <h3 class="onlyresponsive">
            Já tem uma conta? <a href="login.php">Entrar</a>.
          </h3>
          <form id="formulario" method="GET" action="../dashboard.php">
            <label>Nome de usuário</label><br />
            <input type="text" name="name" required /><br />
            <label>E-mail</label><br />
            <input type="email" name="email" required /><br />
            <div>
              <div>
                <label>Senha</label><br />
                <input type="password" name="paswd" required /><br />
              </div>
              <div>
                <label>Confirmar senha</label><br />
                <input type="password" name="paswdconfirm" required /><br />
              </div>
            </div>
            <label>CPF</label><br />
            <input type="text" id="cpf" name="cpf"
                  pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
                  placeholder="000.000.000-00"
                  title="Digite o CPF no formato 000.000.000-00"
                  required>
            <label>Data de Nascimento</label><br />
            <input type="date" name="birthday" required /><br />
            <input type="submit" value="Cadastrar" id="submitform" />
            <h3>Já tem uma conta? <a href="login.php">Entrar</a></h3>
          </form>
        </div>
      </div>
    </main>
    <div id="usermessage">
        <h2>Cadastrado com sucesso!</h2>
    </div>

    <script>
      // verificar se a senha é a mesma de verificar senha
      document.getElementById("formulario").addEventListener("submit", (e) => {
        if (
          document.getElementsByName("paswd")[0].value !==
          document.getElementsByName("paswdconfirm")[0].value
        ) {
          e.preventDefault();
          alert("As senhas não coincidem!");
          document.getElementsByName("paswd")[0].style.color = "red";
          document.getElementsByName("paswdconfirm")[0].style.color = "red";

          document
            .getElementsByName("paswd")[0]
            .parentElement.querySelector("label").style.color = "red";
          document
            .getElementsByName("paswdconfirm")[0]
            .parentElement.querySelector("label").style.color = "red";
        }
      });

      function setDefault() {
        document.getElementsByName("paswd")[0].style.color = "black";
        document.getElementsByName("paswdconfirm")[0].style.color = "black";
        document
          .getElementsByName("paswd")[0]
          .parentElement.querySelector("label").style.color = "black";
        document
          .getElementsByName("paswdconfirm")[0]
          .parentElement.querySelector("label").style.color = "black";
      }
      document
        .getElementsByName("paswd")[0]
        .addEventListener("input", setDefault);
      document
        .getElementsByName("paswdconfirm")[0]
        .addEventListener("input", setDefault);
    </script>
  </body>
</html>
