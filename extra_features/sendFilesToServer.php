<?php
require_once("config/config.php");
require_once("src/core/Database.php");
require_once("src/dao/ContentDAO.php");
require_once("src/models/Content.php");

$db = new Database();
$pdo = $db->getConnection();
$contentDao = new ContentDAO($pdo);


function  pushFiles($name,$tmp_name, $size,$error){
    require_once("config/config.php");
    
    require_once("src/core/Database.php");
    require_once("src/dao/ContentDAO.php");
    require_once("src/models/Content.php");
    if ($size > 5242880){
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
if (isset($_FILES["file"])){
    $file = $_FILES["file"];
    
    foreach($file["name"] as $index => $arq){
        if(pushFiles($file["name"][$index],$file["tmp_name"][$index],$file["size"][$index],$file["error"][$index])){

        }
    }
}
if(isset($_GET["deletar"])){
    $id = intval($_GET["deletar"]);
    $content = $contentDao->getById($id);
    unlink($content->getUrl());
    $contentDao->remove($id);
    
    
}
    

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Upload de Arquivos</title>
</head>
<body>
    <h2>Enviar Arquivo</h2>
    <form action="sendFilesToServer.php" method="POST" enctype="multipart/form-data">
        <label>Tempo de exibição da imagem</label>
        <input name = "num" type="number" step="0.1" name="name" required><br><br>

        <label>Escolha o arquivo:</label>
        <input multiple type="file" name="file[]" required><br><br>

        <button type="submit">Enviar</button>
    </form>
    <table border = "1" cellpadding="10">
        <thead>
            <th>Preview</th>
            <th>ID</th>
            <th>nome</th>
            <th>Extensão</th>
        </thead>
        <tbody>
            <?php
            foreach($contentDao->listAll()as $arq){
            ?>
            <tr>
            <td><img width="80" height="80" src="<?=$arq['url']?>" alt="" srcset=""></td>      
            <td><?=$arq["id"]?></td>      
            <td><?=$arq["name"]?></td>      
            <td><?=$arq["fileType"]?></td>      
            <th><a href="sendFilesToServer.php?deletar=<?=$arq["id"]?>">Excluir</a></th>  
            </tr>    
            <?php
            }
            ?>
        </tbody>
    </table>
    
    
</body>
</html>
