<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/lib/tooltip2.js"></script>

<?php 
	   	

		$category_image=base_url().'upload/category/no_image.png';

		
		if($task_detail->category_image!='') {  
		
			if(file_exists(base_path().'upload/category/'.$task_detail->category_image)) { 
				
				$category_image=base_url().'upload/category/'.$task_detail->category_image;
			
			}
			
		}
		
		$data['category_image']=$category_image;
		
		
		
?>
<div class="main">
<div class="incon">

<div class="mconleft">
       
       
<div id="s1postJ" class="padB10">Additional Information of : <?php echo anchor('tasks/'.$task_detail->task_url_name,$task_detail->task_name,' class="dhan" ');?></div>
 

<div class="clear"></div>


  
<ul class="padli10 marT10">
	<?php 
		if($result){
			foreach($result as $row) { 
	?>
        <li class="posrel">
            <div rel="tooltip2" class="tpp"  title="<?php echo date($site_setting->date_format,strtotime($row->post_date));?>">
                <div class="conbg2" style="width: 625px; background:none; border-bottom:1px solid #cccccc; "> <p class="LH18 marT5" ><?php $information= $row->information;		
					$information=str_replace('KSYDOU','"',$information);
					 $information=str_replace('KSYSING',"'",$information);				
				echo 	ucfirst($information); ?></p></div>
                <div class="clear"></div>
            </div>
        </li>
    <?php } }?>
        	            
</ul>            


<?php 

	if( ($task_detail->task_worker_id == '' || $task_detail->task_worker_id == 0)  && $task_detail->task_activity_status==0) {
		$attributes = array('name'=>'frm_information','class'=>'fdesign');
		echo form_open('additional_information/information/'.$task_id,$attributes);
?>  
        <ul class="padli10">
            <li>
                <div class="conbg3" style="width: 605px;">
                  <textarea name="information" cols="63" rows="5" id="information"></textarea> 
                  
                   <input type="hidden" id="task_id" name="task_id" class="chbg fl" value="<?php echo $task_id;?>">
                 
                    <div class="marT10">
                   
                        <input type="submit" id="dispute" name="dispute" class="chbg fr" value="Add Information">
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>
            </li>
         </ul>

</form>
<?php } ?>
  

		</div>



  <?php echo $this->load->view($theme.'/layout/user_task/worker_offer_side_bar.php',$data); ?>
   <div class="clear"></div>     
</div>
</div>

           
          	
