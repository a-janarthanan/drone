<?php if(!check_user_authentication()) {  redirect('sign_up'); } ?>
<!--do not remove this div its use for menu close-->
<div class="wrap"></div>
<!--do not remove this div its use for menu close-->
<div class="main">
	<div style="height:93px;">
	
    
    <div class="headbgleft">
    	
           <?php 
		   $logo = logo_image();
			if($logo){
				if($logo->template_logo != '') {
					if(file_exists(base_path().getThemeName().'/images/logo/'.$logo->template_logo)) {
						echo anchor(base_url(),"<img src='".base_url().getThemeName()."/images/logo/".$logo->template_logo."' class='clogo' width='254' height='32' alt='' />"); 
					} else {
						echo anchor(base_url(),"<img src='".base_url().getThemeName()."/images/logo.png' class='clogo' width='254' height='32' alt='' />"); 
					}
				} else {
					echo anchor(base_url(),"<img src='".base_url().getThemeName()."/images/logo.png' class='clogo' width='254' height='32' alt='' />"); 
				}
			} else {
				echo anchor(base_url(),"<img src='".base_url().getThemeName()."/images/logo.png' class='clogo' width='254' height='32' alt='' />"); 
			}
		   ?>
     
      <script type="application/javascript">

function update_city(city_id)
{
		
		
		if(city_id=='' || city_id==0)
		{	
			return false;
		}
			
		var strURL='<?php echo site_url('user/update_city/');?>/'+city_id;
			
		var xmlhttp;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  
		  }
		xmlhttp.onreadystatechange=function()
		  {
			 
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{	
			//alert(xmlhttp.responseText);
				if(xmlhttp.responseText=='login_failed')
				{
					window.location.href='<?php echo site_url('sign_up/'); ?>';				
				}
				else
				{
					//document.getElementById("favorite").innerHTML=xmlhttp.responseText;
					window.parent.document.location.reload();
				}		
			}
		  }
		xmlhttp.open("GET",strURL,true);
		xmlhttp.send();

}

</script>     

<?php

$city_name='Pick a City';

$current_city_id=getCurrentCity();
if($current_city_id>0)
{
$current_city_name=getCityName($current_city_id);

if(isset($current_city_name)) {  $city_name=$current_city_name; }
}

?>

<?php 
	
	$data = array(
		'facebook'		=> $this->fb_connect->fb,
		'fbSession'		=> $this->fb_connect->fbSession,
		'user'			=> $this->fb_connect->user,
		'uid'			=> $this->fb_connect->user_id,
		'fbLogoutURL'	=> $this->fb_connect->fbLogoutURL,
		'fbLoginURL'	=> $this->fb_connect->fbLoginURL,	
		'base_url'		=> site_url('home/facebook'),
		'appkey'		=> $this->fb_connect->appkey,
	);
	
	
?>	
           
        <div class="mcity">
        <?php echo anchor('pick_city',$city_name.'&nbsp;<img src="'.base_url().getThemeName().'/images/city_arrow.png" alt="" />',' id="selmycity" class="pickcity"');?>
       </div>
        
        <div class="hsearch">
                
                    
                      <?php
			$attributes = array('name'=>'frm_search_task_worker');
			echo form_open('search',$attributes);
	   ?>
           <div class="fl ie7sp3 marR5"><input type="text" name="search" id="search" class="searchbg" placeholder="Enter your text search" value="" /></div>
<div class="fl">
<input type="submit" class="submbg" value="Search" >
</div>



        </form>
        
        
        </div>
        
    </div>
   <div class="headbgright">


        
        <div class="hposttask">
         <?php 
					
					$check_is_worker=check_is_worker(get_authenticateUserID());
					
					/*if($check_is_worker) { ?>
                     <?php echo anchor('worker_task/my','Do a Task',' class="login" '); ?>  
                    <?php } */?>
                    
                    
     
		
			<?php echo anchor('new_task','Post a Task',' id="various2" class="login" '); ?>            

		</div>

		<div class="my_acc">
        	<a href="#" class="acc_link"><img src="<?php echo base_url().getThemeName();?>/images/user_img.png" alt="" /></a>
            <div class="acc_div">
                <ul>
                   <li><?php echo $this->session->userdata('full_name'); ?></li>
                    <li><?php echo anchor('dashboard','Dashboard');?></li>
                    <li><?php echo anchor('user/'.getUserProfileName(),'My Profile');?></li>
                    <li><?php echo anchor('account','My Account'); ?></li>
                    
                     <li><?php echo anchor('user_task/mytasks','My Posted Tasks');?></li>
                     
                      <?php 
					
					$check_is_worker=check_is_worker(get_authenticateUserID());
					
					if($check_is_worker) { ?>
                     <li><?php echo anchor('worker_task/my','My Running Tasks');?></li>
                    <?php } ?>
                    
                    
                      <li><?php echo anchor('message/allmessage','My Alerts');?></li>
                      
                 
                    <li><?php echo anchor('stored_card','My Credit Card');?></li>
                     <li><?php echo anchor('wallet','Transaction History');?></li>
                       
                    
                   
                   
                      <li><?php echo anchor('notifications','Notifications');?></li>
                   <li><?php echo anchor('user_other/favorites','Favourite Worker bees');?></li>
                    <li><?php 
						if($this->session->userdata('facebook_id') != 0 && $this->session->userdata('facebook_id') != '' )
						{
							echo anchor($data['fbLogoutURL'],'Logout');
						} else {
							echo anchor('home/logout','Logout'); 
						}
					?></li>
                </ul>
            </div>            
        </div>   
      
    </div>
    
    

</div>     
     
    <div class="clear"></div>
</div>

