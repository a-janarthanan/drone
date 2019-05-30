<div class="main">
<div class="incon">

<div class="mconleft">    
  <?php 
		if($error != '') {
			echo '<div class="errmsgcl">'.$error.'</div>';
		}
	?>              
<div id="s1postJ" class="padB10">Create a location:</div>

	<?php
        $attributes = array('name'=>'frm_new_location','class'=>'fdesign');
        echo form_open('user_other/new_location',$attributes);
    ?>  

    <ul class="padli10">
    	<li>
         	<label class="lab1">Location name</label><br/>
            <input type="text" name="location_name" id="location_name" value="<?php echo $location_name;?>"  class="ntexttf"  /><br/>
            <span id="full_nameInfo">can't be blank</span>
		</li>
    	<li>
         	<label class="lab1">Address</label><br/>
            <input type="text" name="location_address" id="location_address"value="<?php echo $location_address;?>"  class="ntexttf"  />
		</li>        
    	<li>
         	<label class="lab1">City</label><br/>
            <input type="text" name="location_city" id="location_city" value="<?php echo $location_city;?>"  class="ntexttf"  />
		</li>
    	<li>
         	<label class="lab1">State</label><br/>
            <input type="text" name="location_state" id="location_state" value="<?php echo $location_state;?>"  class="ntext"  />
		</li>        
    	<li>
         	<label class="lab1">Postal Code</label><br/>
            <input type="text" name="location_zipcode" id="location_zipcode" value="<?php echo $location_zipcode;?>"  class="ntext"  /><br/>
            <span id="full_nameInfo">can't be blank</span>
		</li>
        <li>
        
        </li>
        	<input type="submit" id="sub_newloc" name="sub_newloc" class="submbg2" value="Create Location">
        </ul>

</form>
   
		</div>


 <?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
   <div class="clear"></div>     
</div>
</div>

           
          	
