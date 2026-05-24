<?php
    class Content{
        private $id;
        private $url;
        private $name;
        private $fileType;
        private $dataUpload;
        private $description;

        public function __construct($url,$name,$fileType,$description) {
            $this->url = $url;
            $this->name = $name;
            $this->fileType = $fileType;
            $this->description = $description;

            
        }
        public function getId(){
            return $this->id;
        }
        public function getDescription(){
            return $this->description;
        }
        
        public function getDateUpload(){
            return $this->dataUpload;
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
        
        public function setDescription($description){
            $this->description = $description;
        }
        public function setDateUpload($dataUpload){
            $this->dataUpload = $dataUpload;
        }
    }