<?php
/**
 * Created by PhpStorm.
 * User: mohammadAmin
 * Date: 2/10/2025
 * @author: Mohammadamin Meghdadi
 * @email: mohamadamin.meghdadi@gmail.com
 * @website: https://amin-developer.ir
 * @link: https://github.com/amin-developer2005
 */


namespace Core\Database;


use Core\Database\DatabaseInterface;
use Core\Database\DbPDO;
use Core\Database\DbMysqli;
use Exception;
use PDO;
use stdClass;


abstract class DatabaseFactory implements DatabaseInterface
{

    /**
     * Singleton instance.
     */
    private static ?object $instance;


    /**
     * Supported database classes
     */
    private const array DATABASE_DRIVERS = [
        'pdo_mysql'     => DbPDO::class,
        'mysqli'        => DbMysqli::class,
        'pdo_pgsql'     => DbPgsql::class,
        'pdo_sqlite'    => DbSqlite::class,
    ];


    /**
     * @var object Database connection instance
     */
    protected object $connection {
        set => $this->connection = $value;
        get => $this->connection;
    }


    /**
     * @var mixed Statement instance
     */
    protected $stmt = null {
        set => $this->stmt = $value;
        get => $this->stmt;
    }



    /**
     * The Constructor initializes connection parameters and invoke the connect() method to automatically connect to the database.
     *
     * @throws Exception
     */
    public function __construct(protected(set) readonly string $host, protected(set) readonly int $port, protected(set) readonly string $dbname, protected(set) readonly string $charset, protected(set) readonly string $username, protected(set) readonly string $password) {
        $this->connect();
    }

    abstract public function connect();
    abstract public function close();



    /**
     * Returns a singleton instance of the database connection.
     *
     * @param string $driver
     * @return ?object
     * @throws Exception
     */
    public static function fetchInstance(string $driver = ''): ?object
    {
        // TODO: Implement __invoke() method.
        if (isset(self::$instance)) {
            return self::$instance;
        }

        $class = ! empty($driver) ? self::DATABASE_DRIVERS[$driver] ?? null : self::autoResolveDriverClass();

        if (null === $class) {
            throw new Exception("Database [$driver] is not defined or no database class found.");
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
     * Detects the appropriate database class based on loaded PHP extensions.
     *
     * @return ?string
     */
    private static function autoResolveDriverClass(): ?string
    {
        $extensions = get_loaded_extensions();

        foreach (self::DATABASE_DRIVERS as $driver => $dbClass) {

            if (in_array($driver, $extensions)) {
                if (class_exists($dbClass)) {
                    return $dbClass;
                }
            }

        }

        return null;
    }

}