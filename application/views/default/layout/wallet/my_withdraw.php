<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
<div>


 <div class="red-subtitle top-red-subtitle">Withdraw Amount</div>
    	<div id="two-columnar-section" class="top-cont-main-dash profile_back">
        <div class="task-layout">
        <div class="db-rightinfo" style="width:100%; margin:0px 0 0 0">
        <div class="home-signpost-content" style="min-height:300px;"> 
    

                
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    
    <td align="right" class="mar_bot">
		<?php echo anchor('wallet/','Wallet History('.$site_setting->currency_symbol.$total_wallet_amount.')','class="btn btn-default"'); ?> &nbsp;|&nbsp;
        <?php echo anchor('wallet/add_wallet','Deposit','class="btn btn-default"'); ?> &nbsp;|&nbsp;
        
         <?php if($total_wallet_amount>$wallet_setting->wallet_minimum_amount) { ?>
        <?php echo anchor('wallet/withdraw_wallet','Withdraw','class="btn btn-default"'); ?>
         <?php } ?>
    </td>
  </tr>
</table>


			 <?php if($msg!='') 
			 {  if($msg=='success') { ?>
			 <div class="marTB10" id="error"><p>Withdraw Requested has been submitted successfully. Wait For admin Approval.</p></div>
			  <?php } if($msg=='update') { ?>
			  <div class="marTB10" id="error" ><p>Withdraw Requested has been updated successfully. Wait For admin Approval.</p></div>
			  <?php }  } ?>



<div class="responsive_table new_design">       
		<table width="100%" cellspacing="0" cellpadding="0" border="0" align="left" id="wallet_table">
			 <tbody>
             <tr>
                <th width="170">Date</th>
                <th>Payment Method</th>
                <th style="text-align:center">Amount(<?php echo $site_setting->currency_symbol; ?>)</th>
				<th style="text-align:center">Status</th>                                     
                <th style="text-align:center">Details</th>
			</tr>
			 
			 <?php
			 
			 if($withdraw_details) {
			 
			 $i=0;
			 	foreach($withdraw_details as $rs) { 
				if($rs->withdraw_status=='pending')
				{
					$cls='credit';				
				}
				else
				{
					$cls='debit';
				}			
				
				?>


			<tr class="<?php echo $cls; ?> <?php if($i % 2 == 0){ echo " odd "; } else { echo " even "; }; ?>">
				<td align="center" valign="middle"><?php echo date('d,M Y H:i:s',strtotime($rs->withdraw_date)); ?></td>
                <td align="center" valign="middle" ><?php if($rs->withdraw_method=='bank') { echo "Bank"; } if($rs->withdraw_method=='check') { echo "Check"; } if($rs->withdraw_method=='gateway') { echo "Gateway"; } ?>  </td>
                <td align="right" valign="middle" style="padding-right:8px; text-align:center;"><?php echo number_format($rs->withdraw_amount,2);  ?></td>
				<td align="center" valign="middle" style="text-transform:capitalize; text-align:center;"><?php echo $rs->withdraw_status; ?></td>
				<td align="center" valign="middle" style="text-align:center;"><?php if($rs->withdraw_status=='pending') { echo anchor('wallet/withdraw_details/'.$rs->withdraw_id,'View','class="fpass"'); } else { echo anchor('wallet/withdrawal_detail/'.$rs->withdraw_id,'View','class="fpass"'); }?></td>
			</tr>      
            <?php $i++; } ?>
			<?php if($total_rows>$limit) { ?>
			<tr class="debit" ><td colspan="5" height="35" align="center" valign="middle">
                <div class="gonext" style="width:405px;">
                <?php echo $page_link; ?>
                </div>
				<div class="clear"></div>
			</td></tr>	<?php } ?>   
			<?php  }  else { ?>                      
			<tr style="background-color:#FFF;">
				<td colspan="5" align="center" valign="middle">No Withdrawal in Wallet.</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>             
</div>                
         <!--</div>-->
               <?php //echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>   
                 <div class="clear"></div>
</div>
  <div class="clear"></div>
</div>
</div>
</div>