<?php

namespace Smart\Resolvers;

class Resolver
{
	private static $config = 'app\\config';

	public static function nonEmptyUrl(array $url)
	{
		return !empty($url[0]) ? true : false;
	}

	public static function getResources()
	{
		return require sprintf('%s\\%s\\resources.php', getcwd(), self::$config);
	}

	public static function getDatabaseInformation()
	{
		return require sprintf('%s\\%s\\database.php', getcwd(), self::$config);
	}

	public static function getSecurityInformation()
	{
		return require sprintf('%s\\%s\\security.php', getcwd(), self::$config);
	}

	public static function getAppInformation()
	{
		return require sprintf('%s\\%s\\app.php', getcwd(), self::$config);
	}
}
