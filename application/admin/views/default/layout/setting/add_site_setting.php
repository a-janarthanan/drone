<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">Site Settings </h2> 
			<div class="box-content">
			
			  <?php
				$attributes = array('name'=>'frm_site_setting');
				echo form_open_multipart('site_setting/add_site_setting',$attributes);
			  ?>
			  
			  	  <label class="form-label">Site Online </label>
				  <select name="site_online" id="site_online" class="form-field settingselectbox required" >
						<option value="0" <?php if($site_online == 0){ ?> selected="selected" <?php } ?>> No</option>
						<option value="1" <?php if($site_online == 1){ ?> selected="selected" <?php } ?>> Yes</option>	 	  				 												
				  </select>
				  
				  <label class="form-label">Captcha Enable </label>
				  <select name="captcha_enable" id="captcha_enable" class="form-field settingselectbox required">
						<option value="0" <?php if($captcha_enable == 0){ ?> selected="selected" <?php } ?>> No</option>
						<option value="1" <?php if($captcha_enable == 1){ ?> selected="selected" <?php } ?>> Yes</option>	 	  				 												
				  </select>	
				  									
				  <label class="form-label">Site Name </label> 
				  <input type="text" name="site_name" id="site_name" value="<?php echo $site_name; ?>" class="form-field width40"/>
									
				  <label class="form-label">Site Version</label> 
				  <input type="text" name="site_version" id="site_version" value="<?php echo $site_version; ?>" class="form-field width40" readonly="readonly"/>
				  
                  
                  
                   <label class="form-label">Google Map Key</label> 
				  <input type="text" name="google_map_key" id="google_map_key" value="<?php echo $google_map_key; ?>" class="form-field width40" />(Global Key : AIzaSyAx8RrOtiJweQsoLetdJG_Q0kDXjy1TnnY) 
                  
                  
                   <label class="form-label">Default Latitude</label> 
				  <input type="text" name="default_latitude" id="default_latitude" value="<?php echo $default_latitude; ?>" class="form-field width40" />(Latitude : 43.652527) 
                  
                  
                   <label class="form-label">Default Longitude</label> 
				  <input type="text" name="default_longitude" id="default_longitude" value="<?php echo $default_longitude; ?>" class="form-field width40" />(Longitude : -79.381961) 
                  
                  
                  
				  <!--<label class="form-label">Site Language</label>
				  <select name="currency_code" id="currency_code" class="form-field settingselectbox required">
						<?php
							if($language)
							{
								foreach($language as $lan)
								{
						  ?>
							<option value="<?php echo $lan->language_id; ?>" <?php if($lan->language_id == $site_language){ ?> selected="selected" <?php } ?>><?php echo $lan->language_name; ?></option>
						  <?php
								}
							}
						  ?>		  				 												  	
				  </select>-->
				  
				  <label class="form-label">Currency Code</label>
				  <select name="currency_code" id="currency_code" class="form-field settingselectbox required">
						<?php
							if($currency)
							{
								foreach($currency as $cur)
								{
						  ?>
							<option value="<?php echo $cur->currency_code; ?>" <?php if($cur->currency_code == $currency_code){ ?> selected="selected" <?php } ?>><?php echo $cur->currency_name.'&nbsp;-&nbsp;'.$cur->currency_code.'&nbsp;-&nbsp;'.$cur->currency_symbol; ?></option>
						  <?php
								}
							}
						  ?>		  				 												  	
				  </select>

				  <label class="form-label">Date Format</label>
				 <!-- <input type="text" name="date_format" id="date_format" value="<?php echo $date_format; ?>" class="form-field width40"/>-->
                  <select name="date_format" id="date_format" class="form-field settingselectbox required">
                      <option value='d M,Y' <?php if($date_format == 'd M,Y') { echo 'selected="selected"'; } ?>>d M,Y</option>
                      <option value='Y-m-d' <?php if($date_format == 'Y-m-d') { echo 'selected="selected"'; } ?>>Y-m-d</option>  
                      <option value='m-d-Y' <?php if($date_format == 'm-d-Y') { echo 'selected="selected"'; } ?>>m-d-Y</option> 
                      <option value='d-m-Y' <?php if($date_format == 'd-m-Y') { echo 'selected="selected"'; } ?>>d-m-Y</option>
                      <option value='Y/m/d' <?php if($date_format == 'Y/m/d') { echo 'selected="selected"'; } ?>>Y/m/d</option> 
                      <option value='m/d/Y' <?php if($date_format == 'm/d/Y') { echo 'selected="selected"'; } ?>>m/d/Y</option>
                      <option value='d/m/Y' <?php if($date_format == 'd/m/Y') { echo 'selected="selected"'; } ?>>d/m/Y</option> 
                  </select>
                  
				  
				  <label class="form-label">Time Format</label>
				  <!--<input type="text" name="time_format" id="time_format" value="<?php echo $time_format; ?>" class="form-field width40"/>-->
                  <select name="time_format" id="time_format" class="form-field settingselectbox required">
                     
                      <option value='H:i a' <?php if($time_format == 'H:i a') { echo 'selected="selected"'; } ?>>H:i a</option>
                      <option value='H:i:s a' <?php if($time_format == 'H:i:s a') { echo 'selected="selected"'; } ?>>H:i:s a</option>  
                      <option value='h:i:s a' <?php if($time_format == 'h:i:s a') { echo 'selected="selected"'; } ?>>h:i:s a</option>
                     <!-- <option value='H:i' <?php if($time_format == 'H:i') { echo 'selected="selected"'; } ?>>H:i</option>
                      <option value='H:i:s' <?php if($time_format == 'H:i:s') { echo 'selected="selected"'; } ?>>H:i:s</option> 
                      <option value='h:i:s' <?php if($time_format == 'h:i:s') { echo 'selected="selected"'; } ?>>h:i:s</option>-->    
                  </select>
                  
                  <label class="form-label">Date Time Format</label>
				 <!-- <input type="text" name="date_format" id="date_format" value="<?php echo $date_format; ?>" class="form-field width40"/>-->
                  <select name="date_time_format" id="date_time_format" class="form-field settingselectbox required">
                      <option value='d M,Y H:i a' <?php if($date_time_format == 'd M,Y H:i a') { echo 'selected="selected"'; } ?>>d M,Y H:i a</option>
                      <option value='d M,Y H:i:s a' <?php if($date_time_format == 'd M,Y H:i:s a') { echo 'selected="selected"'; } ?>>d M,Y H:i:s a</option>
                      <option value='d M,Y h:i:s a' <?php if($date_time_format == 'd M,Y h:i:s a') { echo 'selected="selected"'; } ?>>d M,Y h:i:s a</option>
                      
                      <option value='Y-m-d H:i a' <?php if($date_time_format == 'Y-m-d H:i a') { echo 'selected="selected"'; } ?>>Y-m-d H:i a</option> 
                      <option value='Y-m-d H:i:s a' <?php if($date_time_format == 'Y-m-d H:i:s a') { echo 'selected="selected"'; } ?>>Y-m-d H:i:s a</option>
                      <option value='Y-m-d h:i:s a' <?php if($date_time_format == 'Y-m-d h:i:s a') { echo 'selected="selected"'; } ?>>Y-m-d h:i:s a</option>
 
                      <option value='m-d-Y H:i a' <?php if($date_time_format == 'm-d-Y H:i a') { echo 'selected="selected"'; } ?>>m-d-Y H:i a</option> 
                      <option value='m-d-Y H:i:s a' <?php if($date_time_format == 'm-d-Y H:i:s a') { echo 'selected="selected"'; } ?>>m-d-Y H:i:s a</option> 
                      <option value='m-d-Y h:i:s a' <?php if($date_time_format == 'm-d-Y h:i:s a') { echo 'selected="selected"'; } ?>>m-d-Y h:i:s a</option> 
  
                      <option value='d-m-Y H:i a' <?php if($date_time_format == 'd-m-Y H:i a') { echo 'selected="selected"'; } ?>>d-m-Y H:i a</option> 
                      <option value='d-m-Y H:i:s a' <?php if($date_time_format == 'd-m-Y H:i:s a') { echo 'selected="selected"'; } ?>>d-m-Y H:i:s a</option> 
                      <option value='d-m-Y h:i:s a' <?php if($date_time_format == 'd-m-Y h:i:s a') { echo 'selected="selected"'; } ?>>d-m-Y h:i:s a</option>
                      
                      <option value='Y/m/d H:i a' <?php if($date_time_format == 'Y/m/d H:i a') { echo 'selected="selected"'; } ?>>Y/m/d H:i a</option> 
                      <option value='Y/m/d H:i:s a' <?php if($date_time_format == 'Y/m/d H:i:s a') { echo 'selected="selected"'; } ?>>Y/m/d H:i:s a</option> 
                      <option value='Y/m/d h:i:s a' <?php if($date_time_format == 'Y/m/d h:i:s a') { echo 'selected="selected"'; } ?>>Y/m/d h:i:s a</option>
                       
                      <option value='m/d/Y H:i a' <?php if($date_time_format == 'm/d/Y H:i a') { echo 'selected="selected"'; } ?>>m/d/Y H:i a</option> 
                      <option value='m/d/Y H:i:s a' <?php if($date_time_format == 'm/d/Y H:i:s a') { echo 'selected="selected"'; } ?>>m/d/Y H:i:s a</option> 
                      <option value='m/d/Y h:i:s a' <?php if($date_time_format == 'm/d/Y h:i:s a') { echo 'selected="selected"'; } ?>>m/d/Y h:i:s a</option>
                      
                      <option value='d/m/Y H:i a' <?php if($date_time_format == 'd/m/Y H:i a') { echo 'selected="selected"'; } ?>>d/m/Y H:i a</option> 
                      <option value='d/m/Y H:i:s a' <?php if($date_time_format == 'd/m/Y H:i:s a') { echo 'selected="selected"'; } ?>>d/m/Y H:i:s a</option> 
                      <option value='d/m/Y h:i:s a' <?php if($date_time_format == 'd/m/Y h:i:s a') { echo 'selected="selected"'; } ?>>d/m/Y h:i:s a</option>
                       
                  </select>
				  
				  <label class="form-label">Google Analytics Code</label>
				  <input type="text" name="site_tracker" id="site_tracker" value="<?php echo $site_tracker; ?>" class="form-field width40"/>(Ex :: UA-1245878513-1)
				  
				 <!-- <label class="form-label">How Its Work Video</label>
				  <input type="file" name="how_it_works_video" id="how_it_works_video" value="<?php echo $how_it_works_video; ?>"  size="27px"/>
				  
				  <label class="form-label">&nbsp;</label>
				  <label class="form-label">Zipcode Manimum</label>
				  <input type="text" name="zipcode_min" id="zipcode_min" value="<?php echo $zipcode_min; ?>" class="form-field width40"/>
				  
				   <label class="form-label">Zipcode Maximum</label>
				  <input type="text" name="zipcode_max" id="zipcode_max" value="<?php echo $zipcode_max; ?>" class="form-field width40"/>
                  -->
                  <label class="form-label">TimeZone</label>
                   <select name="site_timezone" id="site_timezone" class="form-field settingselectbox required">
						<?php $timezones = get_timezone();
							if($timezones)
							{
								foreach($timezones as $timezone)
								{
						  ?>
							<option value="<?php echo $timezone->timezone; ?>" <?php if($timezone->timezone == $site_timezone){ ?> selected="selected" <?php } ?>><?php echo $timezone->timezone; ?></option>
						  <?php
								}
							}
						  ?>		  				 												  	
				  </select>
