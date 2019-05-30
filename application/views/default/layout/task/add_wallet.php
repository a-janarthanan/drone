


<?php if($error!='') { ?> 
<div class="marTB10" id="error"><p><?php echo $error; ?></p></div><?php } ?>



          <div class="padB10" id="s1postJ" >Add Amount to Your Wallet</div> 


          
<div class="borrdercol wid450">

	


<?php
	$attributes = array('name'=>'frmAddWallet','id'=>'frmAddWallet','class'=>'form_design','target'=>'_parent');
	echo form_open('task/add_amount/'.$task_id.'/'.$task_comment_id,$attributes);
?>





<div id="detail-bg2" class="padTB10"><b style="color:#F00;">Note : </b><p>&nbsp;</p><p>This amount will be holded in escrow until task is finished by Worker bee.</p>
</div>



<table width="100%" cellspacing="4" cellpadding="4" border="0">
<tbody>
<tr>
    <td width="20%" valign="middle" align="left" class="lab1">Add Amount(<?php echo $site_setting->currency_symbol;?>)</td>
    
    <td width="80%" valign="top" align="left"><?php echo $credit ;?>
    <input type="hidden" value="<?php echo $credit ;?>" id="credit" name="credit" class="ntext"></td>
</tr>


<tr>
    <td valign="top" align="left"  class="lab1">Gateway </td>
   
    <td valign="top" align="left"> 	

   
<?php	
	
		if($payment)
		{
			$i=0;
			foreach($payment as $row)
			{
			$check='';
			//var_dump($payment);exit;
			 if($gateway_type==$row->id)$check='checked=checked';
			else if($i==0)$check='checked=checked';
				?>
                                            
                                            
                                         
<p class="fs13"><input type="radio" name="gateway_type" id="gateway_type" value="<?php echo $row->id; ?>" <?php echo $check;?> /><?php echo $row->name; ?></p>
	                                        
			<?php
			}
		}
		
		?>    
	
	</td>
	</tr>

	<tr>
    	<td></td>
        <td align="left"><input type="submit" name="add_detail" class="submbg2" value="Add"></td>
    </tr>
</tbody>
</table>    
    

</form>    
  
                
</div>                

    

  