<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NDefaultRouterAdapter
 *
 * @author krillzip
 */
class NDefaultRouterAdapter extends NRouterAdapterBase{
    public function createURL($route, array $params = array(), $absolute = false){
        return '/index.php?'.urldecode(http_build_query(array_merge(array('r'=>$route), $params)));
    }

    public function findRoute($uri){
        $this->_route = (isset($_GET['r'])?$_GET['r']:'default/index');
        $this->_params = $_GET;
        unset($this->_params['r']);
    }
}
?>