<!--<label class="form-label">Subscription Price</label>
				  <input type="text" name="subscription_price" id="subscription_price" value="<?php echo $subscription_price; ?>" class="form-field width40"/>
                  
                  <label class="form-label">Subscription Time</label>
				  <input type="text" name="subscription_time" id="subscription_time" value="<?php echo $subscription_time; ?>" class="form-field width40"/>
                  -->
                  <label class="form-label">Transaction need Yes/No</label>
				  <input type="radio" name="subscription_need" id="subscription_need" value="0" class="form-field" <?php if($subscription_need==0)  { ?>checked="checked" <?php } ?>/>No
                  <input type="radio" name="subscription_need" id="subscription_need" value="1" class="form-field" <?php if($subscription_need==1)  { ?>checked="checked" <?php } ?>/>Yes

                  <label class="form-label">Credit need Yes/No</label>
				  <input type="radio" name="credit_need" id="credit_need" value="0" class="form-field" <?php if($credit_need==0)  { ?>checked="checked" <?php } ?>/>No
                  <input type="radio" name="credit_need" id="credit_need" value="1" class="form-field" <?php if($credit_need==1)  { ?>checked="checked" <?php } ?>/>Yes

				  <label class="form-label">&nbsp;</label>
				  <input type="hidden" name="site_setting_id" id="site_setting_id" value="<?php echo $site_setting_id; ?>" />

				  <input type="submit" class="button themed" name="submit" value="Update" onclick=""/>
				  
			  </form>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>