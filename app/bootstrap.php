<?php

namespace App;

use Etten;

require __DIR__ . '/../vendor/autoload.php';

$app = new Etten\App\App(__DIR__ . '/..');

$app->addBootstrapFile(__DIR__ . '/config/bootstrap.neon');

$app->addConfigFile(__DIR__ . '/config/config.neon');
$app->addConfigFile(__DIR__ . '/config/config.local.neon');

$app->addExtension(new Etten\App\Extensions\SystemSetup());

return $app;
