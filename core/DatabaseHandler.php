
<?php

class DatabaseHandler
{
    private static $connection;
    private static $config;

    public static function init()
    {
        // Tenta carregar configuração local primeiro, senão usa a padrão
        $localConfig = __DIR__ . "/../config/database.local.php";
        if (file_exists($localConfig)) {
            self::$config = require $localConfig;
            System::log("Using local database configuration.");
        } else {
            self::$config = require __DIR__ . "/../config/database.config.php";
            System::log("Using default database configuration.");
        }
        self::connect();
        System::log("DatabaseHandler initialized.");
    }

    private static function connect()
    {
        $driver = self::$config["driver"];
        $host = self::$config["host"];
        $database = self::$config["database"];
        $username = self::$config["username"];
        $password = self::$config["password"];
        $charset = self::$config["charset"];
        $collation = self::$config["collation"];

        try {
            if ($driver === 'mysql') {
                $dsn = "mysql:host={$host};dbname={$database};charset={$charset}";
                self::$connection = new PDO($dsn, $username, $password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                self::$connection->exec("SET NAMES '{$charset}' COLLATE '{$collation}'");
            } else if ($driver === 'sqlite') {
                $dsn = "sqlite:" . __DIR__ . "/../" . $database; // Assuming database is a file path for SQLite
                self::$connection = new PDO($dsn);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } else {
                throw new Exception("Unsupported database driver: {$driver}");
            }
            System::log("Database connection established successfully with driver: {$driver}.");
        } catch (PDOException $e) {
            System::log("Database connection failed: " . $e->getMessage(), "warning");
            System::log("System will continue without database connection for testing purposes.", "info");
            self::$connection = null;
        } catch (Exception $e) {
            System::log("Database error: " . $e->getMessage(), "warning");
            System::log("System will continue without database connection for testing purposes.", "info");
            self::$connection = null;
        }
    }

    public static function getConnection()
    {
        return self::$connection;
    }

    public static function query($sql, $params = [])
    {
        global $config;
        if (self::$connection === null) {
            System::log("Database not connected. Query skipped: " . $sql, "warning");
            return null;
        }
        if ($config["debug"]) {
            System::log("SQL Query: " . $sql . " Params: " . json_encode($params), "debug");
        }
        $stmt = self::$connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}

class QueryBuilder
{
    private $table;
    private $query = "";
    private $bindings = [];

    public function __construct($table)
    {
        $this->table = $table;
    }
    
    public function select($columns = ["*"])
    {
        $this->query = "SELECT " . implode(", ", $columns) . " FROM {$this->table}";
        return $this;
    }

    public function where($column, $operator, $value)
    {
        if (strpos($this->query, "WHERE") === false) {
            $this->query .= " WHERE ";
        } else {
            $this->query .= " AND ";
        }
        $this->query .= "{$column} {$operator} ?";
        $this->bindings[] = $value;
        return $this;
    }

    public function insert($data)
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $this->query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $this->bindings = array_values($data);
        return $this;
    }

    public function update($data)
    {
        $set = [];
        foreach ($data as $column => $value) {
            $set[] = "{$column} = ?";
            $this->bindings[] = $value;
        }
        $this->query = "UPDATE {$this->table} SET " . implode(", ", $set);
        return $this;
    }

    public function delete()
    {
        $this->query = "DELETE FROM {$this->table}";
        return $this;
    }

    public function get()
    {
        $stmt = DatabaseHandler::query($this->query, $this->bindings);
        if ($stmt === null) {
            return [];
        }
        return $stmt->fetchAll();
    }

    public function execute()
    {
        $stmt = DatabaseHandler::query($this->query, $this->bindings);
        if ($stmt === null) {
            return false;
        }
        return $stmt;
    }
}



//$query = new QueryBuilder("users");
//$result = $query->select()->where("id", "=", 1)->get();
//$insert = $query->insert(["name" => "John Doe", "email" => "BwK8B@example.com"])->execute();