<?php
namespace Mvcify\Core;

class Model
{

    /**
     * Holds the PDO database connection object.
     *
     * @var null
     */
    public $db = null;

    /**
     * Create a new database connection, whenever new model object is created .
     */
    public function __construct()
    {
        try {
            self::createDatabaseConnection();
        } catch (\PDO\PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Create a new database connection with the credentials from config.php
     */
    private function createDatabaseConnection()
    {
        // Set the fetch mode to 'objects', which means all results will be
        // objects, like this: $result->user_name.
        // Set the error reporting to 'warnings'.
        $options = array(
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_WARNING
        );

        // Setting the database encoding.
        if (DB_TYPE == 'pgsql') {
            $db_encoding = ' options="--client_encoding=' . DB_CHARSET . '"';
        } else {
            $db_encoding = '; charset=' . DB_CHARSET;
        }

        // Create a new database connection.
        $this->db = new \PDO(
            DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . $db_encoding,
            DB_USER,
            DB_PASS,
            $options
        );
    }
}
