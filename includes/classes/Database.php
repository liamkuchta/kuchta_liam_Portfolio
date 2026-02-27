<?php
/**
 * Small db helper class.
 * We put PDO stuff in one place so the rest of the app stays cleaner.
 */


namespace Portfolio;

use PDO;
use PDOException;

class Database
{
    /**
     * Keeps one PDO connection around.
     * @var PDO|null
     */
    private $connection;

    /**
     * Run a select query and return rows.
     * Using named binds here so it stays safe.
     */
    public function query(string $query, array $bindings = []): array
    {
        try {
            $connection = $this->connect();
            $statement = $connection->prepare($query);
            
            // bind each value by name
            foreach ($bindings as $key => $value) {
                $statement->bindValue(":" . $key, $value);
            }
            
            // run query then fetch all rows
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            return $results;
        } catch (PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Same as query(), but only returns first row.
     */
    public function queryRow(string $query, array $bindings = []): ?array
    {
        $results = $this->query($query, $bindings);
        return !empty($results) ? $results[0] : null;
    }

    /**
     * Run insert/update/delete statements.
     */
    public function execute(string $query, array $bindings = []): bool
    {
        try {
            $connection = $this->connect();
            $statement = $connection->prepare($query);
            
            foreach ($bindings as $key => $value) {
                $statement->bindValue(":" . $key, $value);
            }
            
            return $statement->execute();
        } catch (PDOException $e) {
            error_log("Database execute error: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Get id from last insert.
     */
    public function lastInsertId(): string
    {
        return $this->connect()->lastInsertId();
    }

    /**
     * Create connection once, then reuse it.
     */
    public function connect(): PDO
    {
        if ($this->connection === null) {
            try {
                $config = $this->getConfig();
                $dsn = $this->getDsn();
                
                $this->connection = new PDO(
                    $dsn,
                    $config['user'],
                    $config['pass'],
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ]
                );
            } catch (PDOException $e) {
                error_log("Connection failed: " . $e->getMessage());
                throw $e;
            }
        }
        
        return $this->connection;
    }

    /**
     * Read db config from env, fallback to local defaults.
     */
    public function getConfig(): array
    {
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT');
        $database = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASS');

        if ($host === false || $host === '') {
            $host = $_ENV['DB_HOST'] ?? ($_SERVER['DB_HOST'] ?? 'localhost');
        }

        if ($port === false || $port === '') {
            $port = $_ENV['DB_PORT'] ?? ($_SERVER['DB_PORT'] ?? '3306');
        }

        if ($database === false || $database === '') {
            $database = $_ENV['DB_NAME'] ?? ($_SERVER['DB_NAME'] ?? 'db_portfolio');
        }

        if ($user === false || $user === '') {
            $user = $_ENV['DB_USER'] ?? ($_SERVER['DB_USER'] ?? 'root');
        }

        if ($pass === false || $pass === '') {
            $pass = $_ENV['DB_PASS'] ?? ($_SERVER['DB_PASS'] ?? 'root');
        }
        
        return [
            'host' => $host,
            'port' => $port,
            'database' => $database,
            'user' => $user,
            'pass' => $pass,
        ];
    }

    /**
     * Build the mysql dsn string.
     */
    public function getDsn(): string
    {
        $config = $this->getConfig();
        
        return sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
            $config['host'],
            $config['port'],
            $config['database']
        );
    }
}
?>
