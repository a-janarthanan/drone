<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column" style="width:630px" >
		<div class="box">
			<h2 class="box-header">Add Page</h2> 
			<div class="box-content">
			
			  <?php
				$attributes = array('name'=>'frm_pages');
				echo form_open('pages/add_pages',$attributes);
				
				
			  ?>
			  <label class="form-label">Pages Title </label>
			<input type="text" name="pages_title" id="pages_title" class="form-field width40" value="<?php echo $pages_title;?>" />
            
            <?php if($pages_id!='') { ?>
            
             <label class="form-label">Pages URL </label>
             <a href="<?php echo front_base_url().'home/content/'.strtolower(str_replace(' ','-',$pages_title)).'/'.$pages_id;?>" target="_balnk"><?php echo front_base_url().'home/content/'.strtolower(str_replace(' ','-',$pages_title)).'/'.$pages_id;?></a>
             
             <?php }?>
             
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

			
                                      
			<label class="form-label">External URL</label>
			<input type="text" name="external_link" id="external_link" class="form-field width40" value="<?php echo $external_link;?>" />(http:// is required)
			<label class="form-label">Display Place</label>
		
			<input type="checkbox" name="header_bar" id="header_bar" value="yes" <?php if($header_bar=='yes') { ?> checked="checked" <?php } ?>/>&nbsp;<label for="Header">Header</label>
			<input type="checkbox" name="left_side" id="left_side" value="yes" <?php if($left_side=='yes') { ?> checked="checked" <?php } ?> /><label for="Left Side">&nbsp; Left Side </label>
			<input type="checkbox" name="right_side" id="right_side" value="yes" <?php if($right_side=='yes') { ?> checked="checked" <?php } ?> /><label for="Right Side">&nbsp; Right Side</label>
			<input type="checkbox" name="footer_bar" id="footer_bar" value="yes" <?php if($footer_bar=='yes') { ?> checked="checked" <?php } ?>/><label for="Footer">&nbsp;Footer</label>
			
		
							  
			  <label class="form-label">Slug</label>		
				<input type="text" name="slug" id="slug" class="form-field width40" value="<?php echo $slug;?>" />
              									
				<label class="form-label">Meta Keyword </label>
                <input type="text" name="meta_keyword" id="meta_keyword" class="form-field width40" value="<?php echo $meta_keyword;?>" />
			
                 <label class="form-label">Meta Description </label>
                <input type="text" name="meta_description" id="meta_description" class="form-field width40" value="<?php echo $meta_description;?>" />
                
                <label class="form-label">Status </label>
                 <select name="active" id="active" class="form-field settingselectbox required">
										<option value="0" <?php if($active=='0'){ echo "selected"; } ?>>Inactive</option>
										<option value="1" <?php if($active=='1'){ echo "selected"; } ?>>Active</option>														
									  </select>
				 <label class="form-label">&nbsp;</label>
				  <input type="hidden" name="pages_id" id="pages_id" value="<?php echo $pages_id; ?>" />
									  <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
					<?php
										if($pages_id=="")
										{
									  ?>				  
									   <input type="submit" class="button themed" name="submit" value="Submit" />
									   <?php 
									   }
									   else{?>
                                              <input type="submit" class="button themed" name="submit" value="Update" />
											  <input type="button" name="cancel" value="Cancel" style="background:none; border:none; width:150px; color:#FFFFFF; font-size:14px; padding-top:7px; cursor:pointer;" onClick="location.href='<?php echo base_url(); ?>pages/list_pages'"/>
											  
											  <?php } ?>
				  
			  </form>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>