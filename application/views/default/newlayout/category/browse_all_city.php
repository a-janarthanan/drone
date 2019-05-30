<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
	<div>
	
     <div class="red-subtitle top-red-subtitle" >Sök bland alla städer!</div>
    	<div class="profile_back">
        <div class="container">
        <div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
        <div class="home-signpost-content"> 

<div class="browseall">
<form>
<!--<table width="100%" border="0" cellspacing="1" cellpadding="5">
<tr>
<td align="left"><h1 id="bilt">We can do just about anything!</h1>
</td>
<td align="right">
<?php if(!check_user_authentication()) {  echo anchor('sign_up','Post a Task',' class="cm temp" ');  } else {       
        
        echo anchor('new_task','Post a Task',' id="various3" class="cm temp" '); } ?> 

</td>
</tr>
</table>-->

<div class="mostpop marTB10 cilnew" style="margin:0 0 0 15px;">
<ul>


             <?php
			 	 $city_list=city_list();
		  		 $current_city_id=getCurrentCity();
		 
		   		 if($city_list) {  foreach($city_list as $city) { ?>
                 
					
            		<li class="city_nam">
						<?php 
							
								echo anchor('taskers/'.$city->city_name,$city->city_name,'class="city_new"');
								//echo $city->city_name;
							
						?> 
                  </li>
				  
           <?php } }  ?>
</ul>

<div class="clear"></div>









</div>


</form>

</div>

<div class="clear"></div>
</div>

<div class="clear"></div>
</div>

<div class="clear"></div>

</div>

<div class="clear"></div>
</div>
