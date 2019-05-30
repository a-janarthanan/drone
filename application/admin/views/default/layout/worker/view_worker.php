<div id="content" align="center">

<?php if($error != ""){?>

        <div class="column full">

            <span class="message information"><strong><?php echo $error;?></strong></span>

        </div>

<?php } ?> 	



	<div align="left" class="column half">

		<div class="box">

			<h2 class="box-header"><?php echo anchor(front_base_url().'user/'.$row->profile_name,ucfirst($row->first_name).' '.ucfirst($row->last_name),' style="color:#004C7A;" target="_blank"'); ?></h2> 

			<div class="box-content">

			

			

            

			  <table class="tablebox">

                  <tbody class="openable-tbody">

                      <tr><td colspan="2" align="left" valign="top">

                      

                     

                      

                      <table border="0" cellpadding="0" cellspacing="0" width="100%">

                      

                      <tr>

                      

                     	 <td align="left" valign="top" width="150">

                        <?php if($row->profile_image!='') {?>

                                 <img src="<?php echo front_base_url();?>upload/user/<?php echo $row->profile_image;?>" style="border-radius:5px; width:120px; height:120px;"/>

                          <?php } else {?>

                                  <img src="<?php echo front_base_url();?>upload/no_image.png" style="border-radius:5px; width:120px; height:120px;"/>

                          <?php }?>

                          

                          </td>

                          

                          <td align="left" valign="top">

                    

                       <table border="0" cellpadding="0" cellspacing="0" width="70%">

                       <tr>

                          <td style="text-align:left; width:35%"><label class="form-label">Name </label></td>

                          <td style="text-align:left; width:65%">: <?php echo anchor(front_base_url().'user/'.$row->profile_name,ucfirst($row->first_name).' '.ucfirst(substr($row->last_name,0,1)),' style="color:#004C7A;" target="_blank"'); ?></td>

                      </tr>

                      

                       <tr>

                          <td style="text-align:left;"><label class="form-label">Email </label></td>

                          <td style="text-align:left;">: <?php echo $row->email;?></td>

                      </tr>

                      

                       <tr>

                          <td style="text-align:left;"><label class="form-label">City </label></td>

                          <td style="text-align:left;">: <?php echo $row->worker_city;?></td>

                      </tr>

                      

                      

                       <tr>

                          <td style="text-align:left;"><label class="form-label">Postal Code </label></td>

                          <td style="text-align:left;">: <?php echo $row->worker_zipcode;?></td>

                      </tr>

                      

                      </table>

                     

                      

                    	  </td>

                      

                      </tr>

                      </table>

                      

                      

                      </td></tr>

                      

                       <tr><td colspan="2"><hr/></td></tr>

                   <tr>
                   <td colspan="2">
                   
               

		 <?php
 $attributes = array('name'=>'frm_worker');
