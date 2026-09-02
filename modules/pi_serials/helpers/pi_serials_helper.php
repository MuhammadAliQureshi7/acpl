<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Format purchase invoice number. Uses the purchase module helper when
 * available and falls back to the raw invoice_number otherwise.
 *
 * @param  int    $pi_id  purchase invoice id
 * @return string
 */
function pi_serials_format_invoice_number($pi_id)
{
    if (function_exists('get_pur_invoice_number')) {
        return get_pur_invoice_number($pi_id);
    }

    $CI = &get_instance();
    $CI->db->where('id', intval($pi_id));
    $invoice = $CI->db->get(db_prefix() . 'pur_invoices')->row();

    return $invoice ? $invoice->invoice_number : '';
}
