<?php defined('BASEPATH') or exit('No direct script access allowed');

$dimensions = $pdf->getPageDimensions();

$CI = &get_instance();

$company_name    = get_option('invoice_company_name');
$company_address = get_option('invoice_company_address');

$client = null;
if (is_numeric($invoice->clientid) && $invoice->clientid != 0) {
    $client = $CI->db->get_where(db_prefix() . 'clients', ['userid' => $invoice->clientid])->row();
}

$customer_no      = '';
$customer_name    = '';
$customer_address = '';
$customer_ntn     = '';
$customer_strn    = '';

if ($client) {
    $customer_no      = $client->userid;
    $customer_name    = $client->company;
    $customer_address = trim(implode(', ', array_filter([$client->billing_street, $client->billing_city, $client->billing_state])));
    if ($customer_address == '') {
        $customer_address = trim(implode(', ', array_filter([$client->address, $client->city, $client->state])));
    }
    $customer_ntn  = (isset($client->vat) ? $client->vat : '');
    $customer_strn = (isset($client->strn) ? $client->strn : '');
}

$company_vat  = get_option('company_vat');
$company_strn = get_option('company_strn');

$sales_person = '';
if (isset($invoice->sale_agent) && $invoice->sale_agent != 0) {
    $sales_person = get_staff_full_name($invoice->sale_agent);
}

$invoice_items = isset($invoice->items) ? $invoice->items : get_items_by_type('invoice', $invoice->id);

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
$html .= '<tr><td width="22%"><b>Customer No.</b></td><td width="28%">' . $esc($customer_no) . '</td><td width="22%"><b>Invoice Date</b></td><td width="28%">' . _d($invoice->date) . '</td></tr>';
$html .= '<tr><td><b>Customer Name</b></td><td>' . $esc($customer_name) . '</td><td><b>Invoice No.</b></td><td>' . $esc($invoice_number) . '</td></tr>';
$html .= '<tr><td><b>Customer Address</b></td><td>' . $esc($customer_address) . '</td><td><b>NTN No.</b></td><td>' . $esc($company_vat) . '</td></tr>';
$html .= '<tr><td><b>Customer NTN No.</b></td><td>' . $esc($customer_ntn) . '</td><td><b>STR No.</b></td><td>' . $esc($company_strn) . '</td></tr>';
$html .= '<tr><td><b>Customer STR No.</b></td><td>' . $esc($customer_strn) . '</td><td><b>Sales Person</b></td><td>' . $esc($sales_person) . '</td></tr>';
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

if (count($invoice_items) > 0) {
    foreach ($invoice_items as $item) {
        $item_code = (isset($item['item_code']) && $item['item_code'] != '' ? $item['item_code'] : '');
        if (is_numeric($item_code) && $item_code != 0) {
            $item_info = $CI->db->get_where(db_prefix() . 'items', ['id' => $item_code])->row();
            $item_code = ($item_info && $item_info->commodity_code != '' ? $item_info->commodity_code : $item_code);
        }
        $subtotal = floatval($item['qty']) * floatval($item['rate']);
        $row_tax  = floatval(isset($item['total_tax']) ? $item['total_tax'] : 0);
        // $gst_rate = ($subtotal > 0 && $row_tax > 0) ? rtrim(rtrim(number_format(($row_tax / $subtotal) * 100, 2), '0'), '.') . '%' : '';

        $html .= '<table width="100%" cellpadding="5" cellspacing="0" style="font-size:18px;"><tr>';
        $html .= '<td width="16%" align="center">' . $esc($item_code) . '</td>';
        $html .= '<td width="21%">' . $esc($item['description']) . '</td>';
        $html .= '<td width="8%" align="center">' . $item['qty'] . '</td>';
        $html .= '<td width="12%" align="right">' . app_format_money($item['rate'], $invoice->currency_name) . '</td>';
        $html .= '<td width="17%" align="right">' . app_format_money($subtotal, $invoice->currency_name) . '</td>';
        $html .= '<td width="8%" align="center">' . $row_tax . '</td>';
        $html .= '<td width="18%" align="right">' . app_format_money(($subtotal + $row_tax), $invoice->currency_name) . '</td>';
        $html .= '</tr></table>';
        $html .= '<hr width="100%" color="#000000" size="0.2" />';
    }
}

$html .= '<table width="100%" cellpadding="5" cellspacing="0" style="font-size:18px;"><tr>';
$html .= '<td width="16%"></td><td width="21%" style="font-weight:bold;">TOTAL</td><td width="8%"></td><td width="12%"></td><td width="17%"></td><td width="8%"></td>';
$html .= '<td width="18%" align="right" style="font-weight:bold;">' . app_format_money($invoice->total, $invoice->currency_name) . '</td>';
$html .= '</tr></table>';
$html .= '<hr width="100%" color="#000000" size="0.4" />';

$html .= '<br /><br />';
$html .= '<table width="100%" cellpadding="5" cellspacing="0" style="font-size:18px;">';
$html .= '<tr><td width="55%"><b>AS ON:</b> ' . _d(date('Y-m-d')) . '</td><td width="45%" align="right"></td></tr>';
$html .= '<tr><td><b>OUTSTANDING AMOUNT (EXCLUDING ABOVE INVOICE)</b></td><td align="right"></td></tr>';
$html .= '<tr><td><b>OVERDUE AMOUNT:</b> after credit period decided</td><td align="right"></td></tr>';
$html .= '</table>';

if (!empty($invoice->clientnote)) {
    $html .= '<br />';
    $html .= '<div style="font-size:15px;"><b>' . _l('invoice_note') . ': </b>' . $invoice->clientnote . '</div>';
}

$html .= '<br /><br />';
$html .= '<table width="100%" cellpadding="5" cellspacing="0" style="font-size:18px;"><tr>';
$html .= '<td width="50%"><b>For ' . html_entity_decode($company_name) . '</b></td>';
$html .= '<td width="50%" align="right"><b>Customer Signature and Stamp</b></td>';
$html .= '</tr></table>';

$pdf->writeHTML($html, true, false, false, false, '');
