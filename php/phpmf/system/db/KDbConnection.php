<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KDbConnection
 *
 * @author krillzip
 */
class KDbConnection extends KObject{
    private $host;
    private $user;
    private $password;
    private $schema;
    private $connection;
    
    public function __construct($connection)
    {
        $this->host = $connection['host'];
        $this->user = $connection['user'];
        $this->password = $connection['password'];
        $this->schema = $connection['schema'];
    }

    protected function connect()
    {
        $this->connection = mysql_connect($this->host, $this->user, $this->password);
        if($this->connection === false)
            throw new Exception();

        $schema = mysql_select_db($this->schema, $this->connection);
        if($schema === false)
            throw new Exception();
    }

    public function query($sql)
    {
        if(empty($this->connection))
            $this->connect();
        $result = mysql_query($sql, $this->connection);
        if($result === false)
            throw new Exception;
        $rows = array();
        while($row = mysql_fetch_assoc($result))
            $rows[] = $row;
        mysql_free_result($result);
        return $rows;
    }

    public function queryRow($sql)
    {
        if(empty($this->connection))
            $this->connect();
        $result = mysql_query($sql, $this->connection);
        if($result === false)
            throw new Exception;
        $row = mysql_fetch_assoc($result);
        mysql_free_result($result);
        return $row;
    }

    /*public function execute()
    {
        if(empty($this->connection))
            $this->connect;
    }*/
}
?>
