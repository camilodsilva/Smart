<?php

namespace Smart\Router;

use Smart\Controllers\Controller as Controller;
use Smart\Resolvers\Resolver as Resolver;
use Smart\Security\Auth as Auth;

class IndexController extends Controller
{
	private $appConfig = null;
	private $auth = null;

	public function __construct()
	{
		parent::__construct();
		$this->appConfig = Resolver::getAppInformation();
		$this->view->js = array('index/js/index.js');
	}

	public function index()
	{
		$this->view->title = $this->appConfig['pageTitle'] . ' - Principal';
		$this->view->users = $this->model->getUsers();

		$this->view->render('index/index');
	}

	public function details($id)
	{
		$this->view->title = $this->appConfig['detailTitle'] . ' - Principal';
		$this->view->user  = $this->model->getUserDetail($id);
		
		$this->view->render('index/details');
	}

	public function detailsAjax($id)
	{
		$this->view->title = $this->appConfig['detailTitle'] . ' - Principal';
		echo json_encode($this->model->getUserDetail($id));
	}

	public function testJwt()
	{
		$this->auth = new Auth();

		$this->view->title = $this->appConfig['pageTitle'] . ' - Principal';
		$users = $this->model->getUsers();
		$search = 'user@email.com';

		echo $this->auth->getToken($search, $users);
	}

	public function testJwtAccess()
	{
		$this->auth = new Auth();

		$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyaWQiOiJDYW1pbG8uU2lsdmFAYnIubmVzdGxlLmNvbSIsImlhdCI6MTUzMzU2MzE4MCwiZXhwIjoxNTMzNTYzMzYwfQ.yJbEGL4xU-nB406wvYuFuug-Jv27E32NyCRqeAMEPcs';
		echo $this->auth->validateToken($token);
	}
}
