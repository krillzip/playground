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
class KSqlUpdate extends KSqlTableOperation{
    public function __construct()
    {
        parent::__construct();
        $this->data = array(
            'columns'=>array(),
            'table'=>NULL,
            'conditions'=>array(),
            'order'=>array(),
            'limit'=>NULL,
        );
    }

    public function column($col, array $option = array())
    {
        $this->data['columns'][$col] = $option;
    }

    public function columns(array $cols)
    {
        $this->data['columns'] = array_merge($cols, $this->data['columns']);
    }

    public function noColumns()
    {
        $this->data['columns'] = array();
    }

    public function set($table)
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

    public function limit($limit)
    {
        $this->data['limit'] = $limit;
    }

    public function sql()
    {
        return implode(' ', array(
            KDbQuery::sqlUpdate($this),
            KDbQuery::sqlWhere($this),
            KDbQuery::sqlOrder($this),
            KDbQuery::sqlLimit($this),
        ));
    }
}
?>