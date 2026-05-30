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
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../src/core/Database.php';
require_once __DIR__ . '/config.php';

echo "<h2>Verifique se a base já existe nos eu banco de dados: digitalSignage_reestruct</h2>";
echo "<h1>Iniciando Setup do Banco de Dados...</h1>";

try {

    $db = new Database();
    $pdo = $db->getConnection();

    echo "<p style='color:blue;'>Conexão com o banco de dados '" . DB_NAME . "' bem-sucedida.</p>";

    $sql = "
     CREATE TABLE IF NOT EXISTS adm ( 
        id int(11) NOT NULL AUTO_INCREMENT, 
        admCode varchar(50) NOT NULL, 
        name varchar(100) NOT NULL, 
        birthDate date NOT NULL, 
        username varchar(50) NOT NULL, 
        password varchar(255) NOT NULL, 
        cpf varchar(14) NOT NULL, 
        email varchar(100) NOT NULL, 
        PRIMARY KEY (id), UNIQUE KEY 
        username (username), UNIQUE KEY 
        cpf (cpf),
        UNIQUE KEY email (email), 
        KEY idx_adm_username (username), 
        KEY idx_adm_password (password) 
    ) ;
    

    CREATE TABLE  IF NOT EXISTS content (
        id int(11) NOT NULL AUTO_INCREMENT,
        url varchar(255) NOT NULL, 
        name varchar(255) NOT NULL, 
        fileType varchar(50) NOT NULL, 
        description varchar(200),
        dataUpload datetime DEFAULT current_timestamp(), 
        PRIMARY KEY (id), 
        KEY idx_adm_content_url (url) 
    ); 

    CREATE TABLE  IF NOT EXISTS player ( 
        id int(11) NOT NULL AUTO_INCREMENT, 
        name varchar(50) NOT NULL, 
        description varchar(255) NOT NULL, 
        ip_adress varchar(100) NOT NULL, 
        locale varchar(50) NOT NULL, 
        status enum('ONLINE','OFFLINE','MAINTENANCE') 
        DEFAULT 'MAINTENANCE', playlist 
        varchar(45) DEFAULT NULL, PRIMARY KEY (id) 
    );

    CREATE TABLE IF NOT EXISTS playlist ( 
        id int(11) NOT NULL AUTO_INCREMENT, 
        name varchar(100) NOT NULL, 
        description varchar(255) DEFAULT NULL, 
        PRIMARY KEY (id) 
    );

    CREATE TABLE IF NOT EXISTS player_playlists ( 
        id int(11) NOT NULL AUTO_INCREMENT, 
        FK_playlist int(11) NOT NULL, 
        FK_player int(11) NOT NULL, PRIMARY KEY (id), 
        UNIQUE KEY FK_player (FK_player,FK_playlist), 
        KEY FK_playlist (FK_playlist), 
        CONSTRAINT player_playlists_ibfk_1 FOREIGN KEY (FK_playlist) REFERENCES playlist (id) ON DELETE CASCADE ON UPDATE CASCADE, 
        CONSTRAINT player_playlists_ibfk_2 FOREIGN KEY (FK_player) REFERENCES player (id) ON DELETE CASCADE ON UPDATE CASCADE 
    );

    

    CREATE TABLE IF NOT EXISTS playlist_content ( 
        id_playlist_content int(11) NOT NULL AUTO_INCREMENT, 
        FK_playlist int(11) NOT NULL, 
        FK_content int(11) NOT NULL, 
        order_index int(11) NOT NULL, 
        duration_seconds int(11) DEFAULT NULL, 
        PRIMARY KEY (id_playlist_content), 
        UNIQUE KEY FK_playlist (FK_playlist,order_index), 
        UNIQUE KEY FK_playlist_2 (FK_playlist,FK_content), 
        KEY playlist_content_ibfk_2 (FK_content), 
        CONSTRAINT playlist_content_ibfk_1 FOREIGN KEY (FK_playlist) REFERENCES playlist (id) ON DELETE CASCADE ON UPDATE CASCADE, 
        CONSTRAINT playlist_content_ibfk_2 FOREIGN KEY (FK_content) REFERENCES content (id) ON DELETE CASCADE ON UPDATE CASCADE 
    ); 
    ";

    $pdo->exec($sql);

    echo "<p style='color:green;'>Tabelas  criadas com sucesso!</p>";

} catch (PDOException $e) {

    echo "<p style='color:red;'>Erro ao criar a tabela: " . $e->getMessage() . "</p>";
    echo "<p style='color:orange;'>Isso pode ser normal se a tabela 'adm' já existir no banco de dados.</p>";
}