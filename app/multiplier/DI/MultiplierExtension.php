<?php

namespace Jarda\Forms\Controls\DI;

use Nette;
use Jarda\Forms\Controls\Multiplier;

class MultiplierExtension extends \WebChemistry\Forms\Controls\DI\MultiplierExtension {

	public function afterCompile(Nette\PhpGenerator\ClassType $class) {
		$init = $class->getMethods()['initialize'];
		$config = $this->validateConfig($this->defaults);

		$init->addBody(Multiplier::class . '::register(?);', [$config['name']]);
	}

}
