<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-margin font-bold"><i class="fa fa-qrcode" aria-hidden="true"></i> <?php echo _l('pi_serials'); ?></h4>
                                <p class="text-muted mtop5"><?php echo _l('pi_serials_page_description'); ?></p>
                                <hr />
                            </div>
                        </div>
                        <?php render_datatable(array(
                            _l('pi_serial_invoice_number'),
                            _l('pi_serial_vendor'),
                            _l('pi_serial_invoice_date'),
                            _l('pi_serial_total'),
                            _l('pi_serial_serials_count'),
                            _l('pi_serial_actions'),
                        ), 'pi_serials_table'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
var PI_SERIALS_LANG = {
    confirm_clear: '<?php echo _l('pi_serial_confirm_clear'); ?>',
    clear_failed: '<?php echo _l('pi_serial_clear_failed'); ?>'
};
</script>
</body>
</html>
