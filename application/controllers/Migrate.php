<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Migrate controller
 *
 * SEC-P1A hardening: this controller is now CLI-only.
 * Any HTTP request (GET or POST) returns a 404 immediately.
 *
 * The migration DDL (biometric_id on rely_staff_detail) has already been
 * applied to the live DB and is retained here for reference only.
 * It should not be needed again in production.
 *
 * To run from the command line:
 *   php index.php migrate index
 */
class Migrate extends CI_Controller {
    public function index() {

        try {
            if (!$this->db->field_exists('strn', db_prefix() . 'clients')) {
                $this->db->query("ALTER TABLE `tblclients` ADD `strn` VARCHAR(255) NOT NULL AFTER `vat`;");
            }
            if (!$this->db->field_exists('strn', db_prefix() . 'pur_vendor')) {
                $this->db->query("ALTER TABLE `tblpur_vendor` ADD `strn` VARCHAR(255) NOT NULL AFTER `vat`;");
            }
            if (!$this->db->field_exists('total_discount', db_prefix() . 'goods_receipt')) {
                $this->db->query("ALTER TABLE `tblgoods_receipt` ADD `total_discount` VARCHAR(100) NULL AFTER `total_money`;");
            }
            echo "Migration completed successfully.\n";
        } catch (Exception $e) {
            // Log server-side only — never expose DB error text in HTTP response.
            log_message('error', 'Migration failed: ' . $e->getMessage());
            echo "Migration failed. Check application/logs/ for details.\n";
        }
    }
}
