<script type="text/javascript">
jQuery(document).ready(function() {	
	
	jQuery("#learnmore").fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});
	
  
});

</script>
<div>
	<div>
	<div class="page-title mbot20">
		<h1 class="mleft15">Set up your credit card</h1>
	</div>
<?php
$site_setting=site_setting();
$data['site_setting']=$site_setting;

  ?>
<?php
	$attributes = array('name'=>'frmCardInfo','id'=>'frmCardInfo');
	echo form_open('stored_card/',$attributes);
?>

    	<div class="mconleft" style="margin:0 0 0 15px;">

      <?php    if($error != '' && $error=='fail') { ?>     
<div class="errmsgcl"> 
	<div class="follfi">There were problems with the following fields:</div>
	<?php echo $error; ?>
</div>
<?php } if($error=='update') {  ?>
        
        
        <div class="errmsgcl"> 
	<div class="follfi">Credit Card Information Added Successfully.</div>
</div>   
           
      <?php } ?>
      
           
          
<div class="tabs2">
             

            <div class="borrdercol">
            	<h1 id="bilt">Your Billing Information</h1>
            <h3 class="crec fs14" style="clear: both;">Credit card <span id="req" class="crec1" >We store your credit card to make posting Tasks easier. <a href="#learnmoreinfo" id="learnmore">Learn more</a></span> </h3>
			
						
						
<div style="display: none;">
		<div id="learnmoreinfo" style="width:500px;height:140px;overflow:auto;">
        <div class="clear"></div>
			<div class="fl padTB3 marL5"><h2>Why we need your credit card</h2></div>
			
            
        
            <div class="clear"></div>


 <ol class="ordlist fs11 LH18">
	<li>We verify your identity using a credit card to protect our <?php echo $site_setting->site_name; ?> against mischievous <?php echo $site_setting->site_name; ?> users. Our background-checked <?php echo $site_setting->site_name; ?> trust us to ensure Tasks are legal and are requested by "neighborly" people.</li>
    <li>The credit card also ensures <?php echo $site_setting->site_name; ?> are paid back any expenses incurred beyond your redeemed credits.</li>
 </ol>
		</div>
	</div>
    
    
<div class="wrap4"></div>             
                
                
            <table width="100%" border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td><h4 class="fs13">First name</h4></td>
                <td><h4 class="fs13">Last name</h4></td>
              </tr>
              <tr>
                <td><input name="card_first_name" id="card_first_name" type="text" class="ntext" value="<?php echo $card_first_name;?>" /></td>
                <td><input name="card_last_name" id="card_last_name" type="text"  class="ntext" value="<?php echo $card_last_name;?>"  /></td>
              </tr>

              <tr>
                <td><h4 class="fs13">Card number</h4></td>
                <td><h4 class="fs13">Card type <span class="marL57">Expiration Date</span></h4></td>
              </tr>
              <tr>
                <td><input name="cardnumber" id="cardnumber" type="text" value="<?php echo $cardnumber; ?>" class="ntext"  size="19" maxlength="19"  /></td>
                <td>
                    <select name="cardtype" id="cardtype" class="wid120 fs11"  onChange="javascript:generateCC(); return false;">
						<option value='Visa' <?php if($cardtype=='Visa') { ?> selected <?php } ?>>Visa</option>
                        <option value='MasterCard'  <?php if($cardtype=='MasterCard') { ?> selected <?php } ?>>MasterCard</option>
                        <option value='Discover'  <?php if($cardtype=='Discover') { ?> selected <?php } ?>>Discover</option>
                        <option value='Amex'  <?php if($cardtype=='Amex') { ?> selected <?php } ?>>American Express</option>
                    </select>
                    
                    <select name="card_expiration_month" id="card_expiration_month" class="fs11">
						<option value="1" <?php if($card_expiration_month==1) { ?> selected <?php } ?>>1</option>
						<option value="2"  <?php if($card_expiration_month==2) { ?> selected <?php } ?>>2</option>
						<option value="3"  <?php if($card_expiration_month==3) { ?> selected <?php } ?>>3</option>
						<option value="4"  <?php if($card_expiration_month==4) { ?> selected <?php } ?>>4</option>
						<option value="5"  <?php if($card_expiration_month==5) { ?> selected <?php } ?>>5</option>
						<option value="6"  <?php if($card_expiration_month==6) { ?> selected <?php } ?>>6</option>
						<option value="7"  <?php if($card_expiration_month==7) { ?> selected <?php } ?>>7</option>
						<option value="8"  <?php if($card_expiration_month==8) { ?> selected <?php } ?>>8</option>
						<option value="9"  <?php if($card_expiration_month==9) { ?> selected <?php } ?>>9</option>
						<option value="10"  <?php if($card_expiration_month==10) { ?> selected <?php } ?>>10</option>
						<option value="11"  <?php if($card_expiration_month==11) { ?> selected <?php } ?>>11</option>
						<option value="12"  <?php if($card_expiration_month==12) { ?> selected <?php } ?>>12</option>
                    </select>
                    
                    <select name="card_expiration_year" id="card_expiration_year" class="fs11">
						<?php for($i=date('Y');$i<=date('Y')+7;$i++) 
						{ ?>
                                              
                        <option value="<?php echo $i;?>" <?php if($card_expiration_year==$i) { ?> selected <?php } ?>><?php echo $i;?></option>
						<?php } ?>
                    </select>
				</td>
              </tr>

            </table>
 
			<h3 class="crec fs14">Billing address <span id="req" class="crec1" >Required for credit card verification.</span> </h3>


