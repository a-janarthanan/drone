<style>
	.onefv a{ color:#333 !important; }
	a.nextN{ color:#fff !important;}
</style>
<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->

<div>
	<div>
	<!--<div class="page-title mbot20">
		<h1 class="mleft15">Wallet History(<?php echo $site_setting->currency_symbol.$total_wallet_amount;	?>)</h1>
	</div>-->
    <div class="red-subtitle top-red-subtitle">Wallet history(<?php echo $site_setting->currency_symbol.$total_wallet_amount;	?>)</div>
    	<!--<div class="mconleft">-->

<div id="two-columnar-section" class="top-cont-main-dash profile_back">
<div class="task-layout">
<div class="db-rightinfo" style="width:100%; margin:0px 0 0 0">
<div class="home-signpost-content" style="min-height:300px;"> 

<?php 
if($msg=='add' && $msg!=''){?>
<div class="marTB10" id="success"><p>Amount has been added successfully in wallet.</p></div>
<?php }  if($msg=='fail' && $msg!='') { ?>

<div class="marTB10" id="error"><p>Your Payment Process is Failed.</p></div>
<?php }  if($msg=='review' && $msg!='') { ?>

<div class="marTB10" id="success"><p>Your transaction is successful. Please note : It will remain under review status till we got confirmation from respective bank.</p></div>
<?php } ?> 
    


                
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    
    <td align="right" class="mar_bot">
		<?php echo anchor('wallet/add_wallet','Deposit','class="btn btn-default"'); ?> 
      
        <?php if($total_wallet_amount>$wallet_setting->wallet_minimum_amount) { ?>
         &nbsp;|&nbsp;
		 <?php echo anchor('wallet/withdraw_wallet','Withdraw','class="btn btn-default"'); ?>&nbsp;|&nbsp;
            <?php echo anchor('wallet/my_withdraw','Withdrawal History','class="btn btn-default"'); ?> 
	      
         <?php } ?>
    </td>
  </tr>
</table>


            


<div class="responsive_table new_design">
<table width="100%" cellspacing="0" cellpadding="0" border="0" align="left" id="wallet_table">
			 
			 <tbody>
             <tr>
                <th width="170">Date</th>
                <th>Task</th>
                <th style="text-align:center;">Transaction Type</th>
                <th style="text-align:center;">Amount</th>
                <!--<th>PAYEE</th>
				<th>TRANSACTION ID</th>                                     
                <th>GATEWAY</th>-->
                <th style="text-align:center;">Status</th>
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

<tr class="<?php echo $cls; ?> <?php if($i % 2 == 0){ echo " odd "; } else { echo " even "; }; ?>">
				<td align="center" valign="middle"><?php echo date($site_setting->date_time_format,strtotime($rs->wallet_date)); ?></td>
				<td align="left" valign="middle"><?php if($rs->task_id=='' || $rs->task_id==0 || $rs->task_id=='0') { } else {
				$task_detail=$this->task_model->get_tasks_detail_by_id($rs->task_id);
				if($task_detail) { 
				echo anchor('tasks/'.$task_detail->task_url_name,substr(ucfirst($task_detail->task_name),0,22),'class="fpass"');
				}
				}?> 
				</td>
                <td align="center" valign="middle" style="text-align:center;"><?php if($rs->credit>0) { echo "Debit"; } if($rs->debit>0) { echo "Credit"; } ?></td>
				<td align="right" valign="middle" style="text-align:center;"><?php if($rs->credit>0) { echo "-".number_format($rs->credit,2); } if($rs->debit>0) { echo "+".number_format($rs->debit,2); } ?>  </td>
				<!--<td align="left" valign="middle"><?php if($rs->wallet_payee_email!='') { echo $rs->wallet_payee_email; } else { echo "Internal"; } ?></td>
				<td align="center" valign="middle"><?php echo $rs->wallet_transaction_id; ?></td>
				<td align="center" valign="middle"><?php if($rs->gateway_id==0 || $rs->gateway_id=='0') { echo "Internal"; } else { 
				$gateway_detail=$this->wallet_model->get_paymentid_result($rs->gateway_id);
				echo $gateway_detail->name;
				 } ?></td>-->				
				<td align="center" valign="middle" style="text-align:center;"><?php if($rs->admin_status=="Review"){ ?><span style="color:#FF0000; font-weight:bold;"><?php echo $rs->admin_status; ?></span> <?php } if($rs->admin_status=="Confirm") { ?><span style="color:#009900; font-weight:bold;"><?php echo $rs->admin_status; ?> </span> <?php }  ?></td>
				</tr>                


			 <?php $i++; } ?>
			 
		
			 <?php if($total_rows>$limit) { ?>
                            <tr class="debit">
                    <td valign="middle" height="35" align="center" colspan="5">


					<div class="gonext">
                    <?php echo $page_link; ?>
                    </div>
			
       
                    <div class="clear"></div>
                       
                     </td>
                </tr>
                
                	<?php } ?>       
                    
                    
	
			 <?php   } else { ?>

			<tr class="even">
			<td colspan="8" align="center" valign="middle"><?php echo "You have no history since you have not run or post any Tasks that  have been completed."; ?>.</td>
			</tr>
			 
			 <?php } ?>             
             


                
            
</tbody>
</table>	

 </div>                 

            


                


            
            
         
<!--  </div>  -->    
             
              <?php //echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>   
                
                <div class="clear"></div>
		</div>
        </div>
        </div>

        
        
    </div>
</div>

