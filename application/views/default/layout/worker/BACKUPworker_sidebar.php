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
            
            <div class="estim marB15">So you want to be a Runner?</div>
            <div class="marB10"><a class="ncitybg" href="<?php echo base_url();?>worker/apply">Apply Now</a></div>
            </div>
            
            <div class="marTB10">
            <div class="estim marB15">See why real people love being a Runner</div>
            <iframe width="280" height="245" src="http://www.youtube.com/embed/lBehsoMuMrM" frameborder="0" allowTransparency="true" style="z-index:0" allowfullscreen></iframe>
            </div>
            
            <div class="estim marB15">Runners in your town</div>
            <p>We are currently adding Runners to our team in the following regions:</p>
            <ul class="ulround2 marTB5">
            	  <?php $worker_city=city_list(); if($worker_city) { foreach($worker_city as $city) { ?>
                  <li><?php echo $city->city_name; ?></li>
                  <?php }}?>
                  
            </ul>
             
            If you would like to know when we will be launching in your neighborhood, <a href="#" class="fpass">let us know!</a>
            
            
        </div>