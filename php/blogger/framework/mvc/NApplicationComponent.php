<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NApplicationComponent
 *
 * @author krillzip
 */
abstract class NApplicationComponent extends NComponent implements IApplicationComponent {

    public abstract function init();
}