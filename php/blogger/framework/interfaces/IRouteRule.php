<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author krillzip
 */
interface IRouteRule {

    public function __construct(NRouter $router);

    public function calculateRoute();

    public function createUrl($controller, $action, array $params);

    public function getController();

    public function getAction();

    public function getParams();
}