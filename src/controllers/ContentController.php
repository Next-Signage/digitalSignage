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
        $playlistName = ['playlist_name'] ?? 'Sem nome';
        $mediaFiles = $data['media_files'] ?? [];
        
        $service =new  ContentFilesService();
        $service->rollPushFiles($mediaFiles);
        header('Content-Type: application/json');
        echo json_encode(["status" => "success", "received" => $playlistName]);
        
        

    }
}