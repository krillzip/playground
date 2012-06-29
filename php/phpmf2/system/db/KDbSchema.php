<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KDbSchema
 *
 * @author krillzip
 */
class KDbSchema extends KObject{
    private $tables = array();
    private $name = NULL;
    
    public function __construct($data = NULL)
    {
        $this->name = $data['name'];
        foreach($data['tables'] as $key=>$value)
        {
            $this->tables[$key] = new KDbTable($this, $value);
        }
    }

    public function __get($name)
    {
        if(!empty($this->tables[$name]))
            return $this->tables[$name];
        else
            return parent::__get($name);
    }

    public function name()
    {
        return $this->name;
    }
}
?>
