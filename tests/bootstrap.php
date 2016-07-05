<?php

namespace Tests;

use Etten;

/** @var Etten\App\App $app */
$app = require __DIR__ . '/../app/bootstrap.php';

$app->addBootstrapFile(__DIR__ . '/bootstrap.neon');
$app->addConfigFile(__DIR__ . '/config.test.neon', 'test');
$app->addConfigFile(__DIR__ . '/config.local.neon', 'local');
$app->createConfigurator();

Etten\App\Tests\ContainerTestCase::$app = $app;

return $app;
