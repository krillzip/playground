<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KDbQuery
 *
 * @author krillzip
 */
class KDbQuery extends KObject{
    public static function select()
    {
        return new KSqlSelect();
    }

    public static function insert()
    {
        return new KSqlInsert();
    }

    public static function update()
    {
        return new KSqlUpdate();
    }

    public static function delete()
    {
        return new KSqlDelete();
    }

    public static function sqlCondition(KSqlCondition $obj, $id = '')
    {

    }

    public static function sqlJoin(KSqlJoin $obj)
    {
        $cnt = 0;
        $froms = array();
        foreach($obj->tables as $table)
        {
            $tid = 't'.++$cnt;
            $table->id($tid);
            $froms[] = $table->table.' AS '.$tid;
        }

        $joins = array();
        foreach($obj->joins as $join)
        {
            $joins[] = $join['pk_tbl']->id().' LEFT JOIN '.$join['fk_tbl']->id().
            ' ON '.$join['pk_tbl']->id().'.'.$join['pk_col'].' = '.$join['fk_tbl']->id().'.'.$join['fk_col'];
        }
        return 'FROM '.implode(', ', $tables).', '.implode(', ', $joins);
    }

    public static function sqlColumns(KSqlTableOperation $obj, $id = '')
    {
        $sql = '';
        if(!empty($id))
            $id = $id.'.';
        if(isset($obj->columns) && count($obj->columns) > 0)
        {
            $columns = array();
            foreach($obj->columns as $column=>$options)
                if(isset($options['as']))
                    $columns[] = $id.$column.' AS \''.$options['as'].'\'';
                else
                    $columns[] = $id.$column;
            $sql .= implode(', ', $columns).' ';
        }
        return $sql;
    }

    public static function sqlSelect(KSqlTableOperation $obj)
    {
        if(!isset($obj->columns))
            return '';
        $sql = 'SELECT ';
        if(isset($obj->distinct) && $obj->distinct)
            $sql .= 'DISTINCT ';
        if(count($obj->columns) == 0 || isset($obj->columns['*']))
            $sql .= '*';
        else
            $sql .= self::sqlColumns($obj);
        return $sql;
    }

    public static function sqlDelete(KSqlTableOperation $obj)
    {
        if(!isset($obj->table))
            return 'false';
        return 'DELETE FROM '.$obj->table;
    }

    public static function sqlUpdate(KSqlTableOperation $obj)
    {
        if(!(isset($obj->table) && isset($obj->columns)))
            return '';
        $sql = 'UPDATE '.$obj->table;
        if(count($obj->columns) > 0)
        {
            $values = array();
            foreach($obj->columns as $key=>$value)
            {
                $value = mysql_real_escape_string($value);
                if(is_numeric($value))
                    $values[] = $key.' = '.$value;
                elseif(is_string($value))
                    $values[] = $key.' = \''.$value.'\'';
            }
            $sql .= 'SET '.implode(', ', $values);
        }
        return $sql;
    }

    public static function sqlInsert(KSqlTableOperation $obj)
    {
        if(!(isset($obj->table) && isset($obj->columns)))
            return '';
        $sql = 'INSERT INTO '.$obj->table;
        if(count($obj->columns) > 0)
        {
            $columns = array_keys($obj->columns);
            $sql .= ' ('.implode(', ', $columns).') VALUES(';
            $values = array();
            foreach($obj->columns as $value)
            {
                $value = mysql_real_escape_string($value);
                if(is_numeric($value))
                    $values[] = $value;
                elseif(is_string($value))
                    $values[] = '\''.$value.'\'';
            }
            $sql .= implode(', '. $values).')';
        }
        return $sql;
    }

    public static function sqlFrom(KSqlTableOperation $obj)
    {
        if(!isset($obj->table))
            return '';
        return 'FROM '.$obj->table;
    }

    public static function sqlWhere(KSqlTableOperation $obj, $id = '')
    {
        if(!(isset($obj->conditions) && count($obj->conditions) > 0))
            return '';
        else
        {
            $conditions = array();
            foreach($obj->conditions as $condition)
                $conditions[] = $condition->sql($id);
        }
        return 'WHERE '.implode(' AND ', $conditions);
    }

    public static function sqlOrder(KSqlTableOperation $obj, $id = '')
    {
        if(!empty($id))
            $id = $id.'.';
        if(!(isset($obj->order) && count($obj->order) > 0))
            return '';
        $order = array();
        foreach($obj->order as $ord=>$dir)
        if(!empty($dir))
            $order[] = $id.$ord.' '.$dir;
        else
            $order[] = $id.$ord;
        return implode(', ', $order);
    }

    public static function sqlLimit(KSqlTableOperation $obj)
    {
        if(!isset($obj->limit))
            return '';
        $sql = 'LIMIT '.$obj->limit;
        if(isset($obj->offset) && $obj->offset > 0)
            $sql .= ' OFFSET '.$obj->offset;
        return $sql;
    }
}

?>