(function($) {
  "use strict";

  // Index page: invoices table
  var $table = $('.table-pi_serials_table');
  if ($table.length) {
    initDataTable($table, admin_url + 'pi_serials/table_pur_invoices', [0], [0]);
  }
})(jQuery);

// Serial management page
var piSerialsData = [];

function pis_lang(key, fallback) {
  "use strict";
  if (typeof PI_SERIALS_LANG !== 'undefined' && PI_SERIALS_LANG[key]) {
    return PI_SERIALS_LANG[key];
  }
  return fallback || '';
}

function pis_init_existing() {
  "use strict";
  if (typeof PI_SERIALS_EXISTING !== 'undefined' && PI_SERIALS_EXISTING) {
    piSerialsData = PI_SERIALS_EXISTING;
  }
  pis_render_table();
}

function pis_parse_serial_excel() {
  "use strict";
  var fileInput = document.getElementById('serial_excel_input');
  if (!fileInput.files.length) {
    alert_float('warning', pis_lang('no_file', 'Please select a file'));
    return;
  }
  var file = fileInput.files[0];
  var fileName = file.name.toLowerCase();

  if (fileName.endsWith('.csv')) {
    var reader = new FileReader();
    reader.onload = function(e) {
      try {
        var text = e.target.result;
        var lines = text.split('\n').filter(function(l) { return l.trim() != ''; });
        var data = [];
        for (var r = 1; r < lines.length; r++) {
          var parts = lines[r].split(',');
          var itemCode = parts[0] ? parts[0].trim() : '';
          var serial = parts[1] ? parts[1].trim() : '';
          if (itemCode != '' && serial != '') {
            data.push([itemCode, serial]);
          }
        }
        pis_replace_data(data);
      } catch (err) {
        alert_float('danger', pis_lang('parse_error_csv', 'Error parsing CSV: ') + err.message);
      }
    };
    reader.readAsText(file);
  } else {
    var reader = new FileReader();
    reader.onload = function(e) {
      try {
        var data = new Uint8Array(e.target.result);
        var workbook = XLSX.read(data, { type: 'array' });
        var sheet = workbook.Sheets[workbook.SheetNames[0]];
        var json = XLSX.utils.sheet_to_json(sheet, { header: 1 });
        var rows = [];
        for (var r = 1; r < json.length; r++) {
          var itemCode = json[r][0] ? json[r][0].toString().trim() : '';
          var serial = json[r][1] ? json[r][1].toString().trim() : '';
          if (itemCode != '' && serial != '') {
            rows.push([itemCode, serial]);
          }
        }
        pis_replace_data(rows);
      } catch (err) {
        alert_float('danger', pis_lang('parse_error_excel', 'Error parsing Excel: ') + err.message);
      }
    };
    reader.readAsArrayBuffer(file);
  }
}

function pis_replace_data(data) {
  "use strict";
  piSerialsData = data || [];
  pis_render_table();
  alert_float('success', piSerialsData.length + ' ' + pis_lang('rows_loaded', 'rows loaded'));
}

function pis_add_serial_row(itemCode, serial) {
  "use strict";
  piSerialsData.push([itemCode || '', serial || '']);
  pis_render_table();
}

function pis_remove_serial_row(idx) {
  "use strict";
  piSerialsData.splice(idx, 1);
  pis_render_table();
}

function pis_clear_serials() {
  "use strict";
  piSerialsData = [];
  pis_render_table();
}

function pis_render_table() {
  "use strict";
  var tbody = document.querySelector('#serial_preview_table tbody');
  if (!tbody) return;
  tbody.innerHTML = '';
  piSerialsData.forEach(function(row, idx) {
    var tr = document.createElement('tr');
    tr.innerHTML = '<td><input type="text" class="form-control input-sm serial-item-code" value="' + $('<div>').text(row[0] || '').html() + '"></td>' +
      '<td><input type="text" class="form-control input-sm serial-number" value="' + $('<div>').text(row[1] || '').html() + '"></td>' +
      '<td><button type="button" class="btn btn-danger btn-xs" onclick="pis_remove_serial_row(' + idx + '); return false;"><i class="fa fa-times"></i></button></td>';
    tbody.appendChild(tr);
  });
  document.getElementById('serial_count_display').textContent = piSerialsData.length;
}

function pis_sync_data() {
  "use strict";
  var data = [];
  document.querySelectorAll('#serial_preview_table tbody tr').forEach(function(tr) {
    var itemCode = tr.querySelector('.serial-item-code') ? tr.querySelector('.serial-item-code').value.trim() : '';
    var serial = tr.querySelector('.serial-number') ? tr.querySelector('.serial-number').value.trim() : '';
    if (serial != '') {
      data.push([itemCode, serial]);
    }
  });
  piSerialsData = data;
  document.getElementById('serial_count_display').textContent = data.length;
}

function pis_save_serials() {
  "use strict";
  pis_sync_data();
  var piId = typeof PI_SERIALS_PI_ID !== 'undefined' ? PI_SERIALS_PI_ID : '';
  if (piId == '') return;
  $.post(admin_url + 'pi_serials/save/' + piId, { serials: JSON.stringify(piSerialsData) })
    .done(function(response) {
      response = JSON.parse(response);
      if (response.success) {
        alert_float('success', response.message + ' (' + response.count + ')');
        if (response.skipped > 0) {
          alert_float('warning', response.skipped + ' ' + pis_lang('skipped', 'rows skipped (unknown item code)'));
        }
      } else {
        alert_float('danger', response.message);
      }
    })
    .fail(function() {
      alert_float('danger', pis_lang('save_failed', 'Failed to save serials'));
    });
}

function pi_serials_clear_ajax(piId) {
  "use strict";
  if (!confirm(pis_lang('confirm_clear', 'Clear all serials of this invoice?'))) return;
  $.post(admin_url + 'pi_serials/clear/' + piId)
    .done(function(response) {
      response = JSON.parse(response);
      if (response.success) {
        alert_float('success', response.message);
        if ($.fn.DataTable.isDataTable('.table-pi_serials_table')) {
          $('.table-pi_serials_table').DataTable().ajax.reload();
        }
      } else {
        alert_float('danger', response.message);
      }
    })
    .fail(function() {
      alert_float('danger', pis_lang('clear_failed', 'Failed to clear serials'));
    });
}

$(function() {
  "use strict";

  if (typeof PI_SERIALS_PI_ID !== 'undefined') {
    // Item picker: add serial rows for a selected item
    init_ajax_search('items', '#serial_item_picker.ajax-search', undefined, admin_url + 'pi_serials/search_items');
    $('#serial_item_picker').on('changed.bs.select', function(e, clickedIndex, isSelected) {
      var code = $(this).val();
      if (code != '') {
        pis_add_serial_row(code, '');
      }
    });

    // Auto sync hidden data on manual edits
    $(document).on('change keyup', '#serial_preview_table input', function() {
      pis_sync_data();
    });

    pis_init_existing();
  }
});
