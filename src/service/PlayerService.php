<?php
    require_once(__DIR__ . "/../../config/config.php");
    require_once(__DIR__ . "/../core/Database.php");
    require_once(__DIR__ . "/../dao/PlayerDAO.php");
    require_once(__DIR__ . "/../dao/PlaylistDAO.php");

    require_once(__DIR__ . "/../models/Player.php");

    class PlayerService{
        
        public function createPlayer($playerArray){

            $name = $playerArray["device_name"];
            $ip = $playerArray["device_ip"];
            $local = $playerArray["device_location"];
            $playlist = $playerArray["device_playlist"];
            $description = $playerArray["device_description"];
            $status = 'online';
            $player  = new Player($ip,$name,$local,$description,$playlist,$status);
            try{
                $db = new Database();
                $pdo = $db->getConnection();
                $playerDao = new PlayerDAO($pdo);
                $playerDao->save($player);
            }catch(Exception $e){
                throw new Exception("player dao has error");
            }
        }
        public function listAllPlayers(){
            try{
                $db = new Database();
                $pdo = $db->getConnection();

                $playerDao = new PlayerDAO($pdo);
                $dispositivosRaw = $playerDao->listAll();
                $playlistDao= new  PlaylistDAO($pdo);
                $playlists = $playlistDao->listAll();

                $playlistsFormatted =[];
                $i = 0;
                foreach ($playlists as $key => $value) {
                    $playlistsFormatted[$i] = [($value["name"])];
                    $i++;
                }
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
            
            return  $pageData = [
                        "playlistOptions" => $playlistsFormatted,
                        "devices" => $devicesFormatted
                    ];
            }catch(Exception $e){
                throw new Exception("player dao has error");
            }
        }

        
    
    
    }