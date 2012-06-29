<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KSqlCondition
 *  Describes an SQL 'where' condition.
 * @author krillzip
 */
class NSqlCondition extends NObject {
    protected $_column;
    protected $_condition;
    protected $_values = array();

    const SQL_IS =                '{column} IS {value1}';
    const SQL_IS_NOT =            '{column} IS NOT {value1}';

    const SQL_BETWEEN =           '{column} BETWEEN {value1} AND {value2}';
    const SQL_NOT_BETWEEN =       '{column} NOT BETWEEN {value1} AND {value2}';
    const SQL_LIKE =              '{column} LIKE({value1})';
    const SQL_NOT_LIKE =          '{column} NOT LIKE {value1}';
    const SQL_SOUNDS_LIKE =       '{column} SOUNDS LIKE {value1}';

    const SQL_EQUAL =             '{column} = {value1}';
    const SQL_NOT_EQUAL =         '{column} <> {value1}';
    const SQL_NULL_NOT_EQUAL =    '{column} <=> {value1}';
    const SQL_LESS =              '{column} < {value1}';
    const SQL_GREATER =           '{column} > {value1}';
    const SQL_LESS_EQUAL =        '{columns} <= {value1}';
    const SQL_GREATER_EQUAL =     '{column} >= {value1}';

    public function __construct($column, $condition, array $values) {
        $this->_column = $column;
        $this->_condition = $condition;
        $this->_values = $values;
    }

    public function sql($id = '') {
        $column = (empty($id)?'':$id.'.').$this->_column;
        return preg_replace(
        array('/{column}/', '/{value1}/', '/{value2}/'),
        array_merge(array($column), $this->_values),
        $this->_condition);
    }
}

?>