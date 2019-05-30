<style>
#copytask2{
	float: left;
width: 100%;
padding: 8px 0;
background: #f2413e;
text-align: center;
border-radius: 10px;
font-family: Century;
font-size: 20px;
color: #FFF;
font-weight: normal;
text-decoration: none;
margin: 0 0 10px 0;
}
</style>
<div class="mconright">
        
        
        
        
<?php   if(check_user_authentication()) { 
			  
			  		$check_worker_detail=$this->worker_model->check_user_worker_detail(get_authenticateUserID());
					
					if($check_worker_detail) { 
                 
				 	if(get_authenticateUserID() != $task_detail->user_id) { 
						
		 			
						$offer_user_detail=$this->user_model->get_user_profile_by_id(get_authenticateUserID());
						
						
		 				$get_worker_bid=$this->task_model->get_worker_bid_on_task($task_id);
						
						if($get_worker_bid)
						{  ?>
        
        <div class="borB">
        
        <div class="fl" style="width:100%;"><?php 
		
		$offer_user_image= base_url().'upload/no_image.png';
				 
				 if($offer_user_detail->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$offer_user_detail->profile_image)) {
				
						$offer_user_image=base_url().'upload/user/'.$offer_user_detail->profile_image;
						
					}
					
				}
				
				
		 echo anchor('user/'.$offer_user_detail->profile_name,'<img src="'.$offer_user_image.'" class="round-corner" alt="" width="60" height="60"/>');
		
		?>
        </div>
        
        
		<div class="estim colgreen fs14 fl" style="width:95%;">
			<p class="marB5"><?php  echo anchor('user/'.$offer_user_detail->profile_name,'<b>'.ucfirst($offer_user_detail->first_name).'</b> '.ucfirst(substr($offer_user_detail->last_name,0,1)),' class="col fs14 unl"'); ?></p>

  			<p class="marB5">Your Offer : <?php echo $site_setting->currency_symbol.$get_worker_bid->offer_amount;
  
  if($task_detail->task_activity_status==0) { 
  	
  		 echo anchor('task/edit_offer_on_task/'.$task_id.'/'.$get_worker_bid->task_comment_id,'<b class="colora">(Edit Offer)</b>',' id="edit_offer" class="marL5" ');
		 
		 ?>
         
            <script type="text/javascript">
					jQuery(document).ready(function() {	
						jQuery("#edit_offer").fancybox();										
					});
			</script>
                        
                        
         <?php
   }
  
  ?></p>
  




     <?php   if($task_detail->task_activity_status==0) {
			
						echo anchor('task/remove_offer_on_task/'.$task_id,'Remove Offer',' class="b-button b-button-2" style="border-top:1px solid #d6d6d6; margin-top:15px; border-bottom:0px;" ');
	  } ?>
                         
                        

</div>
          
          
           <div class="clear"></div>
           
           
      
        
        </div>
        
        <div class="clear"></div>
        
        <?php } } } } ?>
        <div id="right-panel-bg">
        	<div class="">
            
           <!-- <div id="needhelp-ph">
			<p class="needhelp">I want to get this done, too!</p>
			</div>-->
          
            
            <div class="" >
            <?php 
			if(check_user_authentication()) {
			$check_is_worker=$this->worker_model->check_is_worker_new(get_authenticateUserID());
			
			 if($check_is_worker==0) {
		    ?>
                 <div class="pricing_pro">
                 	<p style="font-size: 14px;margin: 5px auto;">Note: You must apply to become a Helper before bidding!</p>
                     <?php   echo anchor('who-are-the-taskers','Bid for this Job!','class="b-button b-button-2 b-button-2-2" style="border-top:1px solid #d6d6d6;"'); ?>
                    	<div class="fleft100"></div>
                 </div>
            <?php } 
			}
			else
			{
			?>
			<div class="pricing_pro">
            	<p style="font-size: 14px;margin: 5px auto;">Note: You must apply to become a Helper before bidding!</p>
                     <?php   echo anchor('login','Bid for this Job!','class="b-button b-button-2 b-button-2-2" style="border-top:1px solid #d6d6d6;"'); ?>
                 <div class="fleft100"></div>
                 </div>
			<?php } ?>
             <?php 
             if(!check_user_authentication()) 
             {  
             	echo anchor('sign_up','POST SIMILAR JOB ',' class="b-button b-button-2" ');  
             }  
             else 
             { 
             	if($site_setting->subscription_need==0)
             	{
             	echo anchor('task/update_task_step_zero/'.$task_detail->task_id.'/copy','POST SIMILAR JOB ',' id="copytask" class="b-button b-button-2" '); 

             	?>
 
 						   <script type="text/javascript">
								jQuery(document).ready(function() {	
									jQuery("#copytask").fancybox();	
								});
						</script>

			<?php 
				} 
				else
				{

					$user_setting=user_profilestatus(get_authenticateUserID());
                    if($user_setting->profile_active==1)
                    {
                    echo anchor('task/update_task_step_zero/'.$task_detail->task_id.'/copy','POST SIMILAR JOB ',' id="copytask" class="b-button b-button-2" '); 

             	?>
 
 						   <script type="text/javascript">
								jQuery(document).ready(function() {	
									jQuery("#copytask").fancybox();	
								});
						</script>

			<?php 
					}
					else
					{
			?>
            				<a href="javascript:void(0)" class="b-button b-button-2 pupload13"><b>POST SIMILAR JOB</b></a>    
			<?php		
					}


				}
			}
			?>
			</div>
            
             
            
            
           
			</div>
        
        
        	<div class="marB20">
            	<!--<hr id="hrid1">-->
                <!--<div class="estimate_pro">
                <div class="pricing_pro">
                    <div class="inside-subtitle inside-subtitle-2">Job Price Estimate</div>
                    
                    <div class="fleft100"><p class="text-mtop10 price-in" style="font-size:24px; text-align:left"><?php echo $site_setting->currency_symbol.$task_detail->task_to_price.' - '.$site_setting->currency_symbol.$task_detail->task_price; ?></p> </div>
                
              
                 </div>
                
                 </div>-->
           
            
            
            
            
            
            
              <!--<?php if($task_detail->task_activity_status==3) { 
					
					if($task_detail->task_worker_id>0)
					{
						$worker_info=$this->worker_model->get_worker_info($task_detail->task_worker_id);
						
						if($worker_info) 
						{
						
						
						
					
				$user_image= base_url().'upload/no_image.png';
				 
				 if($worker_info->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$worker_info->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$worker_info->profile_image;
						
					}
					
				} 
				
				
					
					?>
                    
                     <br /> 
                     <div class="estim marB10  fs14"><?php echo $this->task_model->count_total_offer_on_task($task_id);?> Worker bee(s) submitted offer(s) on this Task</div>
                  <br />

                    <div class="estim marB10">Worker bees for this Task</div>
                     <div class="posrel marTB10">
                       <div class="ponleft">
                           <?php echo anchor('user/'.$worker_info->profile_name,'<img src="'.$user_image.'" width="50" height="50" alt=""/>'); ?>
                            <a rel="tooltip" class="twoonepts1" title="Level <?php echo $worker_info->worker_level;?> Worker bee"><?php echo $worker_info->worker_level;?></a>
                       </div>
                       <div class="ponright">
                            <?php echo anchor('user/'.$worker_info->profile_name,strtoupper($worker_info->first_name.' '.substr($worker_info->last_name,0,1)),'class="fpass fs13"');?>
                         
                         <?php $final_comment=$this->task_model->get_final_comment($task_id,$task_detail->user_id);
						 
						 if($final_comment) { ?>
                         
                            <p class="marTB3"><div class="strmn"><div class="str_sel" style="width:<?php if($final_comment->comment_rate>5) { ?>100<?php } else { echo $final_comment->comment_rate*2;?>0<?php } ?>%;"></div></div><br /></p>
                             <p class="marTB3"><?php echo $final_comment->task_comment;?></p>
							<?php } ?>
								

                       </div>
                       <div class="clear"></div>
                    </div><br />
<br />

                    <?php } 
						}					
					} ?>-->
                    
                    
                    
                    
            <div class="marB20">
                <!--<div class="inside-subtitle inside-subtitle-2">Job Status</div>-->

            	<ul class="stcinn stcinn-1">
                	<!--<li style=" margin:5px 0px; background-color:#<?php if($task_detail->task_activity_status==0) { ?><?php } else { ?><?php } ?>;float:left;">
                            
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                        <td width="80" class="posted"><b class="marL5">Posted</b></td>
                        <td width="150" class="posted"><?php echo date($site_setting->date_time_format, strtotime($task_detail->task_post_date));; ?></td>
                        <td width="30" ><img src="<?php echo base_url().getThemeName(); ?>/images/innr1.png" width="26" height="31" alt=""/></td>
                        </tr>
                        </table>



               
                    </li>-->
                    
                <li style="margin:5px 0px; background-color:#<?php if($task_detail->task_activity_status==1) { ?><?php } else { ?><?php } ?>;float:left;">
                              
                            
                            
                            
                            
                            <!-------- newly added -->
						<!--<?php
                        if($task_detail->task_activity_status>=1 && $task_detail->task_assigned_date!='0000-00-00 00:00:00') {
						?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                        <td width="80" class="posted"><b class="marL5">Assigned</b></td>
                        <td width="150" class="posted"><?php
                        
                        
                        echo date($site_setting->date_time_format, strtotime($task_detail->task_assigned_date));
                        
                        
                        ?></td>
                        <td width="30" ><img src="<?php echo base_url().getThemeName(); ?>/images/innr3.png" width="26" height="31" alt=""/></td>
                        </tr>
                        </table>
						<?php } ?>-->
                        <!-------- newly added -->





                  
                    </li>
                    <?php if($task_detail->task_activity_status==1) { 
					
					if($task_detail->task_worker_id>0)
					{
						$worker_info=$this->worker_model->get_worker_info($task_detail->task_worker_id);
						
						if($worker_info) 
						{
					
					
					$user_image= base_url().'upload/no_image.png';
				 
				 if($worker_info->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$worker_info->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$worker_info->profile_image;
						
					}
					
				} 
				
				
					?>
                     <!--<div class="posrel marTB10" style="clear:both; margin-left:15px; margin-right:15px;">
                       <div class="ponleft" style="float:left; text-align:center;">
                           <?php echo anchor('user/'.$worker_info->profile_name,'<img src="'.$user_image.'" width="50" height="50" alt=""/>'); ?>
                           <br />
                            <a rel="tooltip" class="twoonepts1" title="Level <?php echo $worker_info->worker_level;?> Worker bee">Level <?php echo $worker_info->worker_level;?></a>
                       </div>
                       <div class="ponright" style="float:left; text-align:left; margin-left:10px;">
                            <?php echo anchor('user/'.$worker_info->profile_name,strtoupper($worker_info->first_name.' '.substr($worker_info->last_name,0,1)),'class="fpass fs15"');?>
                            <p class="marTB3 fs13">selected by <?php echo anchor('user/'.$task_user_detail->profile_name,ucfirst($task_user_detail->first_name).' '.ucfirst(substr($task_user_detail->last_name,0,1)).'.',' class="fpass" ');?></p>
                       </div>
                       <div class="clear"></div>
                    </div>-->
                    <?php } 
						}					
					} ?>
                    
                	<li  style=" margin:5px 0px; background-color:#<?php if($task_detail->task_activity_status==2) { ?><?php } else { ?><?php } ?>;float:left;">
                            
                            
                            
                            <!-------- newly added -->
						<!--<?php if($task_detail->task_activity_status>=2 && $task_detail->task_complete_date!='0000-00-00 00:00:00') { ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                        <td width="80" class="posted"><b class="marL5">Completed</b></td>
                        <td width="150" class="posted"><?php
                        
                        echo date($site_setting->date_time_format, strtotime($task_detail->task_complete_date));
                        
                        ?></td>
                        <td width="30"><img src="<?php echo base_url().getThemeName(); ?>/images/innr2.png" width="26" height="31" alt=""/></td>
                        </tr>
                        </table>
						<?php } ?>-->
                        <!-------- newly added -->


                            
                            
                            
                            
                            
                            
                            
                            
                                                
                    </li>
                    
                    <?php if($task_detail->task_activity_status==2) { 
					
					if($task_detail->task_worker_id>0)
					{
						$worker_info=$this->worker_model->get_worker_info($task_detail->task_worker_id);
						
						if($worker_info) 
						{
					
					
					$user_image= base_url().'upload/no_image.png';
				 
				 if($worker_info->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$worker_info->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$worker_info->profile_image;
						
					}
					
				} 
				
				
					?>
                     <div class="posrel marTB10">
                       <div class="ponleft" style="float:left;">
                           <?php echo anchor('user/'.$worker_info->profile_name,'<img src="'.$user_image.'" width="50" height="50" alt=""/>'); ?>
                            <a rel="tooltip" class="twoonepts1" title="Level <?php echo $worker_info->worker_level;?> Worker bee"><?php echo $worker_info->worker_level;?></a>
                       </div>
                       <div class="ponright" style="float:right;">
                            <?php echo anchor('user/'.$worker_info->profile_name,strtoupper($worker_info->first_name.' '.substr($worker_info->last_name,0,1)),'class="fpass fs13"');?>
                            <p class="marTB3">marked this Job Complete</p>
                       </div>
                       <div class="clear"></div>
                    </div>
                    <?php } 
						}					
					} ?>
                    
                	<li style="margin:5px 0px; background-color:#<?php if($task_detail->task_activity_status==3) { ?><?php } else { ?><?php } ?>;float:left;">
                           <!-------- newly added -->
                        <!--<?php if($task_detail->task_activity_status==3) { ?>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                        <td width="80" class="posted"><b class="marL5">Closed</b></td>
                        <td width="150" class="posted"><?php
                        
                        
                        echo date($site_setting->date_time_format, strtotime($task_detail->task_close_date));
                        
                        ?></td>
                        <td width="30" ><img src="<?php echo base_url().getThemeName(); ?>/images/innr4.png" width="26" height="31" alt=""/></td>
                        </tr>
                        </table>
						<?php } ?>-->
                        <!-------- newly added -->

       
                    </li>
                    
                   
                    
                </ul>
            </div>
            <div class="marB20">
                <div class="inside-subtitle inside-subtitle-2">Job Actions</div>
                <ul class="accr">
                 <?php 
					
					
					  $login_worker_id=0;
		    $check_worker_detail=$this->worker_model->check_user_worker_detail(get_authenticateUserID());
			
			if($check_worker_detail) {  $login_worker_id=$check_worker_detail->worker_id; }
			
		   if($task_detail->task_is_private==0 || $task_detail->user_id==get_authenticateUserID() || $task_detail->task_worker_id==$login_worker_id) {  
		   
		   				if($comments) {
						
						echo '<li class="copy-btn">'.anchor('tasks/'.$task_detail->task_url_name.'/comments','See conversations','class="b-button b-button-2"').'</li>'; 
						
						
				 } 
				 
		}  ?>
                    <?php /*?> <li><?php echo anchor('tasks/'.$task_detail->task_url_name.'/see_activity','See history'); ?></li><?php */?>
                      
                      
                      <?php  $chk_bid=0;
					  
					  		$chk_worker_bid=check_worker_bid_on_task($task_detail->task_id);
							
							if($chk_worker_bid)
							{
								$chk_bid=1;
							}
							
					  
					    if($task_detail->user_id == get_authenticateUserID() && $task_detail->task_activity_status==0 && $chk_bid==0) { ?>
                       <li class="copy-btn"><?php echo anchor('task/edit_task/'.$task_detail->task_id,'Edit Job','class="b-button b-button-2"'); ?></li>
                       
                       <?php } ?>
                       
                       
                     
					<?php  if(get_authenticateUserID() == $task_detail->user_id)  { ?>
                    <li class="copy-btn">
                      <?php   echo anchor('additional_information/information/'.$task_detail->task_id,'Additional Information','class="b-button b-button-2"'); ?>
                      </li>
                        <?php } ?>
          			 


                  
                      
                       <li class="copy-btn"> 
					   
					       <?php if(!check_user_authentication()) 
						   {  echo anchor('sign_up','Copy Job','class="b-button b-button-2"');  }  else { echo anchor('task/update_task_step_zero/'.$task_detail->task_id.'/copy','Copy Task',' id="copytask1" class="b-button b-button-2"'); ?>
 
 						   <script type="text/javascript">
								jQuery(document).ready(function() {	
									jQuery("#copytask1").fancybox();	
								});
						</script>
					<?php } ?>  
			
					</li>
                    
                    
                    
                    
                </ul>
            </div>
           <div class="marB20">
                <!--<div class="inside-subtitle inside-subtitle-2"><?php echo ucfirst($task_detail->city_name); ?></div>-->
                
               
