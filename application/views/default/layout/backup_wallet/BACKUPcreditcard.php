
<div class="main">
<div class="incon">
    	<div class="mconleft">



<?php if($error!='') { ?> 
    <div id="error" class="marTB10"><p><?php echo $error; ?></p></div><?php } ?>

<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td class="padB10" id="s1postJ">Credit Card Information</td>
    <td align="right">
    </td>
  </tr>
</table>





  <div class="borrdercol">
  

<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td></td>
    <td align="right">
		<?php echo anchor('wallet/','Wallet History('.$site_setting->currency_symbol.$total_wallet_amount.')','class="fpass"'); ?> &nbsp;|&nbsp;
     
        
         <?php if($total_wallet_amount>$wallet_setting->wallet_minimum_amount) { ?>
      
           <?php echo anchor('wallet/withdraw_wallet','Withdraw','class="fpass"'); ?>  &nbsp;|&nbsp;
            <?php echo anchor('wallet/my_withdraw/','Withdrawal History','class="fpass"'); ?>
         <?php } ?>
    </td>
  </tr>
</table>
  
        
		 <?php
				  		$attributes = array('name'=>'frm_creditcard');
						echo form_open_multipart('wallet/creditcard/'.$id."/".$amt.'/'.$task_id.'/'.$task_comment_id,$attributes);
					
				  	?>

<input type=hidden name=paymentType value="<?php echo $paymentType?>" />


<table width="100%" cellspacing="4" cellpadding="4" border="0">
<tbody>
<tr>
    <td width="20%" valign="middle" align="left" class="lab1">First Name:</td>
    
    <td width="80%" valign="top" align="left"><input type="text"  maxlength="32" value="<?php echo $first_name ;?>" id="firstName" name="firstName" class="ntext"></td>
</tr>

<tr>
    <td  valign="middle" align="left" class="lab1">Last Name:</td>
    
    <td  valign="top" align="left"><input type="text"  maxlength="32" value="<?php echo $last_name ;?>" id="lastName" name="lastName" class="ntext"></td>
</tr>



<tr>
    <td  valign="middle" align="left" class="lab1">Card Type:</td>
    
    <td valign="top" align="left">
			<select name="creditCardType" onChange="javascript:generateCC(); return false;">
				<option value="Visa" selected="selected">Visa</option>
				<option value="MasterCard">MasterCard</option>
				<option value="Discover">Discover</option>
				<option value="Amex">American Express</option>
			</select>    
    </td>
</tr>


<tr>
    <td valign="middle" align="left" class="lab1">Card Number:</td>
    
    <td  valign="top" align="left"><input type="text"  maxlength="19" value="<?php //echo $last_name ;?>" id="creditCardNumber" name="creditCardNumber" class="ntext"></td>
</tr>




<tr>
    <td  valign="middle" align="left" class="lab1">Expiration Date:</td>
    
    <td  valign="top" align="left">
			<select name="expDateMonth">
				<option value="1">01</option>
				<option value="2">02</option>
				<option value="3">03</option>
				<option value="4">04</option>
				<option value="5">05</option>
				<option value="6">06</option>
				<option value="7">07</option>
				<option value="8">08</option>
				<option value="9">09</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
			</select>
			<select name="expDateYear">
				<?php for($i=date('Y');$i<=date('Y')+7;$i++) 
						{ ?>
                                              
                        <option value="<?php echo $i;?>" ><?php echo $i;?></option>
						<?php } ?>
			</select>            
            
    </td>
</tr>

<tr>
    <td  valign="middle" align="left" class="lab1">Card Verification Number:</td>
    
    <td valign="top" align="left"><input type="text" size="5"   maxlength="4" value="<?php //echo $last_name ;?>" id="cvv2Number" name="cvv2Number" class=""></td>
</tr>

<tr>
	<td colspan="2" class="title2">Billing Address:</td>
</tr>


<tr>
    <td  valign="middle" align="left" class="lab1">Address 1:</td>
    
    <td  valign="top" align="left"><input type="text"  maxlength="100" value="<?php //echo $last_name ;?>" id="address1" name="address1" class="ntext"></td>
</tr>

<tr>
    <td  valign="middle" align="left" class="lab1">Address 2:</td>
    
    <td valign="top" align="left"><input type="text"  maxlength="100" value="<?php //echo $last_name ;?>" id="address2" name="address2" class="ntext">(optional)</td>
