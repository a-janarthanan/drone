<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">ADD Newsletter Job</h2> 
			<div class="box-content">
			
			  <?php
				$attributes = array('name'=>'frm_user_setting');
				echo form_open('newsletter/add_newsletter_job',$attributes);
				
				
			  ?>
			  
			  	  <label class="form-label">Select Newsletter</label>
                  
				 <select name="newsletter_id" id="newsletter_id" class="form-field settingselectbox required" >
								<?php if($all_newsletter) {  
																																
										 foreach($all_newsletter as $alnw) { ?>	
										 
										<option value="<?php echo $alnw->newsletter_id;?>" <?php if($alnw->newsletter_id==$newsletter_id) { ?> selected="selected" <?php } ?> style="text-transform:capitalize;"><?php echo $alnw->subject; ?></option>
										<?php } } else { ?>
										
									<option value="">---No Newsletter---</option>
									<?php } ?>
									
									</select>		
				 
					<label class="form-label"> Datepicker </label>
					<input class="form-field datepicker" type="text" name="job_start_date" id="job_start_date" value="<?php echo $job_start_date; ?>"/>
				
				  
                
				  									
				
				  <label class="form-label">&nbsp;</label>
				  <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
                   <input type="submit" class="button themed" name="submit" value="Submit" />
                     <input type="button" name="cancel" value="Cancel"  class="button themed" onClick="location.href='<?php echo base_url(); ?>newsletter/newsletter_job'"/>
				  
			  </form>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>