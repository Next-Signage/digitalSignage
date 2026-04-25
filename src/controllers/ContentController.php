<?php

class ContentController {
    
    private $pdo;

    /**
     * O construtor recebe a conexão PDO via Injeção de Dependência.
     * Esta conexão será usada para criar os DAOs necessários.
     */
    public function update(){
    // 1. Lê tudo o que veio no túnel do JS
    $jsonRaw = file_get_contents('php://input');
    
    // 2. Transforma em Array do PHP
    $data = json_decode($jsonRaw, true);

    // 3. Avisa o navegador que vamos responder com um JSON
    header('Content-Type: application/json');
        
    // 4. Devolve um pacote dizendo se deu certo e o que chegou
    
    if ($data === null) {
        echo json_encode([
            "status" => "erro",
            "mensagem" => "O PHP não conseguiu ler como JSON",
            "texto_bruto_recebido" => $jsonRaw,
            "erro_json" => json_last_error_msg()
        ]);
    } else {
        echo json_encode([
            "status" => "sucesso_debug",
            "mensagem" => "O PHP leu o JSON perfeitamente!",
            "dados_que_o_php_entendeu" => $data
        ]);
    }
    echo "<pre>";
    echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    echo "</pre>";
    // 5. O exit é crucial para não carregar HTML depois daqui
    exit;
}
}