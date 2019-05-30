<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">Add Poster/Runner</h2> 
			<div class="box-content">	
			  <?php
			
				$attributes = array('name'=>'frm_add_user');
				echo form_open('user/add_user',$attributes);
			  ?>					
				  <label class="form-label">First Name </label> 
				  <input type="text" name="first_name" id="first_name" value="<?php echo $first_name; ?>" class="form-field width40"/>
									
				  <label class="form-label">Last Name </label>
                  <input type="text" name="last_name" id="last_name" value="<?php echo $last_name; ?>" class="form-field width40"/>
                   
                  <label class="form-label">Email </label>
                  <input type="text" name="email" id="email" value="<?php echo $email; ?>" class="form-field width40"/> 
                  
               
               
               <label class="form-label">Is Runner</label>
			<input type="checkbox" id="is_worker" name="is_worker" value="1" /><label class="check" for="check7"></label>
            <br />
<br />

            
               <label class="form-label">Mobile No. </label> 
                  <input type="text" name="mobile_no" id="mobile_no" value="<?php echo $mobile_no; ?>" class="form-field width40"/> 
                  
                  <label class="form-label">Phone No. </label>
                  <input type="text" name="phone_no" id="phone_no" value="<?php echo $phone_no; ?>" class="form-field width40"/>  
                  
                  
                  
              <label class="form-label">Postal Code </label>
                  <input type="text" name="zip_code" id="zip_code" value="<?php echo $zip_code; ?>" class="form-field width40"/> 
              
               
               
                <label class="form-label">User City </label>
                 <?php $city_list= city_list(); ?>
                  
                        <select name="current_city" id="current_city">
                        <?php if($city_list) { 
						
						foreach($city_list as $city) { ?>
                        
                        <option value="<?php echo $city->city_id; ?>" <?php if($city->city_id==$current_city) { ?> selected="selected" <?php } ?>><?php echo ucfirst($city->city_name); ?></option>
                        
                        <?php } } else { ?>
                        <option value="">No City</option>
                        <?php } ?>
                        </select>
                   
                 
                  <br /><br />
                
                  
                  <label class="form-label">About User </label>
                  <textarea class="form-field small" name="about_user" cols="" rows="" id="about_user"><?php echo $about_user; ?></textarea>
     
     
     
     
       
                  <label class="form-label">Status </label> 
				  <select name="user_status" id="user_status" class="form-field settingselectbox required">
				  	<option value="0" <?php if($user_status=='0'){ echo "selected"; } ?>>Inactive</option>
					<option value="1" <?php if($user_status=='1'){ echo "selected"; } ?>>Active</option>	
				  </select>
                  
				   <label class="form-label">&nbsp;</label> 
                
                   
              
				   <input type="submit" name="submit" value="Submit" class="button themed"/>
				 
                  
                   <input type="button" name="cancel" value="Cancel" class="button themed" onClick="location.href='<?php echo base_url(); ?>user/list_user'"/>  
				  
			  </form>
			
            
            
            </div>
		</div>
	</div>
	<div class="clear"></div>
</div>