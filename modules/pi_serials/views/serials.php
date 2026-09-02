<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<?php
$existing_serials = [];
if (isset($itemserials) && count($itemserials) > 0) {
    foreach ($itemserials as $serial) {
        $code = (isset($serial['commodity_code']) && $serial['commodity_code'] != '') ? $serial['commodity_code'] : $serial['item_id'];
        $existing_serials[] = [$code, $serial['serial_number']];
    }
}
?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo admin_url('pi_serials'); ?>" class="mbot10 inline-block"><i class="fa fa-arrow-left"></i> <?php echo _l('pi_serial_back_to_list'); ?></a>
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('pi_serials'); ?></h4>
                        <hr class="hr-panel-heading" />

                        <div class="row mbot10">
                            <div class="col-md-3">
                                <span class="bold"><?php echo _l('pi_serial_invoice_number'); ?>:</span>
                                <?php echo html_entity_decode($pur_invoice->invoice_number ?? ''); ?>
                            </div>
                            <div class="col-md-3">
                                <span class="bold"><?php echo _l('pi_serial_vendor'); ?>:</span>
                                <?php echo html_entity_decode($pur_invoice->company ?? ''); ?>
                            </div>
                            <div class="col-md-3">
                                <span class="bold"><?php echo _l('pi_serial_invoice_date'); ?>:</span>
                                <?php echo _d($pur_invoice->invoice_date ?? ''); ?>
                            </div>
                            <div class="col-md-3">
                                <span class="bold"><?php echo _l('pi_serial_total'); ?>:</span>
                                <?php echo app_format_money($pur_invoice->total ?? 0, ''); ?>
                            </div>
                        </div>

                        <?php if (isset($pur_invoice_items) && count($pur_invoice_items) > 0): ?>
                        <div class="row mbot10">
                            <div class="col-md-12">
                                <h5><?php echo _l('pi_serial_invoice_items'); ?></h5>
                                <table class="table table-bordered table-condensed">
                                    <thead>
                                        <tr>
                                            <th><?php echo _l('pi_serial_item_code'); ?></th>
                                            <th><?php echo _l('pi_serial_item_description'); ?></th>
                                            <th><?php echo _l('pi_serial_quantity'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pur_invoice_items as $item): ?>
                                            <tr>
                                                <td><?php echo html_entity_decode(($item['commodity_code'] != '' ? $item['commodity_code'] : $item['item_code'])); ?></td>
                                                <td><?php echo html_entity_decode($item['description']); ?></td>
                                                <td><?php echo html_entity_decode($item['qty']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php endif; ?>

                        <hr />

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo _l('pi_serial_upload_excel'); ?></label>
                                    <input type="file" id="serial_excel_input" accept=".xlsx,.xls,.csv" class="form-control" onchange="pis_parse_serial_excel(); return false;">
                                    <p class="text-muted mtop5"><?php echo _l('pi_serial_excel_format_note'); ?></p>
                                </div>
                            </div>
                            <!-- <div class="col-md-8">
                                <div class="form-group">
                                    <label><?php echo _l('pi_serial_add_for_item'); ?></label>
                                    <select class="selectpicker ajax-search" id="serial_item_picker" data-live-search="true" data-width="100%" data-none-selected-text="<?php echo _l('pi_serial_pick_item'); ?>">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div> -->
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h5><?php echo _l('pi_serial_uploaded'); ?>: <span id="serial_count_display"><?php echo count($existing_serials); ?></span>
                                    <button type="button" class="btn btn-sm btn-success" onclick="pis_add_serial_row(); return false;"><i class="fa fa-plus"></i> <?php echo _l('pi_serial_add_row'); ?></button>
                                    <button type="button" class="btn btn-sm btn-warning" onclick="pis_clear_serials(); return false;"><i class="fa fa-trash"></i> <?php echo _l('pi_serial_clear'); ?></button>
                                </h5>
                                <div class="table-responsive" style="max-height:300px; overflow-y:auto;">
                                    <table class="table table-bordered table-condensed" id="serial_preview_table">
                                        <thead>
                                            <tr>
                                                <th width="45%"><?php echo _l('pi_serial_item_code'); ?></th>
                                                <th width="45%"><?php echo _l('pi_serial_number'); ?></th>
                                                <th width="10%"></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row mtop15">
                            <div class="col-md-12 text-right">
                                <button type="button" class="btn btn-info" onclick="pis_save_serials(); return false;"><i class="fa fa-save"></i> <?php echo _l('pi_serial_save'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
var PI_SERIALS_PI_ID = <?php echo (int) $pur_invoice->id; ?>;
var PI_SERIALS_EXISTING = <?php echo json_encode($existing_serials); ?>;
var PI_SERIALS_LANG = {
    no_file: '<?php echo _l('pi_serial_no_file'); ?>',
    parse_error_csv: '<?php echo _l('pi_serial_parse_error_csv'); ?>',
    parse_error_excel: '<?php echo _l('pi_serial_parse_error_excel'); ?>',
    rows_loaded: '<?php echo _l('pi_serial_rows_loaded'); ?>',
    skipped: '<?php echo _l('pi_serial_skipped'); ?>',
    save_failed: '<?php echo _l('pi_serial_save_failed'); ?>',
    confirm_clear: '<?php echo _l('pi_serial_confirm_clear'); ?>',
    clear_failed: '<?php echo _l('pi_serial_clear_failed'); ?>'
};
</script>
</body>
</html>
