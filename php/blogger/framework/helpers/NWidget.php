<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NWidget
 *
 * @author krillzip
 */
abstract class NWidget extends NComponent{
    
    public static function factory($widget, NConfig $config){
        if(!in_array('NWidget', class_parents($widget))){
            throw new NWidgetException('Class "'.$widget.'" not a NWidget.', NWidgetException::NOT_WIDGET);
        }
        
        $widgetInstance = new $widget();
        NUtil::configureComponent($config, $widgetInstance);
        $widgetInstance->run();
        return $widgetInstance;
    }
    
    public abstract function run();
    
    public abstract function __toString();
}

class NWidgetException extends Exception{
    const NOT_WIDGET = 1;
}