<?php 
	

$user_current_city_id= getCurrentCity();

$city_latlong=get_cityDetail($task_detail->city_id);


if($city_latlong)
	{
		$city_latitude = $city_latlong->city_latitude;
		$city_longitude = $city_latlong->city_longitude;
	}
	else
	{
			$city_latitude = DEFAULT_CITY_LAT;
			$city_longitude =	DEFAULT_CITY_LANG;
	}
	
	
	
	

 ?>
<script type="text/javascript" src="http://www.google.com/jsapi?key=<?php echo GOOGLE_MAP_KEY;?>"></script>
   <script type="text/javascript">
			google.load("maps", "2.x");
			
			var city_lat='<?php echo $city_latitude;?>';
			var city_lang='<?php echo $city_longitude;?>';
			
		</script>
        
		<link href="<?php echo base_url().getThemeName(); ?>/js/map/tooltipv2.css">
        
		<style type="text/css" media="screen">
			#map {  width:100%; height:200px;float:left; }			
			#add-point { float:left; }
		
			#markerList { display:none; float:right; height:500px; overflow:scroll; width:25%;}
			#markerList dl { list-style:none;  }
			float: left;
#copytask2 { width: 100%;
			padding: 8px 0;
			background: #f2413e;
			text-align: center;
			border-radius: 10px;
			font-family: Century;
			font-size: 20px;
			color: #FFF;
			font-weight: normal;
			text-decoration: none;
			margin: 0 0 10px 0;
			}
		</style>
 

