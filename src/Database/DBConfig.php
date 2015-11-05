<?php
/**
 * This class handles database connection.
 *
 * @package Ibonly\PotatoORM\DBConfig
 * @author  Ibraheem ADENIYI <ibonly01@gmail.com>
 * @license MIT <https://opensource.org/licenses/MIT>
 */

namespace Ibonly\PotatoORM;

use PDO;
use PDOException;
use Dotenv\Dotenv;
use Ibonly\PotatoORM\Inflector;
use Ibonly\PotatoORM\InvalidConnectionException;

class DBConfig extends PDO
{
    protected $driver;
    protected $host;
    protected $dbname;
    protected $port;
    protected $user;
    protected $password;
    /**
     * Define the database connection
     */
    public function __construct()
    {
        $dbConn = "";
        $this->loadEnv();
        $this->driver = getenv('DATABASE_DRIVER');
        $this->host = getenv('DATABASE_HOST');
        $this->dbname = getenv('DATABASE_NAME');
        $this->port= getenv('DATABASE_PORT');
        $this->user = getenv('DATABASE_USER');
        $this->password = getenv('DATABASE_PASSWORD');
        try
        {
            if ($this->driver === 'pgsql')
            {
                $dbConn = parent::__construct($this->pgsqlConnectionString());
            }
            elseif ($this->driver === 'mysql')
            {
                $dbConn = parent::__construct($this->mysqlConnectionString(), $this->user, $this->password);
            }
        } catch (InvalidConnectionException $e) {
            return $e->errorMessage();
        }
    }

    /**
     * pgsqlConnectionString Postgres connection string
     *
     * @return [string]
     */
    public function pgsqlConnectionString()
    {
        return $this->driver . ':host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dbname . ';user=' . $this->user . ';password=' . $this->password;
    }

    /**
     * mysqlConnectionString Mysql connection string
     *
     * @return [string]
     */
    public function mysqlConnectionString()
    {
        return $this->driver . ':host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8mb4';
    }

    /**
     * Load Dotenv to grant getenv() access to environment variables in .env file
     */
    protected function loadEnv()
    {
        $dotenv = new Dotenv(__DIR__ . "../../../");
        $dotenv->load();
    }
}