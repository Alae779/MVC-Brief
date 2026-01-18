<?php
class Database
{

    private static ?Database $instance = null;

    private ?PDO $pdo;

    private string $host = "localhost";
    private string $username = "root";
    private string $password = "";
    private string $dbname = "istishara";

    private function __construct()
    {
        $dataSourceName = "mysql:host={$this->host};dbname={$this->dbname}";
        $this->pdo = new PDO($dataSourceName, $this->username, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public static function getInstance(): Database
    {
        if (!self::$instance) {
            self::$instance = new Database;
        }
        return self::$instance;
    }
    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}