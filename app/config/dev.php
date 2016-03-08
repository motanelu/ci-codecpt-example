<?php
/**
 * Configuration for the development environment
 *
 * @see bootstrap.php
 */

$configuration = [
    'db.options' => [
        'driver'   => 'pdo_mysql',
        'host'     => '127.0.0.1',
        'dbname'   => 'phpbcn', // very secure, I know :)
        'user'     => 'phpbcn',
        'password' => 'test',
    ],
    'orm.strategy' => '\Doctrine\ORM\Mapping\UnderscoreNamingStrategy',
];

return $configuration;
