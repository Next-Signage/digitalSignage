<?php 
    require_once 'config.php';
    require_once 'models/Adm.php';
    class AdmDAO{
        
        private $pdo;
        public function __construct(){
            /*TROCAR O NOME DA CONEXÃO */
            //$this->pdo = getPDO();
        }
        public function save($admObject) {
            $name = $admObject->getName();
            $birthDate = $admObject->getBirthDate();
            $username = $admObject->getUsername();
            $password = $admObject->hashCode();
            $cpf = $admObject->getCpf();
            $email = $admObject->getEmail();
            $admCode = $admObject->getAdmCode();
        
            $sql = $this->pdo->prepare("INSERT INTO adm(name,birthDate,username,password,email,admCode,cpf)VALUES(:name,:birthDate,:username,:password,:email,:admCode,:cpf)");
            $sql->bindValue(':name',$name);
            $sql->bindValue(':birthDate',$birthDate);
            $sql->bindValue(':username',$username);
            $sql->bindValue(':password',$password);
            $sql->bindValue(':cpf',$cpf);
            $sql->bindValue(':email',$email);
            $sql->bindValue(':admCode',$admCode);
            $sql->execute();
        }

        public function update($admObject) {
            $id = $admObject->getId();     
            $name = $admObject->getName();
            $birthDate = $admObject->getBirthDate();
            $username = $admObject->getUsername();
            $password = $admObject->getPassword();
            $cpf = $admObject->getCpf();
            $email = $admObject->getEmail();
            $admCode = $admObject->getAdmCode();

            $sql = $this->pdo->prepare("
            UPDATE adm 
            SET 
                name = :name,
                birthDate = :birthDate,
                username = :username,
                password = :password,
                email = :email,
                admCode = :admCode,
                cpf = :cpf
            WHERE id = :id
            ");

            $sql->bindValue(':id', $id, PDO::PARAM_INT);
            $sql->bindValue(':name', $name);
            $sql->bindValue(':birthDate', $birthDate);
            $sql->bindValue(':username', $username);
            $sql->bindValue(':password', $password);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':admCode', $admCode);
            $sql->bindValue(':cpf', $cpf);

            $sql->execute();
        }

        public function remove($id) {
        $sql = $this->pdo->prepare('DELETE FROM adm WHERE id = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();
        }

        public function listAll() {
            $sql = $this->pdo->query('SELECT * FROM adm');
            $admList = $sql->fetchAll(pdo::FETCH_ASSOC);
            return $admList;
        }
        public function getById($id) {
            $sql = $this->pdo->prepare('SELECT * FROM adm WHERE id = :id');
            $sql->bindValue(':id',$id);
            $sql->execute();
            $elem = $sql->fetchAll(pdo::FETCH_ASSOC);
            return $elem;
        }
    }
?>