<script type="text/javascript">
function un_favorite(id)
{
	
		var strURL='<?php echo base_url().'user/un_favorite/';?>'+id;
		var xmlhttp;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  
		  }
		xmlhttp.onreadystatechange=function()
		  {
			 
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{	
			///alert(xmlhttp.responseText);
				if(xmlhttp.responseText=='login_failed')
				{
					window.location.href='<?php echo base_url().'sign_up/'; ?>';				
				}
				else
				{
					document.getElementById("favorite").innerHTML=xmlhttp.responseText;
				}		
			}
		  }
		xmlhttp.open("GET",strURL,true);
		xmlhttp.send();
}
function make_favorite(id)
{
		var strURL='<?php echo base_url().'user/make_favorite/';?>'+id;
		var xmlhttp;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  
		  }
		xmlhttp.onreadystatechange=function()
		  {
			 
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{	
			//alert(xmlhttp.responseText);
				if(xmlhttp.responseText=='login_failed')
				{
					window.location.href='<?php echo base_url().'login/'; ?>';				
				}
				else
				{
					document.getElementById("favorite").innerHTML=xmlhttp.responseText;
				}		
			}
		  }
		xmlhttp.open("GET",strURL,true);
		xmlhttp.send();
}

</script>
        <div class="mconright">
			<!--<div id="needhelp-ph">
				<p class="needhelp">&nbsp;</p>
			</div>-->
			<div id="right-panel-bg">
          
              <?php if($user_profile->user_id==get_authenticateUserID()) { ?>
              
                <div style="text-align:center">
                	<?php echo anchor('customize_profile','Edit Profile','class="btn btn-default btn-profile btn-profile15" style="border-radius:10px"'); ?>
                </div>   
                           
                            
                <?php } else { 
                
                
                 $check_worker_detail=$this->worker_model->check_user_worker_detail($user_profile->user_id);
					
					if($check_worker_detail) { 
                    
                    		$chk_login_user_favorite=check_user_favorite($user_profile->user_id);
						
						if($chk_login_user_favorite) {	
                    ?>
                    <div style="text-align:center" id="favorite">
								<input name="" type="submit" class="btn btn-default btn-profile btn-profile15 btn-profile156" onClick="un_favorite(<?php echo $user_profile->user_id;?>)" value="Un Favorite" style="border-radius:10px" />
					</div>
                    		<!-- changed here -->
                    <?php } else { ?> 
                    		<div style="text-align:center" id="favorite">
								<input name="" type="submit" class="btn btn-default btn-profile btn-profile15 btn-profile156" onClick="make_favorite(<?php echo $user_profile->user_id;?>)" value="Add as Favorite" style="border-radius:10px" />
							</div>
					<? } ?>
                          <div class="clear"></div>
                        <div  style="text-align:center">
                   <?php  if(!check_user_authentication()) 
                   {  
                   	echo anchor('login','Hire '.$user_profile->first_name,'class="btn btn-default btn-profile" style="border-radius:10px"');   
                   }  
                   else 
                   {

				 		if($site_setting->subscription_need==0)
             			{
				 		echo   anchor('task/new_task/'.$check_worker_detail->worker_id,'Hire '.$user_profile->first_name,'class="btn btn-default btn-profile" style="border-radius:10px" id="hireme_'.$check_worker_detail->worker_id.'"');
				   
				  ?>
                   <script type="text/javascript">
								jQuery(document).ready(function() {	
									jQuery("#hireme_<?php echo $check_worker_detail->worker_id;?>").fancybox();	
								});
						</script>
                        
                  <?php 
                  	   }
                  	   else
                  	   {
                  	   	$user_setting=user_profilestatus(get_authenticateUserID());
			            if($user_setting->profile_active==1)
			            {
			            	echo   anchor('task/new_task/'.$check_worker_detail->worker_id,'Hire '.$user_profile->first_name,'class="btn btn-default btn-profile" style="border-radius:10px" id="hireme_'.$check_worker_detail->worker_id.'"');
				   
				  		?>
                   <script type="text/javascript">
								jQuery(document).ready(function() {	
									jQuery("#hireme_<?php echo $check_worker_detail->worker_id;?>").fancybox();	
								});
						</script>
						<?php
			            }
			            else
			            {
			            ?>
                        <a href="javascript:void(0)" class="btn btn-default btn-profile pupload14" style="border-radius:10px">Hire <?php echo $user_profile->first_name?></a>    
			            <?php
			            }
                  	   }
              		} 

              	  ?>
						</div>
                 
                
            

			<div class="runnerph">
            <!--<h3 class="runner">Top Task Types</h3>-->
            <div class="types">
               <!-- <ul>
                    
                    <?php $category_task=$this->worker_model->get_worker_category_task($check_worker_detail->worker_id);
					
					if($category_task) {  
					
							foreach($category_task as $cat_task) {
							
							
				$total_category_rate=get_user_total_category_task_rate($user_profile->user_id,$check_worker_detail->worker_id,$cat_task->task_category_id);
						
							 ?>
                            
                            <li><h5><?php echo anchor('tags/'.$cat_task->category_url_name,$cat_task->category_name,'class="col unl cob"');?></h5><h6><?php echo $cat_task->total_task;?> Tasks run (<?php echo $total_category_rate; ?>/5 stars)</h6></li>
                            
                            <?php } } ?>
                    
                 
                    
                    
                    
                </ul>-->
                <div class="clear"></div>
            </div>   


   					<?php } 
					
					 } ?>
                     
                     
                     


        
        <div class="fb-pro " style="text-align:center"><a href="javascript:void()" onClick="window.open('http://www.facebook.com/share.php?u=<?php echo site_url('user/'.$user_profile->profile_name);?>&amp;t=<?php echo $user_profile->first_name.' '.$user_profile->last_name; ?>','Share on Facebook','height=300,width=600,top=50,left=300');"><img src="<?php echo base_url().getThemeName(); ?>/images/share-profile-fb.png"  border="0" /></a></div>
        <div class="clear"></div>


		<div class="badge_back">
        	<div class="cornered">
            	<h3>
                	<span class="underline white"> My badges</span>
                </h3>
            </div>
            <div class="verifieringar pull-left">
                <div class="roboimg icon-profile" style="margin:0px; padding-top:20px; padding-bottom:20px;">
					<?php 
                    $check_is_worker=check_is_worker($user_profile->user_id);
                    if($check_is_worker) { ?>
                    <a href="#" class="link1 tooltip">
                        <img alt="" src="<?php echo base_url().getThemeName(); ?>/images/badge1.png">
                        <span>Tasker</span>
                    </a>
                    <?php 
                    }
                    if($check_worker_detail->worker_background_approved==1) { ?>
                    <a href="#" class="link2 tooltip">
                        <img alt="" src="<?php echo base_url().getThemeName(); ?>/images/badge2.png">
                        <span>Background Check</span>
                    </a>
                    <?php } if($user_profile->mobile_no!='' || $user_profile->phone_no!='') { ?>
                    <a href="#" class="link3 tooltip">
                        <img alt="" src="<?php echo base_url().getThemeName(); ?>/images/badge3.png">
                        <span>Contact Verified</span>
                    </a>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
<!--<div class="inside-subtitle">Reviews</div>
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
<p class="post-info m15"><?php echo anchor('user/'.$user_profile->profile_name.'/reviews','see all review','class="b-button"');?></p>-->
</div>
            
            
         <!--    
            <div class="marB20">
                <div class="estim marB10 marT10">New York City</div>
                
                <iframe width="280" height="253" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=it+companies+in+bangalore&aq=&sll=19.264768,75.984926&sspn=5.380553,10.821533&vpsrc=6&ie=UTF8&hq=it+companies&hnear=Bengaluru,+Bengaluru+Rural,+Karnataka,+India&t=m&fll=12.97079,77.596886&fspn=0.010852,0.021136&st=112334869561858955379&rq=1&ev=zi&split=1&ll=12.958081,77.603876&spn=0.021705,0.042272&output=embed"></iframe>
                
            </div>
            
            
             -->
            
        </div>
        </div>
        
        
<!--         
        <div class="clear"></div> -->