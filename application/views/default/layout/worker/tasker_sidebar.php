<div class="mconright">
<ul class="padli10">
     <!--   <li><div class="estim marB5">Safety is Task # 1</div>
        	<img src="<?php echo base_url().getThemeName(); ?>/images/secure-large.png" alt="">
            <h3 class="marTB5">All Worker bees must:</h3>
            <ul class="ulround2">
            	<li>Submit an application</li>
                <li>Pass criminal background check</li>
                <li>Complete video interview</li>
            </ul>    
        </li>
         
        <li>Learn more <a class="fpass" href="#">about safety>></a></li>-->
        <li>
        	<div class="inside-subtitle inside-subtitle-2">View  Tasker in </div>
        	    	<?php 
						if($cityname == 'all') {
							echo '<span style="font-size: 15px;" class="b-button b-button-2">All</span>';
						} else {
							echo anchor('taskers/all','All','class="b-button b-button-2"');
						} 
                	?> 
               
                
                <?php
			 	 $city_list=city_list();
		  		 $current_city_id=getCurrentCity();
		 
		   		 if($city_list) 
				  $cityi=0;
					{  
					foreach($city_list as $city) { 
					if($cityi<5)
					{	?>
						<?php 
							if($cityname == $city->city_name) {
								echo '<span style="font-size: 15px;" class="b-button b-button-2">'.$city->city_name.'</span>';
							} else {
								echo anchor('taskers/'.$city->city_name,$city->city_name,'class="b-button b-button-2"');
							} 
						?> 
          		 <?php } $cityi++; } } ?>
				 <p style="float:left; width:100%; text-align:center; font-family:arial; font-size:12px; margin:15px 0 0 0""><?php echo anchor('category/city','View all cities','class="btn btn-default"');?></p>
                <div class="clear"></div>
        </li>
      <style>
	  a.btn_less{
		display:none;
		}
	  </style>
		<li>&nbsp;</li>
        <li>
        	<div class="inside-subtitle inside-subtitle-2">View Tasker by specialty</div>
        	<ul class="accr" id="list">  
           	 	<li style="padding:0px; width:100%;"><?php  echo anchor('taskers/category/all','Showing All Tasker','class="b-button b-button-2"');?></li>  
                <?php 
					$categorie_list = get_all_category();
					
					if($categorie_list) {  
					foreach($categorie_list as $categorie) {
					
				?>
					<li id="list1" style="padding:0px; width:100%"><?php 
					
					
					 
							if($categoryname == $categorie->category_url_name) {
								echo '<span style="font-size: 15px;">'.$categorie->category_name.'</span>';
							} else {
								echo anchor('taskers/category/'.$categorie->category_url_name,$categorie->category_name,'class="b-button b-button-2"');
							} 
						
					
					
					
					
					
					
					 ?></li>
				<?php 	
					
					} }
				?>
                 <p style="padding-top:20px; float:left; width:100%; text-align:center">
				 <a href="javascript:void(0)" class="btn_more btn btn-default">show more</a>
				 <a href="javascript:void(0)" class="btn_less btn btn-default">show less</a>
				 </p>
				 <script type="text/javascript">
				jQuery(document).ready(function() {
				 jQuery('ul#list').children('li:gt(10)').hide();
				jQuery('.btn_more').click(function(){
					jQuery('ul#list').children().show();
					jQuery('.btn_more').hide();
					jQuery('.btn_less').show();
				});
				jQuery('.btn_less').click(function(){
					jQuery('ul#list').children('li:gt(10)').hide();
					jQuery('.btn_less').hide();
					jQuery('.btn_more').show();
				});

				});
				</script>
                <div class="clear"></div>
            </ul>
        
        </li>
        
        

		
        </ul>
</div>