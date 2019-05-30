<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">Wallet Settings </h2> 
			<div class="box-content">
			
			  <?php
				$attributes = array('name'=>'frm_wallet_setting');
				echo form_open('wallet_setting/add_wallet_setting',$attributes);
			  ?>
			  
			  	  
				  
				  <label class="form-label">Deposite to Wallet Fees(%) </label>
		    	  <input type="text" name="wallet_add_fees" id="wallet_add_fees" value="<?php echo $wallet_add_fees; ?>" class="form-field width40"/>
				  									
				  <label class="form-label">Withdraw From Wallet Fees(%) </label> 
				  <input type="text" name="wallet_donation_fees" id="wallet_donation_fees" value="<?php echo $wallet_donation_fees; ?>" class="form-field width40"/>
									
			      <label class="form-label">Minimum Wallet Deposite Amount </label>
				  <input type="text" name="wallet_minimum_amount" id="wallet_minimum_amount" value="<?php echo $wallet_minimum_amount; ?>" class="form-field width40"/><br />(User have to widthdraw minimum amount.)<br /><br />
                  <label class="form-label">Auto Pay After number of confirmed withdraw </label>
				  <input type="text" name="no_payment_after_auto_confirm" id="no_payment_after_auto_confirm" value="<?php echo $no_payment_after_auto_confirm; ?>" class="form-field width40"/><br />(User will able to automatically withdraw after above confirmed withdraw.)<br /><br />
				  
				   <label class="form-label">Wallet Status </label> 
                    <select name="wallet_enable" id="wallet_enable" class="form-field settingselectbox required">
                        <option value="0" <?php if($wallet_enable=='0'){ echo "selected"; } ?>>Inactive</option>
                        <option value="1" <?php if($wallet_enable=='1'){ echo "selected"; } ?>>Active</option>														
					 </select>
                   
				  
				  
				  <label class="form-label">&nbsp;</label>
				 <input type="hidden" name="wallet_id" id="wallet_id" value="<?php echo $wallet_id; ?>" />

				  <input type="submit" class="button themed" name="submit" value="Update" onclick=""/>
				  
			  </form>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>