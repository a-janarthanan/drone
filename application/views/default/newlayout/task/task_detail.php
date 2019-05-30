<?php  
$site_setting=site_setting(); 
$data['site_setting']=$site_setting;
?>


<link type="text/css" rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/js/css/innerpage-slider.css" />
<style>
#askquestion{ margin-left:9px;}
</style>
<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div class="red-subtitle top-red-subtitle" >Detaljer om uppdraget</div>
<div>

<div class="profile_back">
<div class="container">
<div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
	<div class="home-signpost-content">
    	<div class="dbleft dbleft-main">


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


				<div class="">
                    <ul class="taskname">
                    <!--<li class="photo">
                         <?php
						
						$user_detail=$this->user_model->get_user_profile_by_id($task_detail->user_id);
				$user_image= base_url().'upload/no_image.png';
				 
				 if($user_detail->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$user_detail->profile_image;
						
					}
					
				} 
						 
						 
						  echo anchor('user/'.$task_user_detail->profile_name,'<img src="'.$user_image.'" width="72" height="72" alt="" style="border-radius:5px;"/>'); ?>
                    </li>-->
                    <li class="taskn fl urgent_task urgent_task-detail" >
                        <div class="imgright imgright-12">
                            <div id="s1post"><h2 class="taskname" style="margin-bottom:0px; font-size:26px;"><?php echo ucfirst($task_detail->task_name);?></h2></div>
                            <span class="days">Av 
                             <?php echo anchor('user/'.$task_user_detail->profile_name,ucfirst($task_user_detail->first_name).' '.ucfirst(substr($task_user_detail->last_name,0,1)).'.',' class="fpass" ');?>
                             </span>
                            <div class="clear"></div>
                              
                        </div>
                        <div class="<?php if($task_detail->done_online==1) echo "online_class";?>"></div>
                        <div class="<?php if($task_detail->task_urgent==1) echo "Urgent_class";?>"></div>
                        <div class="urgent-price urgent-price-detail">
                            <b>Projekt Budget (SEK)</b> <br />
                            <?php echo $site_setting->currency_symbol.$task_detail->task_to_price.' - '.$site_setting->currency_symbol.$task_detail->task_price; ?>
                        </div>
                        <div class="clear"></div>
                        <div  style="float:right; margin-top:10px;">
                            <?php 
							  if(check_user_authentication()) { 
                                          
                                                $check_worker_detail=$this->worker_model->check_user_worker_detail(get_authenticateUserID());
                                                
                                                if($check_worker_detail) { 
                                             
                                                if(get_authenticateUserID() != $task_detail->user_id) { 
                                                
                                            
                                            
                                            
                                              
                                              
                                                
                                     
                                                    $get_worker_bid=$this->task_model->get_worker_bid_on_task($task_id);
                                                    
                                                    if($get_worker_bid)
                                                    {
                                                                            
                                                    }	 					
                                                    else {
                                                    
                                                     if($task_detail->task_activity_status==0) {

                                                        if($site_setting->subscription_need==1)
                                                        {
                                                            $user_setting=user_profilestatus(get_authenticateUserID());
                                                            if($user_setting->profile_active==1)
                                                            {
                                                                echo anchor('task/offer_task/'.$task_id,'<b>Lägg bud</b>',' id="offer_task" class="btn btn-default" ');
                                                                
                                                            }
                                                            else
                                                            {
                                                    ?>
                                                    		<a href="<?php echo base_url(); ?>dashboard#horizontalTab3" onclick="return confirm('Sorry !!! In order to place your offer , you must subscribe for membership')" class="btn btn-default pupload14"><b>Lägg bud</b></a>
                                                            
                                
                                                       <?php
                                                            }
                                                        }
                                                        else
                                                        {
                                                            echo anchor('task/offer_task/'.$task_id,'<b>Lägg bud</b>',' id="offer_task" class="btn btn-default" ');
                                                                
                                                        }

                                                        echo "<span style='padding-left:5px;'>  </span>"; 
                                                        

                                                      }
                                                  
                                                  
                                                }
                                                 if($task_detail->task_activity_status==0) {
                                                
                                                                      
                                                  echo anchor('task/ask_question/'.$task_id,'<b>Ställ en fråga</b>',' id="askquestion" class="btn btn-default marR5" ');
                                                 
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
                    </li>
                    </ul>
                    <div class="clear"></div>
                </div>

        
        


				<div class="marB20">
                <div class="inside-subtitle">Sammanfattning</div>

                
                <div>
                    <div class="fleft100"> <label class="city city-main" style="width:5%">Plats :</label><span id="need" style="font-weight:normal;"><?php echo ucfirst($task_detail->city_name); ?></span></div>
                    <br>       
                  
                </div>
                
                <div class="fleft100 mtop30">
                <div class="inside-subtitle">Beskrivning</div>
                   <p class=""><?php  
					
					$task_description= $task_detail->task_description;		
					$task_description=str_replace('KSYDOU','"',$task_description);
					 $task_description=str_replace('KSYSING',"'",$task_description);				
				echo 	ucfirst($task_description);?></p>
                    
                    <!-- <b>Can be done:</b> Online or by phone-->
                </div> 
                <?php if($task_detail->task_work_doc!="") { ?>
                <div class="fleft100 mtop30">
	                <div class="inside-subtitle">Attachment</div>
                    <p><a href="<?php echo base_url();?>upload/task_doc/<?php echo $task_detail->task_work_doc ?>" download="<?php echo $task_detail->task_work_doc ?>"> Download file</a></p> 
                	<br><br>
                </div>
                <?php } ?>
                
                <?php if($additional_information) { ?>
                <div class="fleft100 mtop30">
                	<div class="inside-subtitle">Additional Information</div>
                     <p class="text-mtop10">
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
                    </p><br><br>
                </div>

				<?php } ?>

            
                </div>

        


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

<div class="marB20">
<br />
                <div class="inside-subtitle">Conversations</div>
                <ul class="ulsty2">
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
                
                
                
                
                
                
                   
                <li class="posrel posrel-45">
                <div class="papers">
                <div class="taskphoto taskphoto-2">
					<?php echo anchor('user/'.$user_detail->profile_name,'<img src="'.$user_image.'" alt="" width="60" height="60" class="round-corner" />');?>
                    <?php $check_worker_detail=$this->worker_model->check_user_worker_detail($comment->comment_post_user_id);
                    if($check_worker_detail) {
                    ?>
                    <a class="tooltip tooltip-2" id="twoonebr1">Level <?php echo $check_worker_detail->worker_level;?><span>Level <?php echo $check_worker_detail->worker_level;?> Worker bee</span></a>            
                    <?php } ?>
                </div>
                
                <div class="taskdetails">
                <div ><?php echo anchor('user/'.$comment->profile_name,'<b>'.ucfirst($comment->first_name).'</b> '.ucfirst(substr($comment->last_name,0,1)),' class="abmarks abmarks-2 unl"'); ?></div>
                <div>
                <p class="colmark colmark-2"><?php echo $comment->task_comment;?></p>
                <p class="geo geo-2"><?php echo getDuration($comment->comment_date,$task_id); ?></p>
                </div>
                </div>
                
               <div class="fl" style="margin-top:7px; overflow:hidden;" >
                
                
                <?php
                
                $reply_already=0;
                
                
                $check_already_reply=$this->task_model->check_public_message_reply($comment->task_comment_id);
                
                if($check_already_reply)
                {
                $reply_already=1;
                }
                
                
                if(get_authenticateUserID() == $task_detail->user_id && $task_detail->task_activity_status==0 && $reply_already==0) {
                
                echo anchor('task/post_message/'.$task_id.'/'.$comment->task_comment_id,'Reply',' id="postmessage_'.$comment->task_comment_id.'" class="btn btn-default" ');
                
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
                <div class="posrel posrel-1">
                <div class="taskphoto taskphoto-2">
                
                <?php echo anchor('user/'.$reply_user_detail->profile_name,'<img src="'.$reply_user_image.'" alt="" width="60" height="60" class="round-corner" />');?>
                <?php $check_worker_detail=$this->worker_model->check_user_worker_detail($get_reply->comment_post_user_id);
                if($check_worker_detail) {
                ?>
                <a class="tooltip tooltip-2" id="twoonebr1">Level <?php echo $check_worker_detail->worker_level;?><span>Level <?php echo $check_worker_detail->worker_level;?> Worker bee</span></a>
                <?php } ?>
                
                
                
                
                </div>
                
                <div class="taskdetails">
                <div ><?php echo anchor('user/'.$get_reply->profile_name,'<b>'.ucfirst($get_reply->first_name).'</b> '.ucfirst(substr($get_reply->last_name,0,1)),' class="abmarks abmarks-2 unl"'); ?></div>
                
                <div>
                <p class="colmark colmark-2"><?php echo $get_reply->task_comment;?></p>
                <p class="geo geo-2"><?php echo getDuration($get_reply->comment_date,$task_id); ?></p>
                </div>
                </div>
                <div class="clear"></div>
                </div>
                
                
                <?php } } ?>
                </div>
                <div class="bot_paper"></div>
                
                </li>


                    
                    
                    
                    
                
                
			<?php }   ?>
                
                </ul>                    
                </div>
         <?php } } ?>
         
         
         
         
         
         <?php 
		   
		   $data['offers_on_task']=$offers_on_task;
		  
		  if(get_authenticateUserID() == $task_detail->user_id ) { 
		  
		   				if($offers_on_task) { ?>    

<div class="marB20">
                <div class="inside-subtitle">Lagda bud</div>
                <!--<ul class="ulsty2">
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
                               
                
                <li class="posrel">
                    <div class="taskphoto taskphoto-2">
                      					   
					     <?php echo anchor('user/'.$offers->profile_name,'<img src="'.$user_image.'" alt="" width="60" height="60" class="round-corner"  /> ');?>
                    
                           <a class="tooltip tooltip-2" id="twoonebr1">Level <?php echo $offers->worker_level;?><span>Level <?php echo $offers->worker_level;?> Worker bee</span></a>

                	</div>
                    
                    <div class="taskdetails taskdetails-15">
                    	<div class="fl taskdetails-15-15">
                      		<?php echo anchor('user/'.$offers->profile_name,ucfirst($offers->first_name).' '.ucfirst(substr($offers->last_name,0,1)),' class="abmarks abmarks-2 unl"'); ?>
                      		<p class="colmark colmark-2" style="width:338px;"><?php echo $offers->task_comment;?></p>
                            <p class="geo geo-2"><?php echo getDuration($offers->comment_date,$task_id); ?></p>   
                        </div>
                        <div class="catle3n2 fr" style="width:196px; color:#585858;">
                            <ul class="ulnobor">
                                <li style="border-bottom:none;" class="LH16">
                                    <p class="marB5 fs14"><b>Offer Amount : </b><span class="fpass fs14 colora"><?php echo $site_setting->currency_symbol.$offers->offer_amount; ?></span></p>
                                    <p class="fs14"><b>Offer On : </b><?php echo date($site_setting->date_time_format,strtotime($offers->comment_date)); ?></p>
                                </li>
                                <div class="clear"></div>
                              </ul>        
                        </div>
                    </div>
                   		
                                        <div class="clear"></div>
            
            
            
            
                  <div class="marTB5">
        		
                     
                         <div class="runlright runlright-1" style="width: 58%;">
            	<div class="alignright" >
                
                 <?php 
					$worker_detail = $this->worker_model->check_user_worker_detail($offers->comment_post_user_id);
				?>
	        	
             <?php echo anchor('user_task/conversation/'.$worker_detail->worker_id.'/'.$task_id,'Conversation',' class="btn btn-default mar-bot-5" '); ?>       
	        	
             <?php if($task_detail->task_activity_status==0 ) { echo anchor('task/accept_offer/'.$task_id.'/'.$offers->task_comment_id,'Accept Offer',' class="btn btn-default mar-bot-5" '); }
			 
			 
			 if($task_detail->task_activity_status==1 && $task_detail->task_worker_id==$offers->worker_id) {
			 
			  echo anchor('user_task/complete/'.$task_id,'Complete Task',' class="btn btn-default mar-bot-5" '); 
			 
			 
			 echo anchor('dispute/dispute_task/'.$task_id,'Dispute Task',' class="btn btn-default mar-bot-5" ');
			 
			 }
			 
			 
			 
			  ?>
                                          
                            </div>
                        </div>
                        <div class="clear"></div>    
                    </div>
                    <div class="clear"></div>
                    
                    
                </li>
                
                
			<?php }   ?>
            
            
            
                
                
                
                
                
                
                
                
                
                
                
                
                </ul>-->
                	<p style="color:#585858; text-align:center; font-size:17px; padding:0 0 20px 0;"><?php echo anchor('user_task/worker_offer/'.$task_id,'Klicka här','style="color:#881926; font-weight:bold;"'); ?> för att se alla lagda bud på detta uppdrag.</p>
                </div>
         <?php } 
		 
		 
		 } ?>
         
         
         <?php if($similar_tasks) { 
        
       		 if(count($similar_tasks)>2) { ?>
         <div class="inside-subtitle">TASKS SIMILAR TO THIS ONE</div>
		<div class="fleft100">
			<ul class="tasks-status">
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
                <li class="posrel">
                <div class="taskphoto taskphoto-2"><?php echo anchor('user/'.$task_info->profile_name,'<img src="'.$user_image.'" width="60" height="60" alt="" class="round-corner" />'); ?></div>
                <div class="taskdetails">
                <h2 class="abmarks abmarks-2 unl"><?php echo anchor('tasks/'.$task_info->task_url_name,ucfirst($task_info->task_name));?></h2>
                <p class="colmark colmark-2"><span class="nelly">Skapad av <?php echo '<b>'.ucfirst($task_info->first_name).' '.ucfirst(substr($task_info->last_name,0,1)).'.</b>'; ?></span> <span class="newyorkc">in <?php echo $task_info->city_name; ?></span></p>
                <div class="strmn strmn-2"><div class="str_sel str_sel-2 fl" style="width:<?php if($total_rate>5) { ?>100<?php } else { echo round($total_rate*2);?>0<?php } ?>%;"></div></div>
                </div>
                </li>
			<?php  } ?>    
            </ul>
            </div>
         
       <?php  }
	 
	 } ?>     
         
         
         
    
   <?php /*?><?php if($similar_tasks) { 
        
       		 if(count($similar_tasks)>2) { ?>
                 
<div class="task_new">
	<h3 id="detail-bg1">Tasks similar to this one</h3>



<div id="container-inner">
    <div id="carousel-inner">
      
       
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
           <div class="taskoneN1">
                <div class="taskoneleft">
                    <div><?php echo anchor('user/'.$task_info->profile_name,'<img src="'.$user_image.'" width="50" height="50" alt="" />'); ?></div>
                    <div class="str"><div class="str_sel" style="width:<?php if($total_rate>5) { ?>100<?php } else { echo round($total_rate*2);?>0<?php } ?>%;"></div></div>
                </div>
                 <div class="taskoneright">
                    <div style="height:40px"><?php echo anchor('tasks/'.$task_info->task_url_name,ucfirst($task_info->task_name),' class="fpass"');?></div>
                    <h4 style="height:30px"><span class="nelly">posted by <?php echo '<b>'.ucfirst($task_info->first_name).' '.ucfirst(substr($task_info->last_name,0,1)).'.</b>'; ?></span> <span class="newyorkc">in <?php echo $task_info->city_name; ?></span></h4>
                    <h4 style="height:30px"><span class="nelly"><?php echo $site_setting->currency_symbol.$task_info->task_price; ?></span> <!--<span class="newyorkc">for Tasks of this type</span>--></h4><br/>
                      
					  
					  <div style="height:20px">
					  <?php  if(!check_user_authentication()) {  echo anchor('sign_up','Copy',' class="chbg"'); } else { echo anchor('task/update_task_step_zero/'.$task_info->task_id.'/copy','Copy','  class="chbg"  id="copy_'.$task_info->task_id.'"  ');?>
                      </div>
                      
                      <script type="text/javascript">
								jQuery(document).ready(function() {	
									jQuery("#copy_<?php echo $task_info->task_id;?>").fancybox();	
								});
						</script>
                        
                        <?php    }?>
                      
                </div>
                <div class="clear"></div>
            </div>                
      
			<?php  } ?>        
   
                  
                    
				</div>
                
             
    <a href="#" id="ui-carousel-next-inner"><span>next</span></a>
    <a href="#" id="ui-carousel-prev-inner"><span>prev</span></a>
   
     
			</div>	


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
        
       
     
<!-- slider e-->              
</div>                

     <?php  }
	 
	 } ?><?php */?>          
                
                
                
		</div>
	</div>
    <div class="dbright-task dbright-task-main">
        <?php echo $this->load->view($theme.'/layout/task/task_detail_side_bar',$data); ?>  
    </div>
</div>
<div class="clear"></div>
        </div>
        <div class="clear"></div>



    </div>
</div>



