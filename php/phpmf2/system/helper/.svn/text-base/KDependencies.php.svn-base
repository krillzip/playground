<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KDependencies
 *
 * @author krillzip
 */
class KDependencies extends KObject{
    private static $dependencies = array();
    public static function resolve($alias)
    {
        $dependencies = array();
        $path = System::pathAlias($alias);
        $dep = self::loadDependency($path);
        $dependecies[$dep['name']] = $dep;

        foreach($dependecies as $key => $value)
        {
            foreach($value['dependencies'] as $value2)
            {
                if(empty(self::$dependencies[$value2]))
                {
                    $dep2 =3 ;
                }
            }
        }
    }

    protected static function loadDependency($path)
    {
        $dep = include($path);
        self::$dependencies[$dep['name']] = $dap;
        return $dep;
    }
}
?>