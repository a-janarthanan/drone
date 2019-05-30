<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">Facebook Settings </h2> 
			<div class="box-content">	
			  <?php
				$attributes = array('name'=>'frm_facebook_setting');
				echo form_open('facebook_setting/add_facebook_setting',$attributes);
			  ?>
			  
			  	  <label class="form-label">Facebook Login Enable </label>
				  <select name="facebook_login_enable" id="facebook_login_enable" class="form-field settingselectbox required">
				  	<option value="0" <?php if($facebook_login_enable == '0'){	echo 'selected="selected"';	} ?> >No</option>
					<option value="1" <?php if($facebook_login_enable == '1'){	echo 'selected="selected"';	} ?>>Yes</option>
				  </select>
				  					
				  <label class="form-label">Facebook Profile Full URL </label> 
				  <textarea class="form-field small" name="facebook_url" cols="" rows="" id="facebook_url"><?php echo $facebook_url; ?></textarea>
									
				  <label class="form-label">Facebook Application ID </label> 
				  <input type="text" name="facebook_application_id" id="facebook_application_id" value="<?php echo $facebook_application_id; ?>" class="form-field width40"/>
				  
				  <label class="form-label">Facebook Application API Key </label> 
				  <input type="text" name="facebook_api_key" id="facebook_api_key" value="<?php echo $facebook_api_key; ?>" class="form-field width40"/>
				  
				  <label class="form-label">Facebook Application Secret Key </label> 
				  <input type="text" name="facebook_secret_key" id="facebook_secret_key" value="<?php echo $facebook_secret_key; ?>" class="form-field width40"/>
				  
				  <label class="form-label">&nbsp;</label> 
				  <input type="hidden" name="facebook_setting_id" id="facebook_setting_id" value="<?php echo $facebook_setting_id; ?>" />
				  <input type="submit" class="button themed" name="submit" value="Update" onclick=""/>
				  
			  </form>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>