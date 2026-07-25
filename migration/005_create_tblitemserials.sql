CREATE TABLE `tblitemserials` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `item_id` INT(11) NOT NULL,
  `pi_id` INT(11) NOT NULL,
  `serial_number` VARCHAR(255) NOT NULL,
  `is_sold` TINYINT(1) NOT NULL DEFAULT '0',
  `si_id` INT(11) NULL DEFAULT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `pi_id` (`pi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
