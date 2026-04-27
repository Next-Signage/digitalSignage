<?php
    require_once(__DIR__ . "/../../config/config.php");
    require_once(__DIR__ . "/../core/Database.php");
    require_once(__DIR__ . "/../dao/PlayerDAO.php");
    require_once(__DIR__ . "/../models/Player.php");

    class PlaylistService{
        
        public function createPlaylist($playerArray){
            header('Content-Type: application/json');
            echo "oiiiii" ;
        }
        public function listAllPlayers(){
            try{
                $db = new Database();
                $pdo = $db->getConnection();
                $playerDao = new PlayerDAO($pdo);
                $dispositivosRaw = $playerDao->listAll();
                $devicesFormatted = array_map(function($disp) {
                return [
                    "device_id" => $disp['id'],
                    "device_name" => $disp['name'],
                    // Você precisará de uma lógica para definir se está online/offline
                    // (ex: last_ping < 5 minutos)
                    "device_status" => $disp['status'], 
                    "device_playlist" => $disp['playlist_name'] ?? "", // Nome da playlist vinculada
                    "device_ip" => $disp['ip_adress'],
                    "device_description" => $disp['description']
                ];
            }, $dispositivosRaw);
            $playlists = [];
            return  $pageData = [
                        "playlistOptions" => $playlists,
                        "devices" => $devicesFormatted
                    ];
            }catch(Exception $e){
                throw new Exception("player dao has error");
            }
        }

        
    
    
    }