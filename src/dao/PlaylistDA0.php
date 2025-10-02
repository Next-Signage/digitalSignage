<?php

class PlaylistDAO {
    
    private $pdo;
    
    /**
     * agora recebe por PDO 
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
      public function save(Adm $admObject) {
        $sql = $this->pdo->prepare("INSERT INTO adm(name, birthDate, username, password, email, admCode, cpf) VALUES (:name, :birthDate, :username, :password, :email, :admCode, :cpf)");
        
        $sql->bindValue(':name', $admObject->getName());
        $sql->bindValue(':birthDate', $admObject->getBirthDate());
        $sql->bindValue(':username', $admObject->getUsername());
        $sql->bindValue(':password', $admObject->getPassword());
        $sql->bindValue(':cpf', $admObject->getCpf());
        $sql->bindValue(':email', $admObject->getEmail());
        $sql->bindValue(':admCode', $admObject->getAdmCode());
        
        $sql->execute();
        return $this->pdo->lastInsertId();
    }
}