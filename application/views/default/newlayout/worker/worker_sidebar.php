<div class="mconright">

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
            <div class="underl">
            
            <div class="estim marB15">So you want to be a Worker bee?</div>
            <div class="marB10">
			<?php if(!check_user_authentication()) 
			{  
			echo anchor('sign_up','Apply Now','class="chbg"');
			} 
			else 
			{       
			?>
			<a class="chbg" href="<?php echo base_url();?>worker/apply">Apply Now</a>
			<?php
			} 
			?> 
			<!--<a class="ncitybg" href="<?php echo base_url();?>worker/apply">Apply Now</a>-->
			</div>
            </div>
            
            <div class="marTB10">
            <div class="estim marB15">See why real people love being a Worker bee</div>
            <!--<iframe width="280" height="245" src="http://www.youtube.com/embed/lBehsoMuMrM" frameborder="0" allowTransparency="true" style="z-index:0" allowfullscreen></iframe>-->
            </div>
             <style>
	 .show-more-snippet {
    height:350px;  /*this is set to the height of the how much text you want to show based on the font size, line height, etc*/
    width:300px;
    overflow:hidden;
}
	  </style>
            <div class="estim marB15">Worker bees in your town</div>
            <p>We are currently adding Worker bees to our team in the following regions:</p>
			<div class="show-more-snippet">
            <ul class="ulround2 marTB5 ">
            	  <?php $worker_city=city_list(); if($worker_city) { foreach($worker_city as $city) { ?>
                  <li><?php echo $city->city_name; ?></li>
                  <?php }}?>
                   
				
            </ul>
			</div>
             <a href="#" class="show-more">More...</a>
			  <script type="text/javascript">
				$('.show-more').click(function() {
    if($('.show-more-snippet').css('height') != '350px'){
        $('.show-more-snippet').stop().animate({height: '350px'}, 200);
        $(this).text('More...');
    }else{
        $('.show-more-snippet').css({height:'100%'});
        var xx = $('.show-more-snippet').height();
        $('.show-more-snippet').css({height:'35px'});
        $('.show-more-snippet').stop().animate({height: xx}, 400);
        // ^^ The above is beacuse you can't animate css to 100% (or any percentage).  So I change it to 100%, get the value, change it back, then animate it to the value. If you don't want animation, you can ditch all of it and just leave: $('.show-more-snippet').css({height:'100%'});^^ //
        $(this).text('Less...');
    }
});
				</script>
          
        </div>