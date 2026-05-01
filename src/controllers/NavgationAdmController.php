<?php
require_once __DIR__ . '/../service/PlayerService.php';
require_once __DIR__ . '/../dao/PlayerDAO.php';

require_once __DIR__ . '/../service/PlaylistService.php';



class NavgationAdmController {
    
    private $pdo;

    /**
     * O construtor recebe a conexão PDO via Injeção de Dependência.
     * Esta conexão será usada para criar os DAOs necessários.
     */
    public function dashboard(){
        
        $caminho = __DIR__ . "/../views/dashboard/dashboard.php";
        $service = new PlayerService();
        $pageData = $service->listAllPlayers();
        
        // Teste de diagnóstico:
        if (!file_exists($caminho)) {
            die("Erro: O PHP não encontrou o arquivo no caminho: " . $caminho);
        }
        
        include $caminho;
        
        
    }
    public function playlists(){
        
         $caminho = __DIR__ . "/../views/dashboard/playlists.php";
         $menu = __DIR__ . "/../views/components/menu.php";
         $service = new PlaylistService();
         $pageData = $service->listAllPlaylists();
    
        // Teste de diagnóstico:
        if (!file_exists($caminho)) {
            die("Erro: O PHP não encontrou o arquivo no caminho: " . $caminho);
        }
        include $caminho;
    }
    public function playlistConfig(){
        $id =  $_GET["id"];
        try{
                $db = new Database();
                $pdo = $db->getConnection();
                $service = new PlaylistDAO($pdo);
                $playlist = $service->getById($id);
                $playlist_contents = $service->listalAllPlaylistContents($id);
                
                $service_player = new PlayerDAO($pdo);
                $players = $service_player->listAll();
                $mediaItems = array_map(function($item) {
                        return [
                            "media_name"        => $item['name'], // mude para o nome real da coluna
                            "media_description" => $item['realName'] ?? "TESTE",
                            "duration"    => $item['duration_seconds'] ?? "11:00",
                            "updated_at"    => $item['dataUpload'] ?? date("d/m/Y"),
                            "media_origin"      => "existing",
                            "media_token"       => "db-" . $item['id'], // um token único baseado no ID
                            "media_source_name" => $item['url'] 
                        ];
                }, $playlist_contents);
                
                $playersId_Elem= [];
                foreach($players as $key => $subElem){
                    $playersId_Elem[$key] = [$subElem["name"]];
                }

                $pageData = [
                    "id_playlist"=>$id,
                    "playlist_name" => $playlist->getName(),
                    "associatedDevices" => $playersId_Elem,

                    "mediaItems" => $mediaItems

                ];
            }catch(PDOException $e){
                throw new Exception($e->getMessage());
            }

        
         $caminho = __DIR__ . "/../views/dashboard/playlist-config.php";
         $menu = __DIR__ . "/../views/components/menu.php";
    
        // Teste de diagnóstico:
        if (!file_exists($caminho)) {
            die("Erro: O PHP não encontrou o arquivo no caminho: " . $caminho);
        }
        include $caminho;
        
    }


    
}