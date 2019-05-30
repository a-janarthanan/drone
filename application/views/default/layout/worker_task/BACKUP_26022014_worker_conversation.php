<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/lib/tooltip2.js"></script>

<div>
	<div>
	<div class="page-title mbot20">
		<h1 class="mleft15">Conversation</h1>
	</div>
    	<div class="mconleft" style="margin:0 0 0 15px;">



<?php

if($error!='') { ?>

<div id="error"><ul><?php echo $error; ?></ul>
</div>
<?php } ?>


       <?php 
	   
	   $category_image=base_url().'upload/category/no_image.png';

		
		if($task_detail->category_image!='') {  
		
			if(file_exists(base_path().'upload/category/'.$task_detail->category_image)) { 
				
				$category_image=base_url().'upload/category/'.$task_detail->category_image;
			
			}
			
		}
		
		$data['category_image']=$category_image;
		
		
	   		$is_accept = 0;
      		$task_detail = $this->task_model->get_task_detail($task_id); 
	   		$is_close = $task_detail->task_activity_status;
	
	
	
	  if($task_detail->user_id)
			{
				 $check_user_detail=$this->user_model->get_user_profile_by_id($task_detail->user_id);
					
					if($check_user_detail) { 
					?>
                    
                           
<div id="s1postJ" class="padB10">Conversation with: <?php echo anchor('user/'.$check_user_detail->profile_name,ucfirst($check_user_detail->first_name).' '.ucfirst(substr($check_user_detail->last_name,0,1)),' style="color:black" ');?></div>
                    
                    <?php
					}
			}
	   ?>
       
       
       

 
<span class="fr chbglab2" >Offer Price: <b>
	<?php 
	    //$worker_id =
        $offfer_amount = $this->user_task_model->offer_price($user_worker_id, $task_id);
        echo $site_setting->currency_symbol.$offfer_amount->offer_amount;
    ?></b></span>
<div class="clear"></div>



