        
<div class="main">	
		
    <div class="incon">
    	
    	
      <script type="text/javascript">
			jQuery(function($) {
			
			jQuery("#terms").fancybox();
	
	
		
					
			});
		</script>
        
              
    <div class="runlleft">
        
        <h3 id="detail-bg1">Sign Up</h3>
     
        <?php if($this->input->post('register')) { if($error!=''){  ?>
				<div id="error">
					<ul>
					<?php  echo $error; ?>
					</ul>
				</div>
			<?php } } ?>




 <?php
		$attributes = array('name'=>'signupForm','id'=>'signupForm','class'=>'form_design');
		echo form_open('home/social_signup/',$attributes);
	?>
   
        <fieldset>
         
        
            <table width="80%" border="0" cellspacing="0" cellpadding="5" class="fr">
    
            
      <tr id="full_nameTR">
        <td width="28%" valign="top"><label id="silb" >Full Name *</label></td>
        <td width="72%"><input type="text" name="full_name" id="full_name" value="<?php echo $full_name; ?>"  class="ntext"  /><br />
         <span id="full_nameInfo">Please enter your first and last name.</span>
        </td>
      </tr>
      
      <tr id="zip_codeTR">
        <td valign="top"><label id="silb" >Postal Code *</label></td>
        <td><input type="text" name="zip_code" id="zip_code" value="<?php echo $zip_code; ?>"  class="ntext"  /><br />
        
        <span id="zip_codeInfo"></span>
         </td>
      </tr>
      
      
      <tr id="mobile_noTR">
        <td valign="top"><label id="silb">Mobile No.</label></td>
        <td><input type="text" name="mobile_no" id="mobile_no" value="<?php echo $mobile_no; ?>"  class="ntext"  /><br />
        <span id="mobile_noInfo"></span>
            <div id="mbs">Adding your mobile phone ensures you will get the latest updates about the Tasks you post.</div>
            
        </td>
      </tr>
      
    
      <tr id="emailTR">
        <td valign="top"><label id="silb">Email *</label></td>
        <td><input type="text" name="email" id="email" value="<?php echo $email; ?>"  class="ntext"  /><br />
        <span id="emailInfo"></span></td>
      </tr>
      
      
      <tr id="passwordTR">
        <td valign="top"><label  id="silb">Password</label></td>
        <td><input type="password" name="password" id="password" value="<?php echo $password; ?>"  class="ntext"  /><br />

       <span id="passwordInfo"></span>
        </td>
      </tr>
  
    <?php	





$site_setting=site_setting();

	if($site_setting->captcha_enable==1) { ?>
    
     <tr><td>
     
       <img src="<?php echo base_url(); ?>captcha/captcha.php" id="captcha" /><br/>
     <a href="javascript:void(0)" onclick="
    document.getElementById('captcha').src='<?php echo base_url(); ?>captcha/captcha.php?'+Math.random();"
    id="change-image">Not readable? <b>Change text.</b></a><br/><br/>
    
    
	<?php 
		
	//echo load_simple_captcha();
	///===for hard cpatcha
	//echo load_captcha(); ?>
        </td>
        
     <td>
 <input type="text" name="captcha"  value="" /><br />
(Security code is case-sensitive.)
        </td></tr>
    
    
    <?php } ?>
      
      
       <tr><td colspan="2" height="2">&nbsp;</td></tr>
      
       <tr>
      	<td colspan="2"><div id="mbs" ><input type="checkbox" name="agree" id="agree" value="1" />&nbsp;Clicking "Sign Up" acknowledges that you have read and agree to the <?php echo anchor('content/terms_of_use','terms of use', 'id="terms"');?></div></td>
       </tr>
    
      
      
      <tr>
        <td></td>
        <td>
        <input type="hidden" name="register" value="register" id="register" />
        
        <input type="hidden" name="fb_id" value="<?php echo $fb_id; ?>" id="fb_id" />
         <input type="hidden" name="tw_id" value="<?php echo $tw_id; ?>" id="tw_id" />
          <input type="hidden" name="tw_screen_name" value="<?php echo $tw_screen_name; ?>" id="tw_screen_name" />
          <input type="hidden" name="fb_img" id="fb_img" value="<?php echo $fb_img; ?>" />
          <input type="hidden" name="twiter_img" id="twiter_img" value="<?php echo $twiter_img; ?>" />
       
        
        <input type="submit" value="Sign Up" class="submbg2" name="sign_up" id="sign_up">
       </td>
      </tr>
     
     
    </table>
        </fieldset>
       </form>
      
        <div class="clear"></div>
        
    </div>
    
    <div class="runlright">
        
        <fieldset>
     	<table width="80%" border="0" cellspacing="1" cellpadding="5" style="float:right;">
     		 <tr id="forgetEmailTR">
      			<td>
                <?php 	if($tw_screen_name!='' && $tw_id>0) { ?>
	
	<img src="http://api.twitter.com/1/users/profile_image?screen_name=<?php echo $tw_screen_name; ?>&size=bigger" border="0" width="150" height="150" style="padding:2px; border:1px solid #E1E1E1;" />
	
	
	<?php } elseif($fb_id!='' && $fb_id>0) { ?>
	
	
	<img src="http://graph.facebook.com/<?php echo $fb_id; ?>/picture?type=large" border="0" width="150" height="150" style="padding:2px; border:1px solid #E1E1E1;" />
	
	
	<?php } ?>
                
                </td>
     		 </tr>
    	</table>
        </fieldset>
  	
									
    </form>
    
    
                                    
                                    
    </div>
    
    

    <div class="clear"></div>
 
 



    </div>

</div>


<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/validation.js"></script>
