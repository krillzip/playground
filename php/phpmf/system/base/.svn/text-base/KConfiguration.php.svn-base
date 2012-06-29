<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KConfiguration
 *
 * @author krillzip
 */
class KConfiguration extends KObject{
    private $data;
    public function __construct($conf)
    {
        if(is_string($conf))
            $this->data = self::load($conf);
        elseif(is_array($conf))
            $this->data = $conf;
        else
            throw new Exception();
    }

    public function __get($name) {
        if(in_array($name, $this->data))
            return $this->data[$name];
        else
            return parent::__get($name);
    }

    public static function load($conf)
    {
        $path = System::pathAlias($conf);
        if(file_exists($path))
            return include($path);
        else
            throw new Exception();
    }

    public static function save(array $data, $alias)
    {
        $f = file_put_contents(System::pathAlias($alias), KConfiguration::export($data));
        if($f === false)
            return false;
        else
            return true;
    }

    public static function export($data)
    {
        $exported = var_export($data, true);
        return <<<EOF
<?php

return {$exported}

?>
EOF;
    }
}
?>
