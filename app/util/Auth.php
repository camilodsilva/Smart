<?php

/**
 *
 */
class Auth{
	
	function __construct(){}

	public static function handleLogin(){
		@session_start();
		$logged = $_SESSION['loggedIn'];

		if($logged == false){
			Session::destroy();
			header('location: '. URL .'login/index');
			exit;
		}
	}
}