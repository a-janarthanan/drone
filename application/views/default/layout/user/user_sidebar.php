      
        
        <div class="mconright">
        
        	<div class="marB15">
            	<div class="inside-subtitle inside-subtitle-2">Profile</div>
               	<div class="fleft100">
                	<?php echo anchor('user/'.getUserProfileName(),'See Profile','class="b-button b-button-2"'); ?>
				</div>                   
            </div>
            
             <?php $check_is_worker=check_is_worker(get_authenticateUserID()); ?>

			<div class="marB15">
            	<div class="inside-subtitle inside-subtitle-2">Your Account</div>
               	<div class="fleft100">
                	<?php echo anchor('account','See Account','class="b-button b-button-2"');?>
                    
                    
                     
                	<?php //echo anchor('wallet','Transaction History','class="b-button b-button-2"');?>
                	<?php echo anchor('change_password','Change password','class="b-button b-button-2"');?>
                	<?php echo anchor('notifications','Notifications','class="b-button b-button-2"');?>
                	<!--<?php// echo anchor('stored_card','My Credit Card');?>-->
					<?php if($check_is_worker) { ?>
						<?php echo anchor('worker/edit','Tasker Profile','class="b-button b-button-2"');?>
                    <?php } else {?>
						<?php echo anchor('who-are-the-taskers','Apply to be a Tasker','class="b-button b-button-2"');?>
					<?php } ?>
                <!--	<a href="#">Apply to be an affiliate</a>-->
				</div></div>            


			<div class="marB15">
            	<div class="inside-subtitle inside-subtitle-2">My Posted Tasks</div>
               	<div class="fleft100">
                	<?php echo anchor('user_task/mytasks','Tasks','class="b-button b-button-2"');?>
                	<?php //echo anchor('user_task/recurring','Recurring Tasks','class="b-button"');?>
                	<?php //echo anchor('user_task/scheduled','Scheduled Tasks','class="b-button"');?>
                	<?php echo anchor('user_other/favorites','Favourite Tasker','class="b-button b-button-2"');?>
                	<?php echo anchor('user_other/locations','Locations','class="b-button b-button-2"');?>
				</div></div> 
            
              <?php if($check_is_worker) { ?>
            
            <div class="marB15">
            	<div class="inside-subtitle inside-subtitle-2">My Running Tasks</div>
               	<div class="fleft100">
                	<?php echo anchor('worker_task/my','Tasks','class="b-button b-button-2"');?>
                   <?php //echo anchor('worker_task/recurring','Recurring Tasks','class="b-button"');?>
                   <?php //echo anchor('worker_task/scheduled','Scheduled Tasks','class="b-button"');?>
				</div></div> 
            
            
            <?php } 
			
			
			$site_setting=site_setting();?>
            
                       
				<!--<div class="inside-subtitle inside-subtitle-2">Balance</div>
			<p class="text-mtop10 price-in"><?php echo $site_setting->currency_symbol.my_wallet_amount(); ?></p>-->
        
        </div>
        <div class="clear"></div>
