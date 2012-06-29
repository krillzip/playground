<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KDbSelect
 *
 * @author krillzip
 */
class NSqlSelect extends NSqlTableOperation{
    public function __construct()
    {
        parent::__construct();
        $this->_data = array(
            'columns'=>array(),
            'table'=>NULL,
            'id'=>NULL,
            'distinct'=>false,
            'conditions'=>array(),
            'order'=>array(),
            'limit'=>NULL,
            'offset'=> 0,
        );
    }

    public function id($id)
    {
        $this->_data['id'] = $id;
    }

    public function column($col, array $option = array())
    {
        $this->_data['columns'][$col] = $option;
    }

    public function columns(array $cols)
    {
        $this->_data['columns'] = array_merge(array_flip($cols), $this->_data['columns']);
    }

    public function allColumns()
    {
        $this->_data['columns'] = array('*'=>array());
    }

    public function noColumns()
    {
        $this->_data['columns'] = array();
    }

    public function distinct($d = true)
    {
        $this->_data['distinct'] = $d;
    }

    public function from($table, $id = NULL)
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

    public function limit($limit, $offset = NULL)
    {
        $this->_data['limit'] = $limit;
        $this->_data['offset'] = $offset;
    }

    public function sql()
    {
        return implode(' ', array(
            NQueryBuilder::sqlSelect($this),
            NQueryBuilder::sqlFrom($this),
            NQueryBuilder::sqlWhere($this),
            NQueryBuilder::sqlOrder($this),
            NQueryBuilder::sqlLimit($this),
        ));
    }
}
?>