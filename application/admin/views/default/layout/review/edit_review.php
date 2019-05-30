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
				$attributes = array('name'=>'frm_review_edit');
				echo form_open('review/edit_review/'.$cid,$attributes);
			  ?>					
				  <label class="form-label">Task Comment </label> 
                  <textarea class="form-field small" name="task_comment" cols="" rows="" id="task_comment"><?php echo $task_comment; ?></textarea>
                  
                 <!-- <label class="form-label">Runner's Rate </label> 
                  <select name="comment_rate" id="comment_rate"> 
                        <option value="1" <?php if($comment_rate==1) { ?> selected="selected" <?php } ?>>1 - Poor</option>
                        <option value="2" <?php if($comment_rate==2) { ?> selected="selected" <?php } ?>>2 - Fair</option>
                        <option value="3" <?php if($comment_rate==3) { ?> selected="selected" <?php } ?>>3 - Average</option>
                        <option value="4" <?php if($comment_rate==4) { ?> selected="selected" <?php } ?>>4 - Very Good</option>                
                        <option value="5" <?php if($comment_rate==5) { ?> selected="selected" <?php } ?>>5 - Excellent</option>
                  </select>-->
				 
				  <label class="form-label">&nbsp;</label>
				  <input type="hidden" name="task_comment_id" id="task_comment_id" value="<?php echo $task_comment_id; ?>" />
				  <input type="submit" class="button themed" name="submit" value="Update" onclick=""/>
				  
			  </form>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>