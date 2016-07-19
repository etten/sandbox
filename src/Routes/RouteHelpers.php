<?php

/**
 * This file is part of etten/sandbox.
 * Copyright © 2016 Jaroslav Hranička <hranicka@outlook.com>
 */

namespace Project\Routes;

class RouteHelpers
{

	/** @var \Transliterator|null */
	private static $transliterator;

	public static function webalize(string $s, string $charlist = ''): string
	{
		$s = self::toAscii($s);
		$s = strtolower($s);
		$s = preg_replace('#[^a-z0-9' . preg_quote($charlist, '#') . ']+#i', '-', $s);
		return trim($s, '-');
	}

	public static function toAscii(string $s): string
	{
		if (!self::$transliterator) {
			self::$transliterator = \Transliterator::create('Any-Latin; Latin-ASCII');
		}

		return self::$transliterator->transliterate($s);
	}

}
