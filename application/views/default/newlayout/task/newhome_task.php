<!-- aToolTip css -->
<link type="text/css" href="<?php echo base_url().getThemeName(); ?>/css/atooltip.css" rel="stylesheet"  media="screen" />
<!-- aToolTip js -->
<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/jquery.atooltip.js"></script>

<link type="text/css" rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/js/css/category-slider-fancy-newtask_new1.css"/>

<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/lib/category-slider-fancy-newtask.js"></script>

	<script type="text/javascript">

			jQuery(function($) {

				

/*s*/
	$('#changetask').click(function() {
	 jQuery('#hidetask').hide();	
	 jQuery('#showtask').show();	
	});
	$('#changetask1').click(function() {
	 jQuery('#hidetask').hide();	
	 jQuery('#showtask').show();	
	});
	$('#showtask').click(function() {
	 jQuery('#showweek').show();
	 jQuery('#changetask').hide();	
	});
/*e*/


/*s*/
	$('#changeauto').click(function() {
	 jQuery('#hideauto').hide();
	 jQuery('#changeauto').hide();	 
	 jQuery('#showauto').show();	
	});

	$('#changeauto1').click(function() {
	 jQuery('#hideauto').hide();
	 jQuery('#changeauto').hide();	 
	 jQuery('#showauto').show();	
	});


	jQuery('#showp1').click(function (){
		jQuery('#dialog-form-p1').show();
	});
	jQuery('#closep1').click(function (){
		jQuery('#dialog-form-p1').fadeOut("fast");
	});

	jQuery('#showp2').click(function (){
		jQuery('#dialog-form-p2').fadeIn("fast");
	});
	jQuery('#closep2').click(function (){
		jQuery('#dialog-form-p2').fadeOut("fast");
	});

	jQuery('#showp3').click(function (){
		jQuery('#dialog-form-p3').fadeIn("fast");
	});
	jQuery('#closep3').click(function (){
		jQuery('#dialog-form-p3').fadeOut("fast");
	});


	$('#dibs3').click(function() {
	 jQuery('#showdibs').show();
	});
	$('#dibs1').click(function() {
	 jQuery('#showdibs').hide();
	});
	$('#dibs2').click(function() {
	 jQuery('#showdibs').hide();
	});
	
/*e*/
				

       });
    </script>
    <script type="text/javascript">
  function fr_check()
  {
  	if(document.frm_new_task.task_state_id.value=="")
  	{
  		alert("Välj område");
  		return false;
  	}
  	if(document.frm_new_task.task_city_id.value=="")
  	{
  		alert('Välj område');
  		return false;
  	}
  	//alert($('input[name=user_location_id[]]:checked').length);
  	//return false;
  	if(document.getElementById("no").value=="0")
  	{


	  	var address1 = $("#address1");
	  	//alert(address1.val());
	  	//return false;
	  	var count = $('input[name=user_location_id[]]:checked').length;
		if($('input[name=user_location_id[]]:checked').length >count)
		{
			//alert($('input[name=user_location_id[]]:checked').length);
			return true;
		}
		
		else
		{
			 
			if(address1.val()=='')
				{
					alert('Vänligen välj adress!');
	  				return false;
				}
			//alert('hii');return false;
		}
	}

	return false;
	
  	
  }
  function onlin_chk()
  {
  	if(document.getElementById("yes").value=="1")
  	{
  			document.getElementById("add").style.display = "none";
  			
  	}
  	
  }
  function offlin_chk()
  {
    if(document.getElementById("no").value=="0")
  	{
  		document.getElementById("add").style.display = "block";
  		
  	}
  }
  

  </script>
<script type="text/javascript">
	$(function(){ 
		$('#task_city_id.normalTip').aToolTip();
	}); 
</script>
<script type="text/javascript">
                                $(document).ready(function(){
                                    $("#add_new_address").click(function(){
                                        $("#new_address").slideToggle();
                                    })
                                })
                            </script>
<style>
.mid{ padding-top:70px; }
</style>
 <?php 
 $site_setting=site_setting();
$data['site_setting']=$site_setting;

