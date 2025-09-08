<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - PE SIGNAGE</title>
    
    <link rel="stylesheet" type="text/css" href="/php-rascunho/public/css/responsive.css" media="(max-width: 880px)" />
    <link rel="stylesheet" type="text/css" href="/php-rascunho/public/css/style.css" />
    <link rel="stylesheet" href="/php-rascunho/public/header/header.css" />
    <script defer src="/php-rascunho/public/header/header.js"></script>
</head>
<body>
    <nav>
        <div class="logo">
            <div class="imagem">
                <img class="projectimage" src="/php-rascunho/public/images/favicon.ico" />
            </div>
            <h1 class="projecttitle"></h1>
        </div>
        <div class="items">
            <a href="#">Sobre nós</a>
            <p>|</p>
            <a href="#">Conhecer a ferramenta</a>
            <p>|</p>
            <a href="#">Encarregados</a>
            <p>|</p>
            <a href="#">Github</a>
        </div>
    </nav>

    <main>
        <div class="about-content">
            <div class="content">
                <div class="circular-image"><img class="projectimage" src="/php-rascunho/public/images/favicon.ico" /></div>
                <h1 class="projecttitle"></h1>
                <h3>Não tem uma conta? <a href="/php-rascunho/public/signup">Cadastrar</a>.</h3>
                <h3>Que tal entender <a href="#">como nós trabalhamos</a>?</h3>
            </div>
        </div>

        <div class="form-container">
            <div class="content">
                <div class="onlyresponsive"><img class="projectimage" src="/php-rascunho/public/images/favicon.ico" /></div>
                <h1>Bem-vindo</h1>
                <h3>É bom te ter de volta! Insira seus dados para voltar ao sistema</h3>
                <h3 class="onlyresponsive">Não tem uma conta? <a href="/php-rascunho/public/signup">Cadastrar</a>.</h3>

                <?php

                if (isset($_GET['error'])) {
                    $errorMessage = '';
                    if ($_GET['error'] == 'invalid') {
                        $errorMessage = 'E-mail ou senha inválidos.';
                    } elseif ($_GET['error'] == 'empty') {
                        $errorMessage = 'Por favor, preencha todos os campos.';
                    }
                    if ($errorMessage) {
                        echo '<p style="color: red; text-align: center;">' . $errorMessage . '</p>';
                    }
                }
                // Exibe mensagem de sucesso após o cadastro
                if (isset($_GET['status']) && $_GET['status'] == 'success') {
                     echo '<p style="color: green; text-align: center;">Cadastro realizado com sucesso! Faça o login.</p>';
                }
                ?>
                
                <form method="POST" action="/php-rascunho/public/login/authenticate">
                    <label>E-mail</label><br />
                    <input type="email" name="email" required/><br />
                    <label>Senha</label><br />
                    <input type="password" name="paswd" required/><br />
                    <input type="submit" value="Logar">
                </form>
            </div>
        </div>
    </main>
</body>
</html>