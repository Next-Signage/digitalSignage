<?php
    class Player{
        private $id;
        private $ip;
        private $name;
        public function __construct($ip,$name) {
            $this->name = $name;
            $this->ip = $ip;
        }
        public function getId(){
            return $this->id;
        }
        public function getIp(){
            return $this->ip;
        }
        public function getName(){
            return $this->name;
        }
        public function setName($name){
            $this->name = $name;
        }
        public function setIp($ip){
            $this->ip = $ip;
        }
    }