<script>	
	function loadMap(){
	
	
		var baseUrl='<?php echo base_url(); ?>';
		var baseThemeUrl='<?php echo base_url().getThemeName(); ?>';
		
		
		if(!GBrowserIsCompatible()){
			alert('Sorry, the Google Maps API is not compatible with this browser.');
			return;
		}else{
			createMap();
	
		
			
				
			<?php 
			
			 
				
				$taskid = $task_detail->task_id;
				$task_url_name = $task_detail->task_url_name;
				$userid = $task_detail->user_id;
				$location ='';
			
			
				
				$location ='';
				
					$task_map_location=get_map_task_location($taskid);
				
				if($task_map_location!='')
				{
					
					$location=$task_map_location;
					
						
						
						
						
						
				
			
			?>
			
				var content1;	
			
			var location = '<?php echo $location;?>';
			

			var taskname = '<?php echo str_replace("'",'',$task_detail->task_name);?>';
							 content1 = {
									el:'li',att:{id:'lipanel'},ch:[{el:'div',att:{id:'panel'},ch:[	
										{
											el:'div',att:{id:'leftPane1'},ch:[{
											//el:'a',att:{href:baseUrl+'category/task/<?php //echo $taskid;?>'},ch:[{
											el:'img',att:{src:baseThemeUrl+'/images/per.jpg',width:'50',height:'50',border:'0'}
										}]
										//}]
										},{el:'div',att:{id:'rightPane1'},ch:[{
											el:'a',att:{href:baseUrl+'tasks/<?php echo $task_url_name;?>'},ch:[{
											txt:taskname}] },{el:'br'},{txt:'Jobs of this type: <?php echo $site_setting->currency_symbol.$task_detail->task_to_price.' - '.$site_setting->currency_symbol.$task_detail->task_price;?>'}]
										}
									]}]
								};	

					var pin_icon_img= '';
							
					mapmake(map,location,baseUrl+'tasks/<?php echo $task_url_name;?>',baseThemeUrl+'/images/per.jpg',taskname,'Click for more details',content1,'','',pin_icon_img);	
						
						
						<?php  
						
				}  	
				   ?>   						
										
		//	lii.innerHTML=oTbl;
		}
	}
