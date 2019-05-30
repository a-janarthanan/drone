<div id="content" align="center">

 	<?php  
		if($error != "") {
			
			if($error == 'insert') {
				echo '<div class="column full"><span class="message information"><strong>Record has been updated Successfully.</strong></span></div>';
			}
		
			if($error != "insert"){	
				echo '<div class="column full"><span class="message information"><strong>'.$error.'</strong></span></div>';	
			}
		}
	?>		

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header"><?php if($admin_id==""){ echo 'Add Admin'; } else { echo 'Edit Admin'; }?> </h2> 
			<div class="box-content">	
			  <?php
				$attributes = array('name'=>'frm_addadmin');
				echo form_open('admin/add_admin',$attributes);
			  ?>					
				  <label class="form-label">Email </label> 
				  <input type="text" name="email" id="email" value="<?php echo $email; ?>" class="form-field width40"/>
									
				  <label class="form-label">Username </label>
                  <input type="text" name="username" id="username" value="<?php echo $username; ?>" class="form-field width40" style="width:39%;padding: 2px 0 2px 5px;"/>
                   
                  <label class="form-label">Password </label>
                  <input type="password" name="password" id="password" value="<?php echo $password; ?>" class="form-field width40" style="width:39%;padding: 2px 0 2px 5px;"/> 
                  
                 
                  <label class="form-label">Admin Type </label>
                   <select name="admin_type" id="admin_type" class="form-field settingselectbox required">
                        <option value="1" <?php if($admin_type=='1'){ echo "selected"; } ?>>Super Administrator</option>
                        <option value="2" <?php if($admin_type=='2'){ echo "selected"; } ?>>Administrator</option>														
                  </select>
                 
                     
                  <label class="form-label">Status </label> 
                  <select name="active" id="active" class="form-field settingselectbox required">
                        <option value="0" <?php if($active=='0'){ echo "selected"; } ?>>Inactive</option>
                        <option value="1" <?php if($active=='1'){ echo "selected"; } ?>>Active</option>														
                  </select>
                  
                  
                  
				   <label class="form-label">&nbsp;</label> 
                   
                   <input type="hidden" name="admin_id" id="admin_id" value="<?php echo $admin_id; ?>" />
				   <input type="hidden" name="offset" id="offset" value="<?php //echo $offset; ?>" />

                    <?php if($admin_id==""){ ?>
						<input type="submit" name="submit" value="Submit" class="button themed" />
					<?php }else { ?>
						<input type="submit" name="submit" value="Update" class="button themed" onclick=""/>
					<?php } ?>
                  
                   <input type="button" name="cancel" value="Cancel" class="button themed" onClick="location.href='<?php echo base_url(); ?>admin/list_admin'"/>  
				  
			  </form>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>