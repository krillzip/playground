<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NApplication
 *
 * @author krillzip
 */
class NApplication extends NComponent implements IApplication {

    const DEFAULT_CONTROLLER_ID = 'default';
    const DEFAULT_ACTION_ID = 'index';

    protected $preload = array();
    protected $componentsConfig = array();
    protected $components = array();
    protected $context;
    protected $controllerPath;
    protected $viewPath;
    protected $modelPath;
    protected $vendorPath;

    public function init() {
        // Setting up paths
        $this->controllerPath = APP_PATH . DS . 'controllers';
        $this->modelPath = APP_PATH . DS . 'models';
        $this->viewPath = APP_PATH . DS . 'views';
        $this->vendorPath = APP_PATH . DS . 'vendors';

        // Preloading application components
        if (!empty($this->preload)) {
            foreach ($this->preload as $component) {
                $this->loadApplicationComponent($component);
            }
        }
    }

    public function run() {
        $router = $this->getComponent('router', true);
        $this->context = $router->calculateRoute();

        $this->context->init();
        $this->context->execute();
    }

    protected function loadApplicationComponent($component) {
        if (empty($this->componentsConfig[$component])) {
            throw new NApplicationException('ApplicationComponent configuration missing for ' . $component, NApplicationException::APP_COMPONENT_MISSING_CONFIG);
        }

        $config = $this->componentsConfig[$component];
        if (empty($config['class'])) {
            throw new NApplicationException('No class set for ApplicationComponent ' . $component, NApplicationException::APP_COMPONENT_NO_CLASS);
        } else {
            $componentClass = $config['class'];
            unset($config['class']);
        }

        $componentInstance = new $componentClass();
        NUtil::configureComponent(new NConfig($config), $componentInstance);
        $componentInstance->init();

        $this->components[$component] = $componentInstance;
    }

    public function getComponent($component, $autoload = false, array $config = array()) {
        if (empty($this->components[$component]) && !$autoload) {
            throw new NApplicationException('ApplicationComponent "' . $component . '" is not loaded.', NApplicationException::APP_COMPONENT_NOT_LOADED);
        } elseif (empty($this->components[$component]) && $autoload) {
            if (!empty($config)) {
                $this->componentsConfig[$component] = $config;
            }

            $this->loadApplicationComponent($component);
        }
        return $this->components[$component];
    }

    public function setPreload($value) {
        $this->preload = explode(',', $value);
    }

    public function setComponents(array $value) {
        $this->componentsConfig = $value;
    }

    public function getParam($name, $default = NULL) {
        return isset($this->params[$name]) ? $this->params[$name] : $default;
    }

    public function getControllerPath() {
        return $this->controllerPath;
    }

    public function getModelPath() {
        return $this->modelPath;
    }

    public function getViewPath() {
        return $this->viewPath;
    }
    
    public function getVendorPath() {
        return $this->vendorPath;
    }

}

class NApplicationException extends Exception {

    const APP_COMPONENT_MISSING_CONFIG = 1;
    const APP_COMPONENT_NO_CLASS = 2;
    const APP_COMPONENT_NOT_LOADED = 3;

}