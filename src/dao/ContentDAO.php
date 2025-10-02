<?php

class ContentDAO {
    
    private $pdo;
    
    /**
     * agora recebe por PDO 
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    public function save(Content $Object) {
        $sql = $this->pdo->prepare("INSERT INTO content(name,url,fileType) VALUES (:name, :url, :fileType)");  
        $sql->bindValue(':url', $Object->getUrl());
        $sql->bindValue(':name', $Object->getName());
        $sql->bindValue(':fileType', $Object->getFileType());
        $sql->execute();
        return $this->pdo->lastInsertId();
    }
    public function remove($id) {
        $sql = $this->pdo->prepare('DELETE FROM content WHERE id = :id');
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        
    }
    public function listAll() {
        $sql = $this->pdo->query('SELECT * FROM content');
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    
    public function getById($id){
       $sql = $this->pdo->prepare('SELECT * FROM content WHERE id = :id');
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        if($row){
            return new Content($row["url"],$row["name"],$row["fileType"]);
        }
        return null;
    }
    
}