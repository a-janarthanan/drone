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
						  		 if($withdraw_method=='bank') { ?>By Net Banking<?php } 
								 if($withdraw_method=='check') { ?>By Check <?php } 
  								 if($withdraw_method=='gateway') { ?>By Payment Gateway<?php } 
						  	?>
                          </td>
                      </tr>

                       <tr><td colspan="2">&nbsp;</td></tr>
             			
                        <tr><td colspan="2">
                            <table style=" width:100%; display:<?php if($withdraw_method=='bank') { echo "block"; } else { echo "none"; } ?>;">
	
                                <tr><td colspan="2" style="border-top:0px solid #E5E4E4;border-bottom:1px solid #E5E4E4;"><h2>Bank Detail</h2></td></tr>
                                
                                <tr>
                                    <td style="text-align:left;"><label class="form-label">Bank Name</label></td>
                                    <td style="text-align:left;">: <?php echo $bank_name; ?></td>
                                </tr>
                                
                                <tr>
                                    <td style="text-align:left;"><label class="form-label">Account Holder Name</label></td>
                                    <td style="text-align:left;">: <?php echo $bank_account_holder_name; ?></td>
                                </tr>
                                
                                <tr>
                                    <td style="text-align:left;"><label class="form-label">Bank Account Number</label></td>   
                                    <td style="text-align:left;">: <?php echo $bank_account_number; ?></td>
                                </tr>
    
                                <tr>
                                    <td style="text-align:left;"><label class="form-label">Bank Branch</label></td>
              