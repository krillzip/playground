<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KDatabaseManager
 *
 * @author krillzip
 */
class KDatabaseManager extends KApplicationManager{
    private $connection;
    private $schema;
    public function __construct()
    {
        parent::__construct();
        $config = KConfiguration::load('application.config.database');
        $this->connection = new KDbConnection($config['connection']);
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function getSchema()
    {
        return $this->schema;
    }

    public function introspect()
    {
        return new KDbIntrospect($this->connection);
    }
}

?>
