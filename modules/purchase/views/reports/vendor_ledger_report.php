<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div id="vendor_ledger_report" class="hide">
   <div class="row mbot15">
      <div class="col-md-12">
         <div class="btn-group pull-right">
            <a href="#" class="btn btn-default" onclick="vendor_ledger_print(); return false;"><i class="fa fa-print" aria-hidden="true"></i> <?php echo _l('report_print'); ?></a>
         </div>
      </div>
   </div>
   <div id="vendor_ledger_report_content"></div>
</div>
