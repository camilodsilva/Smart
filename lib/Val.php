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
			return "invalid-max-length";
		}
	}

	public function digit($data){
		if(!ctype_digit($data)){
			return "invalid-digit";
		}
	}

	public function numeric($data){
		if(!is_numeric($data)){
			return "invalid-numeric";
		}
	}

	public function mandatory($data){
		if(empty($data)){
			return "invalid-mandatory";
		}
	}

	public function __call($name, $args){
		throw new Exception("$name does not exists inside of " . __CLASS__);
	}
}