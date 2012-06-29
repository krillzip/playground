<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KDbDelete
 *
 * @author krillzip
 */
class KSqlDelete extends KSqlTableOperation{
    public function __construct()
    {
        parent::__construct();
        $this->data = array(
            'table'=>NULL,
            'conditions'=>array(),
            'order'=>array(),
            'limit'=>NULL,
        );
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

    public function limit($limit)
    {
        $this->data['limit'] = $limit;
    }

    public function sql()
    {
        return implode(' ', array(
            KDbQuery::sqlDelete($this),
            KDbQuery::sqlWhere($this),
            KDbQuery::sqlOrder($this),
            KDbQuery::sqlLimit($this),
        ));
    }
}
?>