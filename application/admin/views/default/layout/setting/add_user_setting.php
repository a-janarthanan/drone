<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">User Setting</h2> 
			<div class="box-content">
			
			  <?php
				$attributes = array('name'=>'frm_user_setting');
				echo form_open('user_setting/add_user_setting',$attributes);
				
				
			  ?>
			  
			  	  <label class="form-label">Sign Up Auto Active </label>
                  
				  <select name="sign_up_auto_active" id="sign_up_auto_active" class="form-field settingselectbox required" >
						<option value="0" <?php if($sign_up_auto_active  == 0){ ?> selected="selected" <?php } ?>> No</option>
						<option value="1" <?php if($sign_up_auto_active  == 1){ ?> selected="selected" <?php } ?>> Yes</option>	 	  				 												
				  </select>
				  
				  <label class="form-label">User Task Auto Active </label>
				 <select name="user_task_auto_active" id="user_task_auto_active" class="form-field settingselectbox required">
						<option value="0" <?php if($user_task_auto_active  == 0){ ?> selected="selected" <?php } ?>> No</option>
						<option value="1" <?php if($user_task_auto_active  == 1){ ?> selected="selected" <?php } ?>> Yes</option>	 	  				 												
				  </select>
                  
                  <label class="form-label">No Task After Auto Active </label>
				  <input type="text" name="no_task_after_auto_active" id="no_task_after_auto_active" class="form-field width40" value="<?php echo $no_task_after_auto_active;?>" />
                  
                  <label class="form-label">Days of Delete User login Delete</label>
				  <input type="text" name="delete_user_login_day" id="delete_user_login_day" class="form-field width40" value="<?php echo $delete_user_login_day;?>" />
                  
                   <label class="form-label">Days of Delete Admin login Delete</label>
				  <input type="text" name="delete_admin_login_day" id="delete_admin_login_day" class="form-field width40" value="<?php echo $delete_admin_login_day;?>" />
				  									
				
				  <label class="form-label">&nbsp;</label>
				  <input type="hidden" name="user_setting_id" id="user_setting_id" value="<?php echo $user_setting_id; ?>" />
                  <input type="submit" class="button themed" name="submit" value="Update" />
				  
			  </form>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>