<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">State</h2> 
			<div class="box-content">
			
			  <?php
				$attributes = array('name'=>'frm_state');
				echo form_open('state/add_state',$attributes);
				
				
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
			  <label class="form-label">State Name</label>
			<input type="text" name="state_name" id="state_name" class="form-field width40" value="<?php echo $state_name;?>" />
            
           
                <label class="form-label">Status </label>
                 <select name="active" id="active" class="form-field settingselectbox required">
										<option value="0" <?php if($active=='0'){ echo "selected"; } ?>>Inactive</option>
										<option value="1" <?php if($active=='1'){ echo "selected"; } ?>>Active</option>														
									  </select>
				 <label class="form-label">&nbsp;</label>
				   <input type="hidden" name="state_id" id="state_id" value="<?php echo $state_id; ?>" />
				 <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
					<?php
										if($state_id=="")
										{
									  ?>				  
									   <input type="submit" class="button themed" name="submit" value="Submit" />
                                       <input type="button" name="cancel" value="Cancel" class="button themed" onClick="location.href='<?php echo base_url(); ?>state/list_state'"/>
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