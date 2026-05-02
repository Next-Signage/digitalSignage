<?php

require_once __DIR__ . '/../dao/AdmDAO.php';

class AuthController {
    
    private $pdo;

    /**
     * O construtor recebe a conexão PDO via Injeção de Dependência.
     * Esta conexão será usada para criar os DAOs necessários.
     */
    public function viewTeste1(){
        echo"testando1";
         $caminho = __DIR__ . "/../views/viewTeste1.html";
    
        // Teste de diagnóstico:
        if (!file_exists($caminho)) {
            die("Erro: O PHP não encontrou o arquivo no caminho: " . $caminho);
        }
    
        include $caminho;
    }
    public function viewTeste2(){
        echo"testando2";
         $caminho = __DIR__ . "/../views/dashboard/viewTeste2.html";
    
        // Teste de diagnóstico:
        if (!file_exists($caminho)) {
        die("Erro: O PHP não encontrou o arquivo no caminho: " . $caminho);
        }
        include $caminho;
    }
    public function login(){
         $caminho = __DIR__ . "/../views/auth/login.php";
    
        // Teste de diagnóstico:
        if (!file_exists($caminho)) {
        die("Erro: O PHP não encontrou o arquivo no caminho: " . $caminho);
        }
        include $caminho;
    }
    public function signup(){
         $caminho = __DIR__ . "/../views/auth/signup.php";
    
        // Teste de diagnóstico:
        if (!file_exists($caminho)) {
        die("Erro: O PHP não encontrou o arquivo no caminho: " . $caminho);
        }
        include $caminho;
    }

    
}