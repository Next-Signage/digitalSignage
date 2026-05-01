<?php
require_once __DIR__ . '/../service/ContentFilesService.php';
class ContentController {
    
    private $pdo;

    /**
     * O construtor recebe a conexão PDO via Injeção de Dependência.
     * Esta conexão será usada para criar os DAOs necessários.
     */
    public function update(){
        //teste
        

        $json = file_get_contents('php://input');
        $data = json_decode($json,true);

        
        $id_playlist = $data['id_playlist'];
        $playlistName = ['playlist_name'] ?? 'Sem nome';
        $mediaFiles = $data['media_files'] ?? [];
        
        $service =new  ContentFilesService();
        $service->rollPushFiles($mediaFiles,$id_playlist);
        header('Content-Type: application/json');
        //echo $service->listContents();
        echo json_encode(["status" => "success", "received" => $playlistName]);
        
        

    }
    public function deleteContent(){
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);

        
        /*$service =new  ContentFilesService();
        $service->deleteFile($mediaFiles);*/
        header('Content-Type: application/json');
        echo json_encode(["status" => "success", "received" => $data]);
        
        

    }
}