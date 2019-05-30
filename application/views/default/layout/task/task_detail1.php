<?php  
$site_setting=site_setting(); 
$data['site_setting']=$site_setting;
?>


<link type="text/css" rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/js/css/innerpage-slider.css" />


<div class="main">
<div class="incon">
<div class="details-title-ph">
<div class="user-image">
 <?php
						
						$user_detail=$this->user_model->get_user_profile_by_id($task_detail->user_id);
				$user_image= base_url().'upload/no_image.png';
				 
				 if($user_detail->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$user_detail->profile_image;
						
					}
					
				} 
						 
						 
						  echo anchor('user/'.$task_user_detail->profile_name,'<img src="'.$user_image.'" width="72" height="72" alt="" style="border-radius:5px;"/>'); ?>
</div>
<div class="details-title">
<p class="option-title"><?php echo ucfirst($task_detail->task_name);?></p>
<p class="post-info">Posted <?php echo getDuration($task_detail->task_post_date,$task_id); ?> year ago by <?php echo anchor('user/'.$task_user_detail->profile_name,ucfirst($task_user_detail->first_name).' '.ucfirst(substr($task_user_detail->last_name,0,1)).'.',' class="fpass" ');?></p>
</div>
</div>
<div class="fleftfw">
    	<div class="insideleft">


<?php if($msg!='') { 
	
			if($msg=='no') { 
?>
<div id="error"><ul><p>You have not sufficient amount to assign task to a Worker bee.</p></ul></div>
<script type="text/javascript"> 
   jQuery(document).ready(function() { 
    jQuery("#autostart").fancybox({'overlayShow':true,frameWidth: 
838,frameHeight:540}).trigger('click'); 
  }); 
</script> 

<a id="autostart" href="<?php echo site_url('task/add_amount/'.$task_id.'/'.$task_comment_id);?>"></a> 




<?php } if($msg=='assign') { ?>

<div id="success"><ul><p>Task has been assigned to a Worker bee successfully..</p></ul></div>

<?php } if($msg=='fail') { ?>

<div id="error"><ul><p>Transaction process failed please try again.</p></ul></div>
<?php } if($msg=='remove') { ?>

<div id="success"><ul><p>Offer has been removed successfully.</p></ul></div>
<?php }  if($msg=='fail_remove') { ?>

<div id="error"><ul><p>Unable to remove your offer, please try again.</p></ul></div>
<?php }  if($msg=='offer_update') { ?>

<div id="success"><ul><p>Offer has been updated successfully.</p></ul></div>
<?php }  if($msg=='fail_update') { ?>

<div id="error"><ul><p>Unable to update your offer, please try again.</p></ul></div>
<?php } } ?>


				<!--<div class="marB30">
                    <div class="imgleft">
                         <?php
						
						$user_detail=$this->user_model->get_user_profile_by_id($task_detail->user_id);
				$user_image= base_url().'upload/no_image.png';
				 
				 if($user_detail->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$user_detail->profile_image;
						
					}
					
				} 
						 
						 
						  echo anchor('user/'.$task_user_detail->profile_name,'<img src="'.$user_image.'" width="72" height="72" alt="" style="border-radius:5px;"/>'); ?>
                    </div>
                    <div class="imgright">
                        <div id="s1post"><?php echo ucfirst($task_detail->task_name);?></div>
                        <span class="days">posted <?php echo getDuration($task_detail->task_post_date,$task_id); ?> by 
                         <?php echo anchor('user/'.$task_user_detail->profile_name,ucfirst($task_user_detail->first_name).' '.ucfirst(substr($task_user_detail->last_name,0,1)).'.',' class="fpass" ');?>
                         </span>
						
                        
                        <div class="clear"></div>


						

