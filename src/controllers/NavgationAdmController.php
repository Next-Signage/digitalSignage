<?php
require_once __DIR__ . '/../service/PlayerService.php';
class NavgationAdmController {
    
    private $pdo;

    /**
     * O construtor recebe a conexão PDO via Injeção de Dependência.
     * Esta conexão será usada para criar os DAOs necessários.
     */
    public function dashboard(){
        
        $caminho = __DIR__ . "/../views/dashboard/dashboard.php";
        $service = new PlayerService();
        $pageData = $service->listAllPlayers();
        
        // Teste de diagnóstico:
        if (!file_exists($caminho)) {
            die("Erro: O PHP não encontrou o arquivo no caminho: " . $caminho);
        }
        
        include $caminho;
        
        
    }
    public function playlists(){
        
         $caminho = __DIR__ . "/../views/dashboard/playlists.php";
         $menu = __DIR__ . "/../views/components/menu.php";

    
        // Teste de diagnóstico:
        if (!file_exists($caminho)) {
            die("Erro: O PHP não encontrou o arquivo no caminho: " . $caminho);
        }
        include $caminho;
    }
    public function playlistConfig(){
        
         $caminho = __DIR__ . "/../views/dashboard/playlist-config.php";
         $menu = __DIR__ . "/../views/components/menu.php";
    
        // Teste de diagnóstico:
        if (!file_exists($caminho)) {
            die("Erro: O PHP não encontrou o arquivo no caminho: " . $caminho);
        }
        include $caminho;
    }


    
}