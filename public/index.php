<?php

require_once(__DIR__ . "/../src/core/Router.php");
require_once(__DIR__ . "/../src/core/Database.php");


require_once(__DIR__ . "/../src/controllers/AuthController.php");
require_once(__DIR__ . "/../src/controllers/NavgationAdmController.php");


$router = new Router();

$router->get("/login",[AuthController::class,"login"]);
$router->get("/exec",[AuthController::class,"exec"]);
$router->get("/v2",[AuthController::class,"viewTeste2"]);
$router->get("/v1",[AuthController::class,"viewTeste1"]);
$router->get("/dashboard",[NavgationAdmController::class,"dashboard"]);
$router->get("/playlists",[NavgationAdmController::class,"playlists"]);
$router->get("/playlistConfig",[NavgationAdmController::class,"playlistConfig"]);

//testando a conexão
try{
    $conectInst = new Database();
    $conectInst->getConnection();
    echo "boa";
}catch( Exception){
    echo"erro";
}

$router->dispach();
