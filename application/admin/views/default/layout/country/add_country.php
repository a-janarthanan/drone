<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">Country</h2> 
			<div class="box-content">
			
			  <?php
				$attributes = array('name'=>'frm_country');
				echo form_open('country/add_country',$attributes);
				
				
			  ?>
			  <label class="form-label">Country Name</label>
			<input type="text" name="country_name" id="country_name" class="form-field width40" value="<?php echo $country_name;?>" />
            
           
                <label class="form-label">Status </label>
                 <select name="active" id="active" class="form-field settingselectbox required">
										<option value="0" <?php if($active=='0'){ echo "selected"; } ?>>Inactive</option>
										<option value="1" <?php if($active=='1'){ echo "selected"; } ?>>Active</option>														
									  </select>
				 <label class="form-label">&nbsp;</label>
				  <input type="hidden" name="country_id" id="country_id" value="<?php echo $country_id; ?>" />
										  <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
					<?php
										if($country_id=="")
										{
									  ?>				  
									   <input type="submit" class="button themed" name="submit" value="Submit" />
                                       <input type="button" name="cancel" value="Cancel" class="button themed" onClick="location.href='<?php echo base_url(); ?>country/list_country'"/>
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