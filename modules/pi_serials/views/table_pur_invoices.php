<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
    'invoice_number',
    db_prefix() . 'pur_vendor.company',
    'invoice_date',
    'total',
    '(SELECT COUNT(*) FROM ' . db_prefix() . 'itemserials WHERE ' . db_prefix() . 'itemserials.pi_id = ' . db_prefix() . 'pur_invoices.id) as serials_count',
];

$sIndexColumn = 'id';
$sTable       = db_prefix() . 'pur_invoices';
$join         = [
    'LEFT JOIN ' . db_prefix() . 'pur_vendor ON ' . db_prefix() . 'pur_vendor.userid = ' . db_prefix() . 'pur_invoices.vendor',
];
$where = [];
$additionalSelect = [
    db_prefix() . 'pur_invoices.id as id',
    db_prefix() . 'pur_invoices.invoice_number',
];

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, $additionalSelect);

$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];

    for ($i = 0; $i < count($aColumns); $i++) {
        $_data = $aRow[$aColumns[$i]];

        if ($aColumns[$i] == 'invoice_number') {
            $numberOutput = '<a href="' . admin_url('pi_serials/serials/' . $aRow['id']) . '">' . html_entity_decode($aRow['invoice_number']) . '</a>';
            $numberOutput .= '<div class="row-options">';
            if (has_permission('pi_serials', '', 'edit') || has_permission('pi_serials', '', 'create') || is_admin()) {
                $numberOutput .= '<a href="' . admin_url('pi_serials/serials/' . $aRow['id']) . '">' . _l('pi_serial_manage') . '</a>';
            }
            $numberOutput .= '</div>';

            $_data = $numberOutput;
        } elseif ($aColumns[$i] == db_prefix() . 'pur_vendor.company') {
            $_data = isset($aRow['company']) ? $aRow['company'] : '';
        } elseif ($aColumns[$i] == 'invoice_date') {
            $_data = _d($aRow['invoice_date'] ?? '');
        } elseif ($aColumns[$i] == 'total') {
            $_data = app_format_money($aRow['total'] ?? 0, '');
        } elseif ($aColumns[$i] == '(SELECT COUNT(*) FROM ' . db_prefix() . 'itemserials WHERE ' . db_prefix() . 'itemserials.pi_id = ' . db_prefix() . 'pur_invoices.id) as serials_count') {
            $_data = '<span class="label label-' . (intval($aRow['serials_count']) > 0 ? 'success' : 'default') . '">' . $aRow['serials_count'] . '</span>';
        }

        $row[] = $_data;
    }

    $actions = '';
    if (has_permission('pi_serials', '', 'edit') || has_permission('pi_serials', '', 'create') || is_admin()) {
        $actions .= '<a href="' . admin_url('pi_serials/serials/' . $aRow['id']) . '" class="btn btn-info btn-xs">' . _l('pi_serial_manage') . '</a> ';
    }
    if (has_permission('pi_serials', '', 'delete') || is_admin()) {
        $actions .= '<a href="javascript:void(0);" onclick="pi_serials_clear_ajax(' . $aRow['id'] . '); return false;" class="btn btn-danger btn-xs">' . _l('pi_serial_clear') . '</a>';
    }
    $row[] = $actions;

    $output['aaData'][] = $row;
}
