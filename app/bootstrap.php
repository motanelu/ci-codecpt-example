<?php

use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;

// load the correct configuration
$env = getenv('SILEX_ENV');
if (!$env) {
    $env = 'dev';
}
$file = __DIR__ . '/config/' . $env . '.php';
if (!file_exists($file)) {
    throw new \Exception('Cannot find config file');
}
$config = include($file);

// create the Silex App & DI container
$app = new Application();

$app['debug'] = ($env == 'dev');

$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/views',
));

$app->register(new DoctrineServiceProvider(), array(
    'db.options' => $config['db.options'],
));

$namingStrategy = $config['orm.strategy'];
$app->register(new DoctrineOrmServiceProvider(), array(
    'orm.em.options' => array(
        'mappings' => array(
            array(
                'alias'     => 'pbcn',
                'type'      => 'annotation',
                'namespace' => 'PhpBcn\Entity',
                'path'      => __DIR__ . '/../src/PhpBcn/Entity/',
                'use_simple_annotation_reader' => false,
            )
        )
    ),
    'orm.strategy.naming' => new $namingStrategy(),
));

$app['em'] = $app['orm.em']; // use the same key as Symfony

require_once __DIR__ . '/controllers/site.php';

$app->run();
