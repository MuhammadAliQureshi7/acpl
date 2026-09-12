<div id="accordion">
  <div class="card">
    <table class="tree">
      <tbody>
        <tr>
          <td colspan="7">
              <h3 class="text-center no-margin-top-20 no-margin-left-24"><?php echo get_option('companyname'); ?></h3>
          </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="7">
            <h4 class="text-center no-margin-top-20 no-margin-left-24"><?php echo _l('account_ledger'); ?></h4>
          </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="7">
            <p class="text-center no-margin-top-20 no-margin-left-24"><?php echo _d($data_report['from_date']) .' - '. _d($data_report['to_date']); ?></p>
          </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr class="tr_header">
          <td class="text-bold"><?php echo _l('report_ledger_c_no'); ?></td>
          <td class="text-bold"><?php echo _l('invoice_payments_table_date_heading'); ?></td>
          <td class="text-bold"><?php echo _l('transaction_type'); ?></td>
          <td class="text-bold"><?php echo _l('description'); ?></td>
          <td class="total_amount text-bold"><?php echo _l('debit'); ?></td>
          <td class="total_amount text-bold"><?php echo _l('credit'); ?></td>
          <td class="total_amount text-bold"><?php echo _l('balance'); ?></td>
        </tr>
        <?php if (count($data_report['data']) == 0) { ?>
          <tr>
            <td colspan="7" class="text-center"><?php echo _l('report_ledger_no_records'); ?></td>
          </tr>
        <?php } ?>
        <?php
        $row_index = 0;
        foreach ($data_report['data'] as $account) {
            $row_index++;
            $parent_index = $row_index;
            ?>
            <tr class="treegrid-<?php echo html_entity_decode($parent_index); ?> parent-node expanded">
              <td class="parent text-bold"><?php echo html_entity_decode($account['name']); ?></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr class="treegrid-<?php echo html_entity_decode(++$row_index); ?> treegrid-parent-<?php echo html_entity_decode($parent_index); ?>">
              <td>0</td>
              <td></td>
              <td></td>
              <td><?php echo _l('report_ledger_opening_balance'); ?></td>
              <td class="total_amount"></td>
              <td class="total_amount"></td>
              <td class="total_amount"><?php echo app_format_money($account['opening'], $currency->name); ?></td>
            </tr>
            <?php foreach ($account['rows'] as $val) {
                $row_index++;
                ?>
                <tr class="treegrid-<?php echo html_entity_decode($row_index); ?> treegrid-parent-<?php echo html_entity_decode($parent_index); ?>">
                  <td><?php echo html_entity_decode($val['id']); ?></td>
                  <td><?php echo _d($val['date']); ?></td>
                  <td><?php echo html_entity_decode($val['type']); ?></td>
                  <td><?php echo html_entity_decode($val['description']); ?></td>
                  <td class="total_amount"><?php echo $val['debit'] != 0 ? app_format_money($val['debit'], $currency->name) : ''; ?></td>
                  <td class="total_amount"><?php echo $val['credit'] != 0 ? app_format_money($val['credit'], $currency->name) : ''; ?></td>
                  <td class="total_amount"><?php echo app_format_money($val['balance'], $currency->name); ?></td>
                </tr>
            <?php } ?>
            <tr class="treegrid-<?php echo html_entity_decode(++$row_index); ?> treegrid-parent-<?php echo html_entity_decode($parent_index); ?> tr_total">
              <td class="text-bold"><?php echo _l('report_ledger_total'); ?></td>
              <td></td>
              <td></td>
              <td></td>
              <td class="total_amount text-bold"><?php echo app_format_money($account['total_debit'], $currency->name); ?></td>
              <td class="total_amount text-bold"><?php echo app_format_money($account['total_credit'], $currency->name); ?></td>
              <td class="total_amount text-bold"><?php echo app_format_money($account['closing'], $currency->name); ?></td>
            </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
