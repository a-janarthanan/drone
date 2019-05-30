      
        
        <div class="mconright">
        
        	<div class="marB15">
            	<div class="inside-subtitle inside-subtitle-2">Profil</div>
               	<div class="fleft100">
                	<?php echo anchor('user/'.getUserProfileName(),'Se Profil','class="b-button b-button-2"'); ?>
				</div>                   
            </div>
            
             <?php $check_is_worker=check_is_worker(get_authenticateUserID()); ?>

			<div class="marB15">
            	<div class="inside-subtitle inside-subtitle-2">Mitt Konto</div>
               	<div class="fleft100">
                	<?php echo anchor('account','Se konto','class="b-button b-button-2"');?>
                    
                    
                     
                	<?php echo anchor('wallet','Transaktionshistorik','class="b-button b-button-2"');?>
                	<?php echo anchor('change_password','Ändra lösenord','class="b-button b-button-2"');?>
                	<?php echo anchor('notifications','Notifikationer','class="b-button b-button-2"');?>
                	<!--<?php// echo anchor('stored_card','Mitt kreditkort');?>-->
					<?php if($check_is_worker) { ?>
						<?php echo anchor('worker/edit','Redigera formulär','class="b-button b-button-2"');?>
                    <?php } else {?>
						<?php echo anchor('who-are-the-taskers','Apply to be a Tasker','class="b-button b-button-2"');?>
					<?php } ?>
                <!--	<a href="#">Apply to be an affiliate</a>-->
				</div></div>            


			<div class="marB15">
            	<div class="inside-subtitle inside-subtitle-2">Mina Skapade Uppdrag</div>
               	<div class="fleft100">
                	<?php echo anchor('user_task/mytasks','Uppdrag','class="b-button b-button-2"');?>
                	<?php //echo anchor('user_task/recurring','Recurring Tasks','class="b-button"');?>
                	<?php //echo anchor('user_task/scheduled','Scheduled Tasks','class="b-button"');?>
                	<?php echo anchor('user_other/favorites','Mina Favoriter','class="b-button b-button-2"');?>
                	<?php echo anchor('user_other/locations','Platser','class="b-button b-button-2"');?>
				</div></div> 
            
              <?php if($check_is_worker) { ?>
            
            <div class="marB15">
            	<div class="inside-subtitle inside-subtitle-2">Mina Aktiva Uppdrag</div>
               	<div class="fleft100">
                	<?php echo anchor('worker_task/my','Uppdrag','class="b-button b-button-2"');?>
                   <?php //echo anchor('worker_task/recurring','Recurring Tasks','class="b-button"');?>
                   <?php //echo anchor('worker_task/scheduled','Scheduled Tasks','class="b-button"');?>
				</div></div> 
            
            
            <?php } 
			
			
			$site_setting=site_setting();?>
            
                       
				<div class="inside-subtitle inside-subtitle-2">Saldo</div>
			<p class="text-mtop10 price-in"><?php echo $site_setting->currency_symbol.my_wallet_amount(); ?></p>
        
        </div>
        <div class="clear"></div>
