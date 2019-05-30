<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
	<div>
	<!--<div class="page-title mbot20">
		<h1 class="mleft15">Favourite Worker bees: <?php echo anchor('user/'.getUserProfileName(),$this->session->userdata('full_name'),' style="color:black" ');?></h1>
	</div>-->
    <div class="red-subtitle top-red-subtitle">Edit Location : <?php echo anchor('user/'.getUserProfileName(),$this->session->userdata('full_name'),' style="" ');?></div>
   <div class="profile_back">
<div class="container">
<div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
<div class="home-signpost-content home-signpost-content-new-section"> 
    <div class="dbleft dbleft-main">
                
 	<?php 
		if($msg != '') {
  			if($msg == 'delete') { $error = 'Location has been deleted Successfully.'; }
			if($msg == 'sethome') { $error = 'Your home location has been set.'; }
			if($msg == 'add'){ $error = 'Location was successfully created.';} 
			echo '<div id="success" style="margin-bottom:20px;"><ul><p>'.$error.'</p></ul></div>';
		}
	?>          
	
           


 <strong><?php echo anchor('user_other/new_location','Create New Location','class="marT5 btn btn-default"'); ?></strong>

	<p style="padding-bottom:30px;"></p>
    <ul class="rlist">
    	<?php foreach($result as $row){ ?>
    	<li>
            <table width="100%" border="0" cellspacing="1" cellpadding="5">
              <tr>
                <td width="5%" style="text-align:center;"><img src="<?php echo base_url().getThemeName(); ?>/images/loc_pin.png" alt="" width="22" height="32" border="0" /></td>
                <td width="67%" valign="top" style="color:#565656; font-size:14px; padding-bottom:5px;" ><b style="color:#333; font-size:16px;"><?php echo $row->location_name;?></b><br/>
					<?php 
                        $address= $row->location_address;
                        $city = $row->location_city;
                        $state = $row->location_state;
                        $zipcode = $row->location_zipcode;
                        
                        if($address != '') { echo $address;} 
                        //if($city != '') { echo $city.', ';}
                        //if($state != '') { echo $state;}
                        //if($zipcode != '') { echo $zipcode;}
						
						//if($row->is_home == 1) { echo '<br />Your home location.'; }
                    ?>
                    
                </td>
                <td width="25%">
          	
        
        <?php echo anchor('user_other/delete_location/'.$row->user_location_id,'Delete','class="fr marT5 btn btn-default btn-default-132"'); ?>
        <?php if($row->is_home !=1) { ?>  
            
            <?php
				$attributes = array('name'=>'frm_set_home_location','class'=>'fr');
				echo form_open('user_other/locations_home_set',$attributes);
	   		?>  
                    <input type="hidden" name="location_id"  id="location_id"  value="<?php echo $row->user_location_id;?>"  />
                    <input type="submit" name="sub_loc" class="btn btn-default" value="Set as home">
                </form>
            <?php } else { //echo '<span class="chbg" style="background-color: #83C40F;margin-left: 3px;">Set as home</span>';
			} ?>                  
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
</div>
	<div class="dbright-task dbright-task-main">
 <?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
 </div>
 </div></div>
   <div class="clear"></div>     
</div>
</div>

           
          	
