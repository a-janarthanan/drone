<section>
<div>
<div>
<div class="red-subtitle" style="margin:162px 0 0 0">How  TaskIt  works</div>
    	<div id="two-columnar-section">
        <div class="task-layout">
        <div class="db-rightinfo" style="width:100%; margin:25px 0 0 0">
        <div class="home-signpost-content">
    <?php $site_setting=site_setting(); ?>
        
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td>        
        
        <ul class="thapp">
        <li>
        
        <p class="fs18 LH23">Taskit gets you in touch with friendly, reliable people who can help you get just about anything you need done, and put some free time back into your life.</p>
        </li>
        
		<li>        
        <!--<p class="marT5 fs13 LH18">Currently Tasking in 
        
        <?php $map_city=city_list(); if($map_city) { foreach($map_city as $city) { 
		
		echo  anchor('map/in/'.$city->city_name,$city->city_name,'class="fpass"').','; } } ?>
       __ more coming soon! <?php echo  anchor('map/','Browse live Tasks &raquo;','class="fpass"'); ?></p>-->
        </li>
        
        <li>
     
      <?php if(!check_user_authentication()) {  echo anchor('login','Post a Task',' class="login" ');  } else {       
        
        echo anchor('new_task','Post a Task',' id="various3" class="submbgsearch" '); } ?>     
        
        </li>
        </ul>
        </td>
    <!--<td>
    <iframe width="450" height="316" src="http://www.youtube.com/embed/lBehsoMuMrM" frameborder="1" allowTransparency="true" style="z-index:0" allowfullscreen></iframe>
    </td>-->
  </tr>
</table>
        

<table width="100%" border="0" cellspacing="15" cellpadding="0" class="marT20">
  <tr>
    <td valign="top">
    	<div class="title2" style="text-align: center;">1. Post a Task</div>
    	<img src="<?php echo base_url().getThemeName();?>/images/hiw-step1.jpg" class="marTB10" alt="" />
        <div>
			<!--<p class="LH18">It&acute;s free to post a Task! Include all the necessary info for the "<?php echo $site_setting->site_name;?>" to do the job.</p>-->
			<p class="LH18">Posting a task is FREE Just fill in the details.</p>
		</div>
        
        <p class="marT10">Need Task ideas? <?php echo anchor('tags/','Browse Live Tasks &raquo;',' class="fpass fs15"');?></p>
        
    </td>
    <td  valign="top">
    	<div class="title2" style="text-align: center;">2. Taskit make offers</div>
       	<img src="<?php echo base_url().getThemeName();?>/images/hiw-step2.jpg" class="marTB10" alt="" />
        <div>
			<!--<p class="LH18">The background-checked "<?php echo $site_setting->site_name;?>" who makes the lowest bid will automatically be assigned and run your Task.</p>-->
			<p class="LH18">The background checked <?php echo $site_setting->site_name;?> bid for the TASK.</p>
		</div>
        
        <p class="marT10"><?php //echo anchor('taskers/','Meet our friendly "Task" &raquo;',' class="fpass fs15"');?></p>

    </td>
    <td  valign="top" style="text-align: center;">
    	<div class="title2">3. Pay when Task is done</div>
       	<img src="<?php echo base_url().getThemeName();?>/images/hiw-step3.jpg" class="marTB10" alt="" />
        <div>
			<!--<p class="LH18">Pay the "<?php echo $site_setting->site_name;?>" conveniently online; no cash needed.</p>-->
			<p class="LH18">Work is completed Agreed, and money is Paid SAFELY online.</p>
		</div>
        
        <!--<p class="marT10">More about <a href="#" class="fpass fs15">pricing and payment &raquo;</a></p>-->

    
    </td>
  </tr>
</table>
        
<!--<table width="100%" border="0" cellspacing="1" cellpadding="0" class="marT20">
  <tr>
    <td width="34%" align="center"><img alt="" src="<?php echo base_url().getThemeName();?>/images/secure-large.png"></td>
    <td width="66%">
    	<ul class="thapp">
        	<li><div class="title2">Safety is Task #1</div></li>
            <li><p>To ensure the safety and security of the TaskPosters, each and every Worker bees goes through a multiple step application process which includes an essay, video interviews and a background check before being selected to run Tasks.</p></li>
            <li>Learn more about <a href="#" class="fpass">safety &raquo;</a></li>
		</ul>            
        
    </td>
  </tr>
</table>-->
    </div>
</div>
 </div>
</div>


</section>