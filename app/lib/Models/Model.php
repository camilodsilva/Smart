<?php

namespace Smart\Models;

use Smart\Database\Database as Database;
use Smart\Resolvers\Resolver as Resolver;

class Model
{
	protected $db = null;
	private $credentials = null;

	function __construct()
	{
		$this->credentials = Resolver::getDatabaseInformation();
		$this->db = new Database(
			$this->credentials['dbType'],
			$this->credentials['dbHost'],
			$this->credentials['dbName'],
			$this->credentials['dbUser'],
			$this->credentials['dbPass']
		);
	}
}