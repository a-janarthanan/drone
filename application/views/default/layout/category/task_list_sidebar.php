<div id="needhelp-ph">
<p class="needhelp inside-subtitle" style="font-size:18px;">Need help with <?php  echo $category_infos->category_name;?></p>
</div>
<div id="right-panel-bg">
<div class="posttask-ph">
 <?php if(!check_user_authentication()) {  echo anchor('sign_up','Post a Job',' class="login_new1" ');  } else {       
        
        echo anchor('new_task','Post a Job',' id="various3" class="login_new1" '); } ?> 
</div>      

            <div class="clear"></div>
    
 <br />         
                
       
         <!--<div class="runnerph">
         
         <h3 class="runner" style="margin:0 0 15px 20px">View Task in boston </h3>
        
        	<ul class="ulmycity">
            	 <li>
				<?php 
                    if($cityname == 'all') {
                        echo '<span style="font-size: 15px;">All</span>';
                    } else {
                        echo anchor('tags/'.$category_url_name.'/in/all/','All','class="city_new" ');
                    } 
                ?> 
			</li>
            <?php
			 	 $city_list=city_list();
				 $cityi=0;
		  		 $current_city_id=getCurrentCity();
		 
		   		 if($city_list) {  foreach($city_list as $city) { 
                 
					if($cityi<5)
					{
					?>
            		<li>
						<?php 
							if($cityname == $city->city_name) {
							 	echo '<span style="font-size: 15px;">'.$city->city_name.'</span>';
							} else {
								echo anchor('tags/'.$category_url_name.'/in/'.$city->city_name,$city->city_name);
							} 
						?> 
                  </li>
           <?php } $cityi++; } } ?>
		  
                <div class="clear"></div>
            </ul>
			<p style="padding-left:75px;"><?php echo anchor('category/city','View all cities');?></p>
         <div class="clear"></div>
      </div>-->
      
      
      
      
       
         
        
        

      <!--<div class="fleftfw">
            <div class="estim marB10"><?php if($cityname!='all') {  if($tasks_info) {  echo $cityname;  } } ?></div>
            
           
           
           
           
           

<?php 



 if($tasks_info) {

if($city_id>0)
{

$user_current_city_id= $city_id;
$city_latlong=get_cityDetail($user_current_city_id);

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
			#map {  width:259px; height:303px; }	
		
			#add-point { float:left; }
		
			#markerList { display:none; float:right; height:500px; overflow:scroll; width:25%;}
			#markerList dl { list-style:none;  }
			
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
				foreach($tasks_info as $tasklist){ 
				
				$taskid = $tasklist->task_id;
				$task_url_name = $tasklist->task_url_name;
				$userid = $tasklist->user_id;
				$location ='';
				$sql=mysql_query("SELECT * FROM trc_task_location where task_id='".$taskid."'");
				$location ='';
				
				$task_map_location=get_map_task_location($taskid);
				
				if($task_map_location!='')
				{
					
					$location=$task_map_location;
				
			
			?>
			
				var content1;	
			
			var location = '<?php echo $location;?>';
			

			
			var taskname = '<?php echo str_replace("'",'',$tasklist->task_name);?>';
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
											txt:taskname}] },{el:'br'},{txt:'Tasks of this type: <?php echo $site_setting->currency_symbol.$tasklist->task_price;?>'}]
										}
									]}]
								};	

					var pin_icon_img= baseThemeUrl+'/js/map/blue_star.png';
							
					mapmake(map,location,baseUrl+'tasks/<?php echo $task_url_name;?>',baseThemeUrl+'/images/per.jpg',taskname,'Click for more details',content1,'','',pin_icon_img);	
						<?php  }
						
					}
					
					?>						
										
		//	lii.innerHTML=oTbl;
		}
	}
</script>

<br />
<br />

		
		<div class=""><ul id="markerList" style="border:1px solid #CCC; margin-top:5px;"></ul></div>
        <div id="map"></div>
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
	map.setCenter(new GLatLng(city_lat,city_lang),2);
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
	
	//GEvent.addListener(marker,'mouseover',mclick);
	//GEvent.addListener(marker,'mouseout',ttmout);	
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
  <?php } ?>      
        

           
        
            
            
       </div>-->
        
         <ul class="rightbottom-links">
        	
           <li><?php echo anchor('how_it_works','How it works','class="b-button"'); ?></li>
           <li>	<?php echo anchor('who-are-the-taskers','Become a Tasker','class="b-button"');?></li>
		   
          </ul> 	
           <!--<p class="mapcopyright"> Copyright © <?php echo date('Y') ?> <?php echo $site_setting->site_name;?>, Inc.</p>-->

</div>        
        
