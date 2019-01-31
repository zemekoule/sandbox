<?php

namespace Jarda\Forms\Controls;

use Nette\ComponentModel\IComponent;
use Nette\Forms\Controls\SelectBox;
use Nette\Forms\Container;
use Nette\Utils\ArrayHash;

class Multiplier extends \WebChemistry\Forms\Controls\Multiplier {

	/**
	 * @param int $number
	 * @param array|ArrayHash $defaults
	 * @return IComponent|null
	 */
	public function addCopy($number = null, $defaults = []) {
		if (!is_numeric($number)) {
			$number = $this->createNumber();
		} else if ($component = Container::getComponent($number, false)) {
			return $component;
		}

		$container = $this->createContainer();
		$this->fillContainer($container);
		if ($defaults) {
			foreach ($defaults as $attr => &$value) {
				if (($selectBox = $container->getComponent($attr)) instanceof SelectBox) {
					/** @var SelectBox $selectBox */
					$selectBox->checkDefaultValue();
					if (($selectBox->getPrompt() !== false) && ($value === "")) {
						$value = null;
					}
				}
			}
			$container->setDefaults($defaults, $this->erase);
		}
		$this->attachContainer($container, $number);
		$this->attachRemoveButton($container);

		$this->totalCopies++;

		return $container;
	}

	private function attachRemoveButton(Container $container) {
		if (!$this->removeButton) {
			return;
		}

		$container->addComponent($this->removeButton->create($this), self::SUBMIT_REMOVE_NAME);
	}

	/**
	 * @param string $name
	 */
	public static function register($name = 'addMultiplier') {
		Container::extensionMethod($name, function (Container $form, $name, $factory, $copyNumber = 1, $maxCopies = null) {
			$multiplier = new Multiplier($factory, $copyNumber, $maxCopies);
			$multiplier->setCurrentGroup($form->getCurrentGroup());

			return $form[$name] = $multiplier;
		});
	}

}
