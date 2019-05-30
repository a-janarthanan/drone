<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">Image Size Settings </h2> 
			<div class="box-content">	
			  <?php
				$attributes = array('name'=>'frm_site_setting');
				echo form_open_multipart('site_setting/add_image_setting',$attributes);
			  ?>					

				  <label class="form-label">User Thumbnail Width </label>
				   <input type="text" name="user_width" id="user_width" value="<?php echo $user_width; ?>" class="form-field width40"/>
				  
				  <label class="form-label">User Thumbnail Height </label>
				  <input type="text" name="user_height" id="user_height" value="<?php echo $user_height; ?>" class="form-field width40"/>
				  
				  <label class="form-label">Category Width </label>
				  <input type="text" name="category_width" id="category_width" value="<?php echo $category_width; ?>" class="form-field width40"/>
				  
				  <label class="form-label">Category Height </label>
				  <input type="text" name="category_height" id="category_height" value="<?php echo $category_height; ?>" class="form-field width40"/>


            
				  <label class="form-label">&nbsp;</label>
				  <input type="hidden" name="image_setting_id" id="image_setting_id" value="<?php echo $image_setting_id; ?>" />
				  <input type="submit" class="button themed" name="submit" value="Update" onclick=""/>
				  
			  </form>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>