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
						dv.innerHTML = '<p> Du måste välja fil från din enhet.</p>';
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


<?php if($msg=='success') { 

	if($ref_link!='') { $ref_link=site_url($ref_link); } else { $ref_link=site_url('customize_profile'); } 

?>
	
	
  <script type='text/javascript'>
parent.location.href='<?php echo $ref_link ; ?>';
</script>
	<?php } ?>

  <?php		
					 
	$attributes = array('name'=>'uploadPhoto','id'=>'uploadPhoto','onsubmit'=>'return submit_image_valid()');
		echo form_open_multipart('user/upload_photo/'.$ref_link,$attributes); 
		
		?>
    
           <div  id="error" class="error" style="display:none;"> </div>         
                    
<table border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td width="120" valign="top">
    
 
    
     <?php
					
					if($user_profile->profile_image!='') {  
					
						if(file_exists(base_path().'upload/user/'.$user_profile->profile_image)) { ?>
                        
                        <img src="<?php echo base_url(); ?>upload/user/<?php echo $user_profile->profile_image;?>"  alt="" class="fl upload_img" border="0" width="100" height="100"  />
                        
                        <?php } else { ?>
                        
                  <img src="<?php echo base_url(); ?>upload/no_image.png" border="0" width="100" height="100" alt="" class="fl upload_img"  />
                    
                    <?php } } else { ?>
                    
                    <img src="<?php echo base_url(); ?>upload/no_image.png" border="0" width="100" height="100" alt="" class="fl upload_img"  />
                    
                    <?php } ?>
    
    
    </td>
    <td  valign="top" class="other-pho"><input name="file_up" type="file" id="file_up" />
    <p class="marTB10">Fotot får ej överstiga 1MB i storlek. Behöver du ändra den? <?php echo anchor('http://www.picresize.com','picresize.com',' class="fpass fs12"');?></p>
    <input type="hidden" name="prev_image" id="prev_image" value="<?php echo $user_profile->profile_image; ?>" />
    <input type="hidden" name="ref_link" id="ref_link" value="<?php echo $ref_link; ?>" />
    <input type="submit" name="sub_upphoto"  value="Ladda upp foto" class="btn btn-default" id="sub_upphoto"  />
    </td>
  </tr>
</table>
</form>
