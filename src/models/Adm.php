<?php
    require_once 'User.php';
    require_once 'config.php';
    class Adm extends User{
        private $playlist;
        private $player;
        private $admCode;
        private $pdo; 
        public function __construct($id,$name,$birthDate,$username,$password,$cpf,$email,$admCode){
            parent::__construct($id,$name,$birthDate,$username,$password,$cpf,$email);
            $this->admCode = $admCode;
        }
        public function getPlaylist(){
            return $this->playlist;
        }
        public function  getAdmCode(){
            return $this->admCode;
        }
        public function  getPlayer(){
            return $this->admCode;
        }
        public function setPlayer($player){
            $this->player = $player;
        }
        public function setPlaylist($playlist){
            $this->player = $playlist;
        }
        public function setAdmCode($admCode){
            $this->admCode = $admCode;
        }
        public function toString(){
            return parent::toString()."<br>Adm Code:{$this->admCode}";
        }
        public function resetPlayer($player){
        
        }
        public function deletePlayer($player){

        }
        public function alterName($player){

        }
        public function turnOffPlayer($player){

        }
        public function turnOnPlayer($player){

        }
        public function hashCode(){
            $encrypted = password_hash($this->getPassword() , PASSWORD_BCRYPT);
            return $encrypted;
        }
        public function login(){
            $this->pdo = getPDO();
            $email = $this->getEmail();
            $password = $this->getPassword();
            $sql = $this->pdo->prepare('SELECT * FROM adm WHERE email= :email');
            $sql->bindValue(':email',$email);
            $sql->execute();
            $selectEmail = $sql->fetchAll(pdo::FETCH_ASSOC);
        }
}