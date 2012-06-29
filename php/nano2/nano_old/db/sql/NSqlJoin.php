<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KSqlJoin
 *
 * @author krillzip
 */
class NSqlJoin extends NSqlTableOperation{
    public function __construct()
    {
        parent::__construct();
        $this->_data = array(
            'joins'=>array(),
            'tables'=>array(),
            'limit'=>NULL,
            'offset'=>0,
        );
    }

    public function join(NSqlTableOperation $pk_tbl, $pk_col, NSqlTableOperation $fk_tbl, $fk_col)
    {
        $this->_data['joins'][] = array(
            'pk_tbl'=>$pk_tbl,
            'pk_col'=>$pk_col,
            'fk_tbl'=>$fk_tbl,
            'fk_col'=>$fk_col
        );
        $this->_data['tables'][$pk_tbl->table] = $pk_tbl;
        $this->_data['tables'][$fk_tbl->table] = $fk_tbl;
    }

    public function limit($limit, $offset = NULL)
    {
        $this->_data['limit'] = $limit;
        $this->_data['offset'] = $offset;
    }

    public function sql()
    {
        foreach($this->tables as $table) {
            $tid = 't'.++$cnt;
            $table->id($tid);
        }
        $columns = array();
        foreach($this->_data['tables'] as $table)
            $columns[] = NQueryBuilder::sqlColumns($table, $table->id);

        $select = 'SELECT '.implode(', ', $columns);
        $from = NQueryBuilder::sqlJoin($this);

        $conditions = array();
        foreach($this->_data['tables'] as $table)
            $conditions[] = NQueryBuilder::sqlCondition($table, $table->id);

        $where = 'WHERE '.implode(' AND ', $conditions);
        /*$orders = array();
        foreach($this->_data['tables'] as $table)
            $orders[] = NQueryBuilder::sqlOrder($table, $table->id);

        if(!empty($orders))
            $orderby = 'ORDER BY '.implode(', ', $orders);*/
        $limit = NQueryBuilder::sqlLimit($this);

        return implode(' ', array(
            $select,
            $from,
            $where,
            $orderby,
            $limit,
        ));
    }
}
?>