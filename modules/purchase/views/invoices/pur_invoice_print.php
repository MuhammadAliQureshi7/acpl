<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title><?php echo html_entity_decode($title); ?></title>
<style>
body{font-family:DejaVu Sans,sans-serif;font-size:12px;margin:20px;color:#424242;}
.company-logo{float:left;width:50%;}
.invoice-header{float:right;width:50%;text-align:right;}
.invoice-header h1{font-size:27px;font-weight:bold;margin:0 0 5px;}
.invoice-header .number{color:#4e4e4e;}
.clear{clear:both;}
.info-box{width:48%;float:left;margin-top:15px;}
.info-box.right{float:right;}
.info-box b{font-size:13px;}
table{width:100%;border-collapse:collapse;margin-top:10px;}
th,td{padding:6px 8px;border:1px solid #ddd;text-align:left;}
th{background-color:#f0f0f0;font-weight:bold;}
.text-right{text-align:right;}
.total-table{width:60%;float:right;margin-top:10px;}
.total-table td{padding:6px 8px;border:none;text-align:right;}
.total-table .total-row{background-color:#f0f0f0;font-weight:bold;}
@media print{body{margin:0;}.no-print{display:none;}}
</style></head>
<body>
<div class="invoice-header">
  <h1><?php echo _l('purchase_invoice'); ?></h1>
  <div class="number"># <?php echo html_entity_decode($pur_invoice->invoice_number); ?></div>
</div>
<div class="clear"></div>

<div class="info-box">
  <b><?php echo _l('vendor'); ?></b>
  <div><?php echo html_entity_decode($vendor_name); ?></div>
</div>
<div class="info-box right">
  <b><?php echo _l('invoice_date'); ?>:</b> <?php echo _d($pur_invoice->invoice_date); ?><br>
  <b><?php echo _l('payment_status'); ?>:</b> <?php echo _l($pur_invoice->payment_status); ?><br>
</div>
<div class="clear"></div>

<table>
  <tr>
    <th>#</th>
    <th><?php echo _l('item_description'); ?></th>
    <th class="text-right"><?php echo _l('purchase_quantity'); ?></th>
    <th class="text-right"><?php echo _l('rate'); ?></th>
    <th class="text-right"><?php echo _l('subtotal'); ?></th>
    <th class="text-right"><?php echo _l('subtotal_after_tax'); ?></th>
  </tr>
  <?php $i=1; $total_tax=0; if(isset($pur_invoice_items) && count($pur_invoice_items)>0){ foreach($pur_invoice_items as $item){
    $subtotal = $item['qty'] * $item['rate'];
    $total_tax += floatval($item['tax_id']); ?>
  <tr>
    <td><?php echo $i++; ?></td>
    <td><?php echo html_entity_decode((isset($item['item_commodity_code']) && $item['item_commodity_code'] != '' ? '['.$item['item_commodity_code'].'] ' : (isset($item['item_code']) && $item['item_code'] != '' ? '['.$item['item_code'].'] ' : '')) . $item['description']); ?></td>
    <td class="text-right"><?php echo html_entity_decode($item['qty']); ?></td>
    <td class="text-right"><?php echo app_format_money($item['rate'], ''); ?></td>
    <td class="text-right"><?php echo app_format_money($subtotal, ''); ?></td>
    <td class="text-right"><?php echo app_format_money($item['amount_after_tax'], ''); ?></td>
  </tr>
  <?php } } ?>
</table>

<div class="total-table">
  <table>
    <tr><td width="70%"><strong><?php echo _l('subtotal'); ?></strong></td><td width="30%"><?php echo app_format_money($pur_invoice->subtotal, ''); ?></td></tr>
    <?php if($total_tax > 0){ ?><tr><td><strong><?php echo _l('total_tax'); ?></strong></td><td><?php echo app_format_money($total_tax, ''); ?></td></tr><?php } ?>
    <?php if(isset($pur_invoice->adjustment) && $pur_invoice->adjustment != 0){ ?><tr><td><strong><?php echo _l('adjustment'); ?></strong></td><td><?php echo app_format_money($pur_invoice->adjustment, ''); ?></td></tr><?php } ?>
    <tr class="total-row"><td><strong><?php echo _l('invoice_total'); ?></strong></td><td><?php echo app_format_money($pur_invoice->total, ''); ?></td></tr>
  </table>
</div>
<div class="clear"></div>

<?php if(!empty($pur_invoice->adminnote)){ ?><p><strong><?php echo _l('adminnote'); ?>:</strong> <?php echo html_entity_decode($pur_invoice->adminnote); ?></p><?php } ?>
<?php if(!empty($pur_invoice->vendor_note)){ ?><p><strong><?php echo _l('vendor_note'); ?>:</strong> <?php echo html_entity_decode($pur_invoice->vendor_note); ?></p><?php } ?>

<div class="no-print" style="text-align:center;margin-top:30px;">
  <button onclick="window.print();return false;"><?php echo _l('print'); ?></button>
  <button onclick="window.close();return false;"><?php echo _l('close'); ?></button>
</div>
</body></html>
