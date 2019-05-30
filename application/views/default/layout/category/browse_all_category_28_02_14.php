<div>
	<div>
	<div class="page-title mbot20">
		<h1 class="mleft15">Browse Jobs</h1>
	</div>

<div class="browseall">
<form>
<table width="100%" border="0" cellspacing="1" cellpadding="5">
<tr>
<td align="left"><h1 id="bilt">We can do just about anything!</h1>
</td>
<td align="right">
<?php if(!check_user_authentication()) {  echo anchor('sign_up','Post a Job',' class="cm temp" ');  } else {       
        
        echo anchor('new_task','Post a Job',' id="various3" class="cm temp" '); } ?> 

</td>
</tr>
</table>

<div class="mostpop marTB10" style="margin:0 0 0 15px;">


<?php

if($all_categories)
{
?>

<ul class="mc">
<?php
/*echo '<pre>';
print_r($sub);
foreach($sub as $nik)
{
	echo $nik->task_category_id;
	echo"<br/>";
}


die();*/

$i=0;
foreach($all_categories as $all_cats)
{ $i++;

$sub=sub_category($all_cats->task_category_id);

$nmore= $all_cats->task_category_id;

$count_fewer=0;
if($sub)
{

	foreach($sub as $sub_cats)
	{
		$count_fewer++;
	}
}

	
	
					$category_image=base_url().'upload/category/no_image.png';

		
					if($all_cats->category_image!='') {  
					
						if(file_exists(base_path().'upload/category_orig/'.$all_cats->category_image)) { 
							
							$category_image=base_url().'upload/category_orig/'.$all_cats->category_image;
						
						}
						
					}
					
					
					?>

<li style="padding-bottom:15px;">
<img src="<?php echo $category_image; ?>" width="94" height="94" alt="" />
<h3><?php echo anchor('tags/'.$all_cats->category_url_name,$all_cats->category_name); ?></h3>
          
            <ul class="mch4b4" id="li<?php echo $nmore; ?>">
				<?php
                if($sub)
                {
					foreach($sub as $sub_cats)
					{
					?>
						<li><?php echo anchor('tags/'.$sub_cats->category_url_name,$sub_cats->category_name); ?></li>
					<?php
					}
                }
                ?>
            </ul>



<?php
if($count_fewer>3){
?>
<script type="text/javascript">
$(document).ready(function() {
$('#more<?php echo $nmore; ?>').click(function() {

jQuery('#more<?php echo $nmore; ?>').hide();
jQuery('#fewer<?php echo $nmore; ?>').show();
jQuery('#li<?php echo $nmore; ?>').css('height','100%');
});
$('#fewer<?php echo $nmore; ?>').click(function() {
jQuery('#fewer<?php echo $nmore; ?>').hide();
jQuery('#more<?php echo $nmore; ?>').show();
jQuery('#li<?php echo $nmore; ?>').css('height','70px');
});

});
</script>


<a class="more" id="more<?php echo $nmore; ?>" href="javascript:void(this);">More</a>
<a class="fewer" id="fewer<?php echo $nmore; ?>" style="display:none;" href="javascript:void(this);">Fewer</a>
<?php } ?>


</li>


<?php if($i==5) { $i=0; echo '</ul><div class="clear"></div><hr/><ul class="mc">'; } ?>


<?php
}
?>

<div class="clear"></div>


</ul>


<?php
}
?>



</div>


</form>

</div>


</div>
</div>



