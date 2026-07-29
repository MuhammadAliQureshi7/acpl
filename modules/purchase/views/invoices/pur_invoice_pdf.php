<?php defined('BASEPATH') or exit('No direct script access allowed');
$dimensions = $pdf->getPageDimensions();

$CI = &get_instance();
$CI->load->model('purchase/purchase_model');

$info_right_column = '';
$info_left_column  = '';

$info_right_column .= '<span style="font-weight:bold;font-size:27px;">' . _l('pur_invoice') . '</span><br />';
$info_right_column .= '<b style="color:#4e4e4e;"># ' . $pur_invoice->invoice_number . '</b>';

$info_left_column .= pdf_logo_url();
pdf_multi_row($info_left_column, $info_right_column, $pdf, ($dimensions['wk'] / 2) - $dimensions['lm']);
$pdf->ln(10);

$vendor = $CI->purchase_model->get_vendor($pur_invoice->vendor);
$vendor_name = $vendor ? $vendor->company : $pur_invoice->vendor;

$organization_info = '<div style="color:#424242;">' . format_organization_info() . '</div>';

$vendor_info = '<b>' . _l('vendor') . ':</b>';
$vendor_info .= '<div style="color:#424242;">' . $vendor_name . '</div>';
$vendor_info .= '<br />' . _l('invoice_date') . ': ' . _d($pur_invoice->invoice_date) . '<br />';
$vendor_info .= _l('payment_status') . ': ' . _l($pur_invoice->payment_status) . '<br />';
if(!empty($pur_invoice->adminnote)){
    $vendor_info .= '<br />' . _l('adminnote') . ': ' . $pur_invoice->adminnote . '<br />';
}

$left_info  = $organization_info;
$right_info = $vendor_info;
pdf_multi_row($left_info, $right_info, $pdf, ($dimensions['wk'] / 2) - $dimensions['lm']);

$pdf->Ln(hooks()->apply_filters('pdf_info_and_table_separator', 6));

$pur_invoice_items = $CI->purchase_model->get_pur_invoice_detail($pur_invoice->id);

$tblhtml = '<table width="100%" bgcolor="#fff" cellspacing="0" cellpadding="5" border="1">
    <tr height="30" style="background-color:#f0f0f0;font-weight:bold;">
        <th width="5%" align="center">#</th>
        <th width="35%" align="left">' . _l('item_description') . '</th>
        <th width="10%" align="right">' . _l('purchase_quantity') . '</th>
        <th width="13%" align="right">' . _l('rate') . '</th>
        <th width="13%" align="right">' . _l('subtotal') . '</th>
        <th width="12%" align="right">' . _l('total_tax') . '</th>
        <th width="12%" align="right">' . _l('subtotal_after_tax') . '</th>
    </tr>';
$i=1; $total_tax_sum = 0;
if(count($pur_invoice_items)>0){
    foreach($pur_invoice_items as $item){
        $subtotal = $item['qty'] * $item['rate'];
        $row_tax = floatval($item['total_tax']);
        $total_tax_sum += $row_tax;
        $tblhtml .= '<tr>
            <td align="center">' . $i++ . '</td>
            <td align="left">' . (isset($item['item_commodity_code']) && $item['item_commodity_code'] != '' ? '[' . $item['item_commodity_code'] . '] ' : (isset($item['item_code']) && $item['item_code'] != '' ? '[' . $item['item_code'] . '] ' : '')) . $item['description'] . '</td>
            <td align="right">' . $item['qty'] . '</td>
            <td align="right">' . app_format_money($item['rate'], '') . '</td>
            <td align="right">' . app_format_money($subtotal, '') . '</td>
            <td align="right">' . app_format_money($row_tax, '') . '</td>
            <td align="right">' . app_format_money($item['amount_after_tax'], '') . '</td>
        </tr>';
    }
}
$tblhtml .= '</table>';
$pdf->writeHTML($tblhtml, true, false, false, false, '');
$pdf->Ln(8);

$tbltotal = '<table cellpadding="6" style="font-size:' . ($font_size + 4) . 'px">';
$tbltotal .= '<tr><td align="right" width="85%"><strong>' . _l('invoice_subtotal') . '</strong></td>
    <td align="right" width="15%">' . app_format_money($pur_invoice->subtotal, '') . '</td></tr>';
if($total_tax_sum > 0){
    $tbltotal .= '<tr><td align="right" width="85%"><strong>' . _l('total_tax') . '</strong></td>
        <td align="right" width="15%">' . app_format_money($total_tax_sum, '') . '</td></tr>';
}
if(isset($pur_invoice->discount_total) && floatval($pur_invoice->discount_total) > 0){
    $tbltotal .= '<tr><td align="right" width="85%"><strong>' . _l('invoice_discount') . '</strong></td>
        <td align="right" width="15%">-' . app_format_money($pur_invoice->discount_total, '') . '</td></tr>';
}
if(isset($pur_invoice->adjustment) && floatval($pur_invoice->adjustment) != 0){
    $tbltotal .= '<tr><td align="right" width="85%"><strong>' . _l('invoice_adjustment') . '</strong></td>
        <td align="right" width="15%">' . app_format_money($pur_invoice->adjustment, '') . '</td></tr>';
}
$tbltotal .= '<tr style="background-color:#f0f0f0;">
    <td align="right" width="85%"><strong>' . _l('invoice_total') . '</strong></td>
    <td align="right" width="15%">' . app_format_money($pur_invoice->total, '') . '</td></tr>';
$tbltotal .= '</table>';
$pdf->writeHTML($tbltotal, true, false, false, false, '');

if(!empty($pur_invoice->vendor_note)){
    $pdf->Ln(4);
    $pdf->SetFont($font_name, 'B', $font_size);
    $pdf->writeHTMLCell('', '', '', '', _l('vendor_note'), 0, 1, false, true, 'L', true);
    $pdf->SetFont($font_name, '', $font_size);
    $pdf->Ln(2);
    $pdf->writeHTMLCell('', '', '', '', $pur_invoice->vendor_note, 0, 1, false, true, 'L', true);
}