</script>



		
		<div class=""><ul id="markerList" style="border:1px solid #CCC; margin-top:5px;"></ul></div>
        <!--<div id="map"></div>-->
		<div id="message"></div>
        
        <script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/map/globals.js"></script>
		<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/map/Tooltip.v2.js"></script>
         <script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/map/eshapes.js"></script>
		<script type="text/javascript" >
		
		
		/**
 * @author Marco Alionso Ramirez, marco@onemarco.com
 * @url http://onemarco.com
 * This code is public domain
 */

//load and unload the map

GEvent.addDomListener(window,'load',loadMap);
GEvent.addDomListener(window,'unload',GUnload);

var map ;
//check for google maps compatibility, if so, load xml
//create map icon and sidebar
function createMap(){
	
	map = new GMap2(document.getElementById('map'));
	map.setCenter(new GLatLng(city_lat,city_lang),15);
	//map.addControl(new GMapTypeControl());
	//map.addControl(new GLargeMapControl());
	
	 
	
	}
	
	function mapmake(map,addres,map_listing_url,imagee,txt1,txt2,labell,mlat,mlang,pin_icon_img)
	{
	
		if(pin_icon_img=='')
		{
			pin_icon_img="marker.png";
		}
	
	var icon = new GIcon();
	icon.image = pin_icon_img;
	icon.shadow = "marker_shadow.png";
	icon.iconSize = new GSize(30, 38);
	icon.shadowSize = new GSize(30, 27);
	icon.iconAnchor = new GPoint(10, 25);
	icon.infoWindowAnchor = new GPoint(10, 0);
	icon.infoShadowAnchor = new GPoint(23, 13);

	//var icon = G_DEFAULT_ICON;
	
	var sidebarList = document.getElementById('markerList');
	
	var content = {
		el:'dl',ch:[
			{el:'dt',ch:[
				{txt:'University of Washington'}
			]},
			{el:'dd',ch:[
				{txt:'I graduated from this university in 2006.'}
			]}
		]
	};
	
	/*var spaceNeedleContent = {
		el:'img',att:{src:'images/index2.jpg',width:'82',height:'150'}
	}*/
	
	var content1 = {
		el:'dl',ch:[{el:'dt',ch:[{el:'a',att:{href:map_listing_url},ch:[{
											txt:txt1}]  }]},
			{
				//el:'img',att:{src:imagee,width:'50',height:'50'}
			},{el:'dt',ch:[
				{txt:txt2}
			]}
		]
	};
		
var geo = new GClientGeocoder();		
geo.getLocations(addres, function(addresses){
    if(addresses.Status.code != 200){
      //alert("D'oh!\n " + query);
	  return;
    }else{
     // marker = pin_||createMarker();
      var result = addresses.Placemark[0];
	  var lat = result.Point.coordinates[1];
      var lng = result.Point.coordinates[0];
		//alert(lat+'fgfgfgf'+lng);
		
		
		
		 // === Filled Circle ===
     var point = new GLatLng(lat,lng);
     map.addOverlay(GPolygon.Circle(point,500,"#009FBB",1,1,"#79EBFF",0.3));
	  
	  
	  
		if(mlat=='' || mlang=='')
		{
			
	  		createMarker(map,lat, lng,labell,icon,content1,sidebarList);
		}
		else
		{
			createMarker(map,mlat,mlang,labell,icon,content1,sidebarList);
		}
	//  createMarker(map,lat, lng,'The Space Needle',icon,spaceNeedleContent,sidebarList);

	  }
	  }
	  );

	}

