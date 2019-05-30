<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->

<div>
<div>
<!--<div class="page-title mbot20">
<h1 class="mleft15">Change Password : <?php echo $user_info->email; ?></h1>
</div>-->
<div class="red-subtitle top-red-subtitle">Change Password : <?php echo $user_info->email; ?></div>
    	<div class="profile_back">
        <div class="container">
        <div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
        <div class="home-signpost-content home-signpost-content-new-section"> 
    	<div class="dbleft dbleft-main">


  <div class="padB20">
           
         
          	<div class="marB10">
            
          
  <?php if($error!=''){ ?>
				<div id="error">
					<ul>
					<?php  echo $error; ?>
					</ul>
				</div>
			<?php }  ?>
      <?php 
      $error1= $this->session->flashdata('passwordchange');
      if($error1!=''){ ?>
        <div id="error">
          <ul>
          <?php  echo $error1; ?>
          </ul>
        </div>
      <?php }  ?>      
            
 <?php
		$attributes = array('name'=>'changepasswordForm','id'=>'changepasswordForm','class'=>'form_design');
		echo form_open('change_password',$attributes);
	?>
            
            
              <fieldset>
         
        
            <table width="80%" border="0" cellspacing="0" cellpadding="5">
    <tr id="passwordTR" class="td_main">
        <td valign="top" width="15%"><label class="lab1 lab1-1">Current Password </label></td>
        <td width="72%"><input type="password" name="current_password" id="current_password" value="" class="form-control form-control-1"><br>

     
        </td>
      </tr>
	  <tr><td>&nbsp;</td></tr>
     <tr id="passwordTR" class="td_main">
        <td valign="top" width="15%"><label class="lab1 lab1-1">New Password</label></td>
        <td width="72%"><input type="password" name="password" id="password" value=""  class="form-control form-control-1"  /><br />

       <span id="passwordInfo"></span>
        </td>
      </tr>
	  <tr><td>&nbsp;</td></tr>
      <tr id="passwordTR" class="td_main">
        <td valign="top" width="15%"><label class="lab1 lab1-1">Re-Confirm Password </label></td>
        <td width="72%"><input type="password" name="confirm_password" id="confirm_password" value="" class="form-control form-control-1"><br>

      
        </td>
      </tr>
      </table>
        </fieldset>
             
			</div>           
                


<div style="text-align:center; clear:both; overflow:hidden; width:360px;" class="widthdrow_wallet">
<div style="margin:0px 0 40px 0;"><input type="submit" value="Update password" class="btn btn-default btn-default-join btn-app" name="changepasswordbtn" id="changepasswordbtn">     </div>
</div>        

            </form>   
         
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