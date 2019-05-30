<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">Payment Gateway</h2> 
			<div class="box-content">
			
			  <?php
				$attributes = array('name'=>'frm_payment','enctype'=>'multipart/form-data');
				echo form_open('payments_gateways/add_payment',$attributes);
				
				
			  ?>
			    <label class="form-label">Name</label>
			<input type="text" name="name" id="name" class="form-field width40" value="<?php echo $name;?>" />
			
               <label class="form-label">Status </label>
                <select name="status" id="status" class="form-field settingselectbox required"> 
                    <option <?php if($status=='Active'){ echo "selected"; } ?>>Active</option>
                    <option <?php if($status=='Inactive'){ echo "selected"; } ?>>Inactive</option>									
				</select>
			  <label class="form-label">Image</label>
			<input type="file" name="image" id="image" class="form-field width40"/>
            <?php if($image != ''){ ?>
          	 &nbsp;&nbsp;<img src="<?php echo front_base_url();?>upload/<?php echo $image;?>" style="height:40px; width:40px;" alt="image-gallery"/>
            <?php } ?>
            
			 <input type="hidden" name="prev_image" id="prev_image" value="<?php echo $image; ?>" />
            
			 
			<?php /*?>  <label class="form-label">Function Name</label>
			<input type="text" name="function_name" id="function_name" class="form-field width40" readonly="readonly" value="<?php echo $function_name;?>" /><?php */?>
            
           
               <?php /*?> <label class="form-label">Support Masspayment </label>
                 <select name="suapport_masspayment" id="suapport_masspayment" class="form-field settingselectbox required">
				  <option <?php if($suapport_masspayment=='Yes'){ echo "selected"; } ?>>Yes</option>
				  <option <?php if($suapport_masspayment=='No'){ echo "selected"; } ?>>No</option>												
				</select><?php */?>
                
                <label class="form-label">Auto Confirm </label>
                 <select name="auto_confirm" id="auto_confirm" class="form-field settingselectbox required">
                      <option <?php if($auto_confirm=='1'){ echo "selected"; } ?>>Yes</option>
                      <option <?php if($auto_confirm=='0'){ echo "selected"; } ?>>No</option>												
				</select>
				 <label class="form-label">&nbsp;</label>
				     <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
										  <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
					<?php
										if($id=="")
										{
									  ?>				  
									   <input type="submit" class="button themed" name="submit" value="Submit" />
                                       <input type="button" name="cancel" value="Cancel" class="button themed" onClick="location.href='<?php echo base_url(); ?>payments_gateways/list_payment_gateway'"/>
									   <?php 
									   }
									   else{?>
                                              <input type="submit" class="button themed" name="submit" value="Update" />
											  <input type="button" name="cancel" value="Cancel" class="button themed" onClick="location.href='<?php echo base_url(); ?>payments_gateways/list_payment_gateway'"/>
											  
											  
											  <?php } ?>
				  
			  </form>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>