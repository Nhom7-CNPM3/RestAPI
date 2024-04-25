<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/../vendor/autoload.php';

use Slim\Middleware\MethodOverrideMiddleware;

// Provider Configuration
$provider = new \venndev\restapi\provider\Provider();
$provider->setConfigPath(__DIR__ . '/../../resources/config.yml');

// MySQL Configuration and Connection
$databaseData = $provider->getConfig()['database'];
$provider->setMySQL(new \venndev\restapi\provider\mysql\MySQL(
    $databaseData['host'],
    $databaseData['username'],
    $databaseData['password'],
    $databaseData['database'],
    $databaseData['port']
));

$application = new \venndev\restapi\app\Application();

$app = $application->getApp();
$app->addErrorMiddleware(true, true, true);
$app->add(new MethodOverrideMiddleware());

$application->enable();