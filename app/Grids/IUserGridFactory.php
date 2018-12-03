<?php declare(strict_types=1);

namespace App\Grids;

interface IUserGridFactory {

	/**
	 * @return \App\Grids\UserGrid
	 */
	function create();

}