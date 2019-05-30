
<div class="main">
<div class="incon">
    	<!--<div class="mconleft">-->



<?php 
if($msg=='add' && $msg!=''){?>
<div class="marTB10" id="success"><p>Amount has been added successfully in wallet.</p></div>
<?php }  if($msg=='fail' && $msg!='') { ?>

<div class="marTB10" id="error"><p>Your Payment Process is Failed.</p></div>
<?php } ?> 
    


                
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td class="padB10" id="s1postJ">Wallet History(<?php echo $site_setting->currency_symbol.$total_wallet_amount;	?>)</td>
    <td align="right">
		<?php echo anchor('wallet/add_wallet','Deposit','class="fpass"'); ?> &nbsp;|&nbsp;
      
        <?php if($total_wallet_amount>$wallet_setting->wallet_minimum_amount) { ?>
            <?php echo anchor('wallet/withdraw_wallet','Withdraw','class="fpass"'); ?>&nbsp;|&nbsp;
            <?php echo anchor('wallet/my_withdraw','Withdrawal History','class="fpass"'); ?> 
	      
         <?php } ?>
    </td>
  </tr>
</table>


            



<table width="100%" cellspacing="1" cellpadding="5" border="0" align="left" id="wallet_table">
			 
			 <tbody>
             <tr>
                <th>&nbsp;</th>
                <th>Amount</th>
                <th>PAY BY</th>
				<th>TRANSACTION ID</th>                                     
                <th>TASK</th>
                <th>GATEWAY</th>
                <th width="100">DATE</th>
                <th>STATUS</th>
			</tr>

			 <?php
			 
			 if($wallet_details) {
			 
			 $i=0;
			 	foreach($wallet_details as $rs) { 
				
					$cls='debit';
					if($rs->credit>0)
					{
						$cls='credit';				
					}
					if($rs->debit>0)
					{
						$cls='debit';				
					}
					if($rs->admin_status=='Review') 
					{
						$cls='review';
					}
							
					
				?>

<tr class="<?php echo $cls; ?>">
				<td align="center" valign="middle"><?php if($rs->credit>0) { echo "Debit"; } if($rs->debit>0) { echo "Credit"; } ?></td>
				<td align="right" valign="middle" ><?php if($rs->credit>0) { echo "-".number_format($rs->credit,2); } if($rs->debit>0) { echo "+".number_format($rs->debit,2); } ?>  </td>
				<td align="left" valign="middle"><?php if($rs->wallet_payee_email!='') { echo $rs->wallet_payee_email; } else { echo "Internal"; } ?></td>
				<td align="center" valign="middle"><?php echo $rs->wallet_transaction_id; ?></td>
				
				<td align="left" valign="middle"><?php if($rs->task_id=='' || $rs->task_id==0 || $rs->task_id=='0') { } else {
				
				$task_detail=$this->task_model->get_tasks_detail_by_id($rs->task_id);
				if($task_detail) { 
				echo anchor('tasks/'.$task_detail->task_url_name,substr(ucfirst($task_detail->task_name),0,22),'class="fpass"');
				}
				
				}?> 
				</td>
				
				<td align="center" valign="middle"><?php if($rs->gateway_id==0 || $rs->gateway_id=='0') { echo "Internal"; } else { 
				
			
				$gateway_detail=$this->wallet_model->get_paymentid_result($rs->gateway_id);
				
				echo $gateway_detail->name;
				
			
				
				
				 } ?></td>				
				<td align="center" valign="middle"><?php echo date($site_setting->date_time_format,strtotime($rs->wallet_date)); ?></td>
				<td align="center" valign="middle"><?php if($rs->admin_status=="Review"){ ?><span style="color:#FF0000; font-weight:bold;"><?php echo $rs->admin_status; ?></span> <?php } if($rs->admin_status=="Confirm") { ?><span style="color:#009900; font-weight:bold;"><?php echo $rs->admin_status; ?> </span> <?php }  ?></td>
				</tr>                


			 <?php $i++; } ?>
			 
		
			 <?php if($total_rows>$limit) { ?>
                            <tr class="debit">
                    <td valign="middle" height="35" align="center" colspan="8">


					<div class="gonext" style="width:405px;">
                    <?php echo $page_link; ?>
                    </div>
			
       
                    <div class="clear"></div>
                       
                     </td>
                </tr>
                
                	<?php } ?>       
                    
                    
	
			 <?php   } else { ?>

			<tr class="even">
			<td colspan="8" align="center" valign="middle"><?php echo "No record found"; ?>.</td>
			</tr>
			 
			 <?php } ?>             
             


                
            
</tbody>
</table>	

                  

            


                


            
            
         
<!--  </div>  -->    
             
              <?php //echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>   
                
                <div class="clear"></div>
		</div>
        
       
		  <div class="clear"></div>
        
        
    </div>
</div>

