<?php
    class Content{
        private $id;
        private $url;
        private $name;
        private $fileType;
        public function __construct($url,$name,$fileType) {
            $this->url = $url;
            $this->name = $name;
            $this->fileType = $fileType;
        }
        public function getId(){
            return $this->id;
        }
        public function getUrl(){
            return $this->url;
        }
        public function getName(){
            return $this->name;
        }
        public function getFileType(){
            return $this->fileType;
        }
        public function setUrl($url){
            $this->$url = $url;
        }
        public function setName($name){
            $this->$name = $name;
        }
        public function fileType($fileType){
            $this->$fileType = $fileType;
        }
    }