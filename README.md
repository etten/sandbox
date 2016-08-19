# Etten\Sandbox

Based on official [nette/sandbox](https://github.com/nette/sandbox).

Sandbox is a pre-packaged and pre-configured Nette Framework application
that you can use as the skeleton for your new applications.

[Nette](https://nette.org) is a popular tool for PHP web development.
It is designed to be the most usable and friendliest as possible. It focuses
on security and performance and is definitely one of the safest PHP frameworks.

## Requirements

* [PHP 7.0+](https://secure.php.net/)
* [Composer installed](https://getcomposer.org/)
* [Apache HTTP Server](https://httpd.apache.org/), [mod_rewrite](https://httpd.apache.org/docs/current/mod/mod_rewrite.html) enabled
* [NodeJS + NPM](https://nodejs.org/en/)
* [Bower](http://bower.io/)
* [Grunt](http://gruntjs.com/)

## Installing

The best way to install Sandbox is using [Composer](https://getcomposer.org/doc/00-intro.md).

When you have Composer installed, run these commands and follow instructions:

```bash
composer create-project etten/sandbox my-app
cd my-app
php install.php
```

Run `grunt-contrib-watch` tasks (for automatic LESS, TypeScript compiling):

```bash
grunt watch
```

This can be done automatically by IDE - WebStorm, PHPStorm, [see guide](https://www.jetbrains.com/help/webstorm/2016.2/using-grunt-task-runner.html#d264440e523).

Create/update database schema.

```bash
php web/index.php orm:schema-tool:update
```

Create a User (username and password).

```bash
php web/index.php user:create
```

Navigate your browser to the `www` directory and you will see a welcome page.
PHP 5.4 allows you run `php -S localhost:8888 -t www` to start the web server and
then visit `http://localhost:8888` in your browser.

You can log-in as created user via `http://localhost:8888/admin/sign/in`.

## Security warning

It is CRITICAL that **all** files and directories **except `www`** are NOT accessible
directly via a web browser! Necessary file for Apache is included (`.htaccess`).

**Make sure that is handled properly by your server!**

## Included packages

Study them for deeper understanding.

* [Nette framework](https://nette.org)
* [Etten\App](https://github.com/etten/app)
* [Etten\Migrations](https://github.com/etten/migrations)
* [Etten\Codestyle](https://github.com/etten/codestyle)
* [Etten\Deployment](https://github.com/etten/deployment)
* [Etten\SymfonyEvents](https://github.com/etten/symfony-events)
* [Etten\Doctrine](https://github.com/etten/doctrine)
* [Kdyby\Console](https://github.com/Kdyby/Console)
* [Kdyby\Events](https://github.com/Kdyby/Events)
* [Kdyby\Doctrine](https://github.com/Kdyby/Doctrine)

## CLI usage

Application has built-in CLI support.

It's realized via [Kdyby\Console](https://github.com/Kdyby/Console)
(Nette Extension of [Symfony\Console](http://symfony.com/doc/current/components/console/introduction.html)).

For list of each commands and options just run CLI:

```bash
php www/index.php -h
```

Via CLI you can for example:

* clean application caches **(including Nette\DI and Latte)**
* work with Doctrine DBAL and ORM
* run migrations
* deploy application (it should be launched by CI/CD service)

If you use [PhpStorm IDE](https://www.jetbrains.com/phpstorm/), you can operate with its built-in CLI tool.

It's very simple and you get autocomplete suggestions for all commands and their options!

Just go to `Settings - Tools - Command Line Tool Support`, add new `Tool Based on Symfony Console` and select
path to `www/index.php` of the application. You don't need remember all the commands now.

For more information see
[Symfony2 Command Line Tool Integration](https://confluence.jetbrains.com/display/PhpStorm/Symfony2+Command+Line+Tool+Integration+-+Symfony+Development+using+PhpStorm),
[Command Line Tools Based on Symfony Console (Doctrine, Laravel) in PhpStorm](http://blog.jetbrains.com/phpstorm/2013/09/command-line-tools-based-on-symfony-console-doctrine-laravel-in-phpstorm/).
