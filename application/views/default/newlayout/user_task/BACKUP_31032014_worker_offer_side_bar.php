<div class="mconright">

<div class="estim marB5">Your Task So Far</div>
<div class="sofar LH18">
        
        	<div class="soleft" style="background:#FFFFFF;"><img src="<?php echo $category_image; ?>" alt="" width="48" height="40" /></div>
            
            <div class="soright">
            	<div id="lesf" ><a href="javascript:void()" class="col unl"><?php echo $task_detail->category_name; ?></a></div>
                <?php if($task_detail->task_repeat==1) { ?>
                This Task repeats every <?php echo $task_detail->task_repeat_week; ?> weeks
                <?php } else { ?>
                <div>This Task does not repeat</div>
                <?php } ?>
                
            </div>
            <div class="clear"></div>
            
            <div><b>Assignment: </b> <a href="javascript:void()" class="fpass">
            
           <?php if($task_detail->task_auto_assignment==2) { ?> 
           
           Let me review  </a> the <?php echo $site_setting->site_name;?>
           
            <?php } elseif($task_detail->task_auto_assignment==3) {?>
            
            <?php if($task_detail->task_assing_worker!='' && $task_detail->task_assing_worker>0) { $worker_detail=$this->worker_model->get_worker_info($task_detail->task_assing_worker);
				
				echo 'Notify '. ucfirst($worker_detail->first_name).' '.ucfirst($worker_detail->last_name); ?> </a> first
            
            <?php } else { ?>
            
             Auto-assign </a> the <?php echo $site_setting->site_name;?>
            
            
            <?php }  } else { ?>
            
             Auto-assign </a> the <?php echo $site_setting->site_name;?>
            
            <?php } ?>
            
            </div>
            
			
       	  <span class="int" >For <?php echo $site_setting->site_name;?> in <br/><?php echo ucfirst($task_detail->city_name); ?></span>
         
          <div class="clear"></div>
            
      </div>
      
      
      
      





<div class="estim marB5">Estimated Task Rececipt</div>
<div class="sofar">

<?php  if($task_detail->user_id == get_authenticateUserID()) { ?>
<?php $total_amount=0; ?>
<table width="100%" cellspacing="1" cellpadding="2" class="st2">
  <tr>
    <td><h4>Task Price :</h4></td>
    <td><h5>approx <?php echo $site_setting->currency_symbol.$task_detail->task_price;
	
	$total_amount= $total_amount + $task_detail->task_price;
	?></h5></td>
  </tr>
  <?php if($task_detail->extra_cost>0) { ?>
  <tr>
    <td><h4>Extra Cost</h4></td>
    <td><h5>approx <?php echo $site_setting->currency_symbol.$task_detail->extra_cost;
	
	$total_amount= $total_amount + $task_detail->extra_cost;
	
	?></h5></td>
  </tr>
  <?php } if($task_detail->other_cost>0) { ?>
   <tr>
    <td><h4>Other Cost</h4></td>
    <td><h5>approx <?php echo $site_setting->currency_symbol.$task_detail->other_cost;
	$total_amount= $total_amount + $task_detail->other_cost;
	?></h5></td>
  </tr>
  
  <?php }   
  $task_setting=task_setting();
  
   if($task_setting->task_post_fee>0) {
   ?>
  
   <tr>
    <td><h4>Task Posting Fees</h4></td>
    <td><h5><?php  
	
	
	 $task_site_fee=number_format((($task_setting->task_post_fee*$total_amount) / 100),2); 
	
	echo $site_setting->currency_symbol.$task_site_fee;
	
	
			 $total_amount=$total_amount+$task_site_fee;
			 
			 
	?></h5></td>
  </tr>
  
  <?php } ?>
  
  <tr><td colspan="2"><div class="rw"></div></td></tr>
  <tr>
    <td><h4>Total Estimate:</h4></td>
    <td><h5>approx <?php echo $site_setting->currency_symbol.number_format($total_amount,2);?></h5></td>
  </tr>
  <tr>
    <td colspan="2"><span id="req">You will not be charged until the Task is complete</span></td>
  </tr>
</table>

<?php } else { ?>


<table width="100%" cellspacing="1" cellpadding="2" class="st2">
  <tr>
    <td><h4>Task Price :</h4></td>
    <td><h5>approx <?php echo $site_setting->currency_symbol.$task_detail->task_to_price.' - '.$site_setting->currency_symbol.$task_detail->task_price;	?></h5></td>
  </tr>
 
  
</table>

<?php } ?>

</div>
<script type="application/javascript">
function deletechecked()
{
    var answer = confirm("Do you really want to cancel this task?")
    if (answer){
       
	   window.location.href='<?php echo site_url('user_task/cancel_task/'.$task_detail->task_id); ?>';
    }
    
    return false;  
} 

</script>
	<?php  if($task_detail->user_id == get_authenticateUserID()) { ?>
        <div class="estim marB5">Task Actions</div>
        <ul class="accr">
        	
            <?php if($task_detail->task_activity_status==0) { ?>
        
            <li><a href="javascript:void()" onclick="return deletechecked();">Cancel Task</a></li>
            
            <?php } ?>
            
           <?php  $chk_bid=0;
					  
					  		$chk_worker_bid=check_worker_bid_on_task($task_detail->task_id);
							
							if($chk_worker_bid)
							{
								$chk_bid=1;
							}
							
					  
					    if($task_detail->user_id == get_authenticateUserID() && $task_detail->task_activity_status==0 && $chk_bid==0) { ?>
                       <li><?php echo anchor('task/edit_task/'.$task_detail->task_id,'Edit Task'); ?></li>
                       
                       <?php } ?>
                       
                       <?php  if(get_authenticateUserID() == $task_detail->user_id)  { ?>
                    <li>
                      <?php   echo anchor('additional_information/information/'.$task_detail->task_id,'Additional Information'); ?>
                      </li>
                        <?php } ?>
          			 

           <!-- <li><a href="#">Upload a Photo</a></li>-->
          <!--  <li><a href="#">See history</a></li>-->
        </ul>
    <?php } ?>

<div class="estim marB5">Share with Friends:</div>
<h4 class="fs12">Think your friends might find this task funny... or even run it for you? Send them a link!</h4>

<ul class="s3ul marT5">
<!--<li><a href="#"><img width="40" height="20" alt="" src="<?php //echo base_url().getThemeName(); ?>/images/fb_sml.png"> </a></li>-->
<li class="marLR10"><a href="#"><img width="17" height="17" alt="" src="<?php echo base_url().getThemeName(); ?>/images/fb1.png"></a></li>
<li>Be the first of your friends to like this.</li>
<div class="clear"></div>
</ul>
<div class="clear"></div>
<a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/fb1.png" alt="" /></a>
<a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/sp.png" alt="" /></a>
<a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/msg.png" alt=""/></a>
<a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/ctc.png" alt="" /></a>
<a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/su.png" alt="" /></a>
<a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/digg.png" alt=""/></a>


</div>