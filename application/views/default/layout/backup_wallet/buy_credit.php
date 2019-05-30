<script type="text/javascript">
function change_div_method(str)
{
	if(str=='bank')
	{
		document.getElementById('bank_div').style.display='block';
		document.getElementById('check_div').style.display='none';
		document.getElementById('gateway_div').style.display='none';
	}
	if(str=='check')
	{
		document.getElementById('check_div').style.display='block';
		document.getElementById('bank_div').style.display='none';
		document.getElementById('gateway_div').style.display='none';
	}
	if(str=='gateway')
	{
		document.getElementById('gateway_div').style.display='block';
		document.getElementById('bank_div').style.display='none';
		document.getElementById('check_div').style.display='none';
	}
	
}
function frm_withdarw()
{
  alert("hi");
  if(document.frm_withdrawwallet.bank_name.value=="")
  {
    alert("Please enter your bank name");
    return false;
  }
  if(document.frm_withdrawwallet.bank_account_holder_name.value=="")
  {
    alert("Please enter your account holder name");
    return false;
  }
  if(document.frm_withdrawwallet.bank_account_number.value=="")
  {
    alert("Please enter your bank account number");
    return false;
  }
  if(document.frm_withdrawwallet.bank_branch.value=="")
  {
    alert("Please enter your bank branch name");
    return false;
  }
  if(document.frm_withdrawwallet.bank_ifsc_code.value=="")
  {
    alert("Please enter your bank branch code");
    return false;
  }
}
</script>
<?php
$this->load->library('session');
if($this->uri->segment(3, 0)==$this->session->userdata('packid') || $this->uri->segment(3, 0)==0) 
{
    $packidnew=$this->session->userdata('packid');
}
else
{
    $packidnew=$this->uri->segment(3, 0);
}
$packsecid = $this->session->set_userdata(array('packid'=> $packidnew));
$packid =$this->session->userdata('packid');
$price=$this->wallet_model->getNameTable("trc_membership","price","id",$packid);
$bid=$this->wallet_model->getNameTable("trc_membership","numbid","id",$packid);
?>
<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->

<div>
	<div>
	
    	 <div class="red-subtitle top-red-subtitle" >Buy Credits</div>
    	<div class="profile_back">
        <div class="container">
        <div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
        <div class="home-signpost-content home-signpost-content-new-section"> 
    	<div class="dbleft dbleft-main">

<?php if($error!='') { ?> 
    <div id="error" class="marTB10"><?php echo $error; ?></div><?php } ?>


                         


<div class="borrdercol">
		
			                        


<div class="responsive_table">

<table width="100%" cellspacing="4" cellpadding="4" border="0" >
<tbody>
<tr>
    <td width="25%" valign="middle" align="left" class="lab1 lab1-1" style="font-size:17px !important;">Price</td>
    
    <td width="80%" valign="top" align="left"><input style="background:#e7e7e7; width:25%;" type="text" value="<?php echo $price; ?>" id="amount" name="amount" class="form-control form-control-1 ntext-val-15" readonly="readonly"></td>
</tr>
<tr>
    <td width="25%" valign="middle" align="left" class="lab1 lab1-1" style="font-size:17px !important;">Number of Bid</td>
    
    <td width="80%" valign="top" align="left"><input style="background:#e7e7e7; width:25%;" type="text" value="<?php echo $bid; ?>" id="amount" name="amount" class="form-control form-control-1 ntext-val-15" readonly="readonly"></td>
</tr>
<tr>
	<td colspan="2" style="height:5px;"></td>
</tr>

<tr>
    <td valign="top" align="left"  class="lab1" style="font-size:17px !important;">Payment Method </td>
    <td valign="top" align="left"> 	
    <p class="fs15">
      <label style="font-size:15px;">
        	<input type="radio" name="withdraw_method" onclick="change_div_method(this.value)" value="bank"  <?php if($withdraw_method=='bank') { ?> checked="checked" <?php } ?> id="withdraw_method" /> 
            <img src="<?php echo base_url().getThemeName()?>/images/bank_icon.png" class="credit_icon1" style="vertical-align:middle; padding: 0 0 0 5px;">
            
            <br />
        	<div style="padding-top:10px;"></div>
            <input type="radio" name="strip" value="online" onclick = "document.location.href='<?php echo base_url() ?>wallet/paypalpay/<?php echo $packid?>'">
            <img src="<?php echo base_url().getThemeName()?>/images/paypal-logo.png" class="credit_icon" style="vertical-align:middle; padding: 0 0 0 5px;" width="200" height="100">
      </label>
    </p>
	</td>
	</tr>        
</tbody>
</table>
</div>
<div class="clear"></div>
<div style="display: <?php if($withdraw_method=='bank') { echo "block"; } else { echo "none"; } ?>;" id="bank_div">

