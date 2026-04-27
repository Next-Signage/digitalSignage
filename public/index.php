<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/../src/core/Router.php");
require_once(__DIR__ . "/../src/core/Database.php");

require_once(__DIR__ . "/../src/controllers/AuthController.php");
require_once(__DIR__ . "/../src/controllers/NavgationAdmController.php");
require_once(__DIR__ . "/../src/controllers/ContentController.php");
require_once(__DIR__ . "/../src/controllers/PlayerController.php");
require_once(__DIR__ . "/../src/controllers/PlaylistController.php");



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
//registerPlayer
$router->post("/deletecontent",[ContentController::class,"deleteContent"]);
$router->post("/registerplayer",[PlayerController::class,"registerPlayer"]);
$router->post("/createpalylist",[PlaylistController::class,"createPlaylist"]);


//testando a conexão

try{
    $conectInst = new Database();
    $conectInst->getConnection();
}catch( Exception){
    throw new Exception("Algo deu errado!");
}

$router->dispach();

?>