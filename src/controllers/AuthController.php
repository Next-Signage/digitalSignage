<?php

require_once __DIR__ . '/../dao/AdmDAO.php';

class AuthController {
    
    public function login(){
         $caminho = __DIR__ . "/../views/auth/login.php";
    
        // Teste de diagnóstico:
        if (!file_exists($caminho)) {
        throw new Exception("Erro: O PHP não encontrou o arquivo no caminho: " . $caminho);
        }
        include $caminho;
    }
    public function signup(){
         $caminho = __DIR__ . "/../views/auth/signup.php";
    
        // Teste de diagnóstico:
        if (!file_exists($caminho)) {
        throw new Exception("Erro: O PHP não encontrou o arquivo no caminho: " . $caminho);
        }
        include $caminho;
    }

    
}