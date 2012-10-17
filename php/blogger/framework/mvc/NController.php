<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NController
 *
 * @author krillzip
 */
class NController extends NComponent implements IController {

    protected $context;
    protected $id;
    
    protected $layout = 'main';

    public final function __construct(NExeContext $context, $id) {
        $this->context = $context;
        $this->id = $id;
    }

    public function actions() {
        return array();
    }
    
    public function render($view = NULL, array $params = array(), $return = false){
        $content = $this->renderPartial($view, $params, true);
        if($return){
            return NView::render(NUtil::getLayoutPath($this->layout), array('content'=>$content), $return);
        }else{
            NView::render(NUtil::getLayoutPath($this->layout), array('content'=>$content), $return);
        }
    }
    
    public function renderPartial($view = NULL, array $params = array(), $return = false){
        if($return){
            return NView::render(NUtil::getViewPath($this->context, $view), $params, $return);
        }else{
            NView::render(NUtil::getViewPath($this->context, $view), $params, $return);
        }
    }

}