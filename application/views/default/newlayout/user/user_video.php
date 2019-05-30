
<script type="text/javascript">





function submit_video_valid()
{

        var code = trim(document.getElementById('uservideo').value);
 
        var hasChecked = false;
      
                if (code=='')
                {
                        check=false;
						var dv = document.getElementById('error');						
						dv.style.clear = "both";
						dv.innerHTML = '<p> Video is required.</p>';
						dv.style.display='block';
						
					  	hasChecked = true;
                        
						return false;
                }
				else 
				{
				
							document.getElementById('error').style.display='none';
							check=true;
							return true;
					
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
parent.location.href='<?php echo site_url('customize_profile/video_add')?>';
</script>
	<?php } ?>

  <?php		
					 
	$attributes = array('name'=>'frmuserVideo','id'=>'frmuserVideo','onsubmit'=>'return submit_video_valid()');
		echo form_open('user/user_video/',$attributes); 
		
		?>
        
       <div  id="error" class="error" style="display:none;"> </div>          
     
<ul class="padli10">
	<li class="fs14">
    Shared iframe embedded code
    </li>
	<li>
    <textarea cols="73" rows="3" id="uservideo" name="uservideo"></textarea>
    </li>
    <li>
    <input type="submit" name="sub_link"  value="Submit" class="btn btn-default"/>
    </li>
</ul>                  

</form>
