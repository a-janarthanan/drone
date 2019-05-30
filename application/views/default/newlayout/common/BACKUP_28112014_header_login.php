<!-- used in index -->
<script type="text/javascript">
			jQuery(function($) {
/**/
	jQuery('.select_city .city').click(function (){			
		jQuery('.select_city ul').slideToggle(100);
		//jQuery('.wrap').show();
	});


 	jQuery('.select_city li a').click(function (){
		var val = $(this).text();
		$('.select_city .city').text(val);
		jQuery('.select_city ul').hide("fast");
		//jQuery('.wrap').hide();		
	});


/**/
			});
</script>



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
     
<div>
<div id="header">
<header>
 <?php if(get_authenticateUserID()=='') { ?>
<div class="signup-ph"><a href="<?php echo base_url(); ?>sign_up"><img src="<?php echo base_url().getThemeName()?>/images/signup.png" border="0"></a></div>
<div class="login-ph"><a href="<?php echo base_url(); ?>login"><img src="<?php echo base_url().getThemeName()?>/images/login.png" border="0"></a></div>
<?php } ?>
<div id="flag-ph"><img src="<?php echo base_url().getThemeName()?>/images/flag.jpg"></div>
</header>
</div>
<!--do not remove this div its use for menu close-->
<div class="wrap"></div>
<!--do not remove this div its use for menu close-->



	
    	<!--<?php if(get_authenticateUserID()=='') { ?>
				<a href="<?php echo base_url(); ?>" class="logo_cont">Bumblebeeme</a>
		<?php } else {?>
				<a href="<?php echo base_url(); ?>" class="logo_cont">Bumblebeeme</a>
		<?php } ?>-->
       
		<?php 
		
			//$logo = logo_image();
			//if($logo){
				//if($logo->template_logo != '') {
				//	if(file_exists(base_path().getThemeName().'/images/logo/'.$logo->template_logo)) {
					//	echo anchor(base_url(),"<img src='".base_url().getThemeName()."/images/logo/".$logo->template_logo."' class='clogo' width='254' height='32' alt='' />"); 
				//	} else {
					//	echo anchor(base_url(),"<img src='".base_url().getThemeName()."/images/logo.png' class='clogo' width='254' height='32' alt='' />"); 
				//	}
				//} else {
			//		echo anchor(base_url(),"<img src='".base_url().getThemeName()."/images/logo.png' class='clogo' width='254' height='32' alt='' />"); 
			//	}
			//} else {
				//echo anchor(base_url(),"<img src='".base_url().getThemeName()."/images/logo.png' class='clogo' width='254' height='32' alt='' />"); 
			//}
        
     if(get_authenticateUserID()!='') { 
	 
	 
	 
$check_suspend=check_user_suspend();

if($check_suspend!=0) {  redirect('suspend'); }

 ?> 
        
             
      <script type="application/javascript">

function update_city(city_id)
{
		
		
		if(city_id=='' || city_id==0)
		{	
			return false;
		}
			
		var strURL='<?php echo base_url().'user/update_city/';?>'+city_id;
			
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
					window.location.href='<?php echo base_url().'sign_up/'; ?>';				
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

           
        <div class="mcity">
        <?php echo anchor('pick_city',$city_name.'&nbsp;<img src="'.base_url().getThemeName().'/images/city_arrow.png" alt="" />',' id="selmycity" class="pickcity"');?>
       </div>
       
       
      <?php } ?> 
        
        <div id="menubar">
<div class="rmm">
			<div id="logo-placing"><img src="<?php echo base_url().getThemeName()?>/images/logo_new.png"></div>
            <ul>
            	<li><a href='index.php' class="active">Home</a></li>
                <li>
				<?php if(!check_user_authentication()) { ?>
				<a href="<?php echo base_url(); ?>login">Post a task</a>
				<?php } else { ?>
				<a href="<?php echo base_url(); ?>task/newhome_task">Post a task</a>
				<?php } ?>
				</li>
                <li><a href="<?php echo base_url(); ?>index.php/tags">Find a task</a></li>
                <li><a href="<?php echo base_url(); ?>how_it_works">How it works</a></li>
            </ul>
        </div>
</div>   
  
    
    <!--  <div class="navigation">
	  <ul class="navigation">

            	<li>
				<?php if(get_authenticateUserID()=='') { ?>
				<a class="active" href="<?php echo base_url(); ?>">Home</a>
				<?php } else {?>
				<a class="active" href="<?php echo base_url(); ?>index.php/dashboard">Home</a>
				<?php } ?>
				</li>

                <li><a href="<?php echo base_url(); ?>content/about_us">About us</a></li>

                <li>
				<?php if(!check_user_authentication()) { ?>
				<a href="<?php echo base_url(); ?>sign_up">Post a task</a>
				<?php } else { ?>
				<a href="<?php echo base_url(); ?>task/newhome_task">Post a task</a>
				<?php } ?>
				</li>

                <li><a href="<?php echo base_url(); ?>index.php/tags">Find a task</a></li>

                <li><a href="<?php echo base_url(); ?>how_it_works">How it works</a></li>
      <?php if(get_authenticateUserID()=='') { ?>
    
  
				 <li><?php echo anchor('sign_up','Login/Signup','class="yellow_color"');?></li>
          
          	
              


<script type="text/javascript">
			window.fbAsyncInit = function() {
	        	FB.init({appId: '<?=$data['appkey']?>', status: true, cookie: true, xfbml: true});
	 
	            /* All the events registered */
	            FB.Event.subscribe('auth.login', function(response) {
	    			// do something with response
	             //   login();
	        	});
	
	            FB.Event.subscribe('auth.logout', function(response) {
	            // do something with response
	               // logout();
	          	});
	   		};
	
	        (function() {
		        var e = document.createElement('script');
	            e.type = 'text/javascript';
	            e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
		        e.async = true;
	           // document.getElementById('fb-root').appendChild(e);
	   	 	}());
	 
	        function login(){
	        	//document.location.href = "<?php // echo $data['base_url']; ?>";
	     	}
	
	        function logout(){
	        	//document.location.href = "<?php //echo $data['base_url']; ?>";
	 		}
		</script>

			<?php	
                
              /*  $f_setting = facebook_setting();	
            
                if($f_setting->facebook_login_enable == '1'){
            ?>
            
                <li><?php echo anchor($data['fbLoginURL'],'<img src="'.base_url().getThemeName().'/images/fb_sign.png"  alt="" name="sign_fb" onmouseover="this.src=\''.base_url().getThemeName().'/images/fb_sign_hover.png\'" onmouseout="this.src=\''.base_url().getThemeName().'/images/fb_sign.png\'" />'); ?></li>
            <?php } */ ?>
            
            
            
            <?php	
                
              /*  $t_setting = twitter_setting();	
            
                if($t_setting->twitter_login_enable == '1'){
            ?>
            
             <li><?php echo anchor('home/twitter_auth','<img src="'.base_url().getThemeName().'/images/tw_sign.png"  alt="" name="sign_tw" onmouseover="this.src=\''.base_url().getThemeName().'/images/tw_sign_hover.png\'" onmouseout="this.src=\''.base_url().getThemeName().'/images/tw_sign.png\'" />'); ?></li>
            
            <?php }*/ ?>
                
            
    
    
       <?php } else { ?> 
       
  


        
        <!--<div class="hposttask">
		  <?php 
					
					//$check_is_worker=check_is_worker(get_authenticateUserID());
					
					/*if($check_is_worker) { ?>
                     <?php echo anchor('worker_task/my','Do a Task',' class="login" '); ?>  
                    <?php }*/ ?>
                    
		<?php //echo anchor('new_task','Post a Task',' id="various2" class="login" '); ?>          

		</div>-->
		<!--<li>
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
                      
                   
                    <li><?php //echo anchor('stored_card','My Credit Card');?></li>
                     <li><?php echo anchor('wallet','Transaction History');?></li>
                     
                     
                 
                  
                     <li><?php echo anchor('notifications','Notifications');?></li>
                  <li><?php echo anchor('user_other/favorites','Favourite Bees');?></li>
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
		</li>
   
    
     <?php } ?>
	 </ul>
          
          </div>
     </div>-->

    
     
    <div class="clear"></div>
 <?php   
/*    
$langs=get_supported_lang();

 get_current_language();

$lang_switch_uri= get_switch_uri();

if($langs)
{
	foreach($langs as $lang_prefix => $lang_name)
	{
		?>
        <a href="<?php echo $lang_switch_uri.$lang_prefix; ?>"><?php echo strtoupper($lang_name); ?></a>
        <?php
	}
	
}



 echo $this->lang->line('user.first_name'); */?>
