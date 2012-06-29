<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NModel
 *
 * @author krillzip
 */
class NModel extends NObject{
    protected $_data = array();
    private $_fields = array();
    private $_rules = array();
    private $_errors = false;
    
    public function __construct(array $data)
    {
        $this->_fields = $this->fields();
        $this->_rules = $this->rules();
        foreach($data as $key=>$value)
            $this->setter($key, $value);
    }

    protected function getter($name)
    {
        return $this->_data[$name];
    }

    protected function setter($name, $value)
    {
        if(isset($this->_fields[$name]))
            $this->_data[$name] = $value;
    }

    public function validate()
    {
        $this->_errors = false;
        $errors = array();
        $regex = '/'.implode('|', array_keys($this->fields)).'/';
        foreach($this->_rules as $rule)
        {
            preg_match($regex, $rule[0], $matches);
            foreach($matches as $field)
            {
                $options = explode(',', $rule[1]);
                $try = array_shift($options);
                if(NValidator::validate($this->_fields[$field], $try, $options))
                    $errors[$field][] = $rule[2];
            }
        }
        if(count($errors) > 0)
        {
            $this->_errors = $errors;
            return false;
        }
        else
            return true;
    }

    public function errors()
    {
        $errors = $this->_errors;
        $this->_errors = false;
        return $errors;
    }

    protected abstract function fields();
    protected abstract function rules();
}
?>