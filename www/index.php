<?php

namespace Etten\App;

$app = require __DIR__ . '/../app/bootstrap.php';

$maintainer = new Maintainer();
$locker = new Locker();

// Add some IPs for deploy permission.
$maintainer->developers[] = '192.168.1.1';

// Lock the Application
if ($maintainer->isJob('disable')) {
	$locker->lock();
	exit;
}

// Clean caches and unlock the Application.
if ($maintainer->isJob('enable')) {
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
