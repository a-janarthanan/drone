<section>
<div>
<div>
<div class="page-title mbot20">
<h1 class="mleft15">Worker bees Application</h1>
</div>

<script type="application/javascript">
function setchecked(elemName,status)
{
	elem = document.getElementsByName(elemName);
	for(i=0;i<elem.length;i++){
		elem[i].checked=status;
	}
}


function showbgdiv(i)
{
	if(i==1)
	{
		document.getElementById('add_more2').style.display='block';
		document.getElementById('addimg').style.display='block';
	}
	else
	{
		document.getElementById('add_more2').style.display='none';
		document.getElementById('addimg').style.display='none';
		document.getElementById('err1').style.display='none';
	}
	
}

function append_div2()
{
	var tmp_div2 = document.createElement("div");
	tmp_div2.className = "";								
	
	var glry_cnt=document.getElementById('glry_cnt').value;
	
	if(glry_cnt<5)
	{
		document.getElementById('glry_cnt').value=parseInt(glry_cnt)+1;
		var num=parseInt(glry_cnt)+1;
		
		tmp_div2.id='galry'+num;
		
		var content='<div class="padB10 clear"></div>';		
		content=content + document.getElementById('more2').innerHTML;
		var str = '<div onclick="remove_gallery_div('+num+')" class="fr" style="text-align:left;font-weight:bold;cursor:pointer;color:#990000;">Remove</div><div class="clear"></div>';			
		tmp_div2.innerHTML = content +str;	
	
		document.getElementById('add_more2').appendChild(tmp_div2);
		
		if(parseInt(glry_cnt)+1>=5)
		{
			document.getElementById('addimg').style.display='none';
		}
	}
	else
	{
		document.getElementById('addimg').style.display='none';
	}
							
	
}


function remove_gallery_div(id)
{						
		var element = document.getElementById('galry'+id);
		var add_more = parent.document.getElementById('add_more2');
		
		var add_parent=add_more.parentNode.offsetHeight;			
		var remove_height=parseInt(element.offsetHeight)+20;		
		var final_height=add_parent - remove_height;	
		
		element.parentNode.removeChild(element);
		add_more.parentNode.style.height = final_height+'px';
		
		var glry_cnt=document.getElementById('glry_cnt').value;
		document.getElementById('glry_cnt').value=parseInt(glry_cnt)-1;
			
		document.getElementById('addimg').style.display='block';
	
	}


function submitattachment_valid()
{
	
	var bgchk=document.workerApplyForm.worker_background[0].checked;
	var check=false;
	
	var glry_cnt=document.getElementById('glry_cnt').value;

	if(bgchk==true)
	{
	
        var chks = document.getElementsByName('file_up[]');
 
        var hasChecked = false;
     
	 	
		if(glry_cnt==1)
		{
		
			for (var i = 0; i < chks.length; i++)
			{
					if (chks[i].value=='')
					{
							check=false;
							var dv = document.getElementById('err1');
							
							dv.className = "error";
							dv.style.clear = "both";
							dv.style.minWidth = "110px";
							dv.style.margin = "5px";
							dv.innerHTML ='<ul><p>Attachment is required.</p></ul>';
							dv.style.display='block';						
							hasChecked = true;                        
							
					}
					else 
					{						
							value = chks[i].value;
							t1 = value.substring(value.lastIndexOf('.') + 1,value.length);
							if( t1=='jpg' || t1=='jpeg' || t1=='gif' || t1=='png' || t1=='JPEG' || t1=='JPG'  ||  t1=='PNG' || t1=='GIF' || t1=='pdf' || t1=='PDF')
							{
								document.getElementById('err1').style.display='none';
								check=true;
							}
							else
							{							
								check=false;
								var dv = document.getElementById('err1');
								
								dv.className = "error";
								dv.style.clear = "both";
								dv.style.minWidth = "110px";
								dv.style.margin = "5px";
								dv.innerHTML = '<ul><p>Attachment type is not valid.</p></ul>';
								dv.style.display='block';
								hasChecked = true;							
											
							}
					
					}
									
			}
		
		}
		else
		{
			check=true;
		}
		
		if(check==false)
		{
			return false;
		}
		else { return true; }
		
	} else {   return true; } 
		
	 
	 
	 
}


