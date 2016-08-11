CREATE TABLE IF NOT EXISTS `route` (
	`id` BINARY(16) NOT NULL COMMENT '(DC2Type:uuid_binary)',
	`url` VARCHAR(255)
	COLLATE utf8_unicode_ci NOT NULL,
	`type` VARCHAR(255)
	COLLATE utf8_unicode_ci NOT NULL,
	`title` VARCHAR(255)
	COLLATE utf8_unicode_ci NOT NULL,
	`keywords` VARCHAR(255)
	COLLATE utf8_unicode_ci NOT NULL,
	`description` VARCHAR(255)
	COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `UNIQ_2C42079F47645AE` (`url`)
)
	ENGINE = InnoDB
	DEFAULT CHARSET = utf8
	COLLATE = utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `article` (
	`id` BINARY(16) NOT NULL COMMENT '(DC2Type:uuid_binary)',
	`name` VARCHAR(255)
	COLLATE utf8_unicode_ci NOT NULL,
	`route_id` BINARY(16) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `UNIQ_23A0E6634ECB4E6` (`route_id`),
	CONSTRAINT `FK_23A0E6634ECB4E6` FOREIGN KEY (`route_id`) REFERENCES `route` (`id`)
)
	ENGINE = InnoDB
	DEFAULT CHARSET = utf8
	COLLATE = utf8_unicode_ci;
