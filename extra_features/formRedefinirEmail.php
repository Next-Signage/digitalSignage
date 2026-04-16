<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #1f2340;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            align-items: center;
        }

        /* Navbar */
        nav {
            width: 100%;
            padding: 15px 40px;
            background-color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            color: #000;
        }

        nav .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: bold;
        }

        nav .logo .circle {
            width: 20px;
            height: 20px;
            background-color: #6b5dd3;
            border-radius: 50%;
        }

        nav .menu a {
            margin-left: 20px;
            text-decoration: none;
            color: #000;
        }

        /* Card central */
        .card {
            margin-top: 100px;
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 20px;
            width: 360px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .card h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .card p {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }

        .card a {
            color: #6b5dd3;
            text-decoration: none;
        }

        /* Form */
        .card form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .card input[type="email"] {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .card .error {
            color: red;
            font-size: 12px;
            text-align: left;
        }

        .card button {
            padding: 12px;
            background-color: #6b5dd3;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
        }

        .card button:hover {
            background-color: #5947b0;
        }

        .card .login-link {
            margin-top: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <nav>
        <div class="logo">
            <div class="circle"></div>
            Digital Signage
        </div>
        <div class="menu">
            <a href="#">Sobre nós</a>
            <a href="#">Conhecer a ferramenta</a>
            <a href="#">Encarregados</a>
            <a href="#">GitHub</a>
        </div>
    </nav>

    <div class="card">
        <h2>Esqueceu a senha?</h2>
        <p>Preencha seu e-mail abaixo para receber um <a href="#">link de redefinição de senha</a></p>

        <form action="enviarEmailConfirmacao.php" method="post">
            <input name="email"type="email" placeholder="E-mail" required>
            <div class="error">Esse campo é obrigatório</div>
            <button type="submit">Enviar Solicitação</button>
        </form>

        <div class="login-link">
            Lembrou sua senha? <a href="public/index.php">Fazer Login</a>
        </div>
    </div>

</body>
</html>
