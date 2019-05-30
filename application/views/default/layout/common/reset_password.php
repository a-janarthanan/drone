<div class="body_cont">
<div class="cont-inner-signup"> 
<div id="two-columnar-section" class="login-main-content">
<div class="inside-task">
<div style="visibility: visible; animation-delay: 1s; animation-name: fadeIn;" data-wow-delay="0.1s" class="span3 wow fadeIn animated">
<div class="db-rightinfo login-box-main login-box-main-reset" >
<div class="home-signpost-content home-signpost-content-login">
<h1 class="social-login-title"><b><span style="color:#ec6600;">Reset Password</span></b></h1>
<div class="login-next">
<?php if($status=='valid') { ?>
	<h3 id="detail-bg1"></h3>

	<?php if($error!='' && $error!='reset_success'){  ?>
        <div id="error">
            <ul>
            <?php  echo $error; ?>
            </ul>
        </div>
    <?php }  if($error=='reset_success'){ ?>
    
    <div id="success">
            <ul>
          <p>Password has been reset successfully. Please take a login to your account from <?php echo anchor('sign_up','Login'); ?></p>
            </ul>
        </div>
        
    <?php } ?>

<div class="form-main-box login-form-main">


		<form name="resetForm" id="resetForm" class="form_design" method="post" action="">                 
  
    
        <fieldset style="border:none">
            <table width="100%" border="0" cellspacing="0" cellpadding="5" style="float:right;">
            
            <tr id="newpasswordTR">
        <td><input type="password" name="new_password" placeholder="New Password" id="new_password" value=""  class="ntext form-control form-control-signup form-control-login icon-back5"  /><br />

       <span id="newpasswordInfo"></span>
        </td>
      </tr>
      
        <tr id="confirmpasswordTR">
        <td><input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" value=""  class="ntext form-control form-control-signup form-control-login icon-back5"  /><br />

       <span id="confirmpasswordInfo"></span>
        </td>
      </tr>
            
      
	  <tr>
      	<td>
        	<table cellpadding="0" cellspacing="0" width="100%">
            	<tr>
                    <td>
                         
                    </td>
                    <td> 
                        <div class="signup-btns login-btns login-btns-new pull-right">
                            <input type="hidden" name="reset_password" value="reset_password" id="reset_password" />
        					<input type="submit" value="Reset" class="btn btn-default btn-default-login" name="resetbtn" id="resetbtn">
                        </div>
                    </td>
        		</tr>
        	</table>
        </td>
      </tr>
    </table>
        </fieldset>
  
		<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/validation.js"></script>							
    </form>
                  
                                    
    </div>
  <?php  } else { ?>

<p style="color:#FF0000;">Reset password is failed either due to wrong wrong request or link is expire.Please try again.</p>


<?php } ?>
</div>

</div>
</div>

</div>

</div>
</div>
</div>
</div>


