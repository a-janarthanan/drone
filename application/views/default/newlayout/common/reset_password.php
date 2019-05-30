<div>	
<!--<div class="page-title mbot20">
<h1 class="mleft15">Reset Password</h1>
</div>-->
<div class="red-subtitle" style="margin:162px 0 0 0">Reset Password</div>
<div id="two-columnar-section">
<div class="inside-task">
<div style="float:left; width:100%; margin:15px 0" class="db-rightinfo">
<div class="home-signpost-content">

 
<?php if($status=='valid') { ?>

 <div class="runlleft">
        
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
   
<form name="resetForm" id="resetForm" class="form_design" method="post" action="">
 
  <fieldset>
         
        
            <table width="80%" border="0" cellspacing="0" cellpadding="5" class="fr">
            
              <tr id="newpasswordTR">
        <td valign="top"><label  id="silb">New Password</label></td>
        <td><input type="password" name="new_password" id="new_password" value=""  class="ntext"  /><br />

       <span id="newpasswordInfo"></span>
        </td>
      </tr>
      
        <tr id="confirmpasswordTR">
        <td valign="top"><label  id="silb">Confirm Password</label></td>
        <td><input type="password" name="confirm_password" id="confirm_password" value=""  class="ntext"  /><br />

       <span id="confirmpasswordInfo"></span>
        </td>
      </tr>
      
           <tr>
        <td></td>
        <td>
        <input type="hidden" name="reset_password" value="reset_password" id="reset_password" />
        <input type="submit" value="Reset" class="submbg2 submbgsearch" name="resetbtn" id="resetbtn">
       </td>
      </tr>
     
   
    </table>
        </fieldset>
       </form>
      
        <div class="clear"></div>
        
    </div>
    

 <div class="clear"></div>

	<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/validation.js"></script>


<?php } else { ?>

<p style="color:#FF0000;">Reset password is failed either due to wrong wrong request or link is expire.Please try again.</p>


<?php } ?>


<br>
<br>
<br>

</div>
</div>
</div>