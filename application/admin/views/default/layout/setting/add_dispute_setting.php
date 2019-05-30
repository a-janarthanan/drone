<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">Dispute Settings </h2> 
			<div class="box-content">
			
			  <?php
				$attributes = array('name'=>'frm_dispute_setting');
				echo form_open_multipart('task_setting/add_dispute_setting',$attributes);
				
				
			  ?>
			  
			  	  <label class="form-label">Dispute Comment Limit </label>
                  <input type="text" name="total_comment_limit" id="total_comment_limit" value="<?php echo $total_comment_limit; ?>" class="form-field width40"/> (0 for Unlimited Comment)
				  
				  									
				
				  <label class="form-label">&nbsp;</label>
				  <input type="hidden" name="dispute_setting_id" id="dispute_setting_id" value="<?php echo $dispute_setting_id; ?>" />
                  <input type="hidden" name="action" value="update"/>
				  <input type="submit" class="button themed" name="submit" value="Update" onclick=""/>
				  
			  </form>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>