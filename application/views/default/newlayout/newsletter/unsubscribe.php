<div class="main">	
<br>
<br>
<br>
<br>
<br>




 
 
 <?php if($error=='not_found') { ?>
 
  <h2>Error in Unsubscribe</h2>
    
	<p style="color:#FF0000;">User Email <?php echo $subscribe_email; ?> or Subscription is not Found. </p>
	
 
 <?php }   if($error=='successfull') { ?>
 
 
 	 <h2>Successfull Unubscribe</h2>
    
	<p style="color:#009900;">You have successfully unsubscribed to our newsletter with <?php echo $subscribe_email; ?></p>
	
	
	
 
 <?php } ?>
 
<br>
<br>
<br>
<br>
<br>
<br>


</div>
		