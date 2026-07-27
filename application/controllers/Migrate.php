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
            $this->db->query("ALTER TABLE `tblitemable` ADD `total_tax` DECIMAL(15,2) NOT NULL AFTER `tax_id`;");
            echo "Migration completed successfully.\n";
        } catch (Exception $e) {
            // Log server-side only — never expose DB error text in HTTP response.
            log_message('error', 'Migration failed: ' . $e->getMessage());
            echo "Migration failed. Check application/logs/ for details.\n";
        }
    }
}
