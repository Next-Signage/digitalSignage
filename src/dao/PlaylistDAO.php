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
    public function listAll() {
        $sql = $this->pdo->query('SELECT * FROM playlist');
        $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
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