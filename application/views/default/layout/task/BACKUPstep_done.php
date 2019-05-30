<script type="text/javascript">
jQuery(document).ready(function() {	
	
	jQuery("#learnmore").fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});
	
  
});

</script>
<div class="main">
<div class="incon">
<?php
$site_setting=site_setting();
 $data['task_detail']=$task_detail;
  $data['site_setting']=$site_setting;

?>
<?php
	$attributes = array('name'=>'frm_pay_task');
	echo form_open('task/pay/'.$task_id,$attributes);
?>

    	<div class="mconleft">


<center>
           <img src="<?php echo base_url().getThemeName(); ?>/images/3n.png" alt=""  />
</center>           
           <div id="s1post">Done</div>
        
<div class="tabs2 marB15">
            
             <h2 class="colora">Thanks your Task has been posted.</h2><br />
             <div class="fs15">
You can view your task here : <?php echo anchor('tasks/'.$task_detail->task_url_name,ucfirst($task_detail->task_name),'class="fpass"');?>.
        </div>
        
        <?php
        
		$site_setting=site_setting();
        $task_setting=task_setting();
		
		$total=0;
		
		if($task_detail->extra_cost>0) {
		
		$total=$total+$task_detail->extra_cost;
		
		}
		
		
		
	
	 
		 $total=$total+$task_detail->task_price;
		 
		 
		 
		 if($task_setting->task_post_fee>0) {
		 
		 $task_site_fee=number_format((($task_setting->task_post_fee*$total) / 100),2); 
	
			 $total=$total+$task_site_fee;
	
		}
		 
		 
		 $total=number_format($total,2);
		 
		 $wallet_amount=my_wallet_amount();
		
	
		
		if($total>$wallet_amount)
		{
			?>
            <br>

            <p><span class="colora"><b>NOTE :</b></span> There is no sufficient balance in your wallet, Please deposit atleast <b class="colora"><?php echo $site_setting->currency_symbol.$total;?></b> in your wallet before you assign your task.</p>
            
          <?php 
		}
        
        ?>
                     
            </div>
              	
            
             
   
              
<div class="borrdercol marT10">
 	<div class="addtl">
    <?php
	
	
		$user_detail=$this->user_model->get_user_profile_by_id($task_detail->user_id);
	
	 $user_image= base_url().'upload/no_image.png';
						 
		 if($user_detail->profile_image!='') {  
	
			if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
		
				$user_image=base_url().'upload/user/'.$user_detail->profile_image;
				
			}
			
		}
		
		
		?>
    	<img src="<?php echo $user_image; ?>" width="50" height="50" alt="" />
    </div>
 	<div class="addtr" >
    	
        <h2 class="col"><?php echo ucfirst($task_detail->task_name);?></h2>
        <span>posted by <?php echo anchor('user/'.getUserProfileName(),$user_info->first_name.' '.substr($user_info->last_name,0,1),'class="fpass"');?> for Runner in <?php echo ucfirst($task_detail->city_name); ?></span>
    </div>
   
	<div class="clear"></div>  
    
    
  <h3 class="crec"><span  id="iconbg">Details</span></h3>    
 	<div class="marL15" >
  		<div id="icard"><b>
        
        
        <?php if($task_detail->task_auto_assignment==2) { ?> 
           
           Let me review the Runner
           
            <?php } elseif($task_detail->task_auto_assignment==3) {?>
            
            <?php $worker_detail=$this->worker_model->get_worker_info($task_detail->task_assing_worker);
				
				echo 'We will Notify '. ucfirst($worker_detail->first_name).' '.ucfirst($worker_detail->last_name); ?> first
            
            <?php } else { ?>
            
             We will Auto-assign the Task Runner who makes the best offer on your Task
            
            <?php } ?>
            
            
        
        
        
         </b></div>
    
  		<div id="dat1" class="marTB5">If unassigned, Task will expire on: <b>
        
      
         <?php	
		 
		 echo date('M d',strtotime(date("Y-m-d", strtotime($task_detail->task_post_date)) . " +".$task_detail->task_start_day."days")).',&nbsp;';	
		
		echo date('h A',mktime(0,$task_detail->task_start_time,0,0,0,0));	
		?>
        
        
        </b><br/> Task should be completed by: <b>
        
        <?php	
			 echo date('M d',strtotime(date("Y-m-d", strtotime($task_detail->task_post_date)) . " +".$task_detail->task_end_day."days")).',&nbsp;';		
		echo date('h A',mktime(0,$task_detail->task_end_time,0,0,0,0));	
		?>
        
        
        
        </b></div>

  		<div id="refresbg" >This Task 
        
          <?php if($task_detail->task_repeat==1) { ?>
               <b> repeats every <?php echo $task_detail->task_repeat_week; ?> weeks</b>
                <?php } else { ?>
               <b>does not repeat</b>
                <?php } ?>
                
                
                
        </div>
    </div>  
    <div class="marTB5">
        <h4>Description:</h4>
        <p><?php  
		
		$task_description= $task_detail->task_description;		
		$task_description=str_replace('KSYDOU','"',$task_description);
		 $task_description=str_replace('KSYSING',"'",$task_description);
		
		echo $task_description;
		 ?></p>
    </div> 
  
