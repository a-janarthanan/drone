<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">City</h2> 
			<div class="box-content">
			
			  <?php
				$attributes = array('name'=>'frm_city');
				echo form_open('city/add_city',$attributes);
				
				
			  ?>
               <label class="form-label">Country </label>
                 <select name="country_id" id="country_id" class="form-field settingselectbox required">
                 <option value=""> -- Select Country -- </option>
										<?php
											if($country)
											{
												foreach($country as $cnt)
												{
										?>
											<option value="<?php echo $cnt->country_id; ?>" <?php if($cnt->country_id == $country_id){ echo "selected"; } ?>><?php echo $cnt->country_name; ?></option>
										<?php
												}
											}
										?>										
									  </select>
                
                  <span id="ajaxstatelist">                           
                 <label class="form-label">State </label>
                 <select name="state_id" id="state_id" class="form-field settingselectbox required">
                 <option value=""> -- Select State -- </option>
										<?php
											if($country)
											{
												foreach($state as $cnt)
												{
										?>
											<option value="<?php echo $cnt->state_id; ?>" <?php if($cnt->state_id == $state_id){ echo "selected"; } ?>><?php echo $cnt->state_name; ?></option>
										<?php
												}
											}
										?>										
									  </select>
			 </span>
              <label class="form-label">City Name</label>
			<input type="text" name="city_name" id="city_name" class="form-field width40" value="<?php echo $city_name;?>" />
            
             <label class="form-label">City Latitude</label>
			<input type="text" name="city_latitude" id="city_latitude" class="form-field width40" value="<?php echo $city_latitude;?>" />
            
             <label class="form-label">City Longitude</label>
			<input type="text" name="city_longitude" id="city_longitude" class="form-field width40" value="<?php echo $city_longitude;?>" />
            
           
                <label class="form-label">Status </label>
                 <select name="active" id="active" class="form-field settingselectbox required">
                    <option value="0" <?php if($active=='0'){ echo "selected"; } ?>>Inactive</option>
                    <option value="1" <?php if($active=='1'){ echo "selected"; } ?>>Active</option>														
                  </select>
                  
                  <label class="form-label">TimeZone</label>
                   <select name="city_timezone" id="city_timezone" class="form-field settingselectbox required">
						<?php $timezones = get_timezone();
							if($timezones)
							{
								foreach($timezones as $timezone)
								{
						  ?>
							<option value="<?php echo $timezone->timezone; ?>" <?php if($timezone->timezone == $city_timezone){ ?> selected="selected" <?php } ?>><?php echo $timezone->timezone; ?></option>
						  <?php
								}
							}
						  ?>		  				 												  	
				  </select>
                  
                  
				 <label class="form-label">&nbsp;</label>
				   <input type="hidden" name="city_id" id="city_id" value="<?php echo $city_id; ?>" />
					<input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
					<?php
										if($state_id=="")
										{
									  ?>				  
									   <input type="submit" class="button themed" name="submit" value="Submit" />
                                       <input type="button" name="cancel" value="Cancel" class="button themed" onClick="location.href='<?php echo base_url(); ?>city/list_city'"/>
									   <?php 
									   }
									   else{?>
                                              <input type="submit" class="button themed" name="submit" value="Update" />
											  
											  
											  <?php } ?>
				  
			  </form>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>

<?php echo $site_url= base_url(); ?>
<script>
var url = '<?php echo $site_url; ?>';

	$('#country_id').change(function(){ 
		
		if(document.getElementById("ajaxstatelist"))
		{
			
				document.getElementById("ajaxstatelist").innerHTML="Loading...";
				var postdata = "";
				//alert(url+'city/statebycountry/' + $("#country_id option:selected").val());
				$.post(
				
				 url+'city/statebycountry/' + $("#country_id option:selected").val(),
				postdata,
	
				function(result){//alert(result);
	
					if(result)
					{
							document.getElementById("ajaxstatelist").innerHTML=result;
					}
				}		
				
			 );
		}
	});
</script>											