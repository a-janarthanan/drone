<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">Banner</h2> 
			<div class="box-content">
			
			  <?php
			    $attributes = array('name'=>'frm_task_category');
				echo form_open_multipart('pages/add_banner',$attributes);
				?>
			  <label class="form-label">Tilte </label>
			<input type="text" name="title" id="title" class="form-field width40" value="<?php echo $title;?>" />
			 <label class="form-label">Content</label>
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
			  	 
			<label class="form-label">Link </label>
			<input type="text" name="link" id="link" class="form-field width40" value="<?php echo $link;?>" />
			
			<label class="form-label"> Image </label>
			<input type="file" name="file_up" id="file_up" class="form-field width40" value="" />
			
			<input type="hidden" name="prev_category_image" id="prev_category_image" class="form-field width40" value="<?php echo $image_name;?>" />
         
          
         
				  									
				
				  <label class="form-label">&nbsp;</label>
				  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
                  <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
				  <?php if($id!="") {?>
				  
                   <input type="submit" class="button themed" name="submit" id="submit" value="Update" />
				  <?php } else  {?>
				   <input type="submit" class="button themed" name="submit" id="submit" value="Submits" />
				          
				  <?php }?>
			  </form>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>