<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/lib/tooltip2.js"></script>
<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
<div>

<div class="red-subtitle top-red-subtitle" style="margin:0px 0 0 0">Conversations</div>
    	<div class="profile_back">
        <div class="container">
        <div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
        <div class="home-signpost-content"> 
            <div class="dbleft dbleft-main">
            
            
            <div id="s1postJ" class="padB10 inside-subtitle"><b style="font-size:20px;"><?php echo  anchor('tasks/'.$task_detail->task_url_name,ucfirst($task_detail->task_name),'class="dhan"'); ?></b></div>
                            
                        
            <?php
            
            $site_setting=site_setting(); 
            $data['site_setting']=$site_setting;
            ?>
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
                    </div>
            <div class="dbright-task dbright-task-main">
            	<?php echo $this->load->view($theme.'/layout/task/task_detail_side_bar',$data); ?>  
            </div>
   			<div class="clear"></div>     
		</div>
<div class="clear"></div>     
</div>
<div class="clear"></div> 
          	
