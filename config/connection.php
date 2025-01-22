<?php



class DatabaseConnection {
    private static ?DatabaseConnection $instance = null;
    private ?PDO $connection = null;

    private function __construct() {
        $this->connect();
    }

    private function connect() {
        $dsn = "mysql:host=" . DB_HOSTNAME . ";dbname=" . DB_NAME . ";charset=utf8mb4";

        try {
            $this->connection = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public static function getInstance(): DatabaseConnection {
        if (self::$instance === null) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    public function getConnection(): ?PDO {
        return $this->connection;
    }
}

$db = DatabaseConnection::getInstance();
$pdo = $db->getConnection();
