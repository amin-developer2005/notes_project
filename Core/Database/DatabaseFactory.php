<?php

namespace Core\Database;


use Core\Database\DatabaseInterface;
use Core\Database\DbPDO;
use Core\Database\DbMysqli;
use PDO;
use stdClass;


abstract class DatabaseFactory implements DatabaseInterface
{
    private static ?object $instance = null;


    /**
     * Supported database classes
     */
    private const array DATABASES = [
        'pdo' => DbPDO::class,
        'mysqli' => DbMysqli::class,
        'pgsql' => DbPgsql::class,
        'sqlite' => DbSqlite::class,
    ];


    protected PDO $connection {
        set => $this->connection = $value;
        get => $this->connection;
    }

    protected $stmt = null {
        set => $this->stmt = $value;
        get => $this->stmt;
    }


    /**
     * @throws \Exception
     */
    public function __construct(protected(set) readonly string $host, protected(set) readonly string $port, protected(set) readonly string $dbname, protected(set) readonly string $charset, protected(set) readonly string $username, protected(set) readonly string $password) {
        $this->connect();
    }


    /**
     * @throws \Exception
     */
    public static function fetchInstance($db = ''): ?object
    {
        // TODO: Implement __invoke() method.

        if (isset(self::$instance)) {
            return self::$instance;
        }

        if (empty($db)) {
            $db = self::fetchClass();
        }

        if (null === $class = self::DATABASES[$db] ?? null) {
            throw new \Exception("Database [$db] is not defined.");
        }


        self::$instance = new $class(
            $_ENV['DB_HOST'],
            $_ENV['DB_PORT'],
            $_ENV['DB_NAME'],
            $_ENV['DB_CHARSET'],
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD'],
        );

        return self::$instance;
    }


    /**
     * @throws \Exception
     */
    private static function fetchClass(): string
    {
        $extensions = get_loaded_extensions();
        foreach ($extensions as $extension) {
            $className = match ($extension) {
                'PDO', 'pdo_mysql' => 'pdo',
                'mysqli' => 'mysqli',
                'pdo_pgsql' => 'pgsql',
                'pdo_sqlite' => 'sqlite',
                'mongo' => 'mongo',
                default => null,
            };

            if (null !== $className) {
                return $className;
            }
        }

        throw new \Exception("No database class found!");
    }

}