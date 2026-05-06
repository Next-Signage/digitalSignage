<?php
require_once __DIR__ . '/../service/PlaylistService.php';
class PlaylistController{
    
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
        $service->deletePlaylist($data["playlist_id"]);

        header('Content-Type: application/json');
        print_r($data);


    }
    public function associate(){
        
        $json = file_get_contents('php://input');
        echo "oi";
        $data = json_decode($json, true);
        print_r($data);
        $service = new PlaylistService();
        $service->playlistAssoc($data["id_playlist"],$data["device_ids"]);

        header('Content-Type: application/json');
        
        print_r($data["device_ids"]);


    }
    
}