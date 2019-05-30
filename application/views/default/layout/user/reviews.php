
<?php


$site_setting=site_setting(); 
$data['site_setting']=$site_setting;

$data['reviews']=$reviews;
$data['user_profile']=$user_profile;

?>
<style>
.ulsty2 li {
padding: 10px 0px;
border-bottom: 1px dotted #ccc;
}
.abc img {
float: left;
border: 1px solid #dee0e1;
}
.abct3rig {
float: left;
width: 510px;
}
.revfor {
font-size: 13px;
font-weight: bold;
color: #f2413e;
}
</style>
<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
	<div>
    <div class="red-subtitle top-red-subtitle">Reviews for <?php echo anchor('user/'.$user_profile->profile_name,ucfirst($user_profile->first_name).' '.ucfirst($user_profile->last_name),'style=""');?></div>
    	<div class="profile_back">
        <div class="container">
        <div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
        <div class="home-signpost-content" style="padding-top:0px; padding-bottom:0px; margin-top:0px;"> 
    	<div class="dbleft dbleft-main">
	
    	
                

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
                            <div class="taskphoto taskphoto-2"> <?php echo anchor('user/'.$review->profile_name,'<img src="'.$user_image.'" alt="" width="60" height="60" class="round-corner" />'); ?>
                            
                            </div>
                            <div class="taskdetails">
                            	<div class="abmarks-2 abmarks-2-2">Review for <?php echo anchor('tasks/'.$review->task_url_name,ucfirst($review->task_name),' class="unl"'); ?></div>
                              
                                <div class="strmn strmn-2 fl"><div class="str_sel str_sel-2 fl" style="width:<?php if($review->comment_rate>5) { ?>100<?php } else { echo $review->comment_rate*2;?>0<?php } ?>%;"></div></div>
                                
                                <p class="strig colmark-2"><?php echo $review->task_comment; ?></p>
                                
                                <p class="geo geo-2"><?php echo getDuration($review->comment_date); ?></p>
                                
                                </div>    
                                    
                            
                            <div class="clear"></div>
                        </li>
                      
                      
                      <?php
					  
					  }
					  
					} else {?>  
					
                    	<li>You have no Reviews since you have not run or post any Jobs that have been marked as completed</li>
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
        </div>
     
	<div class="dbright-task dbright-task-10 dbright-task-10-new">
    <?php // echo $this->load->view($theme.'/layout/user/profile_sidebar',$data); ?>
    </div>
   <div class="clear"></div>     
</div><div class="clear"></div>     

           
          	
