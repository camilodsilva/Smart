<?php

namespace Smart\Bootstrap;

use Smart\Parsers\Parser as Parser;
use Smart\Resolvers\Resolver as Resolver;
use Smart\Router\RaiseErrorController as RaiseErrorController;
use Smart\Router\IndexController as IndexController;
use Exception as Exception;

class Bootstrap
{
    private $parser     = null;
    private $url        = null;
    private $controller = null;
    private $model      = null;
    private $resources  = null;

    public function __construct()
    {
        $this->parser    = new Parser();
        $this->url       = $this->parser->url();
        $this->resources = Resolver::getResources();

        if (Resolver::nonEmptyUrl($this->url)) {
            self::setModel();
            self::choosenController();
        } else {
            self::setModel('Index');
            self::defaultController();
        }
    }

    /**
     * Display an raiseError page if nothing exists
     *
     * @return boolean
     */
    private function raiseError()
    {
        $this->controller = new RaiseErrorController();
        $this->controller->index();
    }

    /**
     * This loads if there is no GET parameter passed
     */
    private function defaultController()
    {
        $this->controller = new IndexController();
        $this->controller->loadModel(self::getModel());
        $this->controller->index();
    }
    
    /**
     * Load an existing controller if there IS a GET parameter passed
     *
     * @return boolean|string
     */
    private function choosenController()
    {
        $file  = self::controllerFileBuilder();
        $class = self::controllerClassBuilder();
        
        if (file_exists($file)) {
            $this->controller = new $class();
            $this->controller->loadModel(self::getModel());
            $this->callMethod();
        } else {
            $this->raiseError();
        }
    }

    /**
     * Builds the target file: IndexController.php
     * 
     * @return String
     */
    private function controllerFileBuilder()
    {
        return sprintf('%s/%sController.php', $this->resources['controllersPath'], ucfirst($this->url[0]));
    }

    /**
     * Builds the controller class name: IndexController
     * 
     * @return String
     */
    private function controllerClassBuilder()
    {
        $namespace = 'Smart\\Router\\';
        $class     = ucfirst($this->url[0]);
        
        return sprintf('%s%sController', $namespace, $class);
    }

    /**
     * Identity the model
     * 
     */
    private function setModel($model = null)
    {
        if (isset($model)) {
            $this->model = $model;
        } else {
            $this->model = ucfirst($this->url[0]);
        }
    }

    /**
     * Identity the model
     * 
     */
    private function getModel()
    {
        return $this->model;
    }

    /**
     * If a method is passed in the GET url parameter
     *
     * http://localhost/project/app/controller/method/(param)/(param)/(param)
     *
     * url[0] = Controller name
     * url[1] = Method name
     * url[2] = Param of method
     * url[3] = Param of method
     * url[4] = Param of method
     *
     */
    private function callMethod()
    {
        $method = $this->url[1];

        if (!isset($this->url[0]) || !isset($method))
            throw new Exception('Missing controller or method');
        
        if (!method_exists($this->controller, $method))
            $this->raiseError();
        
        try {
            switch (sizeof($this->url)) {
                case 2:
                    $this->controller->{$method}();
                    break;
    
                case 3:
                    $firstParam = $this->url[2];
                    $this->controller->{$method}($firstParam);
                    break;
                    
                case 4:
                    $firstParam  = $this->url[2];
                    $secondParam = $this->url[3];
                    $this->controller->{$method}($firstParam, $secondParam);
                    break;
                
                default:
                    $this->controller->index();
                    break;
            }
        } catch(Exception $e) {
            echo 'Exception';
        }
    }
}
