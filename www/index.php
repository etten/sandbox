<?php

namespace Etten\App;

/** @var App $app */
$app = require __DIR__ . '/../app/bootstrap.php';

$maintainer = $app->createMaintainer();

$locker = new Locker();

// Lock the Application
$maintainer->addJob('disable', function () use ($locker) {
	$locker->lock();
	exit;
});

// Clean caches, then run Migrations.
$maintainer->addJob('enable', function () use ($app) {
	(new Cleaner($app))->clean();
	(new Console($app))->run('migrations:continue');
});

// Unlock the Application - it's ready.
$maintainer->addJob('enable', function () use ($locker) {
	$locker->unlock();
	exit;
});

$maintainer->runJobs();

// If locked, show a Maintenance site, otherwise run the App.
if ($locker->isLocked()) {
	require __DIR__ . '/.maintenance.php';
} else {
	$app->run();
}
