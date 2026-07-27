<script>
(function($) {
  "use strict";
  $("input[data-type='currency']").on({
    keyup: function() {     
      formatCurrency($(this));
    },
    blur: function() { 
      formatCurrency($(this), "blur");
    }
  });
})(jQuery);

function removeCommas(str) {
  "use strict";
  return(str.replace(/,/g,''));
}

function numberWithCommas(x) {
  "use strict";
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function contract_change(el){
  "use strict";
  if(el.value != ''){
    $.post(admin_url + 'purchase/contract_change/'+el.value).done(function(response) {
      response = JSON.parse(response);
      $('#subtotal').val(numberWithCommas(response.value));
      $('#total').val(numberWithCommas(response.value));
    });
  }
}

function pur_order_change(el){
  "use strict";
  if(el.value != ''){
    $.post(admin_url + 'purchase/pur_order_change/'+el.value).done(function(response) {
      response = JSON.parse(response);
      $('#subtotal').val(numberWithCommas(response.value));
      $('#total').val(numberWithCommas(response.value));
    });
  }
}

function subtotal_change(el){
  "use strict";
  var tax = $('#tax').val();
  if(tax == ''){
    tax = '0';
  }
  var total_value =  parseFloat(removeCommas(el.value)) + parseFloat(removeCommas(tax));
  $('#total').val( numberWithCommas(total_value) );
}

function tax_rate_change(el){
  "use strict";
  var subtotal = $('#subtotal').val();
  if(el.value != ''){
    $.post(admin_url + 'purchase/tax_rate_change/'+el.value).done(function(response) {
      response = JSON.parse(response);
      var tax_value = parseFloat(removeCommas(subtotal)*response.rate)/100;
      var total_value =  parseFloat(removeCommas(subtotal)) +  tax_value;
      $('#tax').val(numberWithCommas(tax_value));
      $('#total').val( numberWithCommas(total_value) );
    });
  }
}

var lastAddedItemKey = 0;
<?php if(isset($pur_invoice_items) && count($pur_invoice_items) > 0){ ?>
lastAddedItemKey = <?php echo count($pur_invoice_items); ?>;
<?php } ?>

// Item selection auto-fill and auto-add
$('#item_select').on('change', function() {
  "use strict";
  var item_id = $(this).val();
  if(item_id != ''){
    $.post(admin_url + 'purchase/items_change/'+item_id).done(function(response) {
      response = JSON.parse(response);
      var item = response.value;
      var itemCode = item.commodity_code || item_id;
      $('#item_select').val('');
      $('#item_select').selectpicker('refresh');
      pur_add_item_to_table({
        item_code: item_id,
        item_code_display: itemCode,
        description: item.description || '',
        qty: 1,
        rate: item.purchase_price || 0
      });
    });
  }
});

function calc_main_row() {
  "use strict";
  var $mainRow = $('table.items tbody tr.main');
  var qty = parseFloat($mainRow.find('input[name="quantity"]').val()) || 0;
  var rate = parseFloat($mainRow.find('input[name="rate"]').val()) || 0;
  var subtotal = qty * rate;
  $mainRow.find('.subtotal-display').text(numberWithCommas(subtotal.toFixed(2)));

  var taxrate = parseFloat($mainRow.find('input.tax-input').val()) || 0;
  var amt_after = subtotal + (taxrate * qty);
  $mainRow.find('.amount-after-tax-display').text(numberWithCommas(amt_after.toFixed(2)));
}

$('table.items tbody tr.main').on('change keyup', 'input[name="quantity"], input[name="rate"], select[name="taxname"]', function() {
  "use strict";
  calc_main_row();
});

function pur_add_item_to_table(data) {
  "use strict";
  data = data || {};

  var description = data.description || $('.main textarea[name="description"]').val() || '';
  var qty = parseFloat(data.qty || $('.main input[name="quantity"]').val()) || 1;
  var rate = parseFloat(data.rate || $('.main input[name="rate"]').val()) || 0;
  var item_code = data.item_code || $('.main input[name="item_code"]').val() || '';
  var item_code_display = data.item_code_display || $('.main input[name="item_code_display"]').val() || item_code;
  var tax = data.tax || parseFloat($('.main input.tax-input').val()) || 0;

  if(description === '' && rate === 0 && !data.description && !data.rate) {
    return;
  }

  lastAddedItemKey++;
  var subtotal = qty * rate;
  var amt_after = subtotal + (tax * qty);

  var row = '<tr class="sortable item">';
  row += '<td class="dragger"><input type="hidden" class="order" name="items[' + lastAddedItemKey + '][order]">';
  row += '<input type="hidden" name="items[' + lastAddedItemKey + '][item_code]" value="' + item_code + '"></td>';
  row += '<td><input type="text" class="form-control" value="' + item_code_display + '" disabled></td>';
  row += '<td class="bold description"><textarea name="items[' + lastAddedItemKey + '][description]" class="form-control" rows="2" readonly>' + description + '</textarea></td>';
  row += '<td><input type="number" min="0" name="items[' + lastAddedItemKey + '][qty]" value="' + qty + '" class="form-control"></td>';
  row += '<td class="rate"><input type="number" step="0.01" name="items[' + lastAddedItemKey + '][rate]" value="' + rate + '" class="form-control"></td>';
  row += '<td class="amount" align="right">' + numberWithCommas(subtotal.toFixed(2)) + '</td>';
  row += '<td class="taxrate">';
  row += '<input type="number" min="0" step="0.01" name="items[' + lastAddedItemKey + '][tax]" value="' + tax + '" class="form-control tax-input">'; 
  row += '</td>';
  row += '<td class="amount_after_tax" align="right">' + numberWithCommas(amt_after.toFixed(2)) + '</td>';
  row += '<td><a href="#" class="btn btn-danger pull-left" onclick="pur_delete_item(this); return false;"><i class="fa fa-times"></i></a></td>';
  row += '</tr>';

  $('table.items tbody').append(row);

  $('.main textarea[name="description"]').val('');
  $('.main input[name="quantity"]').val(1);
  $('.main input[name="rate"]').val('');
  $('.main input[name="item_code"]').val('');
  $('.main input[name="item_code_display"]').val('');
  $('.main .subtotal-display').text('0');
  $('.main .amount-after-tax-display').text('0');
  $('.main input.tax-input').val('0');
  $('.main select[name="taxname"]').selectpicker('refresh');
  $('table.items tbody tr.item select.tax').selectpicker('render');
  calculate_total();
}

function pur_delete_item(el) {
  "use strict";
  $(el).closest('tr').remove();
  calculate_total();
}

function calculate_total() {
  "use strict";
  var subtotal = 0, total_tax_sum = 0, grand_total = 0;
  $('table.items tbody tr.item').each(function() {
    var qty = parseFloat($(this).find('input[name*="[qty]"]').val()) || 0;
    var rate = parseFloat($(this).find('input[name*="[rate]"]').val()) || 0;
    var tax_amount = parseFloat($(this).find('input.tax-input').val()) || 0;
    var amtText = $(this).find('td.amount_after_tax').text().replace(/,/g, '');
    var amt_after = parseFloat(amtText) || 0;
    subtotal += qty * rate;
    total_tax_sum += tax_amount * qty;
    grand_total += amt_after;
  });

  var discount_percent = parseFloat($('input[name="discount_percent"]').val()) || 0;
  var discount_fixed = parseFloat($('input[name="discount_total"]').val()) || 0;
  var adjustment = parseFloat($('input[name="adjustment"]').val()) || 0;

  var discount_amount = 0;
  if(discount_percent > 0) {
    discount_amount = (grand_total * discount_percent) / 100;
  } else if(discount_fixed > 0) {
    discount_amount = discount_fixed;
  }

  grand_total = grand_total - discount_amount + adjustment;

  $('.subtotal').text(numberWithCommas(subtotal.toFixed(2)));
  $('.discount-total').text(numberWithCommas(discount_amount.toFixed(2)));
  $('.adjustment').text(numberWithCommas(adjustment.toFixed(2)));
  $('.total_tax').text(numberWithCommas(total_tax_sum.toFixed(2)));
  $('.total').text(numberWithCommas(grand_total.toFixed(2)));

  $('input[name="subtotal"]').val(numberWithCommas(subtotal.toFixed(2)));
  $('input[name="total"]').val(numberWithCommas(grand_total.toFixed(2)));
}

$('table.items tbody').on('change keyup', 'tr.item input[name*="[qty]"], tr.item input[name*="[rate]"], tr.item input.tax-input', function() {
  "use strict";
  var $row = $(this).closest('tr.item');
  var qty = parseFloat($row.find('input[name*="[qty]"]').val()) || 0;
  var rate = parseFloat($row.find('input[name*="[rate]"]').val()) || 0;
  var subtotal = qty * rate;
  $row.find('td.amount').text(numberWithCommas(subtotal.toFixed(2)));

  var taxrate = parseFloat($row.find('input.tax-input').val()) || 0;
  var amt_after = subtotal + (taxrate * qty);
  $row.find('td.amount_after_tax').text(numberWithCommas(amt_after.toFixed(2)));

  calculate_total();
});

$(document).on('change keyup', 'input[name="discount_percent"], input[name="discount_total"], input[name="adjustment"]', function() {
  "use strict";
  calculate_total();
});

// Hide fixed discount on page load if percent has value
$(function() {
  "use strict";
  if(parseFloat($('input[name="discount_percent"]').val()) > 0) {
    $('.input-discount-fixed').hide();
    $('.input-discount-percent').show();
  }
});

// Discount type toggle
$(document).on('click', '.discount-type-percent', function() {
  "use strict";
  $('.input-discount-percent').show();
  $('.input-discount-fixed').hide();
  $('.discount-total-type-selected').text('%');
  $('.discount-type-percent').addClass('selected');
  $('.discount-type-fixed').removeClass('selected');
  $('input[name="discount_total"]').val(0);
  calculate_total();
  return false;
});

$(document).on('click', '.discount-type-fixed', function() {
  "use strict";
  $('.input-discount-fixed').show();
  $('.input-discount-percent').hide();
  $('.discount-total-type-selected').text('<?php echo _l('discount_fixed_amount'); ?>');
  $('.discount-type-fixed').addClass('selected');
  $('.discount-type-percent').removeClass('selected');
  $('input[name="discount_percent"]').val(0);
  calculate_total();
  return false;
});

$('#pur_invoice-form').on('submit', function() {
  "use strict";
  var items = [];
  $('table.items tbody tr.item').each(function() {
    var $row = $(this);
    var item_code = $row.find('input[name*="[item_code]"]').val() || '';
    var desc = $row.find('textarea[name*="[description]"]').val() || '';
    var qty = parseFloat($row.find('input[name*="[qty]"]').val()) || 0;
    var rate = parseFloat($row.find('input[name*="[rate]"]').val()) || 0;
    var taxrate = parseFloat($row.find('input.tax-input').val()) || 0;
    var subtotal = qty * rate;
    var amt_after = subtotal + (taxrate * qty);

    items.push([
      item_code,
      desc,
      qty,
      rate,
      taxrate,
      amt_after
    ]);
  });
  $('input[name="pur_invoice_detail"]').val(JSON.stringify(items));
});



$(function() {
  "use strict";
  setTimeout(function() { calculate_total(); }, 500);
});

// Serial Excel/CSV upload — direct AJAX save
var piSerialsData = [];

function pur_parse_serial_excel() {
  "use strict";
  var fileInput = document.getElementById('serial_excel_input');
  if(!fileInput.files.length) {
    alert_float('warning', 'Please select a file');
    return;
  }
  var file = fileInput.files[0];
  var fileName = file.name.toLowerCase();

  if(fileName.endsWith('.csv')) {
    var reader = new FileReader();
    reader.onload = function(e) {
      try {
        var text = e.target.result;
        var lines = text.split('\n').filter(function(l) { return l.trim() != ''; });
        piSerialsData = [];
        for(var r = 1; r < lines.length; r++) {
          var parts = lines[r].split(',');
          var itemCode = parts[0] ? parts[0].trim() : '';
          var serial = parts[1] ? parts[1].trim() : '';
          if(itemCode != '' && serial != '') {
            piSerialsData.push([itemCode, serial]);
          }
        }
        updateSerialPreview();
      } catch(err) {
        alert_float('danger', 'Error parsing CSV: ' + err.message);
      }
    };
    reader.readAsText(file);
  } else {
    var reader = new FileReader();
    reader.onload = function(e) {
      try {
        var data = new Uint8Array(e.target.result);
        var workbook = XLSX.read(data, {type: 'array'});
        var sheet = workbook.Sheets[workbook.SheetNames[0]];
        var json = XLSX.utils.sheet_to_json(sheet, {header: 1});
        piSerialsData = [];
        for(var r = 1; r < json.length; r++) {
          var itemCode = json[r][0] ? json[r][0].toString().trim() : '';
          var serial = json[r][1] ? json[r][1].toString().trim() : '';
          if(itemCode != '' && serial != '') {
            piSerialsData.push([itemCode, serial]);
          }
        }
        updateSerialPreview();
      } catch(err) {
        alert_float('danger', 'Error parsing Excel: ' + err.message + '. Try saving as CSV.');
      }
    };
    reader.readAsArrayBuffer(file);
  }
}

function updateSerialPreview() {
  "use strict";
  var tbody = document.querySelector('#serial_preview_table tbody');
  tbody.innerHTML = '';
  piSerialsData.forEach(function(row) {
    var tr = document.createElement('tr');
    tr.innerHTML = '<td>' + row[0] + '</td><td>' + row[1] + '</td>';
    tbody.appendChild(tr);
  });
  document.getElementById('serial_count_display').textContent = piSerialsData.length;
  $('input[name="pi_serial_data"]').val(JSON.stringify(piSerialsData));
}

</script>
</script>