<ul class="padli10">
                <li>
                    <div class="addtl"><img src="<?php echo base_url().getThemeName();?>/images/per.jpg" width="50" height="50" alt="" /></div>
                    <div class="addtr" >
                        <h2 class="col"><?php echo ucfirst($task_detail->task_name);?></h2>
                        <span>posted in <?php echo ucfirst($task_detail->city_name); ?></span>
                    </div>
                    <div class="clear"></div>
                </li>
                
               <li>
                    <h3 id="detail-bg1">Details</h3>
            
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
            
                    <div class="marL30 marTB10">If unassigned, Task will expire on: <b> <span class="geo"><?php	
                             
                             echo date('M d',strtotime(date("Y-m-d", strtotime($task_detail->task_post_date)) . " +".$task_detail->task_start_day."days")).',&nbsp;';	
                            
                            echo date('h A',mktime(0,$task_detail->task_start_time,0,0,0,0));	
                            ?></span>
                            
                            </b><br/> Task should be completed by: <b><span class="geo"><?php	
                                 echo date('M d',strtotime(date("Y-m-d", strtotime($task_detail->task_post_date)) . " +".$task_detail->task_end_day."days")).',&nbsp;';		
                            echo date('h A',mktime(0,$task_detail->task_end_time,0,0,0,0));	
                            ?>
                   </span> </b></div>
            
                    <div id="refresbg" >This Task
                        <?php if($task_detail->task_repeat==1) { ?>
                           <b> repeats every <?php echo $task_detail->task_repeat_week; ?> weeks</b>
                        <?php } else { ?>
                           <b>does not repeat</b>
                        <?php } ?>
                     </div>
            
                </li>
                
                <li>
                    <h4 class="fs13">Description:</h4>
                    <p class="LH18">
                        <?php 
                            $task_description= $task_detail->task_description;		
                            $task_description=str_replace('KSYDOU','"',$task_description);
                            echo $task_description=str_replace('KSYSING',"'",$task_description);
                         ?>
                    </p>
                </li>
                
				 <?php  if($task_detail->user_id == get_authenticateUserID() && $task_detail->more_details != '') { ?>
                 <li>
                    <p><b>Private Notes : </b><?php echo $task_detail->more_details; ?></p>
                </li>
                <?php  } else {				 
                     if($task_detail->task_worker_id != 0 && $task_detail->task_worker_id != '' && $task_detail->more_details != '') { 
                ?> 
                <li>
                    <p><b>Private Notes : </b><?php echo $task_detail->more_details; ?></p>
                </li>

                <?php } } if($task_detail->extra_cost>0) { ?> 
                <li>
                     <p><b>Extra Cost : </b> less than <?php echo $site_setting->currency_symbol.$task_detail->extra_cost;?></p>
                     <p><b>Extra Cost Description : </b><?php echo $task_detail->extra_cost_description; ?></p>
                </li>
                 
                <?php } if($task_detail->other_cost>0) { ?> 
                <li>
                    <p><b>Other Cost : </b>less than <?php echo $site_setting->currency_symbol.$task_detail->other_cost;?></p>
                    <p><b>Other Cost Description : </b><?php echo $task_detail->other_cost_description; ?></p>
                </li>
                
                <?php } ?>
                
                
                   <li>The Runner will need to spend to: <b><?php echo $site_setting->currency_symbol.number_format($task_detail->extra_cost+$task_detail->other_cost,2); ?></b></li>
                <li>How much are you willing to pay for this Task? <b><?php echo $site_setting->currency_symbol.$task_detail->task_to_price.' - '.$site_setting->currency_symbol.$task_detail->task_price; ?></b></li>
                
                <li><br /><br /></li>
                
                <li>
                    <div class="fl">
                       
                            <?php 
                                if($task_location)
                                {
                                  ?>
                                
                                 <h4 class="fs13">Location:</h4>
                                 
                                 <?php   foreach($task_location as $loc) 
                                    {
                                      
									  $login_user_worker_id=0;
									  
									  
									  $get_worker_detail=$this->worker_model->check_user_worker_detail(get_authenticateUserID());
					
										if($get_worker_detail) 
										{ 		  
									  		  $login_user_worker_id=$get_worker_detail->worker_id;
									    }
                                        
										
										if($task_detail->task_activity_status>0 && $task_detail->task_worker_id==$login_user_worker_id)
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
                                        
                                       
									   
									   
									   
									    } else {
										
										
										 if($loc->user_location_id>0)
                                        {
                                            
                                            $get_user_location=$this->user_model->get_user_location_detail($loc->user_location_id);
                                            
                                            if($get_user_location) 
                                            {
                                                echo '<div class="fl" style="width:275px;">';
                                                
                                                $loc_full='';
                                                
                                               
                                                echo '<p>';
                                              
                                                
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
                                    
                                }
                            ?>     
                    </div>
                    <div class="clear"></div>
                </li>
                
             
            </ul>


   <div class="marTB20"><h3 id="detail-bg1">Conversations</h3></div>     

<ul class="padli10 marT10">
	<?php 
		foreach($result as $row) {
		
		
	
		
		
			$user_detail=$this->user_model->get_user_profile_by_id($row->comment_post_user_id);
				$user_image= base_url().'upload/no_image.png';
				 
				 if($user_detail->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$user_detail->profile_image;
						
					}
					
				}
				
				
				
	?>
        <li class="posrel">
            <div rel="tooltip2" class="tpp" title="<?php echo $user_detail->full_name.'('.date($site_setting->date_time_format,strtotime($row->comment_date)).')';?>">
                <div class="abc">
                   <?php echo anchor('user/'.$user_detail->profile_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />',' class="fpass fs13"');?>
                </div>
               <?php 
			  	if($row->comment_post_user_id != get_authenticateUserID()) 
				{ 
					$conbg =  'conbg1';
				} else {
					$conbg =  'conbg2';
				}
			  ?>
                <div class="<?php echo $conbg;?>">
                    <?php /*if($row->is_final == 0) {  ?> <p class="marT10">this msg is related to <?php echo $task_detail->task_name; ?></p><?php }*/ ?>
                    <?php if($row->is_accept == 1) { $is_accept = 1 ;} ?>
                        <p class="LH18 marT5"><?php echo $row->task_comment;?></p>
                </div>
                <div class="clear"></div>
            </div>
        </li>
    <?php } ?>
        	            
</ul>            


<?php
	$dispute = $this->dispute_model->check_dispute_task($task_id);
$dispute_status=0;
if($dispute)
{
	$dispute_status=1;
}


	
	if($is_close != 3 && $dispute_status!=1) {
	
	
	$attributes = array('name'=>'frm_new_comment','class'=>'fdesign');
	echo form_open('worker_task/conversation/'.$worker_id.'/'.$task_id,$attributes);
?>  
    <ul class="padli10">
    	<li>
            <div class="abc">
            <?php
			
			$userinfo=$this->user_model->get_user_info(get_authenticateUserID());
			
			$user_detail=$this->user_model->get_user_profile_by_id(get_authenticateUserID());
				$user_image= base_url().'upload/no_image.png';
				 
				 if($user_detail->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$user_detail->profile_image;
						
					}
					
				}
				
				?>
             <?php echo anchor('user/'.$userinfo->profile_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />',' class="fpass fs13"');?>
            </div>
            
            <div class="conbg3">
              <textarea name="comment" cols="63" rows="5"></textarea>
              <?php 
			  						
					$post_user_id =  $worker_user_id;
					$task_user = $task_user_id;
				
			  ?>
               
              <input type="hidden" id="worker_id" name="worker_id" class="chbg fl" value="<?php echo $user_worker_id;?>">
              <input type="hidden" id="task_id" name="task_id" class="chbg fl" value="<?php echo $task_id;?>">
              <input type="hidden" id="post_user_id" name="post_user_id" class="chbg fl" value="<?php echo $post_user_id;?>">
              <input type="hidden" id="task_user" name="task_user" class="chbg fl" value="<?php echo $task_user;?>">
                <div class="marT10">
               <?php if($task_user_id == get_authenticateUserID()) {
			   	if($is_accept != 1) { ?>
                    <input type="submit" id="accept" name="accept" class="chbg fl" value="Accept Offer">
               <?php } } 
			   
			   
			   
			   		$assign_time_pay_amount=0;
					$assign_pay_status=0;
				
					$payable_amount=0;
					
					$check_amount_pay=check_task_assign_amount_pay($task_user_id,$task_id);
					
					if($check_amount_pay)
					{
						$assign_pay_status=1;
						$assign_time_pay_amount=$check_amount_pay->task_amount;
					}
					else
					{
						$payable_amount=0;
					}
					
					
					
					
			   
			   	if($task_detail->task_activity_status!=2 && $task_detail->task_activity_status!=3 && $task_detail->task_activity_status==1 && $task_user_id != get_authenticateUserID() && $assign_pay_status==1 && $assign_time_pay_amount>0) { ?>
				
				<input type="submit" id="complete" name="complete" class="chbg fl marR5" value="Complete Task">
				
                
                 <input type="button" id="complete" name="complete" class="chbg fl" value="Dispute Task" onclick="window.location.href='<?php echo site_url('dispute/dispute_task/'.$task_id) ?>'">
                 
				
			<?php 	}
			   
			   ?>
                    <input type="submit" id="send" name="send" class="chbg fr" value="Send">
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>
		</li>
     </ul>

</form>
<?php } ?>
    
           
     

		</div>


 <?php //echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
 
 <?php echo $this->load->view($theme.'/layout/user_task/worker_offer_side_bar.php',$data); ?>
   <div class="clear"></div>     
</div>
</div>

           
          	
