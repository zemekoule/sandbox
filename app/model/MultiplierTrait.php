<?php declare(strict_types=1);

namespace FrontModule;

use WebChemistry\Forms\Controls\Multiplier;

/* *
 * @method \WebChemistry\Forms\Controls\Multiplier addMultiplier(string $name, callable $factory, int $copies, int $maxCopies)
 */
trait MultiplierTrait
{

	// pokud nechceme dělat vlastní extensions u vlastních inputů.
	public function addMultiplier(string $name, callable $factory, int $copies, int $maxCopies) {
		return $this[$name] = new Multiplier($factory, $copies, $maxCopies);
	}
}