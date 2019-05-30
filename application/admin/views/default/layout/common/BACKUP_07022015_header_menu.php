<?php
	if($this->session->userdata('admin_id')=="")
	{
		echo "<script>window.location.href='".site_url('home')."'</script>";
	}
	 /*For Selected active class in menu*/
	 $this->active = $this->uri->uri_string();
	 $this->strdd = explode("/",$this->active);

	$site_setting=site_setting();
?>

<!-- Panel -->
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
			
            <script type="application/javascript">
			
			function getskillworkerlist(val)
			{
				
				if(val=='' || val==0)
				{	
					return false;
				}
					
				var strURL='<?php echo site_url('skill_worker/get_ajax_sort_list/');?>/'+val;
					
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
							window.location.href='<?php echo site_url('home/login/'); ?>';				
						}
						else
						{
							document.getElementById("category_panel").innerHTML=xmlhttp.responseText;
							
						}		
					}
				  }
				xmlhttp.open("GET",strURL,true);
				xmlhttp.send();
			
			}
			
			
			</script>
            
          <div style="float:left; color:#FFFFFF; font-size:14px; font-weight:bold;"> Sort By : </div>
          
              <select name="panel_city" id="panel_city" style="display:block; float:left; font-size:13px;" onchange="getskillworkerlist(this.value)">
              <option value="all">All</option>
                    <?php  
					   	  $cities = city_list();
						  if($cities) {
						  foreach($cities as $city){   
					?>
                         <option value="<?php echo $city->city_id;?>" ><?php echo $city->city_name;?></option>
                    <?php } }?>
                       </select>
                       
                       
                       
                       
            <div id="category_panel">
            	<ul>
                
                <?php 

				$all_categories=get_parent_category();
				
				if($all_categories)
				{
				   
				   $cnt_cat=0;
                	
					foreach($all_categories as $all_cats)
					{
					
					
						$category_image=front_base_url().'upload/category/no_image.png';

		
						if($all_cats->category_image!='') 
						{  
						
							if(file_exists(base_path().'upload/category/'.$all_cats->category_image)) 
							{ 
								
								$category_image=front_base_url().'upload/category/'.$all_cats->category_image;
							
							}
							
						}
					
					?>
					
              		 <li>
			
              <img src="<?php echo $category_image; ?>" width="50" height="50"  />
				<h1><?php 
				
				echo anchor('skill_worker/lists/'.$all_cats->task_category_id,ucfirst($all_cats->category_name),' style="color:#FFFFFF;"');
				
				$parent_count=get_skill_worker($all_cats->task_category_id);
				
				 ?>(<?php echo $parent_count; ?>)</h1>
				
                
                <?php $sub=sub_category($all_cats->task_category_id);
				
						if($sub)
						{
							foreach($sub as $sub_cats)
							{
							
							$child_count=get_skill_worker($sub_cats->task_category_id);
					?>
                    
                <h2><?php echo anchor('skill_worker/lists/'.$sub_cats->task_category_id,ucfirst($sub_cats->category_name)); ?>(<?php echo $child_count; ?>)</h2>
               
               <?php }  } ?>
               <div style="clear:both;"></div>
                
                </li>
                
                
            		
            <?php  $cnt_cat++;    if($cnt_cat>4) { $cnt_cat=0; echo "</ul><ul>"; }
					
				 }
			
			 } ?>
            
          
			
            
            
            
             
                
                </ul>		
            
            
			</div>
            
            
            
            
            
		</div>
</div> <!-- /login -->	

	<!-- The tab on top -->	
	<div class="slide_tab">
		<ul class="login">
			<li class="left">&nbsp;</li>
			<li id="toggle">
				<a id="open" class="open" href="#">&nbsp;</a>
				<a id="close" style="display: none; border:none;" class="close" href="#">&nbsp;</a>			
			</li>
			<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->
	
</div> <!--panel -->



