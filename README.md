# Etten\Sandbox

Based on official [nette/sandbox](https://github.com/nette/sandbox).

Sandbox is a pre-packaged and pre-configured Nette Framework application
that you can use as the skeleton for your new applications.

[Nette](https://nette.org) is a popular tool for PHP web development.
It is designed to be the most usable and friendliest as possible. It focuses
on security and performance and is definitely one of the safest PHP frameworks.

## Installing

1. The best way to install Sandbox is using Composer. If you don't have Composer yet, download
it and install following [the instructions](https://getcomposer.org/doc/00-intro.md). Then use command:

	`$ composer create-project etten/sandbox my-app`

2. Make directories `temp`, `log` + `tests/temp`, `tests/log` writable.

3. Create local configuration files and set up as you need (eg. database credentials).

	`$ cp app/config/config.local.neon.dist app/config/config.local.neon`

	`$ cp tests/config.local.neon.dist tests/config.local.neon`

4. Navigate your browser to the `www` directory and you will see a welcome page.
PHP 5.4 allows you run `php -S localhost:8888 -t www` to start the web server and
then visit `http://localhost:8888` in your browser.

## Security warning

It is CRITICAL that **all** files and directories **except `www`** are NOT accessible
directly via a web browser! Necessary file for Apache is included (`.htaccess`).

**Make sure that is handled properly by your server!**

## Included packages

* [Nette framework](https://nette.org)
* [Etten\App](https://github.com/etten/app)
* [Artfocus\Migrations](https://github.com/artfocus/migrations)
* [Artfocus\Codestyle](https://bitbucket.org/artfocus/codestyle.git)
* [Kdyby\Console](https://github.com/Kdyby/Console)
* [Kdyby\Events](https://github.com/Kdyby/Events)
* [Kdyby\Doctrine](https://github.com/Kdyby/Doctrine)