<table width="100%" border="0" cellspacing="1" cellpadding="1">
<?php if($user_location) { ?>

  
  <?php foreach($user_location as $location) { ?>
  <tr>
    <td width="20"><input type="radio" name="user_location_id" value="<?php echo $location->user_location_id; ?>" id="user_location_id" <?php if(($location->is_home==1) || $user_location_id==$location->user_location_id ) { ?>checked="checked" <?php } ?>/></td>
                <td><label><?php echo ucfirst($location->location_name);?></label></td>
               </tr>
                <tr>
                <td>&nbsp;</td>
                <td><span>(<?php if($location->location_address!='') { echo $location->location_address.','; }

   if($location->location_city!='') { echo $location->location_city.','; }
   
    if($location->location_state!='') { echo $location->location_state.','; }
	
	 if($location->location_zipcode!='') { echo $location->location_zipcode; }
   
   ?>)</span></td>                
  </tr>
 
 
 
 <?php } ?>

<?php } ?>

 <tr><td colspan="2" height="10">&nbsp;</td></tr>
 
 
 	<tr><td><input type="radio" name="user_location_id" id="user_location_id" value="other" <?php if($user_location_id=='other' || $card_address!='') {  ?> checked <?php } else { if(!$user_location) {  ?> checked <?php } } ?> /></td>
                <td><label>Fill out form</label></td>
                </tr>
                
                
</table>



<table width="100%" border="0" cellspacing="1" cellpadding="3">



  <tr>
    <td><h4 class="fs13">Address</h4></td>
    <td></td>
    <td></td>
   </tr>
  <tr>
    <td><input name="card_address" id="card_address" type="text"  class="ntext" value="<?php echo $card_address; ?>"  /></td>
    <td></td>
    <td></td>
   </tr>
   
  <tr>
    <td><h4 class="fs13">City</h4></td>
    <td><h4 class="fs13">State</h4></td>
    <td><h4 class="fs13">Postal Code</h4></td>
   </tr>
  <tr>
    <td><input name="card_city"  id="card_city" type="text"  class="ntext" value="<?php echo $card_city; ?>" /></td>
    <td><input name="card_state" id="card_state" type="text"   size="15" value="<?php echo $card_state;?>" /></td>
    <td><input name="card_zipcode" id="card_zipcode" type="text"  size="15"  value="<?php echo $card_zipcode; ?>" /></td>
   </tr>
   
   <?php if($card_verify_status==0 || $card_verify_status=='') { ?>
    <tr>
  
 
    <td align="left" valign="top" colspan="3"><h4><input name="save_location" type="checkbox" value="1" id="save_location"  <?php if($save_location==1) { ?> checked <?php } ?>/> Save this location</h4></td>
  </tr>
  <?php  } ?>
   
</table>   
<div class="clear"></div> <br>
<?php if($card_verify_status==0 || $card_verify_status=='') { ?>

 <input type="submit" value="Store" class="submbg2 fl" name="sub_step2">
 <?php } ?>
              <div class="clear"></div>     
            </div>
              	
            
			
             
   
              






			</div>                
		</div>
         <?php 
		
		 echo $this->load->view($theme.'/layout/user/user_sidebar',$data); ?>  
        <div class="clear"></div>

</form>

    </div>
</div>



</section>