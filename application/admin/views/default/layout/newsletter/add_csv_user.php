<script language="javascript">

function Checkfiles()
{

var fup = document.getElementById('upcsv');

var fileName = fup.value;

	if(fileName=='')
	{
		alert("Upload csv only");
		fup.focus();
	
		return false;
	}

var ext = fileName.substring(fileName.lastIndexOf('.') + 1);

		if(ext == "csv")
		{
			return true;
		} 
		
		else
		{
			alert("Upload csv only");
			fup.focus();
			
			return false;
		}

}

</script>

<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">Upload CSV</h2> 
			<div class="box-content">
			
			  <?php
				$attributes = array('name'=>'frm_addcsvreward');
				echo form_open('newsletter/add_csv_upload',$attributes);
				
				
			  ?>
			  
			  	  <label class="form-label">Upload CSV</label>
                  
				  <input type="file" name="upcsv" id="upcsv"  onfocus="show_bg('upcsv')" onblur="hide_bg('upcsv')"/>			
								
				 
					 <a href="<?php echo base_url();?>newsletter_user_format.csv" style="color:#A2DAFF;">Download Sample CSV file</a>
				  
                
				  									
				
				  <label class="form-label">&nbsp;</label>
				  
                   <input type="submit" class="button themed" name="submit" value="Update" />
                     <input type="button" name="cancel" value="Cancel"  class="button themed" onClick="location.href='<?php echo base_url(); ?>newsletter/list_newsletter_user'"/>
				  
			  </form>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>