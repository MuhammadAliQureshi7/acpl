<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div id="sales-itemswise-report" class="hide">
    <div class="row mbot15">
        <div class="col-md-12">
            <div class="btn-group pull-right">
                <a href="#" class="btn btn-default" onclick="sales_detail_print('itemswise'); return false;"><i class="fa-regular fa-print"></i> <?php echo _l('report_print'); ?></a>
            </div>
        </div>
    </div>
    <div id="sales-itemswise-report-content"></div>
</div>