</script>
		<?php 
		$site_setting=site_setting();
			$attributes = array('name'=>'workerApplyForm','id'=>'workerApplyForm','onsubmit'=>'return submitattachment_valid()');
			echo form_open_multipart('worker/edit',$attributes);
		?>
            <div id="s1post" style="margin:0 0 0 15px;"><a href="<?php echo base_url().'user/'.$user_info->profile_name; ?>" class="dhan"><?php echo $this->session->userdata('full_name'); ?></a></div>

			<ul class="appul" style="margin:0 0 0 15px;">
            	<li>Welcome to the BumbleBeeme Worker bee application process!</li>
            	<li>There are 4 simple steps to becoming an official Worker bee:
                	<ul class="ordlistappl">
                    	<li>Fill out this application</li>
                    	<li>Complete a video interview</li>
                    	<li>Complete a secure background check</li>
                        <li>Take a short informational quiz</li>
                    </ul>
                </li>
            	<li><p><b>Please note:</b> we often have a waiting list to become a Worker bee. When this is the case, it may take some time to move through this process. We very much appreciate your patience and are expanding as fast as our cottontails can manage!</p></li>
                
                <li><p>Please answer ALL questions in complete sentences and be as descriptive as possible.</p>
                <p>Please note: Incomplete applications will be declined.</p> </li>
<li>   
        


			   <?php if($error != '') { ?>     
				  <div id="error"> 
						<div class="follfi">There were problems with the following fields:</div>
                        <ul>
							<?php echo $error; ?>
                            </ul>
			   </div>
			   <?php } ?>
