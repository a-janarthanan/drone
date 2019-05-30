

<div id="content" align="center">

<?php

if($error!='') { ?>
<div class="column full">
			<span class="message information"><strong><?php echo $error; ?></strong></span>
		</div>
<?php } ?>

     
    <div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">User Suspend Conversation : </h2> 
			<div class="box-content">	
            
            
            <div class="clear"></div>


<?php

				
			
			
				$user_detail=$this->suspend_model->get_user_profile_by_id($user_id);
				
				
				
				if(!$user_detail)
				{
					/*echo "<script>window.location.href='".site_url('home')."'</script>";*/
				}
				
				 $user_suspend_id=$this->suspend_model->get_suspend_id($user_id);
			
				
				if($user_suspend_id==0)
				{
					/*echo "<script>window.location.href='".site_url('home')."'</script>";*/
				}
				
				$suspend_detail=$this->suspend_model->get_suspend_detail($user_suspend_id);
				
				
				$check_live=$this->suspend_model->check_suspend_live($user_id);


				

				?>
				
                <p><b><?php echo anchor('suspend/remove_suspend/'.$user_id.'/'.$user_suspend_id,'Remove Suspend'); ?></b> 
                
                
                OR 
                
                <b><?php echo anchor('suspend/make_permanent_suspend/'.$user_id.'/'.$user_suspend_id,'Permanent Suspend'); ?></b> 
                
                </p>
					<hr/>
                
				    <p><b>From :</b> <?php echo date($site_setting->date_time_format,strtotime($suspend_detail->suspend_from_date)); ?>  <b>To :</b> <?php echo date($site_setting->date_time_format,strtotime($suspend_detail->suspend_to_date)); ?>
                </p>
                
                
                <p><b>Suspend Type :</b> <?php if($suspend_detail->is_permanent==1) { echo "Permanent"; } else { echo "Temporary"; } ?></p>
                
                
                <p><b>Reason :</b>
                <?php
				
				echo $suspend_detail->suspend_reason;
				
				 ?>
                 
                
                </p>
                
            
                

  
      <div class="clear"></div> 
  
  <hr/>  
  
   <div class="marTB20"><h3 id="detail-bg1">Conversations</h3></div>     


 	
    <div class="clear"></div>            
    
    
  <?php


if($check_live)
{
	$attributes = array('name'=>'frm_new_comment','class'=>'fdesign');
	echo form_open('suspend/new_message/'.$user_id.'/'.$user_suspend_id,$attributes);
?>  
    <ul class="padli10">
    	<li>
            <div class="abc">
            <?php
			
			
				$user_image= base_url().'upload/no_image.png';
				 
				  if($user_detail)
				  {
				 
				 if($user_detail->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$user_detail->profile_image;
						
					}
					
				}
				
				}
				
				?>
            
            </div>
            
            <div class="conbg3" style="width:613px;">
            
            
  
            
              <textarea name="comment" cols="73" rows="5"></textarea>
              
              
           
              
             
              <input type="hidden" id="user_suspend_id" name="user_suspend_id" class="chbg fl" value="<?php echo $user_suspend_id;?>">
              
              <input type="hidden" id="user_id" name="user_id" class="chbg fl" value="<?php echo $user_id;?>">
              
             
              <input type="hidden" id="offset" name="offset" class="chbg fl" value="<?php echo $offset;?>">
              
              
                <div class="marT10">
              
                 
                 
                   
			   
		
			    <div class="clear"></div><br />

			<br />

			  
			  
		
                    <input type="submit" id="accept" name="accept" class="button themed" value="Send">
                   
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>
		</li>
     </ul>

</form>

        <div class="clear"></div> 
<?php } ?>

            <hr/>    
<ul class="padli10 marT10">
	<?php 
	
	
	if($result) { 
		foreach($result as $row) {
		
		
	
		
		
			$user_detail=$this->suspend_model->get_user_profile_by_id($row->user_id);
			
			
				$user_image= base_url().'upload/no_image.png';
				 
				 if($user_detail->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$user_detail->profile_image;
						
					}
					
				}
				
				
				
	?>
        <li class="posrel">
          
               
               <?php 
			  	if($row->is_admin == 1) 
				{ 
					$conbg =  'conbg1';
				} else {
					$conbg =  'conbg2';
				}
			  ?>
                <div class="<?php echo $conbg;?>" style="width:635px;">
                    
              
                        <p class="LH18 marT5"><?php echo ucfirst($row->message);?><br />

<i style="color:#999999; font-size:12px;"><?php if($row->is_admin==1) {  echo "By Administrator "; } else { echo "By ".$user_detail->full_name; } echo date($site_setting->date_time_format,strtotime($row->message_date));?></i>
</p><hr/>
                </div>
                <div class="clear"></div>
            
        </li>
    <?php } } ?>
        	            
</ul>            



           	<?php if($total_rows>10) { ?>
					<ul class="pagination">
					<?php echo $page_link; ?>
                </ul>
				<?php } ?>
                
     
  
            </div>
		</div>
	</div>
	<div class="clear"></div>
</div>
          	
