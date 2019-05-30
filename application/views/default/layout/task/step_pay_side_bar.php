<div class="mconright">

    	<div class="inside-subtitle">Estimated Task Receipt </div>
<div id="right-panel-bg">
        <div class="sofar" style="float:left">
        <?php $total_amount=0; ?>
<table width="100%" cellspacing="1" cellpadding="2" class="st2" style="text-align:left;">
  <tr>
    <td><h4>Task Price :</h4></td>
    <td><h5>approx <?php echo $site_setting->currency_symbol.$task_detail->task_price;
	
	$total_amount= $total_amount + $task_detail->task_price;
	?></h5></td>
  </tr>
  <?php if($task_detail->extra_cost>0) { ?>
  <tr>
    <td><h4>Extra Cost :</h4></td>
    <td><h5>approx <?php echo $site_setting->currency_symbol.$task_detail->extra_cost;
	
	$total_amount= $total_amount + $task_detail->extra_cost;
	
	?></h5></td>
  </tr>
  <?php } if($task_detail->other_cost>0) { ?>
   <tr>
    <td><h4>Other Cost :</h4></td>
    <td><h5>approx <?php echo $site_setting->currency_symbol.$task_detail->other_cost;
	$total_amount= $total_amount + $task_detail->other_cost;
	?></h5></td>
  </tr>
  
  <?php } 
  
  
  $task_setting=task_setting();
  
   if($task_setting->task_post_fee>0) {
   ?>
  
   <tr>
    <td><h4>Task Posting Fees :</h4></td>
    <td><h5><?php  
	
	
	 $task_site_fee=number_format((($task_setting->task_post_fee*$total_amount) / 100),2); 
	
	echo $site_setting->currency_symbol.$task_site_fee;
	
	
			 $total_amount=$total_amount+$task_site_fee;
			 
			 
	?></h5></td>
  </tr>
  
  <?php } ?>
  
  <tr><td colspan="2"><div class="rw"></div></td></tr>
  <tr>
    <td><h4>Total Estimate :</h4></td>
    <td><h5>approx <?php echo $site_setting->currency_symbol.number_format($total_amount,2);?></h5></td>
  </tr>
 
  <tr>
    <td colspan="2" style="padding-top:20px; font-weight:bold; color:#585858;"><span id="req">Funds will not be released until task is complete</span></td>
  </tr>
</table>
        	
  
        </div>
		 </div>
   
		
      <?php /*?>  <h4>Got a promotion code?</h4> 
        <input name="" type="text" class="ntext" /><br/>
         <span id="req"><!--Invalid promotion code!--></span>
         <input type="button" value="Update" name="btn_update" class="submbg2" /><?php */?>
      
<?php
if(isset($_REQUEST['aa']))
{
	echo "yes";
}
?>


        

        
        </div>