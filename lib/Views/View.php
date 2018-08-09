<?php

namespace Smart\Views;

use Smart\Resolvers\Resolver as Resolver;
use Smart\Views\View as View;

class View
{
	public function __construct()
	{
		// No actions till now
	}

	// TODO: Enhacement on this behavior
	public function render($name, $noInclude = false)
	{
		$file = sprintf('%s/%s.php', Resolver::getResources()['viewsPath'], $name);
		
		if ($noInclude) {
			if(file_exists($file)) {
				require($file);
			}
		} else {
			require(sprintf('%s/layout/header.php', Resolver::getResources()['viewsPath']));
			
			if(file_exists($file)) {
				require($file);
			}

			require(sprintf('%s/layout/footer.php', Resolver::getResources()['viewsPath']));
		}
	}
}