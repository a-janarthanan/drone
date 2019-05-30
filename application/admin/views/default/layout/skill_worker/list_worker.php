<script type="text/javascript" language="javascript">
	
	
	function getlimit(limit)
	{
		if(limit=='0')
		{
		return false;
		}
		else
		{
			window.location.href='<?php echo base_url();?>skill_worker/lists/<?php echo $category_id;?>/'+limit;
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
			
			window.location.href='<?php echo base_url();?>skill_worker/search_lists/<?php echo $category_id;?>/'+limit+'/<?php echo $option.'/'.$keyword; ?>';
		}
	
	}
	
	function gomain(x)
	{
		
		if(x == 'all')
		{
			window.location.href= '<?php echo base_url();?>skill_worker/lists/<?php echo $category_id;?>';
		}
		else if(x=='city')
		{
		   document.getElementById("city").style.display="block";
		   document.getElementById("keyword").style.display="none";
			
		}
		
		
	}
</script>

<div id="content">        
	
	<div class="clear"></div>
	<div class="column full">
	
	<div class="box">		
		<div class="box themed_box">
		<h2 class="box-header">Total Runners :: <?php echo $total_rows; ?></h2>
			
			<div class="box-content box-table">
			<table class="tablebox">
            
                <div id="topbar" style="border:#CCC solid 1px;">
                    <div style="float:left;">
                        <strong>Show</strong>
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
                    
                     <form name="frm_search" id="frm_search" method="post" action="<?php echo base_url(); ?>skill_worker/search_lists/<?php echo $category_id.'/'.$limit; ?>" onSubmit="return chk_valid();">
                 <strong style="float:left; margin-bottom:10px; margin-top:6px;">&nbsp;&nbsp;&nbsp;Search By &nbsp;</strong>&nbsp;&nbsp;
                        <select name="option" id="option" style="width:100px; float:left;" onchange="gomain(this.value)">
                            <option value="all">All</option> 
                            <option value="city" <?php if($option=='city'){?> selected="selected"<?php }?>>City</option>
                        </select>
                        
                    
					   
                    <?php if($option != 'city' ){ ?>
					    <input type="text" name="keyword" id="keyword" value="<?php echo $keyword;?>" class="textfield" style="float:left; display:block; margin-top:4px; margin-left:6px;"/> 
					   <?php } else {?>
                                  <input type="text" name="keyword" id="keyword" value="<?php echo $keyword;?>" class="textfield" style="float:left; display:none; margin-top:4px; margin-left:6px;"/> 
                       <?php }?>
                      
			
					
                     
					   
                       
                    <?php if($option!='city'){ ?>
					   <select name="keyword" id="city" style="display:none; float:left;">
					<?php }else {?>
                       <select name="keyword" id="city" style="display:block; float:left;">
                    <?php } 
					   	  $cities = city_list();
						  foreach($cities as $city){   
					?>
                         <option value="<?php echo $city->city_id;?>" <?php if($keyword==$city->city_id){?> selected="selected"<?php }?>><?php echo $city->city_name;?></option>
                    <?php }?>
                       </select>  
                      
                                      
                        <input type="submit" name="submit" id="submit" value="Search" class="button themed" /> 
                     </form> 

                
                 
                 <div style="float:right;">
                 
                 <?php if($keyword=='') { $keyword=0; } echo anchor('skill_worker/export_skill_worker/'.$category_id.'/'.$keyword.'/'.strtotime(date('H:i:s')),'Export CSV','class="button white" style="margin: 0px;"'); ?>
                 </div>
                 
 </div>
 
 
				<thead class="table-header">
					<tr> 
                        <th class="first tc">Runner Name</th>
                        <th>Email</th>
                        <th>Mobile</th>   
                        <th>Phone</th>                                 
                        <th>Postal Code</th>
                    
                        <th>Task Type</th> 
                        <th>Verified</th> 
                        
                        <th class="tc">View Detail</th>      
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
                        <td class="tc"><?php echo anchor(front_base_url().'user/'.$row->profile_name,ucfirst($row->first_name).' '.ucfirst(substr($row->last_name,0,1)),' style="color:#004C7A;" target="_blank"'); ?></td>
                        <td><?php echo $row->email; ?></td>              
                        <td><?php echo $row->mobile_no; ?></td>
                        <td><?php echo $row->phone_no; ?></td>
                        <td><?php echo $row->zip_code; ?></td>
                     
                        <td><?php  
						
						$task_type='';
						if($row->worker_task_type != ''){

                                       $cate=explode(',',$row->worker_task_type);

                                       foreach($cate as $c)

                                       {

                                           if(get_category_name($c) != '') {
                                           		$task_type.=trim(get_category_name($c)).', '; 
										  	}

                                       }

                                   }
								   
								  
 ?>
 <img src="<?php echo base_url().getThemename();?>/images/task_type.png" border="0" title="<?php  echo $task_type; ?>" style="cursor:pointer;" height="35" width="35" />
 </td> 
                        <td align="center" valign="middle" style="padding-left:10px;">
                        
                           <?php if($row->worker_app_approved  == 1){ ?><div  style="float:left; "><img src="<?php echo base_url().getThemeName();?>/images/abr1.png" alt="" width="30" height="30" style="cursor:pointer;" title="Application" /></div> <?php } ?>
                           
                                <?php if($row->worker_background_approved  == 1){?><div  style="float:left; "><img src="<?php echo base_url().getThemeName();?>/images/abr2.png" alt="" width="30" height="30" style="cursor:pointer;" title="Background" /></div> <?php } ?>
                                
                                 <?php if($row->mobile_no !='' || $row->phone_no !=''){ ?><div  style="float:left;"><img src="<?php echo base_url().getThemeName();?>/images/abr3.png" alt="" width="30" height="30" style="cursor:pointer;" title="Phone"  /></div> <?php } ?>
                                 
                                 

                        
                        
                        </td>
                        
                        <td><?php echo anchor('worker/view_worker/'.$row->worker_id,'View Detail','class="button white"'); ?></td>
                  	</tr>
				  <?php
                            $i++;
                        }
                    } else { ?>
							<tr class="odd">
                                <td colspan="8">No Worker has been added yet.</td>
                            </tr>
					<?php }
                  ?>	
				</tbody>
			</table>
				<ul class="pagination">
                    <?php echo $page_link; ?>
				</ul>
                
			</div>
		</div>
	</div>
</div>