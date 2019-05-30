<script type="text/javascript" language="javascript">
function setchecked(elemName,status){
	elem = document.getElementsByName(elemName);
	for(i=0;i<elem.length;i++){
		elem[i].checked=status;
	}
}


function get_project_details(str)
{
	if(str=='')
	{
		return false;
	}
	
		if (window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		} else if(window.ActiveXObject) {
			try {
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
					xmlhttp = false;
				}
			}
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{				
				//var orig_content = document.getElementsByTagName('iframe')[0].contentWindow.document.body.innerHTML;				
				//document.getElementsByTagName('iframe')[0].contentWindow.document.body.innerHTML=orig_content + xmlhttp.responseText;
				
				document.getElementsByTagName('iframe')[0].contentWindow.document.body.innerHTML=xmlhttp.responseText;
				
				
			}
		}
		
		
		
		var url = '<?php echo base_url(); ?>/newsletter/get_project_template/'+str+'/<?php echo strtotime(date('H:i:s')); ?>';
		
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
	
}



</script>


<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column" style="width:630px">
		<div class="box">
			<h2 class="box-header">	<?php if($newsletter_id==""){?>	Add NewLetter <?php } else { ?> Edit NewLetter<?php } ?></h2> 
			<div class="box-content">
			
			  <?php
				$attributes = array('name'=>'frm_add_newsletter','enctype'=>'multipart/form-data');
				echo form_open('newsletter/add_newsletter',$attributes);
				
				
			  ?>
              
			  <label class="form-label">Subject </label>
			<input type="text" name="subject" id="subject" class="form-field width40" value="<?php echo $subject;?>" />
			
			<label class="form-label">Attach File </label>
			<input type="file" name="file_up" id="file_up" class="form-field width40" value="<?php echo $file_up;?>" />
			<input type="hidden" name="prev_attach_file" id="prev_attach_file" value="<?php echo $prev_attach_file; ?>" />
							  
					
				  									
				<label class="form-label">Allow Subscribe Link </label>
				<table  cellpadding="2" cellspacing="2" border="0" >
									<tr>
									<td align="left" valign="top" width="20"><input type="radio" name="allow_subscribe_link" id="allow_subscribe_link" value="1" <?php if($allow_subscribe_link=='1') { ?> checked="checked" <?php } ?> style="width:20px;" /> </td><td align="left" valign="top"> Yes </td>
									
									<td align="left" valign="top" width="20"><input type="radio" name="allow_subscribe_link" id="allow_subscribe_link" value="0" <?php if($allow_subscribe_link=='0') { ?> checked="checked" <?php } ?> style="width:20px;"/> </td><td align="left" valign="top"> No</td>
									
									
									</tr>
									</table><br />
						<label class="form-label">Allow Unsubscribe Link</label>
						<table  cellpadding="2" cellspacing="2" border="0" >
									<tr>
									<td align="left" valign="top" width="20"><input type="radio" name="allow_unsubscribe_link" id="allow_unsubscribe_link" value="1" <?php if($allow_unsubscribe_link=='1') { ?> checked="checked" <?php } ?> style="width:20px;" /> </td><td align="left" valign="top"> Yes </td>
									
									<td align="left" valign="top" width="20"><input type="radio" name="allow_unsubscribe_link" id="allow_unsubscribe_link" value="0" <?php if($allow_unsubscribe_link=='0') { ?> checked="checked" <?php } ?> style="width:20px;"/> </td><td align="left" valign="top"> No</td>
									
									
									</tr>
									</table>
									<br />
									<?php
								if($newsletter_id=="")
								{
							  ?>	  <label class="form-label">Subscribe To<span>&nbsp;</span></label>
							  <table  cellpadding="2" cellspacing="2" border="0" >
									<tr>
									
									
									<td align="left" valign="top" width="20">
									<input type="radio" name="subscribe_to" id="subscribe_to" value="none" <?php if($subscribe_to=='none') { ?> checked="checked" <?php } ?> style="width:20px;" /> </td>
									<td align="left" valign="top"> None </td>
									
									
									<td align="left" valign="top" width="20">
									<input type="radio" name="subscribe_to" id="subscribe_to" value="all" <?php if($subscribe_to=='all') { ?> checked="checked" <?php } ?> style="width:20px;" /> </td>
									<td align="left" valign="top"> All </td>
											
									
									
									</tr>
									</table>
							  
							  <?php } ?>	
							  
							 <br />
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
				
				$('#template_content').elrte(opts1);
				
			})
		</script>
        
        
        <textarea id="template_content" name="template_content" cols="50" rows="4">
				<?php echo $template_content; ?>
			</textarea>
        			  <br />
<br />



									
									
				  <label class="form-label">&nbsp;</label>
				  <input type="hidden" name="newsletter_id" id="newsletter_id" value="<?php echo $newsletter_id; ?>" />
									  <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>" />
					<?php
										if($newsletter_id=="")
										{
									  ?>				  
									   <input type="submit" class="button themed" name="submit" value="Submit" />
									   <?php 
									   }
									   else{?>
                                              <input type="submit" class="button themed" name="submit" value="Update" />
											  <input type="button" name="cancel" value="Cancel" style="background:none; border:none; width:150px; color:#FFFFFF; font-size:14px; padding-top:7px; cursor:pointer;" onClick="location.href='<?php echo base_url(); ?>newsletter/list_newsletter'"/>
											  
											  <?php } ?>
				  
			  </form>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>