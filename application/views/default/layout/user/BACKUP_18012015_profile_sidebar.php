 
        <div class="mconright">
			<!--<div id="needhelp-ph">
				<p class="needhelp">&nbsp;</p>
			</div>-->
			<div id="right-panel-bg">
          
              
              <?php if($user_profile->user_id==get_authenticateUserID()) { ?>
              
                <div class="fleft100 mtop15" style="text-align:center">
              <?php echo anchor('customize_profile','Customise Profile','class="login_new1"'); ?>
                        </div>   
                           
                            
                <?php } else { 
                
                
                 $check_worker_detail=$this->worker_model->check_user_worker_detail($user_profile->user_id);
					
					if($check_worker_detail) { 
                    ?>
                        <div class="fleft100 mtop15" style="text-align:center">
                   <?php  if(!check_user_authentication()) {  echo anchor('sign_up','Hire '.$user_profile->first_name,'class="login_new1"');   }  else {
				   
				   
				 echo   anchor('task/new_task/'.$check_worker_detail->worker_id,'Hire '.$user_profile->first_name,'class="login_new1" id="hireme_'.$check_worker_detail->worker_id.'"');
				   
				    ?>
                   
                   
                   
                   <script type="text/javascript">
								jQuery(document).ready(function() {	
									jQuery("#hireme_<?php echo $check_worker_detail->worker_id;?>").fancybox();	
								});
						</script>
                        
                   <?php } ?>
						</div>
                 
                
            

			<div class="runnerph">
            <h3 class="runner">Top Task Types</h3>
            <div class="types">
                <ul>
                    
                    <?php $category_task=$this->worker_model->get_worker_category_task($check_worker_detail->worker_id);
					
					if($category_task) {  
					
							foreach($category_task as $cat_task) {
							
							
				$total_category_rate=get_user_total_category_task_rate($user_profile->user_id,$check_worker_detail->worker_id,$cat_task->task_category_id);
						
							 ?>
                            
                            <li><h5><?php echo anchor('tags/'.$cat_task->category_url_name,$cat_task->category_name,'class="col unl cob"');?></h5><h6><?php echo $cat_task->total_task;?> Tasks run (<?php echo $total_category_rate; ?>/5 stars)</h6></li>
                            
                            <?php } } ?>
                    
                 
                    
                    
                    
                </ul>
                <div class="clear"></div>
            </div>   



            <div class="roboimg marTB20" >
                
              
               
              
            
            	
                <!--<div><img src="<?php echo base_url().getThemeName(); ?>/images/tbh.png" alt="" /></div>-->
                <a class="link1" href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/abr1.png" alt="" /></a>
                
                
                <?php if($check_worker_detail->worker_background_approved==1) { ?>
                   <!--<div><a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/bag_chk.png" alt="" /></a></div>-->
                <a class="link2" href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/abr2.png" alt=""  /></a>
                
                <?php }  if($user_profile->mobile_no!='' || $user_profile->phone_no!='') { ?>
                
                
                
                 <!--<div><a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/phmail.png" alt="" /></a></div>-->
                <a class="link3" href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/abr3.png" alt=""/></a>
                
                <?php } ?>
             <?php /*?> <div id="roboho4"><a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/ip_var.png" alt="" /></a></div>      
                 <a class="link4" href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/abr4.png" alt="" /></a>
                 <?php */?>
                 
              <div class="clear"></div>
            </div>

   					<?php } 
					
					 } ?>
                     
                     
                     


        
        <div class="fleft100 mtop15" style="text-align:center"><a href="javascript:void()" onClick="window.open('http://www.facebook.com/share.php?u=<?php echo site_url('user/'.$user_profile->profile_name);?>&amp;t=<?php echo $user_profile->first_name.' '.$user_profile->last_name; ?>','Share on Facebook','height=300,width=600,top=50,left=300');"><img src="<?php echo base_url().getThemeName(); ?>/images/share-profile-fb.png"  border="0" /></a></div>
        <div class="clear"></div>


<div class="starmenu marB10" >
<?php

$total_rate=get_user_total_rate($user_profile->user_id);

$total_review=get_user_total_review($user_profile->user_id);

?>
    <div class="fleft100 mtop15"><div class="str_sel" style="width:<?php if($total_rate>5) { ?>100<?php } else { echo round($total_rate*2);?>0<?php } ?>%;"></div></div>
    <div class="rate" style="width: 127px;"><p class="normal-text"><?php echo $total_rate; ?>/5  ( <span><?php echo anchor('user/'.$user_profile->profile_name.'/reviews',$total_review.' reviews');  ?> </span> )</p></div>
    <div class="clear"></div>
</div> 
<div class="inside-subtitle">Reviews</div>
<div class="rlist" >
   <ul>
    
    
    <?php
	
	if($reviews ) { 
		
		$review_cnt=0;
		
		foreach($reviews as $review) {
		
				 $user_image= base_url().'upload/no_image.png';
							 
				 if($review->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$review->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$review->profile_image;
						
					}
					
				}
						
	
		?>
    
        <li>
           <div class="taskphoto">
               <?php echo anchor('user/'.$review->profile_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />'); ?>
                            
           </div>
           <div class="taskdetails" style="text-align:left; width:60%">
            <h5>Review for <span><?php echo anchor('tasks/'.$review->task_url_name,ucfirst($review->task_name)); ?></span></h5>
            <h5><?php echo $review->task_comment; ?></h5>
           <div class="geo"><?php echo getDuration($review->comment_date); ?></div>	
           </div>
           <div class="clear"></div>
            
        </li>
        
        
        <?php
		
				$review_cnt++;
				
				if($review_cnt==6) { break; } 
			 } 
		
		
		} ?>
        
        
        
        
     </ul>
	 <p class="post-info m15"><?php echo anchor('user/'.$user_profile->profile_name.'/reviews','see all review','class="b-button"');?></p>
</div>
</div>
            
            
            
            <!--<div class="marB20">
                <div class="estim marB10 marT10">New York City</div>
                
                <iframe width="280" height="253" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=it+companies+in+bangalore&aq=&sll=19.264768,75.984926&sspn=5.380553,10.821533&vpsrc=6&ie=UTF8&hq=it+companies&hnear=Bengaluru,+Bengaluru+Rural,+Karnataka,+India&t=m&fll=12.97079,77.596886&fspn=0.010852,0.021136&st=112334869561858955379&rq=1&ev=zi&split=1&ll=12.958081,77.603876&spn=0.021705,0.042272&output=embed"></iframe>
                
            </div>-->
            
            
            
            
        </div>
        </div>
        
        
        
        <div class="clear"></div>