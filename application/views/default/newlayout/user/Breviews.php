<div class="main">
<div class="incon">
<?php


$site_setting=site_setting(); 
$data['site_setting']=$site_setting;

$data['reviews']=$reviews;
$data['user_profile']=$user_profile;

?>

<div class="mconleft">
                
            

           
<div id="s1postJ" class="padB10">Reviews for <?php echo anchor('user/'.$user_profile->profile_name,ucfirst($user_profile->first_name).' '.ucfirst($user_profile->last_name),'class="dhan"');?></div>
           
           


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
					  
					} ?>  
					
                    	
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


    <?php  echo $this->load->view($theme.'/layout/user/profile_sidebar',$data); ?>
   <div class="clear"></div>     
</div>
</div>

           
          	