<div id="detail-bg1" class="title2 inside-subtitle">Bank Detail</div>
<div class="clear"></div>
<?php
      $attributes = array('name'=>'frm_buycredit','id'=>'frm_buycredit','class'=>'form_design');
      echo form_open_multipart('wallet/buy_credit',$attributes);       
?>
<table width="100%" cellspacing="4" cellpadding="4" border="0">
<tr><td><table width="50%">
<tbody>
  <input type="hidden" name="withdraw_method" value="bank">
  <input type="hidden" name="amount" value="<?php echo $price; ?>">
  <input type="hidden" name="packid" value="<?php echo $packid; ?>">
<tr>
<td valign="middle" align="left" class="lab1 lab1-1">Payment Methdo<span id="star-six">*</span></td>

<td valign="top" align="left">
  <select name="bank_account_holder_name">
    <option value="">Select One</option>
    <option value="Direct Deposit">Direct Deposit</option>
    <option value="Online Transfer">Online Transfer</option>
    <option value="ATM Transfer">ATM Transfer</option>
  </select>
  </td>
</tr>
<tr>
<td width="20%" valign="middle" align="left" class="lab1 lab1-1">Name of Depositor</td>

<td width="80%" valign="top" align="left"><input type="text" value="<?php echo $bank_name; ?>" id="bank_name" name="bank_name" class="form-control form-control-1 ntext-val-15"><span id="star-six">*</span></td>
</tr>

<tr>
<td valign="middle" align="left" class="lab1 lab1-1">Slip No/Transaction ID:</td>

<td valign="top" align="left"><input type="text" value="<?php echo $bank_account_number; ?>" id="bank_account_number" name="bank_account_number" class="form-control form-control-1 ntext-val-15"><span id="star-six">*</span></td>
</tr>
<tr>
<td valign="middle" align="left" class="lab1 lab1-1">Mobile Number</td>

<td valign="top" align="left"><input type="text" value="<?php echo $bank_branch; ?>" id="bank_branch" name="bank_branch" class="form-control form-control-1 ntext-val-15"><span id="star-six">*</span></td>
</tr>

<tr>
<td valign="middle" align="left" class="lab1 lab1-1">Email</td>

<td valign="top" align="left"><input type="text" value="<?php echo $bank_ifsc_code; ?>" id="bank_ifsc_code" name="bank_ifsc_code" class="form-control form-control-1 ntext-val-15"><span id="star-six">*</span></td>
</tr>
<tr>
<td valign="middle" align="left" class="lab1 lab1-1">Upload slip image</td>

<td valign="top" align="left"><input type="file" id="bank_slip" name="bank_slip" ></td>
</tr>
<tr>
<td valign="middle" align="left" class="lab1 lab1-1"></td>
<td valign="middle" align="left">
<input type="checkbox" name="accept_terms_checkbox" value="1" id="accept_terms_checkbox" checked="true">
<span class="">I agree the Terms and Condition</span>
</td>

</tr>
<tr><td><input type="submit" name="sub" value="Submit" class="btn btn-default btn-default-join btn-app bye-btn"></td></tr>
</table></td>
<td>
  <table><tr><td><img src="<?php echo base_url().getThemeName()?>/images/bank.png" class="credit_icon" style="vertical-align:middle; padding: 0 0 0 5px;" width="300" height="300"></td></tr></table>
</td>
</tr>

</tbody></table>

</div>
<div class="clear"></div>

<div style="display: <?php if($withdraw_method=='check') { echo "block"; } else { echo "none"; } ?>;" id="check_div">
<div  id="detail-bg1" class="title2 inside-subtitle">Check Bank Detail</div>
<div class="clear"></div>

<table width="100%" cellspacing="4" cellpadding="4" border="0">

<tbody>

<tr>
<td width="20%" align="left" valign="middle" class="lab1 lab1-1">Bank Name</td>

<td width="80%" align="left" valign="top"><input type="text" value="<?php echo $check_name; ?>" id="check_name" name="check_name" class="ntext ntext-val ntext-val-15"></td>
</tr>


<tr>
<td valign="middle" align="left" class="lab1 lab1-1">Account Holder Name</td>

<td valign="top" align="left"><input type="text" value="<?php echo $check_account_holder_name; ?>" id="check_account_holder_name" name="check_account_holder_name" class="ntext ntext-val ntext-val-15"></td>
</tr>


<tr>
<td valign="middle" align="left" class="lab1 lab1-1">Bank Account Number</td>

<td valign="top" align="left"><input type="text" value="<?php echo $check_account_number; ?>" id="check_account_number" name="check_account_number" class="ntext ntext-val ntext-val-15"></td>
</tr>


<tr> 
<td valign="middle" align="left" class="lab1 lab1-1">Bank Branch</td>

<td valign="top" align="left"><input type="text" value="<?php echo $check_branch; ?>" id="check_branch" name="check_branch" class="ntext ntext-val ntext-val-15"></td>
</tr>



