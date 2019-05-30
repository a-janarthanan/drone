
<script type="text/javascript">



$("#send_invitetion").submit(function(e)
{
	var postData = $(this).serializeArray();
	var formURL = $(this).attr("action");
	$.ajax(
	{
		url : formURL,
		type: "POST",
		data : postData,
		success:function(data, textStatus, jqXHR) 
		{
parent.$.fancybox.close();
		},
		error: function(jqXHR, textStatus, errorThrown) 
		{
		}
	});
    e.preventDefault();	//STOP default action
});
$("#subno_upphoto").click(function(e)
{
	parent.$.fancybox.close();
});
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

	echo "Invitetion Send";

?>
	
	
  <script type='text/javascript'>
parent.location.href='<?php echo $ref_link ; ?>';
</script>
	<?php } ?>

  <?php		
					 
	$attributes = array('name'=>'send_invitetion','id'=>'send_invitetion');
		echo form_open_multipart('task/invite/'.$ref_link,$attributes); 
		
		?>
    <input type="hidden" name="userid" value="<?php echo $user_id ?>">
    <input type="hidden" name="taskmail" value="1">
           <div  id="error" class="error" style="display:none;"> </div>         
                    
<table border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td width="100%">
    
 	Are you sure , You want to invite this tasker for your Task ?
    
    
    
    </td>
    </tr>
    <tr><td height="10px"></td></tr>
    <tr>
    <td >
   
    <input type="hidden" name="ref_link" id="ref_link" value="<?php echo $ref_link; ?>" />
    <input type="submit" name="sub_upphoto"  value="Yes" class="chbg" id="sub_upphoto"  />
    <input type="button" name="subno_upphoto"  id="subno_upphoto" value="No" class="chbg" id="subno_upphoto"/>
    </td>
  </tr>
</table>
</form>
