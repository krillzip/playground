<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KSqlCondition
 *
 * @author krillzip
 */
class KSqlCondition extends KObject {
    private $column;
    private $condition;
    private $values = array();

    const K_IS =                '{column} IS {value1}';
    const K_IS_NOT =            '{column} IS NOT {value1}';

    const K_BETWEEN =           '{column} BETWEEN {value1} AND {value2}';
    const K_NOT_BETWEEN =       '{column} NOT BETWEEN {value1} AND {value2}';
    const K_LIKE =              '{column} LIKE({value1})';
    const K_NOT_LIKE =          '{column} NOT LIKE {value1}';
    const K_SOUNDS_LIKE =       '{column} SOUNDS LIKE {value1}';

    const K_EQUAL =             '{column} = {value1}';
    const K_NOT_EQUAL =         '{column} <> {value1}';
    const K_NULL_NOT_EQUAL =    '{column} <=> {value1}';
    const K_LESS =              '{column} < {value1}';
    const K_GREATER =           '{column} > {value1}';
    const K_LESS_EQUAL =        '{columns} <= {value1}';
    const K_GREATER_EQUAL =     '{column} >= {value1}';

    public function __construct($column, $condition, array $values)
    {
        $this->column = $column;
        $this->condition = $condition;
        $this->values = $values;
    }

    public function sql($id = '')
    {
        $column = (empty($id)?'':$id.'.').$this->column;
        return preg_replace(
            array('/{column}/', '/{value1}/', '/{value2}/'),
            array_merge(array($column), $this->values),
            $this->condition);
    }
}

?>