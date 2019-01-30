<?php

/**
 * - Fill out a form
 *     - Post to PHP
 *     - Sanitize
 *     - Validate
 *     - Return data
 *     - Write to database
 */
class AjaxForm {
	
	/**
	 * @var array  $_postData    Stores the posted data
	 * @var string $_currentItem Immediately posted item
	 * @var object $_currentItem The validator object
	 * @var array  $_error       Holds current forms erros
	 */
	private $_postData      = array();
	private $_arrayPostData = array();
	private $_currentItem   = null;
	private $_val           = null;
	private $_error         = array();

	/**
	 * __construct Instantiates the validator class
	 */
	function __construct(){
		$this->_val = new Val();
	}

	/**
	 * post - This is to run $_POST
	 *
	 * @param  string $field The HTML field name to post
	 * @return class object
	 */
	public function post($field){
		$this->_postData[$field] = $this->_arrayPostData[$field];
		$this->_currentItem = $field;

		return $this;
	}

	/**
	 * arrayPost - This is to run array post
	 *
	 * @param  array $arrayData The array that will be evaluated
	 */
	public function arrayPost(array $arrayData){
		$this->_arrayPostData = $arrayData;
	}

	/**
	 * fecth - Return posted data
	 *
	 * @param  mixed $field
	 * @return mixed string or array
	 */
	public function fetch($field = false){
		if($field)
			if(isset($this->_postData[$field]))
				return $this->_postData[$field];
			else
				return false;
		else
			return $this->_postData;
	}

	/**
	 * val - This is to validate
	 *
	 * @param  string  $typeOfValidator A method from the Form/Val class
	 * @param  string  @arg             A property to validate
	 * @return object                   the class itself
	 */
	public function val($typeOfValidator, $arg = null){
		if($arg == null)
			$error = $this->_val->{$typeOfValidator}($this->_postData[$this->_currentItem]);
		else
			$error = $this->_val->{$typeOfValidator}($this->_postData[$this->_currentItem], $arg);

		if($error)
			$this->_error[$this->_currentItem] = $error;

		return $this;	
	}

	/**
	 * submit - Handles the form and throws an exception upon error.
	 *
	 * @return boolean
	 * @throws exception
	 */
	public function submit(){
		if(empty($this->_error))
			return true;
		else{
			$translation = unserialize(TRANSLATION);
			$e = '<br/>';
			foreach ($this->_error as $key => $value) {
				$e .= '- '. $translation['validation']['pt_BR'][$key][$value] . '<br/>';
			}
			throw new Exception($e);
		}
	}
}