$categories=get_category();
	$cat_id='';
	$category_image=base_url().'upload/category/no_image.png';
	
	
	if(isset($task_detail->task_category_id)) 
	{ 
		if($task_detail->task_category_id!='' && $task_detail->task_category_id>0) 
		{
			
		$cat_id	= $task_detail->task_category_id;
		  
	 } } 
	 if($cat_id=='') { 
	 
	 	if($categories){
					foreach($categories as $c){
					
					$cat_id=$c->task_category_id;
					
						

		
					if($c->category_image!='') {  
					
						if(file_exists(base_path().'upload/category_orig/'.$c->category_image)) { 
							
							$category_image=base_url().'upload/category_orig/'.$c->category_image;
						
						}
						
					}
					
					
					break;
					
					}
			}
	 
	 }
	 
	
	 ?>
    <script type="text/javascript">
				
					var catid='<?php echo 'c'.$cat_id; ?>';
  				  var catimgsel='<?php echo $category_image; ?>';
	
		
					
					
					
					var selcatid=0;
					
					
							function getmyCat(id,obj)
							{
								//alert(obj.id);
							
							 $('.slidedivbox').each(function(){
							      
								  if(obj!="")
								  {
								    if(obj.id==$(this).attr('id'))
									{
									
										//alert($(this).attr('id'));
										 selcatid=$(this).attr('id');
										//$(this).removeClass("slidecatfancy");
										$(this).removeClass("deselected");
										$(this).addClass("selected");
										
										
									}
									 else
									  {
									  $(this).removeClass("slidecatfancy");
									  $(this).removeClass("selected");
									   $(this).addClass("deselected");
										

									  }	
								  }
								 
								  
							 })
								
								if(id=='')
								{
									document.getElementById('task_category_id').value=id;
									document.getElementById('results').innerHTML=document.getElementById('nm'+id).innerHTML;
									document.getElementById('selcatimg').src=document.getElementById('img'+id).src;
								
								}
								else
								{
									
								
									//alert(pid);
									document.getElementById('task_category_id').value=id;
									document.getElementById('results').innerHTML=document.getElementById('nm'+id).innerHTML;
									document.getElementById('selcatimg').src=document.getElementById('img'+id).src;
									
								}
							}
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
	
	getmyCat(catid,'');


});

</script>

<script type='text/javascript'>
       /* jQuery(document).ready(function(){
            jQuery( "#task_state_id" ).change(function() {
  			var task_state_id = $('#task_state_id').val(); 
        	alert(task_state_id);
        	list1 = '<option value="">Välj område</option>';
        	jQuery('#task_city_id').html(list1);
	        	jQuery.ajax({
		            type:'POST',
		            url:'<?php echo base_url(); ?>" + "index.php/task/task_city',
		            data:{'state_id':task_state_id},
		            success:function(list){
		                if(list.search(/\S/)!=-1){
		                    list1 = '<option value="">Välj område</option>'+list;
		                    jQuery('#task_city_id').html(list1);
		                	}
		            	}
	        	});
			});
        });*/

function get_city(city_id)
{
		
		
		//alert(city_id);
		
			
		/*var strURL='http://taskit.co.za/task/task_city/'+city_id;
		alert(strURL);	
		var xmlhttp;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  
		  }
		xmlhttp.onreadystatechange=function()
		  {
			 
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{	
			//alert(xmlhttp.responseText);
				if(xmlhttp.responseText=='login_failed')
				{
					window.location.href='http://taskit.co.za/sign_up/';				
				}
				else
				{
					//document.getElementById("favorite").innerHTML=xmlhttp.responseText;
					document.getElementById('citydiv').innerHTML=req.responseText; 
				}		
			}
		  }

		xmlhttp.open("GET",strURL,true);
		xmlhttp.send();*/
		jQuery.ajax({
		            type:'POST',
		            url:'<?php echo base_url()?>task/task_city/',
		            data:{'state_id':city_id},
		            success:function(list){
		                if(list.search(/\S/)!=-1){
		                    list1 = '<option value="">Välj Område</option>'+list;
		                    jQuery('#task_city_id').html(list1);
		                	}
		            	}
	        	});


}

</script>

