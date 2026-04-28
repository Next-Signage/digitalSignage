<?php
    class Playlist{
        private $id;
        private $content;
        private $player;
        private $name;
        private $description;

        public function __construct($name,$description) {
            $this->name = $name;
            $this->description= $description;
        }
        public function getId(){
            return $this->id;
        } 
        public function getContent(){
            return $this->content;
        } 
        public function getPlayer(){
            return $this->player;
        }
        public function getName(){
            return $this->name;
        } 
        public function getDescription(){
            return $this->description;
        } 
        public function setDescription($description){
            $this->description = $description;
        }
        public function setContent($content){
            $this->content = $content;
        }
        public function setPlayer($player){
            $this->player = $player;
        }
        public function setName($name){
            $this->name = $name;
        }
        
    }