//create the marker
function createMarker(map,lat,lng,title,icon,content,list){
	
	var marker = new GMarker(new GLatLng(lat,lng),{icon:icon});
	 map.addOverlay(marker);
	marker.tooltip = new Tooltip(marker,jsonToDom(content),5);
	createTab(marker,content);
	marker.isInfoWindowOpen = true;
	
//	var sidebarLink = jsonToDom({el:'li',ch:[{txt:'University of Washington'}]});

//var sidebarLink = jsonToDom({el:'li',ch:[{el:'table',ch:[{el:'tr',ch:[{el:'td',ch:[{txt:'University of Washington'}]}]}]}]});
//alert(sidebarLink.innerHTML)
	//list.appendChild(sidebarLink);
	
	var sidebarLink =jsonToDom(title);
	//alert(sidebarLink.innerHTML)
	list.appendChild(sidebarLink);
    //var theBR = document.createElement('br');

	//list.appendChild(theBR);
	
	
	var ttmover = GEvent.callbackArgs(marker,tooltipMouseover,sidebarLink);
	var ttmout = GEvent.callbackArgs(marker,tooltipMouseout,sidebarLink);
	var mclick = GEvent.callback(marker,markerClick);
	
	//GEvent.addDomListener(sidebarLink,'mouseover',ttmover);
	GEvent.addDomListener(sidebarLink,'mouseover',mclick);
	GEvent.addDomListener(sidebarLink,'mouseout',ttmout);
	GEvent.addDomListener(sidebarLink,'click',mclick);	
	
	
	//GEvent.addListener(marker,'mouseover',ttmover);
	//GEvent.addListener(marker,'mouseout',ttmout);	
	
	GEvent.addListener(marker,'mouseover',mclick);
	GEvent.addListener(marker,'mouseout',ttmout);	
	GEvent.addListener(marker,'click',mclick);
	
	
	
	GEvent.addListener(marker,'infowindowopen',GEvent.callbackArgs(marker,infoWindowOpen,sidebarLink));
	GEvent.addListener(marker,'infowindowclose',GEvent.callbackArgs(marker,infoWindowClose,sidebarLink));
	
	map.addOverlay(marker);	
	map.addOverlay(marker.tooltip);
	map.setCenter(marker.getPoint());
	
	return marker;
}

