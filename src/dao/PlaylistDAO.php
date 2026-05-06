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
        // 1. Inicia uma transação para garantir que ou faz tudo, ou não faz nada
        $this->pdo->beginTransaction();

        // 2. Remove todas as associações atuais dessa playlist
        // Isso permite que se você desmarcar um player no front, ele suma do banco
        $sqlDelete = $this->pdo->prepare("DELETE FROM player_playlists WHERE FK_playlist = :FK_playlist");
        $sqlDelete->bindValue(':FK_playlist', $id_playlist);
        $sqlDelete->execute();

        // 3. Se houver players selecionados, insere as novas associações
        if (!empty($ids_players) && is_array($ids_players)) {
            $sqlInsert = $this->pdo->prepare("INSERT INTO player_playlists(FK_playlist, FK_player) VALUES (:FK_playlist, :FK_player)");
            
            foreach ($ids_players as $id_player) {
                $sqlInsert->bindValue(':FK_playlist', $id_playlist);
                $sqlInsert->bindValue(':FK_player', $id_player);
                $sqlInsert->execute();
            }
        }

        // 4. Confirma as alterações
        $this->pdo->commit();
        return true;

    } catch (Exception $e) {
        // Se algo der errado, desfaz tudo o que foi feito acima
        $this->pdo->rollBack();
        throw new Exception("Erro ao sincronizar playlist: " . $e->getMessage());
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