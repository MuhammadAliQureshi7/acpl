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
    // Load serials for existing items on page load
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
    // Init accountacy currency symbol
    init_currency();
    // Project ajax search
    init_ajax_project_search_by_customer_id();
    // Maybe items ajax search
    init_ajax_search('items', '#item_select.ajax-search', undefined, admin_url + 'items/search');

    // Auto-add item on select with item_code column
    var __add_item_to_table = window.add_item_to_table;
    window.add_item_to_table = function(data, itemid, merge_invoice, bill_expense) {
        var itemCode = '';
        var itemRefId = '';
        if(typeof data === 'object' && data !== null && !Array.isArray(data)) {
            itemCode = data.item_code || '';
            itemRefId = data.item_ref_id || '';
        }
        __add_item_to_table(data, itemid, merge_invoice, bill_expense);
        if(itemCode) {
            var watcher = setInterval(function() {
                var lastRow = $('table.items tbody tr.item:last');
                var hasItemCode = lastRow.find('td.dragger input[name*="[item_code]"]').length;
                if(lastRow.length && lastRow.find('td.amount').length && !hasItemCode) {
                    lastRow.find('td.dragger').append('<input type="hidden" name="newitems[' + lastAddedItemKey + '][item_code]" value="' + itemCode + '">');
                    lastRow.find('td.dragger').after('<td><input type="text" class="form-control" value="' + itemCode + '" disabled></td>');
                    // Add serials dropdown
                    if(!lastRow.find('td.serials-cell').length) {
                        var serialSelect = '<td align="center" class="serials-cell"><select class="selectpicker serials-select" data-width="100%" multiple data-none-selected-text="-" data-item-code="' + itemRefId + '"></select></td>';
                        lastRow.find('td:has(a.btn-danger)').before(serialSelect);
                        // Load serials
                        if(itemRefId) {
                            $.get(admin_url + 'purchase/get_available_serials/' + itemRefId).done(function(resp) {
                                resp = JSON.parse(resp);
                                if(resp.serials && resp.serials.length > 0) {
                                    var $sel = $('table.items tbody tr.item:last .serials-select');
                                    var opts = '';
                                    resp.serials.forEach(function(s) {
                                        opts += '<option value="' + s.id + '">' + s.serial_number + '</option>';
                                    });
                                    $sel.html(opts);
                                    $sel.selectpicker('refresh');
                                }
                            });
                        }
                    }
                    clearInterval(watcher);
                } else if(hasItemCode) {
                    clearInterval(watcher);
                }
            }, 100);
        }
    };

    $('#item_select').on('change', function() {
        var item_id = $(this).val();
        if(item_id != ''){
            $.post(admin_url + 'purchase/items_change/'+item_id).done(function(response) {
                response = JSON.parse(response);
                var item = response.value;
                var itemCode = item.commodity_code || item_id;
                var taxSelected = $('.main select.tax').selectpicker('val') || [];
                $('#item_select').val('');
                $('#item_select').selectpicker('refresh');
                add_item_to_table({
                    description: item.description || '',
                    long_description: '',
                    qty: 1,
                    rate: item.purchase_price || 0,
                    unit: item.unit || '',
                    taxname: taxSelected,
                    item_code: itemCode,
                    item_ref_id: item_id
                });
            }).fail(function() {
                add_item_to_table();
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