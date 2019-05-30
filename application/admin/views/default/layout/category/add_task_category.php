<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">Category</h2> 
			<div class="box-content">
			
			  <?php
			    $attributes = array('name'=>'frm_task_category');
				echo form_open_multipart('task_category/add_task_category',$attributes);
				?>
			  <label class="form-label">Category Name </label>
			<input type="text" name="category_name" id="category_name" class="form-field width40" value="<?php echo $category_name;?>" />
			  
			  	  <label class="form-label">Parent Category </label>
                  
				  <select name="category_parent_id" id="category_parent_id" class="form-field settingselectbox required" >
						<option value="0"> -- Select one -- </option>
													  <?php
													  	foreach($all_category as $category)
														{
													  ?>
												<option value="<?php echo $category->task_category_id; ?>" <?php if($category->task_category_id == $category_parent_id 	){ echo "selected"; } ?>><?php echo $category->category_name; ?></option>
													  <?php
														}
													  ?>  				 												
				  </select>
			<label class="form-label">Category Description </label>
		    <textarea  name="category_description" cols="56" rows="4" id="category_description"><?php echo $category_description;?></textarea>
			<br />
			<label class="form-label">Category Average Price </label>
			<input type="text" name="category_average_price" id="category_average_price" class="form-field width40" value="<?php echo $category_average_price;?>" />
			
			<label class="form-label">Category Image </label>
			<input type="file" name="file_up" id="file_up" class="form-field width40" value="" />
			
			<input type="hidden" name="prev_category_image" id="prev_category_image" class="form-field width40" value="<?php echo $category_image;?>" />
         
          
          <?php if($task_category_id!="") {?>
          	<a class="lightbox" href="<?php echo front_base_url();?>upload/category_orig/<?php echo $category_image;?>" title="<?php echo $category_image;?>"><img src="<?php echo front_base_url();?>upload/category/<?php echo $category_image;?>" alt="image-gallery"/><br/><b><?php echo $category_image;?></b></a><br />
          <?php } ?>
			
		    <label class="form-label">Status </label>
				 <select name="category_status" id="category_status" class="form-field settingselectbox required">
						<option value="0" <?php if($category_status  == 0){ ?> selected="selected" <?php } ?>> Inactive</option>
						<option value="1" <?php if($category_status  == 1){ ?> selected="selected" <?php } ?>> Active</option>	 	  				 												
				  </select>
                 
				  									
				
				  <label class="form-label">&nbsp;</label>
				  <input type="hidden" name="task_category_id" id="task_category_id" value="<?php echo $task_category_id; ?>" />
                  <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
				  <?php if($task_category_id!="") {?>
				  
                   <input type="submit" class="button themed" name="submit" id="submit" value="Update" />
				  <?php } else  {?>
				   <input type="submit" class="button themed" name="submit" id="submit" value="Submits" />
				          
				  <?php }?>
			  </form>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>