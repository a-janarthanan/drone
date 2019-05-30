<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">Spam Settings </h2> 
			<div class="box-content">
			
			  <?php
				$attributes = array('name'=>'frm_spam_setting');
				echo form_open('newletter/newsletter_setting',$attributes);
			  ?>
			  
			  	  
				  
				  <label class="form-label">Total Spam Report Allow </label>
		    	  <input type="text" name="spam_report_total" id="spam_report_total" value="<?php echo $spam_report_total; ?>" class="form-field width40"/>
				  									
				  <label class="form-label">Report Spamer Expire(In Days) </label> 
				  <input type="text" name="spam_report_expire" id="spam_report_expire" value="<?php echo $spam_report_expire; ?>" class="form-field width40"/>
									
			       <label class="form-label">Total Registration Allow From Same IP </label>
				  <input type="text" name="total_register" id="total_register" value="<?php echo $total_register; ?>" class="form-field width40"/>
				  
				   <label class="form-label">Registration Spamer Expire(In Days) </label> 
				  <input type="text" name="register_expire" id="register_expire" value="<?php echo $register_expire; ?>" class="form-field width40"/>
				  
				  <label class="form-label">Total Comment Allow From Same IP In One Day</label>
				  <input type="text" name="total_comment" id="total_comment" value="<?php echo $total_comment; ?>" class="form-field width40"/>
				  
				  <label class="form-label">Comment Spamer Expire(In Days)</label>
				  <input type="text" name="comment_expire" id="comment_expire" value="<?php echo $comment_expire; ?>" class="form-field width40"/>
				  
				  <label class="form-label">Total Inquiry Allow From Same IP In One Day</label>
				  <input type="text" name="total_contact" id="total_contact" value="<?php echo $total_contact; ?>" class="form-field width40"/>

				  <label class="form-label">Inquiry Spamer Expire(In Days)</label>
				  <input type="text" name="contact_expire" id="contact_expire" class="form-field width40" value="<?php echo $total_contact; ?>"/>
				  
				  <label class="form-label">&nbsp;</label>
				 <input type="hidden" name="spam_control_id" id="spam_control_id" value="<?php echo $spam_control_id; ?>" />

				  <input type="submit" class="button themed" name="submit" value="Update" onclick=""/>
				  
			  </form>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>