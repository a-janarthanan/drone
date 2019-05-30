
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

<?php $site_setting=site_setting();  ?>


<?php 
	$attributes = array('name'=>'posMessageForm','id'=>'posMessageForm','class'=>'form_design');
	echo form_open('task/post_message/'.$task_id.'/'.$task_comment_id,$attributes);
?>

 <?php if($error != '') { ?>     
<div class="errmsgcl"> 
	<div class="follfi">There were problems with the following fields:</div>
	<?php echo $error; ?>
</div>
<?php } ?>

<table  border="0" cellspacing="1" cellpadding="5">
  <tr id="task_commentTR">
	<td width="82%">
		<label id="silb" style="color:#585858;"><b>Comment</b></label><br/>
		<textarea name="task_comment" id="task_comment"  rows="5" style="margin-top:5px; width:352px; height:100px; " class="form-control form-control-1" ><?php echo $task_comment; ?></textarea><br />
		<span id="task_commentInfo"></span>
	</td>
  </tr>
  
   <tr>
	<td width="82%" style="text-align:center;">
		<input id="task_id" name="task_id" type="hidden" value="<?php echo $task_id; ?>"  />
		<input type="submit" value="Post Message" class="btn btn-default" name="posMessagebtn" id="posMessagebtn">
		
	</td>
  </tr>
</table>
</form>


<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/validation.js"></script>
