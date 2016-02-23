<?php

namespace App\Router;

use Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route;

/**
 * Router factory.
 */
class RouterFactory
{
	/**
	 * @param bool $secured
	 * @return \Nette\Application\IRouter
	 */
	public static function createRouter($secured)
	{
//		$router = new RouteList;
//		$router[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');
		
		$flags = $secured ? Route::SECURED : 0;
		
		$router = new RouteList();

		//index.php
		$router[] = new Route('index.php', 'Front:Homepage:default', Route::ONE_WAY);
		
		// Admin module
		$router[] = $adminRouter = new RouteList('Admin');
		$adminRouter[] = new Route('admin/<presenter>[/<action=default>[/<id [0-9]+>]]', [], $flags);
		
		// Front module
		$router[] = $frontRouter = new RouteList('Front');
		
		$frontRouter[] = new Route('[<locale sk|en>/]<presenter>[/<action=default>[/<id [0-9]+>]]', 'Homepage:default');
		
		return $router;
	}

}
