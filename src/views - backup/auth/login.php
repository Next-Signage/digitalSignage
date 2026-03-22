<?php
require_once __DIR__ . '/../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title class="projecttitle"></title>
    <link
      rel="stylesheet"
      type="text/css"
      href="<?= BASE_URL ?>/css/responsive.css"
      media="(max-width: 880px)"
    />
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/variaveis.css" />
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/css/login.css" />
    
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
          <div class="onlyresponsive responsivelogo"><img class="projectimage" src="<?= BASE_URL ?>/images/others/logo.png" /></div>
          <h1>Bem-vindo</h1>
          <h3>
            É bom te ter de volta! Insira seus dados para voltar ao sistema
          </h3>
          <h3 class="onlyresponsive">Não tem uma conta? <a href="signup.php">Cadastrar</a>.</h3>
          <form>
            <label>E-mail</label>
            <input type="email" name="email" required/><br />
            <label>Senha</label>
            <input type="password" name="paswd" required/><br />
            <input type="submit" value="Logar"><br />
            <h3>Não tem uma conta? <a href="signup.php">Cadastrar</a></h3>
          </form>
        </div>
      </div>
    </main>
  </body>
</html>
