<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">Meta Settings </h2> 
			<div class="box-content">	
			  <?php
				$attributes = array('name'=>'frm_meta_setting');
				echo form_open('meta_setting/add_meta_setting',$attributes);
			  ?>					
				  <label class="form-label">Title </label> 
				  <input type="text" name="title" id="title" value="<?php echo $title; ?>" class="form-field width40"/>
									
				  <label class="form-label">Meta Keyword</label> 
				  <input type="text" name="meta_keyword" id="meta_keyword" value="<?php echo $meta_keyword; ?>" class="form-field width40"/>
				  
				  <label class="form-label">Meta Description </label>
				  <textarea class="form-field small" name="meta_description" cols="" rows="" id="meta_description"><?php echo $meta_description; ?></textarea>

				  <input type="hidden" name="meta_setting_id" id="meta_setting_id" value="<?php echo $meta_setting_id; ?>" />
				  <input type="submit" class="button themed" name="submit" value="Update" onclick=""/>
				  
			  </form>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>