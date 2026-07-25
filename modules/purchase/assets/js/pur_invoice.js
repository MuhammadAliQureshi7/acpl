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

function customDropdownRenderer(instance, td, row, col, prop, value, cellProperties) {
  "use strict";
  var selectedId = value;
  var optionsList = cellProperties.chosenOptions.data;
  if(typeof optionsList !== "undefined" && selectedId !== null) {
    var label = "";
    for(var i = 0; i < optionsList.length; i++) {
      if(optionsList[i].id == selectedId) {
        if(typeof optionsList[i].label !== "undefined") {
          label = optionsList[i].label;  
        } else {
          label = optionsList[i].id;
        }
      }
    }
    Handsontable.cellTypes.text.renderer(instance, td, row, col, prop, label, cellProperties);
  }
  return td;
}

function recalc_invoice_totals() {
  "use strict";
  var subtotal = 0, grand_total = 0;
  var col_qty = inv_is_edit ? 4 : 2;
  var col_rate = inv_is_edit ? 5 : 3;
  var col_amt = inv_is_edit ? 8 : 6;
  for (var row_index = 0; row_index < hot.countRows(); row_index++) {
    var qty = parseFloat(hot.getDataAtCell(row_index, col_qty)) || 0;
    var rate = parseFloat(hot.getDataAtCell(row_index, col_rate)) || 0;
    var amount_after = parseFloat(hot.getDataAtCell(row_index, col_amt)) || 0;
    subtotal += qty * rate;
    grand_total += amount_after;
  }
  $('#subtotal').val(numberWithCommas(subtotal));
  $('#total').val(numberWithCommas(grand_total));
}

var hotElement = document.querySelector('#example');
var hotSettings = {
  data: inv_detail.length > 0 ? inv_detail : [],
  columns: inv_is_edit ? [
    { data: 'id', type: 'numeric' },
    { data: 'rel_id', type: 'numeric' },
    {
      data: 'item_code',
      renderer: customDropdownRenderer,
      editor: "chosen",
      width: 150,
      chosenOptions: { data: inv_items }
    },
    {
      data: 'description',
      type: 'text',
      width: 200
    },
    {
      data: 'qty',
      type: 'numeric',
      numericFormat: { pattern: '0,0' }
    },
    {
      data: 'rate',
      type: 'numeric',
      numericFormat: { pattern: '0,0' }
    },
    {
      data: 'subtotal',
      type: 'numeric',
      numericFormat: { pattern: '0,0' },
      readOnly: true
    },
    {
      data: 'tax_id',
      renderer: customDropdownRenderer,
      editor: "chosen",
      width: 100,
      chosenOptions: { data: inv_taxes }
    },
    {
      data: 'amount_after_tax',
      type: 'numeric',
      numericFormat: { pattern: '0,0' },
      readOnly: true
    }
  ] : [
    {
      data: 'item_code',
      renderer: customDropdownRenderer,
      editor: "chosen",
      width: 150,
      chosenOptions: { data: inv_items }
    },
    {
      data: 'description',
      type: 'text',
      width: 200
    },
    {
      data: 'qty',
      type: 'numeric',
      numericFormat: { pattern: '0,0' }
    },
    {
      data: 'rate',
      type: 'numeric',
      numericFormat: { pattern: '0,0' }
    },
    {
      data: 'subtotal',
      type: 'numeric',
      numericFormat: { pattern: '0,0' },
      readOnly: true
    },
    {
      data: 'tax_id',
      renderer: customDropdownRenderer,
      editor: "chosen",
      width: 100,
      chosenOptions: { data: inv_taxes }
    },
    {
      data: 'amount_after_tax',
      type: 'numeric',
      numericFormat: { pattern: '0,0' },
      readOnly: true
    }
  ],
  licenseKey: 'non-commercial-and-evaluation',
  stretchH: 'all',
  width: '100%',
  autoWrapRow: true,
  rowHeights: 30,
  columnHeaderHeight: 40,
  minRows: 10,
  maxRows: 22,
  rowHeaders: true,
  colHeaders: inv_is_edit ? [
    '', '',
    inv_lang.item_code,
    inv_lang.item_description,
    inv_lang.purchase_quantity,
    inv_lang.rate,
    inv_lang.subtotal,
    inv_lang.tax,
    inv_lang.amount_after_tax
  ] : [
    inv_lang.item_code,
    inv_lang.item_description,
    inv_lang.purchase_quantity,
    inv_lang.rate,
    inv_lang.subtotal,
    inv_lang.tax,
    inv_lang.amount_after_tax
  ],
  columnSorting: { indicator: true },
  autoColumnSize: { samplingRatio: 23 },
  dropdownMenu: true,
  mergeCells: true,
  contextMenu: true,
  manualRowMove: true,
  manualColumnMove: true,
  multiColumnSorting: { indicator: true },
  filters: true,
  manualRowResize: true,
  manualColumnResize: true,
  hiddenColumns: inv_is_edit ? { columns: [0, 1] } : {}
};

