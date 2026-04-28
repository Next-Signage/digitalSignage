<?php
    class Player{
        private $id;
        private $ip;
        private $name;
        private $local;
        private $description;
        private $playlist;
        private $status;


        public function __construct($ip,$name,$local,$description,$playlist,$status) {
            $this->name = $name;
            $this->ip = $ip;
            $this->local = $local;
            $this->description = $description;
            $this->$playlist = $playlist;
            $this->status = $status;


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
        public function getLocal(){
            return $this->local;
        }
        public function getDescription(){
            return $this->description;
        }
        public function getPlaylist(){
            return $this->playlist;
        }
        public function getStatus(){
            return $this->playlist;
        }

        public function setName($name){
            $this->name = $name;
        }
        public function setIp($ip){
            $this->ip = $ip;
        }
        public function setLocal($local){
            $this->local = $local;
        }
        public function setDescription($description){
            $this->description = $description;
        }
        public function setPlayer($playlist){
            $this->playlist = $playlist;
        }
        public function setStatus($status){
            $this->status = $status;
        }

        
    }