<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KDbInsert
 *
 * @author krillzip
 */
class KSqlInsert extends KSqlTableOperation{
    public function __construct()
    {
        parent::__construct();
        $this->data = array(
            'columns'=>array(),
            'table'=>NULL,
        );
    }

    public function into($table)
    {
        $this->data['table'] = $table;
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

    public function sql()
    {
        return implode(' ', array(
            KDbQuery::sqlInsert($this),
        ));
    }
}
?>