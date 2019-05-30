
<script type="text/javascript">
jQuery(function($) {

		
 jQuery("#user_video_close").click(function(){
 	
  		 jQuery.fancybox.close();
		
    });
	
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
<?php if($msg=='success') { ?>
	
	
  <script type='text/javascript'>
parent.location.href='<?php echo site_url('customize_profile/photo_delete')?>';
</script>
	<?php } ?>
	
  <?php		
					 
	$attributes = array('name'=>'portfolioView','id'=>'portfolioView');
	echo form_open_multipart('user/portfolio_view/'.$user_portfolio->portfolio_id,$attributes);
		?>
     
        <input name="portfolio_id" id="portfolio_id" type="hidden" value="<?php echo $user_portfolio->portfolio_id; ?>" />
      
<input type="submit" class="delbg" id="sub_delimg" name="sub_delimg">
<div class="clear"></div>        
 

        <?php echo '<img src="'.base_url().'upload/user_orig/'.$user_portfolio->portfolio_image.'" alt="" width="400" height="300"/>';?>
 
<div class="clear"></div>
 


</form>
