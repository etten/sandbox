CREATE TABLE `article` (
	`id` CHAR(36) NOT NULL
	COMMENT '(DC2Type:guid)'
	COLLATE 'utf8_unicode_ci',
	`name` VARCHAR(255) NOT NULL
	COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`id`)
)
	COLLATE = 'utf8_unicode_ci'
	ENGINE = InnoDB;
