<?php
require_once __DIR__ . '/../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Next Signage</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/variaveis.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/auth.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/header.css" />
    <script src="<?= BASE_URL ?>/js/authheader.js"></script>
  </head>

  <body data-logo-src="<?= BASE_URL ?>/images/others/logo.png">
    <main class="auth-page">
      <section class="auth-layout">
        <aside class="auth-panel auth-panel--brand" aria-hidden="true">
          <div class="auth-brand">
            <img
              class="auth-brand__image"
              src="<?= BASE_URL ?>/images/others/logo.png"
              alt="Digital Signage"
            />
          </div>
        </aside>

        <section class="auth-panel auth-panel--form">
          <div class="auth-card">
            <div class="auth-card__logo auth-card__logo--mobile">
              <img
                class="auth-card__logo-image"
                src="<?= BASE_URL ?>/images/others/logo.png"
                alt="Digital Signage"
              />
            </div>

            <header class="auth-card__header">
              <h1 class="auth-card__title">Bem-vindo</h1>
              <p class="auth-card__subtitle">
                É bom te ter de volta! Insira seus dados para voltar ao sistema
              </p>
              <p class="auth-switch auth-switch--mobile">
                Não tem uma conta?
                <a class="auth-switch__link" href="signup">Cadastrar</a>.
              </p>
            </header>

            <form
              class="auth-form"
              id="loginForm"
              method="POST"
              action="/mock-api/auth/login"
              data-endpoint="/mock-api/auth/login"
              data-reload-after-submit="true"
            >
              <div class="auth-form__field">
                <label class="auth-form__label" for="login-email">E-mail</label>
                <input
                  class="auth-form__input"
                  id="login-email"
                  type="email"
                  name="email"
                  placeholder="Endereco de e-mail"
                  required
                />
              </div>

              <div class="auth-form__field">
                <label class="auth-form__label" for="login-password">Senha</label>
                <input
                  class="auth-form__input"
                  id="login-password"
                  type="password"
                  name="paswd"
                  placeholder="Senha"
                  required
                />
              </div>

              <button class="auth-form__submit" type="submit">Logar</button>

              <p class="auth-switch auth-switch--desktop">
                Não tem uma conta?
                <a class="auth-switch__link" href="signup">Cadastrar</a>
              </p>
            </form>
          </div>
        </section>
      </section>
    </main>
  </body>
  <script src="<?= BASE_URL ?>/js/viewforms.js"></script>
  <script src="<?= BASE_URL ?>/js/pages/login.js"></script>
</html>
