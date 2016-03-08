<?php
/**
 * Doctrine CLI configuration file
 *
 * vendor/bin/doctrine in the console
 */

require_once 'vendor/autoload.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;

$env = getenv('SILEX_ENV');
if (!$env) {
    $env = 'dev';
}
$file = __DIR__ . '/app/config/' . $env . '.php';
if (!file_exists($file)) {
    throw new \Exception('Cannot find config file');
}

$configuration = include($file);

$paths = array(
    __DIR__ . '/src/PhpBcn/Entity',
);

$dbOptions = $configuration['db.options'];
$namingStrategy = $configuration['orm.strategy'];

$config = Setup::createAnnotationMetadataConfiguration($paths, true, null, null, false);
$config->setNamingStrategy(new $namingStrategy());
$entityManager = EntityManager::create($dbOptions, $config);

return ConsoleRunner::createHelperSet($entityManager);