<tr>
<td valign="middle" align="left" class="lab1 lab1-1">Bank IFSC Code</td>

<td valign="top" align="left"><input type="text" value="<?php echo $check_unique_id; ?>" id="check_unique_id" name="check_unique_id" class="ntext ntext-val ntext-val-15"></td>
</tr>


<tr>
<td valign="middle" align="left" class="lab1 lab1-1">Bank Address</td>

<td valign="top" align="left"><input type="text" value="<?php echo $check_address; ?>" id="check_address" name="check_address" class="ntext ntext-val ntext-val-15"></td>
</tr>

<tr>
<td valign="middle" align="left" class="lab1 lab1-1">Bank City</td>

<td valign="top" align="left"><input type="text" value="<?php echo $check_city; ?>" id="check_city" name="check_city" class="ntext ntext-val ntext-val-15"></td>
</tr>


<tr>
<td valign="middle" align="left" class="lab1 lab1-1">Bank State</td>

<td valign="top" align="left"><input type="text" value="<?php echo $check_state; ?>" id="check_state" name="check_state" class="ntext ntext-val ntext-val-15"></td>
</tr>


<tr>
<td valign="middle" align="left" class="lab1 lab1-1">Bank Country</td>

<td valign="top" align="left"><input type="text" value="<?php echo $check_country; ?>" id="check_country" name="check_country" class="ntext ntext-val ntext-val-15"></td>
</tr>


<tr>
<td valign="middle" align="left" class="lab1 lab1-1">Bank Postal Code</td>

<td valign="top" align="left"><input type="text" value="<?php echo $check_zipcode; ?>" id="check_zipcode" name="check_zipcode" class="ntext ntext-val ntext-val-15"></td>
</tr>

</tbody></table>
</div>

<div class="clear"></div>


<div style="display: <?php if($withdraw_method=='gateway') { echo "block"; } else { echo "none"; } ?>;" id="gateway_div">
<div id="detail-bg1" class="title2 inside-subtitle">Paypal Detail</div>
<div class="clear"></div>
<table width="100%" cellspacing="4" cellpadding="4" border="0">

<tbody><tr>
<td width="20%"  align="left" valign="middle" class="lab1 lab1-1">Paypal Email</td>

<td width="80%"  align="left" valign="top"><input type="text" value="<?php echo $gateway_name; ?>" id="gateway_name" name="gateway_name" class="ntext ntext-val ntext-val-15"></td>
</tr>


<!--<tr>
<td valign="middle" align="left" class="lab1 lab1-1">Gateway Account</td>

<td valign="top" align="left"><input type="text" value="<?php echo $gateway_account; ?>" id="gateway_account" name="gateway_account" class="form-control form-control-1"></td>
</tr>



<tr>
<td valign="middle" align="left" class="lab1 lab1-1">Gateway City</td>

<td valign="top" align="left"><input type="text" value="<?php echo $gateway_city; ?>" id="gateway_city" name="gateway_city" class="form-control form-control-1"></td>
</tr>


<tr> 
<td valign="middle" align="left" class="lab1 lab1-1">Gateway State</td>

<td valign="top" align="left"><input type="text" value="<?php echo $gateway_state; ?>" id="gateway_state" name="gateway_state" class="form-control form-control-1"></td>
</tr>


<tr>
<td valign="middle" align="left" class="lab1 lab1-1">Gateway Country</td>

<td valign="top" align="left"><input type="text" value="<?php echo $gateway_country; ?>" id="gateway_country" name="gateway_country" class="form-control form-control-1"></td>
</tr>


<tr>
<td valign="middle" align="left" class="lab1 lab1-1">Gateway Postal Code</td>

<td valign="top" align="left"><input type="text" value="<?php echo $gateway_zip; ?>" id="gateway_zip" name="gateway_zip" class="form-control form-control-1"></td>
</tr>-->

</tbody></table>

</div>
	
<div class="clear"></div>


<table width="100%" cellspacing="4" cellpadding="4" border="0">
<tbody>
<tr>
    <td width="20%">
<input type="hidden" name="withdraw_id" id="withdraw_id" value="<?php echo $withdraw_id; ?>" /></td>
    
    <td width="80%" valign="top" align="left"><!--*Required--></td>
</tr>
</tbody>
</table>

<!--<div style="text-align:center; clear:both; overflow:hidden; width:360px;" class="width_wallet">
<div style="margin:0px 0 40px 0;"><input type="submit" value="Bye Now" class="btn btn-default btn-default-join btn-app" name="sub_detail"></div>
</div>-->


</form>
 
	
			</div>
	</div><!--left-->
    </div>
   	<div class="dbright-task dbright-task-main" >
     <?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
     </div>
    
</div>
</div>
		<div class="clear"></div>
</div>       			