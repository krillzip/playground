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
class NSqlInsert extends NSqlTableOperation{
    public function __construct()
    {
        parent::__construct();
        $this->_data = array(
            'columns'=>array(),
            'table'=>NULL,
        );
    }

    public function into($table)
    {
        $this->_data['table'] = $table;
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

    public function sql()
    {
        return implode(' ', array(
            NQueryBuilder::sqlInsert($this),
        ));
    }
}
?>