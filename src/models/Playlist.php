<?php
    class Playlist{
        private $id;
        private $content;
        private $player;
        private $name;
        public function __construct($name,$content) {
            $this->name = $name;
            $this->content= $content;
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
        public function getNName(){
            return $this->name;
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
        public function save(){

        }
        public function update(){

        }
        public function listAll(){

        }
        public function delete(){
            
        }
    }