<style>
	.fadeimg{background:#555;}
</style>
<!--banner-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
<div>
<div id="two-columnar-section" class="top-cont-main-dash">
<div class="db-rightinfo-dash">
    <div class="container">
    	<div class="red-subtitle red-subtitle-630"><div class="count-number-1">1</div>Skapa ett uppdrag</div>
        <div class="span3 wow fadeIn center animated animated" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;">
        <div class="home-signpost-content dashboard-box1 dashboard-box2">
        	
            <div class="fleft100 mtop15" >
                
				<?php //$site_setting=site_setting(); 
                    $attributes = array('name'=>'frm_new_task','onsubmit'=>'return fr_check()');
                    //if($task_id!='' && $task_id!=0) {  
                       //echo form_open('task/update_task_step_zero/'.$task_id,$attributes);
                    //}
                    //else
                    //{
                        echo form_open('task/new_task',$attributes);
                    //}
                ?>
                <?php $cities=city_list(); ?>
                <div class="main-selection">
                	<div class="top-selection" style="margin-top:10px;">
                        <div class="fl">
                        	<span class="select_dop_name select-title"><strong>Välj område via geografisk plats</strong></span>
                        </div>
                        <div class="fl">
                            <select name="task_state_id" id="task_state_id" class="selboxwi200 select_dop_name_box form-control select-width target" onchange="get_city(this.value)">
                                <option value="" >--Vänligen välj stad--</option>
                                <?php 
                                    if($state_list){
                                        foreach($state_list as $key=>$val){
                                ?>
                                <option value="<?php echo $val['state_id']; ?>" ><?php echo ucfirst($val['state_name']); ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>    
                    <div class="top-selection">
                    	<!--<div class="fl">
                        	<span class="select_dop_name select-title"><strong>Välj plats!</strong></span>
                        </div>-->
                        <div class="fl">
                            <select name="task_city_id" id="task_city_id" class="selboxwi200 select_dop_name_box form-control select-width" title="Välj plats!" style="margin-top:0px;">
                                <option value="">Välj Område</option>
                            </select>
                        </div>
                    </div>
                    <div class="left-online">
                                    <div class="firts_img-1">Can it be done online?</div>
                                    <div class="yes-no-section">
                                        <div class="yes-no-section-1 left_round"><input type="radio" name="done_online" id="no" value="0" checked="true" onclick="offlin_chk()"/><label for="no">No</label></div>
                                        <div class="yes-no-section-1 right_round"><input type="radio" name="done_online" id="yes" value="1" onclick="onlin_chk()"/><label for="yes">Yes</label></div>
                                    </div>
                                </div>
                <div id="add">
                    <div class="fl" style="margin-bottom:8px;">
                        <span class="select_dop_name select-title"><strong>Adress </strong></span>
                    </div>
                    <div class="">
                        <div class="implcr wid550" style="float:left;width: 100%;">
                            <?php 
                               $task_user_location=array();
                                if($task_location) 
                                {  
                                    foreach($task_location as $task_loc)
                                    { 
                                        $task_user_location[]=$task_loc->user_location_id;
                                    }
                                } 
                                if($user_location) {  
                            ?>
                            <ul>
                            <?php foreach($user_location as $location) { ?>
                                <li class="main-title" style="font-weight:normal; clear:both; padding:0px; margin-bottom:20px; font-size:16px;">
                                    <input type="checkbox" name="user_location_id[]" id="user_location_id" value="<?php echo $location->user_location_id; ?>" <?php if(($location->is_home==1) || (in_array($location->user_location_id,$task_user_location) || ($location->is_home==1)) ) { ?> checked="checked" <?php } ?> />
                                    &nbsp;<?php echo ucfirst($location->location_name);?> 
                                    (
                                    <?php if($location->location_address!='') { echo $location->location_address.', '; }
                                    if($location->location_city!='') { echo $location->location_city.', '; }
                                    if($location->location_state!='') { echo $location->location_state.', '; }
                                    if($location->location_zipcode!='') { echo $location->location_zipcode; } 
                                    ?>
                                    )
                                </li>  
                                
                             <?php } ?>
                             </ul>
                            <?php  } ?>
                            <div class="clear"></div>
                            <script type="text/javascript">
                                function LTrim( value ) {
                                    
                                    var re = /\s*((\S+\s*)*)/;
                                    return value.replace(re, "$1");
                                    
                                }
                                
                                // Removes ending whitespaces
                                function RTrim( value ) {
                                    
                                    var re = /((\s*\S+)*)\s*/;
                                    return value.replace(re, "$1");
                                    
                                }
                                
                                // Removes leading and ending whitespaces
                                function trim( value ) {
                                    
                                    return LTrim(RTrim(value));
                                    
                                }
                                
                                
                                
                                
                                function removeHTMLTags(str){
                                    
                                        var strInputCode = str;
                                        
                                        strInputCode = strInputCode.replace(/&(lt|gt);/g, function (strMatch, p1){
                                            return (p1 == "lt")? "<" : ">";
                                        });
                                        var strTagStrippedText = strInputCode.replace(/<\/?[^>]+(>|$)/g, "");
                                        return strTagStrippedText;	
                                   
                                    
                                }
                        </script>
                            <script type="text/javascript">
                        function append_div2()
                        {
                        
                           var numi = document.getElementById('savelocation');
                           var num = eval((document.getElementById('savelocation').value))+ 1;
                           numi.value = num;
                            
                           var tmp_div2 = document.createElement("li");
                           var content = document.getElementById('more2').innerHTML; //alert(content);
                           content=content.replace(/address/g,"address"+num);
                           content=content.replace(/zipcode/g,"zipcode"+num);
                           content=content.replace(/locationname/g,"locationname"+num);
                           content=content.replace(/savelocation/g,"savelocation"+num);
                           content=content.replace(/disabled="disabled"/g,"");
                        
                        
                        tmp_div2.className = "inner_content_"+num;
                        tmp_div2.innerHTML = content;;
                        //tmp_div2.innerHTML = document.getElementById('more2').innerHTML;
                        document.getElementById('add_more2').appendChild(tmp_div2);
                        
                        /*
                        var myVerticalSlide2 = new Fx.Slide('add_more2');
                        myVerticalSlide2.slideIn();*/
                        }
                        
                        
                        function remove_div2(e){
                        var pid=e.parentNode;
                        var i = pid.parentNode;
                        i.style.display="none";
                        }
                        
                        </script>
                            <script src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"   type="text/javascript"></script>        
                            <script type="text/javascript">
                          function initialize() {
                            var mapOptions = {
                              center: new google.maps.LatLng(51.510866, -0.120238),
                              zoom: 13,
                              mapTypeId: google.maps.MapTypeId.ROADMAP
                            };
                            var map = new google.maps.Map(document.getElementById('map_canvas'),
                              mapOptions);
                    
                            var input = document.getElementById('address1');
                            var autocomplete = new google.maps.places.Autocomplete(input);
                    
                            autocomplete.bindTo('bounds', map);
                    
                            var infowindow = new google.maps.InfoWindow();
                            var marker = new google.maps.Marker({
                              map: map
                            });
                    
                            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                              infowindow.close();
                              var place = autocomplete.getPlace();
                              if (place.geometry.viewport) {
                                map.fitBounds(place.geometry.viewport);
                              } else {
                                map.setCenter(place.geometry.location);
                                map.setZoom(17);  // Why 17? Because it looks good.
                              }
                    
                              var image = new google.maps.MarkerImage(
                                  place.icon,
                                  new google.maps.Size(71, 71),
                                  new google.maps.Point(0, 0),
                                  new google.maps.Point(17, 34),
                                  new google.maps.Size(35, 35));
                              marker.setIcon(image);
                              marker.setPosition(place.geometry.location);
                              
                            var full_address= document.getElementById("address1").value;		
                            var explode=full_address.split(",");		
                            var total=explode.length;
                            document.getElementById('location_state').value=trim(explode[total-2]).replace(/[0-9]/g, '');		
                            document.getElementById('location_city').value=trim(explode[total-3]);
                    
                            
                            });
                    
                           
                          }
                          google.maps.event.addDomListener(window, 'load', initialize);
                        </script>
                            
                            <!--<div class="divider divider-ver"><h2>OR</h2></div>-->
                            <div id="add_new_address"><a href="javascript:void(0)" style="text-decoration:underline;"><b>Lägg till adress</b></a></div>
                            <div class="inner_content_two add-more main-page" id="new_address" style="margin-top:10px; display:none;">
                                <ul id="add_more2">
                                    <li id="more2" >
                                        <div class="addleft LH30" >
                                            <table width="100%" border="0" cellspacing="1" cellpadding="0">
                                              <tr id="address1TR">
                                                <td valign="top" width="25%" style="padding-bottom: 5px"><label class="main-title">Adress:</label></td>
                                              </tr>
                                              <tr>
                                                <td><input name="address1" class="form-control add-text" style="float:left;" id="address1" type="text" value="<?php echo $address1; ?>" size="18"  placeholder="Skriv in adress" /></td>
                                              </tr>
                                              <tr id="zipcodeTR">
                                                <td valign="top" style="padding-bottom: 5px"><label class="main-title">Postkod: </label></td>
                                              </tr>
                                              <tr>
                                                <td><input name="zipcode" id="zipcode" class="form-control add-text" style="float:left;" type="text" size="18" placeholder="Ange postkod"  />
                                                    <input type="hidden" name="location_state" id="location_state" value=""/>
                                                    <input type="hidden" name="location_city" id="location_city" value=""/>
                                                </td>
                                              </tr>
                                              <tr id="locationnameTR">
                                                <td valign="top" style="padding-bottom: 5px"> <label class="main-title">Namnge platsen: </label></td>
                                              </tr>
                                              <tr>
                                                <td><input name="locationname" id="locationname" class="form-control add-text" style="float:left;" type="text" size="18" placeholder="Hem, kontoret, etc"/><?php $location_cnt = 1; ?>
                                                </td>
                                              </tr>
                                             
                                              <tr>
                                                <td colspan="2">
                                                  <label class="main-title" style="font-weight:normal; padding:0px; margin-bottom:0px; font-size:15px;"><input type="checkbox" name="savelocation" value="<?php echo $location_cnt;?>" id="savelocation" /> &nbsp; Spara adress </label>
                                                </td>
                                              </tr>
                                            </table>
                                        </div>
                                        <div class="clear"></div>
                                  </li>
                              </ul>
                          </div>
                        </div>
                        <div class="clear"></div>                
                    </div>
                </div>
                </div>
                
                <div> 
                    
                <?php 
                $cat_page=array_key_exists('c'.$cat_id,$cat_arr); 
                $catpagebouns=0;
                if($cat_page) { $catpagebouns=$cat_arr['c'.$cat_id]; }  
                ?>
                <script type="text/javascript">
                
                    var catpageid='<?php echo $catpagebouns; ?>';
                
                if(catpageid=='') { catpageid=0; }
                
                //alert(catpageid);
                
                            jQuery(function($){
                                        
                                $("#carousel-cat-fancy").rcarousel({
                                    visible: 6,
                                    step: 3,
                                    width: 150,
                                    height: 150,
                                    startAtPage:catpageid,
                                    auto: {
                                        enabled: false,
                                        interval: 1000,
                                        direction: "next"
                                    }	
                                    
                                    
                                    
                                });
                                
                                $("#ui-carousel-next-cat-fancy")
                                    .add("#ui-carousel-prev-cat-fancy")
                                    .hover(
                                        function(){
                                            $(this).css("opacity",0.7);
                                        },
                                        function(){
                                            $(this).css("opacity",1.0);
                                        }
                                    );				
                            });
                        </script>
                <!-- cat slider e -->  
                <div class="underl posrel category1" style="display:none;">
                    <table width="90%" border="0" align="center" cellspacing="1" cellpadding="5">
                        <tr>
                            <td width="7%"  valign="top"><div class="refresbg"></div></td>
                            <td width="78%">
                                <div id="hidetask">This Task  
                                    <a href="javascript:void();" class="plinks" id="changetask1">
                                    <?php if(isset($task_detail->task_repeat)) { if($task_detail->task_repeat==1) {?>repeats<?php } else { ?>does not repeat<?php } } else {?>does not repeat<?php }?>
                                    </a> 
                                    <span class="req">Need it done weekly? Every two weeks? <!--<a href="#" class="fpass">Learn more</a>--></span>
                                </div>
                                <div id="showtask" style="display:none;">
                                    <label style="cursor:pointer; "><input type="radio" name="repeatenable" value="0" <?php if(isset($task_detail->task_repeat)) {  if($task_detail->task_repeat==0) {?> checked="checked" <?php } } ?> id="repeatenable" />This Task does not repeats regularly</label>
                                    <br />
                                    <label style="cursor:pointer; "><input type="radio" name="repeatenable" value="1" <?php if(isset($task_detail->task_repeat)) {  if($task_detail->task_repeat==1) {?> checked="checked" <?php } } ?> id="repeatenable" />This Task repeats regularly
                                        <div id="showweek" style="  display:<?php  if(isset($task_detail->task_repeat)) { if($task_detail->task_repeat==1) {?>block<?php } else { ?>none <?php } } else { ?>none<?php } ?>; margin-left:173px; margin-top:-20px;">
                                            <select name="task_repeat_week" id="task_repeat_week">
                                                  <option value="1" <?php if(isset($task_detail->task_repeat_week)) { if($task_detail->task_repeat_week==1) { ?> selected="selected" <?php } } ?>>1 week</option>
                                                  <option value="2" <?php if(isset($task_detail->task_repeat_week)) { if($task_detail->task_repeat_week==2) { ?> selected="selected" <?php } }?>>2 weeks</option>
                                                  <option value="3" <?php if(isset($task_detail->task_repeat_week)) { if($task_detail->task_repeat_week==3) { ?> selected="selected" <?php } } ?>>3 weeks</option>
                                                  <option value="4" <?php if(isset($task_detail->task_repeat_week)) { if($task_detail->task_repeat_week==4) { ?> selected="selected" <?php } } ?>>4 weeks</option>
                                                  <option value="5" <?php if(isset($task_detail->task_repeat_week)) { if($task_detail->task_repeat_week==5) { ?> selected="selected" <?php } } ?>>5 weeks</option>
                                                  <option value="6" <?php if(isset($task_detail->task_repeat_week)) { if($task_detail->task_repeat_week==6) { ?> selected="selected" <?php } } ?>>6 weeks</option>
                                                  <option value="7" <?php if(isset($task_detail->task_repeat_week)) { if($task_detail->task_repeat_week==7) { ?> selected="selected" <?php } } ?>>7 weeks</option>
                                                  <option value="8" <?php  if(isset($task_detail->task_repeat_week)) { if($task_detail->task_repeat_week==8) { ?> selected="selected" <?php } } ?>>8 weeks</option>
                                              </select>
                                        </div>
                                    </label>
                                </div>
                            </td>
                            <td width="15%"><a href="javascript:void();" class="chbg" id="changetask">Change</a></td>
                        </tr>
                    </table>
                </div>
                <div class="underl" style="display:none;">
                    <table width="90%" border="0" align="center" cellspacing="1" cellpadding="5">
                      <tr>
                        <td width="7%" valign="top"><div class="icardbg"></div></td>
                        <td width="78%"><div id="hideauto">
                        
                        
                         <?php //if($task_id!='' && $task_id!=0) {  
                         
                         
                         /*if($task_detail->task_auto_assignment==2 ) { ?> 
                           
                           <a href="javascript:void();"  class="fpass" id="changeauto1"> Let me </a>  review the Worker bee who make offers 
                           
                            <?php } elseif($task_detail->task_auto_assignment==3) {?>
                            
                            Give first dibs to <a href="javascript:void();"  class="fpass" id="changeauto1">
                            <?php 
                                $worker_detail=$this->worker_model->get_worker_info($task_detail->task_assing_worker);
                                echo ucfirst($worker_detail->first_name).' '.ucfirst($worker_detail->last_name); ?> </a>
                            
                            <?php 
                
                            }else { ?>
                            
                         We'll <a href="javascript:void();"  class="fpass" id="changeauto1">   auto-assign</a> the Worker bee who makes the best offer
                         
                      
                            
                            <?php }  
                            
                            
                            } elseif($task_assign_worker != '' && $task_assign_worker != 0){
                            
                                    $worker_detail=$this->worker_model->get_worker_info($task_assign_worker);
                                    echo 'Give first dibs to <a href="javascript:void();"  class="fpass" id="changeauto1">';
                                    echo ucfirst($worker_detail->first_name).' '.ucfirst($worker_detail->last_name);
                                    echo '</a>';
                            }  else { ?>
                            
                         We'll <a href="javascript:void();"  class="fpass" id="changeauto1">   auto-assign</a> the Worker bee who makes the best offer
                          
                          
                            
                            <?php }   ?>
                        */?>
                        We'll <a href="javascript:void();"  class="fpass" id="changeauto1">   auto-assign</a> the Worker bee who makes the best offer
                        
                        </div>
                        <div id="showauto" style="display:none;">
                        
                            <ul>
                                 <li style="position:relative;">
                                
                                       <label id="dibs1" class="curp fl">
                                          <input type="radio" name="autoassign" value="1" checked="checked" id="autoassign"   <?php if(isset($task_detail->task_auto_assignment)) { if($task_detail->task_auto_assignment==1)  { ?> checked="checked" <?php } } ?>  />
                                         Auto-assign the Worker bee who makes the best offer</label> <a href="javascript:void();" id="showp1" class="fl marTL5"><div class="questions" ></div></a>
                                 
                    <div id="dialog-form-p1">
                        <h3 class="fl">Auto Assign</h3>
                        <a href="javascript:void();" class="fr"  id="closep1" title="close" ><div class="closebg" ></div></a><div class="clear"></div>
                        <p class="lineh17 padTB3">The quickest way to get stuff done: We'll automatically assign the Worker bee who makes the best offer. You sit back and let us take care of everything.</p>
                    </div>
                                      <div class="clear"></div>       
                                 </li>
                                 
                                 <li style="position:relative;">
                                 
                               <label id="dibs2"  class="curp fl">
                                 <input type="radio" name="autoassign" value="2"   id="autoassign"   <?php if(isset($task_detail->task_auto_assignment)) {  if($task_detail->task_auto_assignment==2) { ?> checked="checked"  <?php } } ?> />
                                 Let me review the Worker bee who make offers</label> <a href="javascript:void();" id="showp2" class="fl marTL5" ><div class="questions" ></div></a><div class="clear"></div>
                                 <div class="req marL25">(Auto-assign may still occur if unassigned by deadline)</div>
                    
                    <div id="dialog-form-p2">
                        <h3 class="fl">Let me review</h3>
                        <a href="javascript:void();" class="fr"  id="closep2" title="close" ><div class="closebg" ></div></a><div class="clear"></div>
                        <p class="lineh17 padTB3">You'll be able to review every Worker bee who offers to do your Task. Accept the offer you like, or Decline those you don't. If the Task is still unassigned and it's getting close to your complete deadline, we will auto-assign the best offer that meets your price, if you haven't declined it.</p>
                    </div>
                                 
                                 <div class="clear"></div>
                                 </li>
                                 
                                 <li style="position:relative;">
                               <label id="dibs3" class="curp fl">
                               <?php //if($task_assign_worker != '' && $task_assign_worker != 0) { ?>
                                 <!--<input type="radio" name="autoassign" value="3" id="autoassign"  checked="checked"/>-->
                                 
                               <?php //} else { ?>
                               
                                 <input type="radio" name="autoassign" value="3" id="autoassign"  <?php if(isset($task_detail->task_auto_assignment)) {  if($task_detail->task_auto_assignment==3) { ?> checked="checked" <?php }} ?> />
                                 
                                 <?php //} ?>
                                 
                                 Give first dibs to a <?php echo $site_setting->site_name;?> I've worked with before</label> <a href="javascript:void();" id="showp3" class="fl marTL5"><div class="questions" ></div></a><div class="clear"></div>
                   
                    <div id="dialog-form-p3">
                        <h3 class="fl">Let me give dibs</h3>
                        <a href="javascript:void();" class="fr"  id="closep3" title="close" ><div class="closebg" ></div></a><div class="clear"></div>
                        <p class="lineh17 padTB3">The Worker bee you choose will have a period of exclusivity where only he or she can be assigned. If your chosen Worker bee does not respond, the exclusivity is lifted and it's up for grabs. You will be able to accept or decline offers from other Worker bees.</p>
                    </div>             
                
                   <?php /*if($task_assign_worker != '' && $task_assign_worker != 0) { ?>
                   
                        <ul id="showdibs" class="sbid marL25" style="display:block;">
                            <li class="posrel"><label>
                            <input type="radio" checked="checked"  name="worker" value="<?php echo $task_assign_worker;?>" id="worker" />
                            <?php 
                                    $tasker=$this->worker_model->get_worker_info($task_assign_worker);
                                    echo ucfirst($tasker->first_name).' '.ucfirst(substr($tasker->last_name,0,1)).'.';
                            ?>
                            </label>
                                <div class="abcpt4 fn">
                                
                                
                                <?php
                                
                                
                         $user_image= base_url().'upload/no_image.png';
                 
                         if($tasker->profile_image!='') {  
                    
                            if(file_exists(base_path().'upload/user/'.$tasker->profile_image)) {
                        
                                $user_image=base_url().'upload/user/'.$tasker->profile_image;
                                
                            }
                            
                        }
                        
                        ?>
                                    <a href="#"><img src="<?php echo $user_image;?>" alt="" width="50" height="50" /></a>
                                    <div class="sp1" id="twoonebr2"><?php echo $tasker->worker_level; ?></div>
                                </div>
                                <div class="clear"></div>
                            
                            </li>
                            <div class="clear"></div>
                        </ul>
                    
                   <?php } else {?>*/
                   ?>
                     <ul id="showdibs" class="sbid marL25" style="display:<?php if(isset($task_detail->task_auto_assignment)) { if($task_detail->task_auto_assignment==3) { ?>block <?php } else { ?>none<?php } } else {?>none<?php } ?>;">
                    <?php if($taskers) { foreach($taskers as $tasker) { //echo '<pre>'; print_r($task_detail); 
                            if(!empty($task_detail)) {
                            
                            if(($task_detail->task_assing_worker > 0 )&& ($task_detail->task_auto_assignment==3)){ 
                            
                            
                            
                                 $tasker=$this->worker_model->get_worker_info($task_detail->task_assing_worker);
                                
                         $user_image= base_url().'upload/no_image.png';
                 
                         if($tasker->profile_image!='') {  
                    
                            if(file_exists(base_path().'upload/user/'.$tasker->profile_image)) {
                        
                                $user_image=base_url().'upload/user/'.$tasker->profile_image;
                                
                            }
                            
                        }
                        
                        
                            
                                if( $task_detail->task_assing_worker ==  $tasker->worker_id) { ?>
                                <li class="posrel"><label><input type="radio" <?php if($task_id!='' && $task_id!=0) {  if($task_detail->task_assing_worker!='' && $task_detail->task_assing_worker>0 && $task_detail->task_assing_worker==$tasker->worker_id) { ?>checked="checked" <?php } else { ?> checked="checked" <?php } } else {?> checked="checked" <?php } ?> name="worker" value="<?php echo $tasker->worker_id;?>" id="worker" /><?php echo ucfirst($tasker->first_name).' '.ucfirst(substr($tasker->last_name,0,1)).'.';?></label>
                            <div class="abcpt4 fn">
                                <a href="#"><img src="<?php echo $user_image;?>" alt="" width="50" height="50" /></a>
                                <div class="sp1" id="twoonebr2"><?php echo $tasker->worker_level; ?></div>
                            </div>
                            <div class="clear"></div>
                        
                        </li>
                        <?php } } else {  
                        
                        
                            
                                
                         $user_image= base_url().'upload/no_image.png';
                 
                        
                         if($task_detail->task_assing_worker!='' && $task_detail->task_assing_worker>0)
                         {
                            
                             $tasker=$this->worker_model->get_worker_info($task_detail->task_assing_worker);
                             
                         if($tasker->profile_image!='') {  
                    
                            if(file_exists(base_path().'upload/user/'.$tasker->profile_image)) {
                        
                                $user_image=base_url().'upload/user/'.$tasker->profile_image;
                                
                            }
                            
                        }
                        }
                        
                        ?>
                        <li class="posrel"><label><input type="radio" <?php if($task_id!='' && $task_id!=0) {  if($task_detail->task_assing_worker!='' && $task_detail->task_assing_worker>0 && $task_detail->task_assing_worker==$tasker->worker_id) { ?>checked="checked" <?php } else { ?> checked="checked" <?php } } else {?> checked="checked" <?php } ?> name="worker" value="<?php echo $tasker->worker_id;?>" id="worker" /><?php echo ucfirst($tasker->first_name).' '.ucfirst(substr($tasker->last_name,0,1)).'.';?></label>
                            <div class="abcpt4 fn">
                                <a href="#"><img src="<?php echo $user_image;?>" alt="" width="50" height="50" /></a>
                                <div class="sp1" id="twoonebr2"><?php echo $tasker->worker_level; ?></div>
                            </div>
                            <div class="clear"></div>
                        
                        </li>
                        <?php } } else {
                    
                /*	if($task_detail->task_assing_worker!='' && $task_detail->task_assing_worker>0 && $task_detail->task_assing_worker==$tasker->worker_id) { ?>
                    
                      <li class="posrel"><label><input type="radio" checked="checked" name="worker" value="<?php echo $tasker->worker_id;?>" id="worker" /><?php echo ucfirst($tasker->first_name).' '.ucfirst(substr($tasker->last_name,0,1)).'.';?></label>
                            <div class="abcpt4 fn">
                                <a href="#"><img src="<?php echo base_url().getThemeName(); ?>/images/per.jpg" alt="" width="50" height="50" /></a>
                                <div class="sp1" id="twoonebr2"><?php echo $tasker->worker_level; ?></div>
                            </div>
                            <div class="clear"></div>
                        
                        </li>
                    
                    
                    <?php } else { */
                    
                                
                                
                                 $tasker=$this->worker_model->get_worker_info($tasker->worker_id);
                                
                         $user_image= base_url().'upload/no_image.png';
                 
                         if($tasker->profile_image!='') {  
                    
                            if(file_exists(base_path().'upload/user/'.$tasker->profile_image)) {
                        
                                $user_image=base_url().'upload/user/'.$tasker->profile_image;
                                
                            }
                            
                        }
                        
                    ?>
                    
                        <li class="posrel"><label><input type="radio" <?php if($task_id!='' && $task_id!=0) {  if($task_detail->task_assing_worker!='' && $task_detail->task_assing_worker>0 && $task_detail->task_assing_worker==$tasker->worker_id) { ?>checked="checked" <?php } else { ?> checked="checked" <?php } } else {?> checked="checked" <?php } ?> name="worker" value="<?php echo $tasker->worker_id;?>" id="worker" /><?php echo ucfirst($tasker->first_name).' '.ucfirst(substr($tasker->last_name,0,1)).'.';?></label>
                            <div class="abcpt4 fn">
                                <a href="#"><img src="<?php echo $user_image;?>" alt="" width="50" height="50" /></a>
                                <div class="sp1" id="twoonebr2"><?php echo $tasker->worker_level; ?></div>
                            </div>
                            <div class="clear"></div>
                        
                        </li>
                        
                      <?php }  
                      
                       } ?>
                        <div class="clear"></div>
                    </ul>
                   
                   <?php }  ?>
                    
                   
                                 
                                 <div class="clear"></div>
                                </li>
                                
                
                            </ul>            	
                        </div>
                        
                        </td>
                        <td width="15%"><a href="javascript:void();" class="chbg" id="changeauto">Change</a></td>
                      </tr>
                    </table>
                </div>
                <div class="button-main">
                    <input name="sub_step" class="btn btn-default find-friends-btn" value="Spara &amp; forts&#228tt" type="submit" style="">    
                    <!--<input type="hidden" name="task_id" id="task_id" value="<?php echo $task_id; ?>" />   
                    <input type="hidden" name="copy" id="copy" value="<?php echo $copy; ?>" />      
                    <p class="small-grey">Next step: Add more details, locations, and name your price.</p>-->
                </div>
                
                </form>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        </div>
    </div>
</div>
    
<link href="<?php echo base_url().getThemeName(); ?>/css/new_me.css" rel="stylesheet" type="text/css">