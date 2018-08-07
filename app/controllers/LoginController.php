<?php

namespace Smart\Router;

use Smart\Controllers\Controller as Controller;
use Smart\Resolvers\Resolver as Resolver;
use Smart\Resolvers\HttpResolver as HttpResolver;
use Smart\Security\Auth as Auth;

class LoginController extends Controller
{
	private $appConfig = null;
	private $auth = null;

	public function __construct()
	{
        parent::__construct();
        $this->auth = new Auth();
		$this->appConfig = Resolver::getAppInformation();
		$this->view->js = array('login/js/login.js');
	}

	public function index()
	{
		$this->view->title = $this->appConfig['pageTitle'] . ' - Principal';
		$this->view->users = $this->model->getUsers();

		$this->view->render('login/index');
	}

    public function login()
	{
        $users  = $this->model->getUsers();
        $search = $_POST['user_email'];

        $this->jwt = $this->auth->getToken($search, $users);

        if(isset($this->jwt) && $this->jwt['status'] === 'success') {
            session_start();
            $_SESSION['token'] = $this->jwt['jwt'];

            HttpResolver::redirect('?url=login/restrict');
        } else {
            HttpResolver::redirect('?url=login/index');
        }
	}

	public function restrict()
	{
        session_start();
        $token = $_SESSION['token'];

        $this->jwt = $this->auth->validateToken($token);
        
        if(isset($this->jwt) && $this->jwt['status'] === 'success') {
		    $this->view->render('login/restrict');
        } else {
            HttpResolver::redirect('?url=login/index');
        }
    }
    
    public function logout()
	{
        session_start();
        session_unset();

        HttpResolver::redirect('?url=login/index');
	}
}
