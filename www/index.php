<?php

// Uncomment this line if you must temporarily take down your site for maintenance.
// require __DIR__ . '/.maintenance.php';

/** @var \Etten\App\App $app */
$app = require __DIR__ . '/../app/bootstrap.php';
$app->run();
