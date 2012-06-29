<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NDbTransaction
 *
 * @author krillzip
 */
class NDbTransaction extends NObject{
    protected $_connection;
    protected $_pdo;

    /**
     *  Initializing a database transaction class.
     * @param NDbConnection $connection
     */
    public function __construct(NDbConnection $connection)
    {
        $this->_connection = $connection;
        $this->_pdo = $this->_connection->pdo;
        if(!$this->_pdo->beginTransaction())
            throw new Exception();
    }

    public function commit()
    {
        return $this->_pdo->commit();
    }

    public function rollBack()
    {
        return $this->_pdo->rollBack();
    }

    public function getConnection()
    {
        return  $this->_connection;
    }
}
?>