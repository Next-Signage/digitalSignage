<?php
require_once("src/models/Content.php");
require_once("src/models/Player.php");
require_once("src/models/Playlist.php");
    $code = $_POST["code"];
    $tokenHashed = $_GET["act"];
    echo md5($code);
    echo"<br>";
    if(password_verify($code,$tokenHashed)){
        //header("Location:public/index.php");
        $player = new Player("192.168.10.2","salão principal");
        $content = new Content("url!!!","nome",".jpeg");
        $playlist = new Playlist("playlist1",$content);
        $playlist->setPlayer($player);
        echo "<pre>";
        print_r($playlist);
        echo "</pre>";
    }
    echo $tokenHashed;