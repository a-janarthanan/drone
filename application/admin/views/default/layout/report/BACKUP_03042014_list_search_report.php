<script type="text/javascript" language="javascript">
	function gomain(x)
	{
		//alert(x);
		if(x == 'all')
		{
			window.location.href= '<?php echo base_url();?>report/list_search_report/20';
		}
		else if(x=='category')
		{
		   document.getElementById("cat").style.display="block";
		   document.getElementById("keyword").style.display="none";
		   document.getElementById("bjet").style.display="none";
		   document.getElementById("city").style.display="none";
		   document.getElementById("state").style.display="none";
		}
		
		else if(x=='city')
		{
		   document.getElementById("city").style.display="block";
		   document.getElementById("cat").style.display="none";
		   document.getElementById("keyword").style.display="none";
		   document.getElementById("bjet").style.display="none";
		   document.getElementById("state").style.display="none";
			
		}
		else if(x=='state')
		{
		   document.getElementById("city").style.display="none";
		   document.getElementById("cat").style.display="none";
		   document.getElementById("keyword").style.display="none";
		   document.getElementById("bjet").style.display="none";
		   document.getElementById("state").style.display="block";
			
		}
		else if(x=='budget')
		{
		   document.getElementById("cat").style.display="none";
		   document.getElementById("keyword").style.display="none";
		   document.getElementById("bjet").style.display="block";
		   document.getElementById("city").style.display="none";
		   document.getElementById("state").style.display="none";
		 }
		 else
		 {
		    document.getElementById("cat").style.display="none";
		   document.getElementById("keyword").style.display="block";
		   document.getElementById("bjet").style.display="none";
		   document.getElementById("city").style.display="none";
		   document.getElementById("state").style.display="none";
		 }
	}
	
	function getlimit(limit)
	{
		if(limit=='0')
		{
		return false;
		}
		else
		{
			window.location.href='<?php echo base_url();?>report/list_search_report/'+limit;
		}
	
	}	
	
	function getsearchlimit(limit)
	{
		if(limit=='0')
		{
		return false;
		}
		else
		{
			
			window.location.href='<?php echo base_url();?>report/list_search_report/'+limit+'/<?php echo $option.'/'.$keyword; ?>';
		}
	
	}
	
</script>

