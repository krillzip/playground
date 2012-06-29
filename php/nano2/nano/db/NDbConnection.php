<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NDbConnection
 *
 * @author krillzip
 */
class NDbConnection extends NObject
{
    protected $_pdo;
    
    public function construct($dsn, $user, $password)
    {
        $this->_pdo = new PDO($dsn, $user, $password);
    }

    public function query($sql)
    {
        return $this->_pdo->query($sql);
    }

    public function beginTransaction()
    {
        try{
            return new NDbTransaction($this);
        }catch(Exception $e){
            return false;
        }
    }

    public function getPDO()
    {
        return $this->_pdo;
    }
}
?>