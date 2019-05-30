<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
<div>
		
        
        
      <div class="red-subtitle top-red-subtitle" style="margin:0px 0 0 0">Pay</div>
    	<div class="profile_back">
        <div class="container">
        <div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
        <div class="home-signpost-content home-signpost-content-new-section"> 
    	<div class="dbleft dbleft-main">
        
           <?php
		
		if($error!='') { 
		?>
        
        <div id="error"><ul style="font-size:16px;"><?php echo $error; ?></ul></div>
        
        <?php }   ?>
		
		 
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td class="inside-subtitle" id="s1postJ">Payable amount details</td>
    <td align="right">
    </td>
  </tr>
</table>

<div class="borrdercol">
		
     <?php
		
		$attributes = array('name'=>'frmpaynowtask');
	echo form_open('user_task/pay_now/'.$task_id,$attributes);
		
		
		
		
		 $site_setting=site_setting(); 
		
		$task_setting=task_setting();
		
		$total=0;
		
		
		?>
   
 
 
 <table width="100%" cellspacing="4" cellpadding="4" border="0" style="font-size:14px; color:#585858;">

<tbody><tr>
<td width="30%"  align="left" valign="middle" class="">Job Name</td>
<td width="70%"  align="left" valign="top"><?php echo ucfirst($task_detail->task_name); ?></td>
</tr>

<tr>
<td valign="middle" align="left" class="">Assign To</td>
<td valign="top" align="left"><?php $worker = $this->worker_model->get_worker_info($task_detail->task_worker_id);

echo anchor('user/'.$worker->profile_name,$worker->first_name.' '.substr($worker->last_name,0,1),'class="fpass"'); 


 ?></td>
</tr>


</tbody>

</table>
 
 
 
 
 
<div id="detail-bg1" class="inside-subtitle">Payable amount details</div>

<table width="100%" cellspacing="4" cellpadding="4" border="0" style="font-size:14px; color:#585858;">
<tbody>
<tr>
    <td width="30%" valign="middle" align="left" class="">Job Amount(<?php echo $site_setting->currency_symbol;?>)</td>
    
    <td width="70%" valign="top" align="left"><?php echo $task_detail->task_to_price.' - '.$task_detail->task_price;  ?><br />
</td>
</tr>
<tr><td colspan="2" style="border-bottom:1px dotted #585858; height:1px;"></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>


<?php if($task_detail->extra_cost>0) { ?>
<tr>
    <td width="30%" valign="middle" align="left" class="">Extra Amount(<?php echo $site_setting->currency_symbol;?>)</td>
    
    <td width="70%" valign="top" align="left"><?php echo $task_detail->extra_cost; $total=$total+$task_detail->extra_cost;  ?></td>
</tr>
<?php } ?>


<tr>
    <td width="30%" valign="middle" align="left" class="">Final Job Amount(<?php echo $site_setting->currency_symbol;?>)</td>
    
    <td width="70%" valign="top" align="left"><?php 
	
	 //echo $task_detail->task_worker_id.'======='.$task_detail->task_id;
     $price = $this->user_task_model->offer_price($task_detail->task_worker_id,$task_detail->task_id); 
	 
	
    echo $price->offer_amount;  $total=$total+$price->offer_amount; ?></td>
</tr>


<?php if($task_setting->task_post_fee>0) { 


?>

<tr>
    <td width="30%" valign="middle" align="left" class="">Site Fees(<?php echo $site_setting->currency_symbol;?>)</td>
    
    <td width="70%" valign="top" align="left"><?php $task_site_fee=number_format((($task_setting->task_post_fee*$total) / 100),2); 
	
	echo $task_site_fee;    
    $ntot=number_format($total,2,'.','');
    $sfee=str_replace(',', '', $task_site_fee);
    $total=$ntot+$sfee;
	  ?></td>
</tr>


<?php } ?> 


<tr><td colspan="2" style="border-bottom:1px dotted #585858; height:1px;"></td></tr>


<tr>
    <td width="30%" valign="middle" align="left" class="">Total Amount(<?php echo $site_setting->currency_symbol;?>)</td>
    
    <td width="70%" valign="top" align="left"><?php echo number_format($total,2);  ?></td>
</tr>


<tr>
    <td width="30%" valign="middle" align="left" class="">Amount in Wallet(<?php echo $site_setting->currency_symbol;?>)</td>
    
    <td width="70%" valign="top" align="left"><?php echo $wallet_amount=my_wallet_amount();  ?></td>
</tr>

<tr><td colspan="2" style="border-bottom:1px dotted #585858; height:1px;"></td></tr>
 

<tr>
    <td width="30%" valign="middle" align="left" class="">After Pay Amount in Wallet(<?php echo $site_setting->currency_symbol;?>)</td>
    <?php 

    $bidamout=number_format($total,2,'.','');
    $leftamount=number_format(($wallet_amount-$bidamout),2);?>
    <td width="70%" valign="top" align="left"><?php echo  $leftamount; ?></td>
</tr>
<tr><td colspan="2"></td></tr>
<tr><td colspan="2"></td></tr>

<tr>
<td>&nbsp;</td>
<td>
<input type="hidden" name="task_id" id="task_id" value="<?php echo $task_id; ?>" />
<?php //if($leftamount>0) { ?>
<input type="submit" name="pay" id="pay" value="Pay" class="btn btn-default" style="font-weight:bold;"  />
<?php echo anchor('user_task/open_tasks','Cancel','class="btn btn-default" style="padding: 7px 12px; font-weight:bold; margin-left:5px;"'); ?>
<?php //} else {  
//echo anchor('wallet/add_wallet','Pay','class="btn btn-default"');
 //} ?>
</td>
</tr>


<tr><td colspan="2"><span class="colora"><b>NOTE :</b></span> You have to pay the task amount to assign job , But do not worrythis amount will be held in escrow until job is finished by Helper.</td></tr>

</tbody>
</table>




</form>
        









			</div>

</div><!--left-->
</div>
<div class="dbright-task dbright-task-main">
 <?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
</div>
        <div class="clear"></div>
</div>
<div class="clear"></div>
</div>

