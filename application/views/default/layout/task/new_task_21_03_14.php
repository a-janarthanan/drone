<link type="text/css" rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/js/css/category-slider-fancy-newtask.css"/>

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

 <?php 
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




<div style="width:700px;">

<?php $site_setting=site_setting(); 

	$attributes = array('name'=>'frm_new_task');
	
	 if($task_id!='' && $task_id!=0) {  
	   echo form_open('task/update_task_step_zero/'.$task_id,$attributes);
	}
	else
	{
			
		echo form_open('task/new_task',$attributes);
			
	}
?>
<?php $cities=city_list(); ?>

    <span id="s2post">Post a Task</span>  <span class="marLR20">in</span>
        <select name="task_city_id" id="task_city_id" class="selboxwi200">
			<?php 
				if($cities){
					foreach($cities as $c){
			?>
			<option value="<?php echo $c->city_id; ?>" <?php if(isset($task_detail->task_city_id)) { if($task_detail->task_city_id==$c->city_id) { ?> selected="selected" <?php } } ?>><?php echo ucfirst($c->city_name); ?></option>
			<?php
					}
				}
			?>
        </select>


<br>
		




<input name="task_category_id" id="task_category_id" type="hidden" value="" />
    <style>
	.fadeimg{background:#555;}
	</style>
    
    
    
    <div id="container-cat-fancy">
    <div id="carousel-cat-fancy">
				


		<?php 
		
		$cat_arr=array();
		
		if($categories){ $ic=1; $putval=0;
					foreach($categories as $c){
					
					
					if($ic>3) {  $ic=1; $putval++; 	}
					
		$category_image=base_url().'upload/category/no_image.png';

		
					if($c->category_image!='') {  
					
						if(file_exists(base_path().'upload/category_orig/'.$c->category_image)) { 
							
							$category_image=base_url().'upload/category_orig/'.$c->category_image;
						
						}
						
					}
					
					
					 ?>
	    	<div class="slidedivbox slidecatfancy"  id="c<?php echo $c->task_category_id; ?>" onclick="return getmyCat(this.id,this);">
	
                    <div class="c<?php echo $c->task_category_id; ?>"><img src="<?php echo $category_image; ?>" id="imgc<?php echo $c->task_category_id; ?>"  width="94" height="94" alt="" border="0" /></div>
                    <div id="nmc<?php echo $c->task_category_id; ?>"><?php echo ucfirst($c->category_name); ?></div>
		 </div>                     
					<?php
					
					
					$cat_arr['c'.$c->task_category_id]=$putval;
					
					
					
					$ic++;
					
					 } } ?>
                    
                      </div>
    <a style="cursor:pointer;" id="ui-carousel-next-cat-fancy"><span>next</span></a>
    <a style="cursor:pointer;" id="ui-carousel-prev-cat-fancy"><span>prev</span></a>
</div>


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
					width: 100,
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

<div class="underl marT10">
<table width="100%" border="0" cellspacing="1" cellpadding="5">
<tr>
<td width="10%" align="right"><img width="20" height="20" border="0"  alt="" src="<?php echo base_url().getThemeName(); ?>/images/category.png"></td>
<td width="20%" align="left"><b class="colblack marL10">Category Selected</b> : </td>
<td width="70%"><img src="" width="60" height="60" alt="" border="0" id="selcatimg" /><br /><span id="results"></span></td>
</tr>
</table>


</div>





	<div class="underl posrel">
        <table width="90%" border="0" align="center" cellspacing="1" cellpadding="5">
          <tr>
            <td width="7%"  valign="top"><div class="refresbg"></div></td>
            <td width="78%" ><div id="hidetask">This Task  <a href="javascript:void();" class="plinks" id="changetask1"><?php if(isset($task_detail->task_repeat)) { if($task_detail->task_repeat==1) {?>repeats<?php } else { ?>does not repeat<?php } } else {?>does not repeat<?php }?></a> <span class="req">Need it done weekly? Every two weeks? <a href="#" class="fpass">Learn more</a></span></div>
           
           
           
            <div id="showtask" style="display:none;">
               
                <label style="cursor:pointer; "><input type="radio" name="repeatenable" value="0" <?php if(isset($task_detail->task_repeat)) {  if($task_detail->task_repeat==0) {?> checked="checked" <?php } } ?> id="repeatenable" />This Task does not repeats regularly
                </label>
                
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
            <td width="15%"><a href="javascript:void();" class="chbg" id="changetask" style="color:#fff;">Change</a></td>
          </tr>
        </table>
    </div>






<div class="underl">
    <table width="90%" border="0" align="center" cellspacing="1" cellpadding="5">
      <tr>
        <td width="7%" valign="top"><div class="icardbg"></div></td>
        <td width="78%"><div id="hideauto">
        
        
         <?php if($task_id!='' && $task_id!=0) {  
		 
		 
		 if($task_detail->task_auto_assignment==2 ) { ?> 
           
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
               <?php if($task_assign_worker != '' && $task_assign_worker != 0) { ?>
              	 <input type="radio" name="autoassign" value="3" id="autoassign"  checked="checked"/>
                 
               <?php } else { ?>
               
                 <input type="radio" name="autoassign" value="3" id="autoassign"  <?php if(isset($task_detail->task_auto_assignment)) {  if($task_detail->task_auto_assignment==3) { ?> checked="checked" <?php }} ?> />
                 
                 <?php } ?>
                 
                 Give first dibs to a <?php echo $site_setting->site_name;?> I've worked with before</label> <a href="javascript:void();" id="showp3" class="fl marTL5"><div class="questions" ></div></a><div class="clear"></div>
   
    <div id="dialog-form-p3">
        <h3 class="fl">Let me give dibs</h3>
        <a href="javascript:void();" class="fr"  id="closep3" title="close" ><div class="closebg" ></div></a><div class="clear"></div>
        <p class="lineh17 padTB3">The Worker bee you choose will have a period of exclusivity where only he or she can be assigned. If your chosen Worker bee does not respond, the exclusivity is lifted and it's up for grabs. You will be able to accept or decline offers from other Worker bees.</p>
    </div>             

   <?php if($task_assign_worker != '' && $task_assign_worker != 0) { ?>
   
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
    
   <?php } else {?>
   
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
   
   <?php } } ?>
    
   
                 
                 <div class="clear"></div>
                </li>
                

       		</ul>            	
        </div>
        
        </td>
        <td width="15%"><a href="javascript:void();" class="chbg" id="changeauto" style="color:#fff;">Change</a></td>
      </tr>
    </table>
</div>

<div class="padTB10">
                <input name="sub_step" class="submbg2" value="Save &amp; Continue" type="submit">    
                <input type="hidden" name="task_id" id="task_id" value="<?php echo $task_id; ?>" />   
                <input type="hidden" name="copy" id="copy" value="<?php echo $copy; ?>" />      
                <span id="req">Next step: Add more details, locations, and name your price.</span>

</div>
</form>


	</div>
    
    
   