<ul id="topbar" style="margin-top:5px; padding: 6px 11px;">
     
      <li>IP: <b><?php echo $_SERVER['REMOTE_ADDR']; ?></b></li>
     <li class="s_1"></li>
      <li>Server Date: <b><?php echo date('d M, Y h:i:s A');?></b></li>
      
      
       <li class="s_1"></li>
      <li>Last Login: <b><?php echo get_last_admin_login_detail();?></b></li>
      
       <li class="s_1"></li>
     
      
      
       <li class="fr"><?php echo anchor('home/logout','<span class="icon_text logout"></span>logout',' title="logout" class="button red fl"');?></li>
        <li class="s_1 fr"></li>
        
        
        <li class="fr"><a href="<?php echo front_base_url(); ?>" title="fronts side" target="_blank" class="button white fl"><span class="icon_text admin"></span>Front</a></li>
        <li class="s_1 fr"></li>
		<li class="fr"><?php echo anchor(base_url(),'<span class="icon_text admin"></span>'.$this->session->userdata('username'),' title="admin" class="button white fl"');?></li>
		<li class="clear"></li>
        
        
      </ul>
      
      
      
     <ul id="topbar" style="padding: 6px 18px;">
     
      <li>Total Task: <b><?php echo get_total_task();?></b></li>
     <li class="s_1"></li>
      <li>Total User: <b><?php echo get_total_user();?></b></li>
      
      
      <li class="s_1"></li>
      <li>Total Runner: <b><?php echo get_total_worker();?></b></li>
      
      
      <li class="s_1"></li>
      <li>Online User: <b><?php echo get_current_login_user();?></b></li>
      
      
      <li class="s_1"></li>
      <li>Daily Login User: <b><?php echo get_daily_login_user();?></b></li>
      
      
      <li class="s_1"></li>
      <li>Total City: <b><?php echo get_total_city(); ?></b></li>
      
      <li class="s_1"></li>
      <li>Total State: <b><?php echo get_total_state(); ?></b></li>
      
      <li class="s_1"></li>
      <li>Total Country: <b><?php echo get_total_country(); ?></b></li>
     
     <?php
	 
	$earning_post_task= get_total_earning_post_task();
	$earning_runner_pay= get_total_earning_runner_pay();
	 $total_earn=number_format($earning_post_task + $earning_runner_pay,2);
	
	$total_escrow=get_total_escrow_pay();
	$total_runner_pay=get_total_runner_pay();
	
	 ?>
     
     <li class="s_1"></li>
        <li class="fr"><!--Total -->Pay: <b><?php echo $site_setting->currency_symbol.$total_runner_pay; ?></b></li>
        <li class="s_1 fr"></li>
        
        <li class="fr"><!--Total -->Escrow: <b><?php echo $site_setting->currency_symbol.$total_escrow; ?></b></li>
      
        <li class="s_1 fr"></li>
          <li class="fr"><!--Total -->Earning: <b><?php echo $site_setting->currency_symbol.$total_earn;?></b></li>
         
          
     
     
       <?php /*?> <li><?php echo anchor(base_url(),'<span class="icon_single preview"></span>',' title="Ask For Task" class="button white fl"');?></li>
		<li class="s_1"></li>
        <li class="logo"><strong><?php echo page_title();?></strong> ADMIN SKIN</li>
		<li class="s_1"></li>
        <li>
			<?php if ($this->active == 'home/dashboard'){?><span class="breadcrumb">Dashboard</span><?php }?>
            <?php if ($this->strdd[0] == 'admin'){?><span class="breadcrumb">Admins</span><?php }?>
            <?php if ($this->strdd[0] == 'user'){?><span class="breadcrumb">Posters</span><?php }?>
            <?php if ($this->strdd[0] == 'worker'){?><span class="breadcrumb">Runners</span><?php }?>
            <?php if ($this->strdd[0] == 'task_category'){?><span class="breadcrumb">Task Category</span><?php }?>
            <?php if ($this->strdd[0] == 'task'){?><span class="breadcrumb">Tasks</span><?php }?>
            <?php if ($this->strdd[0] == 'dispute'){?><span class="breadcrumb">Dispute Tasks</span><?php }?>
            <?php if ($this->strdd[0] == 'wallet'){?><span class="breadcrumb">Payments</span><?php }?>
            <?php if ($this->strdd[0] == 'report'){?><span class="breadcrumb">Task Report</span><?php }?>
            <?php if ($this->strdd[0] == 'pages'){?><span class="breadcrumb">Pages</span><?php }?>
            <?php if ($this->strdd[0] == 'country'){?><span class="breadcrumb">Country</span><?php }?>
            <?php if ($this->strdd[0] == 'state'){?><span class="breadcrumb">State</span><?php }?>
            <?php if ($this->strdd[0] == 'city'){?><span class="breadcrumb">City</span><?php }?>
            <?php if ($this->strdd[0] == 'newsletter'){?><span class="breadcrumb">Newsletter</span><?php }?>
            <?php if ($this->strdd[0] == 'spam_setting'){?><span class="breadcrumb">Spam Setting</span><?php }?>
            
            
			<?php if ($this->active == 'site_setting/add_site_setting'){?><span class="breadcrumb">Site Setting</span><?php }?>
			<?php if ($this->active == 'meta_setting/add_meta_setting'){?><span class="breadcrumb">Meta Setting</span><?php }?>
			<?php if ($this->active == 'facebook_setting/add_facebook_setting'){?><span class="breadcrumb">Facebook Setting</span><?php }?>
			<?php if ($this->active == 'twitter_setting/add_twitter_setting'){?><span class="breadcrumb">Twitter Setting</span><?php }?>
			<?php if ($this->active == 'site_setting/add_image_setting'){?><span class="breadcrumb">Image Size Setting</span><?php }?>
			<?php if ($this->active == 'email_setting/add_email_setting'){?><span class="breadcrumb">Email Setting</span><?php }?>
            <?php if ($this->active == 'task_setting/add_task_setting'){?><span class="breadcrumb">Task Setting</span><?php }?>
            <?php if ($this->active == 'user_setting/add_user_setting'){?><span class="breadcrumb">User Setting</span><?php }?>
            <?php if ($this->active == 'email_template/list_email_template'){?><span class="breadcrumb">Email Templates</span><?php }?>
            <?php if ($this->active == 'task_setting/add_dispute_setting'){?><span class="breadcrumb">Dispute Setting</span><?php }?>
            
			
			
		</li><?php */?>
        
        
      
		
        
        
		<li class="clear"></li>
      </ul>
	
    <?php 
	$chk_admin_list=get_rights('list_admin');
	$chk_admin_login=get_rights('admin_login');
	
	?>
    
      <ul id="navbar">
        <li <?php  if($this->strdd[0] == 'home' || $this->strdd[0] == 'graph' || $this->strdd[0] == 'cronjob' ){ echo 'class="active"'; }?> > <?php echo anchor('home/dashboard','<span class="icon_text dashboard"></span>Dashboard',' title="Dashboard"');?> </li>
        
         <?php  if($this->strdd[0] == 'home' || $this->strdd[0] == 'graph' || $this->strdd[0] == 'cronjob' ){ ?>
        <ul>
           <li><?php echo anchor('graph/','Graphical Transaction Report',' title="Graphical Transaction Report" class="subbutton white"');?></li>
           
              <li><?php echo anchor('graph/user','Graphical Registration Report',' title="Graphical Registration Report" class="subbutton white"');?></li>
              
              
                <li><?php echo anchor('graph/task','Graphical Task Report',' title="Graphical Task Report" class="subbutton white"');?></li>
                
              
               <li><?php //echo anchor('cronjob/list_cronjob','Cron Job Report',' title="Cron Job Report" class="subbutton white"');?></li>
        
      
              
          </ul>
          
            <?php } ?>
        
        <?php if(($this->strdd[0] == 'admin' || $this->strdd[0] == 'rights') && ($chk_admin_list==1 || $chk_admin_login==1)) { ?>
       
       	 <li  class="active"><?php  
		 		 
		 if($chk_admin_list==1) { echo anchor('admin/list_admin','<span class="icon_text settings"></span>Admin',' title="Administrator Management"');  }  
		 
		 elseif($chk_admin_login==1) { echo anchor('admin/admin_login','<span class="icon_text settings"></span>Admin',' title="Login List"'); } 
		 
		 ?></li>
         
         <ul>
          	
            <?php if($chk_admin_list==1) { ?>
            
            <li <?php if($this->strdd[1] == 'list_admin') { echo 'class="active"'; }?>><?php echo anchor('admin/list_admin','Administrator',' title="Admin List" class="subbutton white"');?></li>
            
            <?php } if($chk_admin_login==1) {  ?>
            
            <li <?php if($this->strdd[1] == 'admin_login' && $chk_admin_login==1) { echo 'class="active"'; }?>><?php echo anchor('admin/admin_login','Login',' title="Login List" class="subbutton white"');?></li>
            
            <?php } ?>
            
          </ul>
          
		<?php } else { 
		
		if($chk_admin_list==1 ||$chk_admin_login==1) { ?>
        <li><?php
        
		 if($chk_admin_list==1) { echo anchor('admin/list_admin','<span class="icon_text settings"></span>Admin',' title="Administrator Management"');  }  
		 
		 elseif($chk_admin_login==1) { echo anchor('admin/admin_login','<span class="icon_text settings"></span>Admin',' title="Login List"'); } 
		
		?></li>
        <?php } } ?>
          
        
        <?php if($this->strdd[0] == 'user' || $this->strdd[0] == 'review') { ?>
         <li class="active"><?php echo anchor('user/list_user','<span class="icon_text users"></span>Posters',' title="Posters"');?></li>
             <ul>  
              
                <li <?php if($this->strdd[1] == 'list_user' || $this->strdd[1] == 'search_list_user') { echo 'class="active"'; }?>><?php echo anchor('user/list_user','All Posters',' title="Posters List" class="subbutton white"');?></li>
                <li <?php if($this->strdd[1] == 'list_active_user') { echo 'class="active"'; }?>><?php echo anchor('user/list_active_user','Active Posters',' title=" Active Posters List" class="subbutton white"');?></li>
                <li <?php if($this->strdd[1] == 'list_suspend_user') { echo 'class="active"'; }?>><?php echo anchor('user/list_suspend_user','Suspend Posters',' title=" Suspend Posters List" class="subbutton white"');?></li>
                <li <?php if($this->strdd[1] == 'list_deleted_user') { echo 'class="active"'; }?>><?php echo anchor('user/list_deleted_user','Deleted Posters',' title=" Deleted Posters List" class="subbutton white"');?></li>
                <li <?php if($this->strdd[1] == 'user_login') { echo 'class="active"'; }?>><?php echo anchor('user/user_login','Posters Login',' title=" Posters Login List" class="subbutton white"');?></li>
                
                <li <?php if($this->strdd[1] == 'list_review') { echo 'class="active"'; }?>><?php echo anchor('review/list_review','Review',' title="Review" class="subbutton white"');?></li>
     
             </ul>
         <?php } else { ?>
         <li><?php echo anchor('user/list_user','<span class="icon_text users"></span>Posters',' title="Posters"');?></li>
         <?php } ?>
         
         <?php if($this->strdd[0] == 'worker') { ?>
             <li class="active"><?php echo anchor('worker/list_worker','<span class="icon_text content"></span>Runners',' title="Runners"');?></li>
             <ul>
				<li <?php if($this->strdd[1] == 'list_worker' || $this->strdd[1] == 'search_list_worker') { echo 'class="active"'; }?>><?php echo anchor('worker/list_worker','All Runners',' title="Runners List" class="subbutton white"');?></li> 
				<li <?php if($this->strdd[1] == 'list_active_worker') { echo 'class="active"'; }?>><?php echo anchor('worker/list_active_worker','Active Runners',' title="Active Runners List" class="subbutton white"');?></li>
				
				<li <?php if($this->strdd[1] == 'list_waiting_worker') { echo 'class="active"'; }?>><?php echo anchor('worker/list_waiting_worker','Waiting Runners',' title="Waiting Runners List" class="subbutton white"');?></li>
				
				<li <?php if($this->strdd[1] == 'list_reject_worker') { echo 'class="active"'; }?>><?php echo anchor('worker/list_reject_worker','Reject Runners',' title="Reject Runners List" class="subbutton white"');?></li>
                <li <?php if($this->strdd[1] == 'list_deleted_worker') { echo 'class="active"'; }?>><?php echo anchor('worker/list_deleted_worker','Delete Runners',' title="Delete Runners List" class="subbutton white"');?></li>
             </ul>
         <?php } else { ?>
         <li><?php echo anchor('worker/list_worker','<span class="icon_text content"></span>Runners',' title="Runners"');?></li>
         <?php } ?>
         
         <?php if($this->strdd[0] == 'task_category') { ?>
             <li class="active"><?php echo anchor('task_category/list_task_category','<span class="icon_text content"></span>Category',' title="Category"');?></li>
             <!--<ul>
             	<li <?php if($this->strdd[1] == 'list_task_category' || $this->strdd[1] == 'add_task_category' || $this->strdd[1] == 'edit_task_category') { echo 'class="active"'; }?>><?php echo anchor('task_category/list_task_category','Category',' title="Category List" class="subbutton white"');?></li>
                
                
             </ul>-->
         <?php } else { ?>
         <li><?php echo anchor('task_category/list_task_category','<span class="icon_text content"></span>Category',' title="Category"');?></li>
         <?php } ?>
         
         <?php if($this->strdd[0] == 'task') { ?>
             <li class="active"><?php echo anchor('task/list_task','<span class="icon_text content"></span>Tasks',' title="Tasks"');?></li>
             <ul>
             	<li <?php if($this->strdd[1] == 'list_task' || $this->strdd[1] == 'search_list_task') { echo 'class="active"'; }?>><?php echo anchor('task/list_task','All Tasks',' title="All Tasks List" class="subbutton white"');?></li>
                
                 <li <?php if($this->strdd[1] == 'post_task') { echo 'class="active"'; }?>><?php echo anchor('task/post_task','Posted Tasks',' title="Posted Tasks List" class="subbutton white"');?></li> 
                 
                <li <?php if($this->strdd[1] == 'running_task') { echo 'class="active"'; }?>><?php echo anchor('task/running_task','Assigned Tasks',' title="Assigned Tasks List" class="subbutton white"');?></li> 
                
                 <li <?php if($this->strdd[1] == 'completed_task') { echo 'class="active"'; }?>><?php echo anchor('task/completed_task','Completed Tasks',' title="Completed Tasks List" class="subbutton white"');?></li>
                 
                <li <?php if($this->strdd[1] == 'close_task') { echo 'class="active"'; }?>><?php echo anchor('task/close_task','Closed Tasks',' title="Closed Tasks List" class="subbutton white"');?></li>
				
				 <li <?php if($this->strdd[1] == 'suspend_task') { echo 'class="active"'; }?>><?php echo anchor('task/suspend_task','Suspended Tasks',' title="Suspended Tasks List" class="subbutton white"');?></li>
             </ul>
         <?php } else { ?>
         <li><?php echo anchor('task/list_task','<span class="icon_text content"></span>Tasks',' title="Tasks"');?></li>
         <?php } ?>
         
          <?php if($this->strdd[0] == 'dispute') { ?>
             <li class="active"><?php echo anchor('dispute/list_dispute','<span class="icon_text content"></span>Dispute',' title="Dispute"');?></li>
            <!-- <ul>
             	<li <?php if($this->strdd[1] == 'list_dispute') { echo 'class="active"'; }?>><?php echo anchor('dispute/list_dispute','Dispute',' title="Dispute" class="subbutton white"');?></li>
                
                
             </ul>-->
         <?php } else { ?>
         <li><?php echo anchor('dispute/list_dispute','<span class="icon_text content"></span>Dispute',' title="Dispute"');?></li>
         <?php } ?>
         
              <?php if($this->strdd[0] == 'transaction_type' || $this->strdd[0] == 'payments_gateways' || $this->strdd[0]=='wallet' || $this->strdd[0]=='wallet_setting'||$this->strdd[0] =='gateways_details' || $this->strdd[0] == 'transaction' || $this->strdd[0] == 'wallet_report') { ?>
             
             <li class="active"><?php echo anchor('wallet/list_wallet_review','<span class="icon_text media"></span>Payment',' title="Payment Module"');?></li>
             
             <ul>
              <li <?php if($this->strdd[1] == 'add_wallet_setting') { echo 'class="active"'; }?>><?php echo anchor('wallet_setting/add_wallet_setting','Wallet Settings  ',' title="Wallet Settings" class="subbutton white"');?></li>
				<!--<li <?php if($this->strdd[1] == 'list_paypal') { echo 'class="active"'; }?>><?php echo anchor('transaction_type/list_paypal','Paypal Setting',' title="Paypal Setting" class="subbutton white"');?></li> -->
                <li <?php if($this->strdd[1] == 'list_payment_gateway' || $this->strdd[1]=='list_gateway_detail') { echo 'class="active"'; }?>><?php echo anchor('payments_gateways/list_payment_gateway','Payment Gateway',' title="Payment Gateway" class="subbutton white"');?></li>
                 <li <?php if($this->strdd[1] == 'list_wallet_review') { echo 'class="active"'; }?>><?php echo anchor('wallet/list_wallet_review','Wallet Review ',' title="Wallet Review" class="subbutton white"');?></li>
                 
                 <li <?php if($this->strdd[1] == 'list_wallet_withdraw') { echo 'class="active"'; }?>><?php echo anchor('wallet/list_wallet_withdraw','Wallet Withdraw ',' title="Wallet Withdraw" class="subbutton white"');?></li>
                 
                  <li <?php if($this->strdd[1] == 'list_escrow') { echo 'class="active"'; }?>><?php echo anchor('transaction/list_escrow','Escrow',' title="Escrow" class="subbutton white"');?></li>
                 
                 
                 
                 <li <?php if($this->strdd[1] == 'list_paying') { echo 'class="active"'; }?>><?php echo anchor('transaction/list_paying','Paying',' title="Paying" class="subbutton white"');?></li>
                
                 <li <?php if($this->strdd[1] == 'list_earning') { echo 'class="active"'; }?>><?php echo anchor('transaction/list_earning','Earning',' title="Earning" class="subbutton white"');?></li>
                 
                 <li <?php if($this->strdd[1] == 'list_refund') { echo 'class="active"'; }?>><?php echo anchor('transaction/list_refund','Refund',' title="Refund" class="subbutton white"');?></li>
      
             </ul>
         <?php } else { ?>
         <li><?php echo anchor('wallet/list_wallet_review','<span class="icon_text media"></span>Payment',' title="Payment Module"');?></li>
         <?php } ?>
         
         <?php if($this->strdd[0] == 'report') { ?>
             <li class="active"><?php echo anchor('report/list_search_report','<span class="icon_text content"></span>Report',' title="Report"');?></li>
            <!-- <ul>
             	<li <?php if($this->strdd[1] == 'list_search_report') { echo 'class="active"'; }?>><?php echo anchor('report/list_search_report','Report',' title="Report" class="subbutton white"');?></li>
                
                
             </ul>-->
         <?php } else { ?>
         <li><?php echo anchor('report/list_search_report','<span class="icon_text content"></span>Report',' title="Report"');?></li>
         <?php } ?>
         
         <?php if($this->strdd[0] == 'pages') { ?>
             <li class="active"><?php echo anchor('pages/list_pages','<span class="icon_text content"></span>Pages',' title="Pages"');?></li>
            <!-- <ul>
             	<li <?php if($this->strdd[1] == 'list_pages' || $this->strdd[1] == 'search_list_pages' || $this->strdd[1] == 'add_pages' || $this->strdd[1] == 'edit_pages') { echo 'class="active"'; }?>><?php echo anchor('pages/list_pages','Pages',' title="Pages List" class="subbutton white"');?></li>
                
                
             </ul>-->
         <?php } else { ?>
         <li><?php echo anchor('pages/list_pages','<span class="icon_text content"></span>Pages',' title="Pages"');?></li>
         <?php } ?>
        
         <?php if($this->strdd[0] == 'country' || $this->strdd[0] == 'state' || $this->strdd[0] == 'city') { ?>
             <li class="active"><?php echo anchor('country/list_country','<span class="icon_text content"></span>Globalisation ',' title="Globalisation"');?></li>
             <ul>
             	<li <?php if($this->strdd[1] == 'list_country' || $this->strdd[1] == 'search_list_country' || $this->strdd[1] == 'add_country' || $this->strdd[1] == 'edit_country') { echo 'class="active"'; }?>><?php echo anchor('country/list_country','Countries',' title="Countries List" class="subbutton white"');?></li>
                
                	<li <?php if($this->strdd[1] == 'list_state' || $this->strdd[1] == 'search_list_state' || $this->strdd[1] == 'add_state' || $this->strdd[1] == 'edit_state') { echo 'class="active"'; }?>><?php echo anchor('state/list_state','States',' title="States List" class="subbutton white"');?></li>
                    
                    <li <?php if($this->strdd[1] == 'list_city' || $this->strdd[1] == 'search_list_city' || $this->strdd[1] == 'add_city' || $this->strdd[1] == 'edit_city') { echo 'class="active"'; }?>><?php echo anchor('city/list_city','Cities',' title="Cities List" class="subbutton white"');?></li>
             </ul>
             
             
             
         <?php } else { ?>
         <li><?php echo anchor('country/list_country','<span class="icon_text content"></span>Globalisation',' title="Globalisation"');?></li>
         <?php } ?>
         
         <?php if($this->strdd[0] == 'newsletter') { ?>
             <li class="active"><?php echo anchor('newsletter/list_newsletter','<span class="icon_text content"></span>Newsletter',' title="Newsletter"');?></li>
             <ul>
             	<li <?php if($this->strdd[1] == 'list_newsletter' || $this->strdd[1] == 'search_newsletter' || $this->strdd[1] == 'add_newsletter' || $this->strdd[1] == 'show_all_subscriber' || $this->strdd[1] == 'search_subscriber_user' ) { echo 'class="active"'; }?>><?php echo anchor('newsletter/list_newsletter','All Newsletter',' title="All Newsletter List" class="subbutton white"');?></li>
                
                	<li <?php if($this->strdd[1] == 'list_newsletter_user' || $this->strdd[1] == 'search_newsletter_user' || $this->strdd[1] =='add_newsletter_user' ||  $this->strdd[1] =='edit_newsletter_user' || $this->strdd[1] =='import_newsletter_user') { echo 'class="active"'; }?>><?php echo anchor('newsletter/list_newsletter_user','Newsletter User',' title="All Newsletter List" class="subbutton white"');?></li>
                    
                    
                    <li <?php if($this->strdd[1] == 'newsletter_job' || $this->strdd[1] == 'search_newsletter_job' || $this->strdd[1] =='add_newsletter_job') { echo 'class="active"'; }?>><?php echo anchor('newsletter/newsletter_job','Newsletter Job',' title="Newsletter Job" class="subbutton white"');?></li>
                  <li <?php if($this->strdd[1] == 'newsletter_setting') { echo 'class="active"'; }?>><?php echo anchor('newsletter/newsletter_setting','Settings',' title="Settings" class="subbutton white"');?></li>
				
             </ul>
         <?php } else { ?>
         <li><?php echo anchor('newsletter/list_newsletter','<span class="icon_text content"></span>Newsletter',' title="Newsletter"');?></li>
         <?php } ?>

         <?php if($this->strdd[0] == 'spam_setting') { ?>
         <li class="active"> <?php echo anchor('spam_setting/add_spam_setting','<span class="icon_text settings"></span>Spam Setting',' title="Spam Setting"');?></li>
         
			<ul>
				<li <?php if($this->strdd[1] == 'add_spam_setting') { echo 'class="active"'; }?>><?php echo anchor('spam_setting/add_spam_setting','Spam Setting',' title="Spam Setting" class="subbutton white"');?></li>    
				
				<li <?php if($this->strdd[1] == 'spam_report' || $this->strdd[1] == 'search_list_spam_report' ) { echo 'class="active"'; }?>><?php echo anchor('spam_setting/spam_report','Spam Report',' title="Spam Report" class="subbutton white"');?></li>  
				
				<li <?php if($this->strdd[1] == 'spamer' || $this->strdd[1] == 'add_spammer' || $this->strdd[1] == 'search_list_spam' ) { echo 'class="active"'; }?>><?php echo anchor('spam_setting/spamer','Spamer',' title="Spamer" class="subbutton white"');?></li>    
				
            </ul>
         <?php } else{ ?>
          <li><?php echo anchor('spam_setting/add_spam_setting','<span class="icon_text settings"></span>Spam Setting',' title="Spam Setting"');?></li>
         <?php } ?>

         <?php if($this->strdd[0] == 'site_setting' || $this->strdd[0] == 'meta_setting' || $this->strdd[0] == 'facebook_setting' || $this->strdd[0] == 'twitter_setting' || $this->strdd[0] == 'email_setting' || $this->strdd[0] == 'task_setting' || $this->strdd[0] == 'user_setting' || $this->strdd[0] == 'email_template' || $this->strdd[0] == 'template_setting') { ?>
        <li class="active"><?php echo anchor('site_setting/add_site_setting','<span class="icon_text settings"></span>settings',' title="Settings"');?></li>
		
			<ul>
				<li <?php if($this->strdd[1] == 'add_site_setting') { echo 'class="active"'; }?>><?php echo anchor('site_setting/add_site_setting','Site',' title="Site Setting" class="subbutton white"');?></li>
				
				<li <?php if($this->strdd[0] == 'meta_setting') { echo 'class="active"'; }?>><?php echo anchor('meta_setting/add_meta_setting','Meta',' title="Meta Setting" class="subbutton white"');?></li>
				
				<li <?php if($this->strdd[0] == 'facebook_setting') { echo 'class="active"'; }?>><?php echo anchor('facebook_setting/add_facebook_setting','Facebook',' title="Facebook Setting" class="subbutton white"');?></li>
				
				<li <?php if($this->strdd[0] == 'twitter_setting') { echo 'class="active"'; }?>><?php echo anchor('twitter_setting/add_twitter_setting','Twitter',' title="Twitter Setting" class="subbutton white"');?></li>
				
				<li <?php if($this->strdd[0] == 'email_setting') { echo 'class="active"'; }?>><?php echo anchor('email_setting/add_email_setting','Email',' title="Email Setting" class="subbutton white"');?></li>
				
				<li <?php if($this->strdd[1] == 'add_image_setting') { echo 'class="active"'; }?>><?php echo anchor('site_setting/add_image_setting','Image Size',' title="Image Size Setting" class="subbutton white"');?></li>
				
				<li <?php if($this->strdd[1] == 'add_task_setting') { echo 'class="active"'; }?>><?php echo anchor('task_setting/add_task_setting','Task',' title="Task Setting" class="subbutton white"');?></li>
				
				<li <?php if($this->strdd[1] == 'add_user_setting') { echo 'class="active"'; }?>><?php echo anchor('user_setting/add_user_setting','User',' title="User Setting" class="subbutton white"');?></li>
                
                <li <?php if($this->strdd[0] == 'email_template') { echo 'class="active"'; }?>><?php echo anchor('email_template/list_email_template','Email Templates',' title="Email Templates Setting" class="subbutton white"');?></li>
                
                 <li <?php if($this->strdd[1] == 'add_dispute_setting') { echo 'class="active"'; }?>><?php echo anchor('task_setting/add_dispute_setting','Dispute',' title="Dispute Setting" class="subbutton white"');?></li>
                 
                 <li <?php if($this->strdd[1] == 'list_template') { echo 'class="active"'; }?>><?php echo anchor('template_setting/list_template','Templates',' title="List Template Manager" class="subbutton white"');?></li>
                
			</ul>
			
		<?php } else { ?>
		<li><?php echo anchor('site_setting/add_site_setting','<span class="icon_text settings"></span>settings',' title="Settings"');?></li>
		 <?php } ?>
         
		 
		 
		 
      
	  
	 
         
        
	  
	  
        </ul> 
        
         
      </ul>
	  <div id="subnavbar">
		<!--<form id="search_form" method="post" action="">
			<input type="text" name="search_input" value="Search..." id="search_input" class="fl" />
		</form>-->
	  </div>