<?php

class PlayerDAO {
    
    private $pdo;
    
    /**
     * agora recebe por PDO 
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    public function save(Player $Object) {
        $sql = $this->pdo->prepare("INSERT INTO player(name,description,ip_adress,locale,status,playlist) VALUES (:name,:description,:ip_adress,:locale,:status,:playlist)");
        
        $sql->bindValue(':name', $Object->getName());
        $sql->bindValue(':ip_adress', $Object->getIp());
        $sql->bindValue(':locale', $Object->getLocal());
        $sql->bindValue(':playlist', $Object->getPlaylist());
        $sql->bindValue(':description', $Object->getDescription());
        $sql->bindValue(':status', $Object->getStatus());


        $sql->execute();
        return $this->pdo->lastInsertId();
    }
    public function update(Player $Object) {
        $sql = $this->pdo->prepare("UPDATE  player SET name = :name, description = :description, ip_adress = :ip_adress, locale = :locale, status = :status, playlist = :playlist WHERE = player.id = :ip;");
        
        $sql->bindValue(':name', $Object->getName());
        $sql->bindValue(':ip_adress', $Object->getIp());
        $sql->bindValue(':locale', $Object->getLocal());
        $sql->bindValue(':playlist', $Object->getPlaylist());
        $sql->bindValue(':description', $Object->getDescription());
        $sql->bindValue(':status', $Object->getStatus());
        $sql->bindValue(':ip', $Object->getId());


        $sql->execute();
        return $this->pdo->lastInsertId();
    }
    public function remove($id) {
        $sql = $this->pdo->prepare('DELETE FROM player WHERE id = :id');
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        
    }
    public function listAll() {
        $sql = $this->pdo->query('SELECT * FROM player');
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    
    public function getById($id){
       $sql = $this->pdo->prepare('SELECT * FROM player WHERE id = :id');
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        if($row){
            return new Player($row["ip"],$row["name"]);
        }
        return null;
    }
}