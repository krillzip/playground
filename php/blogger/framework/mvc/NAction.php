<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NAction
 *
 * @author krillzip
 */
abstract class NAction extends NComponent implements IAction{
    
    protected $context;
    protected $id;
    
    public function __construct(NExeContext $context, $id) {
        $this->context = $context;
        $this->id = $id;
    }
    
    public abstract function run();
}