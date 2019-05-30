<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">Twitter Settings </h2> 
			<div class="box-content">	
			  <?php
				$attributes = array('name'=>'frm_twitter_setting');
				echo form_open('twitter_setting/add_twitter_setting',$attributes);
			  ?>
			  
			  	  <label class="form-label">Twitter Login Enabled </label>
				  <select name="twitter_login_enable" id="twitter_login_enable" class="form-field settingselectbox required">
				  	<option value="0" <?php if($twitter_login_enable == '0'){	echo 'selected="selected"';	} ?> >No</option>
					<option value="1" <?php if($twitter_login_enable == '1'){	echo 'selected="selected"';	} ?>>Yes</option>
				  </select>
				  					
				  <label class="form-label">Twitter Profile Full URL </label> 
				  <textarea class="form-field small" name="twitter_url" cols="" rows="" id="twitter_url"><?php echo $twitter_url; ?></textarea>
									
				  <label class="form-label">Consumer Key </label> 
				  <input type="text" name="consumer_key" id="consumer_key" value="<?php echo $consumer_key; ?>" class="form-field width40"/>
				  
				  <label class="form-label">Consumer Secret  </label> 
				  <input type="text" name="consumer_secret" id="consumer_secret" value="<?php echo $consumer_secret; ?>" class="form-field width40"/>
				  
				  <label class="form-label">&nbsp;</label> 
				  <input type="hidden" name="twitter_setting_id" id="twitter_setting_id" value="<?php echo $twitter_setting_id; ?>" />
				  <input type="submit" class="button themed" name="submit" value="Update" onclick=""/>
				  
			  </form>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>