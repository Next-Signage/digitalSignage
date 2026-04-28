<?php
require_once __DIR__ . '/../service/PlaylistConfigService.php';
class PlaylistConfigController{
    
    private $pdo;

    /**
     * O construtor recebe a conexão PDO via Injeção de Dependência.
     * Esta conexão será usada para criar os DAOs necessários.
     */
    public function createPlaylist(){
        
        $json = file_get_contents('php://input');
        
        $data = json_decode($json, true);

        $service = new PlaylistService();
        $data = json_decode($json,true);
        $service->createPlaylist($data);

        header('Content-Type: application/json');
        print_r($data);


    }
    public function deletePlaylist(){
        
        $json = file_get_contents('php://input');
        
        $data = json_decode($json, true);
        $service = new PlaylistService();
        //$service->deletePlaylist($data["playlist_id"]);

        header('Content-Type: application/json');
        
        print_r($data["playlist_id"]);


    }
    
}