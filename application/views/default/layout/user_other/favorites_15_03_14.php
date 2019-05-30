<div>
	<div>
	<div class="page-title mbot20">
		<h1 class="mleft15">Favourite Worker bees: <?php echo anchor('user/'.getUserProfileName(),$this->session->userdata('full_name'),' style="color:black" ');?></h1>
	</div>
    	<div class="mconleft" style="margin:0 0 0 15px;">
                
            
<?php
if($msg!='')
{ ?>
<div id="success">
<ul>
<?php if($msg=='delete'){ ?> <p>Favourite Worker bee has been deleted successfully.</p><?php } ?>
</ul></div>
<?php } ?>

           
           <?php echo anchor('taskers','Browse Worker bees to add a favorite','class="fpass fs14"'); ?>
           
       
       

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
            	<div class="abc">
                
                
                
                	<?php echo anchor('user/'.$row->profile_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />','class="fpass fs14"'); ?>
                     <?php 
					 	$site_setting=site_setting();
						$check_worker_detail=$this->worker_model->check_user_worker_detail($row->user_id);
						if($check_worker_detail) { 
						
						
                     ?>
                      
                        <a rel="tooltip" class="twoonepts1" title="Level <?php echo $check_worker_detail->worker_level;?> Worker bee"><?php echo $check_worker_detail->worker_level;?></a>

                    <?php } ?>   
               
                </div>
                <div class="fl wid450 marL5" >
                                    
                                  

<table width="100%" border="0" cellspacing="1" cellpadding="0">
                      <tr>
                        <td width="37%" ><?php echo anchor('user/'.$row->profile_name,ucfirst($row->first_name).' '.ucfirst(substr($row->last_name,0,1)).'.',' class="abmarks unl" ');?></td>
                        
                        <?php 
						
	$total_rate=get_user_total_rate($row->user_id);

$total_review=get_user_total_review($row->user_id);
?>
                        <td width="63%"><div class="strmn"><div class="str_sel" style="width:<?php if($total_rate>5) { ?>100<?php } else { echo round($total_rate*2);?>0<?php } ?>%;"></div></div><div class="fl marL5"><?php echo $total_rate; ?>/5(<?php echo anchor('user/'.$row->profile_name.'/reviews',$total_review.' reviews','class="fpass"');  ?>)</div></td>
                    </table>
                                    
                    
                    <p class="marTB5 LH18">
						 <?php                                            
                            $about_user= $row->about_user;		
                            $about_user=str_replace('KSYDOU','"',$about_user);
                            $about_user=str_replace('KSYSING',"'",$about_user);
    
                            $strlen = strlen($about_user);
                            if($strlen > 50) {
								echo substr($about_user,0,80).' ...&nbsp;'; 
								echo anchor('user/'.$row->profile_name,'more',' class="abmarks unl" ');
							} else { 
								echo $about_user; 
							} 
                         ?>               
                    </p>
                    <p class="marT5">
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
				  $task_type_detail .=$get_task_type->task_name.',';
				  }
				 }
				 
				
			}
			
			if($task_type_detail!='') { echo "<b>Top Task Types: </b>  ". substr($task_type_detail,0,-1); }
			
			}
			
			
							}
						?>
                    </p>

             
                </div>
                
                <div class="fr marTB10"><?php echo anchor('user_other/delete_favorite/'.$row->favorite_id.'/'.$offset,'Unfavorite','class="chbg"'); ?></div>


                <div class="clear"></div>
            </li>
            <?php } } ?>

     
        </ul>
       
                
            <?php if($total_rows>10) { ?>
					<div class="gonext">
                    <?php echo $page_link; ?>
                    </div>
				<?php } ?>
           
                

		</div>


 <?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
   <div class="clear"></div>     
</div>
</div>

           
          	
