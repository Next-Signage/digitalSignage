<?php

class AuthController {
    
    private $pdo;

    /**
     * O construtor recebe a conexão PDO via Injeção de Dependência.
     * Esta conexão será usada para criar os DAOs necessários.
     */
    public function dashboard(){
        die("testando1");
         $caminho = __DIR__ . "/../views/dashboard/dashboard.php";
    
        // Teste de diagnóstico:
        if (!file_exists($caminho)) {
            die("Erro: O PHP não encontrou o arquivo no caminho: " . $caminho);
        }
    
        include $caminho;
    }
    public function playlists(){
        echo"testando2";
         $caminho = __DIR__ . "/../views/dashboard/playlists.php";
    
        // Teste de diagnóstico:
        if (!file_exists($caminho)) {
            die("Erro: O PHP não encontrou o arquivo no caminho: " . $caminho);
        }
        include $caminho;
    }
    public function playlistConfig(){
        echo"testando2";
         $caminho = __DIR__ . "/../views/dashboard/playlist-config.php";
    
        // Teste de diagnóstico:
        if (!file_exists($caminho)) {
            die("Erro: O PHP não encontrou o arquivo no caminho: " . $caminho);
        }
        include $caminho;
    }


    
}