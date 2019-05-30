
<?php


$site_setting=site_setting(); 
$data['site_setting']=$site_setting;

$data['reviews']=$reviews;
$data['user_profile']=$user_profile;

?>

<div>
	<div>
    <div class="red-subtitle" style="margin:172px 0 0 0">Reviews for <?php echo anchor('user/'.$user_profile->profile_name,ucfirst($user_profile->first_name).' '.ucfirst($user_profile->last_name),'style="color:black"');?></div>
    	<div id="two-columnar-section">
        <div class="task-layout">
        <div class="db-rightinfo" style="width:100%; margin:25px 0 0 0">
        <div class="home-signpost-content"> 
    	<div class="dbleft">
	
    	
                

                	<ul class="ulsty2">
                    
                      <?php if($result) { 
					
					
							foreach($result as $review) { 
							
							
							
							 $user_image= base_url().'upload/no_image.png';
							 
							 if($review->profile_image!='') {  
						
								if(file_exists(base_path().'upload/user/'.$review->profile_image)) {
							
									$user_image=base_url().'upload/user/'.$review->profile_image;
									
								}
								
							}
						
						
						
						
						?>
                    
                    	<li>
                            <div class="abc"> <?php echo anchor('user/'.$review->profile_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />'); ?>
                            
                            </div>
                            <div class="abct3rig">
                            	<div class="revfor">Review for <?php echo anchor('tasks/'.$review->task_url_name,ucfirst($review->task_name),' class="unl"'); ?></div>
                              
                                <div class="str"><div class="str_sel" style="width:<?php if($review->comment_rate>5) { ?>100<?php } else { echo $review->comment_rate*2;?>0<?php } ?>%;"></div></div>
                                
                                <p class="LH18"><?php echo $review->task_comment; ?></p>
                                
                                <p class="marT5 geo"><?php echo getDuration($review->comment_date); ?></p>
                                
                                </div>    
                                    
                            
                            <div class="clear"></div>
                        </li>
                      
                      
                      <?php
					  
					  }
					  
					} else {?>  
					
                    	<li>You have no Reviews since you have not run or post any Tasks that have been marked as completed</li>
                    <?php } ?>
            		</ul>

					<!-- s -->
					 <?php if($total_rows>$limit) { ?>
					<div class="gonext">
                    <?php echo $page_link; ?>
                    </div>
				<?php } ?>
                
                    <div class="clear"></div>
					<!-- e -->
       

   



       
                
           
           
                

		</div>

	<div class="dbright-task">
    <?php  echo $this->load->view($theme.'/layout/user/profile_sidebar',$data); ?>
    </div>
   <div class="clear"></div>     
</div>
</div>

           
          	
