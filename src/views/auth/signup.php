<?php
require_once __DIR__ . '/../../../config/config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastro | Next Signage</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/variaveis.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/auth.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/header.css" />
    <script src="<?= BASE_URL ?>/js/authheader.js"></script>
  </head>

  <body
    data-page="signup"
    data-logo-src="<?= BASE_URL ?>/images/others/logo.png"
    data-dashboard-url="<?= BASE_URL ?>/dashboard"
  >
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
              <h1 class="auth-card__title">Cadastre-se agora</h1>
              <p class="auth-card__subtitle">Crie uma conta de graça</p>
              <p class="auth-switch auth-switch--mobile">
                J&aacute; possui uma conta?
                <a class="auth-switch__link" href="login.php">Entrar</a>.
              </p>
            </header>

            <form
              class="auth-form"
              id="signupForm"
              method="POST"
              action="/mock-api/auth/signup"
              data-endpoint="/mock-api/auth/signup"
              data-after-submit="handleSignupAfterSubmit"
            >
              <div id="signup-step-one" data-signup-step="one" class="auth-card confirm-signup">
                <div class="auth-form__field">
                  <label class="auth-form__label" for="signup-email">E-mail</label>
                  <input
                    class="auth-form__input"
                    id="signup-email"
                    type="email"
                    name="email"
                    placeholder="Endereco de e-mail"
                    required
                  />
                </div>

                <div class="auth-form__field">
                  <label class="auth-form__label" for="signup-password">Senha</label>
                  <input
                    class="auth-form__input"
                    id="signup-password"
                    type="password"
                    name="paswd"
                    placeholder="Senha"
                    required
                  />
                </div>

                <div class="auth-form__field">
                  <label class="auth-form__label" for="signup-password-confirm">Confirmar Senha</label>
                  <input
                    class="auth-form__input"
                    id="signup-password-confirm"
                    placeholder="Confirme sua senha"
                    required
                  />
                </div>

                <button class="auth-form__submit" id="signup-next-step" type="button">Continuar</button>
              </div>

              <?php include 'confirm-signup.php'; ?>

              <p class="auth-switch auth-switch--desktop">
                J&aacute; possui uma conta?
                <a class="auth-switch__link" href="login">Entrar</a>
              </p>
            </form>
          </div>
        </section>
      </section>
    </main>
  </body>
  <script src="<?= BASE_URL ?>/js/viewforms.js"></script>
  <script src="<?= BASE_URL ?>/js/pages/signup.js"></script>
</html>
