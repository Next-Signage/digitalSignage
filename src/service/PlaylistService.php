<?php
    require_once(__DIR__ . "/../../config/config.php");
    require_once(__DIR__ . "/../core/Database.php");
    require_once(__DIR__ . "/../dao/PlaylistDAO.php");
    require_once(__DIR__ . "/../models/Playlist.php");

    class PlaylistService{
        
       public function createPlaylist($playlistrArray){

            $name = $playlistrArray["playlist_name"];
            $description = $playlistrArray["playlist_description"];
            
            $player  = new Playlist($name,$description);
            try{
                $db = new Database();
                $pdo = $db->getConnection();
                $playlistDao = new PlaylistDAO($pdo);
                $playlistDao->save($player);
            }catch(Exception $e){
                throw new Exception("player dao has error");
            }
            
            


        }
        public function listAllPlaylists(){
            try{
                $db = new Database();
                $pdo = $db->getConnection();
                $playerDao = new PlaylistDao($pdo);
                $playlistRaw = $playerDao->listAll();
                $devicesFormatted = array_map(function($disp) {
                return [
                    "playlist_id" => $disp['id'],
                    "playlist_name" => $disp['name'],

                    "playlist_description" => $disp['description']
                    // Você precisará de uma lógica para definir se está online/offline
                    // (ex: last_ping < 5 minutos)
                ];
            }, $playlistRaw);
            $playlists = [];
            return  $pageData = [
                        
                        "playlists" => $devicesFormatted
                    ];
            }catch(Exception $e){
                throw new Exception("player dao has error");
            }
        }
        public function deletePlaylist($id){
            try{
                $db = new Database();
                $pdo = $db->getConnection();
                $playerDao = new PlaylistDao($pdo);
                $playerDao->remove($id);
                
            }catch(Exception $e){
                throw new Exception("playlist dao has error");
            }

        }
        public function playlistAssoc($id_playlist, $ids_players){
            try{
                $db = new Database();
                $pdo = $db->getConnection();
                $playerDao = new PlaylistDao($pdo);
                $playerDao->savePlayerPlaylist($id_playlist,$ids_players);
                
            }catch(Exception $e){
                echo "não foi";
                throw new Exception("playlist dao has error");
            }

        }
        
        
    
    
    }