<!--banner-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner-->

<div class="red-subtitle top-red-subtitle">City</div>
<div id="two-columnar-section" class="top-cont-main-dash" style="background:#f1f1f6;">
<div class="task-layout">
<div class="profile_back">
<div class="become-tasker become-tasker-12" style="padding: 30px 0; ">
    <div class="container">
        <div class="span3 wow fadeIn animated animated" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;">
            <p class="only-text" style="text-align:left; color:#fff;">1. Easily find Jobs to BID on or simply use as inspiration for CREATING your own Jobs.</p> 
            <p class="only-text" style="text-align:left; color:#fff;">2. Scroll down the list of Jobs and click on the ones that interest you, this will highlight the location on the map.</p>
            <p class="only-text" style="text-align:left; color:#fff;">3. For more detail about the job simply click on the Job Name and it will take you to The Job post where you can BID on or REPLICATE the job.</p>
        </div>
    </div>
</div>
    <div class="clear"></div>
    <div class="container">
		<div class="main-ma"  style="margin:0px; padding:70px 0;">
		<?php 
            $site_setting=site_setting();
            $city_latitude = DEFAULT_CITY_LAT;
                $city_longitude =	DEFAULT_CITY_LANG;
        
         ?>
 
 
					
		<script type="text/javascript" src="http://www.google.com/jsapi?key=AIzaSyC2erRS3HKmVv--N_U2Q_GqLX_5N-KTIjQ"></script>
        
		<script type="text/javascript">
			google.load("maps", "2.x");
			
			
				var city_lat='<?php echo $city_latitude;?>';
			var city_lang='<?php echo $city_longitude;?>';
			
			
			
				function resizeElementHeight() {
			  var height = 0;
			  var body = window.document.body;
			  if (window.innerHeight) {
				  height = window.innerHeight;
			  } else if (body.parentElement.clientHeight) {
				  height = body.parentElement.clientHeight;
			  } else if (body && body.clientHeight) {
				  height = body.clientHeight;
			  }
			   document.getElementById('map').style.height = ((height -  (document.getElementById('map').offsetTop + 40) ) + "px");
			   document.getElementById('markerList').style.minHeight = ((height -  (document.getElementById('markerList').offsetTop  )) + "px");
			}



		</script>
        
		<link href="<?php echo base_url().getThemeName(); ?>/js/map/tooltipv2.css">
        
		<style type="text/css" media="screen">
                        .mapatleft{ float:left; width:73%; }
                        .mapatright{float:right; width:27%;}
                        #lipanel{ border-bottom:1px dotted #ccc; padding:5px 5px 5px 4px; min-height:75px;}
                        #lipanel:hover { background:#ededed; cursor:pointer; cursor:hand; }
                        #message { background:#555; color:#fff; position:absolute; display:none; width:100px; padding:5px; }
                        #add-point { float:left; }
                        div.input { padding:3px 0; }
                        label { display:block; font-size:80%; }
                        select { width:150px; }
                        button { float:right; }
                        div.error { color:red; font-weight:bold; }
                        #markerList { /*Nfloat:right; width:25%; */ height:596px; overflow-y:scroll;}
                        #markerList dl { list-style:none;   }
                        #leftPane1 {  float:left;width:50px; padding:0px 10px 0px 5px; /*padding:5px 10px 0px 10px;*/  }
                        #leftPane1 img{ border-radius:5px; }
						#rightPane1 {
                            font-size: 14px;
                            padding: 5px;
                            text-align: left;
                            width: 295px;
                        }
                        #leftPane1 a, #rightPane1 a, .content a{ font-size:14px; font-weight:bold; color:#f70000; text-transform:capitalize; }
                        #leftPane1 a:hover, #rightPane1 a:hover, .content a:hover{text-decoration:underline;color:#f70000;}
                        .link{ font-size:12px;}
                        #fs12{ font-size:12px !important;}
                        .colblack{ color:#646464;}
                        .bor1{ border:1px solid red;}
                        .fl{ float:left;}
                        .fr{ float:right;}
                        .wid150{ width:150px;}
                        .wid160{width:160px;}
                        .wid50{ width:50px;}
                        
                        .padR5 { margin-right:10px; }
                        
                        
                        .wid100{width:100px;}
                        .clear{ clear:both;}
                        .marT5{ margin-top:5px;}
                        .marT25{ margin-top:9px;}
                        .marL30{ margin-left:30px;}
                        .wid190{ width:190px;}
                        .ita{ font-size:13px; color:#565656 !important; }
                        .colora1{ color:#e23a37;}
                        .colgrey { color:#e23a37; }
						.googleMarkerTab img.wid50{border-radius:5px; }
						.gm-style { font-family:"Roboto Condensed",sans-serif !important;}
						.gm-style .gm-style-iw{ font-size:14px !important;}
                    </style>
        
        <!--[if IE 7]>
<style type="text/css" media="screen">
			
			
			.mapatleft{ float:left; width:70.80%; }
			.mapatright{float:right; width:29%;}
    </style>
<![endif]-->
 
<script>	
	function loadMap(){
	
	
		var baseUrl='<?php echo base_url(); ?>';
		var baseThemeUrl='<?php echo base_url().getThemeName(); ?>';
		
		
		if(!GBrowserIsCompatible()){
			alert('Sorry, the Google Maps API is not compatible with this browser.');
			return;
		}else{
			createMap();
	
		resizeElementHeight();
		
				
			<?php 
			if($tasklists) {
			
				foreach($tasklists as $tasklist){
				
				
				
				
				 
				
				
				$user_detail=$this->user_model->get_user_profile_by_id($tasklist->user_id);
									
						
									
			 $user_image= base_url().'upload/no_image.png';
				 
				 if($user_detail->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$user_detail->profile_image;
						
					}
					
				}
						
						
						
				
				$taskid = $tasklist->task_id;
				$task_worker_id=$tasklist->task_worker_id;
				$userid = $tasklist->user_id;
				
				$task_start_date= $tasklist->task_end_day;	
				
				
				
				$task_url_name = $tasklist->task_url_name;
				$task_activity_status=$tasklist->task_activity_status;
				
				$poster_agree=$tasklist->poster_agree;
				$worker_agree=$tasklist->worker_agree;
				
				
		
				
				
				
				$worker_name='';
				
				if($task_worker_id>0 && $task_activity_status>0) 
				{
				
					$worker_detail=$this->worker_model->get_worker_info($task_worker_id);
					
					if($worker_detail)
					{
						$worker_name=ucfirst($worker_detail->first_name).' '.ucfirst(substr($worker_detail->last_name,0,1)).'.';
					}
				
				}
				
				
				
				
			
				$location ='';
				$task_map_location=get_map_task_location($taskid);
				
				if($task_map_location!='')
				{
					
					$location=$task_map_location;
				
			
			?>
			
				var content1;	
					//alert(content1);
			
			var location = '<?php echo $location;?>';
			
			var user_image ='<?php echo $user_image; ?>';

			var taskname = '<?php echo str_replace("'",'',$tasklist->task_name);?>';
			
			var task_poster_name ='<?php echo ucfirst($user_detail->first_name).' '.ucfirst(substr($user_detail->last_name,0,1)).'.'; ?>';
			
			var worker_name= '<?php echo $worker_name; ?>';
			
			
			var task_start_date= '<?php echo $task_start_date; ?>';
			
					<?php if($task_activity_status==0) { ?>
			
			var status_image = '<?php echo base_url().getThemeName();?>/images/innr1.png';
			
			<?php } elseif($task_activity_status==1 && $task_worker_id>0 && $worker_agree==0) { ?>
			
				var status_image = '<?php echo base_url().getThemeName();?>/images/innr3.png';
				
				
			<?php } elseif($task_activity_status==2 && ($worker_agree==1 || $worker_agree==0) && $poster_agree==0) { ?>
			
				var status_image = '<?php echo base_url().getThemeName();?>/images/innr2.png';
			
			<?php } elseif(($task_activity_status==2 || $task_activity_status==3) && ($worker_agree==1 || $worker_agree==0) && ($poster_agree==1 || $poster_agree==0)) { ?>
			
				var status_image = '<?php echo base_url().getThemeName();?>/images/innr4.png';
						
			<?php }  elseif($task_activity_status==3 && $worker_agree==0 && $poster_agree==0 && $task_worker_id==0) { ?>
			
				var status_image = '<?php echo base_url().getThemeName();?>/images/innr4.png';
						
			<?php } else { ?>
			
			var status_image = '<?php echo base_url().getThemeName();?>/images/innr4.png';
			
			<?php } ?>
			
							
								
		/////======right side bar
								
	 content1 = 
		 
		 {el:'li',att:{id:'lipanel'},ch:[
									 
										 
				{ el:'div',att:{id:'panel'},
				 
				 ch:[
															 
						{el:'div',att:{id:'leftPane1'},
										ch:[{
												
											el:'img',att:{'class':'marT5',src:user_image,width:'50',height:'50',border:'0'}
											}]
										},
										
										{el:'div',att:{id:'rightPane1'},
										ch:[
								
											{el:'a',att:{href:baseUrl+'tasks/<?php echo $task_url_name;?>'},				
											
											ch:[{
											txt:taskname}] 
											
											},
								
								{el:'br'},
							
								{el:'p',att:{'class':'colblack fl wid190'},
								
								ch:[
									
									
									
									
								
									
									
									
							<?php if($task_activity_status==0) { ?>
									
									
									{txt:'posted by '},
									
									{el:'b',
									
									ch:[{txt: task_poster_name}]
									},
									
									
									{txt:' and'},
									
									{el:'br'},
									
									{el:'p',ch:[{txt:'needs to be completed by'}]},
									
									{el:'p',att:{'class':'marT5 ita colgrey'},ch:[{txt:task_start_date}]},
									
									
									<?php } elseif($task_activity_status==1 && $task_worker_id>0 && $worker_agree==0) { ?>
									
									
									{txt:'is getting done.'},
									
									{el:'b',
									
									ch:[{txt:' '+task_poster_name+' '}]
									},
									
									{el:'br'},
									
									{txt:'is helping out'},
									
									{el:'b',ch:[{txt:' '+worker_name}]},
									
									{el:'br'},
									
									{el:'div',att:{'class':'marT5 ita'},
									
									ch:[
										{txt:'Tasks of this type: '},{el:'span',att:{'class':'colora'},ch:[{txt:'<?php echo mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES').$tasklist->task_price.' - '.mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES').$tasklist->task_price;?>'}]}
										]
									}
									
									<?php } elseif($task_activity_status==2 && ($worker_agree==1  || $worker_agree==0) && $poster_agree==0) { ?>
									
									
									{txt:'has been marked'},
									
									{el:'br'},
									
									{txt:'completed by'},					
									
									{el:'b',ch:[{txt:' '+worker_name}]},
									
									{el:'br'},
									
									{el:'div',att:{'class':'marT5 ita'},
									
									ch:[
										{txt:'Tasks of this type: '},{el:'span',att:{'class':'colora'},ch:[{txt:'<?php echo mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES').$tasklist->task_price.' - '.mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES').$tasklist->task_price;?>'}]}
										]
									}
									
									
									<?php } elseif(($task_activity_status==2 || $task_activity_status==3) && ($worker_agree==1 || $worker_agree==0) && ($poster_agree==1 || $poster_agree==0)) { ?>
									
									
									
									
									{txt:'is all finished. '},
									
									{el:'b',
									
									ch:[{txt:task_poster_name}]
									},
									
									
									
									{el:'br'},
									
									{txt:'is happy to be done with it.'},					
								
									{el:'br'},
									
									{el:'div',att:{'class':'marT5 ita'},
									
									ch:[
										{txt:'Tasks of this type: '},{el:'span',att:{'class':'colora'},ch:[{txt:'<?php echo mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES').$tasklist->task_price.' - '.mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES').$tasklist->task_price;?>'}]}
										]
									}
								
									<?php }  elseif($task_activity_status==3 && $worker_agree==0 && $poster_agree==0 && $task_worker_id==0) { ?>
									
									
										
									
									{txt:'is cancelled. '},
									
									{el:'b',
									
									ch:[{txt:task_poster_name}]
									},
									
									
									{el:'br'},
									
									
									{el:'div',att:{'class':'marT5 ita'},
									
									ch:[
										{txt:'Tasks of this type: '},{el:'span',att:{'class':'colora'},ch:[{txt:'<?php echo mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES').$tasklist->task_price.' - '.mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES').$tasklist->task_price;?>'}]}
										]
									}
								
								
								
									<?php } ?>
									
									
									
									
									
									]
								
								
								
							},
							{el:'img',att:{'class':'marT25',src:status_image,width:'20',height:'20',border:'0'}},
									
							{el:'div',att:{'class':'clear'} }
							
									]
							
							
										},{el:'div',att:{'class':'clear'} }
							
							
							
							]
								}
								
							 ]};
							 
							 
					
					/////====for map pin description
					
					var content2 = {
	
	el:'dl',ch:[
			{el:'img',att:{'class':'fl padR5 wid50',src:user_image,width:'50',height:'50'}},
			{el:'dt',att:{'class':'fl wid160'},ch:[															  
												{el:'a',att:{href:baseUrl+'tasks/<?php echo $task_url_name;?>'},ch:[{txt:taskname}]},
												{el:'p',att:{'class':'colblack '},
								
								ch:[
									
									
									
									
									
									
									
										
								
									
									
									
							<?php if($task_activity_status==0) { ?>
									
									
									{txt:'posted by '},
									
									{el:'b',
									
									ch:[{txt: task_poster_name}]
									},
									
									
									{txt:' and'},
									
									{el:'br'},
									
									{el:'p',ch:[{txt:'needs to be completed by'}]},
									
									{el:'p',att:{'class':'marT5 ita colgrey'},ch:[{txt:task_start_date}]},
									
									
									<?php } elseif($task_activity_status==1 && $task_worker_id>0 && $worker_agree==0) { ?>
									
									
									{txt:'is getting done.'},
									
									{el:'b',
									
									ch:[{txt:' '+task_poster_name+' '}]
									},
									
									{el:'br'},
									
									{txt:'is helping out'},
									
									{el:'b',ch:[{txt:' '+worker_name}]},
									
									{el:'br'},
									
									{el:'div',att:{'class':'marT5 ita'},
									
									ch:[
										{txt:'Tasks of this type: '},{el:'span',att:{'class':'colora'},ch:[{txt:'<?php echo mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES').$tasklist->task_price.' - '.mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES').$tasklist->task_price;?>'}]}
										]
									
									}
									
									
									<?php } elseif($task_activity_status==2 && ($worker_agree==1 || $worker_agree==0) && $poster_agree==0) { ?>
									
									
									{txt:'has been marked'},
									
									{el:'br'},
									
									{txt:'completed by'},					
									
									{el:'b',ch:[{txt:' '+worker_name}]},
									
									{el:'br'},
									
									{el:'div',att:{'class':'marT5 ita'},
									
									ch:[
										{txt:'Tasks of this type: '},{el:'span',att:{'class':'colora'},ch:[{txt:'<?php echo mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES').$tasklist->task_price.' - '.mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES').$tasklist->task_price;?>'}]}
										]
									
									}
									
									<?php } elseif(($task_activity_status==2 || $task_activity_status==3) && ($worker_agree==1 || $worker_agree==0) && ($poster_agree==1 || $poster_agree==0)) { ?>
									
									
									
									
									{txt:'is all finished. '},
									
									{el:'b',
									
									ch:[{txt:task_poster_name}]
									},
									
									
									
									{el:'br'},
									
									{txt:'is happy to be done with it.'},					
								
									{el:'br'},
									
									{el:'div',att:{'class':'marT5 ita'},
									
									ch:[
										{txt:'Tasks of this type: '},{el:'span',att:{'class':'colora'},ch:[{txt:'<?php echo mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES').$tasklist->task_price.' - '.mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES').$tasklist->task_price;?>'}]}
										]
									
									}
								
									<?php }  elseif($task_activity_status==3 && $worker_agree==0 && $poster_agree==0 && $task_worker_id==0) { ?>
									
									
									
									
									{txt:'is cancelled. '},
									
									{el:'b',
									
									ch:[{txt:task_poster_name}]
									},
									
									
								
									{el:'br'},
									
									{el:'div',att:{'class':'marT5 ita'},
									
									ch:[
										{txt:'Tasks of this type: '},{el:'span',att:{'class':'colora'},ch:[{txt:'<?php echo mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES').$tasklist->task_price.' - '.mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES').$tasklist->task_price;?>'}]}
										]
									
									}
								
									
									
									<?php } ?>
									
									
									
									
									
									
									
									]
								
								
								
							}
												]},								
			{el:'div',att:{'class':'clear'}},
			{el:'dt',ch:[{txt:''}]}
		]
	};		 

					var pin_icon_img= baseThemeUrl+'/js/map/blue_star.png';
							
					mapmake(map,location,baseUrl+'tasks/<?php echo $task_url_name;?>',user_image,taskname,content2,content1,'','',pin_icon_img);	
						<?php  
						
						
				
				} 	//////if loop for task_map+location
				
				
				
				
				
			
				
				  } 
				
			}
			else{ ?>
			alert("Currently There Is No Active Task In Selected Location , Please Chose Different Location");
			window.location="<?php echo base_url(); ?>map";
			 var content1;	
			
			var location = '';
			
			var user_image ='';

			var taskname = 'No job avilable in this city';
			
			var task_poster_name ='';
			
			var worker_name= '';
			
			
			var task_start_date= '';
			
			
			
			var status_image = '';
			
			
							
								
		/////======right side bar
								
	 content1 = 
		 
		 {el:'li',att:{id:'lipanel'},ch:[
									 
									{txt:'No job avilable in this city '}, 
				
								
							 ]};
							 
							 
					
					/////====for map pin description
			var pin_icon_img= baseThemeUrl+'/js/map/blue_star.png';	
			var map='';
			var location='';
			var user_image='';
			var taskname='';
			var content2='';
			
			//mapmake('','','','','',content1,'','','','');		
			//mapmake(map,location,baseUrl+'tasks/',user_image,taskname,content2,content1,'','',pin_icon_img);
			//mapmake(map,addres,map_listing_url,imagee,txt1,txt2,labell,mlat,mlang,pin_icon_img)
			<?php }?>						
										
		//	lii.innerHTML=oTbl;
		}
	}
