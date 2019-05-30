<div class="main">
<div class="incon">

<div class="mconleft">
                
 	<?php 
		if($msg != '') {
  			if($msg == 'delete') { $error = 'Location has been deleted Successfully.'; }
			if($msg == 'sethome') { $error = 'Your home location has been set.'; }
			if($msg == 'add'){ $error = 'Location was successfully created.';} 
			echo '<div class="errmsgcl">'.$error.'</div>';
		}
	?>          
	
           
<div id="s1postJ" class="padB10">Locations: <?php echo anchor('user/'.getUserProfileName(),$this->session->userdata('full_name'),' class="dhan" ');?></div>

 <?php echo anchor('user_other/new_location','New Location','class="fpass marT5"'); ?>


    <ul class="rlist">
    	<?php foreach($result as $row){ ?>
    	<li>
            <table width="100%" border="0" cellspacing="1" cellpadding="5">
              <tr>
                <td width="8%"><img src="<?php echo base_url().getThemeName(); ?>/images/loc_pin.png" alt="" width="22" height="32" border="0" /></td>
                <td width="67%" valign="top" ><b><?php echo $row->location_name;?></b><br/>
					<?php 
                        $address= $row->location_address;
                        $city = $row->location_city;
                        $state = $row->location_state;
                        $zipcode = $row->location_zipcode;
                        
                        if($address != '') { echo $address.', ';} 
                        if($city != '') { echo $city.', ';}
                        if($state != '') { echo $state.', ';}
                        if($zipcode != '') { echo $zipcode;}
						
						//if($row->is_home == 1) { echo '<br />Your home location.'; }
                    ?>
                    
                </td>
                <td width="25%">
          	<?php if($row->is_home !=1) { ?>  
            
            <?php
				$attributes = array('name'=>'frm_set_home_location','class'=>'fl');
				echo form_open('user_other/locations_home_set',$attributes);
	   		?>  
                    <input type="hidden" name="location_id"  id="location_id"  value="<?php echo $row->user_location_id;?>"  />
                    <input type="submit" name="sub_loc" class="chbg" value="Set as home">
                </form>
            <?php } else { //echo '<span class="chbg" style="background-color: #83C40F;margin-left: 3px;">Set as home</span>';
			} ?>                  
        
        <?php echo anchor('user_other/delete_location/'.$row->user_location_id,'Delete','class="fpass fr marT5"'); ?>
        <div class="clear"></div>
                </td>
              </tr>
   			</table>   
           
		</li>
   		<?php } ?>
        
    	<!--<li>
            <table width="100%" border="0" cellspacing="1" cellpadding="5">
              <tr>
                <td width="8%"><img src="<?php //echo base_url().getThemeName(); ?>/images/loc_pin.png" alt="" width="22" height="32" border="0" /></td>
                <td width="67%" valign="top" ><b>loc nm</b><br/>add, New York, NY 12345</td>
                <td width="25%">
              
		<form action=" <?php //echo base_url(); ?>ntask/locations"  method="post" class="fl">
            <input type="hidden" name="txt_valid"   value="112"  />
            <input type="submit" name="sub_loc" class="chbg" value="Set as home">
        </form>                  
        <?php
		/*if(isset($_REQUEST['sub_loc']))
		{
			echo $_REQUEST['txt_valid'];	
		}*/
		?>
        <?php //echo anchor('ntask/locations','Delete','class="fpass fr marT5"'); ?>
        <div class="clear"></div>
                </td>
              </tr>
   			</table>   
           
		</li>  -->      
        
        </ul>


    
           
     

		</div>


 <?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
   <div class="clear"></div>     
</div>
</div>

           
          	
