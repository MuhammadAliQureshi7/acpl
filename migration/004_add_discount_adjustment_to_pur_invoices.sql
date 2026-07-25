ALTER TABLE `tblpur_invoices` 
  ADD COLUMN `discount_percent` DECIMAL(15,2) NULL DEFAULT '0.00' AFTER `total`,
  ADD COLUMN `discount_total` DECIMAL(15,2) NULL DEFAULT '0.00' AFTER `discount_percent`,
  ADD COLUMN `discount_type` VARCHAR(30) NULL AFTER `discount_total`,
  ADD COLUMN `adjustment` DECIMAL(15,2) NULL AFTER `discount_type`;
