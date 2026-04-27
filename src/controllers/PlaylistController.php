<?php
require_once __DIR__ . '/../service/PlayerService.php';
class PlaylistController{
    
    private $pdo;

    /**
     * O construtor recebe a conexão PDO via Injeção de Dependência.
     * Esta conexão será usada para criar os DAOs necessários.
     */
    public function createPlaylist(){
        $json = file_get_contents('php://input');
        
        $data = json_decode($json, true);

        header('Content-Type: application/json');
        print_r($data);


    }
    
}