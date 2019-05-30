<?php

	$data = array(
		'facebook'		=> $this->fb_connect->fb,
		'fbSession'		=> $this->fb_connect->fbSession,
		'user'			=> $this->fb_connect->user,
		'uid'			=> $this->fb_connect->user_id,
		'fbLogoutURL'	=> $this->fb_connect->fbLogoutURL,
		'fbLoginURL'	=> $this->fb_connect->fbLoginURL,	
		'base_url'		=> site_url('home/facebook'),
		'appkey'		=> $this->fb_connect->appkey,
	);
	//var_dump($data);
?>

<script type="text/javascript">
			jQuery(function($) {
			
			jQuery("#terms").fancybox();
	
	
		
					
			});
		</script>
		
<div>	
<div class="page-title">
<h1 class="mleft15">Login / Signup</h1>
</div>		
<div class="social-ph">
 <label class="blue-label">Connect Using:</label>   	
    	<?php  $t_setting = twitter_setting();	
            
               $f_setting = facebook_setting();	

			   if($f_setting->facebook_login_enable == '1' ||  $t_setting->twitter_login_enable == '1') { ?>
               
               
               
       	
			
                
           
           <?php	if($f_setting->facebook_login_enable == '1'){ ?>
             
      <?php /*?>   <a href="<?php echo $data['fbLoginURL']; ?>" class="fbtn"> <img alt="Facebook-16x16" src="<?php echo base_url().getThemeName(); ?>/images/fb.png" class="marB_3 marR5" />Connect to Facebook</a><?php */?>
         
         <?php echo anchor($data['fbLoginURL'],'<img src="'.base_url().getThemeName().'/images/fb_sign.png"  alt="" name="sign_fb" onmouseover="this.src=\''.base_url().getThemeName().'/images/fb_sign_hover.png\'" onmouseout="this.src=\''.base_url().getThemeName().'/images/fb_sign.png\'" />'); ?>
         
         
         
        <?php }   if($t_setting->twitter_login_enable == '1'){  ?>
            
           <?php echo anchor('home/twitter_auth','<img src="'.base_url().getThemeName().'/images/tw_sign.png"  alt="" name="sign_tw" onmouseover="this.src=\''.base_url().getThemeName().'/images/tw_sign_hover.png\'" onmouseout="this.src=\''.base_url().getThemeName().'/images/tw_sign.png\'" />'); ?>
            
            <?php } ?>
         
              <!--  <div id="ib" ><b>Shortcut:</b> Use Facebook Connect to skip the sign up form!</div>-->
                <div class="clear"></div>
                
    		</div>
       <?php } ?>
</div>       
<div style="float:left; width:100%; margin:15px 0">       
            
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
		echo form_open('sign_up',$attributes);
	?>
   
        <fieldset>
         
        
            <table width="100%" border="0" cellspacing="0" cellpadding="5" class="fr">
    
            
      <tr id="full_nameTR">
        <td width="28%" valign="top"><label id="silb" >Full Name *</label></td>
        <td width="72%"><input type="text" name="full_name" id="full_name" value="<?php echo $full_name; ?>"  class="ntext"  /><br />
         <span id="full_nameInfo" style="height:5px;"></span>
        </td>
      </tr>
      <tr><td height="15px" colspan="2"></td></tr>
      <tr id="zip_codeTR">
        <td valign="top"><label id="silb" >Postal Code *</label></td>
        <td><input type="text" name="zip_code" id="zip_code" value="<?php if($this->input->post('zip_code')!="") { echo $this->input->post('zip_code'); } else{ echo $zip_code; } ?>"  class="ntext"  /><br />
        
        <span id="zip_codeInfo"></span>
         </td>
      </tr>
      <tr><td height="15px" colspan="2"></td></tr>
      
      <tr id="mobile_noTR">
        <td valign="top"><label id="silb">Mobile No.</label></td>
        <td><input type="text" name="mobile_no" id="mobile_no" value="<?php echo $mobile_no; ?>"  class="ntext"  /><br />
        <span id="mobile_noInfo"></span>

        </td>
      </tr>
      <tr><td height="15px" colspan="2"></td></tr>
    
      <tr id="emailTR">
        <td valign="top"><label id="silb">Email *</label></td>
        <td><input type="text" name="email" id="email" value="<?php if($this->input->post('email')!="") { echo $this->input->post('email'); } else{ echo $email; }?>"  class="ntext"  /><br />
        <span id="emailInfo"></span></td>
      </tr>
      
      <tr><td height="15px" colspan="2"></td></tr>
      <tr id="passwordTR">
        <td valign="top"><label  id="silb">Password</label></td>
        <td><input type="password" name="password" id="password" value="<?php echo $password; ?>"  class="ntext"  /><br />

       <span id="passwordInfo"></span>
        </td>
      </tr>
      <tr><td height="15px" colspan="2"></td></tr>
  	
    <?php	





