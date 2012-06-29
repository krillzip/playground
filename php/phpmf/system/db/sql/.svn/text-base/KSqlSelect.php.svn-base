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
class KSqlSelect extends KSqlTableOperation{
    public function __construct()
    {
        parent::__construct();
        $this->data = array(
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
        $this->data['id'] = $id;
    }

    public function column($col, array $option = array())
    {
        $this->data['columns'][$col] = $option;
    }

    public function columns(array $cols)
    {
        $this->data['columns'] = array_merge($cols, $this->data['columns']);
    }

    public function allColumns()
    {
        $this->data['columns'] = array('*'=>array());
    }

    public function noColumns()
    {
        $this->data['columns'] = array();
    }

    public function distinct($d = true)
    {
        $this->data['distinct'] = $d;
    }

    public function from($table)
    {
        $this->data['table'] = $table;
    }

    public function condition(KSqlCondition $cond)
    {
        $this->data['conditions'][] = $cond;
    }

    public function order($col, $dir = 'ASC')
    {
        $this->data['order'][$col] = $dir;
    }

    public function limit($limit, $offset = NULL)
    {
        $this->data['limit'] = $limit;
        $this->data['offset'] = $offset;
    }

    public function sql()
    {
        return implode(' ', array(
            KDbQuery::sqlSelect($this),
            KDbQuery::sqlFrom($this),
            KDbQuery::sqlWhere($this),
            KDbQuery::sqlOrder($this),
            KDbQuery::sqlLimit($this),
        ));
    }
}
?>