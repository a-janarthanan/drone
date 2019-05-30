<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column" style="width:630px" >
		<div class="box">
			<h2 class="box-header">Add Membership Plan</h2> 
			<div class="box-content">
			
			  <?php
				$attributes = array('name'=>'frm_pages');
				echo form_open('pages/add_members',$attributes);
				
				
			  ?>
			  <label class="form-label"> Title </label>
			<input type="text" name="title" id="title" class="form-field width40" value="<?php echo $title;?>" />
            
            
             
               <label class="form-label">Description</label>
						<!-- jQuery and jQuery UI -->
		<script src="<?php echo front_base_url(); ?>editor/js/jquery-1.4.4.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo front_base_url(); ?>editor/js/jquery-ui-1.8.7.custom.min.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="<?php echo front_base_url(); ?>editor/css/smoothness/jquery-ui-1.8.7.custom.css" type="text/css" media="screen" charset="utf-8">

		<!-- elRTE -->
		<script src="<?php echo front_base_url(); ?>editor/js/elrte.min.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="<?php echo front_base_url(); ?>editor/css/elrte.min.css" type="text/css" media="screen" charset="utf-8">
		
		<!-- elFinder -->
		<link rel="stylesheet" href="<?php echo front_base_url(); ?>editor/css/elfinder.css" type="text/css" media="screen" charset="utf-8" /> 
		<script src="<?php echo front_base_url(); ?>editor/js/elfinder.full.js" type="text/javascript" charset="utf-8"></script> 
		
		<!-- elRTE and elFinder translation messages -->
		<!--<script src="<?php echo front_base_url(); ?>editor/js/i18n/elrte.ru.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo front_base_url(); ?>editor/js/i18n/elfinder.ru.js" type="text/javascript" charset="utf-8"></script>-->

		<script type="text/javascript" charset="utf-8">
			jQuery().ready(function() {
				var opts1 = {
					cssClass : 'el-rte',
					lang     : 'en',  // Set your language
					allowSource : 1,  // Allow user to view source
					height   : 450,   // Height of text area
					toolbar  : 'maxi',   // Your options here are 'tiny', 'compact', 'normal', 'complete', 'maxi', or 'custom'
					cssfiles : ['<?php echo front_base_url(); ?>editor/css/elrte-inner.css'],
					// elFinder
					fmAllow  : 1,
					fmOpen : function(callback) {
						$('<div id="myelfinder" />').elfinder({
							url : '<?php echo front_base_url(); ?>editor/connectors/php/connector.php', //You must configure this file. Look for 'URL'.  
							lang : 'en',
							dialog : { width : 900, modal : true, title : 'Files' }, // Open in dialog window
							closeOnEditorCallback : true, // Close after file select
							editorCallback : callback     // Pass callback to file manager
						})
					}
					//End of elFinder
				}
				
				$('#description').elrte(opts1);
				
			})
		</script>
        
        
        <textarea id="description" name="description" cols="50" rows="4">
				<?php echo $description; ?>
			</textarea>
        			  <br />
<br />

			
                                      
			<label class="form-label">Price</label>
			<input type="text" name="price" id="external_link" class="form-field width40" value="<?php echo $price;?>" />
			
							  
			<label class="form-label">Number of Bid</label>		
			<input type="text" name="numbid" id="numbid" class="form-field width40" value="<?php echo $numbid;?>" />
              									
			
            <!--<label class="form-label">Status </label>
            <select name="active" id="active" class="form-field settingselectbox required">
										<option value="0" <?php if($active=='0'){ echo "selected"; } ?>>Inactive</option>
										<option value="1" <?php if($active=='1'){ echo "selected"; } ?>>Active</option>														
									  </select>-->
			<label class="form-label">&nbsp;</label>
			<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
			<input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
					<?php
					if($id=="")
					{
					?>				  
								<input type="submit" class="button themed" name="submit" value="Submit" />
					<?php 
					}
					else{?>
                                <input type="submit" class="button themed" name="submit" value="Update" />
								<input type="button" name="cancel" value="Cancel" style="background:none; border:none; width:150px; color:#FFFFFF; font-size:14px; padding-top:7px; cursor:pointer;" onClick="location.href='<?php echo base_url(); ?>pages/list_membership'"/>
											  
					<?php } ?>
				  
			  </form>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>