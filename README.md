# Etten\Sandbox

Sandbox is a pre-packaged and pre-configured Nette Framework application
that you can use as the skeleton for your new applications.

[Nette](https://nette.org) is a popular tool for PHP web development.
It is designed to be the most usable and friendliest as possible. It focuses
on security and performance and is definitely one of the safest PHP frameworks.


## Installing

The best way to install Sandbox is using Composer. If you don't have Composer yet, download
it following [the instructions](https://doc.nette.org/composer). Then use command:

`$ composer create-project etten/sandbox my-app`

Make directories `temp` and `log` writable. Navigate your browser
to the `www` directory and you will see a welcome page. PHP 5.4 allows
you run `php -S localhost:8888 -t www` to start the web server and
then visit `http://localhost:8888` in your browser.

It is CRITICAL that all files and directories except `www` are NOT accessible
directly via a web browser! Necessary file for Apache is included (`.htaccess`).
Make sure that is handled properly by your server!
