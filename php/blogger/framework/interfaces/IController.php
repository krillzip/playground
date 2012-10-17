<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author krillzip
 */
interface IController {

    public function __construct(NExeContext $context, $id);

    public function actions();
}