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
class NSqlDelete extends NSqlTableOperation {
    public function __construct() {
        parent::__construct();
        $this->_data = array(
            'table'=>NULL,
            'conditions'=>array(),
            'order'=>array(),
            'limit'=>NULL,
        );
    }

    public function from($table) {
        $this->_data['table'] = $table;
    }

    public function condition(NSqlCondition $cond) {
        $this->_data['conditions'][] = $cond;
    }

    public function order($col, $dir = 'ASC') {
        $this->_data['order'][$col] = $dir;
    }

    public function limit($limit) {
        $this->_data['limit'] = $limit;
    }

    public function sql() {
        return implode(' ', array(
        NQueryBuilder::sqlDelete($this),
        NQueryBuilder::sqlWhere($this),
        'ORDER BY '.NQueryBuilder::sqlOrder($this),
        NQueryBuilder::sqlLimit($this),
        ));
    }
}
?>