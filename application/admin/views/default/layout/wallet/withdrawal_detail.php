<div id="content" >

	<div align="left" class="column half">
		<div class="box">	
            <h2 class="box-header">Withdrawal Details</h2> 
			<div class="box-content">
            
            	 <table class="tablebox">
                  <tbody class="openable-tbody">
                  
                      <tr>
                          <td style="text-align:left; width:30%; "><label class="form-label">User </label></td>
                          <td style="text-align:left;">: <?php echo $full_name;?></td>
                      </tr>
                      
                      <tr>
                          <td style="text-align:left;"><label class="form-label">Email </label></td>
                          <td style="text-align:left;">: <?php echo $email;?></td>
                      </tr>
                      
                      <tr>
                          <td style="text-align:left;"><label class="form-label">Current Amount(<?php echo $site_setting->currency_symbol; ?>) </label></td>
                          <td style="text-align:left;">: <?php echo $total_current_amount;?></td>
                      </tr>
                      
                      <tr>
                          <td style="text-align:left;"><label class="form-label">Withdraw Amount(<?php echo $site_setting->currency_symbol; ?>) </label></td>
                          <td style="text-align:left;">: <?php echo $amount;?></td>
                      </tr>
                      
                      <tr>
                          <td style="text-align:left;"><label class="form-label">Amount To Pay(<?php echo $site_setting->currency_symbol; ?>) </label></td>
                          <td style="text-align:left;">: 
						 	 <?php	
								$donation_charge=$wallet_setting->wallet_donation_fees;
								
								if($donation_charge==0)
								{
									 echo $amount;
								}
								else
								{
									$donation_charge_fee= number_format((($amount*$donation_charge)/100),2);								
									echo $amount_to_pay = number_format(($amount-$donation_charge_fee),2);
								}				 
							?>
                          </td>
                      </tr>
                      
                      <tr>
                          <td style="text-align:left;"><label class="form-label">Withdraw Method </label></td>
                          <td style="text-align:left;">: 
                          	<?php 
						  		 if($withdraw_method=='bank') { ?>By Banking<?php } 
								 if($withdraw_method=='check') { ?>By Check <?php } 
  								 if($withdraw_method=='gateway') { ?>Paypal<?php } 
						  	?>
                          </td>
                      </tr>

                       <tr><td colspan="2">&nbsp;</td></tr>
             			
                        <tr><td colspan="2">
						<?php if($withdraw_method=='check') { ?>
                            <table style=" width:100%; display:<?php if($withdraw_method=='check') { echo "block"; } else { echo "none"; } ?>;">
	
                                <tr><td colspan="2" style="border-top:0px solid #E5E4E4;border-bottom:1px solid #E5E4E4;"><h2>Check Detail</h2></td></tr>
                                
                                <tr>
                                    <td style="text-align:left;"><label class="form-label">Check Name</label></td>
                                    <td style="text-align:left;">: <?php echo $check_name; ?></td>
                                </tr>

                                <tr>
                                    <td style="text-align:left;"><label class="form-label">Check Branch</label></td>
								    <td style="text-align:left;">: <?php echo $check_branch; ?></td>
								</tr>
								<tr>
                                    <td style="text-align:left;"><label class="form-label">Check Unique Id</label></td>
								    <td style="text-align:left;">: <?php echo $check_unique_id; ?></td>
								</tr>
								<tr>
                                    <td style="text-align:left;"><label class="form-label">Check Address Details</label></td>
								    <td style="text-align:left;">: <?php echo $check_address; ?></td>
								</tr>
								<tr>
                                    <td style="text-align:left;"><label class="form-label">Check City </label></td>
								    <td style="text-align:left;">: <?php echo $check_city; ?></td>
								</tr>
								<tr>
                                    <td style="text-align:left;"><label class="form-label">Check State </label></td>
								    <td style="text-align:left;">: <?php echo $check_state; ?></td>
								</tr>
								<tr>
                                    <td style="text-align:left;"><label class="form-label">Check Country </label></td>
								    <td style="text-align:left;">: <?php echo $check_country; ?></td>
								</tr>
								<tr>
                                    <td style="text-align:left;"><label class="form-label">Check Post Code </label></td>
								    <td style="text-align:left;">: <?php echo $check_zipcode; ?></td>
								</tr>
								<tr>
                                    <td style="text-align:left;"><label class="form-label">Check Account Holder Name </label></td>
								    <td style="text-align:left;">: <?php echo $check_account_holder_name; ?></td>
								</tr>
								<tr>
                                    <td style="text-align:left;"><label class="form-label">Check Account Number </label></td>
								    <td style="text-align:left;">: <?php echo $check_account_number; ?></td>
								</tr>
							</table>
							<?php 
							} 
							if($withdraw_method=='bank') {
							?>
							<table style=" width:100%; display:<?php if($withdraw_method=='bank') { echo "block"; } else { echo "none"; } ?>;">
	
                                <tr><td colspan="2" style="border-top:0px solid #E5E4E4;border-bottom:1px solid #E5E4E4;"><h2>Bank Detail</h2></td></tr>
                                
                                <tr>
                                    <td style="text-align:left;"><label class="form-label">Full Name</label></td>
                                    <td style="text-align:left;">: <?php echo $bank_name; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left;"><label class="form-label">National Identity Document Number (Called "Cedula") </label></td>
								    <td style="text-align:left;">: <?php echo $bank_account_holder_name; ?></td>
								</tr>
								<tr>
                                    <td style="text-align:left;"><label class="form-label">Address</label></td>
								    <td style="text-align:left;">: <?php echo $bank_account_number; ?></td>
								</tr>

                                <tr>
                                    <td style="text-align:left;"><label class="form-label">Mobile</label></td>
								    <td style="text-align:left;">: <?php echo $bank_branch; ?></td>
								</tr>
								<tr>
                                    <td style="text-align:left;"><label class="form-label">Email</label></td>
								    <td style="text-align:left;">: <?php echo $bank_ifsc_code; ?></td>
								</tr>
							<!--	<tr>
                                    <td style="text-align:left;"><label class="form-label">Bank Address Details</label></td>
								    <td style="text-align:left;">: <?php echo $bank_address; ?></td>
								</tr>
								<tr>
                                    <td style="text-align:left;"><label class="form-label">Bank City </label></td>
								    <td style="text-align:left;">: <?php echo $bank_city; ?></td>
								</tr>
								<tr>
                                    <td style="text-align:left;"><label class="form-label">Bank State </label></td>
								    <td style="text-align:left;">: <?php echo $bank_state; ?></td>
								</tr>
								<tr>
                                    <td style="text-align:left;"><label class="form-label">Bank Country </label></td>
								    <td style="text-align:left;">: <?php echo $bank_country; ?></td>
								</tr>
								<tr>
                                    <td style="text-align:left;"><label class="form-label">Bank Post Code </label></td>
								    <td style="text-align:left;">: <?php echo $bank_zipcode; ?></td>
								</tr>-->
								
							</table>
							<?php } 
							if($withdraw_method=='gateway') {
							?>
							<table style=" width:100%; display:<?php if($withdraw_method=='gateway') { echo "block"; } else { echo "none"; } ?>;">
	
                                <tr><td colspan="2" style="border-top:0px solid #E5E4E4;border-bottom:1px solid #E5E4E4;"><h2>Paypal Detail</h2></td></tr>
                                
                                <tr>
                                    <td style="text-align:left;"><label class="form-label">Paypal Email Id</label></td>
                                    <td style="text-align:left;">: <?php echo $gateway_name; ?></td>
                                </tr>

                                <!--<tr>
                                    <td style="text-align:left;"><label class="form-label">Gateway Account</label></td>
								    <td style="text-align:left;">: <?php echo $gateway_account; ?></td>
								</tr>
								
								<tr>
                                    <td style="text-align:left;"><label class="form-label">Gateway City</label></td>
								    <td style="text-align:left;">: <?php echo $gateway_city; ?></td>
								</tr>
							
								<tr>
                                    <td style="text-align:left;"><label class="form-label">Gateway State </label></td>
								    <td style="text-align:left;">: <?php echo $gateway_state; ?></td>
								</tr>
								<tr>
                                    <td style="text-align:left;"><label class="form-label">Gateway Country </label></td>
								    <td style="text-align:left;">: <?php echo $gateway_country; ?></td>
								</tr>
								<tr>
                                    <td style="text-align:left;"><label class="form-label">Gateway Post Code </label></td>
								    <td style="text-align:left;">: <?php echo $gateway_zip; ?></td>
								</tr>-->
								
							</table>
							<?php } ?>
						</td></tr>
              