$site_setting=site_setting();

	if($site_setting->captcha_enable==1) { ?>
    
      <tr>
         		<td> <?php dsp_crypt(0,1); ?></td>    
        		<td> <input type="text" name="captcha"  value="" /><br />(Security code is case-sensitive.)</td>
     	</tr>
    
    
    <?php } ?>
      
   <tr><td colspan="2" height="2">&nbsp;</td></tr>
   
      <tr>
		<td>&nbsp;</td>
      	<td lign="left"><div id="mbs" ><input type="checkbox" name="agree" id="agree" value="1" />&nbsp;<span class="gen-txt">I agree with the&nbsp;<?php echo anchor('content/terms_of_use','terms of use', 'id="terms"');?></span></div></td>
       </tr>
        <tr><td colspan="2" height="2">&nbsp;</td></tr>
     <!-- <tr>
        <td colspan="2" id="acJ"  >Already have an account? <span>Log In</span></td>
      </tr>-->
      
         <tr>
        <td></td>
        <td>
        <input type="hidden" name="register" value="register" id="register" />
        <input type="submit" value="Sign Up" class="submbg2" name="sign_up" id="sign_up">
       </td>
      </tr>
     
    </table>
        </fieldset>
       </form>
      
        <div class="clear"></div>
        
    </div>
    
    
    
    
    <div class="runlright">
  
  
 <h3 id="detail-bg1">Log In</h3>  
 
 

	<?php if($this->input->post('clogin')) {  if($error!='') { ?>
				<div id="error">
					<ul>
					
						<?php  echo $error; ?>
					
					</ul>
				</div>
			
		<?php } } ?>

	<?php if($msg!='') { if($msg=='login') { ?><div class="error" align="center"><p>You must have to Login or Sign Up for creating Task.</p></div><?php } if($msg=='fail') { ?><div class="error" align="center"><p>Sorry,Internal System Error. Please Try Again.</p></div><?php } } ?>



<script type="text/javascript">
function show_form(id1,id2)
{
	
	document.getElementById(id1).style.display = "block";
	document.getElementById(id2).style.display = "none";
	
}
</script>



		<?php
            if($view == "cforget")
            {
                $attributes = array('name'=>'loginForm','id'=>'loginForm','style'=>'display:none;');
            }else{
                $attributes = array('name'=>'loginForm','id'=>'loginForm','class'=>'form_design');
            }
            echo form_open('sign_up',$attributes);
        ?>
                                
  
    
        <fieldset>
            <table width="100%" border="0" cellspacing="0" cellpadding="5" style="float:right;">
      <tr id="loginEmailTR">
        <td width="18%"><label  id="silb" >Email</label></td>
        <td width="82%"><input type="text" name="login_email" id="login_email" value="<?php echo $login_email; ?>" class="ntext"   /><br />
        <span id="loginemailInfo"></span></td>
      </tr>
	  <tr><td height="15px" colspan="2"></td></tr>
      <tr id="loginPasswordTR">
        <td><label  id="silb" >Password</label></td>
        <td><input type="password" name="login_password" id="login_password" value="<?php echo $login_password; ?>"  class="ntext" /><br />
        <span id="loginPasswordInfo"></span>
        </td>
      </tr>
	  <tr><td height="15px" colspan="2"></td></tr>
      <tr>
        <td colspan="2">
		<span class="gen-txt" style="margin:0 0 0 80px"><a href="javascript:" onclick="show_form('forgetForm','loginForm')" >Forgot Password </a></span>
        
		
		</td>
	  </tr>
	  <tr><td height="5px" colspan="2"></td></tr>
	  <tr>
        <td></td>
        <td>
		<label>
		<input type="checkbox" name="remember" value="1" id="remember">
		Remember me on this computer.    
		</label>
		</td>
      </tr>
      <tr><td height="15px" colspan="2"></td></tr>
      <tr>
      	<td></td>
        	<input type="hidden" name="clogin" value="clogin" id="clogin" />
        <td style="padding-left: 100px;"> <input type="submit" value="Log In" class="submbg1" name="loginbtn" id="loginbtn"></td>
      </tr>
    </table>
        </fieldset>
  
									
    </form>
    
    
    <?php
        if($view == "cforget")
        {
            $attributes = array('name'=>'forgetForm','id'=>'forgetForm','class'=>'form_design');
        }else{
            $attributes = array('name'=>'forgetForm','id'=>'forgetForm','style'=>'display:none;');
        }
        echo form_open_multipart('sign_up',$attributes);
    ?>
                                    
                                    
    <?php if($this->input->post('cforget')) {  if($error!='') { ?>
				<div id="error">
					<ul>
					
						<?php  echo $error; ?>
					
					</ul>
				</div>
			
		<?php } } ?>
        
        
        <fieldset>
            <table width="100%" border="0" cellspacing="1" cellpadding="5" style="float:right;">
      <tr id="forgetEmailTR">
        <td width="18%"><label  id="silb" >Email</label></td>
       <td width="82%"><input type="text" name="forget_email" id="forget_email" value="" class="ntext"   /><br />
        <span id="forgetEmailInfo"></span></td>
      </tr>
     <tr>
      	<td></td>
        <td><span class="gen-txt"><a href="javascript:" onclick="show_form('loginForm','forgetForm')" >Back To Login </a></span></td>
      </tr>
	  <tr><td height="15px" colspan="2"></td></tr>
      <tr>
      	<td></td>
        <input type="hidden" name="cforget" value="cforget" id="cforget" />
        <td> <input type="submit" value="Send" class="submbg2" name="forgetbtn" id="forgetbtn"></td>
      </tr>
    </table>
        </fieldset>
  	
									
    </form>
    
    
                                    
                                    
    </div>
    <div class="clear"></div>
 
 



    </div>

</div>


	<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/validation.js"></script>
