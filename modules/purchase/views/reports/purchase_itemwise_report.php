<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div id="purchase_itemwise_report" class="hide">
   <div class="row mbot15">
      <div class="col-md-12">
         <div class="btn-group pull-right">
            <a href="#" class="btn btn-default" onclick="purchase_detail_print('itemwise'); return false;"><i class="fa fa-print" aria-hidden="true"></i> <?php echo _l('report_print'); ?></a>
         </div>
      </div>
   </div>
   <div id="purchase_itemwise_report_content"></div>
</div>
