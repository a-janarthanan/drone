<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>
	
	
	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">PayPal Settings</h2> 
			<div class="box-content">
			  <?php			 
					$attributes = array('name'=>'frm_paypal');
					echo form_open('transaction_type/add_paypal',$attributes);
			  ?>													
				  <label class="form-label">Site Status</label> 
				  <select name="site_status" id="site_status" class="form-field settingselectbox required">
				  	 	<option value="sandbox" <?php if($site_status=='sandbox'){ echo "selected"; } ?>>sand box</option>
						<option value="live" <?php if($site_status=='live'){ echo "selected"; } ?>>live</option>
				  </select> 
				  
				  <label class="form-label">Paypal Application Id </label>
				  <input type="text" name="application_id" id="application_id" value="<?php echo $application_id; ?>" class="form-field width40"/> (ex :: APP-80W284485P519543T)
				  
				  <label class="form-label">Paypal Email Id</label>
				   <input type="text" name="paypal_email" id="paypal_email" value="<?php echo $paypal_email; ?>" class="form-field width40"/>
				  
				  <label class="form-label">Paypal API Username </label>
				  <input type="text" name="paypal_username" id="paypal_username" value="<?php echo $paypal_username; ?>" class="form-field width40"/>
				  
				  <label class="form-label">Paypal API Password</label>
				   <input type="password" name="paypal_password" id="paypal_password" value="<?php echo $paypal_password; ?>" class="form-field width40"/>

				  <label class="form-label">Paypal API Signature</label>
				  <input type="text" name="paypal_signature" id="paypal_signature" value="<?php echo $paypal_signature; ?>" class="form-field width40"/>
				  
				   <label class="form-label">Preapproval</label>
					   <select name="preapproval" id="preapproval" class="form-field settingselectbox required" >
						   <option value="">select</option>
						   <option  value="0" <?php if($preapproval=='0'){ echo "selected"; } ?>>Inactive</option>
						   <option  value="1" <?php if($preapproval=='1'){ echo "selected"; } ?>>Active</option>
					   </select>
				   
				   <label class="form-label">Paypal Fees taken from</label>
						<select name="fees_taken_from" id="fees_taken_from" class="form-field settingselectbox required">							
							<option value="SENDER" <?php if($fees_taken_from=='SENDER'){ echo "selected"; } ?>>Donar</option>
							<option value="PRIMARYRECEIVER" <?php if($fees_taken_from=='PRIMARYRECEIVER'){ echo "selected"; } ?>>Project Owner</option>
						</select>

				  <label class="form-label">Commission fees(%)</label>
				  <input type="text" name="transaction_fees" id="transaction_fees" value="<?php echo $transaction_fees; ?>" class="form-field width40"/>
				  
				   <label class="form-label">Gateway Status</label>
						<select name="gateway_status" id="gateway_status" class="form-field settingselectbox required">     
							<option  value="0" <?php if($gateway_status=='0'){ echo "selected"; } ?>>Inactive</option>
							<option  value="1" <?php if($gateway_status=='1'){ echo "selected"; } ?>>Active</option>
						</select>
				   
				   
				   
				    <label class="form-label">&nbsp;</label>
				   <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
				   <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
				   <input type="submit" class="button themed" name="submit" value="Update" onclick=""/>
				   
				 <!--  <input type="button" class="button themed" name="cancel" value="Cancel"  onClick="location.href='<?php echo base_url(); ?>facebook_setting/add_facebook_setting'"/>-->
				  
				  
			  </form>
            
			
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>