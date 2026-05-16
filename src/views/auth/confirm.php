<?php
require_once __DIR__ . '/../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title class="projecttitle"></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/variaveis.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/confirm.css" />
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/css/responsive.css" />
  </head>

  <body data-page="confirm" data-logo-src="<?= BASE_URL ?>/images/others/logo.png">
    <main>
      <div class="normal-container confirm">
        <h1>Pronto! Verifique seu e-mail para começar</h1>
        <p id="emailtext">Um c&oacute;digo de 6 d&iacute;gitos foi enviado a<br><strong>emailsuperoficial@iorgute.net</strong></p>
        <p>O c&oacute;digo expira em 5 minutos</p>
        <form
          method="POST"
          action="/mock-api/auth/confirm"
          data-endpoint="/mock-api/auth/confirm"
          data-reload-after-submit="true"
        >
          <label for="Code"><strong>Insira seu c&oacute;digo de 6 d&iacute;gitos</strong></label>
          <input id="Code" type="text" maxlength="6" value="000000" name="code" inputmode="numeric" />
          <label for="submit">Não recebeu nenhum c&oacute;digo? <a href="">Re-enviar C&oacute;digo</a></label>
          <input type="submit" value="Verificar" name="submit" />
        </form>
      </div>
    </main>
  </body>
  <script src="<?= BASE_URL ?>/js/viewforms.js"></script>
  <script src="<?= BASE_URL ?>/js/pages/confirm.js"></script>
</html>
