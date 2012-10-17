<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NInlineAction
 *
 * @author krillzip
 */
class NInlineAction extends NAction {

    protected $callback;

    public function __construct(NExeContext $context, $id, $callback) {
        parent::__construct($context, $id);
        $this->callback = $callback;
    }

    public function run() {
        call_user_func($this->callback);
    }

}