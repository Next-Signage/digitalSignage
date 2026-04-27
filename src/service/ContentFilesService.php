<?php
    require_once(__DIR__ . "/../../config/config.php");
    require_once(__DIR__ . "/../core/Database.php");
    require_once(__DIR__ . "/../dao/ContentDAO.php");
    require_once(__DIR__ . "/../models/Content.php");

    class ContentFilesService{
        
        const SIZE_LIMIT = 5242880;
        // size é em bytes
        //valor / 1024 = valorkb
        //5mb = 5*1024kb*1024

        public function rollPushFiles($mediaFiles){
            $results = [];
            foreach($mediaFiles as $fileData){
                try{
                    self::pushFiles($fileData);
                    $results[] = ["status" => "sucess","file"=>$fileData['name']];
                }catch(Exception $e){
                    $results[] = ["status" => "error","file" => $fileData['name'],
                    "message" => $e->getMessage()];
                }
                
            }
            return $results;
            
        }
        public static function listContents(){
            try{
                $db = new Database();
                $pdo = $db->getConnection();
                $contentDao = new ContentDAO($pdo);
                $medias = $contentDao->listAll();
                $pageData = [
                "playlist_name" => "teste",
                "associatedDevices" => "teste",
                "mediaItems" => array_map(function($m) {
                    return [
                        "media_name" => $m['filename'],
                        "media_description" => $m['description'],
                        "media_added_at" => date('d/m/Y', strtotime($m['created_at'])),
                        "media_duration" => $m['duration'], // Formato "mm:ss"
                        "media_origin" => "existing",
                        "media_token" => $m['token'],
                        "media_source_name" => $m['original_name']
                    ];
                }, $medias)
            ];
            }catch (Exception $e){
                return $e->getMessage();
            }
            
        }
        public static function pushFiles($fileData){
            $name = $fileData['name'];
            $base64code = $fileData['base64'];
            $extensoesPermitidas = ["jpg", "jpeg", "png"];
            $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            
            //tratamento da base64

            if (strpos($base64code, ',') !== false) {
            $partes = explode(',', $base64code);
            $dadosBase64 = $partes[1];
            } else {
            $dadosBase64 = $base64code;
            }
            // convertendo pra binário
            $arquivoBinario = base64_decode($dadosBase64);

            if($arquivoBinario === false){
                throw new Exception("Falha ao decodificar o arquivo Base64");
            }
            $filesize = strlen($arquivoBinario);
            if($filesize > self::SIZE_LIMIT){
                throw new Exception("Arquivo muito grande! O limite é de 5MB.");
            }

            if (!in_array($extension, $extensoesPermitidas)) {
                throw new Exception("Tipo de arquivo não aceito. Apenas JPG e PNG.");
            }
            $path = __DIR__ . '/../../public/uploads/';
            $arqName = "NextSignage_" . uniqid();
            $url = $path . $arqName . "." . $extension;

            if (file_put_contents($url, $arquivoBinario)) {
                $content = new Content($url, $arqName, $extension);
                try{
                    $db = new Database();
                    $pdo = $db->getConnection();
                    $contentDao = new ContentDAO($pdo);
                    $contentDao->save($content);
                    return true;
                }catch(\PDOException $e){

                }
            }else{
                throw new Exception("Falha ao mover o arquivo para a pasta uploads.");
            }
           

            
        }

        
    public function deleteFile($id){
        if(!$id){
            throw new Exception("ID não fornecido para exclusão.");
        }
        $db = new Database();
        $pdo = $db->getConnection();
        $contentDao = new ContentDAO($pdo);
        $content = $contentDao->getById($id);
        if($content){
            if (file_exists($content->getUrl())) {
                unlink($content->getUrl());
            }
             $contentDao->remove($id);
        }
        
    }
        
    
}