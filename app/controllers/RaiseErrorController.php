<?php

namespace Smart\Router;

use Smart\Controllers\Controller as Controller;

class RaiseErrorController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->view->title = 'Erro 404 - Página inexistente!';
		$this->view->render('error_page/index', true);
	}
}