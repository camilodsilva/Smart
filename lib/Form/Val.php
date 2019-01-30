<?php

class Val {
	
	function __construct(){}

	public function minlength($data, $arg){
		if(strlen($data) < $arg){
			return "You string must be greater or equals to $arg long";
		}
	}

	public function maxlength($data, $arg){
		if(strlen($data) > $arg){
			return "You string can only be $arg long";
		}
	}

	public function digit($data){
		if(!ctype_digit($data)){
			return "You string must be a digit";
		}
	}

	public function __call($name, $args){
		throw new Exception("$name does not exists inside of " . __CLASS__);
	}
}