//create the tab(s) for the GInfoWindow
function createTab(marker,content){
	var element = jsonToDom(
		{el:'div',att:{Class:'googleMarkerTab'},ch:[
			{el:'div',att:{Class:'content'},ch:[
				content
			]}
		]});
	marker.tab = [new GInfoWindowTab('Address',element)];
}

//makrer,sidebar mouseover handler
function tooltipMouseover(sidebarLink){
	if(!(this.isInfoWindowOpen) && !(this.isHidden())){
		this.tooltip.show();
	}
}

//marker,sidebar mouseout handler
function tooltipMouseout(sidebarLink){
	this.tooltip.hide();
}

//marker click handler
function markerClick(){
	this.tooltip.hide();
	this.openInfoWindowTabs(this.tab);
}

//infowindowopen handler
function infoWindowOpen(sidebarLink){
	this.isInfoWindowOpen = true;	
}

//infowindowclose handler
function infoWindowClose(sidebarLink){
	this.isInfoWindowOpen = false;
}
</script>
        <!----map--->
                
            </div>
            

            

            
            <div class="marB20">
                <div class="inside-subtitle inside-subtitle-2" style="margin-bottom:20px;">Share with Friends</div>
                            
							<a href="javascript:void()" onClick="window.open('http://twitter.com/home?status=<?php echo $task_detail->task_name; ?> <?php echo site_url('tasks/'.$task_detail->task_url_name);?>','Share on Twitter','height=300,width=600,top=50,left=300');"><img src="<?php echo base_url().getThemeName(); ?>/images/twitter-o.png" alt="" width="30" height="30"/></a>
							
							<a href="javascript:void()" onClick="window.open('http://www.facebook.com/share.php?u=<?php echo site_url('tasks/'.$task_detail->task_url_name);?>&amp;t=<?php echo $task_detail->task_name; ?>','Share on Facebook','height=300,width=600,top=50,left=300');"><img src="<?php echo base_url().getThemeName(); ?>/images/facebook-o.png" alt=""  width="30" height="30"/></a>
							
							<a href="https://plus.google.com/share?url=<?php echo site_url('tasks/'.$task_detail->task_url_name);?>" onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="<?php echo base_url().getThemeName(); ?>/images/googleplus.png" alt="Share on Google+"  width="30" height="30"/></a>
							
							<a href="javascript:void()" onClick="window.open('https://www.linkedin.com/shareArticle?mini=true&url=https://www.linkedin.com/&title=&summary=&source=','Share on Linkedin','height=300,width=600,top=50,left=300');"><img src="<?php echo base_url().getThemeName(); ?>/images/linkedin.png" alt="" width="30" height="30"/></a>
							
							<!--<a href="javascript:void()" onClick="window.open('mailto:?subject=<?php echo $task_detail->task_name; ?>&amp;body=<?php echo site_url('tasks/'.$task_detail->task_url_name);?>','Send Message','height=300,width=600,top=50,left=300');"><img src="<?php echo base_url().getThemeName(); ?>/images/msg.png" alt=""/></a>
                            
                            <a href="javascript:void()" onClick="window.open('http://del.icio.us/post?url=<?php echo site_url('tasks/'.$task_detail->task_url_name);?>&amp;title=<?php echo $task_detail->task_name; ?>','Share on Delicious','height=300,width=600,top=50,left=300');"><img src="<?php echo base_url().getThemeName(); ?>/images/ctc.png" alt="" /></a>
                            
                            <a href="javascript:void()" onClick="window.open('http://www.stumbleupon.com/submit?url=<?php echo site_url('tasks/'.$task_detail->task_url_name);?>&amp;title=<?php echo $task_detail->task_name; ?>','Share on Stumbleupon','height=300,width=600,top=50,left=300');"><img src="<?php echo base_url().getThemeName(); ?>/images/su.png" alt=""  /></a>
                            
                            <a href="javascript:void()" onClick="window.open('http://digg.com/submit?phase=2&url=<?php echo site_url('tasks/'.$task_detail->task_url_name);?>&amp;title=<?php echo $task_detail->task_name; ?>','Share on Digg','height=300,width=600,top=50,left=300');"><img src="<?php echo base_url().getThemeName(); ?>/images/digg.png" alt=""/></a>-->
                            
                            
			</div>
        </div>
        </div>>>>>>>>>>>