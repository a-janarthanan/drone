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
// CompleteRegistration
// Track when a registration form is completed (ex. complete subscription, sign up for a service)
fbq('track', 'CompleteRegistration');
</script>
		

        <div class="cont-inner-signup">
               <div id="two-columnar-section" class="signup-main-content">
                  <div class="container">
                        <div class="inside-task">
                            <div style="visibility: visible; animation-delay: 1s; animation-name: fadeIn;" data-wow-delay="1s" class="span3 wow fadeIn animated">
                                <div class="db-rightinfo login-box-main">
                                    <div class="home-signpost-content home-signpost-content-login"> 
                                        <h1 class="social-login-title" ><b><span style="color:#ec6600">The best place </span> <span style="color:#ec6600;">for drone pilots to reach out. Sign up</span> <span style="color:#ec6600"> Now</span></b></h1>
                                        <div class="login-next">
                                        	<?php if($this->input->post('register')) { if($error!=''){  ?>
                                                <div id="error">
                                                    <ul>
                                                        <?php  echo $error; ?>
                                                    </ul>
                                                </div>
                                            <?php } } ?>
                                            <div class="form-main-box login-form-main">
                                                <?php
                                                    $attributes = array('name'=>'signupForm','id'=>'signupForm','class'=>'form_design');
                                                    echo form_open('sign_up',$attributes);
                                                ?>
                                                <fieldset>
                                                 
                                                
                                         <table width="100%" border="0" cellspacing="0" cellpadding="5" class="fr">
                                              <tr id="full_nameTR">
                                                
                                                <td width="72%" align="center">
                                                <input type="text" name="full_name" id="full_name" placeholder="First Name *" value="<?php echo $full_name; ?>"  class="ntext form-control form-control-signup icon-back1 form-control-login"  />
                                                	<span style="float:right; height:37px" id="full_name_symbol"></span><br />
													<span id="full_nameInfo"></span>
                                                </td>
                                              </tr>
                                              <tr id="last_nameTR">
                                                
                                                <td width="72%" align="center">
                                                <input type="text" name="last_name" id="last_name" placeholder="Last Name *" value="<?php echo $last_name; ?>"  class="ntext form-control form-control-signup icon-back1 form-control-login"  />
                                                  <span style="float:right; height:37px" id="last_name_symbol"></span><br />
                          <span id="last_nameInfo"></span>
                                                </td>
                                              </tr>
                                            
                                              <tr id="zip_codeTR">
                                                
                                                <td align="center"><input type="text" name="zip_code" placeholder="ARN eg. 123456789" id="zip_code"  value="<?php if($this->input->post('zip_code')!="") { echo $this->input->post('zip_code'); } else{ echo $zip_code; } ?>"  class="ntext form-control form-control-signup icon-back2 form-control-login" />
                                                	<span id="zip_code_symbol" style="float:right; height:37px;"></span><br />
                                                    <span id="zip_codeInfo"></span>
                                                 </td>
                                              </tr>
                                              
                                              <tr id="invitation_codeTR">
                                                
                                                <td align="center"><input type="text" name="invi_code" placeholder="Invitation Code" id="invi_code"  value="<?php if($this->input->post('zip_code')!="") { echo $this->input->post('invi_code'); } else{ echo $invi_code; } ?>"  class="ntext form-control form-control-signup icon-back2 form-control-login" />
                                                  <span id="invi_code_symbol" style="float:right; height:37px;"></span><br />
                                                    <span id="invi_codeInfo"></span>
                                                 </td>
                                              </tr>
                                              
                                              <tr id="mobile_noTR">
                                               
                                                <td align="center"><input type="text" name="mobile_no" placeholder="Mobile No." id="mobile_no"  value="<?php echo $mobile_no; ?>"  class="ntext form-control form-control-signup icon-back3 form-control-login"  /><span id="mobile_no_symbol" style="float:right; height:37px;"></span><br />
                                                <span id="mobile_noInfo"></span>
                                        
                                                </td>
                                              </tr>
                                              
                                            
                                              <tr id="emailTR">
                                               
                                                <td align="center"><input type="text" name="email" id="email"  placeholder="Email *"  value="<?php if($this->input->post('email')!="") { echo $this->input->post('email'); } else{ echo $email; }?>"  class="ntext form-control form-control-signup icon-back4 form-control-login"  /><span id="email_symbol" style="float:right; height:37px;"></span><br />
                                                <span id="emailInfo"></span></td>
                                              </tr>
                                              
                                              
                                              <tr id="passwordTR">
                                              
                                                <td align="center"><input type="password" name="password" id="password" placeholder="Password *" value="<?php echo $password; ?>"  class="ntext form-control form-control-signup icon-back5 form-control-login"   /><span id="password_symbol" style="float:right; height:37px;"></span><br />
                                        
                                               <span id="passwordInfo"></span>
                                                </td>
                                              </tr>
                                              <tr id="cpasswordTR">
                                              
                                                <td align="center"><input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password *" value="<?php echo $password; ?>"  class="ntext form-control form-control-signup icon-back5 form-control-login"   /><span id="cpassword_symbol" style="float:right; height:37px;"></span><br />
                                        
                                               <span id="cpasswordInfo"></span>
                                                </td>
                                              </tr>

                                              <tr id="want_detailsTR">
                                               <td>
                                                <div>
                                                  <input type="checkbox" name="person" value=""> I want to Find Jobs<br/>
                                                  <br/>
                                                  <input type="checkbox" name="person" value="">I want to Post a Job
                                                  <br/>
                                                </div>
                                                </td>
                                                </tr>
                                                </div>
                                              <?php	
                                        
                                        
                                        
                                        
                                        
                                        $site_setting=site_setting();
                                        
                                            if($site_setting->captcha_enable==1) { ?>
                                            
                                             <!-- <tr>
                                                        <td> <?php dsp_crypt(0,1); ?></td>    
                                                        <td> <input type="text" name="captcha"  value="" /><br />(Security code is case-sensitive.)</td>
                                                </tr>-->
                                            
                                            
                                            <?php } ?>
                                              <!--<tr>
                                                
                                                <td lign="center"><div id="mbs" ><input type="checkbox" name="agree" id="agree" value="1" />&nbsp;<span class="gen-txt" >I agree with the&nbsp;<?php echo anchor('content/terms_of_use','terms of use', ' style="color:#e23a37"');?></span></div></td>
                                               </tr>
                                                <tr><td colspan="2" height="2">&nbsp;</td></tr>
                                            
                                                 <tr>
                                               
                                                <td style="padding: 0 0 8px 0;">
                                                <input type="hidden" name="register" value="register" id="register" />
                                                <input type="submit" value="Sign Up" class="submbgsearch" name="sign_up" id="sign_up" style="width:150px;">
                                               </td>
                                              </tr>-->
                                              <tr>
                                                  <td class="pad-bot" style="padding-bottom:0px;">
                                                      <table cellpadding="0" cellspacing="0" width="100%">
                                                          <tr>
                                                              <td>
                                                                  <div id="mbs" class="agree-signup agree-login condition_signup">
                                                                      <input type="checkbox" value="1" id="agree" name="agree">&nbsp;<span class="gen-txt">I agree with the &nbsp;<a href="<?php echo base_url(); ?>content/terms_and_use" style="font-weight:bold;" id="terms">terms of use</a></span>
                                                                  </div>   
                                                              </td>
                                                              <td> 
                                                                  <div class="signup-btns login-btns login-btns-new pull-right">
                                                                  	  <input type="hidden" id="register" value="register" name="register">
                                                            		  <input type="submit" id="sign_up" name="sign_up" class=" btn btn-default btn-default-login btn-default-signup" value="Sign Up">  
                                                                  </div>
                                                              </td>
                                                          </tr>
                                                      </table>
                                                  </td>
                                                </tr>
                                            </table>
                                                </fieldset>
                                               	</form>
                                           </div>
                                           <!--<div class="login-right">
                                      			<div class="divider divider-2"><h2>Or</h2></div>
                                                    <div class="social-ph login-social-ph signup-social-ph">
                                                        <div class="social-login-btns" style="overflow:visible !important; ">
                                                            <?php  $t_setting = twitter_setting();  
                            									$f_setting = facebook_setting(); 
                												if($f_setting->facebook_login_enable == '1' ||  $t_setting->twitter_login_enable == '1') { ?>
                           										<?php  if($f_setting->facebook_login_enable == '1'){ ?>
                             
                      											<?php /*?>   <a href="<?php echo $data['fbLoginURL']; ?>" class="fbtn"> <img alt="Facebook-16x16" src="<?php echo base_url().getThemeName(); ?>/images/fb.png" class="marB_3 marR5" />Connect to Facebook</a><?php */?>
                                                               	<div style="float:left; width:100%; ">
                                                               		<?php echo anchor($data['fbLoginURL'],'<img src="'.base_url().getThemeName().'/images/fb_signup_btn.png"  alt="" name="sign_fb" onmouseover="this.src=\''.base_url().getThemeName().'/images/fb_signup_btn.png\'" onmouseout="this.src=\''.base_url().getThemeName().'/images/fb_signup_btn.png\'" />'); ?>
                                                               	</div>
                         
                         
                        									<?php } } ?>
                                							<div class="clear"></div>
                                						</div>
                                                    </div>
                                                <div class="clear"></div>
                                        	</div>-->
                                        </div>    
                                        <div class="clear"></div>
        							</div>
    							</div>
                            </div>
                        </div>
                  </div>
               </div>
	<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/validation_signup_neew.js"></script>
