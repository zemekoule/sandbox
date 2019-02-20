<?php declare(strict_types=1);

namespace App\Components;

interface INameFormFactory
{

	/**
	 * @param \App\Components\NameForm $nameForm
	 *
	 * @return \App\Components\NameForm
	 */
	public function create(NameForm $nameForm);

}