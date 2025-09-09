<?php

class AdmDAO {
    
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

    public function update(Adm $admObject) {
        $sql = $this->pdo->prepare("
            UPDATE adm 
            SET name = :name, birthDate = :birthDate, username = :username, 
                password = :password, email = :email, admCode = :admCode, cpf = :cpf
            WHERE id = :id
        ");

        $sql->bindValue(':id', $admObject->getId(), PDO::PARAM_INT);
        $sql->bindValue(':name', $admObject->getName());
        $sql->bindValue(':birthDate', $admObject->getBirthDate());
        $sql->bindValue(':username', $admObject->getUsername());
        $sql->bindValue(':password', $admObject->getPassword()); 
        $sql->bindValue(':email', $admObject->getEmail());
        $sql->bindValue(':admCode', $admObject->getAdmCode());
        $sql->bindValue(':cpf', $admObject->getCpf());

        $sql->execute();
    }

    public function remove($id) {
        $sql = $this->pdo->prepare('DELETE FROM adm WHERE id = :id');
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();
    }

    /**
     * Agora são retornados objetos ;)
     * @return Adm[]
     */
    public function listAll() {
        $sql = $this->pdo->query('SELECT * FROM adm');
        // PDO::FETCH_CLASS mapeia as colunas do DB para as propriedades da classe Adm
        return $sql->fetchAll(PDO::FETCH_CLASS, 'Adm');
    }

    /**
     * retorna ou objeto ou false (pra caso não encontre)
     * @return Adm|false
     */
    public function getById($id) {
        $sql = $this->pdo->prepare('SELECT * FROM adm WHERE id = :id');
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        
        $sql->setFetchMode(PDO::FETCH_CLASS, 'Adm');
        return $sql->fetch();
    }

    /**
     * Busca um administrador pelo seu e-mail.
     * Retorna um objeto Adm se encontrar, ou false se não encontrar.
     * @return Adm|false
     */
    public function findByEmail($email) {
        $sql = $this->pdo->prepare('SELECT * FROM adm WHERE email = :email');
        $sql->bindValue(':email', $email);
        $sql->execute();
        
        // Configura o modo de fetch para a classe Adm
        $sql->setFetchMode(PDO::FETCH_CLASS, 'Adm');
        // fetch() retorna o resultado como um objeto Adm, ou false se não encontrar
        return $sql->fetch();
    }

    /**
     * Busca um administrador pelo seu CPF.
     * Retorna um objeto Adm se encontrar, ou false se não encontrar.
     * @return Adm|false
     */
    public function findByCpf($cpf) {
        $sql = $this->pdo->prepare('SELECT * FROM adm WHERE cpf = :cpf');
        $sql->bindValue(':cpf', $cpf);
        $sql->execute();
        
        $sql->setFetchMode(PDO::FETCH_CLASS, 'Adm');
        return $sql->fetch();
    }
}
?>