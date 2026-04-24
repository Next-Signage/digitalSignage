<?php

require_once(__DIR__ . "/../src/core/Router.php");
require_once(__DIR__ . "/../src/core/Database.php");


require_once(__DIR__ . "/../src/controllers/AuthController.php");
require_once(__DIR__ . "/../src/controllers/NavgationAdmController.php");
require_once(__DIR__ . "/../src/controllers/ContentController.php");

var_dump($_POST);
var_dump($_FILES);


$router = new Router();
// o nome a rota deve estar em minusculo
$router->get("/login",[AuthController::class,"login"]);
$router->get("/exec",[AuthController::class,"exec"]);
$router->get("/v2",[AuthController::class,"viewTeste2"]);
$router->get("/v1",[AuthController::class,"viewTeste1"]);
$router->get("/dashboard",[NavgationAdmController::class,"dashboard"]);
$router->get("/playlists",[NavgationAdmController::class,"playlists"]);
$router->get("/playlistconfig",[NavgationAdmController::class,"playlistConfig"]);
$router->post("/update",[ContentController::class,"update"]);

echo $router->listAllRoutesPOST();

//testando a conexão

try{
    $conectInst = new Database();
    $conectInst->getConnection();
    echo "Todos os direitos reservados";
}catch( Exception){
    echo"erro";
}

$router->dispach();

?>
<!--Aqui é apenas para testes....... futuramente o index conterá apenas os códigos de rota verificano se existe login
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Boas-vindas</title>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
    }

    body {
        background: #f4f4f6;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        background: white;
        padding: 40px;
        border-radius: 16px;
        width: 420px;
        text-align: center;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .logo {
        width: 60px;
        height: 60px;
        margin: 0 auto 20px;
        border-radius: 12px;
        background: linear-gradient(135deg, #ff0066, #ff3b3b);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 24px;
    }

    h1 {
        margin-bottom: 10px;
        font-size: 24px;
        color: #333;
    }

    p {
        color: #666;
        margin-bottom: 30px;
        font-size: 14px;
    }

    .stats {
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
        gap: 10px;
    }

    .card {
        flex: 1;
        padding: 12px;
        border-radius: 10px;
        color: white;
        font-size: 13px;
    }

    .devices {
        background: linear-gradient(135deg, #ff0066, #d1005b);
    }

    .online {
        background: #28a745;
    }

    .offline {
        background: #ff3b3b;
    }

    .btn {
        display: block;
        width: 100%;
        padding: 12px;
        border-radius: 10px;
        border: none;
        font-size: 14px;
        cursor: pointer;
        margin-bottom: 10px;
        transition: 0.2s;
    }

    .primary {
        background: #ff0066;
        color: white;
    }

    .primary:hover {
        background: #e0005a;
    }

    .secondary {
        background: #eaeaea;
        color: #333;
    }

    .secondary:hover {
        background: #dcdcdc;
    }

</style>
</head>

<body>

<div class="container">
    <div class="logo">DS</div>

    <h1>Bem-vindo ao sistema</h1>
    <p>Gerencie seus dispositivos e playlists de forma simples e eficiente.</p>

    <div class="stats">
        <div class="card devices">
            <strong>4</strong><br>Dispositivos
        </div>
        <div class="card online">
            <strong>2</strong><br>Online
        </div>
        <div class="card offline">
            <strong>2</strong><br>Offline
        </div>
    </div>

    <button class="btn primary">Acessar painel</button>
    <button class="btn secondary">Ver documentação</button>
</div>

</body>
</html>
-->