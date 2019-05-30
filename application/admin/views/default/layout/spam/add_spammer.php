<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">Add Spam</h2> 
			<div class="box-content">
			
			  <?php
				$attributes = array('name'=>'frm_add_spammer');
				echo form_open('spam_setting/add_spammer',$attributes);
				
				
			  ?>
			 
                  
				
                  <label class="form-label">Spam IP </label>
			<input type="text" name="spam_ip" id="spam_ip" class="form-field width40" value="<?php echo $spam_ip;?>" />
            
				  									
				
				  <label class="form-label">&nbsp;</label>
                  <input type="checkbox" name="permenant_spam" id="permenant_spam" value="1" ch <?php if($permenant_spam==1) { ?> checked="checked" <?php } ?> style="width:30px !important;" />&nbsp;Make Permenant
                  <label class="form-label">&nbsp;</label>
				 
                   <input type="submit" class="button themed" name="submit" value="Submit" />
				  
			  </form>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>