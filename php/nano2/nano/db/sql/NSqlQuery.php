<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NSqlQuery
 *
 * @author krillzip
 */
class NSqlQuery extends NObject{
    const SELECT = 'select';
    const INSERT = 'insert';
    const UPDATE = 'update';
    const DELETE = 'delete';

    public static function factory($type)
    {
        switch($type)
        {
            case NSqlQuery::SELECT:
                return new NSqlQuerySelect();
            case NSqlQuery::INSERT:
                return new NSqlQueryInsert();
            case NSqlQuery::UPDATE:
                return new NSqlQueryUpdate();
            case NSqlQuery::DELETE:
                return new NSqlQueryDelete();
            default:
                return NULL;
        }
    }

    public abstract function __toString();
}

class NSqlQuerySelect extends NSqlQuery
{
    protected $_select = '';
    protected $_from = '';
    protected $_join = '';
    protected $_where = '';
    protected $_groupby = '';
    protected $_having = '';
    protected $_orderby = '';
    protected $_limit = '';
    protected $_offset = '';

    public function __toString()
    {
        $sql = $this->_select;
        $sql .= $this->_from;
        $sql .= $this->_join;
        $sql .= $this->_where;
        $sql .= $this->_groupby;
        $sql .= $this->_having;
        $sql .= $this->_orderby;
        $sql .= $this->_limit;
        $sql .= $this->_offset;
        return $sql;
    }
}

class NSqlQueryInsert extends NSqlQuery
{
    protected $_into = '';
    protected $_values = '';

    public function __toString()
    {
        $sql = $this->_into;
        $sql .= $this->_values;
        return $sql;
    }
}

class NSqlQueryUpdate extends NSqlQuery
{
    protected $_update = '';
    protected $_set = '';
    protected $_where = '';
    protected $_orderby = '';
    protected $_limit = '';

    public function __toString()
    {
        $sql = $this->_update;
        $sql .= $this->_set;
        $sql .= $this->_where;
        $sql .= $this->_orderby;
        $sql .= $this->_limit;
        return $sql;
    }
}

class NSqlQueryDelete extends NSqlQuery
{
    protected $_from = '';
    protected $_using = '';
    protected $_where = '';
    protected $_orderby = '';
    protected $_limit = '';

    public function __toString()
    {
        $sql .= $this->_from;
        $sql .= $this->_using;
        $sql .= $this->_where;
        $sql .= $this->_orderby;
        $sql .= $this->_limit;
        return $sql;
    }
}

class NSqlStatement
{
    
}

class NSqlElement extends NObject
{
    
}

class NSqlElementTable extends NSqlElement
{
    private $_name = NULL;
    private $_as = '';
    private $_columns = array();

    public function __construct($name)
    {
        $this->_name = $name;
    }

    public function addColumn(NSqlElementColumn $column)
    {
        $this->_columns[strtolower($columns->name)] = $column;
    }

    public function getColumn($column)
    {
        return $this->_columns[strtolower($column)];
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getAs()
    {
        return $this->_as;
    }

    public function setAs($as = '')
    {
        return $this->_as = $as;
    }
}

class NSqlElementColumn extends NSqlElement
{
    private $_name = NULL;
    private $_as = '';
    private $_table = NULL;

    public function __construct($name, NSqlElementTable $table)
    {
        $this->_name = $name;
        $this->_table = $table;
        $this->_table->addColumn($this);
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getTable()
    {
        return $this->_table;
    }

    public function getAs()
    {
        return $this->_as;
    }

    public function setAs($as = '')
    {
        return $this->_as = $as;
    }
}

class NSqlCondition
{
    
}

?>