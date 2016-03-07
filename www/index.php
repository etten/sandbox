<?php

namespace Etten\App;

/** @var App $app */
$app = require __DIR__ . '/../app/bootstrap.php';

$locker = new Locker();

// Lock the Application
if ($app->isMaintainerJob('disable')) {
	$locker->lock();
	exit;
}

// Clean caches and unlock the Application.
if ($app->isMaintainerJob('enable')) {
	(new Cleaner($app))->clean();
	$locker->unlock();
	exit;
}

// If locked, show a Maintenance site.
if ($locker->isLocked()) {
	require __DIR__ . '/.maintenance.php';
}

// Finally run the Application.
$app->run();