<br />

    <div class="marTB5">
    	
                      
            <h4>Location:</h4><br />

            
            <?php 
			if($task_location)
			{
				foreach($task_location as $loc) 
				{
					
					
					
					if($loc->user_location_id>0)
					{
						
						$get_user_location=$this->user_model->get_user_location_detail($loc->user_location_id);
						
						if($get_user_location) 
						{
							echo '<div class="fl" style="width:275px;">';
							
							$loc_full='';
							
							echo '<p>';
							if($get_user_location->location_name!='') { echo $get_user_location->location_name; }
							echo '</p>';
							
							echo '<p>';
							if($get_user_location->location_address!='') { $loc_full.=$get_user_location->location_address.','; }
	
						  // if($get_user_location->location_city!='') { $loc_full.=$get_user_location->location_city.','; }
						   
							//if($get_user_location->location_state!='') { $loc_full.=$get_user_location->location_state.','; }
							
							 if($get_user_location->location_zipcode!='') { $loc_full.=$get_user_location->location_zipcode; }
							 
							 echo $loc_full.'</p><p>&nbsp;</p>';
							
							echo '</div>';
							
							 echo '<div class="fr">
        
       

        
         <iframe width="350" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?key='.GOOGLE_MAP_KEY.'&output=embed&q='.urlencode(utf8_encode($loc_full)).'"></iframe>';     
         
        	  
        echo '<br />      
        </div>
        <div class="clear"></div>';
		
							
						}
						
						
					}
					else
					{
						
						echo '<div class="fl" style="width:275px;">';
							
						$loc_full='';
							
						echo '<p>';
						if($loc->location_name!='') { echo $loc->location_name; }
						echo '</p>';
						
						echo '<p>';
						if($loc->location_address!='') { $loc_full.=$loc->location_address.','; }

					  // if($loc->location_city!='') { $loc_full.=$loc->location_city.','; }
					   
						//if($loc->location_state!='') { $loc_full.=$loc->location_state.','; }
						
						 if($loc->location_zip!='') { $loc_full.=$loc->location_zip; }
						 
						 echo $loc_full.'</p><p>&nbsp;</p>';
						 
						 echo '</div>';
							
							 echo '<div class="fr">
        
       

        
         <iframe width="350" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?key='.GOOGLE_MAP_KEY.'&output=embed&q='.urlencode(utf8_encode($loc_full)).'"></iframe>';     
         
        	  
        echo '<br />      
        </div>
        <div class="clear"></div>';
		
		
						 
					}
					
					
					
				
				}
				
			}
			?>
            
           
            
            
            
            
            
            
            
      
      
    </div> 
    
</div>





			</div>                
		</div>
         <?php 
		
		 echo $this->load->view($theme.'/layout/task/step_pay_side_bar',$data); ?>  
        <div class="clear"></div>

</form>

    </div>
</div>



</section>