echo form_open('worker/view_worker/'.$row->worker_id,$attributes);
?>	  

			 <div align="right"> <input type="submit" class="button themed" name="submit" value="Update" /></div>
             

			  <label class="form-label">Level :</label>  

			<input type="text" name="worker_level" id="worker_level" class="form-field" value="<?php echo $row->worker_level;?>" />

				  

		  <label class="form-label">Status : </label> <?php //echo $worker_status;?>

				 <select name="worker_status" id="worker_status" class="form-field">

						<option value="0" <?php if($row->worker_status  == 0){ ?> selected="selected" <?php } ?>>InActive</option>

						<option value="1" <?php if($row->worker_status  == 1){ ?> selected="selected" <?php } ?>>Active</option>

                        <option value="2" <?php if($row->worker_status  == 2){ ?> selected="selected" <?php } ?>>Reject</option>

						 	  		 	  				 												

				  </select>

        

        

        

        <hr/>

        

                

				  									

				<label class="form-label">App Approved</label>  <?php //echo $worker_app_approved;?><br />

		<div class="radiocheck" style="position:absolute;">

			<input type="radio" id="check1" name="worker_app_approved" value="1" <?php if($row->worker_app_approved  == 1){ echo 'checked="checked"';} ?> /><label for="check1">Yes</label>

			<input type="radio" id="check2" name="worker_app_approved" value="0" <?php if($row->worker_app_approved  == 0){ echo 'checked="checked"';} ?>/><label for="check2">No</label>

	

		</div>

        

        <?php if($row->worker_app_approved  == 1){ echo '<div  style="position:relative; left:166px; top:-3px;"><a class="link1" href="#"><img src="'.base_url().getThemeName().'/images/abr1.png" alt="" /></a></div>'; } ?>

        

		

        

       <br/><br/><label class="form-label">Background Approved </label>   <?php //echo $worker_background_approved;?><br />

		<div class="radiocheck" style="position:absolute;">

			<input type="radio" id="check3" name="worker_background_approved" value="1"  <?php if($row->worker_background_approved  == 1){ echo 'checked="checked"'; } ?>/><label for="check3">Yes</label>

			<input type="radio" id="check4" name="worker_background_approved" value="0"  <?php if($row->worker_background_approved  == 0){ echo 'checked="checked"'; } ?>/><label for="check4">No</label>

			

		</div>

        

         <?php if($row->worker_background_approved  == 1){ echo '<div  style="position:relative; left:166px; top:-3px;"><a class="link1" href="#"><img src="'.base_url().getThemeName().'/images/abr2.png" alt="" /></a></div>'; } ?>

         

        

		<br/><hr/>

				  <label class="form-label">&nbsp;</label>

				 <input type="hidden" name="worker_id" id="worker_id" value="<?php echo $row->worker_id; ?>" >

            
				  

			  </form>



                   </td></tr>
                   
                   
                   

                     

                      <tr>

                          <td style="text-align:left;"><label class="form-label">Address </label></td>

                          <td style="text-align:left;">: <?php echo $row->worker_address;?></td>

                      </tr>

                     

                  	  <tr>

                          <td style="text-align:left;"><label class="form-label">State </label></td>

                          <td style="text-align:left;">: <?php echo $row->worker_state;?></td> 

                      </tr>

                     

                    

                      <tr>

                          <td style="text-align:left;"><label class="form-label">Mobile Number </label></td>

                          <td style="text-align:left;">: <?php echo $row->mobile_no;?></td>

                      </tr>

                      

                      

                        <tr>

                          <td style="text-align:left;"><label class="form-label">Phone Number </label></td>

                          <td style="text-align:left;">: <?php echo $row->phone_no;?></td>

                      </tr>

                      

                      

                      

                         <tr>

                          <td style="text-align:left; width:180px;"><label class="form-label">Birthdate </label></td>

                          <td style="text-align:left;"> : <?php echo date($site_setting->date_format,strtotime($row->worker_birthdate));?></td>

                      </tr>

                      

                        <!--<tr>

                          <td style="text-align:left;"><label class="form-label">Home Neighborhood </label></td>

                          <td style="text-align:left;">: <?php echo $row->worker_home_neighborhood;?></td>

                      </tr>

                      <tr>

                          <td style="text-align:left;"><label class="form-label">Work Neighborhood </label></td>

                          <td style="text-align:left;">: <?php echo $row->worker_work_neighborhood;?></td>

                      </tr>-->

                      

                      

                      

                        <tr><td colspan="2"><hr/></td></tr>

                      

                      

                      

                     <!--   <tr>

                          <td style="text-align:left;"><label class="form-label">About Worker</label></td>

                          <td style="text-align:left;">: <?php echo $row->about_user;?></td>

                      </tr>-->

                      

                      

                      <?php $worker_cities=$this->worker_model->get_worker_cities($row->worker_id);

					  

					    if($worker_cities) {

						

						 ?>

                      

                         <tr>

                          <td style="text-align:left;"><label class="form-label">Work Cities</label></td>

                          <td style="text-align:left;">: <?php $city_list='';

				  

				   foreach($worker_cities as $wc) {   

                   

				   $city_list .=ucfirst($wc->city_name).',';

				   

                   }  

				   

				   echo substr($city_list,0,-1); ?></td>

                      </tr>

                      

                      <?php } ?>

                      

                      

                      <tr><td colspan="2"><hr/></td></tr>

                      

                      

                      

                        <tr>

                          <td style="text-align:left;"><label class="form-label">Mini- resume (write some things about yourself and your work carrier.)</label></td>

                          <td style="text-align:left;">: <?php echo $row->worker_skills;?></td>

                      </tr>

                      

                      

                      <!-- <tr>

                          <td style="text-align:left;"><label class="form-label">About do Task </label></td>

                          <td style="text-align:left;">: <?php echo $row->worker_availability;?></td>

                      </tr>-->

                      

                      

                       <tr><td colspan="2"><hr/></td></tr>

                       

                       

                      <tr>

                          <td style="text-align:left;"><label class="form-label">Available Day </label></td>

                          <td style="text-align:left;">: <?php echo $row->worker_available_day;?></td>

                      </tr>

                      <tr>

                          <td style="text-align:left;"><label class="form-label">Available Time </label></td>

                          <td style="text-align:left;">: <?php echo $row->worker_available_time;?></td>          

                      </tr>

                    

                      <tr>

                          <td style="text-align:left;"><label class="form-label">Task Type </label></td>

                          <td style="text-align:left;">: <?php 

                                   if($row->worker_task_type != ''){

                                       $cate=explode(',',$row->worker_task_type);

                                       foreach($cate as $c)

                                       {

                                           if(get_category_name($c) != '') {
                                           		echo get_category_name($c).', '; 
										  	}

                                       }

                                   }

                                   ?></td>

                          

                          </tr>

                  	 <tr>

                 		 <td style="text-align:left;"><label class="form-label">Transportation </label></td>

                 		 <td style="text-align:left;"> : <?php 

                            if($row->worker_transportation != ''){

                               $trans=explode(',',$row->worker_transportation);

                               foreach($trans as $t)

                               {

                                   echo get_transportation_name($t).', '; 

                               }

                             }

                           ?></td>

                  	  </tr>
                       <tr>

                          <td style="text-align:left;"><label class="form-label">Document number  </label></td>

                          <td style="text-align:left;">: <?php echo $row->worker_securitynum;?></td>

                      </tr>

                      

                      

                        <tr><td colspan="2"><hr/></td></tr>

                        

                        

                     <!-- <tr>

                          <td style="text-align:left;"><label class="form-label">Internet </label></td>

                          <td style="text-align:left;">: <?php echo $row->worker_Internet;?></td>

                      </tr>

                      

                      

                        

                      <tr>

                          <td style="text-align:left;"><label class="form-label">Devices </label></td>

                          <td style="text-align:left;">: <?php 

                                   if($row->worker_devices != ''){

                                       $device=explode(',',$row->worker_devices);

                                       foreach($device as $d)

                                       {

                                           echo get_device_name($d).', '; 

                                       }

                                      }

                                   ?></td>

                      

                      </tr>

                    

                      

                      

                    

                        

                     

                      <tr>

                          <td style="text-align:left;"><label class="form-label">Hear About </label></td>

                          <td style="text-align:left;">: <?php echo $row->worker_hear_about;?></td>

                      </tr>

                      

                      

                          <tr><td colspan="2"><hr/></td></tr>

                        

                        <?php if($row->facebook_link!='') { ?>

                        

                         <tr>

                          <td style="text-align:left;"><label class="form-label">Facebook Link </label></td>

                          <td style="text-align:left;">: <?php echo $row->facebook_link;?></td>

                      </tr>

                      

                       <?php } if($row->linkedin_link!='') { ?>

                      <tr>

                          <td style="text-align:left;"><label class="form-label">Linkedin Link </label></td>

                          <td style="text-align:left;">: <?php echo $row->linkedin_link;?></td>

                      </tr>

                      <?php } if($row->twitter_link!='') { ?>

                      <tr>

                          <td style="text-align:left;"><label class="form-label">Twitter Link </label></td>

                          <td style="text-align:left;">: <?php echo $row->twitter_link;?></td>

                      </tr>

                      <?php } if($row->youtube_link!='') { ?>

                      <tr>

                          <td style="text-align:left;"><label class="form-label">Youtube Link </label></td>

                          <td style="text-align:left;">: <?php echo $row->youtube_link;?></td>

                      </tr>

                      <?php } if($row->own_site_link!='') { ?>

                      <tr>

                          <td style="text-align:left;"><label class="form-label">Own Site Link </label></td>

                          <td style="text-align:left;">: <?php echo $row->own_site_link;?></td>          

                      </tr>

                      <?php } if($row->blog_link!='') { ?>

                      <tr>

                          <td style="text-align:left;"><label class="form-label">Blog Link </label></td>

                          <td style="text-align:left;">: <?php echo $row->blog_link;?></td>

                      </tr> 

                      <?php } if($row->yelp_link!='') { ?>

                      <tr>

                          <td style="text-align:left;"><label class="form-label">Yelp Link </label></td>

                          <td style="text-align:left;">: <?php echo $row->yelp_link;?></td>          

                      </tr>

                      <?php } if($row->digg_link!='') { ?>

                      <tr>

                          <td style="text-align:left;"><label class="form-label">Digg Link </label></td>

                          <td style="text-align:left;">: <?php echo $row->digg_link;?></td>

                      </tr>

                      <?php } if($row->stumblupon_link!='') { ?>

                       <tr>

                          <td style="text-align:left;"><label class="form-label">Stumblupon Link </label></td>

                          <td style="text-align:left;">: <?php echo $row->stumblupon_link;?></td>

                      </tr>

                      

                      <?php } ?>

                   -->   

                     
                      

                        

                      <tr>

                          <td style="text-align:left;"><label class="form-label">Documents </label></td>

                          <td style="text-align:left; float:left;"> <?php 

                                   

                                       $do= get_worker_document($row->worker_id);

                                    //  print_r($do);

                                    

                                     if($do)

                                     {

                                       foreach($do as $d)

                                       {

                                          

                                          $ext=explode('.',$d->worker_document);

                                        ?><a href="<?php echo front_base_url();?>upload/worker_doc/<?php echo $d->worker_document; ?>" target="_blank" ><span class="icon_table <?php echo $ext[1];?>" style="float: left;"></span></a>

                                        

                                       <?php }

                                       }

                                       else

                                       {

                                          echo "N/A";

                                       }

                                                               

                                   ?>

						</td>

                      

                      </tr>

                  </tbody>

			  	 </table>

            

   

        

       
                

        


        

               



			</div>

		</div>

	</div>

	<div class="clear"></div>

</div>