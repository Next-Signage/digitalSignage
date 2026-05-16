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

//get method

$router->get("/login",[AuthController::class,"login"]);
$router->get("/signup",[AuthController::class,"signup"]);
$router->get("/v2",[AuthController::class,"viewTeste2"]);
$router->get("/v1",[AuthController::class,"viewTeste1"]);
$router->get("/dashboard",[NavgationAdmController::class,"dashboard"]);
$router->get("/playlists",[NavgationAdmController::class,"playlists"]);
$router->get("/playlistconfig",[NavgationAdmController::class,"playlistConfig"]);


//post method 
$router->post("/update",[ContentController::class,"update"]);
$router->post("/deletecontent",[ContentController::class,"deleteContent"]);
$router->post("/registerplayer",[PlayerController::class,"registerPlayer"]);

$router->post("/updateplayer",[PlayerController::class,"updatePlayer"]);

$router->post("/associate",[PlaylistController::class,"associate"]);

$router->post("/createplaylist",[PlaylistController::class,"createPlaylist"]);

$router->post("/deleteplaylist",[PlaylistController::class,"deletePlaylist"]);




//testando a conexão

try{
    $conectInst = new Database();
    $conectInst->getConnection();
}catch( Exception){
    throw new Exception("Algo deu errado! -  Conexão com o banco NÃO estabelecida");
}

$router->dispach();

?>