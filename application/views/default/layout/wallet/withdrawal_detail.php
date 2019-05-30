
<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
 	<div class="red-subtitle top-red-subtitle" >Withdrawal Details</div>
  	<div class="profile_back">
  <div class="container">
  <div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
  <div class="home-signpost-content home-signpost-content-new-section"> 
  <div class="dbleft dbleft-main">

        <div class="mconleft">
            
            <div class="borrdercol">
                    
            
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td class="padB10" id="s1postJ"></td>
                <td align="right">
                    <?php echo anchor('wallet/','Wallet History('.$site_setting->currency_symbol.$total_wallet_amount.')','class="btn btn-default mar-bot-5"'); ?> &nbsp;|&nbsp;
                    <?php echo anchor('wallet/add_wallet','Deposit','class="btn btn-default mar-bot-5"'); ?> &nbsp;|&nbsp;
                        
                     <?php if($total_wallet_amount>$wallet_setting->wallet_minimum_amount) { ?>
                    <?php echo anchor('wallet/my_withdraw','Withdrawal History','class="btn btn-default mar-bot-5"'); ?>
                     <?php } ?>
                </td>
              </tr>
            </table>        
                              
           <div style="background: #4ca0c6; width: 400px; margin: auto; margin-top:70px; margin-bottom:10px; padding: 15px; color: #fff;">
            <table width="100%" cellspacing="4" cellpadding="4" border="0">
            <tbody>
            <tr>
                <td width="45%" valign="middle" align="left">Withdraw Amount(<?php echo $site_setting->currency_symbol;?>)</td>
                
                <td width="55%" valign="top" align="left"><?php echo $amount; ?></td>
            </tr>
            
            
            <tr>
                <td valign="top" align="left">Withdraw Method </td>
                <td valign="top" align="left"> 	
                
            <?php if($withdraw_method=='bank') { ?>By Internet Banking(EFT)<?php } 
             if($withdraw_method=='check') { ?>By Check <?php } 
              if($withdraw_method=='gateway') { ?>By Payment Gateway<?php } ?>
                
                
                </td>
                </tr>        
            </tbody>
            </table>
            </div>
            
            
            <div style="display: <?php if($withdraw_method=='bank') { echo "block"; } else { echo "none"; } ?>; display: block; background: #4ca0c6; width: 400px; margin: auto; padding: 15px;
color: #fff;" id="bank_div">
            
            <div id="detail-bg1" class="title2 how-business" style="margin:15px 0 5px 0; color:#fff; font-weight:bold; float:left; width:100%; text-align:left; font-size:24px">Bank Detail</div>
            <div class="clear"></div>
            <table width="100%" cellspacing="4" cellpadding="4" border="0">
            
            <tbody>
            <tr>
            <td width="45%" valign="middle" align="left">Bank Name</td>
            <td width="55%" valign="top" align="left"><?php echo $bank_name; ?></td>
            </tr>
            
            
            <tr>
            <td valign="middle" align="left">Account Holder Name</td>
            <td valign="top" align="left"><?php echo $bank_account_holder_name; ?></td>
            </tr>
            
            <tr>
            <td valign="middle" align="left">Bank Account Number</td>
            <td valign="top" align="left"><?php echo $bank_account_number; ?></td>
            </tr>
            
            <tr>
            <td valign="middle" align="left">Bank Branch Name</td>
            <td valign="top" align="left"><?php echo $bank_branch; ?></td>
            </tr>
            
            <tr>
            <td valign="middle" align="left">Bank Branch Code</td>
            
            <td valign="top" align="left"><?php echo $bank_ifsc_code; ?></td>
            </tr>
            
            <!--<tr>
            <td valign="middle" align="left" class="lab1">Bank Address</td>
             <td valign="top" align="left"><?php echo $bank_address; ?></td>
            </tr>
            
            <tr>
            <td valign="middle" align="left" class="lab1">Bank City</td>
            <td valign="top" align="left"><?php echo $bank_city; ?></td>
            </tr>
            
            <tr>
            <td valign="middle" align="left" class="lab1">Bank State</td>
            <td valign="top" align="left"><?php echo $bank_state; ?></td>
            </tr>
            
            <tr>
            <td valign="middle" align="left" class="lab1">Bank Country</td>
            <td valign="top" align="left"><?php echo $bank_country; ?></td>
            </tr>
            
            <tr>
            <td valign="middle" align="left" class="lab1">Bank Postal Code</td>
            <td valign="top" align="left"><?php echo $bank_zipcode; ?></td>
            </tr>-->
            
            </tbody></table>
            
            </div>
            
            
            
            <div style="display: <?php if($withdraw_method=='check') { echo "block"; } else { echo "none"; } ?>; background: #4ca0c6; width: 400px; margin: auto; padding: 15px;