</li>                
                <li><p>Details from your <a href="<?php echo base_url(); ?>account" class="fpass">account</a></p>
    				<p>Email: <?php echo $user_info->email; ?>.</p>
                </li>
                <li>First Name: <?php echo $user_info->first_name; ?>.</li>
                <li>Last Name: <?php echo $user_info->last_name; ?>.</li>
                <li>Mobile Phone: <?php echo $user_info->mobile_no; ?>.</li>
                <!--<li>
                    <label>
                      <input type="checkbox" name="" value="checkbox" id="" checked="checked" />
                      I want to receive new Task notifications via SMS (text messages)</label>
                </li>-->
                <li>
                
                 
                	<h4>Cities</h4>
                    <p>Choose your location or select Virtual if you don't see your city listed.</p>
					<select name="worker_cities[]" id="worker_cities" class="selboxwi200" multiple="multiple"  style="height:90px;">
					<?php 
						$cites = city_list();
						foreach ($cites as $city){  ?>
						
							<option value="<?php echo $city->city_id;?>" <?php if($worker_cities) {  if(in_array($city->city_id,$worker_cities)) { ?> selected="selected" <?php } }  ?>><?php echo $city->city_name;?></option>
						<?php } 
					?>
                    </select>    

                </li>
                <li>
                	<h4>Home Address</h4>

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="apptab1">
   <tr>
    <td><h4>Location name</h4><input name="worker_location_name" id="worker_location_name" type="text" class="ntexttf" value="<?php echo $worker_location_name; ?>" /></td>
  </tr>
  
  <tr>
    <td><h4>Postal Code</h4><input name="worker_zipcode" id="worker_zipcode" type="text" class="ntexttf" value="<?php echo $worker_zipcode; ?>"/></td>
  </tr>
  
   <tr>
    <td><h4>Address</h4><input name="worker_address" type="text" class="ntexttf" value="<?php echo $worker_address; ?>" id="worker_address"/></td>
  </tr>
  
  <tr>
    <td><h4>City</h4><input name="worker_city" type="text" class="ntexttf" value="<?php echo $worker_city; ?>" id="worker_city"/></td>
  </tr>
  
  <tr>
    <td><h4>Country</h4><input name="worker_state" type="text" class="ntexttf" value="<?php echo $worker_state; ?>" id="worker_state" /></td>
  </tr>
  
 <?php /*?> <tr>
    <td class="selhov">
      <label>
        <input type="checkbox" name="save_location" value="1" id="save_location" <?php if($save_location==1) { ?> checked="checked" <?php } ?> />
        Save this location</label>
	</td>
  </tr><?php */?>
  
  <tr>
    <td><h4>Travel range </h4>
	<select name="worker_home_neighborhood" id="worker_home_neighborhood">
		<option value="" <?php if($worker_home_neighborhood=="") echo 'selected'; ?>>--Select--</option>
		<option value="1" <?php if($worker_home_neighborhood==1) echo 'selected'; ?>>Up to 10 miles</option>
		<option value="2" <?php if($worker_home_neighborhood==2) echo 'selected'; ?>>Up to 20 miles</option>
		<option value="3" <?php if($worker_home_neighborhood==3) echo 'selected'; ?>>Up to 30 miles</option>
	</select>
	</td>
  </tr>
  
 <!-- <tr>
    <td><h4>Work neighborhood</h4><input name="worker_work_neighborhood" type="text" class="ntexttf" value="<?php echo $worker_work_neighborhood; ?>" id="worker_work_neighborhood"/></td>
  </tr>-->
  
   <tr>
    <td>

  
    <h4>Select the Task types of which you would like to be notified (you can change this later)</h4><br />

     <a href="javascript:void(0)" onclick="javascript:setchecked('worker_task_type[]',1)" class="fpass">Select all</a>,  <a href="javascript:void(0)" onclick="javascript:setchecked('worker_task_type[]',0)" class="fpass">Select none</a><br /><br />


    	<ul class="mcats">
			<?php 
			
			$post_worker_task_type=array();
			
			if($worker_task_type)
			{
				$post_worker_task_type=$worker_task_type;
			}
		
				
				$categories = get_all_category();
				if($categories) { 
					foreach ($categories as $category){
						if(in_array($category->task_category_id,$post_worker_task_type)){  $checked= 'checked="checked"';} else { $checked=''; }
						
						echo '<li><input name="worker_task_type[]" id="worker_task_type" type="checkbox" value="'.$category->task_category_id.'" '.$checked.' /><span>'.$category->category_name.'</span></li>';
					} 
				}

			?>
         	<div class="clear"></div>
		</ul> 
        <div class="clear"></div>           
    </td>
  </tr>  
  
  <tr>
    <td>
    <h4>1.What means of transportation would you use to complete Tasks?</h4>
  	<ul class="apque">
		<?php 
		
		$post_worker_transportation=array();
			
			if($worker_transportation)
			{
				$post_worker_transportation=$worker_transportation;
			}
		
		
		
				foreach ($transportations as $transportation){ 
					if(in_array($transportation->transportation_id,$post_worker_transportation)){  $checked= 'checked="checked"';} else { $checked=''; }
					
					echo  '<li><label><input type="checkbox" name="worker_transportation[]" id="worker_transportation" value="'.$transportation->transportation_id.'" '.$checked.'/>&nbsp;&nbsp;'.$transportation->name.'</label></li>';
				} 
		?>
  	</ul>
   </td>
  </tr>
  
  <tr>
    <td>
        <h4>2. How do your talents, skills, and qualities contribute to your wanting to become a Worker bee?</h4>
	    <textarea name="worker_skills" cols="72" rows="3" id="worker_skills"><?php echo $worker_skills; ?></textarea>
    </td>
  </tr>
  <tr><td>&nbsp;&nbsp;</td></tr>
  <tr>
    <td><h4>3.What devices do you use in your everyday life?</h4>
    	<ul class="apque">
		
		<?php 
				$post_worker_devices=array();
			
			if($worker_devices)
			{
				$post_worker_devices=$worker_devices;
			}
			
			
			foreach ($devices as $device){ 
				
					if(in_array($device->device_id,$post_worker_devices)){  $checked= 'checked="checked"';} else { $checked=''; }
					
					echo  '<li><label><input type="checkbox" name="worker_devices[]" id="worker_devices" value="'.$device->device_id.'" '.$checked.'  />&nbsp;&nbsp;'.$device->device_name.'</label></li>';
					
				} 
		?>
       
        </ul>
    </td>
  </tr>
  
  <tr>
  	<td><h4>4. How comfortable are you in your use of the Internet?</h4>
    	<ul class="apque">
        <li><label><input type="radio" name="worker_Internet" value="Novice" id="worker_Internet" <?php if($worker_Internet == 'Novice'){ echo 'checked="checked"';} ?> />&nbsp;&nbsp;Novice</label></li>
		<li><label><input type="radio" name="worker_Internet" value="Intermediate" id="worker_Internet" <?php if($worker_Internet == 'Intermediate'){ echo 'checked="checked"';} ?> />&nbsp;&nbsp;Intermediate</label></li>
		<li><label><input type="radio" name="worker_Internet" value="Advanced" id="worker_Internet" <?php if($worker_Internet == 'Advanced'){ echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Advanced</label></li>
        <li><label><input type="radio" name="worker_Internet" value="Hacker" id="worker_Internet" <?php if($worker_Internet == 'Hacker'){ echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Hacker</label></li>
        </ul>
    </td>
  </tr> 
  
  <tr>
  	<td>
    <?php 
	
	$post_worker_available_day=array();
			
			if($worker_available_day)
			{
				$post_worker_available_day=$worker_available_day;
			}
			
			?>
    <h4>5. What days of the week are you generally available to do tasks?</h4>
    <ul class="apque">
		<li><label><input type="checkbox" name="worker_available_day[]" value="Sunday" id="worker_available_day" <?php if(in_array('Sunday',$post_worker_available_day)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Sunday</label></li>
        
		<li><label><input type="checkbox" name="worker_available_day[]" value="Monday" id="worker_available_day" <?php if(in_array('Monday',$post_worker_available_day)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Monday</label></li>
        
		<li><label><input type="checkbox" name="worker_available_day[]" value="Tuesday" id="worker_available_day" <?php if(in_array('Tuesday',$post_worker_available_day)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Tuesday</label></li>
        
		<li><label><input type="checkbox" name="worker_available_day[]" value="Wednesday" id="worker_available_day" <?php if(in_array('Wednesday',$post_worker_available_day)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Wednesday</label></li>
        
		<li><label><input type="checkbox" name="worker_available_day[]" value="Thursday" id="worker_available_day" <?php if(in_array('Thursday',$post_worker_available_day)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Thursday</label></li>
        
		<li><label><input type="checkbox" name="worker_available_day[]" value="Friday" id="worker_available_day" <?php if(in_array('Friday',$post_worker_available_day)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Friday</label></li>
        
		<li><label><input type="checkbox" name="worker_available_day[]" value="Saturday" id="worker_available_day" <?php if(in_array('Saturday',$post_worker_available_day)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Saturday</label></li>
    </ul>
    </td>
  </tr> 
   
  <tr>
  	<td>
    
       <?php 
	
	$post_worker_available_time=array();
			
			if($worker_available_time)
			{
				$post_worker_available_time=$worker_available_time;
			}
			
			?>
            
            
    <h4>6. What time of day are you generally available?</h4>
    <ul class="apque">
		<li><label><input type="checkbox" name="worker_available_time[]" value="Morning" id="worker_available_time" <?php if(in_array('Morning',$post_worker_available_time)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Morning</label></li>
        
		<li><label><input type="checkbox" name="worker_available_time[]" value="Midday" id="worker_available_time" <?php if(in_array('Midday',$post_worker_available_time)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Midday</label></li>
        
		<li><label><input type="checkbox" name="worker_available_time[]" value="Afternoon" id="worker_available_time" <?php if(in_array('Afternoon',$post_worker_available_time)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Afternoon</label></li>
        
		<li><label><input type="checkbox" name="worker_available_time[]" value="Evening" id="worker_available_time" <?php if(in_array('Evening',$post_worker_available_time)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Evening</label></li>
        
		<li><label><input type="checkbox" name="worker_available_time[]" value="Last Night" id="worker_available_time" <?php if(in_array('Last Night',$post_worker_available_time)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Last Night</label></li>
    </ul>
    </td>
  </tr> 
  
  <tr>
    <td>
        <h4>7. Anything else you&acute;d like us to know about your availability to do tasks?</h4>
	    <textarea name="worker_availability" cols="72" rows="3" id="worker_availability"><?php echo $worker_availability; ?></textarea>
    </td>
  </tr>

  <tr>
    <td>
<h4>8. How did you hear about Bumblebeeme  <?php //echo $site_setting->site_name; ?>?</h4>

   <?php 
	
	$post_worker_hear_about=array();
			
			if($worker_hear_about)
			{
				$post_worker_available_time=$worker_hear_about;
			}
			
		
			?>
            
            
<ul class="apque">

	
    
	<li><label><input type="checkbox" name="worker_hear_about[]" value="Daily Deal Site (Groupon, Living Social, etc.)" id="worker_hear_about"  <?php if(in_array('Daily Deal Site (Groupon, Living Social, etc.)',$post_worker_hear_about)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Daily Deal Site (Groupon, Living Social, etc.)</label></li>
    
	<li><label><input type="checkbox" name="worker_hear_about[]" value="Email Marketing" id="worker_hear_about"  <?php if(in_array('Email Marketing',$post_worker_hear_about)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Email Marketing</label></li>
    
	<li><label><input type="checkbox" name="worker_hear_about[]" value="Social Media (Facebook, Twitter)" id="worker_hear_about"  <?php if(in_array('Social Media (Facebook, Twitter)',$post_worker_hear_about)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Social Media (Facebook, Twitter)</label></li>
    
	<li><label><input type="checkbox" name="worker_hear_about[]" value="Magazine/Newspaper" id="worker_hear_about"  <?php if(in_array('Magazine/Newspaper',$post_worker_hear_about)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Magazine/Newspaper</label></li>
    
	<li><label><input type="checkbox" name="worker_hear_about[]" value="Website (TechCrunch, Gigaom, blog, etc.)" id="worker_hear_about"  <?php if(in_array('Website (TechCrunch, Gigaom, blog, etc.)',$post_worker_hear_about)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Website (TechCrunch, Gigaom, blog, etc.)</label></li>
    
	<li><label><input type="checkbox" name="worker_hear_about[]" value="From a friend / Overheard from someone" id="worker_hear_about"  <?php if(in_array('From a friend / Overheard from someone',$post_worker_hear_about)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;From a friend / Overheard from someone</label></li>
</ul>  
    </td>
  </tr> 
  
  <tr>
  	<td><h4>9. Are you willing to submit to a background check?</h4>
    	<ul class="apque">
        <li><label><input type="radio" name="worker_background" value="Yes" id="worker_background" <?php if($worker_background=='' || $worker_background=='Yes') { ?> checked="checked" <?php } ?>  onclick="showbgdiv(1)" />&nbsp;&nbsp;Yes</label></li>
		<li><label><input type="radio" name="worker_background" <?php if($worker_background=='No') { ?> checked="checked" <?php } ?> value="No" id="worker_background" onclick="showbgdiv(0)" />&nbsp;&nbsp;No</label></li>
        </ul>
    </td>
  </tr> 
  
  


  <tr>
  <td>
  <div id="err1" style="display:none;"></div>		
  
  <div id="add_more2" style="display:block; width:400px;"> 
		
        
        
        <?php $dcnt=1;
		
			 if($worker_document) { 
		
				foreach($worker_document as $doc) { 
				
				if(file_exists(base_path().'upload/worker_doc/'.$doc->worker_document)) {
					
				?>
        	
            <div> <b><?php echo $dcnt.')&nbsp;&nbsp;';?><a target="_blank" href="<?php echo base_url();?>upload/worker_doc/<?php echo $doc->worker_document; ?>"><?php echo $doc->worker_document; ?></a></div>
            
            
            <?php $dcnt++;    }  }  } ?>
            <br><br>
        
        
        
        <p><span class="colora"><b>NOTE :</b></span> Only PDF,PNG, JPG, GIF file extension are allowed.<br /><br /></p>
        
        
				 <div id="more2">
				  
					  <div class="fl">Attachment : * </div>                        
                         
                      <div class="fl"><input name="file_up[]" type="file" /></div>
                  
				</div>
				
	</div>
				<div class="clear"></div>
					<input type="hidden" name="glry_cnt" id="glry_cnt" value="<?php echo $dcnt; ?>" />
			<div id="addimg" style="display:block;"><img src="<?php echo base_url().$theme; ?>/images/add.png" height="16" width="16" border="0" title="add more" onclick="append_div2();" style="cursor:pointer;" /></div>
  
  </td>
  </tr>
  
  <tr>
  	<td><h4>Birthdate</h4>

    	<ul class="apque">
		<li>
            <select name="bobyear" id="">
            <?php
                for($i=1950;$i<=date('Y');$i++)
                {
            ?>
            <option value="<?php echo $i; ?>"  <?php if($bobyear ==  $i){ echo 'selected';} ?>  ><?php echo $i; ?></option>
            <?php
                }
            ?>
            </select>
            
            <select name="bobmonth" id="">
            <option value="1" <?php if($bobmonth == '1'){ echo 'selected';} ?>>January</option>
            <option value="2" <?php if($bobmonth == '2'){ echo 'selected';} ?>>February</option>
            <option value="3" <?php if($bobmonth == '3'){ echo 'selected';} ?>>March</option>
            <option value="4" <?php if($bobmonth == '4'){ echo 'selected';} ?>>April</option>
            <option value="5" <?php if($bobmonth == '5'){ echo 'selected';} ?>>May</option>
            <option value="6" <?php if($bobmonth == '6'){ echo 'selected';} ?>>June</option>
            <option value="7" <?php if($bobmonth == '7'){ echo 'selected';} ?>>July</option>
            <option value="8" <?php if($bobmonth == '8'){ echo 'selected';} ?>>August</option>
            <option value="9" <?php if($bobmonth == '9'){ echo 'selected';} ?>>September</option>
            <option value="10" <?php if($bobmonth == '10'){ echo 'selected';} ?>>October</option>
            <option value="11" <?php if($bobmonth == '11'){ echo 'selected';} ?>>November</option>
            <option value="12" <?php if($bobmonth == '12'){ echo 'selected';} ?>>December</option>
            </select>
            
            <select name="bobday" id="">
            <?php
                for($i=1;$i<=31;$i++)
                {
            ?>
            <option value="<?php echo $i; ?>" <?php if($bobday ==  $i){ echo 'selected';} ?>><?php echo $i; ?></option>
            <?php
                }
            ?>	
            </select>
        </li>
        </ul>
    </td>
  </tr>
  
</table>
  
                </li>
            </ul>    

      <div class="area-ph"> 
     <input type="submit" name="worker_apply" class="submbg2" value="Update">   
		</div>

         </form>


<?php if($worker_background=='' || $worker_background=='Yes'){ $setselc=1; } else {  $setselc=0; } ?>


<script type="text/javascript">

var setselc=<?php echo $setselc; ?>;

function setattach()
{
	
	if(setselc=='1')
	{
		
		
			document.getElementById('add_more2').style.display='block';
			document.getElementById('addimg').style.display='block';
		
			document.workerApplyForm.worker_background[0].checked=true;	
		
	}
	
	if(setselc=='0')
	{
		
		document.getElementById('add_more2').style.display='none';
			document.getElementById('addimg').style.display='none';
		
			document.workerApplyForm.worker_background[1].checked=true;	
	}
	
}





window.onload= function() {  
 
 setattach();
 
 };
 
 </script>
    </div>
</div>
</section>