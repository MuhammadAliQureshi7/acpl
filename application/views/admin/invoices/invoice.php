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

    // Override calculate_total to use tax-input, show total tax, and sum into grand total
    if(typeof window.calculate_total === 'function') {
        window.calculate_total = function() {
            if ($('body').hasClass('no-calculate-total')) return false;
            var subtotal = 0, total_tax_sum = 0, grand_total = 0;
            var rows = $('.table.has-calculations tbody tr.item');
            $('.tax-area, .total-tax-row').remove();
            $.each(rows, function() {
                var qty = parseFloat($(this).find('[data-quantity]').val()) || 1;
                var rate = parseFloat($(this).find('td.rate input').val()) || 0;
                var tax = parseFloat($(this).find('input.tax-input').val()) || 0;
                var _amount = qty * rate;
                $(this).find('td.amount').html(format_money(_amount, true));
                $(this).find('td.amount_after_tax').html(format_money(_amount + tax, true));
                subtotal += _amount;
                total_tax_sum += tax;
            });

            var discount_percent = parseFloat($('input[name="discount_percent"]').val()) || 0;
            var discount_fixed = parseFloat($('input[name="discount_total"]').val()) || 0;
            var discount_type = $('select[name="discount_type"]').val() || '';
            var discount_total_type = $('.discount-total-type.selected');
            var adjustment = parseFloat($('input[name="adjustment"]').val()) || 0;
            var discount_amount = 0;
            grand_total = subtotal + total_tax_sum;

            if(discount_percent > 0 && discount_type != '' && discount_total_type.hasClass('discount-type-percent')) {
                discount_amount = (grand_total * discount_percent) / 100;
            } else if(discount_fixed > 0 && discount_type != '' && discount_total_type.hasClass('discount-type-fixed')) {
                discount_amount = discount_fixed;
            }

            grand_total = grand_total - discount_amount + adjustment;

            // Add total tax row under discount
            if(total_tax_sum > 0) {
                $('#discount_area').after(
                    '<tr class="total-tax-row"><td><span class="bold">' + app.lang.total_tax + '</span></td><td class="total-tax">' + format_money(total_tax_sum) + '</td></tr>'
                );
            }

            $('.discount-total').html(format_money(discount_amount));
            $('.adjustment').html(format_money(adjustment));
            $('.subtotal').html(format_money(subtotal) + hidden_input('subtotal', accounting.toFixed(subtotal, app.options.decimal_places)));
            $('.total').html(format_money(grand_total) + hidden_input('total', accounting.toFixed(grand_total, app.options.decimal_places)));
            $(document).trigger('sales-total-calculated');
        };
    }

    // Auto-add item on select
    $('#item_select').on('change', function() {
        var item_id = $(this).val();
        if(item_id != ''){
            // Prevent duplicates
            var dup = false;
            $('table.items tbody tr.item').each(function() {
                if($(this).find('td.dragger input[name*="[item_code]"]').val() == item_id) { dup = true; return false; }
                if($(this).find('input[name*="[itemid]"]').val() == item_id) { dup = true; return false; }
            });
            if(dup) {
                alert_float('warning', 'Item already added');
                $('#item_select').val('');
                $('#item_select').selectpicker('refresh');
                return;
            }
            $.post(admin_url + 'purchase/items_change/'+item_id).done(function(response) {
                response = JSON.parse(response);
                var item = response.value;
                $('#item_select').val('');
                $('#item_select').selectpicker('refresh');
                add_item_to_table({
                    description: item.description || '',
                    long_description: '',
                    qty: 1,
                    rate: parseFloat(item.purchase_price) || 0,
                    unit: item.unit || '',
                    taxname: [],
                    item_code: item_id
                });
            }).fail(function() {
                add_item_to_table();
            });
        }
    });

    // Trigger calculate_total on tax-input, qty, rate changes
    $('table.items tbody').on('change keyup', 'input.tax-input, td.rate input, [data-quantity]', function() {
        calculate_total();
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