</tr>

<tr>
    <td valign="middle" align="left" class="lab1">City:</td>
    
    <td  valign="top" align="left"><input type="text"  maxlength="40" value="<?php //echo $last_name ;?>" id="city" name="city" class="ntext"></td>
</tr>


<tr>
    <td  valign="middle" align="left" class="lab1">State:</td>
    
    <td  valign="top" align="left">
		<select id=state name=state>
				<option value=""></option>
				<option value="AK">AK</option>
				<option value="AL">AL</option>
				<option value="AR">AR</option>
				<option value="AZ">AZ</option>
				<option value="CA" selected="selected">CA</option>
				<option value="CO">CO</option>
				<option value="CT">CT</option>
				<option value="DC">DC</option>
				<option value="DE">DE</option>
				<option value="FL">FL</option>
				<option value="GA">GA</option>
				<option value="HI">HI</option>
				<option value="IA">IA</option>
				<option value="ID">ID</option>
				<option value="IL">IL</option>
				<option value="IN">IN</option>
				<option value="KS">KS</option>
				<option value="KY">KY</option>
				<option value="LA">LA</option>
				<option value="MA">MA</option>
				<option value="MD">MD</option>
				<option value="ME">ME</option>
				<option value="MI">MI</option>
				<option value="MN">MN</option>
				<option value="MO">MO</option>
				<option value="MS">MS</option>
				<option value="MT">MT</option>
				<option value="NC">NC</option>
				<option value="ND">ND</option>
				<option value="NE">NE</option>
				<option value="NH">NH</option>
				<option value="NJ">NJ</option>
				<option value="NM">NM</option>
				<option value="NV">NV</option>
				<option value="NY">NY</option>
				<option value="OH">OH</option>
				<option value="OK">OK</option>
				<option value="OR">OR</option>
				<option value="PA">PA</option>
				<option value="RI">RI</option>
				<option value="SC">SC</option>
				<option value="SD">SD</option>
				<option value="TN">TN</option>
				<option value="TX">TX</option>
				<option value="UT">UT</option>
				<option value="VA">VA</option>
				<option value="VT">VT</option>
				<option value="WA">WA</option>
				<option value="WI">WI</option>
				<option value="WV">WV</option>
				<option value="WY">WY</option>
				<option value="AA">AA</option>
				<option value="AE">AE</option>
				<option value="AP">AP</option>
				<option value="AS">AS</option>
				<option value="FM">FM</option>
				<option value="GU">GU</option>
				<option value="MH">MH</option>
				<option value="MP">MP</option>
				<option value="PR">PR</option>
				<option value="PW">PW</option>
				<option value="VI">VI</option>
			</select>		
    </td>
</tr>


<tr>
    <td valign="middle" align="left" class="lab1">Postal Code:</td>
    
    <td  valign="top" align="left"><input type="text"  maxlength="10" value="<?php //echo $last_name ;?>" id="zip" name="zip" class="ntext">(5 or 9 digits)</td>
</tr>

<tr>
    <td valign="middle" align="left" class="lab1">Country:</td>
    
    <td  valign="top" align="left">United States(only supports USD at this time)</td>
</tr>


<tr>
    <td valign="middle" align="left" class="lab1">Amount:</td>
    
    <td  valign="top" align="left">
    
    <?php 
	
	if($task_id!=0 && $task_id>0 && $task_comment_id!=0 && $task_comment_id>0)
		{ ?>
        <?php echo $amt ;?>
          <input type="hidden"  maxlength="7" value="<?php echo $amt ;?>" id="amount" name="amount" class="" size="10"> 
		<?php } else { ?>
        <input type="text"  maxlength="7" value="<?php echo $amt ;?>" id="amount" name="amount" class="" size="10"> 
        <?php } ?>
        USD</td>
</tr>


	

	
	<tr>
		<td></td>
        <td align="left"><input type="Submit" class="submbg2" value="Submit"></td>
	</tr>
</table>
</form>
<script language="javascript">
	generateCC();
</script>
				 
				

                
</div>                

            


                


            
            
         
  </div>      
                
                
		</div>
        
        <?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
		
        
        
    </div>
</div>

