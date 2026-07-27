<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <?php
            echo form_open($this->uri->uri_string(), ['id' => 'invoice-form', 'class' => '_transaction_form invoice-form']);
            if (isset($invoice)) {
                echo form_hidden('isedit');
            }
            ?>
            <div class="col-md-12">
                <h4
                    class="tw-mt-0 tw-font-semibold tw-text-lg tw-text-neutral-700 tw-flex tw-items-center tw-space-x-2">
                    <span>
                        <?php echo isset($invoice) ? format_invoice_number($invoice) : _l('create_new_invoice'); ?>
                    </span>
                    <?php echo isset($invoice) ? format_invoice_status($invoice->status) : ''; ?>
                </h4>
                <?php $this->load->view('admin/invoices/invoice_template'); ?>
            </div>
            <?php echo form_close(); ?>
            <?php $this->load->view('admin/invoice_items/item'); ?>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
$(function() {
    validate_invoice_form();
    init_currency();
    init_ajax_project_search_by_customer_id();
    init_ajax_search('items', '#item_select.ajax-search', undefined, admin_url + 'items/search');

    // Auto-add item on select
    $('#item_select').on('change', function() {
        var item_id = $(this).val();
        if(item_id != ''){
            $.post(admin_url + 'purchase/items_change/'+item_id).done(function(response) {
                response = JSON.parse(response);
                var item = response.value;
                $('.main textarea[name="description"]').val(item.description);
                $('.main textarea[name="long_description"]').val('');
                $('.main input[name="quantity"]').val(1);
                $('.main input[name="rate"]').val(item.purchase_price);
                $('.main input[name="unit"]').val(item.unit || '');
                $('#item_select').val('');
                $('#item_select').selectpicker('refresh');
                add_item_to_table('undefined','undefined',undefined);
            }).fail(function() {
                add_item_to_table('undefined','undefined',undefined);
            });
        }
    });

    // Load serials for existing rows
    $('.serials-select').each(function() {
        var itemCode = $(this).data('item-code');
        if(itemCode) {
            var $sel = $(this);
            $.get(admin_url + 'purchase/get_available_serials/' + itemCode).done(function(resp) {
                resp = JSON.parse(resp);
                if(resp.serials && resp.serials.length > 0) {
                    var opts = '';
                    resp.serials.forEach(function(s) {
                        opts += '<option value="' + s.id + '">' + s.serial_number + '</option>';
                    });
                    $sel.html(opts);
                    $sel.selectpicker('refresh');
                }
            });
        }
    });
});
function update_due_date() {
    var date = $('input[name="date"]').val();
    var clientid = $('select[name="clientid"]').val();
    if (date && clientid) {
        requestGetJSON('invoices/get_due_date_by_client_creditdays/' + clientid + '/' + date).done(function(response) {
            $('input[name="duedate"]').val(response);
        });
    }       
}
</script>
</body>

</html>
