<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!$CI->db->table_exists(db_prefix() . 'itemserials')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "itemserials` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `item_id` int(11) NOT NULL,
      `pi_id` int(11) NOT NULL,
      `serial_number` varchar(255) NOT NULL,
      `is_sold` tinyint(1) NOT NULL DEFAULT '0',
      `si_id` int(11) DEFAULT NULL,
      `created_at` datetime NOT NULL,
      `updated_at` datetime DEFAULT NULL,
      PRIMARY KEY (`id`),
      KEY `item_id` (`item_id`),
      KEY `pi_id` (`pi_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

if (!$CI->db->table_exists(db_prefix() . 'pur_invoices')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "pur_invoices` (
      `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `number` int(11) NOT NULL,
      `invoice_number` TEXT NULL,
      `invoice_date` DATE NULL,
      `subtotal` DECIMAL(15,2) NULL,
      `tax_rate` INT(11) NULL,
      `tax` DECIMAL(15,2) NULL,
      `total` DECIMAL(15,2) NULL,
      `contract` int(11) NULL,
      `vendor` int(11) NULL,
      `transactionid` MEDIUMTEXT NULL,
      `transaction_date` DATE NULL,
      `payment_request_status` VARCHAR(30) NULL,
      `payment_status` VARCHAR(30) NULL,
      `vendor_note` TEXT NULL,
      `adminnote` TEXT NULL,
      `terms` TEXT NULL,
      `add_from` INT(11) NULL,
      `date_add` DATE NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}
