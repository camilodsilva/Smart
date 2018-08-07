<?php

/**
 * - Fill out a form
 *     - Post to PHP
 *     - Sanitize
 *     - Validate
 *     - Return data
 *     - Write to database
 */
class Form {
	
	/**
	 * @var array  $_postData    Stores the posted data
	 * @var string $_currentItem Immediately posted item
	 * @var object $_currentItem The validator object
	 * @var array  $_error       Holds current forms erros
	 */
	private $_postData    = array();
	private $_currentItem = null;
	private $_val         = null;
	private $_error       = array();

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
		$this->_postData[$field] = $_POST[$field];
		$this->_currentItem = $field;

		return $this;
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
                    $e = '';
                    foreach ($this->_error as $key => $value) {
                            $e .= ucfirst($key) .': '. $value .'<br />';
                    }
                    throw new Exception($e);
		}
	}
}