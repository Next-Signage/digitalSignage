<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página não encontrada</title>
    <style>
        /* Reset básico para combinar com o dashboard */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: #f8f9fa; /* Cinza muito claro de fundo da tua tabela */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2d3436;
        }

        .error-container {
            text-align: center;
            background: #ffffff;
            padding: 50px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            max-width: 500px;
            width: 90%;
        }

        /* O rosa extraído do teu botão "Novo Dispositivo" */
        .error-code {
            font-size: 100px;
            font-weight: 800;
            color: #ff2d55; 
            line-height: 1;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #333;
        }

        p {
            color: #636e72;
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .status-badge {
            background-color: #ff2d55;
            color: white;
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .btn {
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
        }

        /* Estilo dos botões do teu cabeçalho */
        .btn-primary {
            background-color: #ff2d55;
            color: white;
        }

        .btn-secondary {
            background-color: #8e8e93; /* Cinza do botão "Atualizar Dispositivos" */
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        /* Ícone simples simulando um dispositivo */
        .icon {
            margin-bottom: 20px;
            display: inline-block;
            width: 60px;
            height: 60px;
            background: #f1f2f6;
            border-radius: 50%;
            line-height: 60px;
            font-size: 30px;
        }
    </style>
</head>
<body>

    <div class="error-container">
        <div class="icon">🖥️</div>
        <div class="error-code">404</div>
        <h1>Caminho não encontrado</h1>
        <p>
            A rota que tentaste aceder encontra-se <span class="status-badge">Offline</span> ou nunca foi registada no sistema.
        </p>
        
        <div class="button-group">
    <!--<button onclick="window.history.back()" class="btn btn-secondary">
                Voltar
            </button>-->
            <a href="/digitalSignage/" class="btn btn-primary">
                Painel Principal
            </a>
        </div>
    </div>

</body>
</html>