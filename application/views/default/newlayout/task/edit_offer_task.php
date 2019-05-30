


<?php $site_setting=site_setting();  ?>


<?php 
	$attributes = array('name'=>'offerTaskForm','id'=>'offerTaskForm','class'=>'form_design');
	echo form_open('task/edit_offer_on_task/'.$task_id.'/'.$task_comment_id,$attributes);
?>

 <?php if($error != '') { ?>     
<div class="errmsgcl"> 
	<div class="follfi">There were problems with the following fields:</div>
	<?php echo $error; ?>
</div>
<?php } ?>

<style>
#offerTaskForm > table {
    border: 1px solid #ccc;
    padding: 10px;
	border-radius:5px;
}
</style>
<table  border="0" cellspacing="1" cellpadding="5">
  <tr id="offer_amountTR">
	<td width="82%">
		<label id="silb"><b>Place Offer Amount(<?php echo $site_setting->currency_symbol;?>)</b></label><br/>
		<input id="offer_amount" name="offer_amount" type="text" value="<?php echo $offer_amount; ?>" style="margin-top:5px;" class="form-control form-control-1" /><br />
		<span id="offer_amountInfo"></span>
	</td>
  </tr>
  
  <tr id="task_commentTR">
	<td width="82%">
		<label id="silb"><b>Place Offer Description (Describe your offer in few words)</b></label><br/>
		<textarea name="task_comment" id="task_comment"  rows="5" style="margin-top:5px; width:352px; height:100px; " class="form-control form-control-1" ><?php echo $task_comment; ?></textarea><br />
		<span id="task_commentInfo"></span>
	</td>
  </tr>
  
   <tr>
	<td width="82%" style="text-align:center;">
		<input id="task_id" name="task_id" type="hidden" value="<?php echo $task_id; ?>"  />
		<input type="submit" value="Place Offer" class="btn btn-default" name="offerTaskbtn" id="offerTaskbtn">
		
	</td>
  </tr>
</table>
</form>


<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/validation.js"></script>
