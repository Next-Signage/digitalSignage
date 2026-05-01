<?php
    class Content{
        private $id;
        private $url;
        private $name;
        private $fileType;
        private $realName;
        private $dataUpload;
        public function __construct($url,$name,$fileType,$realName) {
            $this->url = $url;
            $this->name = $name;
            $this->fileType = $fileType;
            $this->realName = $realName;
            
        }
        public function getId(){
            return $this->id;
        }
        public function getRealName(){
            return $this->realName;
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
        public function setRealName($realName){
            $this->realName = $realName;
        }
        public function setDateUpload($dataUpload){
            $this->dataUpload = $dataUpload;
        }
    }