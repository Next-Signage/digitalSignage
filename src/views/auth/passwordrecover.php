<?php
require_once __DIR__ . '/../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title class="projecttitle"></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/header.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/variaveis.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/passwordrecover.css" />
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/css/responsive.css" />
  </head>

  <body data-page="passwordrecover" data-logo-src="<?= BASE_URL ?>/images/others/logo.png">
    <main>
      <div class="normal-container passrecover">
        <h1>Esqueceu a senha?</h1>
        <p>Preencha seu e-mail abaixo para receber um link de redefini&ccedil;&atilde;o de senha</p>
        <form
          method="POST"
          action="/mock-api/auth/password-recover"
          data-endpoint="/mock-api/auth/password-recover"
          data-reload-after-submit="true"
        >
          <label for="Email"><strong>E-mail</strong></label>
          <input id="Email" type="email" name="email" />
          <label for="Email" class="obrigatorio">Esse campo &eacute; obrigat&oacute;rio</label>
          <input type="submit" value="Enviar Solicita&ccedil;&atilde;o" name="submit" />
        </form>
        <p class="lemb">Lembrou sua senha? <a href="login.php">Fazer login</a></p>
      </div>
    </main>
  </body>
  <script src="<?= BASE_URL ?>/js/viewforms.js"></script>
  <script src="<?= BASE_URL ?>/js/pages/passwordrecover.js"></script>
</html>
