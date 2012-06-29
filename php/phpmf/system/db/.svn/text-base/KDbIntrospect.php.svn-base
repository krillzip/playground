<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KDbIntrospect
 *
 * @author krillzip
 */
class KDbIntrospect extends KObject {
    private $connection;

    public function __construct(KDbConnection $connection = NULL)
    {
        if(!empty($connection))
            $this->connection = $connection;
        else
            $this->connection = System::app()->dbms->connection;
    }

    public function introspect($schema = NULL)
    {
        $schemas = $this->schemas();
        if(!empty($schema))
            if(in_array($schema, $schemas))
                $schemas = array($schema);
            else
                return false;

        foreach($schemas as $schema)
        {
            $tables = $this->tables($schema);
            foreach($tables as $table)
            {
                $columns = $this->columns($schema, $table);
                foreach($columns as $column)
                {
                    $cols[$column] = $this->columnDetails($schema, $table, $column);
                }
                $tbl[$table] = array_merge($this->tableDetails($schema, $table), array('columns'=>$cols), array('name'=>$schema));
            }
            $dbs[$schema] = array('tables'=>$tbl, 'name'=>$schema);
        }
        return $dbs;
    }

    public function schemas()
    {
        $result = $this->connection->query('SHOW SCHEMAS');
        foreach($result as $row)
            $schemas[] = $row['Database'];
        return $schemas;
    }

    public function schemaDetails($schema)
    {
        
    }

    public function tables($schema)
    {
        $result = $this->connection->query('SHOW TABLES FROM '.$schema);
        foreach($result as $row)
            $tables[] = $row['Tables_in_'.strtolower($schema)];
        return $tables;
    }

    public function tableDetails($schema, $table)
    {
        $fkarr = $this->connection->query('SELECT column_name, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM information_schema.key_column_usage WHERE table_name = \''.$table.'\' AND table_schema = \''.$schema.'\' and REFERENCED_COLUMN_NAME is not NULL');
        $fk = array();
        foreach($fkarr as $fvalue)
            $fk[$fvalue['column_name']] = array($fvalue['REFERENCED_TABLE_NAME'], $fvalue['REFERENCED_COLUMN_NAME']);

        $pkarr = $this->connection->query('SHOW INDEX FROM '.$table.' IN '.$schema.' WHERE Key_name = \'PRIMARY\'');
        $pk = array();
        foreach($pkarr as $pvalue)
            $pk[] = $pvalue['Column_name'];
            
        $cresult = $this->connection->queryRow('SHOW TABLE STATUS FROM '.$schema.' WHERE Name = \''.strtolower($table).'\'');
        $collation = $cresult['Collation'];
        $engine = $cresult['Engine'];
        $csresult = $this->connection->queryRow('SHOW COLLATION WHERE Collation = \''.$collation.'\'');
        $charset = $csresult['Charset'];

        return array('pk'=>$pk, 'fk'=>$fk, 'collation'=>$collation, 'engine'=> $engine, 'charset'=>$charset);
    }

    public function columns($schema, $table)
    {
        $result = $this->connection->query('SHOW COLUMNS FROM '.$table.' IN '.$schema);
        foreach($result as $row)
            $columns[] = $row['Field'];
        return $columns;
    }

    public function columnDetails($schema, $table, $column)
    {
        $col = $this->connection->queryRow('SHOW FULL COLUMNS FROM '.$table.' IN '.$schema.' WHERE Field = \''.$column.'\'');
        $index = $this->connection->queryRow('SHOW INDEX FROM '.$table.' FROM '.$schema.' WHERE Column_name = \''.$column.'\'');

        $name = $col['Field'];          // Name of field
        $primary = (bool) ($index['Key_name'] == 'PRIMARY');       // Is primary key
        $unique = (bool) ($index['Non_unique'] == '0');        // Is unique
        //$foreign;       // Is foreign key
        $t = explode('(', $col['Type']);
        $type = trim(array_shift($t));          // Data type
        $length = (integer) trim(array_pop($t));        // Length of data type
        //$values;        // Possible values if enum
        $unsigned = (stripos($col['Type'], 'unsigned') !== false);      // Is unsigned
        $default = $col['Default'];       // Default value
        $notnull = (bool) ($col['Null'] != 'YES');       // Is not null
        $autoincrement = (bool) (strpos($col['Extra'], 'auto_increment') !== false); // Is autoincrement
        $collation = $col['Collation'];
        $csresult = $this->connection->queryRow('SHOW COLLATION WHERE Collation = \''.$collation.'\'');
        $charset = $csresult['Charset'];

        return array(
            'name'=>$name,
            'primary'=>$primary,
            'unique'=>$unique,
            'type'=>$type,
            'length'=>$length,
            'unsigned'=>$unsigned,
            'default'=>$default,
            'notnull'=>$notnull,
            'autoincrement'=>$autoincrement,
            'collation'=>$collation,
            'charset'=>$charset
        );
    }
}

?>