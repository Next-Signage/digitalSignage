<?php
require_once __DIR__ . '/../service/ContentFilesService.php';
class ContentController {
    
    private $pdo;

    /**
     * O construtor recebe a conexão PDO via Injeção de Dependência.
     * Esta conexão será usada para criar os DAOs necessários.
     */
    public function update(){
    
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);

        $id_playlist = $data['id_playlist'];
        $playlistName = ['playlist_name'] ?? 'Sem nome';
        $mediaFiles = $data['media_files'] ?? [];
        $media_duration = $data['media_duration'];
        $media_description = $data['media_description'];
        

        print_r($media_duration);
        print_r($media_description);

        $service =new  ContentFilesService();
        $service->rollPushFiles($mediaFiles,$id_playlist,$media_duration,$media_description);

        header('Content-Type: application/json');
        echo json_encode(["status" => "success", "received" => $playlistName]);
                

    }
    public function deleteContent(){
        header('Content-Type: application/json');
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);


        $id = (int)preg_replace('/[^0-9]/', '', $data["id"]);
        $service =new  ContentFilesService();
        
        $service->deleteFile($id);
        
        echo json_encode(["status" => "success", "received" => $data]);
        
        

    }
}