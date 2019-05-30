<script type="text/javascript" language="javascript">
function setchecked(elemName,status){
	elem = document.getElementsByName(elemName);
	for(i=0;i<elem.length;i++){
		elem[i].checked=status;
	}
}

function setaction(elename, actionval, actionmsg, formname) {
	vchkcnt=0;
	elem = document.getElementsByName(elename);
	
	for(i=0;i<elem.length;i++){
		if(elem[i].checked) vchkcnt++;	
	}
	if(vchkcnt==0) {
		alert('Please select a record')
	} else {
		
		if(confirm(actionmsg))
		{
			document.getElementById('action').value=actionval;	
			document.getElementById(formname).submit();
		}		
		
	}
}

	function chk_valid()
	{
		
		var keyword = document.getElementById('keyword').value;
		
		if(keyword=='')
		{
			alert('Please enter search keyword');	
			return false;
			
		}
		
		else
		{
			return true;			
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
		<h2 class="box-header">Newsletters </h2>
			
			<div class="box-content box-table">
			<table class="tablebox">
            <div id="topbar" style="border:#CCC solid 1px;">
                    <div style="float:left; ">
                        
                         	<form name="frm_search" id="frm_search" method="post" action="<?php echo base_url(); ?>newsletter/search_subscriber_user/<?php echo $newsletter_id; ?>" onSubmit="return chk_valid();" >
                <strong>Search by</strong>
                                <select name="option" id="option" style="width:100px;" class="">
                                    <option value="user_name">Username</option>                    
                                    <option value="email">Email</option>                   
                                </select>&nbsp;
                                
                                
                                <input type="text" name="keyword" id="keyword" value=""/> &nbsp;           
                                <input type="submit" name="submit" id="submit" class="button themed" value="Search" style="margin:0px;"/>
  
                               </form> 
                    </div>		      
                </div>

			 
                 

				<thead class="table-header">
					<tr> 
                    	<th class="first tc"><a href="javascript:void(0)" onClick="javascript:setchecked('chk[]',1)" style="color:#000;"><?php echo "Check All"; ?></a>|<a href="javascript:void(0)" onClick="javascript:setchecked('chk[]',0)" style="color:#000;"><?php echo "Clear All"; ?></a></th>
                        <th class="first tc">Name</th>
                        <th>Email</th>
                        <th>Signup IP Address</th>
                        <th>Subscribe Date</th>                                    	
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
					<tr onClick="<?php echo $cl; ?>(this);" class="<?php echo $cl; ?>">
						<td><input type="checkbox" name="chk[]" id="chk" value="<?php   echo $row->newsletter_user_id;?>" /></td>
                        <td class="tc"><?php if($row->user_name=='') { echo "N/A"; } else { echo $row->user_name; }?></td>
                        <td><?php echo $row->email; ?></td>
                        <td><?php echo $row->user_ip; ?></td>
                        <td><?php echo date('d M,Y',strtotime($row->subscribe_date)); ?></td> 
                  	</tr>
				  <?php
                            $i++;
                        }
                    }
                   else {
								  ?>        
								  
								  <tr class="alter">
                                    <td colspan="15" align="center" valign="middle" height="30">No Records found.</td></tr>
								  
								  <?php } ?>  
				</tbody>
			</table>
				<ul class="pagination">
                    <?php echo $page_link; ?>
				</ul>
                
				</form>
			</div>
		</div>
	</div>
</div>