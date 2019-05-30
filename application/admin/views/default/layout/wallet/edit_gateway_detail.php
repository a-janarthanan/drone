<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">Gateway Detail</h2> 
			<div class="box-content">
			
			  <?php
				$attributes = array('name'=>'frm_detail');
				echo form_open('gateways_details/edit_detail',$attributes);
				
				
			  ?>
              <label class="form-label">&nbsp; </label>
                 <input type="hidden" name="name" id="name" value="<?php echo $name; ?>"/>
                 	 <input type="hidden" id="payment_gateway_id" name="payment_gateway_id" value="<?php echo $payment['id']; ?>" />
                 
			    <label class="form-label"><?php echo $label; ?></label>
			<input type="text" name="value" id="value" class="form-field width40" value="<?php echo $value;?>" />
            
             <label class="form-label">&nbsp; </label>
            <input type="hidden" name="label" id="label" value="<?php echo $label; ?>"/>
			
               
                 
                 
			  <label class="form-label">Description</label>
			
			  <textarea id="description" name="description" readonly="readonly" onfocus="show_bg('description')" onblur="hide_bg('description')"><?php echo $description;  ?></textarea>
			
           
                
				 <label class="form-label">&nbsp;</label>
				     <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
										  <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
					<?php
										if($id=="")
										{
									  ?>				  
									 <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
										  <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
									   <?php 
									   }
									   else{?>
                                              <input type="submit" class="button themed" name="submit" value="Update" />
											  <input type="button" name="cancel" value="Cancel" class="button themed" onClick="location.href='<?php echo base_url(); ?>gateways_details/list_gateway_detail/<?php echo $payment_gateway_id; ?>'"/>
											  
											  
											  <?php } ?>
				  
			  </form>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>