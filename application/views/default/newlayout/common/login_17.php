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
		
<div class="body_cont">
<div class="cont-inner-signup"> 
<div id="two-columnar-section" class="login-main-content">
<div class="inside-task">
<div style="visibility: visible; animation-delay: 1s; animation-name: fadeIn;" data-wow-delay="0.1s" class="span3 wow fadeIn animated">
<div class="db-rightinfo login-box-main" >
<div class="home-signpost-content home-signpost-content-login">
<h1 class="social-login-title"><b><span style="color:#881926;">Login</span> <span style="color:#0e0f19;">to your</span> <span style="color:#881926;">account</span></b></h1>
<div class="login-next">
    	
     
  <!--<p style="
    padding-left: 251px;
    padding-top: 32px;
    <?php if($view == "cforget") { ?>display:none; <?php } ?>
"><h1 style="float:left; width:100%; padding:20px 0; text-align:center"><b>Or</b></h1></p>-->     

  
  
<!-- <h3 id="detail-bg1">Log In</h3> --> 
 
 

	<?php if($this->input->post('clogin')) {  if($error!='') { ?>
				<div id="error">
					<ul>
					
						<?php  echo $error; ?>
					
					</ul>
				</div>
			
		<?php } } ?>

	<?php if($msg!='') { if($msg=='login') { ?><div class="error" align="center"><p>You must have to Login or Sign Up for creating Job.</p></div><?php } if($msg=='fail') { ?><div class="error" align="center"><p>Sorry,Internal System Error. Please Try Again.</p></div><?php } } ?>



<script type="text/javascript">
function show_form(id1,id2)
{
	
	document.getElementById(id1).style.display = "block";
	document.getElementById(id2).style.display = "none";
	
}
</script>
<div class="form-main-box login-form-main">


		<?php
            if($view == "cforget")
            {
                $attributes = array('name'=>'loginForm','id'=>'loginForm','style'=>'display:none;');
            }else{
                $attributes = array('name'=>'loginForm','id'=>'loginForm','class'=>'form_design');
            }
            echo form_open('login',$attributes);
        ?>
                                
  
    
        <fieldset style="border:none">
            <table width="100%" border="0" cellspacing="0" cellpadding="5" style="float:right;">
      <tr id="loginEmailTR">
        
        <td width="82%" align="center"><input type="text" name="login_email" placeholder="Email" id="login_email" value="<?php echo $login_email; ?>" class="ntext form-control form-control-signup form-control-login icon-back4"/>
       <span style="float:right; " id="email_symbol"></span><br><span id="emailInfo"></span></td>
      </tr>
	  
      <tr id="loginPasswordTR">
        <td align="center" ><input type="password" name="login_password" id="login_password" placeholder="Password" value="<?php echo $login_password; ?>"  class="ntext form-control form-control-signup form-control-login icon-back5" />
        <span style="float:right; " id="password_symbol"></span><br><span id="passwordInfo"></span>
        </td>
      </tr>
      <tr>
      	<td>
        	<table cellpadding="0" cellspacing="0" width="100%">
            	<tr>
                    <td>
                        <div id="mbs" class="agree-signup agree-login">
                            <input type="checkbox" name="remember" value="1" id="remember">
                            <span class="gen-txt">Remember me</span>
                        </div>   
                    </td>
                    <td> 
                        <div class="signup-btns login-btns login-btns-new pull-right">
                            <input type="hidden" name="clogin" value="clogin" id="clogin" />
                            <input type="submit" value="Login" class="btn btn-default btn-default-login" name="loginbtn" id="loginbtn" >
                            
                        </div>
                    </td>
        		</tr>
        	</table>
        </td>
      </tr>
	  <tr>
         <td class="forgot-p">
         <div class="forgot-pa">
              <p class="forgot-title">Forgot your password ?</p>
              <p>no worries, <a onclick="show_form('forgetForm','loginForm')" href="javascript:"> click here </a> to reset your password. </p>
          </div>
          </td>
      </tr>
      <tr>
         <td>
         	<div class="forgot-pa forgot-pa-no">
              <p>Don't have an account yet ?  <a href="<?php echo base_url(); ?>sign_up">Create an account</a></p>
          </div>
          </td>
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
        echo form_open_multipart('login',$attributes);
    ?>
                                    
                                    
    <?php if($this->input->post('cforget')) {  if($error!='') { ?>
				<div id="error">
					<ul>
					
						<?php  echo $error; ?>
					
					</ul>
				</div>
			
		<?php } } ?>
        
        
        <fieldset style="border:none">
            <table width="100%" border="0" cellspacing="1" cellpadding="5" style="float:right;">
      <tr id="forgetEmailTR">
        
       <td width="82%" align="center"><input type="text" name="forget_email" id="forget_email" placeholder="Email" value="" class="ntext form-control form-control-signup form-control-login icon-back4"  />
        <span style="float:right; " id="forgetEmailInfo"></span></td>
      </tr>
      <tr>
      	<td>
        	<table cellpadding="0" cellspacing="0" width="100%">
            	<tr>
                    <td>
                        <div id="mbs" class="agree-signup agree-login">
                            <a onclick="show_form('loginForm','forgetForm')" href="javascript:">Back To Login </a>
                        </div>   
                    </td>
                    <td> 
                        <div class="signup-btns login-btns login-btns-new pull-right">
                            <input type="hidden" name="cforget" value="cforget" id="cforget" />
                            <input type="submit" value="Retrieve Password" name="forgetbtn" id="forgetbtn" class="btn btn-default btn-default-login">
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
    



<div class="login-right">
                                          <div class="divider divider-1"><h2>Or</h2></div>
                                            <div class="social-ph login-social-ph">
                                                <div class="social-login-btns" style="overflow:visible !important;">
                                                    <?php  $t_setting = twitter_setting();  
            
               $f_setting = facebook_setting(); 

         if($f_setting->facebook_login_enable == '1' ||  $t_setting->twitter_login_enable == '1') { ?>
               
               
               
        
      
                
           
           <?php  if($f_setting->facebook_login_enable == '1'){ ?>


                                                    <?php echo anchor($data['fbLoginURL'],'<img src="'.base_url().getThemeName().'/images/LoginWithFacebook.png"  alt="" name="sign_fb" onmouseover="this.src=\''.base_url().getThemeName().'/images/LoginWithFacebook.png\'" onmouseout="this.src=\''.base_url().getThemeName().'/images/LoginWithFacebook.png\'" />'); ?>
                                                    <?php } }  ?>
                                                <div class="clear"></div>
                                                
                                        </div>
                                            
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>

</div>
</div>

</div>

</div>
</div>
</div>
</div>

	<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/validation.js"></script>
