

<div class="main">
<div class="incon">
    	<div class="mconleft">



<?php if($error!='') { ?> 
<div class="marTB10" id="error"><p><?php echo $error; ?></p></div><?php } ?>



          <div class="padB10" id="s1postJ" >Add Amount to Your Wallet</div> 


          
<div class="borrdercol">

	<div class="alignright">
		<?php echo anchor('wallet/','Wallet History('.$site_setting->currency_symbol.$total_wallet_amount.')','class="fpass"'); ?> &nbsp;|&nbsp;
      
      
        <?php if($total_wallet_amount>$wallet_setting->wallet_minimum_amount) { ?>
        
	        <?php echo anchor('wallet/withdraw_wallet','Withdraw','class="fpass"'); ?> &nbsp;|&nbsp;
              <?php echo anchor('wallet/my_withdraw','Withdrawal History','class="fpass"'); ?> 
         <?php } ?>
         
      
        
	</div>


<?php
	$attributes = array('name'=>'frmAddWallet','id'=>'frmAddWallet','class'=>'form_design');
	echo form_open('wallet/add_wallet',$attributes);
?>





<div id="detail-bg2" class="padTB10"><b style="color:#F00;">Note : </b><p>Transaction Fees <b class="colblack"><?php echo $wallet_setting->wallet_add_fees; ?>(%)</b> is added on the Total Wallet or Transaction Amount. Minimum <b class="colblack"><?php echo $site_setting->currency_symbol.$wallet_setting->wallet_minimum_amount; ?></b> is required.</p>

<!--<p>1. Pay through paypal and wait for 24 hours for Administrator Approval.</p>
<p>2. Pay via Credit Card for Instant Approval.</p>-->



</div>



<table width="100%" cellspacing="4" cellpadding="4" border="0">
<tbody>
<tr>
    <td width="20%" valign="middle" align="left" class="lab1">Add Amount(<?php echo $site_setting->currency_symbol;?>)</td>
    
    <td width="80%" valign="top" align="left"><input type="text" value="<?php echo $credit ;?>" id="credit" name="credit" class="ntext"></td>
</tr>


<tr>
    <td valign="top" align="left"  class="lab1">Gateway </td>
   
    <td valign="top" align="left"> 	

   
<?php	
	
		if($payment)
		{
			$i=0;
			foreach($payment as $row)
			{
			$check='';
			//var_dump($payment);exit;
			 if($gateway_type==$row->id)$check='checked=checked';
			else if($i==0)$check='checked=checked';
				?>
                                            
                                            
                                         
<p class="fs13"><input type="radio" name="gateway_type" id="gateway_type" value="<?php echo $row->id; ?>" <?php echo $check;?> /><?php echo $row->name; ?></p>
	                                        
			<?php
			}
		}
		
		?>    
	
	</td>
	</tr>

	<tr>
    	<td></td>
        <td align="left"><input type="submit" name="add_detail" class="submbg2" value="Add"></td>
    </tr>
</tbody>
</table>    
    

</form>    
  
                
</div>                

    
  </div>      
                
                
		
        
        <?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
		
        </div>
        
    </div>




