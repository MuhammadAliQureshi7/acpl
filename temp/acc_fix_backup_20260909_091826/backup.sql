-- backup 2026-09-09 09:18:26
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `tblacc_accounts`;
CREATE TABLE `tblacc_accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `key_name` varchar(255) DEFAULT NULL,
  `number` varchar(45) DEFAULT NULL,
  `parent_account` int DEFAULT NULL,
  `account_type_id` int NOT NULL,
  `account_detail_type_id` int NOT NULL,
  `balance` decimal(15,2) DEFAULT NULL,
  `balance_as_of` date DEFAULT NULL,
  `description` text,
  `default_account` int NOT NULL DEFAULT '0',
  `active` int NOT NULL DEFAULT '1',
  `access_token` text,
  `account_id` varchar(255) DEFAULT NULL,
  `plaid_status` tinyint NOT NULL DEFAULT '0' COMMENT '1=>verified, 0=>not verified',
  `plaid_account_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8mb3;
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('89','ASSETS',NULL,'1000','0','16','200',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('90','Current Assets',NULL,'1100','0','16','200',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('91','Cash in Hand',NULL,'1110','0','17','200',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('92','Petty Cash',NULL,'1120','0','17','200',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('93','Cash at Bank',NULL,'1130','0','17','200',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('94','Bank Account - 1',NULL,'1131','0','18','200',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('95','Bank Account - 2',NULL,'1132','0','18','200',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('96','Accounts Receivable',NULL,'1140','0','17','200',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('97','Advance to Suppliers',NULL,'1150','0','17','200',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('98','Employee Advances',NULL,'1160','0','17','200',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('99','Prepaid Expenses',NULL,'1170','0','17','200',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('100','Inventory',NULL,'1180','0','17','200',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('101','Input Sales Tax / GST',NULL,'1190','0','17','200',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('102','Non-Current Assets',NULL,'1200','0','16','200',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('103','Furniture & Fixtures',NULL,'1230','0','19','200',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('104','Office Equipment',NULL,'1240','0','19','200',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('105','Computers & IT Equipment',NULL,'1250','0','19','200',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('106','Vehicles',NULL,'1260','0','19','200',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('107','Accumulated Depreciation',NULL,'1290','0','19','201',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('108','Accumulated Depreciation - Equipment',NULL,'1292','0','20','201',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('109','Accumulated Depreciation - Vehicles',NULL,'1293','0','20','201',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('110','Long-Term Investments',NULL,'1300','0','16','200',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('111','Security Deposits',NULL,'1310','0','19','200',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('112','LIABILITIES',NULL,'2000','0','21','223',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('113','Current Liabilities',NULL,'2100','0','21','223',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('114','Accounts Payable',NULL,'2110','0','22','223',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('115','Accrued Expenses',NULL,'2120','0','22','223',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('116','Salaries Payable',NULL,'2130','0','22','223',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('117','Taxes Payable',NULL,'2140','0','22','223',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('118','Sales Tax / GST Payable',NULL,'2141','0','23','223',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('119','Withholding Tax Payable',NULL,'2142','0','23','223',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('120','Customer Advances',NULL,'2150','0','22','223',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('121','Short-Term Loan',NULL,'2160','0','22','223',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('122','Non-Current Liabilities',NULL,'2200','0','21','223',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('123','Long-Term Bank Loan',NULL,'2210','0','24','223',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('124','Lease Liability',NULL,'2220','0','24','223',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('125','Other Long-Term Liabilities',NULL,'2230','0','24','223',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('126','EQUITY',NULL,'3000','0','25','209',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('127','Owner\'s / Share Capital',NULL,'3100','0','25','209',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('128','Partner / Owner Capital',NULL,'3110','0','26','209',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('129','Additional Capital',NULL,'3120','0','26','209',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('130','Retained Earnings',NULL,'3200','0','25','209',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('131','Current Year Profit / Loss',NULL,'3300','0','25','209',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('132','Drawings / Dividends',NULL,'3400','0','25','206',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('133','REVENUE',NULL,'4000','0','27','227',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('134','Sales Revenue',NULL,'4100','0','27','227',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('135','Local Sales',NULL,'4110','0','28','227',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('136','Export Sales',NULL,'4120','0','28','227',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('137','Service Revenue',NULL,'4130','0','27','227',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('138','Other Operating Revenue',NULL,'4150','0','27','227',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('139','Sales Returns & Allowances',NULL,'4200','0','27','208',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('140','Other Income',NULL,'4300','0','27','227',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('141','Interest Income',NULL,'4310','0','29','227',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('142','Gain on Sale of Assets',NULL,'4320','0','29','227',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('143','Exchange Gain',NULL,'4330','0','29','227',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('144','COST OF SALES / COGS',NULL,'5000','0','30','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('145','Cost of Goods Sold',NULL,'5100','0','30','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('146','Freight / Carriage Inward',NULL,'5140','0','31','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('147','Purchase Expense',NULL,'5150','0','31','212','1.00','0000-00-00','','0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('148','Purchase Returns',NULL,'5200','0','30','207',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('149','OPERATING EXPENSES',NULL,'6000','0','32','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('150','Selling & Distribution Expenses',NULL,'6100','0','32','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('151','Advertising Expense',NULL,'6110','0','33','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('152','Marketing Expense',NULL,'6120','0','33','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('153','Sales Commission',NULL,'6130','0','33','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('154','Delivery Expense',NULL,'6140','0','33','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('155','Freight / Carriage Outward',NULL,'6150','0','33','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('156','Administrative Expenses',NULL,'6200','0','32','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('157','Salaries & Wages',NULL,'6210','0','34','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('158','Rent Expense',NULL,'6220','0','34','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('159','Electricity Expense',NULL,'6230','0','34','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('160','Gas Expense',NULL,'6240','0','34','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('161','Water Expense',NULL,'6250','0','34','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('162','Telephone Expense',NULL,'6260','0','34','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('163','Internet Expense',NULL,'6270','0','34','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('164','Office Supplies',NULL,'6280','0','34','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('165','Printing & Stationery',NULL,'6290','0','34','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('166','Repairs & Maintenance',NULL,'6300','0','32','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('167','Vehicle Maintenance',NULL,'6310','0','35','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('168','Professional Expenses',NULL,'6400','0','32','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('169','Audit Fee',NULL,'6410','0','36','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('170','Legal Fee',NULL,'6420','0','36','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('171','Consultancy Fee',NULL,'6430','0','36','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('172','Depreciation & Amortization',NULL,'6500','0','32','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('173','Depreciation - Building',NULL,'6510','0','37','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('174','Depreciation - Equipment',NULL,'6520','0','37','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('175','Depreciation - Vehicles',NULL,'6530','0','37','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('176','Insurance Expense',NULL,'6600','0','32','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('177','Travel & Conveyance',NULL,'6700','0','32','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('178','Local Conveyance',NULL,'6710','0','38','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('179','Travelling Expense',NULL,'6720','0','38','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('180','Bank & Financial Charges',NULL,'6800','0','32','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('181','Bank Charges',NULL,'6810','0','39','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('182','Interest Expense',NULL,'6820','0','39','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('183','Other Operating Expenses',NULL,'6900','0','32','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('184','Bad Debt Expense',NULL,'6910','0','40','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('185','Exchange Loss',NULL,'6920','0','40','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('186','Miscellaneous Expense',NULL,'6930','0','40','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('187','TAX EXPENSE',NULL,'7000','0','41','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('188','Income Tax Expense',NULL,'7100','0','41','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);
INSERT INTO `tblacc_accounts` (`id`,`name`,`key_name`,`number`,`parent_account`,`account_type_id`,`account_detail_type_id`,`balance`,`balance_as_of`,`description`,`default_account`,`active`,`access_token`,`account_id`,`plaid_status`,`plaid_account_name`) VALUES ('189','Deferred Tax Expense',NULL,'7200','0','41','211',NULL,NULL,NULL,'0','1',NULL,NULL,'0',NULL);

DROP TABLE IF EXISTS `tblacc_account_type_details`;
CREATE TABLE `tblacc_account_type_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `account_type_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `note` text,
  `statement_of_cash_flows` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=230 DEFAULT CHARSET=utf8mb3;
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('200','16','Asset','','cash_flows_from_investing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('201','19','Contra Asset','','cash_flows_from_investing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('202','20','Contra Asset','','cash_flows_from_investing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('203','17','Asset','','cash_flows_from_investing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('204','18','Asset','','cash_flows_from_investing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('205','19','Asset','','cash_flows_from_investing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('206','25','Contra Equity','','cash_flows_from_investing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('207','30','Contra Expense','','cash_flows_from_financing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('208','27','Contra Revenue','','cash_flows_from_operating_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('209','25','Equity','','cash_flows_from_investing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('210','26','Equity','','cash_flows_from_investing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('211','30','Expense','','cash_flows_from_financing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('212','31','Expense','','cash_flows_from_financing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('213','32','Expense','','cash_flows_from_financing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('214','33','Expense','','cash_flows_from_financing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('215','34','Expense','','cash_flows_from_financing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('216','35','Expense','','cash_flows_from_financing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('217','36','Expense','','cash_flows_from_financing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('218','37','Expense','','cash_flows_from_financing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('219','38','Expense','','cash_flows_from_financing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('220','39','Expense','','cash_flows_from_financing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('221','40','Expense','','cash_flows_from_financing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('222','41','Expense','','cash_flows_from_financing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('223','21','Liability','','cash_flows_from_financing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('224','22','Liability','','cash_flows_from_financing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('225','23','Liability','','cash_flows_from_financing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('226','24','Liability','','cash_flows_from_financing_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('227','27','Revenue','','cash_flows_from_operating_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('228','28','Revenue','','cash_flows_from_operating_activities');
INSERT INTO `tblacc_account_type_details` (`id`,`account_type_id`,`name`,`note`,`statement_of_cash_flows`) VALUES ('229','29','Revenue','','cash_flows_from_operating_activities');

DROP TABLE IF EXISTS `tblacc_account_history`;
CREATE TABLE `tblacc_account_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `account` int NOT NULL,
  `debit` decimal(15,2) NOT NULL DEFAULT '0.00',
  `credit` decimal(15,2) NOT NULL DEFAULT '0.00',
  `description` text,
  `rel_id` int DEFAULT NULL,
  `rel_type` varchar(45) DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL,
  `addedfrom` int DEFAULT NULL,
  `customer` int DEFAULT NULL,
  `reconcile` int NOT NULL DEFAULT '0',
  `split` int NOT NULL DEFAULT '0',
  `item` int DEFAULT NULL,
  `paid` int NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `tax` int DEFAULT NULL,
  `payslip_type` varchar(45) DEFAULT NULL,
  `vendor` int DEFAULT NULL,
  `itemable_id` int DEFAULT NULL,
  `cleared` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3;
INSERT INTO `tblacc_account_history` (`id`,`account`,`debit`,`credit`,`description`,`rel_id`,`rel_type`,`datecreated`,`addedfrom`,`customer`,`reconcile`,`split`,`item`,`paid`,`date`,`tax`,`payslip_type`,`vendor`,`itemable_id`,`cleared`) VALUES ('1','1','490000.00','0.00','','1','invoice','2026-07-29 11:26:11','2','5','0','66','1','0','2026-07-29','0',NULL,NULL,'6','0');
INSERT INTO `tblacc_account_history` (`id`,`account`,`debit`,`credit`,`description`,`rel_id`,`rel_type`,`datecreated`,`addedfrom`,`customer`,`reconcile`,`split`,`item`,`paid`,`date`,`tax`,`payslip_type`,`vendor`,`itemable_id`,`cleared`) VALUES ('2','66','0.00','490000.00','','1','invoice','2026-07-29 11:26:11','2','5','0','1','1','0','2026-07-29','0',NULL,NULL,'6','0');
INSERT INTO `tblacc_account_history` (`id`,`account`,`debit`,`credit`,`description`,`rel_id`,`rel_type`,`datecreated`,`addedfrom`,`customer`,`reconcile`,`split`,`item`,`paid`,`date`,`tax`,`payslip_type`,`vendor`,`itemable_id`,`cleared`) VALUES ('3','1','1500000.00','0.00','','2','invoice','2026-08-13 14:22:20','3','6','0','66','2','0','2026-08-04','0',NULL,NULL,'13','0');
INSERT INTO `tblacc_account_history` (`id`,`account`,`debit`,`credit`,`description`,`rel_id`,`rel_type`,`datecreated`,`addedfrom`,`customer`,`reconcile`,`split`,`item`,`paid`,`date`,`tax`,`payslip_type`,`vendor`,`itemable_id`,`cleared`) VALUES ('4','66','0.00','1500000.00','','2','invoice','2026-08-13 14:22:20','3','6','0','1','2','0','2026-08-04','0',NULL,NULL,'13','0');
INSERT INTO `tblacc_account_history` (`id`,`account`,`debit`,`credit`,`description`,`rel_id`,`rel_type`,`datecreated`,`addedfrom`,`customer`,`reconcile`,`split`,`item`,`paid`,`date`,`tax`,`payslip_type`,`vendor`,`itemable_id`,`cleared`) VALUES ('5','1','700000.00','0.00','','2','invoice','2026-08-13 14:22:20','3','6','0','66','3','0','2026-08-04','0',NULL,NULL,'14','0');
INSERT INTO `tblacc_account_history` (`id`,`account`,`debit`,`credit`,`description`,`rel_id`,`rel_type`,`datecreated`,`addedfrom`,`customer`,`reconcile`,`split`,`item`,`paid`,`date`,`tax`,`payslip_type`,`vendor`,`itemable_id`,`cleared`) VALUES ('6','66','0.00','700000.00','','2','invoice','2026-08-13 14:22:20','3','6','0','1','3','0','2026-08-04','0',NULL,NULL,'14','0');
INSERT INTO `tblacc_account_history` (`id`,`account`,`debit`,`credit`,`description`,`rel_id`,`rel_type`,`datecreated`,`addedfrom`,`customer`,`reconcile`,`split`,`item`,`paid`,`date`,`tax`,`payslip_type`,`vendor`,`itemable_id`,`cleared`) VALUES ('7','1','70000.00','0.00','','2','invoice','2026-08-13 14:22:20','3','6','0','66','4','0','2026-08-04','0',NULL,NULL,'15','0');
INSERT INTO `tblacc_account_history` (`id`,`account`,`debit`,`credit`,`description`,`rel_id`,`rel_type`,`datecreated`,`addedfrom`,`customer`,`reconcile`,`split`,`item`,`paid`,`date`,`tax`,`payslip_type`,`vendor`,`itemable_id`,`cleared`) VALUES ('8','66','0.00','70000.00','','2','invoice','2026-08-13 14:22:20','3','6','0','1','4','0','2026-08-04','0',NULL,NULL,'15','0');
INSERT INTO `tblacc_account_history` (`id`,`account`,`debit`,`credit`,`description`,`rel_id`,`rel_type`,`datecreated`,`addedfrom`,`customer`,`reconcile`,`split`,`item`,`paid`,`date`,`tax`,`payslip_type`,`vendor`,`itemable_id`,`cleared`) VALUES ('9','1','70000.00','0.00','','2','invoice','2026-08-13 14:22:20','3','6','0','66','5','0','2026-08-04','0',NULL,NULL,'16','0');
INSERT INTO `tblacc_account_history` (`id`,`account`,`debit`,`credit`,`description`,`rel_id`,`rel_type`,`datecreated`,`addedfrom`,`customer`,`reconcile`,`split`,`item`,`paid`,`date`,`tax`,`payslip_type`,`vendor`,`itemable_id`,`cleared`) VALUES ('10','66','0.00','70000.00','','2','invoice','2026-08-13 14:22:20','3','6','0','1','5','0','2026-08-04','0',NULL,NULL,'16','0');
INSERT INTO `tblacc_account_history` (`id`,`account`,`debit`,`credit`,`description`,`rel_id`,`rel_type`,`datecreated`,`addedfrom`,`customer`,`reconcile`,`split`,`item`,`paid`,`date`,`tax`,`payslip_type`,`vendor`,`itemable_id`,`cleared`) VALUES ('19','1','1000000.00','0.00','','3','invoice','2026-09-09 14:15:53','1','6','0','66','4','1','2026-09-09','0',NULL,NULL,'31','0');
INSERT INTO `tblacc_account_history` (`id`,`account`,`debit`,`credit`,`description`,`rel_id`,`rel_type`,`datecreated`,`addedfrom`,`customer`,`reconcile`,`split`,`item`,`paid`,`date`,`tax`,`payslip_type`,`vendor`,`itemable_id`,`cleared`) VALUES ('20','66','0.00','1000000.00','','3','invoice','2026-09-09 14:15:53','1','6','0','1','4','1','2026-09-09','0',NULL,NULL,'31','0');
INSERT INTO `tblacc_account_history` (`id`,`account`,`debit`,`credit`,`description`,`rel_id`,`rel_type`,`datecreated`,`addedfrom`,`customer`,`reconcile`,`split`,`item`,`paid`,`date`,`tax`,`payslip_type`,`vendor`,`itemable_id`,`cleared`) VALUES ('21','1','5000000.00','0.00','','3','invoice','2026-09-09 14:15:53','1','6','0','66','7','1','2026-09-09','0',NULL,NULL,'32','0');
INSERT INTO `tblacc_account_history` (`id`,`account`,`debit`,`credit`,`description`,`rel_id`,`rel_type`,`datecreated`,`addedfrom`,`customer`,`reconcile`,`split`,`item`,`paid`,`date`,`tax`,`payslip_type`,`vendor`,`itemable_id`,`cleared`) VALUES ('22','66','0.00','5000000.00','','3','invoice','2026-09-09 14:15:53','1','6','0','1','7','1','2026-09-09','0',NULL,NULL,'32','0');
INSERT INTO `tblacc_account_history` (`id`,`account`,`debit`,`credit`,`description`,`rel_id`,`rel_type`,`datecreated`,`addedfrom`,`customer`,`reconcile`,`split`,`item`,`paid`,`date`,`tax`,`payslip_type`,`vendor`,`itemable_id`,`cleared`) VALUES ('23','13','6000000.00','0.00','','1','payment','2026-09-09 14:15:53','1','6','0','1',NULL,'0','2026-09-09',NULL,NULL,NULL,NULL,'0');
INSERT INTO `tblacc_account_history` (`id`,`account`,`debit`,`credit`,`description`,`rel_id`,`rel_type`,`datecreated`,`addedfrom`,`customer`,`reconcile`,`split`,`item`,`paid`,`date`,`tax`,`payslip_type`,`vendor`,`itemable_id`,`cleared`) VALUES ('24','1','0.00','6000000.00','','1','payment','2026-09-09 14:15:53','1','6','0','13',NULL,'0','2026-09-09',NULL,NULL,NULL,NULL,'0');

DROP TABLE IF EXISTS `tblacc_journal_entries`;
CREATE TABLE `tblacc_journal_entries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `number` varchar(45) DEFAULT NULL,
  `description` text,
  `journal_date` date DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `datecreated` datetime DEFAULT NULL,
  `addedfrom` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `tblacc_transfers`;
CREATE TABLE `tblacc_transfers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `transfer_funds_from` int NOT NULL,
  `transfer_funds_to` int NOT NULL,
  `transfer_amount` decimal(15,2) DEFAULT NULL,
  `date` varchar(45) DEFAULT NULL,
  `description` text,
  `datecreated` datetime DEFAULT NULL,
  `addedfrom` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `tblacc_payment_mode_mappings`;
CREATE TABLE `tblacc_payment_mode_mappings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `payment_mode_id` int NOT NULL,
  `payment_account` int NOT NULL DEFAULT '0',
  `deposit_to` int NOT NULL DEFAULT '0',
  `expense_payment_account` int NOT NULL DEFAULT '0',
  `expense_deposit_to` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `tblacc_tax_mappings`;
CREATE TABLE `tblacc_tax_mappings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tax_id` int NOT NULL,
  `payment_account` int NOT NULL DEFAULT '0',
  `deposit_to` int NOT NULL DEFAULT '0',
  `expense_payment_account` int NOT NULL DEFAULT '0',
  `expense_deposit_to` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `tblacc_expense_category_mappings`;
CREATE TABLE `tblacc_expense_category_mappings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `payment_account` int NOT NULL DEFAULT '0',
  `deposit_to` int NOT NULL DEFAULT '0',
  `preferred_payment_method` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `tblacc_item_automatics`;
CREATE TABLE `tblacc_item_automatics` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item_id` int NOT NULL,
  `inventory_asset_account` int NOT NULL DEFAULT '0',
  `income_account` int NOT NULL DEFAULT '0',
  `expense_account` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
INSERT INTO tbloptions (name, value) VALUES ('acc_accounting_method', 'accrual');
INSERT INTO tbloptions (name, value) VALUES ('acc_active_expense_category_mapping', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_active_payment_mode_mapping', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_add_default_account', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_add_default_account_new', '0');
INSERT INTO tbloptions (name, value) VALUES ('acc_allow_changes_after_viewing', 'allow_changes_after_viewing_a_warning');
INSERT INTO tbloptions (name, value) VALUES ('acc_close_book_password', '');
INSERT INTO tbloptions (name, value) VALUES ('acc_close_book_passwordr', '');
INSERT INTO tbloptions (name, value) VALUES ('acc_close_the_books', '0');
INSERT INTO tbloptions (name, value) VALUES ('acc_closing_date', '');
INSERT INTO tbloptions (name, value) VALUES ('acc_credit_note_automatic_conversion', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_credit_note_deposit_to', '13');
INSERT INTO tbloptions (name, value) VALUES ('acc_credit_note_payment_account', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_enable_account_numbers', '0');
INSERT INTO tbloptions (name, value) VALUES ('acc_expense_automatic_conversion', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_expense_deposit_to', '80');
INSERT INTO tbloptions (name, value) VALUES ('acc_expense_payment_account', '13');
INSERT INTO tbloptions (name, value) VALUES ('acc_expense_payment_deposit_to', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_expense_payment_payment_account', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_expense_tax_deposit_to', '29');
INSERT INTO tbloptions (name, value) VALUES ('acc_expense_tax_payment_account', '13');
INSERT INTO tbloptions (name, value) VALUES ('acc_first_month_of_financial_year', 'January');
INSERT INTO tbloptions (name, value) VALUES ('acc_first_month_of_tax_year', 'same_as_financial_year');
INSERT INTO tbloptions (name, value) VALUES ('acc_invoice_automatic_conversion', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_invoice_deposit_to', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_invoice_payment_account', '66');
INSERT INTO tbloptions (name, value) VALUES ('acc_payment_automatic_conversion', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_payment_deposit_to', '13');
INSERT INTO tbloptions (name, value) VALUES ('acc_payment_expense_automatic_conversion', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_payment_payment_account', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_payment_sale_automatic_conversion', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_pl_net_pay_automatic_conversion', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_pl_net_pay_deposit_to', '56');
INSERT INTO tbloptions (name, value) VALUES ('acc_pl_net_pay_payment_account', '13');
INSERT INTO tbloptions (name, value) VALUES ('acc_pl_tax_paye_automatic_conversion', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_pl_tax_paye_deposit_to', '28');
INSERT INTO tbloptions (name, value) VALUES ('acc_pl_tax_paye_payment_account', '13');
INSERT INTO tbloptions (name, value) VALUES ('acc_pl_total_insurance_automatic_conversion', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_pl_total_insurance_deposit_to', '32');
INSERT INTO tbloptions (name, value) VALUES ('acc_pl_total_insurance_payment_account', '13');
INSERT INTO tbloptions (name, value) VALUES ('acc_pur_order_automatic_conversion', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_pur_order_deposit_to', '80');
INSERT INTO tbloptions (name, value) VALUES ('acc_pur_order_payment_account', '13');
INSERT INTO tbloptions (name, value) VALUES ('acc_pur_payment_automatic_conversion', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_pur_payment_deposit_to', '37');
INSERT INTO tbloptions (name, value) VALUES ('acc_pur_payment_payment_account', '16');
INSERT INTO tbloptions (name, value) VALUES ('acc_show_account_numbers', '0');
INSERT INTO tbloptions (name, value) VALUES ('acc_tax_automatic_conversion', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_tax_deposit_to', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_tax_payment_account', '29');
INSERT INTO tbloptions (name, value) VALUES ('acc_wh_decrease_deposit_to', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_wh_decrease_payment_account', '37');
INSERT INTO tbloptions (name, value) VALUES ('acc_wh_increase_deposit_to', '37');
INSERT INTO tbloptions (name, value) VALUES ('acc_wh_increase_payment_account', '87');
INSERT INTO tbloptions (name, value) VALUES ('acc_wh_loss_adjustment_automatic_conversion', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_wh_opening_stock_automatic_conversion', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_wh_opening_stock_deposit_to', '37');
INSERT INTO tbloptions (name, value) VALUES ('acc_wh_opening_stock_payment_account', '88');
INSERT INTO tbloptions (name, value) VALUES ('acc_wh_stock_export_automatic_conversion', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_wh_stock_export_deposit_to', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_wh_stock_export_payment_account', '37');
INSERT INTO tbloptions (name, value) VALUES ('acc_wh_stock_import_automatic_conversion', '1');
INSERT INTO tbloptions (name, value) VALUES ('acc_wh_stock_import_deposit_to', '37');
INSERT INTO tbloptions (name, value) VALUES ('acc_wh_stock_import_payment_account', '87');
INSERT INTO tbloptions (name, value) VALUES ('access_tickets_to_none_staff_members', '0');
SET FOREIGN_KEY_CHECKS=1;
