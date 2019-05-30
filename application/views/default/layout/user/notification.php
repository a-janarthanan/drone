<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
<div>
<div class="red-subtitle top-red-subtitle">Notifications : <?php echo anchor('user/'.getUserProfileName(),$user_info->first_name.' '.substr($user_info->last_name,0,1),'class="dhan unl"'); ?></div>
    	<div class="profile_back">
        <div class="container">
        <div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
        <div class="home-signpost-content home-signpost-content-new-section"> 
    	<div class="dbleft dbleft-main">
    	

 <?php if($error!=''){ 
  
  if($error=='update') {  ?>
  
  	<div id="success">
					<ul>
				<p>Notifications updated!</p>
					</ul>
				</div>
                
                
  <?php } else { ?>
				<div id="error">
					<ul>
					<?php  echo $error; ?>
					</ul>
				</div>
			<?php }  } ?>
            
            
  <div class="padT10B20">
           
          
          	<div class="marTB10">
            
            <p>We can email you when actions are taken on the site that are relevant. Click the checkboxes below to control the notifications for each action</p>
            
            
            <br />

            <p><b>Email : </b><span style="color:#000000;"><?php echo $user_info->email; ?></span></p>
            <?php
			
			/*if($user_info->mobile_no!='') { ?>
              <br />

            <p><b>Mobile : </b><span style="color:#000000;"><?php echo $user_info->mobile_no; ?></span></p>
            
            <?php } */ ?>
            
	           
 
            
            
 <?php
		$attributes = array('name'=>'notificationForm','id'=>'notificationForm','class'=>'form_design');
		echo form_open('notifications',$attributes);
	?>
            
            
              <fieldset>
         <p>When I post a Task, notify me as follows:</p><br />

        
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
    
    
    
    <tr>
    <td align="left" valign="top">1. After I post a Task</td>
    <td align="center" valign="middle" width="40"><input type="checkbox" name="on_post_task" id="on_post_task" value="1" <?php if($user_notification->on_post_task==1) { ?> checked="checked" <?php } ?> /></td>
    </tr>
    
 <?php    $site_setting=site_setting(); ?>
     <tr class="backg">
    <td align="left" valign="top">2. Tasker made an offer or posted a comment on my Task</td>
    <td align="center" valign="middle"><input type="checkbox" name="on_comment_or_offer_task" id="on_comment_or_offer_task" value="1"  <?php if($user_notification->on_comment_or_offer_task==1) { ?> checked="checked" <?php } ?> /></td>
    </tr>
    
    
     <tr>
    <td align="left" valign="top">3. Tasker is assigned to my Task</td>
    <td align="center" valign="middle"><input type="checkbox" name="on_assign_task" id="on_assign_task" value="1"  <?php if($user_notification->on_assign_task==1) { ?> checked="checked" <?php } ?> /></td>
    </tr>
    
     <tr class="backg">
    <td align="left" valign="top">4. Tasker has completed my Task</td>
    <td align="center" valign="middle"><input type="checkbox" name="on_complete_task" id="on_complete_task" value="1"  <?php if($user_notification->on_complete_task==1) { ?> checked="checked" <?php } ?> /></td>
    </tr>
    
    
     <tr>
    <td align="left" valign="top">5. A Task needs my attention to prevent it from expiring</td>
    <td align="center" valign="middle"><input type="checkbox" name="on_expire_task" id="on_expire_task" value="1"  <?php if($user_notification->on_expire_task==1) { ?> checked="checked" <?php } ?> /></td>
    </tr>
      
      </table>
     </fieldset>
     
      <fieldset> 
      <br />

      
      <!-- <p>Marketing : </p><br />-->

        
            <!--<table width="100%" border="0" cellspacing="0" cellpadding="5">
    
    
    
    <tr  class="backg">
    <td align="left" valign="top">Tell me about <?php echo $site_setting->site_name; ?> promotions.</td>
    <td align="center" valign="middle"  width="40"><input type="checkbox" name="on_promotions" id="on_promotions" value="1"  <?php if($user_notification->on_promotions==1) { ?> checked="checked" <?php } ?> /></td>
    </tr>
    

    
    
   
      
      </table>-->
        </fieldset>
             
			</div>           
                


                

<div class="marTB10">
	           
          <input type="submit" value="Change" class="btn btn-default" name="notificationbtn" id="notificationbtn">     
               
            </form>   
               
</div>            


                


            
            
         
  </div>      
                
                
		</div>
        </div>
        <div class="dbright-task dbright-task-main">
		<?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
		</div>
        
</div>
</div>
<div class="clear"></div>
</div>

<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/validation.js"></script>