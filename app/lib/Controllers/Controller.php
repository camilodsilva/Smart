<?php

namespace Smart\Controllers;

use Smart\Views\View as View;
use Smart\Resolvers\Resolver as Resolver;

class Controller
{
	protected $model = null;

	function __construct()
	{
		$this->view = new View();
	}

	public function loadModel($model)
	{
		$file  = sprintf('%s/%s.php', Resolver::getResources()['modelsPath'], $model);
		$class = self::modelClassBuilder($model);
		
		if (file_exists($file)) {
			$this->model = new $class;
		}
	}

	/**
     * Builds the controller class name: IndexController
     * 
     * @return String
     */
    private function modelClassBuilder($model)
    {
        $namespace = 'Smart\\Orm\\';
		$class     = ucfirst($model);
		
        return sprintf('%s%s', $namespace, $class);
	}
}
