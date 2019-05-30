<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">Task Settings </h2> 
			<div class="box-content">
			
			  <?php
				$attributes = array('name'=>'frm_task_setting');
				echo form_open_multipart('task_setting/add_task_setting',$attributes);
				
				
			  ?>
			  
			  	  <label class="form-label">Comment Auto Publish </label>
                  
				  <select name="comment_auto_publish" id="comment_auto_publish" class="form-field settingselectbox required" >
						<option value="0" <?php if($comment_auto_publish == 0){ ?> selected="selected" <?php } ?>> No</option>
						<option value="1" <?php if($comment_auto_publish == 1){ ?> selected="selected" <?php } ?>> Yes</option>	 	  				 												
				  </select>
				  
				  <label class="form-label">Post Task Enable </label>
				 <select name="post_task_enable" id="post_task_enable" class="form-field settingselectbox required">
						<option value="0" <?php if($post_task_enable == 0){ ?> selected="selected" <?php } ?>> No</option>
						<option value="1" <?php if($post_task_enable == 1){ ?> selected="selected" <?php } ?>> Yes</option>	 	  				 												
				  </select>

				 <label class="form-label">Admin Fee For Post Task (%)</label>
				 <input type="text" name="task_post_fee" id="task_post_fee" value="<?php echo $task_post_fee; ?>" class="form-field width40"/>
                 
                 <label class="form-label">Admin Refund Fee For Poster (%)</label>
				 <input type="text" name="task_post_refund_fee" id="task_post_refund_fee" value="<?php echo $task_post_refund_fee; ?>" class="form-field width40"/>
				  									
				 <label class="form-label">Admin Fee For Runner (%)</label>
				 <input type="text" name="task_worker_fee" id="task_worker_fee" value="<?php echo $task_worker_fee; ?>" class="form-field width40"/>
                 
                 <label class="form-label">Task Auto Complete</label>
				 <input type="text" name="task_auto_complete_hour" id="task_auto_complete_hour" value="<?php echo $task_auto_complete_hour; ?>" class="form-field width40"/> (In Hour)
                  
				  <label class="form-label">&nbsp;</label>
				  <input type="hidden" name="task_setting_id" id="task_setting_id" value="<?php echo $task_setting_id; ?>" />
                   <input type="hidden" name="action" value="update"/>
				  <input type="submit" class="button themed" name="submit" value="Update" onclick=""/>
				  
			  </form>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>