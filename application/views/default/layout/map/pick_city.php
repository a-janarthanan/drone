<script type="text/javascript">
jQuery(function($) {



$("#Dscomsonbg1").mouseover(function () {
$("#Dcomsonbg1").show("fast");
});

$("#Dscomsonbg1").mouseout(function () {
$("#Dcomsonbg1").hide("fast");
});

$("#Dscomsonbg2").mouseover(function () {
$("#Dcomsonbg2").show("fast");
});

$("#Dscomsonbg2").mouseout(function () {
$("#Dcomsonbg2").hide("fast");
});

$("#Dscomsonbg3").mouseover(function () {
$("#Dcomsonbg3").show("fast");
});

$("#Dscomsonbg3").mouseout(function () {
$("#Dcomsonbg3").hide("fast");
});

$("#Dscomsonbg4").mouseover(function () {
$("#Dcomsonbg4").show("fast");
});

$("#Dscomsonbg4").mouseout(function () {
$("#Dcomsonbg4").hide("fast");
});

$("#Dscomsonbg5").mouseover(function () {
$("#Dcomsonbg5").show("fast");
});

$("#Dscomsonbg5").mouseout(function () {
$("#Dcomsonbg5").hide("fast");
});

$("#Dscomsonbg6").mouseover(function () {
$("#Dcomsonbg6").show("fast");
});

$("#Dscomsonbg6").mouseout(function () {
$("#Dcomsonbg6").hide("fast");
});

});

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

  <div class="ie7sp4">
          
            
<h3 class="whereu">Where <span class="colgreen">you want</span> your <span class="colred">task</span> completed ?</h3>
<div class="breaker2 marTB10"></div>

<div class="webg fl">
	<h3 class="wer">Where we are</h3>
    <div class="cil">
    <ul>

           
		   <?php $city_list=city_list();
		   $current_city_id=getCurrentCity();
		   
		   if($city_list) {  foreach($city_list as $city) { ?>   
          
           
            <li><?php echo anchor('map/in/'.$city->city_name,$city->city_name);  ?></li>
           
           
           <?php } } else {  } ?>

       
        <div class="clear"></div>
    </ul>
    </div>
</div>

<!--<div class="comsoon">
	<h3 class="wer">Coming soon</h3>
    <div class="cil2">
    <ul>
        <li><a href="#">Vancouver</a></li>
        <li><a href="#">Calgary</a></li>
        <li><a href="#">Ottava</a></li>
        <li><a href="#">Montreal</a></li>
        <li><a href="#">Yukon</a></li>
        <li><a href="#">Nunavut</a></li>
    </ul>
    </div>
</div>-->
<div class="clear"></div>



<!--<div class="aligncen">
<div class="posrel">


<img src="<?php echo base_url().getThemeName(); ?>/images/mapn_iframe.png" alt="" usemap="#planetmap" width="452" height="218">

<map name="planetmap">

<area shape="circle" coords="33,130,22" id="Dscomsonbg1" title="" alt="Victoria" href="#"/>
<div id="Dcomsonbg1"></div>

<area shape="circle" coords="128,173,22" id="Dscomsonbg2" title="" alt="Toronto" href="#" />
<div id="Dcomsonbg2"></div>

<area shape="circle" coords="167,157,22" id="Dscomsonbg3" title="" alt="Montreal" href="#" />
<div id="Dcomsonbg3"></div>

<area shape="circle" coords="253,105,22" id="Dscomsonbg4" title="" alt="Los Angeles" href="http://google.com" />
<div id="Dcomsonbg4"></div>

<area shape="circle" coords="358,70,22" id="Dscomsonbg5" title="" alt="Chicago" href="#" />
<div id="Dcomsonbg5"></div>

<area shape="circle" coords="412,58,22" id="Dscomsonbg6" title="" alt="New York" href="#"/>
<div id="Dcomsonbg6"></div>

<area shape="rect" coords="65,162,20,152" alt="Victoria" href="#" />
<area shape="rect" coords="153,200,110,190" alt="Toronto" href="#" />
<area shape="rect" coords="200,185,150,175" alt="Montreal" href="#" />
<area shape="rect" coords="300,145,240,135" alt="Los Angeles" href="#" />
<area shape="rect" coords="385,105,340,95" alt="Chicago" href="#" />
<area shape="rect" coords="444,90,390,80" alt="New York" href="#" />
</map>

</div></div>-->

</div>