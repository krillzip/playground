<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IRouter
 *
 * @author krillzip
 */
interface IRouterAdapter {
    public function createUrl($route, array $params = array(), $absolute = false);
    public function findRoute($uri);

    public function getRoute();
    public function getParams();
}
?>
