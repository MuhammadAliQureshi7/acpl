<?php defined('BASEPATH') or exit('No direct script access allowed');
$dimensions = $pdf->getPageDimensions();

$CI = &get_instance();
$CI->load->model('purchase/purchase_model');

$company_name    = get_option('invoice_company_name');
$company_address = get_option('invoice_company_address');

$vendor = null;
if (is_numeric($pur_invoice->vendor) && $pur_invoice->vendor != 0) {
    $vendor = $CI->db->get_where(db_prefix() . 'pur_vendor', ['userid' => $pur_invoice->vendor])->row();
}

$vendor_no      = '';
$vendor_name    = '';
$vendor_address = '';
$vendor_ntn     = '';
$vendor_strn    = '';

if ($vendor) {
    $vendor_no      = (isset($vendor->vendor_code) && $vendor->vendor_code != '' ? $vendor->vendor_code : $vendor->userid);
    $vendor_name    = $vendor->company;
    $vendor_address = trim(implode(', ', array_filter([$vendor->address, $vendor->city, $vendor->state])));
    $vendor_ntn     = (isset($vendor->vat) ? $vendor->vat : '');
    $vendor_strn    = (isset($vendor->strn) ? $vendor->strn : '');
}

$company_vat  = get_option('company_vat');
$company_strn = get_option('company_strn');

$pur_invoice_items = $CI->purchase_model->get_pur_invoice_detail($pur_invoice->id);

$esc = function ($v) {
    return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
};

$pdf->setMargins(6.5, 8, 6.5);

$html = '';

$logo = pdf_logo_url();
$html .= '<table width="100%" cellpadding="2" cellspacing="0"><tr><td align="left">' . $logo . '</td></tr>';
$html .= '<tr><td align="left"><div style="font-size:16px;font-weight:bold;">' . html_entity_decode($company_name) . '</div></td></tr>';
if ($company_address != '') {
    $html .= '<tr><td align="left"><div style="font-size:16px;">' . html_entity_decode($company_address) . '</div></td></tr>';
}
$html .= '</table>';

$html .= '<br />';
$html .= '<div style="text-align:center;font-size:18px;font-weight:bold;">INVOICE</div>';
$html .= '<br />';

$html .= '<table width="100%" cellpadding="5" cellspacing="0" style="font-size:18px;">';
$html .= '<tr><td width="22%"><b>Supplier No.</b></td><td width="28%">' . $esc($vendor_no) . '</td><td width="22%"><b>Invoice Date</b></td><td width="28%">' . _d($pur_invoice->invoice_date) . '</td></tr>';
$html .= '<tr><td><b>Supplier Name</b></td><td>' . $esc($vendor_name) . '</td><td><b>Invoice No.</b></td><td>' . $esc($pur_invoice->invoice_number) . '</td></tr>';
$html .= '<tr><td><b>Supplier Address</b></td><td>' . $esc($vendor_address) . '</td><td><b>NTN No.</b></td><td>' . $esc($company_vat) . '</td></tr>';
$html .= '<tr><td><b>Supplier NTN No.</b></td><td>' . $esc($vendor_ntn) . '</td><td><b>STR No.</b></td><td>' . $esc($company_strn) . '</td></tr>';
$html .= '<tr><td><b>Supplier STR No.</b></td><td>' . $esc($vendor_strn) . '</td><td></td><td></td></tr>';
$html .= '</table>';

$html .= '<br />';
$html .= '<hr width="100%" color="#999999" size="0.2" />';

$html .= '<table width="100%" cellpadding="5" cellspacing="0" style="font-size:18px;">';
$html .= '<tr style="font-weight:bold;text-align:center;">';
$html .= '<td width="16%">Code</td>';
$html .= '<td width="21%">Product Name</td>';
$html .= '<td width="8%">Qty</td>';
$html .= '<td width="12%">Rate/Unit</td>';
$html .= '<td width="17%">Total Amount<br />Excluding Tax</td>';
$html .= '<td width="8%">Tax</td>';
$html .= '<td width="18%">Value Inclusive<br />of Sales Tax</td>';
$html .= '</tr></table>';
$html .= '<hr width="100%" color="#000000" size="0.4" />';

if (count($pur_invoice_items) > 0) {
    foreach ($pur_invoice_items as $item) {
        $item_code = (isset($item['item_commodity_code']) && $item['item_commodity_code'] != '' ? $item['item_commodity_code'] : (isset($item['item_code']) ? $item['item_code'] : ''));
        $subtotal  = floatval($item['qty']) * floatval($item['rate']);
        $row_tax   = floatval($item['total_tax']);
        // $gst_rate  = ($subtotal > 0 && $row_tax > 0) ? rtrim(rtrim(number_format(($row_tax / $subtotal) * 100, 2), '0'), '.') . '%' : '';

        $html .= '<table width="100%" cellpadding="5" cellspacing="0" style="font-size:18px;"><tr>';
        $html .= '<td width="16%" align="center">' . $esc($item_code) . '</td>';
        $html .= '<td width="21%">' . $esc($item['description']) . '</td>';
        $html .= '<td width="8%" align="center">' . $item['qty'] . '</td>';
        $html .= '<td width="12%" align="right">' . app_format_money($item['rate'], '') . '</td>';
        $html .= '<td width="17%" align="right">' . app_format_money($subtotal, '') . '</td>';
        $html .= '<td width="8%" align="center">' . $row_tax . '</td>';
        $html .= '<td width="18%" align="right">' . app_format_money($item['amount_after_tax'], '') . '</td>';
        $html .= '</tr></table>';
        $html .= '<hr width="100%" color="#000000" size="0.2" />';
    }
}

$html .= '<table width="100%" cellpadding="5" cellspacing="0" style="font-size:18px;"><tr>';
$html .= '<td width="16%"></td><td width="21%" style="font-weight:bold;">TOTAL</td><td width="8%"></td><td width="12%"></td><td width="17%"></td><td width="8%"></td>';
$html .= '<td width="18%" align="right" style="font-weight:bold;">' . app_format_money($pur_invoice->total, '') . '</td>';
$html .= '</tr></table>';
$html .= '<hr width="100%" color="#000000" size="0.4" />';

$html .= '<br /><br />';
$html .= '<table width="100%" cellpadding="5" cellspacing="0" style="font-size:18px;">';
$html .= '<tr><td width="55%"><b>AS ON:</b> ' . _d(date('Y-m-d')) . '</td><td width="45%" align="right"></td></tr>';
$html .= '<tr><td><b>PAYABLE AMOUNT (EXCLUDING ABOVE INVOICE)</b></td><td align="right"></td></tr>';
$html .= '<tr><td><b>OVERDUE AMOUNT:</b> after payment period decided</td><td align="right"></td></tr>';
$html .= '</table>';

if (!empty($pur_invoice->vendor_note)) {
    $html .= '<br />';
    $html .= '<div style="font-size:15px;"><b>' . _l('vendor_note') . ': </b>' . $pur_invoice->vendor_note . '</div>';
}

$pdf->writeHTML($html, true, false, false, false, '');
