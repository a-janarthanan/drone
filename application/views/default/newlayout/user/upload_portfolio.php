
<script type="text/javascript">



function submit_image_valid()
{


 
frmCheckform = document.frm_addgallery;
        // assigh the name of the checkbox;
        var chks = document.getElementsByName('file_up');
 
        var hasChecked = false;
      
	  		
                if (chks[0].value=='')
                {
                        check=false;
						var dv = document.getElementById('error');						
						dv.style.clear = "both";
						dv.innerHTML = '<p> Image is required.</p>';
						dv.style.display='block';
						
					  	hasChecked = true;
                        
						return false;
                }
				else 
				{
						value = chks[0].value;
						t1 = value.substring(value.lastIndexOf('.') + 1,value.length);
						if( t1=='jpg' || t1=='jpeg' || t1=='gif' || t1=='png' || t1=='JPEG' || t1=='JPG'  ||  t1=='PNG' || t1=='GIF' )
						{
							document.getElementById('error').style.display='none';
							check=true;
						}
						else
						{						
							check=false;
							i=0;
							var dv = document.getElementById('error');
							
							dv.style.clear = "both";							
							dv.innerHTML = ' <p>Image type is not valid.</p>';
							dv.style.display='block';
							hasChecked = true;
							
							return false;
						}			
				}

}
</script>

	<script type="text/javascript">
$(document).ready(function() {
   $("iframe").each(function(){
       var ifr_source = $(this).attr('src');
       var wmode = "wmode=transparent";
       if(ifr_source.indexOf('?') != -1) {
           var getQString = ifr_source.split('?');
           var oldString = getQString[1];
           var newString = getQString[0];
           $(this).attr('src',newString+'?'+wmode+'&'+oldString);
       }
       else $(this).attr('src',ifr_source+'?'+wmode);
   });
});
</script>  


<?php if($msg=='success') { ?>
	
	
  <script type='text/javascript'>
parent.location.href='<?php echo site_url('customize_profile/photo_add')?>';
</script>
	<?php } ?>

  <?php		
					 
	$attributes = array('name'=>'uploadPortfolio','id'=>'uploadPortfolio','onsubmit'=>'return submit_image_valid()');
	echo form_open_multipart('user/upload_portfolio/',$attributes); 
		?>
           <div  id="error" class="error" style="display:none;"> </div>         
                    
<table border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td width="120" valign="top"><img src="<?php echo base_url(); ?>upload/no_image.png" border="0" width="100" class="upload_img" height="100" /></td>
    <td valign="top" class="other-pho"><input name="file_up" type="file" id="file_up" />
    <p class="marTB10">Photos should be no larger than 1MB. Need to resize? <?php echo anchor('http://www.picresize.com','picresize.com',' class="fpass fs12"');?></p>
    
    <input type="submit" name="sub_upphoto"  value="Upload Photo" class="btn btn-default" id="sub_upphoto"  />
    </td>
  </tr>
</table>
</form>
