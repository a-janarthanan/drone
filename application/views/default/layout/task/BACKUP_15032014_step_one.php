<script type="text/javascript">
$(document).ready(function() {	
	
	$("#various3").fancybox();
	$("#various4").fancybox();
	$("#various5").fancybox();
	
	$("#selmycity").fancybox();


});
</script>
<script type="text/javascript">
$(document).ready(function(){
						   
	$('#changeprice').click(function() {
	 jQuery('#changeprice').hide();	
	 jQuery('#lesf').hide();	
	 jQuery('#spend').show();	
	});
	$('#lesf').click(function() {
	 jQuery('#changeprice').hide();	
	 jQuery('#lesf').hide();	
	 jQuery('#spend').show();	
	});

	$('#cline').click(function() {
	 jQuery('#hline').hide();
	 jQuery('#sline').show();
	});

	$('#cline1').click(function() {
	 jQuery('#hline').hide();
	 jQuery('#sline').show();
	});


	$('#rloc').click(function() {
	 jQuery('#more2').hide();
	});

	jQuery('#mdprivate').click(function (){
		jQuery('#dialog-form-mdprivate').fadeIn("fast");
		jQuery('.wrap').show();
		
	});
	jQuery('#closemdprivate').click(function (){
		jQuery('#dialog-form-mdprivate').fadeOut("fast");
		jQuery('.wrap').hide();	
	});


	jQuery('#stp').click(function (){
		jQuery('#dialog-form-stp').fadeIn("fast");
		jQuery('.wrap').show();
		
	});
	
	
	jQuery('#stp2').click(function (){
		jQuery('#dialog-form-stp2').fadeIn("fast");
		jQuery('.wrap').show();
		
	});
	
	
	jQuery('#stp3').click(function (){
		jQuery('#dialog-form-stp3').fadeIn("fast");
		jQuery('.wrap').show();
		
	});
	
	
	
	jQuery('#closestp').click(function (){
		jQuery('#dialog-form-stp').fadeOut("fast");
		jQuery('.wrap').hide();	
	});


jQuery('#closestp2').click(function (){
		jQuery('#dialog-form-stp2').fadeOut("fast");
		jQuery('.wrap').hide();	
	});
	
	
	jQuery('#closestp3').click(function (){
		jQuery('#dialog-form-stp3').fadeOut("fast");
		jQuery('.wrap').hide();	
	});
	
	
	

	jQuery('#prino').click(function (){
		jQuery('#dialog-form-sprino').fadeIn("fast");
		jQuery('.wrap').show();
	});
	jQuery('#closesprino').click(function (){
		jQuery('#dialog-form-sprino').fadeOut("fast");
		jQuery('.wrap').hide();	
	});
	
	
	
	jQuery('#addpnote').click(function (){
	if(jQuery('#showpnote').css('display')=='none'){
		jQuery('#showpnote').show("fast");
	}
	else if(jQuery('#showpnote').css('display')=='block'){
		jQuery('#showpnote').hide("fast");
	}
	
	});


});

</script>


<div>
<div>

<div class="page-title mbot20">
<h1 class="mleft15">Post New Task</h1>
</div>
<?php if($error != '') { ?>     
  <div id="error"> 
						<div class="follfi">There were problems with the following fields:</div>
                        <ul>
							<?php echo $error; ?>
                            </ul>
			   </div>
<?php } ?>
<?php
	$attributes = array('name'=>'frm_new_task','id'=>'frm_new_task','class'=>'form_design');
	echo form_open('task/step_one/'.$task_id,$attributes);
	
	$site_setting=site_setting();
	$data['task_detail']=$task_detail;
	
	
	
		
		$category_image=base_url().'upload/category/no_image.png';

		
		if($task_detail->category_image!='') {  
		
			if(file_exists(base_path().'upload/category_orig/'.$task_detail->category_image)) { 
				
				$category_image=base_url().'upload/category_orig/'.$task_detail->category_image;
			
			}
			
		}
		
		$data['category_image']=$category_image;
	
	