</script>
		
	<div class="dbleft dbleft-map">
		<div class="dbleft-map-inner">
			<?php $cities = city_list(); ?>
            <table cellpadding="0" cellspacing="0" class="apptab1 apptab1-1" align="center">
                <tr>
                    <td width="34%" style="float:left; padding-top:2px; font-size:20px; color: #fff;"><h4>Search Job In : </h4></td>
                    <td width="54%" style="float:left;">
                        <select name="citymap" id="citymap" style="margin-bottom:0px;" onChange="javascript:changecity(this.value);" class="form-control select-control">
                            <option value="all">All</option>
                            <?php foreach($cities as $cityinfo) { ?>
                            <option value="<?php echo $cityinfo->city_name;?>" <?php if($city == $cityinfo->city_name) { echo 'selected="selected"'; } ?>><?php echo $cityinfo->city_name;?></option>
                            <?php } ?>
                        </select>
                  </td>
                </tr>
            </table>
        </div>
<div class="clear"></div>
			<div id="map" class="map-area" style="margin-top:0px;"></div>
            <!-- map footer s -->
            <script type="text/javascript">
  function changecity(val)
	{
		
		var linkurl = '<?php echo site_url('map/');?>';
		var linkurl2 = '<?php echo site_url('map/in/');?>';
		
		if(val=='all')
		{
		window.location.href=linkurl;
		}
		else
		{
			window.location.href=linkurl2+'/'+val;
		}
		return false;
	}   
</script> 



            <!-- map footer e -->

		</div>
         
		<div class="dbright-task dbright-task-map">
        	<div class="map-title">Tasks</div>
            <div class="clear"></div>
			<ul id="markerList" style="border-radius:0 5px 5px 0px; height:514px !important;"></ul>
        </div>
        <div class="clear"></div>
		<div id="message"></div>
        
        
        <script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/map/globals.js"></script>
		<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/map/Tooltip.v2.js"></script>
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
		map.setCenter(new GLatLng(city_lat,city_lang),14);
	//map.addControl(new GMapTypeControl());
	map.addControl(new GLargeMapControl());
    
	
	}
	//alert(mapmake);
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
	
	
	
		var content1 =txt2;
		//alert(content1);
		
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
	</div>
  </div>
  <div class="clear"></div>
</div>