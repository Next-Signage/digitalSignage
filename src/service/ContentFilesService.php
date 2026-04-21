<?php
    require_once("config/config.php");
    require_once("src/core/Database.php");
    require_once("src/dao/ContentDAO.php");
    require_once("src/models/Content.php");

    class ContentFilesService{
        
        const SIZE_LIMIT = 5242880;
        
        public function rollPushFiles(){
            if (isset($_FILES["file"])){
            $file = $_FILES["file"];

            foreach($file["name"] as $index => $arq){
                if(pushFiles($file["name"][$index],$file["tmp_name"][$index],$file["size"][$index],$file["error"][$index])){

                }
            }
        }
        }
        
        public static function pushFiles($name,$tmp_name, $size,$error){
            /*require_once("config/config.php");

            require_once("src/core/Database.php");
            require_once("src/dao/ContentDAO.php");
            require_once("src/models/Content.php");*/
            if ($size > self::SIZE_LIMIT){
                die("Arquivo muito grande!!!");
            }
            if ($error){
                die("Falha ao enviar!!!");
            }
            $path = "uploads/";
            $arqName ="NextSignage_".uniqid();

            $extension = strtolower(pathinfo($name,PATHINFO_EXTENSION));
            $url = $path.$arqName.".".$extension;
            if($extension != "jpg" && $extension != "png"){
                die("tipo de arquivo não aceito");
            }
            if(move_uploaded_file($tmp_name,$url)){
                echo "<a target='\_blank\' href=\"uploads/$arqName.$extension\">deu certo, abra!!</a>";
                $content = new Content($url,$arqName,$extension);
                try{
                    $db = new Database();
                    $pdo = $db->getConnection();
                    $contentDao = new ContentDAO($pdo);
                    $contentDao->save($content);
                    return true;
                }catch (\PDOException $e) {
                    throw new \PDOException($e->getMessage(), (int)$e->getCode());
                    return false;
                }

            
            }else{
                return false;
            }
        }

        // size é em bytes
        //valor / 1024 = valorkb
        //5mb = 5*1024kb*1024
        
    public function deleteContent(){
        $db = new Database();
        $pdo = $db->getConnection();
        $contentDao = new ContentDAO($pdo);
        if(isset($_GET["deletar"])){
            $id = intval($_GET["deletar"]);
            $content = $contentDao->getById($id);
            unlink($content->getUrl());
            $contentDao->remove($id);


        }
    }
        
    
}