?>


    	<div class="mconleft">
<!--<center>
           <img src="<?php echo base_url().getThemeName(); ?>/images/1n.png" alt=""  />
</center>   -->
<div class="fleftfw" style="text-align:center"><img src="<?php echo base_url().getThemeName(); ?>/images/posttask-status1.png" /></div>        
           
        
<div class="tabs1">
          <div class="under">
            <table width="100%" border="0" cellspacing="1" cellpadding="5">
              <tr>
                <td width="18%" rowspan="2"><img src="<?php echo $category_image; ?>" width="94" height="94" alt="" /></td>
              </tr>
              <tr id="task_nameTR">
                <td width="82%"><label> Task Title</label> <span id="req" style="color:red;">*</span><br/>
				<input type="hidden" value="<?php echo $task_id;?>" id="task_id" name="task_id" />
                <input name="task_name" type="text" class="ntext" value="<?php echo $task_name;?>" id="task_name"/><span id="task_name_symbol" style="float:right; height:30px; margin-right:20px;"></span><br /><span id="task_nameInfo" style="height:5px;"></span></td>
              </tr>
            </table>
			</div>
            
            
			<div class="under posrel">
            <div class="fl" style="margin:0 0 0 15px;"><label>Task Description</label> <span id="req" style="color:red;">*</span> <span id="req" style="font-size:15px; font-style:italic;">(This description is public, <a href="javascript:void(0);" id="addpnote" class="fpass" style="color:#000000;
text-decoration:underline; font-weight:normal;">Add private notes here)</a></span></div>
            <a href="javascript:void(0);" id="prino"  class="fl marL5"><div class="questions"></div></a>
            <div class="clear"></div>
			<table width="100%" border="0" cellspacing="1" cellpadding="5">
              <tr id="task_descriptionTR">
			  <td>
				<textarea name="task_description" class="ntext m15" id="task_description" cols="73" rows="5"><?php echo $task_description;?></textarea><span id="task_description_symbol" style="float:right; height:30px; margin-right:5px; margin-top:45px;"></span><br /><span id="task_descriptionInfo" style="height:5px;"></span>
			  </td>
			  </tr>
				<tr>
					<td>
					<div id="dialog-form-sprino">
						<h3 class="fl">Private Notes</h3>
						<a href="javascript:void(0);" class="fr" id="closesprino" title="close" ><div class="closebg" ></div></a><div class="clear"></div>
						<p class="padTB3">Use private notes for sensitive info. Private notes will be shared only with the assigned Worker bee.</p>
					</div>   
					</td>
				</tr>
			</table>			

            
            <div id="showpnote" style="display:none;margin:0 0 0 15px;">
            <label>Private Notes</label>
            <textarea name="more_details" id="more_details" cols="73" rows="2" placeholder="These may include where you want a package dropped off if you're not home, where you've hidden a key for a Worker bee, a FedEx account number, etc."><?php echo $more_details;?></textarea>
           
            </div>
            
            
            </div>
            
            
            
			<div class="under">
            	<!--<div class="implcl" style="float:left;">
                	 <img src="<?php echo base_url().getThemeName(); ?>/images/map-loc.png" width="48" height="48" alt=""   />
                </div>-->
            	<div class="implcr wid550" style="float:left;width: 100%;">
                
                	<h3 class="section-title" style="width: 97%;">Full addresses shared only with the assigned Worker bee</h3>
                    
                    <?php 
					
					$task_user_location=array();
						
					 if($task_location) 
					 {  
					
							foreach($task_location as $task_loc)
							{ 
							
								$task_user_location[]=$task_loc->user_location_id;
							}
					 } 
					
					
					
					if($user_location) {  ?>
					<ul>
					<?php foreach($user_location as $location) { ?>
                            
                      <li><input type="checkbox" name="user_location_id[]" value="<?php echo $location->user_location_id; ?>" <?php if(($location->is_home==1) || (in_array($location->user_location_id,$task_user_location) || ($location->is_home==1)) ) { ?> checked="checked" <?php } ?> />&nbsp;<?php echo ucfirst($location->location_name);?><br />
<i class="location_detail">(<?php if($location->location_address!='') { echo $location->location_address.','; }

   if($location->location_city!='') { echo $location->location_city.','; }
   
    if($location->location_state!='') { echo $location->location_state.','; }
	
	 if($location->location_zipcode!='') { echo $location->location_zipcode; }
   
   ?>)</i>
</li>
                      
                     <?php } ?>
                     </ul>
                <?php  } ?>
                    
   
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
          center: new google.maps.LatLng(51.4992, 0.1247),
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
                    



          
                <div class="inner_content_two">
                    <ul id="add_more2">
                        <li id="more2" >
                            <div class="addleft LH30" style="float:left;width:281px;">
                    
                    <table width="100%" border="0" cellspacing="1" cellpadding="0">
                      <tr id="address1TR">
                        <td valign="top"><label>Address</label> <span id="req" style="color:red;">*</span></td>
						<td><input name="address1" id="address1" type="text" value="<?php echo $address1; ?>" size="22"  placeholder="Enter a location" /><span id="address1_symbol" style="float:right; height:30px;"></span><br /><span id="address1Info" style="height:5px;"></span></td>
                      </tr>
                      <tr id="zipcodeTR">
						<td valign="top"><label>Post Code</label> <span id="req" style="color:red;">*</span></td>
						<td><input name="zipcode" id="zipcode" type="text" size="22" placeholder="Post Code"  /><span id="zipcode_symbol" style="float:right; height:30px;"></span><br /><span id="zipcodeInfo" style="height:5px;"></span>
							<input type="hidden" name="location_state" id="location_state" value=""/>
							<input type="hidden" name="location_city" id="location_city" value=""/>
                        </td>
                      </tr>
                      <tr id="locationnameTR">
                        <td valign="top"> <label>Location name</label> <span id="req" style="color:red;">*</span></td>
						<td><input name="locationname" id="locationname" type="text" size="22" placeholder="Home,Sally's,etc"/><span id="locationname_symbol" style="float:right; height:30px;"></span><br /><span id="locationnameInfo" style="height:5px;"></span><?php $location_cnt = 1; ?>
						</td>
                      </tr>
					 
                      <tr>
                        <td colspan="2">
                          <label><input type="checkbox" name="savelocation" value="<?php echo $location_cnt;?>" id="savelocation" />Save this location </label>
                        </td>
                      </tr>
                    </table>
                    
                    </div>
                    
<div class="addright" style="width: 319px;">
	<!--<a href="javascript:void();" onclick="remove_div2(this)" class="fpass fr"><div class="closebg"><span class="padL15">remove</span></div></a>--><div class="clear"></div>
    
    
    
       
        <div  id="map_canvas" style="width:340px; height:125px; margin-top:5px;" ></div>
        
        
        
       
                    </div>                    
                        	<div class="clear"></div>
                        </li>
                    </ul>
                </div>
                   
                   <!-- <span> <a href="javascript:void();"  class="fpass fs13"  onclick="append_div2();" id="addloc">+ Add another location</a></span>-->
                    
                    
                </div>
				<div class="clear"></div>                
            </div>

           <?php /*?> <div class="under">
            	<div class="implcl" style="float:left;">
                	 <img src="<?php echo base_url().getThemeName(); ?>/images/money.png" width="48" height="48" alt=""   />
                </div>
            	<div class="implcr wid550" style="float:left;">
                	<label class="fl marR5">The <?php echo $site_setting->site_name;?> will need to spend&nbsp;</label>

                        <a href="javascript:void();" id="lesf" class="fl">less than <?php echo $site_setting->currency_symbol;?>25</a>
                        <a href="javascript:void();" class="chbg spend" id="changeprice">Change</a>
                    
<select name="spend" id="spend" style=" display:none;">
<option value="0"><?php echo $site_setting->currency_symbol;?>0</option>
<option selected="selected" value="2500">less than <?php echo $site_setting->currency_symbol;?>25</option>
<option value="5000">less than <?php echo $site_setting->currency_symbol;?>50</option>
<option value="10000">less than <?php echo $site_setting->currency_symbol;?>100</option>
<option value="20000">more than <?php echo $site_setting->currency_symbol;?>100</option>
</select>

<div class="clear"></div>

                </div>
                <div class="clear"></div>
            </div>  <?php */?>



            <div class="under posrel">
            	
            	<div class="implcr wid550 LH23" style="float:left;width:97%">
               <!-- <h3 class="section-title">How much are you willing to pay for this Task?</h3>
                <a href="javascript:void();" id="stp" class="fl marL5 marT2"><div class="questions" ></div></a>-->
				<label class="fl" style="background-color: #dddddd;color: #4d4d4d;font-family: Arial, Helvetica, sans-serif;font-size: 18px;font-style: normal;font-weight: normal;padding: 8px 10px;
margin-bottom: 6px;">How much are you willing to pay for this Task?</label>
                <a href="javascript:void();" id="stp" class="fl marL5 marT2"><div class="questions" ></div></a>
				<div id="dialog-form-stp" class="fs11 LH18">
                    <h3 class="fl">TaskPrice</h3>
                    <a href="javascript:void();" class="fr" id="closestp" title="close" ><div class="closebg" ></div></a><div class="clear"></div>
                    <p>Your Task will be visible only to Worker bee.</p>
                    <p>The most you would pay for the task to be completed. Task may be done for less.</p>
                    <p>Does not include expenses such as cost of groceries for a grocery pickup.</p>
                    <p>You can still accept offers over your TaskPrice.</p>


                    <ol class="ordlist fs11 LH18">
                        <li>Effort by the Worker bee</li>
                        <li>Skills needed</li>
                        <li>Time required</li>
                        <li>Distance travelled</li>
                     </ol>                    
                    
                </div>                
            	<div class="clear"></div>


              <table width="100%" border="0" cellspacing="1" cellpadding="5">
               <tr><td id="task_to_priceTR" width="5%"><b class="fs15">From <span id="req" style="color:red;">*</span>&nbsp;&nbsp;&nbsp;</b><span id="lesf"><?php echo $site_setting->currency_symbol;?></span><input name="task_to_price" id="task_to_price" type="text" size="5" value="<?php if($task_to_price==0.00 || $task_to_price==0) { } else { echo $task_to_price; } ?>" />&nbsp;&nbsp;<span id="task_to_price_symbol" style="float:right; height:30px;"></span><br /><span id="task_to_priceInfo" style="height:5px;"></span></td>
 
                
              <td id="task_priceTR" width="28%" style="padding-right: 10px;"><b class="fs15">To <span id="req" style="color:red;">*</span>&nbsp;&nbsp;&nbsp;</b> 
			  <span id="lesf">
			  <?php echo $site_setting->currency_symbol;?></span><input name="task_price" id="task_price" type="text" size="5" value="<?php  if($task_price==0.00 || $task_price==0) { } else { echo $task_price; } ?>" />
<?php if($task_detail->category_average_price>0) { ?><span id="lesf"><?php echo $site_setting->currency_symbol;?><?php echo $task_detail->category_average_price; ?></span><span id="task_price_symbol" style="float:right; height:30px;"></span><br /><span id="task_priceInfo" style="height:5px;"></span><?php } ?></td>
				<?php if($task_detail->category_average_price>0) { ?><td width="60%"> is the average price for similar Tasks</td><?php } ?></tr></table>
                <span id="req" class="lockbg">Your price is private and helps us determine when Worker bee make good offers    </span>
                </div>
                <div class="clear"></div>
            </div>  
            
            
            
            <div class="under posrel">
            	<!--<div class="implcl" style="float:left;">
                	 <img src="<?php echo base_url().getThemeName(); ?>/images/money.png" width="48" height="40" alt=""   />
                </div>-->
                
                <div class="implcr wid550 LH23" style="float:left;">
				
              <!-- <h3 class="section-title">Extra Costs</h3>
                <a href="javascript:void();" id="stp2" class="fl marL5 marT2"><div class="questions" ></div></a>-->
				<label class="fl" style="background-color: #dddddd;color: #4d4d4d;font-family: Arial, Helvetica, sans-serif;font-size: 18px;font-style: normal;font-weight: normal;padding: 8px 10px;
margin-bottom: 6px;">Extra Costs</label>
                <a href="javascript:void();" id="stp2" class="fl marL5 marT2"><div class="questions" ></div></a>

				<div id="dialog-form-stp2" class="fs11 LH18" style="display:none;">
                    <h3 class="fl">Extra Costs</h3>
                    <a href="javascript:void();" class="fr" id="closestp2" title="close" ><div class="closebg" ></div></a><div class="clear"></div>
                    <p>eg. cost of the coffee, lunch</p>
                                     
                    
                </div>                
            	<div class="clear"></div>


                <div class="area-ph">
                <span id="lesf"><?php echo $site_setting->currency_symbol;?></span><input name="extra_cost" class="ntext" id="extra_cost" type="text" size="5" value="<?php echo $extra_cost;?>" />
                </div>
                
                </div>
            
            <div class="implcl" style="float:left;">&nbsp;</div>
				<div class="area-ph">
            	<div class="implcr wid550 LH23" style="float:left;">
                <label class="fl">Extra Costs Description</label>
               
				                
            	<div class="clear"></div>


                 <textarea name="extra_cost_description" id="extra_cost_description" cols="68" rows="5"><?php echo $extra_cost_description;?></textarea>
                
               
                
                </div>
				</div>
                
                <div class="clear"></div>
            </div>
            
            
            
            
            <?php /*?><div class="under posrel">
            	<div class="implcl" style="float:left;">
                	 <img src="<?php echo base_url().getThemeName(); ?>/images/money.png" width="48" height="40" alt=""   />
                </div>
                
                <div class="implcr wid550 LH23" style="float:left;">
                <label class="fl">Other Costs</label>
                <a href="javascript:void();" id="stp3" class="fl marL5 marT2"><div class="questions" ></div></a>

				<div id="dialog-form-stp3" class="fs11 LH18" style="display:none;">
                    <h3 class="fl">Other Costs</h3>
                    <a href="javascript:void();" class="fr" id="closestp3" title="close" ><div class="closebg" ></div></a><div class="clear"></div>
                    <p>eg. transportaion cost</p>
                                     
                    
                </div>                
            	<div class="clear"></div>


                
                <span id="lesf"><?php echo $site_setting->currency_symbol;?></span><input name="other_cost" id="other_cost" type="text" size="5" value="<?php echo $other_cost;?>" />
               
                
                </div>
                
                
                
                  <div class="implcl" style="float:left;">&nbsp;</div>
                  
            	<div class="implcr wid550 LH23" style="float:left;">
                <label class="fl">Other Costs Description</label>
               
				                
            	<div class="clear"></div>


                 <textarea name="other_cost_description" id="other_cost_description"cols="70" rows="5"><?php echo $other_cost_description;?></textarea>
                
               
                
                </div>
                <div class="clear"></div>
            </div><?php */?>
            
            
            
            <div class="area-ph">
            <div class="marTB10">
<input type="submit" name="sub_step1" class="submbg2" id="post_new_task" value="Save & Continue">            
<p class="small-grey">Next step: Review your Task before posting.</p>
</div></div>

			</div>
        
                
		</div>
        <?php echo $this->load->view($theme.'/layout/task/step_one_side_bar',$data); ?>  
        <div class="clear"></div>

</form>

    </div>
</div>

<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/validation.js"></script>
