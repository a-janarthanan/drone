<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<style>
.ultaskers li {
border-bottom: 1px #f2413e solid;
padding: 10px 0px;
}
.abc{
float: left;
width: 55px;
}
</style>
<div>
	<div>
	<!--<div class="page-title mbot20">
		<h1 class="mleft15">Favourite Worker bees: <?php echo anchor('user/'.getUserProfileName(),$this->session->userdata('full_name'),' style="color:black" ');?></h1>
	</div>-->
    <div class="red-subtitle top-red-subtitle" >Mina favoriter: <?php echo anchor('user/'.getUserProfileName(),$this->session->userdata('full_name'),' style="color:#fff" ');?></div>
    	<div class="profile_back">
        <div class="container">
        <div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
        <div class="home-signpost-content"> 
    	<div class="dbleft dbleft-main">
                
            
<?php
if($msg!='')
{ ?>
<div id="success">
<ul>
<?php if($msg=='delete'){ ?> <p>Favourite Tasker has been removed successfully.</p><?php } ?>
</ul></div>
<?php } ?>

           
           <?php echo anchor('taskers','<b style="font-size:18px">Klicka här för att söka bland mina favoriter</b>','class="fpass fs14"'); ?>
           
       
       
<div class="abttb3-2">
<ul class="ultaskers marT10">

 		<?php if($result) {  foreach($result as $row) { 
		
		
		
			$user_detail=$this->user_model->get_user_profile_by_id($row->user_id);
									
						
									
			 $user_image= base_url().'upload/no_image.png';
				 
				 if($user_detail->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$user_detail->profile_image;
						
					}
					
				}
				
		
		
		?> 
        	<li class="posrel">
            	<div class="taskphoto taskphoto-2" style="text-align:center;">
                
                
                
                	<?php echo anchor('user/'.$row->profile_name,'<img src="'.$user_image.'" alt="" width="50" height="50"  class="round-corner" />'); ?>
                     <?php 
					 	$site_setting=site_setting();
						$check_worker_detail=$this->worker_model->check_user_worker_detail($row->user_id);
						if($check_worker_detail) { 
						
						
                     ?>
                      <a class="tooltip tooltip-2" id="twoonebr1">Level <?php echo $check_worker_detail->worker_level;?><span>Level <?php echo $check_worker_detail->worker_level;?> Worker bee</span></a>

                    <?php } ?>   
               
                </div>
                	<div class="taskdetails taskdetails-main" >
                                    
                      <table width="100%" border="0" cellspacing="1" cellpadding="0">
                      <tr>
                        <td width="22%" class="padTB10"><?php echo anchor('user/'.$row->profile_name,ucfirst($row->first_name).' '.ucfirst(substr($row->last_name,0,1)).'.',' class="abmarks abmarks-2 unl" ');?></td>
                        <?php 
						
	$total_rate=get_user_total_rate($row->user_id);

$total_review=get_user_total_review($row->user_id);
?>
                        <td width="58%">
                        	<div class="strmn strmn-2" style="margin-top:2px;"><div class="str_sel str_sel-2 fl" style="width:<?php if($total_rate>5) { ?>100<?php } else { echo round($total_rate*2);?>0<?php } ?>%;"></div></div><div class="fl marL5"><?php echo $total_rate; ?>/5(<?php echo anchor('user/'.$row->profile_name.'/Omdömen',$total_review.' Omdömen','class="fpass"');  ?>)</div></td>
                        <td width="20%">
                                       
                                       
                                    
                                        
                                <?php echo anchor('user_other/delete_favorite/'.$row->favorite_id.'/'.$offset,'Avmarkera','class="btn btn-default btn-color fr"'); ?>


                           
                                        
                                          
                        </td>
                      </tr>
                    </table>            

					
                                    
                    
                    <p class="marTB5 LH18 abmarks abmarks-2" style="font-size:15px;">
						 <?php                                            
                            $about_user= $row->about_user;		
                            $about_user=str_replace('KSYDOU','"',$about_user);
                            $about_user=str_replace('KSYSING',"'",$about_user);
    
                            $strlen = strlen($about_user);
                            if($strlen > 50) {
								echo substr($about_user,0,80).' ...&nbsp;'; 
								echo anchor('user/'.$row->profile_name,'more',' class="abmarks abmarks-2 unl" ');
							} else { 
								echo $about_user; 
							} 
                         ?>               
                    </p>
                    <p class="marT5 abmarks abmarks-2 fs14" style="padding-top:5px;">
                    	<?php 
							if($check_worker_detail) {
							
								 $task_type_detail='';
			  
			 $types=$check_worker_detail->worker_task_type;
			 
			 if($types!='') { 
			 
			
			 
			 $ex_type=explode(',',$types);
			 
			 foreach($ex_type as $type) 
			 {
				
				 $get_task_type=$this->worker_model->get_task_type_detail($type);
				 
				if($get_task_type)
				 {
				 	if(isset($get_task_type->task_name))				
					{
				  $task_type_detail .=$get_task_type->task_name.', ';
				  }
				 }
				 
				
			}
			
			if($task_type_detail!='') { 
				echo "<b>Uppdragspreferenser: </b>  ";
				$final_tring = substr($task_type_detail,0,-1);
				if(strlen($final_tring) > 100) { echo substr($final_tring,0,100).' ...';}
										else { echo $final_tring; } 
			}
			
			}
			
			
							}
						?>
                    </p>

             
                </div>


                <div class="clear"></div>
            </li>
            <?php } } ?>

     
        </ul>
</div>  
                
            <?php if($total_rows>10) { ?>
					<div class="gonext">
                    <?php echo $page_link; ?>
                    </div>
				<?php } ?>
           
                

		</div>
	</div>
 <div class="dbright-task dbright-task-main">
 <?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
 </div>
   <div class="clear"></div>     
</div>
   <div class="clear"></div>   
</div>
</div>

           
          	
