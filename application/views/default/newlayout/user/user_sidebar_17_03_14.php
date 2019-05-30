      
        
        <div class="mconright">
        
        	<div class="marB15">
            	<div class="estim marB10">Profile</div>
               	<ul class="accr">
                	<li><?php echo anchor('user/'.getUserProfileName(),'See Profile'); ?></li>
				</ul>                     
            </div>
            
             <?php $check_is_worker=check_is_worker(get_authenticateUserID()); ?>

			<div class="marB15">
            	<div class="estim marB10">Mitt konto</div>
               	<ul class="accr">
                	<li><?php echo anchor('account','See Account');?></li>
                    
                    
                     
                	<li><?php echo anchor('wallet','Transaction History');?></li>
                	<li><?php echo anchor('change_password','Change password');?></li>
                	<li><?php echo anchor('notifications','Notifications');?></li>
                	<li><?php echo anchor('stored_card','My Credit Card');?></li>
					<?php if($check_is_worker) { ?>
						<li><?php echo anchor('worker/edit','Worker bee Profile');?></li>
                    <?php } else {?>
						<li><?php echo anchor('worker/apply','Apply to be a Worker bee');?></li>
					<?php } ?>
                <!--	<li><a href="#">Apply to be an affiliate</a></li>-->
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
