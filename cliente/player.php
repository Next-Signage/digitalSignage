<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once("core/Database.php");
require_once("dao/PlaylistDAO.php");


$ip_servidor = $_SERVER['SERVER_ADDR'];
echo "Eu sou o Player no IP: " . $ip_servidor;


try{
 $db = new  Database();
 $pdo = $db->getConnection();
 $playlistDAO = new PlaylistDAO($pdo);
$playlists = $playlistDAO->listAll();

$onlyPlayersAssoc  = $playlistDAO->listalAllPlayerPlaylist($ip_servidor);
echo "<pre>";
 print_r($onlyPlayersAssoc);
echo "</pre>";
echo "<pre>";
 //print_r($fotos);
$fotos = $playlistDAO->listalAllPlaylistContents($playlists[0]["id"]);
 // eu sei que IP expostos é má prática mas tenho pressa pra acabar
 foreach($fotos as $foto){
    
    print_r($foto["order_index"]);
    $urlServer = str_replace('/opt/lampp/htdocs/', '', $foto["url"]);
    $urlPublica = str_replace('/src/service/../../', '/', $urlServer);

    
    echo "<pre>http://localhost:55/".$urlPublica."\n</pre>";
    echo "<a href =http://localhost:55/".$urlPublica."><img id=".$foto["order_index"]." src=http://localhost:55/".$urlPublica."></a>";
 }
echo "</pre>";

}catch(PDOException){
    echo "deu merda";
    throw new PDOException("Algo de errado"); 
}
?>
<script>
    /*async function atualizarPlaylists() {
    const res = await fetch('player.php');
    const playlists = await res.json();
    console.log(playlists);
    // Aqui você atualiza o DOM (telas, vídeos, etc)
    }*/

// Chama a cada 5 segundos sem travar o navegador
// Recarrega a página agora


// Recarrega a página a cada 5 minutos (300.000 milissegundos)
setTimeout(() => {
    location.reload();
}, 5000);
</script>