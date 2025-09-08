<?php

require_once __DIR__ . '/../../config/config.php';

$nome_usuario = htmlspecialchars($_SESSION['user_name']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - <?php echo $nome_usuario; ?></title>
    <style>
        body { font-family: sans-serif; padding: 20px; text-align: center; }
        .container { max-width: 800px; margin: auto; border: 1px solid #ccc; padding: 20px; border-radius: 8px; }
        a { color: #d9534f; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bem-vindo, <?php echo $nome_usuario; ?>!</h1>
        <p>Se você está aqui, significa que está autenticado.</p>
        <br>
        
        <p><a href="<?php echo BASE_URL; ?>/logout">Sair (Logout)</a></p>

    </div>
</body>
</html>