<?php

// Uncomment this line if you must temporarily take down your site for maintenance.
// require __DIR__ . '/.maintenance.php';

/** @var \Etten\App\App $app */
$app = require __DIR__ . '/../app/bootstrap.php';

// PhpStorm & Symfony Console
// See https://youtrack.jetbrains.com/issue/WI-29627
if (isset($argv[1]) && $argv[1] === '-V') {
	die('Symfony version 2.8.0');
}

$app->run();
