<?php
    require_once __DIR__ . '/config/config.php';
    require_once __DIR__ . '/src/core/Database.php';
    $token = $__GET["token"];
    $db = new Database();
    $pdo = $db->getConnection();
    $sql = $pdo->prepare("SELECT * FROM redefinicoes WHERE token = :token");
    $sql->bindValue(":token",$token);
    $sql->execute();
    $sql->fetchAll(PDO::FETCH_CLASS, 'redefinicoes');
    echo "<pre>";
    print_r($sql);
    echo "</pre>";