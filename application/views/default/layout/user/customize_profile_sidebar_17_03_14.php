      
        
        <div class="mconright">
        
        <div class="marB15">
        <br>
<br>

        
        <div align="center" style="padding-left: 90px;">
        <input type="submit" name="customizebtn" id="customizebtn" value="Save Changes" class="submbg1"  />
        </div>
        <br>
<br>
<br>
<br>

        
        
        
            	<div class="estim marB10">Links</div>       

<p>Display links to your profiles on other sites</p>
 	<ul class="accr">
    
    <li>   <img src="<?php echo base_url().getThemeName(); ?>/images/home.png" alt="" class="edit_profile_social" /><input type="text" name="own_site_link" id="own_site_link" value="<?php echo $user_profile->own_site_link; ?>" class="ntext" /></li>
    
    
     <li>   <img src="<?php echo base_url().getThemeName(); ?>/images/fb_p.png" alt="" class="edit_profile_social" /><input type="text" name="facebook_link" id="facebook_link" value="<?php echo $user_profile->facebook_link; ?>" class="ntext" /></li>
                 	  
                        
               
        <li>   <img src="<?php echo base_url().getThemeName(); ?>/images/twitter_p.png" alt="" class="edit_profile_social" /><input type="text" name="twitter_link" id="twitter_link" value="<?php echo $user_profile->twitter_link; ?>" class="ntext" /></li>          
                    
                    
               
        <li>   <img src="<?php echo base_url().getThemeName(); ?>/images/linkedin.png" alt="" class="edit_profile_social" /><input type="text" name="linkedin_link" id="linkedin_link" value="<?php echo $user_profile->linkedin_link; ?>" class="ntext" /></li>                     
               
				
           <li>   <img src="<?php echo base_url().getThemeName(); ?>/images/yelp.png" alt="" class="edit_profile_social" /><input type="text" name="yelp_link" id="yelp_link" value="<?php echo $user_profile->yelp_link; ?>" class="ntext" /></li>         
                
             <li>   <img src="<?php echo base_url().getThemeName(); ?>/images/youtube.png" alt="" class="edit_profile_social" /><input type="text" name="youtube_link" id="youtube_link" value="<?php echo $user_profile->youtube_link; ?>" class="ntext" /></li>         
                
                
                    
                 <li>   <img src="<?php echo base_url().getThemeName(); ?>/images/rss.png" alt="" class="edit_profile_social" /><input type="text" name="blog_link" id="blog_link" value="<?php echo $user_profile->blog_link; ?>" class="ntext" /></li>         
                 
                
                   
                  
                        
	</ul>
    
    </div>    
           
        
        
        
     
               
            </form>  
        
   <?php $check_is_worker=check_is_worker(get_authenticateUserID()); ?>
   
        	<div class="marB15">
            	<div class="estim marB10">Profile</div>
               	<ul class="accr">
                	<li><?php echo anchor('user/'.getUserProfileName(),'See Profile'); ?></li>
				</ul>                     
            </div>
            
			<div class="marB15">
            	<div class="estim marB10">Your Account</div>
               	<ul class="accr">
                	<li><?php echo anchor('account','See Account');?></li>
                    
                     <?php if($check_is_worker) { ?>
                     <li><?php echo anchor('worker/edit','Worker bee Profile');?></li>
                     <?php } ?>
                     
                	<li><?php echo anchor('wallet','Transaction History');?></li>
                	<li><?php echo anchor('change_password','Change password');?></li>
                	<li><?php echo anchor('notifications','Notifications');?></li>
                	 <li><?php echo anchor('stored_card','My Credit Card');?></li>
                	<li><?php echo anchor('who-are-the-taskers','Apply to be a Worker bee');?></li>
                	<!--<li><a href="#">Apply to be an affiliate</a></li>-->
				</ul>                     
            </div>            
    


			<div class="marB15">
            	<div class="estim marB10">My Posted Tasks</div>
               	<ul class="accr">
                	<li><?php echo anchor('user_task/mytasks','Tasks');?></li>
                	<li><?php echo anchor('user_task/recurring','Recurring Tasks');?></li>
                	<li><?php echo anchor('user_task/scheduled','Scheduled Tasks');?></li>
                	<li><?php echo anchor('user_other/favorites','Favourite Worker bees');?></li>
                	<li><?php echo anchor('user_other/locations','Locations');?></li>
				</ul>                     
            </div> 
            
              <?php if($check_is_worker) { ?>
            
            <div class="marB15">
            	<div class="estim marB10">My Running Tasks</div>
               	<ul class="accr">
                	<li><?php echo anchor('worker_task/my','Tasks');?></li>
                   <li><?php echo anchor('worker_task/recurring','Recurring Tasks');?></li>
                   <li><?php echo anchor('worker_task/scheduled','Scheduled Tasks');?></li>
				</ul>                     
            </div> 
            
            
            <?php } 	
			$site_setting=site_setting();?>
            
                       

			Balance: <?php echo $site_setting->currency_symbol.my_wallet_amount(); ?>
        
        </div>
        <div class="clear"></div>
