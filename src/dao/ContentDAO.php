<?php

class ContentDAO {
    
    private $pdo;
    
    /**
     * agora recebe por PDO 
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    public function save(Content $Object, int $playlistId) {
        //ORDEM DE DURAÇÃO PRECISA DE AJUDA
        try{
            $this->pdo->beginTransaction();
            $sql = $this->pdo->prepare("INSERT INTO content(name,url,fileType,realName) VALUES (:name, :url, :fileType,:realName);");  
            $sql->bindValue(':url', $Object->getUrl());
            $sql->bindValue(':name', $Object->getName());
            $sql->bindValue(':fileType', $Object->getFileType());
            $sql->bindValue(':realName', $Object->getRealName());
            $sql->execute();

            $lastId = $this->pdo->lastInsertId();
            // SALVAR O ORDER_INDEX
            // SAVAR DURATION SECONDS
            // SALVAR  
            $sql2 = $this->pdo->prepare("INSERT INTO playlist_content(FK_playlist,FK_content,order_index) VALUES (:FK_playlist, :FK_content,:order_index)");  
            $sql2->bindValue(':FK_playlist', $playlistId);
            $sql2->bindValue(':FK_content', $lastId);
            $sql2->bindValue(':order_index', $lastId+1);

            $sql2->execute();

            $this->pdo->commit();
            return $lastId;
        }catch(\PDOException $e){
            $this->pdo->rollBack();
            throw new \Exception("Erro ao salvar conteúdo e vincular à playlist: " . $e->getMessage());
            
        }
        
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
            return new Content($row["url"],$row["name"],$row["fileType"],$row["realName"],$row["dataUpload"]);
        }
        return null;
    }
    
}