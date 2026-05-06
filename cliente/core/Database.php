<?php
require_once("config/config.php");
class Database {
    
    private $pdo;

    // construtor publico
    public function __construct() {
        // supondo q config.php já foi carregado no index.php, dá pra usar as constantes que tao definidas la
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
            
        } catch (\PDOException $e) {
            

            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * Retorna a conexão PDO para ser usada.
     * @return PDO
     */
    public function getConnection() {
        return $this->pdo;
    }
}