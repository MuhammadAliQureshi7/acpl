ALTER TABLE `tblgoods_delivery_detail` 
  ADD COLUMN `total_tax` DECIMAL(15,2) NULL DEFAULT '0.00' AFTER `sub_total`;