color: #fff;" id="check_div">
            <div  id="detail-bg1" class="title2">Check Bank Detail</div>
            <table width="100%" cellspacing="4" cellpadding="4" border="0">
            
            <tbody>
            
            <tr>
            <td width="45%" align="left" valign="middle">Bank Name</td>
            
            <td width="55%" align="left" valign="top"><?php echo $check_name; ?></td>
            </tr>
            
            
            <tr>
            <td valign="middle" align="left" >Account Holder Name</td>
            
            <td valign="top" align="left"><?php echo $check_account_holder_name; ?></td>
            </tr>
            
            
            <tr>
            <td valign="middle" align="left" >Bank Account Number</td>
            
            <td valign="top" align="left"><?php echo $check_account_number; ?></td>
            </tr>
            
            
            <tr>
            <td valign="middle" align="left">Bank Branch</td>
            
            <td valign="top" align="left"><?php echo $check_branch; ?></td>
            </tr>
            
            
            
            <tr>
            <td valign="middle" align="left">Bank IFSC Code</td>
            
            <td valign="top" align="left"><?php echo $check_unique_id; ?></td>
            </tr>
            
            
            <tr>
            <td valign="middle" align="left">Bank Address</td>
            
            <td valign="top" align="left"><?php echo $check_address; ?></td>
            </tr>
            
            
            
            
            
            
            <tr>
            <td valign="middle" align="left" >Bank City</td>
            
            <td valign="top" align="left"><?php echo $check_city; ?></td>
            </tr>
            
            
            <tr>
            <td valign="middle" align="left" >Bank State</td>
            
            <td valign="top" align="left"><?php echo $check_state; ?></td>
            </tr>
            
            
            <tr>
            <td valign="middle" align="left" >Bank Country</td>
            
            <td valign="top" align="left"><?php echo $check_country; ?></td>
            </tr>
            
            
            <tr>
            <td valign="middle" align="left" >Bank Postal Code</td>
            
            <td valign="top" align="left"><?php echo $check_zipcode; ?></td>
            </tr>
            
            </tbody></table>
            </div>
            
            
            <div style="display: <?php if($withdraw_method=='gateway') { echo "block"; } else { echo "none"; } ?>; background: #4ca0c6; width: 400px; margin: auto; padding: 15px;
color: #fff;" id="gateway_div">
            <div id="detail-bg1" class="title2">Payment Gateway Detail</div>
            <table width="100%" cellspacing="4" cellpadding="4" border="0">
            
            <tbody><tr>
            <td width="45%"  align="left" valign="middle" >Gateway Name</td>
            <td width="55%"  align="left" valign="top"><?php echo $gateway_name; ?></td>
            </tr>
            
            <tr>
            <td valign="middle" align="left" >Gateway Account</td>
            <td valign="top" align="left"><?php echo $gateway_account; ?></td>
            </tr>
            
            <tr>
            <td valign="middle" align="left" >Gateway City</td>
            <td valign="top" align="left"><?php echo $gateway_city; ?></td>
            </tr>
            
            
            <tr>
            <td valign="middle" align="left" >Gateway State</td>
            
            <td valign="top" align="left"><?php echo $gateway_state; ?></td>
            </tr>
            
            
            <tr>
            <td valign="middle" align="left" >Gateway Country</td>
            
            <td valign="top" align="left"><?php echo $gateway_country; ?></td>
            </tr>
            
            
            <tr>
            <td valign="middle" align="left" >Gateway Postal Code</td>
            
            <td valign="top" align="left"><?php echo $gateway_zip; ?></td>
            </tr>
            
            </tbody></table>
            
            </div>
                
            
            
            
                        </div>

		</div><!--left-->
</div><!--left-->
</div>
<div class="dbright-task dbright-task-main">
<?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
</div>

</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>

