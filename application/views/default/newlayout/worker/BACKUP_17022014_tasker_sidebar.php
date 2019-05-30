<div class="mconright">
<ul class="padli10">
        <li><div class="estim marB5">Safety is Task # 1</div>
        	<img src="<?php echo base_url().getThemeName(); ?>/images/secure-large.png" alt="">
            <h3 class="col marTB5">All Runners must:</h3>
            <ul class="ulround2">
            	<li>Submit an application</li>
                <li>Pass criminal background check</li>
                <li>Complete video interview</li>
            </ul>    
        </li>
         
        <!--<li>Learn more <a class="fpass" href="#">about safety>></a></li>-->
        <li><div class="estim marB5" style="padding-left: 45px;">Viewing Runner in </div>
        
        	<ul class="ulmycity">
            	<li>
                	<?php 
						if($cityname == 'all') {
							echo '<span style="font-size: 15px;">All</span>';
						} else {
							echo anchor('taskers/all','All');
						} 
                	?> 
                </li>
                
                <?php
			 	 $city_list=city_list();
		  		 $current_city_id=getCurrentCity();
		 
		   		 if($city_list) {  foreach($city_list as $city) { ?>
 
            		<li>
						<?php 
							if($cityname == $city->city_name) {
							 	echo '<span style="font-size: 15px;">'.$city->city_name.'</span>';
							} else {
								echo anchor('taskers/'.$city->city_name,$city->city_name);
							} 
						?> 
                 	</li>
          		 <?php } } ?>
                <div class="clear"></div>
            </ul>
        
        </li>
      

        <li><div class="estim marB5">View Runners by specialty</div>
        	
        	<ul class="accr">  
           	 	<li><?php  echo anchor('taskers/category/all','Showing All Runners');?></li>  
                <?php 
					$categorie_list = get_all_category();
					if($categorie_list) {  foreach($categorie_list as $categorie) {
				?>
					<li><?php 
					
					
					 
							if($categoryname == $categorie->category_url_name) {
							 	echo '<span style="font-size: 15px;">'.$categorie->category_name.'</span>';
							} else {
								echo anchor('taskers/category/'.$categorie->category_url_name,$categorie->category_name);
							} 
						
					
					
					
					
					
					
					 ?></li>
				<?php 	
					} }
				?>
                        
                <div class="clear"></div>
            </ul>
        
        </li>
        
        

		
        </ul>
</div>