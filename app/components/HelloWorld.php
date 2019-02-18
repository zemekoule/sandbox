<?php declare(strict_types=1);

namespace App\Components;

use Nette\Application\UI\Control;

class HelloWorld extends Control
{
	public function render()
	{
		$this->template->name = "Jarda";
		$this->template->render(__DIR__ . '/world.latte');
	}

}