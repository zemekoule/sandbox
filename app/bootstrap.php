<?php

require __DIR__ . '/../vendor/autoload.php';

$configurator = new Nette\Configurator;

$debug = false;
if((isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] === '127.0.0.1') || getenv('NETTE_DEBUG') === '1') {
	$debug = true;
}

$configurator->setDebugMode($debug);
$configurator->enableTracy(__DIR__ . '/../log');

$configurator->setTimeZone('Europe/Prague');
$configurator->setTempDirectory(__DIR__ . '/../temp');

$configurator->createRobotLoader()
	->addDirectory(__DIR__)
	->register();

$configurator->addConfig(__DIR__ . '/config/config.neon');
$configurator->addConfig(__DIR__ . '/config/config.local.neon');

$container = $configurator->createContainer();

$application = $container->getByType(\Nette\Application\Application::class);

$application->onPresenter[] = function(\Nette\Application\Application $application, \Nette\Application\UI\Presenter $presenter) use ($container) {
	$cachedAnnotationReader = $container->getByType(\Doctrine\Common\Annotations\Reader::class);

	$loggableListener = new Gedmo\Loggable\LoggableListener;
	$loggableListener->setAnnotationReader($cachedAnnotationReader);
	$loggableListener->setUsername((string) $presenter->getUser()->getId());

	$container->getByType(\Doctrine\Common\EventManager::class)
		->addEventSubscriber($loggableListener);
};

return $container;
