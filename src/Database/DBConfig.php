<?php

namespace Ibonly\SugarORM;
use PDO;

class DBConfig
{


    public function connect(){
        // Set DSN
        $dsn = 'mysql:host=localhost;dbname=todo_app';
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try
        {
            $dbh = new PDO($dsn, "root", "", $options);
        }
        // Catch any errors
        catch(PDOException $e)
        {
            $error = $e->getMessage();
        }
        return $dbh;
    }
}