var hot = new Handsontable(hotElement, hotSettings);

hot.addHook('afterChange', function(changes, src) {
  if(changes !== null){
    changes.forEach(([row, prop, oldValue, newValue]) => {
      if(newValue != ''){
        var col_item = inv_is_edit ? 2 : 0;
        var col_desc = inv_is_edit ? 3 : 1;
        var col_qty = inv_is_edit ? 4 : 2;
        var col_rate = inv_is_edit ? 5 : 3;
        var col_sub = inv_is_edit ? 6 : 4;
        var col_tax = inv_is_edit ? 7 : 5;
        var col_amt = inv_is_edit ? 8 : 6;

        if(prop == 'item_code'){
          $.post(admin_url + 'purchase/items_change/'+newValue).done(function(response){
            response = JSON.parse(response);
            var item = response.value;
            hot.setDataAtCell(row, col_desc, item.description);
            hot.setDataAtCell(row, col_rate, item.purchase_price);
            var qty = parseFloat(hot.getDataAtCell(row, col_qty)) || 1;
            var rate = parseFloat(item.purchase_price) || 0;
            hot.setDataAtCell(row, col_sub, qty * rate);
            // Recalculate amount after tax
            var tax_id = hot.getDataAtCell(row, col_tax);
            if(tax_id && tax_id != ''){
              var tax_rate = 0;
              for(var t = 0; t < inv_taxes.length; t++){
                if(inv_taxes[t].id == tax_id){
                  tax_rate = parseFloat(inv_taxes[t].taxrate) || 0;
                  break;
                }
              }
              var subtotal = qty * rate;
              hot.setDataAtCell(row, col_amt, subtotal + (subtotal * tax_rate / 100));
            } else {
              hot.setDataAtCell(row, col_amt, qty * rate);
            }
            recalc_invoice_totals();
          });
        } else if(prop == 'qty' || prop == 'rate'){
          var qty = parseFloat(hot.getDataAtCell(row, col_qty)) || 0;
          var rate = parseFloat(hot.getDataAtCell(row, col_rate)) || 0;
          var subtotal = qty * rate;
          hot.setDataAtCell(row, col_sub, subtotal);
          var tax_id = hot.getDataAtCell(row, col_tax);
          if(tax_id && tax_id != ''){
            var tax_rate = 0;
            for(var t = 0; t < inv_taxes.length; t++){
              if(inv_taxes[t].id == tax_id){
                tax_rate = parseFloat(inv_taxes[t].taxrate) || 0;
                break;
              }
            }
            hot.setDataAtCell(row, col_amt, subtotal + (subtotal * tax_rate / 100));
          } else {
            hot.setDataAtCell(row, col_amt, subtotal);
          }
          recalc_invoice_totals();
        } else if(prop == 'tax_id'){
          var qty = parseFloat(hot.getDataAtCell(row, col_qty)) || 0;
          var rate = parseFloat(hot.getDataAtCell(row, col_rate)) || 0;
          var subtotal = qty * rate;
          hot.setDataAtCell(row, col_sub, subtotal);
          if(newValue && newValue != ''){
            var tax_rate = 0;
            for(var t = 0; t < inv_taxes.length; t++){
              if(inv_taxes[t].id == newValue){
                tax_rate = parseFloat(inv_taxes[t].taxrate) || 0;
                break;
              }
            }
            hot.setDataAtCell(row, col_amt, subtotal + (subtotal * tax_rate / 100));
          } else {
            hot.setDataAtCell(row, col_amt, subtotal);
          }
          recalc_invoice_totals();
        }
      }
    });
  }
});

$('#pur_invoice-form').on('submit', function() {
  $('input[name="pur_invoice_detail"]').val(JSON.stringify(hot.getData()));
});

// Set default qty to 1 for new rows
hot.addHook('afterCreateRow', function(index, amount) {
  for(var i = index; i < index + amount; i++) {
    var col_qty = inv_is_edit ? 4 : 2;
    var col_tax = inv_is_edit ? 7 : 5;
    hot.setDataAtCell(i, col_qty, 1);
  }
});
