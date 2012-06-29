<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KDbTable
 *
 * @author krillzip
 */
class KDbTable extends KObject{
    private $schema;

    private $columns = array();
    private $pk = array();
    private $fk = array();

    private $engine;
    private $charset;
    private $collation;
    private $name;

    public function __construct(KDbSchema $schema, $data = NULL)
    {
        $this->schema = $schema;

        $this->engine = $data['engine'];
        $this->charset = $data['charset'];
        $this->collation = $data['collation'];
        $this->name = $data['name'];

        $this->pk = $data['pk'];
        $this->fk = $data['fk'];
        foreach($data['columns'] as $key=>$value)
        {
            $this->columns[$key] = new KDbColumn($this->schema, $this, $value);
        }
    }
}
?>