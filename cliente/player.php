<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("core/Database.php");
require_once("dao/PlaylistDAO.php");

$ip_servidor = $_SERVER['SERVER_ADDR'];
$port = $_SERVER['SERVER_PORT'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Player</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background-color: #000; /* Fundo preto para painéis */
            overflow: hidden;
        }

        .carousel {
            position: relative;
            width: 100vw;
            height: 100vh;
        }

        .carousel img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain; 
            opacity: 0;
            z-index: 1;
            /* Transição de 1.5s bem suave no canal alfa (transparência) */
            transition: opacity 1.5s ease-in-out; 
        }

        /* A classe active joga a imagem para frente e deixa 100% visível */
        .carousel img.active {
            opacity: 1;
            z-index: 2;
        }

        .debug-logs {
            display: none; 
        }
    </style>
</head>
<body>

<div class="debug-logs">
<?php
    echo "Eu sou o Player no IP: " . $ip_servidor . ":" . $port;
?>
</div>

<div class="carousel">
<?php
try{
    $db = new Database();
    $pdo = $db->getConnection();
    $playlistDAO = new PlaylistDAO($pdo);
    $playlists = $playlistDAO->listAll();

    $onlyPlayersAssoc  = $playlistDAO->listalAllPlayerPlaylist($ip_servidor);
    $fotos = $playlistDAO->listalAllPlaylistContents($playlists[0]["id"]);
     
    foreach($fotos as $index => $foto){
        $urlServer = str_replace('/opt/lampp/htdocs/', '', $foto["url"]);
        $urlPublica = str_replace('/src/service/../../', '/', $urlServer);

        $activeClass = ($index === 0) ? 'active' : '';
        
        echo "<img class='{$activeClass}' id='".$foto["order_index"]."' src='http://localhost:55/".$urlPublica."'>\n";
    }

} catch(PDOException $e) {
    echo "<h1 style='color:red; text-align:center; padding-top:20%;'>deu merda</h1>";
}
?>
</div>

<script>
    const tempoPorSlide = 5000; // 5 segundos parado em cada tela
    const tempoDeTransicao = 1500; // 1.5 segundos de efeito visual (bate com o CSS)
    const imagens = document.querySelectorAll('.carousel img');
    let indexAtual = 0;

    if (imagens.length > 1) {
        setInterval(() => {
            const imgAntiga = imagens[indexAtual];
            
            // Calcula qual é a próxima imagem
            indexAtual = (indexAtual + 1) % imagens.length;
            const imgNova = imagens[indexAtual];

            // 1. A nova imagem vem pra frente e começa a aparecer
            imgNova.classList.add('active');

            // 2. A imagem antiga vai pra trás (z-index 1 via CSS), mas AINDA fica visível
            imgAntiga.style.zIndex = '1';
            
            // 3. Espera a nova imagem terminar de aparecer para só então apagar a antiga
            setTimeout(() => {
                imgAntiga.classList.remove('active');
                imgAntiga.style.zIndex = ''; // Reseta o z-index
            }, tempoDeTransicao);

        }, tempoPorSlide);
    }

    // Calcula o tempo total para dar refresh no PHP e puxar novas mídias do banco
    const tempoTotalPlaylist = imagens.length > 0 ? (imagens.length * tempoPorSlide) : 5000;

    setTimeout(() => {
        location.reload();
    }, tempoTotalPlaylist);
</script>

</body>
</html>