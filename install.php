#!/usr/bin/env php
<?php

namespace Etten\Installation;

class CliHelpers
{

	public static function ask(string $question, string $default = ''):string
	{
		echo $question . ' ';
		if ($default !== '') {
			echo '[' . $default . '] ';
		}

		$handle = fopen('php://stdin', 'r');
		$return = trim(fgets($handle));
		fclose($handle);

		return ($return === '') ?
			$default :
			$return;
	}

}

class InstallHelpers
{

	public static function setupConfig(array $data)
	{
		foreach (self::searchConfigFiles() as $file) {
			$fileContent = file_get_contents($file);

			$counter = 0;
			foreach ($data as $key => $value) {
				$fileContent = str_replace("#<$key>", $value, $fileContent, $iterationCounter);
				$counter += $iterationCounter;
			}
			file_put_contents($file, $fileContent);

			if ($counter) {
				echo "Set-up ({$counter}x): $file\n";
			}
		}
	}

	private static function searchConfigFiles()
	{
		return array_merge(
			self::searchFiles('app/config', '.*\.neon'),
			self::searchFiles('tests', '.*\.neon')
		);
	}

	private static function searchFiles(string $folder, string $pattern = '.*')
	{
		$dir = new \RecursiveDirectoryIterator($folder, \RecursiveDirectoryIterator::SKIP_DOTS);
		$ite = new \RecursiveIteratorIterator($dir);
		$files = new \RegexIterator($ite, '~' . $pattern . '~', \RegexIterator::GET_MATCH);

		$fileList = [];
		foreach ($files as $file) {
			$fileList = array_merge($fileList, $file);
		}

		return $fileList;
	}

}

echo "\n";
echo "Running Installation...\n";
echo "-----------------------\n";

// Rewrite config only when .local.neon file is not created yet.
if (!is_file('app/config/config.local.neon')) {
	$data['database-user'] = CliHelpers::ask('Enter your local DB username:', 'root');
	$data['database-password'] = CliHelpers::ask('Enter your local DB password:');
	$data['database-name'] = CliHelpers::ask('Enter your local DB name:');
	$data['database-test-name'] = $data['database-name'] . '_test';
	echo "\n";

	// Create .local.neon configurations.
	copy('app/config/config.local.neon.dist', 'app/config/config.local.neon');
	copy('tests/config.local.neon.dist', 'tests/config.local.neon');

	// Generate secret token
	$data['developer-token'] = bin2hex(random_bytes(20));

	$data = array_filter($data, 'strlen');
	InstallHelpers::setupConfig($data);
}

echo "Done.\n";

if (php_uname('s') === 'Linux') {
	echo "\n";
	echo "----------------------\n";
	echo "Setting permissions...\n";

	passthru('chmod -R 777 log');
	passthru('chmod -R 777 storage');
	passthru('chmod -R 777 temp');

	passthru('chmod -R 777 tests/log');
	passthru('chmod -R 777 tests/temp');

	echo "Done.\n";
}

echo "Running Composer...\n";
echo "-------------------\n";
passthru('composer update');
echo "Done.\n";

echo "\n";
echo "Running Bower...\n";
echo "----------------\n";
passthru('bower update');
echo "Done.\n";

echo "\n";
echo "Running migrations...\n";
echo "---------------------\n";
passthru('php ' . escapeshellarg(__DIR__ . '/www/index.php') . ' migrations:continue');
echo "Done.\n";

echo "\n";
echo "Installation completed.\n";