<div id="content">        
	<?php if($msg != ""){
            if($msg == "insert"){ $error = 'New Record has been added Successfully.';}
            if($msg == "update"){ $error = 'Record has been updated Successfully.';}
            if($msg == "delete"){ $error = 'Record has been deleted Successfully.';}
    ?>
        <div class="column full">
            <span class="message information"><strong><?php echo $error;?></strong></span>
        </div>
    <?php } ?>
	<div class="clear"></div>
	<div class="column full">
	
	<div class="box">		
		<div class="box themed_box">
		<h2 class="box-header">Tasks </h2>
			
			<div class="box-content box-table">
			<table class="tablebox" id="tabledata">
         <?php /*?>   
               <div id="topbar" style="border:#CCC solid 1px;">
                    <div style="float:left; width:127px;">
					   <strong>Show :</strong>
                            <?php if($search_type=='normal') { ?>
                            <select name="limit" id="limit" onchange="getlimit(this.value)" style="width:80px;">
                            <?php } if($search_type=='search') { ?>
                             <select name="limit" id="limit" onchange="getsearchlimit(this.value)" style="width:80px;">
                            <?php } ?>
                                <option value="0">Per Page</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="75">75</option>
                                <option value="100">100</option>
                            </select>
                      </div>
                    
                     <form name="frm_search" id="frm_search" method="post" action="<?php echo base_url(); ?>report/list_search_report/<?php echo $limit; ?>" onSubmit="return chk_valid();">
                     <strong style="float:left; margin-bottom:10px; margin-top:4px;">&nbsp;&nbsp;&nbsp;Search By &nbsp;</strong>&nbsp;&nbsp;
                        <select name="option" id="option" style="width:100px; float:left;" onChange="gomain(this.value)">
                            <option value="all">All</option> 
                            <option value="taskname" <?php if($option=='taskname'){?> selected="selected"<?php }?>>Taskname</option>
							<option value="category" <?php if($option=='category'){?> selected="selected"<?php }?>>Category</option>
							<option value="username" <?php if($option=='username'){?> selected="selected"<?php }?>>User Name</option>
							<option value="city" <?php if($option=='city'){?> selected="selected"<?php }?>>City</option>
                            <option value="state" <?php if($option=='state'){?> selected="selected"<?php }?>>State</option>
							<option value="date" <?php if($option=='date'){?> selected="selected"<?php }?>>Date</option>
							<option value="ip" <?php if($option=='ip'){?> selected="selected"<?php }?>>IP</option>
							<option value="budget" <?php if($option=='budget'){?> selected="selected"<?php }?>>Budget</option>
                       </select>
					   
					 
					   <?php if($option!='category' && $option !='budget' && $option != 'city' && $option != 'state'){ ?>
					    <input type="text" name="keyword" id="keyword" value="<?php echo $keyword;?>" class="textfield" style="float:left; display:block; margin-top:4px; margin-left:6px;"/> 
					   <?php } else {?>
                                  <input type="text" name="keyword" id="keyword" value="<?php echo $keyword;?>" class="textfield" style="float:left; display:none; margin-top:4px; margin-left:6px;"/> 
                       <?php }?>
                      
				<?php if($option=='budget'){?>
                	<span id="bjet" style="display:block; float:left;">
                <?php } else{?>
                    <span id="bjet" style="display:none; float:left;">
                <?php }?>		
				<strong style="float:left; margin-bottom:10px; margin-top:4px;">&nbsp;&nbsp;&nbsp;Low Budget: &nbsp;</strong>&nbsp;&nbsp;
			  <input type="text" name="low_budget" id="low_budget" value="<?php echo $lbudget;?>" class="textfield" style="float:left; display:block; margin-top:2px;"/> 
			  <strong style="float:left; margin-bottom:10px; margin-top:4px;">&nbsp;&nbsp;&nbsp;High Budget: &nbsp;</strong>&nbsp;&nbsp;
			  <input type="text" name="high_budget" id="high_budget" value="<?php echo $hbudget;?>" class="textfield" style="float:left; display:block; margin-top:-10px;"/> 
			  </span>
					<?php if($option!='category'){ ?>
					   <select name="cat" id="cat" style="display:none; float:left;">
					<?php }else {?>
                       <select name="cat" id="cat" style="display:block; float:left;">
                    <?php }?>
                       
					   <?php
					    
						  foreach($cat as $c)
						  {
						     
					   ?>
                         <option value="<?php echo $c->category_name;?>" <?php if($cate==$c->category_name){?> selected="selected"<?php }?>><?php echo $c->category_name;?></option>
                            <?php }?>
                       </select>    
					   
                       
                    <?php if($option!='city'){ ?>
					   <select name="city" id="city" style="display:none; float:left;">
					<?php }else {?>
                       <select name="city" id="city" style="display:block; float:left;">
                    <?php } 
					   	  $cities = city_list();
						  foreach($cities as $city){   
					?>
                         <option value="<?php echo $city->city_name;?>" <?php if($cityname==$city->city_name){?> selected="selected"<?php }?>><?php echo $city->city_name;?></option>
                    <?php }?>
                       </select>  
                       
                       
                       
                    <?php if($option!='state'){ ?>
					   <select name="state" id="state" style="display:none; float:left;">
					<?php }else {?>
                       <select name="state" id="state" style="display:block; float:left;">
                    <?php } 
					   	  $states = state_list();
						  foreach($states as $state){   
					?>
                         <option value="<?php echo $state->state_name;?>" <?php if($statename==$state->state_name){?> selected="selected"<?php }?>><?php echo $state->state_name;?></option>
                    <?php }?>
                       </select>  
					          
                        <input type="submit" name="submit" id="submit" value="Search" class="button themed"/> 
                     </form>
					 </div> 

                <?php */?>

				<thead>
					<tr height="25"> 
                        <th class="first tc">Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>City</th>                                    
                        <th>Poster Name</th>
                        <th>Assinged Runner</th>
                        <th>Active</th>
                        <th>Status</th>
                        <th class="tc">Posted On</th>        
					</tr>
				</thead>
				
				<tbody class="openable-tbody">
				<?php
                    if($result)
                    {
                        $i=0;
                        foreach($result as $row)
                        {
                            if($i%2=="0")
                            {
                                $cl = "odd";	
                            }else{	
                                $cl = "even";	
                            }
                  ?>
					<tr class="<?php echo $cl; ?>">
                        <td class="tc"><?php echo anchor(front_base_url().'tasks/'.$row->task_url_name,ucfirst($row->task_name),' style="color:#004C7A;" target="_blank"'); ?></td> 
                        <td>$<?php echo $row->task_price; ?></td>
                        <td><?php echo get_category_name($row->task_category_id); ?></td>
                        <td><?php echo get_city_name($row->task_city_id); ?></td>
                        <td><?php  echo get_user_name($row->user_id);?> </td>
                        <td><?php  
								if($row->task_worker_id != 0) { 
									$worker = $this->worker_model->view_worker_result($row->task_worker_id);
									echo anchor(front_base_url().'user/'.$worker->profile_name,ucfirst($worker->first_name).' '.ucfirst(substr($worker->last_name,0,1)),' style="color:#004C7A;" target="_blank"');
									 
								} else { echo 'Not Assign'; }
							?>
						
                        </td>
                       
                        <td><?php if($row->task_status=="1"){ echo "Active"; }else{ echo "Inactive"; } ?></td>
                         <td>
						<?php 
							 	if($row->task_activity_status == 0) { $task_activity_status = 'Post'; }
								elseif($row->task_activity_status == 1) { $task_activity_status = 'Assign'; }
								elseif($row->task_activity_status == 2) { $task_activity_status = 'Complete'; }
								elseif($row->task_activity_status == 3) { $task_activity_status = 'Close'; }
								elseif($row->task_activity_status == 4) { $task_activity_status = 'Suspend'; }
								
								echo $task_activity_status;
							 ?>
                        
                        </td>
                        <td><?php echo date('d-m-Y',strtotime($row->task_post_date)); ?></td>
                  	</tr>
				  <?php
                            $i++;
                        }
                    }
                  
				  else {?>
				           <tr class="odd">
                                <td colspan="8">No Report has been added yet.</td>
                            </tr>
				  <?php }?>	
				</tbody>
			</table>
           <!-- <ul class="pagination">
                <?php //echo $page_link; ?>
            </ul>-->
			</div>
		</div>
	</div>
</div>