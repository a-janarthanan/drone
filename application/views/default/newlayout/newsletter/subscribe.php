<div class="main">	
<br>
<br>
<br>
<br>
<br>



 
 <?php if($error=='user_exists') { ?>
 
  <h2>Error in Subscription</h2>
    
	<p style="color:#FF0000;">User Email <?php echo $subscribe_email;?> already Subscribe to Newsletter. </p>
	
 
 <?php } if($error=='not_found') { ?>
 
  <h2>Error in Subscription</h2>
    
	<p style="color:#FF0000;">  User Email <?php echo $subscribe_email;?> is not Found. </p>
	
 
 <?php }   if($error=='successfull') { ?>
 
 
 	 <h2>Successfull Subscribe</h2>
    
<p style="color:#009900;">You have subscribed to our newsletter with <?php echo $subscribe_email;?></p>
	
	
	
 
 <?php } ?>
 
<br>
<br>
<br>
<br>
<br>
<br>


</div>
		