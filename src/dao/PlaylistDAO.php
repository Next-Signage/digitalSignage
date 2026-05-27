<?php
require_once(__DIR__ . "/../models/Playlist.php");

class PlaylistDAO {
    
    private $pdo;
    
    /**
     * agora recebe por PDO 
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    public function save(Playlist $playlistObject) {
        $sql = $this->pdo->prepare("INSERT INTO playlist(name, description) VALUES (:name, :description)");
        
        $sql->bindValue(':name', $playlistObject->getName());
        $sql->bindValue(':description', $playlistObject->getDescription());
        
        $sql->execute();
        return $this->pdo->lastInsertId();
    }

   public function savePlayerPlaylist($id_playlist, $ids_players) {
        try {
            // 1. Inicia a transação
            $this->pdo->beginTransaction();

            // 2. Remove as associações atuais
            $sqlDelete = $this->pdo->prepare("DELETE FROM player_playlists WHERE FK_player = :FK_players");
            

            // Pega os dados da playlist
            $sqlNamePlaylist = $this->pdo->prepare('SELECT name FROM playlist WHERE id = :FK_playlist');
            $sqlNamePlaylist->bindValue(':FK_playlist', $id_playlist);
            $sqlNamePlaylist->execute();
            
            $resultPlaylist = $sqlNamePlaylist->fetch(PDO::FETCH_ASSOC);
            
            // CORREÇÃO 1: Extrai apenas a string (o nome) do array, validando se a playlist existe
            $namePlaylist = $resultPlaylist ? $resultPlaylist['name'] : 'Sem Nome'; 
            
            // 3. Insere as novas associações
            if (!empty($ids_players) && is_array($ids_players)) {
                
                // CORREÇÃO 2: Separa o INSERT e o UPDATE em prepares distintos
                $sqlInsert = $this->pdo->prepare("INSERT INTO player_playlists(FK_playlist, FK_player) VALUES (:FK_playlist, :FK_player)");
                $sqlUpdate = $this->pdo->prepare("UPDATE player SET playlist = :nameplaylist WHERE id = :FK_player");
                
                foreach ($ids_players as $id_player) {
                    // executa o delete das associacoes existentes:
                    $sqlDelete->bindValue(':FK_players', $id_player);
                    $sqlDelete->execute();
                    // Executa o INSERT
                    $sqlInsert->bindValue(':FK_playlist', $id_playlist);
                    $sqlInsert->bindValue(':FK_player', $id_player);
                    $sqlInsert->execute();

                    // Executa o UPDATE
                    $sqlUpdate->bindValue(':nameplaylist', $namePlaylist);
                    $sqlUpdate->bindValue(':FK_player', $id_player);
                    $sqlUpdate->execute();
                }
            }

            // 4. Confirma as alterações
            $this->pdo->commit();
            return true;

        } catch (Exception $e) {
            // Se algo der errado, desfaz tudo e joga a mensagem REAL do banco para facilitar o debug
            $this->pdo->rollBack();
            throw new Exception("Erro no DAO ao sincronizar playlist: " . $e->getMessage());
        }
    }
    
    public function listAll() {
        $sql = $this->pdo->query('SELECT * FROM playlist');
        $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    public function listalAllPlaylistContents($id){
        $sql = $this->pdo->prepare('SELECT * FROM content INNER JOIN playlist_content on content.id  = FK_content and :id = FK_playlist;');
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    public function remove($id) {
        $sql = $this->pdo->prepare('DELETE FROM playlist WHERE id = :id');
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        
    }
    public function getById($id){
    
        $sql = $this->pdo->prepare('SELECT * FROM playlist WHERE id = :id;');
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        if($row){
            
            return new Playlist($row["name"],$row["description"]);
        }
            
        return null;
    }

}