<?php   if(check_user_authentication()) { 
			  
			  		$check_worker_detail=$this->worker_model->check_user_worker_detail(get_authenticateUserID());
					
					if($check_worker_detail) { 
                 
				 	if(get_authenticateUserID() != $task_detail->user_id) { 
					
				
				
				
				  
				  
					
		 
		 				$get_worker_bid=$this->task_model->get_worker_bid_on_task($task_id);
						
						if($get_worker_bid)
						{
												
						}	 					
                  		else {
						
						 if($task_detail->task_activity_status==0) {
						 
							 echo anchor('task/offer_task/'.$task_id,'<b>Do It Now</b>',' id="offer_task" class="cm chbg" ');
					
						  }
					  
					  
                    }
					
					
					 if($task_detail->task_activity_status==0) {
					 
										 
					  echo anchor('task/ask_question/'.$task_id,'<b>Ask Question</b>',' id="askquestion" class="cm login marR5" ');
					 
					 } 
					
                    ?>
                      <script type="text/javascript">
								jQuery(document).ready(function() {	
									jQuery("#offer_task").fancybox();	
									jQuery("#askquestion").fancybox();	
									
								});
						</script>
                        
                        
                    <?php } } }  
					
				
				
			/*	if(get_authenticateUserID() == $task_detail->user_id && $task_detail->task_activity_status==0 ) { 
				
				  echo anchor('task/post_message/'.$task_id,'<b>Post Message</b>',' id="postmessage" class="cm login marR5" ');
				  
				  ?>
                  
                  <script type="text/javascript">
								jQuery(document).ready(function() {	
									jQuery("#postmessage").fancybox();										
								});
						</script>
                        
					  
					<?php }  */ ?>  
                    
                    
						 
                         
                    </div>
                    <div class="clear"></div>
                </div>-->

        
        


				
                <h3 class="section-title">Detail</h3>
                
                
                <ul class="details">
                    <li><label class="blue-label mtop10">City : </label><span class="value mtopleft10"><?php echo ucfirst($task_detail->city_name); ?></span></li>
                    
                    <li><label class="blue-label mtop20">Description:</label>
                    <p class="value mtop10"><?php  
					
					$task_description= $task_detail->task_description;		
					$task_description=str_replace('KSYDOU','"',$task_description);
					 $task_description=str_replace('KSYSING',"'",$task_description);				
				echo 	ucfirst($task_description);?></p>
                    
                    <!-- <b>Can be done:</b> Online or by phone-->
					</li>  
                </ul>
                
                
                <?php if($additional_information) { ?>
                <div class="marLR10">
                    <h4 class="fs13">Additional Information:</h4><br />

                    <span id="need">
                    <?php 
						foreach($additional_information as $information) { 
							echo '<span class="daysago">Post Date : '.date($site_setting->date_format,strtotime($information->post_date)).'</span><br />';
							
					$information= $information->information;		
					$information=str_replace('KSYDOU','"',$information);
					 $information=str_replace('KSYSING',"'",$information);				
				echo 	ucfirst($information);
				
				echo '<br /><br />';
						}
					?>
                    </span><br><br>
                </div>

				<?php } ?>

            
                

        


				<!--<div class="marB20">
                <h3 id="detail-bg1">Multimedia Attachments</h3>
                <div class="multiimg">
                    <a href="#"><img width="100" height="100" alt="" src="<?php echo base_url().getThemeName(); ?>/images/dash_r2.png"></a>
                    <a href="#"><img width="100" height="100" alt="" src="<?php echo base_url().getThemeName(); ?>/images/dash_r3.png"></a>
                    <a href="#"><img width="100" height="100" alt="" src="<?php echo base_url().getThemeName(); ?>/images/dash_r1.png"></a>
                </div>                
                </div>-->

             
           <?php 
		   
		   $data['comments']=$comments;
		   $login_worker_id=0;
		    $check_worker_detail=$this->worker_model->check_user_worker_detail(get_authenticateUserID());
			
			if($check_worker_detail) {  $login_worker_id=$check_worker_detail->worker_id; }
			
		  // if($task_detail->task_is_private==0 || $task_detail->user_id==get_authenticateUserID() || $task_detail->task_worker_id==$login_worker_id) {  
		   
		   
		   		   if($task_detail->task_is_private==0) {  
		   
		   				if($comments) { ?>    


                <h3 class="section-title">Conversations</h3>
                <ul class="listing mbot20 scrolling">
				<?php 
				$i= 0;
					foreach($comments as $comment) {  $i++;
					
					
				$user_detail=$this->user_model->get_user_profile_by_id($comment->comment_post_user_id);
				$user_image= base_url().'upload/no_image.png';
				 
				 if($user_detail->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$user_detail->profile_image;
						
					}
					
				}
				
				
				
				?>                
                
                
                
                
                
                
                   
                 <li>
                
                <div>
                <div class="imageph">
                
                <?php echo anchor('user/'.$user_detail->profile_name,'<img src="'.$user_image.'" alt="" width="68" height="69"/>');?>
                <?php $check_worker_detail=$this->worker_model->check_user_worker_detail($comment->comment_post_user_id);
                
                
                
                
                
                if($check_worker_detail) {
                ?>
                
                <a rel="tooltip" id="twoone2br" title="Level <?php echo $check_worker_detail->worker_level;?> Worker bee"><?php echo $check_worker_detail->worker_level;?></a>
                
                <?php } ?>
                
                
                
                
                </div>
                
                <div class="message-part">
               <p class="user-name"><?php echo anchor('user/'.$comment->profile_name,'<b>'.ucfirst($comment->first_name).'</b> '.ucfirst(substr($comment->last_name,0,1)),' class="col fs14 unl"'); ?></p>
                
                <p class="item-price"><?php echo $comment->task_comment;?></p>
                <p class="small-grey"><?php echo getDuration($comment->comment_date,$task_id); ?></p>
               
                </div>
                
               <div class="fl marT_10" >
                
                
                <?php
                
                $reply_already=0;
                
                
                $check_already_reply=$this->task_model->check_public_message_reply($comment->task_comment_id);
                
                if($check_already_reply)
                {
                $reply_already=1;
                }
                
                
                if(get_authenticateUserID() == $task_detail->user_id && $task_detail->task_activity_status==0 && $reply_already==0) {
                
                echo anchor('task/post_message/'.$task_id.'/'.$comment->task_comment_id,'Reply',' id="postmessage_'.$comment->task_comment_id.'" class="chbg2" ');
                
                ?>
                
                <script type="text/javascript">
                jQuery(document).ready(function() {
                jQuery("#postmessage_<?php echo $comment->task_comment_id; ?>").fancybox();
                });
                </script>
                
                
                <?php } ?>
                
                
                
                </div>
                <div class="clear"></div>
                
                
                <?php if($reply_already==1) {
                
                $get_reply=$this->task_model->get_owner_public_reply($task_id,$comment->task_comment_id);
                
                if($get_reply)
                {
                
                
                $reply_user_detail=$this->user_model->get_user_profile_by_id($get_reply->comment_post_user_id);
                $reply_user_image= base_url().'upload/no_image.png';
                
                if($reply_user_detail->profile_image!='') {
                
                if(file_exists(base_path().'upload/user/'.$reply_user_detail->profile_image)) {
                
                $reply_user_image=base_url().'upload/user/'.$reply_user_detail->profile_image;
                
                }
                
                }
                ?>
                
                
                <!-- ans s -->
                <div class="marT5">
                <div class="fl wid90 marL15">
                
                <?php echo anchor('user/'.$reply_user_detail->profile_name,'<img src="'.$reply_user_image.'" alt="" width="68" height="69"/>');?>
                <?php $check_worker_detail=$this->worker_model->check_user_worker_detail($get_reply->comment_post_user_id);
                
                
                
                
                
                if($check_worker_detail) {
                ?>
                
                <a rel="tooltip" id="twoone2br" title="Level <?php echo $check_worker_detail->worker_level;?> Worker bee"><?php echo $check_worker_detail->worker_level;?></a>
                
                <?php } ?>
                
                
                
                
                </div>
                
                <div class="fl wid450">
                <div style="margin-bottom:5px;" ><?php echo anchor('user/'.$get_reply->profile_name,'<b>'.ucfirst($get_reply->first_name).'</b> '.ucfirst(substr($get_reply->last_name,0,1)),' class="col fs14 unl"'); ?></div>
                
                <div style="font-size:1.25em; line-height:25px;">
                <p class="colmark"><?php echo $get_reply->task_comment;?></p>
                <p><?php echo getDuration($get_reply->comment_date,$task_id); ?></p>
                </div>
                </div>
                <div class="clear"></div>
                </div>
                
                
                <?php } } ?>
                </div>
				
                </li>


                    
                    
                    
                    
                
                
			<?php }   ?>
                
                </ul>                    
               
         <?php } } ?>
         
         
         
         
         
         <?php 
		   
		   $data['offers_on_task']=$offers_on_task;
		  
		  if(get_authenticateUserID() == $task_detail->user_id ) { 
		  
		   				if($offers_on_task) { ?>    

<div class="marB20">
                <h3 id="detail-bg1">Offers</h3>
                <ul class="ulsty2">
				<?php 
				$i= 0;
					foreach($offers_on_task as $offers) {  $i++;
					
					
					
						
				$user_image= base_url().'upload/no_image.png';
				 
				 if($offers->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$offers->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$offers->profile_image;
						
					}
					
				}
				
				
				
				?>                
                               
                
                <li>
                    <div class="abct3" style="width:100px;">
                      					   
					     <?php echo anchor('user/'.$offers->profile_name,'<img src="'.$user_image.'" alt="" width="68" height="69"/>', 'class="fpass fs13" ');?>
                    
                           <a rel="tooltip" id="twoone2br" title="Level <?php echo $offers->worker_level;?> Worker bee"><?php echo $offers->worker_level;?></a>

                </div>
                    
                    <div class="catle3n">
                      <?php echo anchor('user/'.$offers->profile_name,'<b>'.ucfirst($offers->first_name).'</b> '.ucfirst(substr($offers->last_name,0,1)),' class="fpass fs13"'); ?>
                      
                                      
                            <p class="colmark marT5" style="width:338px;"><?php echo $offers->task_comment;?></p>   
                    </div>
                    
                    
                                         
                                            <div class="catle3n2" style="width:196px;">
                            <ul class="ulnobor">
                                <li style="border-bottom:none;" class="LH16">
								
								
								
								
								
				            
          <p class="marB5"><b>Offer Amount : </b><span class="fpass fs14 colora"><?php echo $site_setting->currency_symbol.$offers->offer_amount; ?></span></p>
          
            
                        
						
								
								
								
								
							
                                <p><b>Offer On : </b><?php echo date($site_setting->date_time_format,strtotime($offers->comment_date)); ?></p>
                                                              
                                                                </li>
                                <div class="clear"></div>
                            
                              </ul>        
                            
                        </div>
                                        <div class="clear"></div>
            
            
            
            
                  <div class="marTB5">
        	<div class="fl wid100 marL100">
                            <p><?php echo getDuration($offers->comment_date,$task_id); ?></p>
                            
                     </div>	
                     
                         <div class="runlright">
            	<div class="alignright">
                
                 <?php 
					$worker_detail = $this->worker_model->check_user_worker_detail($offers->comment_post_user_id);
				?>
	        	
             <?php echo anchor('user_task/conversation/'.$worker_detail->worker_id.'/'.$task_id,'Conversation',' class="chbg" '); ?>       
	        	
             <?php if($task_detail->task_activity_status==0 ) { echo anchor('task/accept_offer/'.$task_id.'/'.$offers->task_comment_id,'Accpet Offer',' class="chbg2" '); }
			 
			 
			 if($task_detail->task_activity_status==1 && $task_detail->task_worker_id==$offers->worker_id) {
			 
			  echo anchor('user_task/complete/'.$task_id,'Complete Task',' class="chbg2 marR3" '); 
			 
			 
			 echo anchor('dispute/dispute_task/'.$task_id,'Dispute Task',' class="chbg" ');
			 
			 }
			 
			 
			 
			  ?>
                                          
                            </div>
                        </div>
                        <div class="clear"></div>    
                    </div>
                    <div class="clear"></div>
                    
                    
                </li>
                
                
			<?php }   ?>
            
            
            
                
                
                
                
                
                
                
                
                
                
                
                
                </ul>                    
                </div>
         <?php } 
		 
		 
		 } ?>
         
         
         
         
         
         
         
         
         
    
   <?php if($similar_tasks) { 
        
    ?>
                 

	<h3 id="detail-bg1">Tasks similar to this one</h3>



<ul class="listing mbot20 scrolling">

      
       
		<?php  foreach($similar_tasks as $task_info) { 
		
		
			$user_detail=$this->user_model->get_user_profile_by_id($task_info->user_id);
				$user_image= base_url().'upload/no_image.png';
				 
				 if($user_detail->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$user_detail->profile_image;
						
					}
					
				}
				
			
			$total_rate=get_user_total_rate($task_info->user_id);
		
		   ?>
		   <li>
		   <div class="imageph"><?php echo anchor('user/'.$task_info->profile_name,'<img src="'.$user_image.'" width="50" height="50" alt="" />'); ?></div>
           <div class="detailspart">
		   <p class="item-title"><?php echo anchor('tasks/'.$task_info->task_url_name,ucfirst($task_info->task_name),' class="fpass"');?></p>
		   <p class="item-price">Posted by <span class="item-cost"><?php echo '<b>'.ucfirst($task_info->first_name).' '.ucfirst(substr($task_info->last_name,0,1)).'.</b>'; ?></span> in <?php echo $task_info->city_name; ?></p>
		   <p class="item-short-des"><span class="item-cost"><?php echo $site_setting->currency_symbol.$task_info->task_price; ?></span> for Tasks of this type</p>
		   </div>
		   <div class="frightauto">
				<div><p class="ratings">Ratings</p> </div>
				<div class="str"><div class="str_sel" style="width:<?php if($total_rate>5) { ?>100<?php } else { echo round($total_rate*2);?>0<?php } ?>%;"></div></div>
				<?php  if(!check_user_authentication()) {  echo anchor('sign_up','Post similar task',' class="chbg"'); } else { echo anchor('task/update_task_step_zero/'.$task_info->task_id.'/copy','Post similar task','  class="chbg"  id="copy_'.$task_info->task_id.'"  ');}?>
				
		   </div>
		   </li>
		              
      
			      
   
                  
                    
				
                
<!--             
    <a href="#" id="ui-carousel-next-inner"><span>next</span></a>
    <a href="#" id="ui-carousel-prev-inner"><span>prev</span></a>
   
     
		


		<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/lib/innerpage-slider.js"></script>
		<script type="text/javascript">
			jQuery(function($) {
				$("#carousel-inner").rcarousel({
					visible: 2,
					step: 1,
					width: 250,
					height: 150,
					auto: {
						enabled: true,
						interval: 3000,
						direction: "next"
					}
				});
				
				$("#ui-carousel-next-inner")
					.add("#ui-carousel-prev-inner")
					.hover(
						function(){
							$(this).css("opacity",0.7);
						},
						function(){
							$(this).css("opacity",1.0);
						}
					);				
			});
		</script>
        
       
     
 slider e              
</div>        -->        

     <?php  }
	 
	 ?>
	 </ul>
	 <?php
	 
	 } ?>          
                
                
                
	
		
        <div class="clear"></div>



    
</div>
		<div class="insideright">
        <?php echo $this->load->view($theme.'/layout/task/task_detail_side_bar',$data); ?> 
		</div>


