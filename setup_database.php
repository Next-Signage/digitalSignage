<?php

/*
    * Pelo amor de deus vamos usar isso aqui só como um seeder
    * inicial. De forma alguma deixar no código em produção, por que
    * qualquer um que tiver acesso a esse arquivo pode resetar o banco
    * de dados e dar uma confusão diabólica. Pro futuro, vamos usar 
    * migrations ou um sistema de seeders mais elaborado, que não
    * dependa de um arquivo PHP acessível publicamente tipo esse kkkkkkkk
    * mas enfim, é importante deixar esse pq o index.php depende da tabela adm
    * e eu mudo muito de computador, então é mais fácil ter esse arquivo
    * do que ficar recriando a tabela toda hora.

    * obrigado pela atencao

*/ 
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/src/core/Database.php';

echo "<h1>Iniciando Setup do Banco de Dados...</h1>";

try {

    $db = new Database();
    $pdo = $db->getConnection();

    echo "<p style='color:blue;'>Conexão com o banco de dados '" . DB_NAME . "' bem-sucedida.</p>";

    $sql = "
    CREATE TABLE adm (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        birthDate DATE NOT NULL,
        username VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        cpf VARCHAR(14) UNIQUE NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        admCode VARCHAR(50) NOT NULL
    );";

    $pdo->exec($sql);

    echo "<p style='color:green;'>Tabela 'adm' criada com sucesso!</p>";

} catch (PDOException $e) {

    echo "<p style='color:red;'>Erro ao criar a tabela: " . $e->getMessage() . "</p>";
    echo "<p style='color:orange;'>Isso pode ser normal se a tabela 'adm' já existir no banco de dados.</p>";
}