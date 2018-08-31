<?php

namespace App;

use Nette;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;


class RouterFactory
{
	use Nette\StaticClass;

	/**
	 * @return Nette\Application\IRouter
	 */
	public static function createRouter()
	{
		$router = new RouteList;

		// Admin
		$router[] = new Route('admin/<presenter>/<action>/<id>', [
			'module' => 'Admin',
			'presenter' => 'Homepage',
			'action' => 'default',
			'id' => NULL,
		]);

		// Front
		$router[] = new Route('<presenter>[/<action>][/<id>]', [
			'module' => 'Front',
			'presenter' => 'Homepage',
			'action' => 'default',
			'id' => NULL,
		]);

		return $router;
	}
}
