<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KDbUpdate
 *
 * @author krillzip
 */
class NSqlUpdate extends NSqlTableOperation{
    public function __construct()
    {
        parent::__construct();
        $this->_data = array(
            'columns'=>array(),
            'table'=>NULL,
            'conditions'=>array(),
            'order'=>array(),
            'limit'=>NULL,
        );
    }

    public function column($col, array $option = array())
    {
        $this->_data['columns'][$col] = $option;
    }

    public function columns(array $cols)
    {
        $this->_data['columns'] = array_merge($cols, $this->_data['columns']);
    }

    public function noColumns()
    {
        $this->_data['columns'] = array();
    }

    public function set($table)
    {
        $this->_data['table'] = $table;
    }

    public function condition(NSqlCondition $cond)
    {
        $this->_data['conditions'][] = $cond;
    }

    public function order($col, $dir = 'ASC')
    {
        $this->_data['order'][$col] = $dir;
    }

    public function limit($limit)
    {
        $this->_data['limit'] = $limit;
    }

    public function sql()
    {
        return implode(' ', array(
            NQueryBuilder::sqlUpdate($this),
            NQueryBuilder::sqlWhere($this),
            'ORDER BY '.NQueryBuilder::sqlOrder($this),
            NQueryBuilder::sqlLimit($this),
        ));
    }
}
?>