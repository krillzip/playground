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
class KSqlJoin extends KSqlTableOperation{
    public function __construct()
    {
        parent::__construct();
        $this->data = array(
            'joins'=>array(),
            'tables'=>array(),
            'limit'=>NULL,
            'offset'=>0,
        );
    }

    public function join(KSqlTableOperation $pk_tbl, $pk_col, KSqlTableOperation $fk_tbl, $fk_col)
    {
        $this->data['joins'][] = array(
            'pk_tbl'=>$pk_tbl,
            'pk_col'=>$pk_col,
            'fk_tbl'=>$fk_tbl,
            'fk_col'=>$fk_col
        );
        $this->data['tables'][$pk_tbl->table] = $pk_tbl;
        $this->data['tables'][$fk_tbl->table] = $fk_tbl;
    }

    public function limit($limit, $offset = NULL)
    {
        $this->data['limit'] = $limit;
        $this->data['offset'] = $offset;
    }

    public function sql()
    {
        
    }
}
?>