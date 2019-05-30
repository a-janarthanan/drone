<div>
	<div>
	<!--<div class="page-title mbot20">
		<h1 class="mleft15">Add Amount to Your Wallet</h1>
	</div>-->
    <div class="red-subtitle" >Add Amount to Your Wallet</div>
          <div id="two-columnar-section">
<div class="task-layout">
<div class="db-rightinfo" style="width:100%; margin:25px 0 0 0">
<div class="home-signpost-content"> 
    	<div class="dbleft">



<?php if($error!='') { ?> 
<div class="marTB10" id="error"><p><?php echo $error; ?></p></div><?php } ?>



        


          
<div class="borrdercol">

	<div class="alignright">
		<?php echo anchor('wallet/','Wallet History('.$site_setting->currency_symbol.$total_wallet_amount.')','class="fpass chbg"'); ?> &nbsp;|&nbsp;
      
      
        <?php if($total_wallet_amount>$wallet_setting->wallet_minimum_amount) { ?>
        
	        <?php echo anchor('wallet/withdraw_wallet','Withdraw','class="fpass chbg"'); ?> &nbsp;|&nbsp;
              <?php echo anchor('wallet/my_withdraw','Withdrawal History','class="fpass chbg"'); ?> 
         <?php } ?>
         
      
        
	</div>


<?php
	$attributes = array('name'=>'frmAddWallet','id'=>'frmAddWallet','class'=>'form_design');
	echo form_open('wallet/add_wallet',$attributes);
?>





<div id="detail-bg2" class="padTB10" style="font-size:20px;"><b style="color:#F00;">Note : </b><p>Transaction Fees <b class="colblack"><?php echo $wallet_setting->wallet_add_fees; ?>(%)</b> is added on the Total Wallet or Transaction Amount. Minimum <b class="colblack"><?php echo $site_setting->currency_symbol.$wallet_setting->wallet_minimum_amount; ?></b> is required.</p>

<!--<p>1. Pay through paypal and wait for 24 hours for Administrator Approval.</p>
<p>2. Pay via Credit Card for Instant Approval.</p>-->



</div>



<table width="100%" cellspacing="4" cellpadding="4" border="0">
<tbody>
<tr>
    <td width="20%" valign="middle" align="left" class="lab1" style="font-size:20px;">Add Amount(<?php echo $site_setting->currency_symbol;?>)</td>
    
    <td width="80%" valign="top" align="left"><input type="text" value="<?php echo $credit ;?>" id="credit" name="credit" class="ntext"></td>
</tr>


<tr>
    <td valign="top" align="left"  class="lab1" style="font-size:20px;">Gateway </td>
   
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
                                            
                                            
                                         
<p class="fs13" style="font-size:20px;"><input type="radio" name="gateway_type" id="gateway_type" value="<?php echo $row->id; ?>" <?php echo $check;?> /><?php echo $row->name; ?></p>
	                                        
			<?php
			}
		}
		
		?>    
	
	</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
    	<td></td>
        <td align="left"><input type="submit" name="add_detail" class="submbg2 chbg" value="Add" style="width:195px;"></td>
    </tr>
</tbody>
</table>    
    

</form>    
  
                
</div>                

    
  </div>      
                
                
		
        <div class="dbright-task">
        <?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
        </div>
        
        </div>
        
    </div>
		
        </div>
        
    </div>




