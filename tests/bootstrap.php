<?php

namespace Tests;

use Etten;

/** @var Etten\App\App $app */
$app = require __DIR__ . '/../app/bootstrap.php';

$app->addBootstrapFile(__DIR__ . '/bootstrap.neon');

Etten\App\Tests\TestCase::$app = $app;
