<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="panel_s">
          <div class="panel-body">

          	<div class="row">
             <div class="col-md-12">
              <h4 class="no-margin font-bold"><i class="fa <?php if(isset($pur_invoice)){ echo 'fa-pencil-square-o';}else{ echo 'fa-plus';} ?>" aria-hidden="true"></i> <?php echo _l($title); ?> <?php if(isset($pur_invoice)){ echo ' '.html_entity_decode($pur_invoice->invoice_number); } ?></h4>
              <hr />
             </div>
            </div>
            <?php echo form_open_multipart(admin_url('purchase/pur_invoice_form'),array('id'=>'pur_invoice-form','class'=>'_pur_invoice_form')); ?>

            <div class="row">
            	<div class="col-md-6">
            		<?php echo form_hidden('id', (isset($pur_invoice) ? $pur_invoice->id : '') ); ?>
            		<div class="form-group">
            			<label for="vendor"><span class="text-danger">* </span><?php echo _l('vendor'); ?></label>
            			<select name="vendor" id="vendor" class="selectpicker" data-live-search="true" data-width="100%" data-none-selected-text="<?php echo _l('ticket_settings_none_assigned'); ?>" required>
            				<option value=""></option>
            				<?php foreach($vendors as $ven){ ?>
            				<option value="<?php echo html_entity_decode($ven['userid']); ?>" <?php if(isset($pur_invoice) && $pur_invoice->vendor == $ven['userid']){ echo 'selected'; } ?>><?php echo html_entity_decode($ven['company']); ?></option>
            				<?php } ?>
            			</select>
            		</div>
	            	<div class="col-md-6 pad_left_0">
	            		<label for="invoice_number"><span class="text-danger">* </span><?php echo _l('invoice_number'); ?></label>
		            	<?php
	                    $prefix = get_purchase_option('pur_inv_prefix');
	                    $next_number = get_purchase_option('next_inv_number');
	                    $number = (isset($pur_invoice) ? $pur_invoice->number : $next_number);
	                    echo form_hidden('number',$number); ?> 
	                           
	                    <?php $invoice_number = ( isset($pur_invoice) ? $pur_invoice->invoice_number : $prefix.str_pad($next_number,5,'0',STR_PAD_LEFT));
	                    echo render_input('invoice_number','',$invoice_number ,'text',array('readonly' => '', 'required' => 'true')); ?>
	                </div>
	                <div class="col-md-6 pad_right_0">
	                	<label for="invoice_date"><span class="text-danger">* </span><?php echo _l('invoice_date'); ?></label>
	                	<?php $invoice_date = ( isset($pur_invoice) ? _d($pur_invoice->invoice_date) : _d(date('Y-m-d')) );
	                	 echo render_date_input('invoice_date','',$invoice_date,array( 'required' => 'true')); ?>
	                </div>

	                <div class="col-md-12 pad_left_0 pad_right_0">
	                	<?php echo form_hidden('subtotal', (isset($pur_invoice) ? $pur_invoice->subtotal : 0)); ?>
	                	<?php echo form_hidden('tax', (isset($pur_invoice) ? $pur_invoice->tax : 0)); ?>
	                	<?php echo form_hidden('total', (isset($pur_invoice) ? $pur_invoice->total : 0)); ?>
	                </div>
	                <div class="col-md-12 pad_left_0 pad_right_0">
	                	<?php $adminnote = ( isset($pur_invoice) ? $pur_invoice->adminnote : '');
	                	echo render_textarea('adminnote','adminnote',$adminnote) ?>
	                </div>

	            </div>

	            <div class="col-md-6">
	                <div class="col-md-12 pad_left_0 pad_right_0">
	                	<?php $vendor_note = ( isset($pur_invoice) ? $pur_invoice->vendor_note : '');
	                	echo render_textarea('vendor_note','vendor_note',$vendor_note) ?>
	                </div>
	            </div>

            </div>


            <hr class="hr-panel-separator" />
            <div class="row">
            	<div class="col-md-12">
            		<h4 class="no-margin font-bold"><?php echo _l('item_list'); ?></h4>
            		<hr />
            	</div>
            </div>
            <div class="row">
            	<div class="col-md-4">
            		<div class="form-group">
            			<select name="item_select" class="selectpicker no-margin" data-width="false" id="item_select" data-none-selected-text="<?php echo _l('add_item'); ?>" data-live-search="true">
            				<option value=""></option>
            				<?php foreach($items as $it){ ?>
            				<option value="<?php echo html_entity_decode($it['id']); ?>"><?php echo html_entity_decode($it['label']); ?></option>
            				<?php } ?>
            			</select>
            		</div>
            	</div>
            </div>
            <div class="table-responsive s_table">
            	<table class="table invoice-items-table items table-main-invoice-edit no-mtop">
            		<thead>
            			<tr>
            				<th></th>
            				<th width="15%" align="left"><?php echo _l('commodity_code'); ?></th>
            				<th width="20%" align="left"><?php echo _l('item_description'); ?></th>
            				<th width="10%" align="right" class="qty"><?php echo _l('purchase_quantity'); ?></th>
            				<th width="10%" align="right"><?php echo _l('rate'); ?></th>
            				<th width="10%" align="right"><?php echo _l('subtotal'); ?></th>
            				<th width="15%" align="right"><?php echo _l('tax'); ?></th>
            				<th width="10%" align="right"><?php echo _l('subtotal_after_tax'); ?></th>
            				<th align="center"><i class="fa fa-cog"></i></th>
            			</tr>
            		</thead>
            		<tbody>
            			<tr class="main" style="display:none;">
            				<td><input type="hidden" name="item_code" value=""></td>
            				<td><input type="text" name="item_code_display" class="form-control" disabled></td>
            				<td>
            					<textarea name="description" class="form-control" rows="2" placeholder="<?php echo _l('item_description_placeholder'); ?>"></textarea>
            				</td>
            				<td>
            					<input type="number" name="quantity" min="0" value="1" class="form-control" placeholder="<?php echo _l('item_quantity_placeholder'); ?>">
            				</td>
            				<td>
            					<input type="number" name="rate" class="form-control" placeholder="<?php echo _l('item_rate_placeholder'); ?>">
            				</td>
            				<td><span class="subtotal-display">0</span></td>
            				<td>
            					<select class="selectpicker display-block tax" data-width="100%" name="taxname" data-none-selected-text="<?php echo _l('no_tax'); ?>">
            						<option value=""></option>
            						<?php foreach($taxes as $tx){ ?>
            						<option value="<?php echo html_entity_decode($tx['id']); ?>" data-taxrate="<?php echo html_entity_decode($tx['taxrate']); ?>"><?php echo html_entity_decode($tx['label']); ?> (<?php echo html_entity_decode($tx['taxrate']); ?>%)</option>
            						<?php } ?>
            					</select>
            				</td>
            				<td><span class="amount-after-tax-display">0</span></td>
            				<td>
            					<button type="button" onclick="pur_add_item_to_table(); return false;" class="btn pull-right btn-primary"><i class="fa fa-check"></i></button>
            				</td>
            			</tr>
            			<?php if(isset($pur_invoice_items) && count($pur_invoice_items) > 0){
            				$i = 1;
            				foreach($pur_invoice_items as $item){
            					$amount = $item['qty'] * $item['rate'];
            			?>
            			<tr class="sortable item">
            				<td class="dragger">
            					<input type="hidden" class="order" name="items[<?php echo html_entity_decode($i); ?>][order]">
            					<input type="hidden" name="items[<?php echo html_entity_decode($i); ?>][item_code]" value="<?php echo html_entity_decode($item['item_code']); ?>">
            				</td>
            				<td>
            					<input type="text" class="form-control item_code_display" value="<?php echo html_entity_decode($item['item_code']); ?>" disabled>
            				</td>
            				<td class="bold description">
            					<textarea name="items[<?php echo html_entity_decode($i); ?>][description]" class="form-control" rows="2" readonly><?php echo html_entity_decode($item['description']); ?></textarea>
            				</td>
            				<td>
            					<input type="number" min="0" name="items[<?php echo html_entity_decode($i); ?>][qty]" value="<?php echo html_entity_decode($item['qty']); ?>" class="form-control">
            				</td>
            				<td class="rate">
            					<input type="number" name="items[<?php echo html_entity_decode($i); ?>][rate]" value="<?php echo html_entity_decode($item['rate']); ?>" class="form-control">
            				</td>
            				<td class="amount" align="right"><?php echo app_format_money($amount, ''); ?></td>
            				<td class="taxrate">
            					<select class="selectpicker display-block tax" data-width="100%" name="items[<?php echo html_entity_decode($i); ?>][taxname]" data-none-selected-text="<?php echo _l('no_tax'); ?>">
            						<option value=""></option>
            						<?php foreach($taxes as $tx){ ?>
            						<option value="<?php echo html_entity_decode($tx['id']); ?>" <?php if($item['tax_id'] == $tx['id']){ echo 'selected'; } ?> data-taxrate="<?php echo html_entity_decode($tx['taxrate']); ?>"><?php echo html_entity_decode($tx['label']); ?> (<?php echo html_entity_decode($tx['taxrate']); ?>%)</option>
            						<?php } ?>
            					</select>
            				</td>
            				<td class="amount_after_tax" align="right"><?php echo app_format_money($item['amount_after_tax'], ''); ?></td>
            				<td>
            					<a href="#" class="btn btn-danger pull-left" onclick="pur_delete_item(this); return false;"><i class="fa fa-times"></i></a>
            				</td>
            			</tr>
            			<?php $i++; } ?>
            			<?php } ?>
            		</tbody>
            	</table>
            </div>
            <?php echo form_hidden('pur_invoice_detail'); ?>

            <div class="row">
            	<div class="col-md-8 col-md-offset-4">
            		<table class="table text-right">
            			<tbody>
            				<tr id="subtotal">
            					<td><span class="bold"><?php echo _l('invoice_subtotal'); ?> :</span></td>
            					<td class="subtotal"></td>
            				</tr>
            				<tr id="discount_area">
            					<td>
            						<div class="row">
            							<div class="col-md-7">
            								<span class="bold"><?php echo _l('invoice_discount'); ?></span>
            							</div>
            							<div class="col-md-5">
            								<div class="input-group" id="discount-total">
            									<input type="number" value="<?php echo (isset($pur_invoice) ? $pur_invoice->discount_percent : 0); ?>" class="form-control pull-left input-discount-percent" min="0" max="100" name="discount_percent" placeholder="%">
            									<input type="number" value="<?php echo (isset($pur_invoice) ? $pur_invoice->discount_total : 0); ?>" class="form-control pull-left input-discount-fixed" min="0" name="discount_total" placeholder="<?php echo _l('discount_fixed_amount'); ?>" style="display:none;">
            									<div class="input-group-addon">
            										<div class="dropdown">
            											<a class="dropdown-toggle" href="#" id="dropdown_menu_tax_total_type" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            												<span class="discount-total-type-selected">%</span>
            												<span class="caret"></span>
            											</a>
            											<ul class="dropdown-menu" id="discount-total-type-dropdown" aria-labelledby="dropdown_menu_tax_total_type">
            												<li><a href="#" class="discount-total-type discount-type-percent selected">%</a></li>
            												<li><a href="#" class="discount-total-type discount-type-fixed"><?php echo _l('discount_fixed_amount'); ?></a></li>
            											</ul>
            										</div>
            									</div>
            								</div>
            							</div>
            						</div>
            					</td>
            					<td class="discount-total"></td>
            				</tr>
            				<tr>
            					<td>
            						<div class="row">
            							<div class="col-md-7">
            								<span class="bold"><?php echo _l('invoice_adjustment'); ?></span>
            							</div>
            							<div class="col-md-5">
            								<input type="number" value="<?php echo (isset($pur_invoice) ? $pur_invoice->adjustment : 0); ?>" class="form-control pull-left" name="adjustment">
            							</div>
            						</div>
            					</td>
            					<td class="adjustment"></td>
            				</tr>
            				<tr>
            					<td><span class="bold"><?php echo _l('invoice_total'); ?> :</span></td>
            					<td class="total"></td>
            				</tr>
            			</tbody>
            		</table>
            	</div>
            </div>

            <div class="row">
            	<div class="col-md-12">
            		<hr />
            		<div class="panel-group" id="serials_accordion">
            			<div class="panel panel-default">
            				<div class="panel-heading">
            					<h4 class="panel-title">
            						<a data-toggle="collapse" data-parent="#serials_accordion" href="#collapse_serials">
            							<?php echo _l('serials'); ?> <i class="fa fa-chevron-down pull-right"></i>
            						</a>
            					</h4>
            				</div>
            				<div id="collapse_serials" class="panel-collapse collapse">
            					<div class="panel-body">
            						<div class="row">
            							<div class="col-md-6">
            								<div class="form-group">
            									<label><?php echo _l('upload_serial_excel'); ?></label>
            									<input type="file" id="serial_excel_input" accept=".xlsx,.xls,.csv" class="form-control" onchange="pur_parse_serial_excel(); return false;">
            									<p class="text-muted"><?php echo _l('serial_excel_format_note'); ?></p>
            								</div>
            							</div>
            							<div class="col-md-6">
            								<h5><?php echo _l('uploaded_serials'); ?>: <span id="serial_count_display">0</span></h5>
            								<div class="table-responsive" style="max-height:200px; overflow-y:auto;">
            									<table class="table table-bordered table-condensed" id="serial_preview_table">
            										<thead>
            											<tr><th><?php echo _l('commodity_code'); ?></th><th><?php echo _l('serial_number'); ?></th></tr>
            										</thead>
            										<tbody></tbody>
            									</table>
            								</div>
            							</div>
            						</div>
            					</div>
            				</div>
            			</div>
            		</div>
            		<?php echo form_hidden('pi_serial_data', ''); ?>
            	</div>
            </div>

            <div class="row">
            	<hr>
          	</div>
          	<div class="text-right">
                   <button type="submit" class="btn btn-info mbot15"><?php echo _l('submit'); ?></button>
             </div>
         	<?php echo form_close(); ?>
          </div>
      	</div>
  	</div>
  </div>
</div>

<?php init_tail(); ?>
</body>
</html>
<?php require 'modules/purchase/assets/js/pur_invoice_js.php';?>
