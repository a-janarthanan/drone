
<script type="text/javascript">
$(document).ready(function() {	
	
	$("#various3").fancybox();
	$("#various4").fancybox();
	$("#various5").fancybox();
	
	$("#selmycity").fancybox();

});


	function deletetaskloc(id)
	{
		if(id=='' || id==0)
		{	
			return false;
		}
			
		var strURL='<?php echo site_url('task/delete_task_location/');?>/'+id;
		
		//alert(strURL);
			
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
					window.location.href='<?php echo site_url('sign_up/'); ?>';				
				}
				else
				{
					document.getElementById("taskloc"+id).style.display='none';
					
				}		
			}
		  }
		xmlhttp.open("GET",strURL,true);
		xmlhttp.send();
	}

</script>
<script type="text/javascript">
$(document).ready(function(){
						   
	$('#changeprice').click(function() {
	 jQuery('#changeprice').hide();	
	 jQuery('#lesf').hide();	
	 jQuery('#spend').show();	
	});
	$('#lesf').click(function() {
	 jQuery('#changeprice').hide();	
	 jQuery('#lesf').hide();	
	 jQuery('#spend').show();	
	});

	$('#cline').click(function() {
	 jQuery('#hline').hide();
	 jQuery('#sline').show();
	});

	$('#cline1').click(function() {
	 jQuery('#hline').hide();
	 jQuery('#sline').show();
	});


	$('#rloc').click(function() {
	 jQuery('#more2').hide();
	});

	jQuery('#mdprivate').click(function (){
		jQuery('#dialog-form-mdprivate').fadeIn("fast");
		jQuery('.wrap').show();
		
	});
	jQuery('#closemdprivate').click(function (){
		jQuery('#dialog-form-mdprivate').fadeOut("fast");
		jQuery('.wrap').hide();	
	});


	jQuery('#stp').click(function (){
		jQuery('#dialog-form-stp').fadeIn("fast");
		jQuery('.wrap').show();
		
	});
	
	
	jQuery('#stp2').click(function (){
		jQuery('#dialog-form-stp2').fadeIn("fast");
		jQuery('.wrap').show();
		
	});
	
	
	jQuery('#stp3').click(function (){
		jQuery('#dialog-form-stp3').fadeIn("fast");
		jQuery('.wrap').show();
		
	});
	
	
	
	jQuery('#closestp').click(function (){
		jQuery('#dialog-form-stp').fadeOut("fast");
		jQuery('.wrap').hide();	
	});


jQuery('#closestp2').click(function (){
		jQuery('#dialog-form-stp2').fadeOut("fast");
		jQuery('.wrap').hide();	
	});
	
	
	jQuery('#closestp3').click(function (){
		jQuery('#dialog-form-stp3').fadeOut("fast");
		jQuery('.wrap').hide();	
	});
	
	
	jQuery('#addpnote').click(function (){
		jQuery('#showpnote').slideToggle("fast");
		//jQuery('.wrap').show();
		
	});

	jQuery('#prino').click(function (){
		jQuery('#dialog-form-sprino').fadeIn("fast");
		jQuery('.wrap').show();
	});
	jQuery('#closesprino').click(function (){
		jQuery('#dialog-form-sprino').fadeOut("fast");
		jQuery('.wrap').hide();	
	});

});

</script>

<!--banner-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->
<div>
<div>
<div id="two-columnar-section" class="top-cont-main-dash">
   <div class="db-rightinfo-dash db-rightinfo-dash-back">
        <div class="container">
        	<div class="home-signpost-content dashboard-box1 dashboard-box1-1 round-back">
    			<?php if($error != '') { ?>     
      				<div id="error"> 
                    	<div class="follfi">There were problems with the following fields:</div>
                        <ul>
                            <?php echo $error; ?>
                        </ul>
                   	</div>
    			<?php } ?>
				<?php
                //echo "<pre>";print_r($task_detail);echo "</pre>";
				$attributes = array('name'=>'frm_edit_task');
				echo form_open('task/edit_task/'.$task_id,$attributes);
				$site_setting=site_setting();
				$data['task_detail']=$task_detail;
				$category_image=base_url().'upload/category/no_image.png';
				if($task_detail->category_image!='') {  
					if(file_exists(base_path().'upload/category/'.$task_detail->category_image)) { 
						$category_image=base_url().'upload/category/'.$task_detail->category_image;
					}
				}
				$data['category_image']=$category_image;
			    ?>
                <h1 class="social-login-title" style="padding:17px 0 17px 0;"><b style="color:#ec6600;">Get FREE Quotes</b></h1>
                <div class="job-status-main-block job-status-main-block2">
                    <ul>
                        <li>
                            <div class="posted-bar-line-jp posted-bar-line-first-jp active-post-jp"></div>
                            <div class="posted-bar-text-jp">Describe</div>
                        </li>
                        <li>
                            <div class="posted-bar-line-jp"></div>
                            <div class="posted-bar-text-jp">Review</div>
                        </li>
                        <li>
                            <div class="posted-bar-line-jp posted-bar-line-last-jp"></div>
                            <div class="posted-bar-text-jp">Done</div>
                        </li>
                    </ul>
                </div>
    			<div class="dbleft" style="padding:0px 0px 0 0px; width:100%; border:0; margin-left:0px;">
                    <div class="tabs1">
                    	<div class="left-part">
                        	<!--<div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;" data-wow-delay="0.5s" class="span3 wow fadeIn animated">
                                <div class="step-2-info">
                                    <div class="fl count-number">1</div>
                                    <div class="fl step-2-title">Choose work category</div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;" data-wow-delay="0.5s" class="span3 wow fadeIn animated">
                                <div id="container-cat-fancy" class="bottom-selection" style="margin-top:0px; padding-top:0px;">
                                    
                                    <select name="task_category_id" class="form-control select-width-5" >
									<option value="" <?php if($task_detail->task_category_id=="") { ?> selected <?php } ?>>--Please select a category--</option>
                                        <?php 
                                        $cat_arr=array();
                                        if($categories){ $ic=1; $putval=0;
                                            foreach($categories as $c){
                                        ?>
                                            <option value="c<?php echo $c->task_category_id; ?>" <?php if($task_detail->task_category_id==$c->task_category_id) { ?> selected <?php } ?>><?php echo ucfirst($c->category_name); ?></option>
                                        <?php
                                            }
                                        }
                                        ?>		
                                    </select>
                                    <span id="task_category_symbol" style="float:left; height:30px; margin-left:5px;"></span><br />
                                    <span id="task_categoryInfo" style="height:5px;"></span>	
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div class="margin-between"></div>-->
                            <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;" data-wow-delay="0.5s" class="span3 wow fadeIn animated">
                                <div class="step-2-info">
                                    <!--<div class="fl count-number">2</div>-->
                                    <div class="fl step-2-title step-2-title-on">Tell us more about the project</div>
                                </div>
                            </div>
                            <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;" data-wow-delay="0.5s" class="span3 wow fadeIn animated">
                                <div class="">
                                    <table width="100%" border="0" cellspacing="1" cellpadding="5" style="margin-left:-1px;">
                                        <tr>
                                            <td class="firts_img-1">Project title:</td>
                                        </tr>
                                        <tr id="task_nameTR">
                                            <td>
                                                <input type="hidden" value="<?php echo $task_id;?>" id="task_id" name="task_id" />
                                                <input name="task_name" type="text" class="select-width-2 form-control" style="margin-bottom:0px; float:left;" value="<?php echo $task_name;?>" id="task_name"/>
                                                <span id="task_name_symbol" style="float:left; height:30px; margin-left:5px;"></span><br />
                                                <span id="task_nameInfo" style="height:5px;"></span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <!--<div class="margin-between-2"></div>
                            <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;" data-wow-delay="0.5s" class="span3 wow fadeIn animated">
                                <div class="">
                                    <table width="100%" border="0" cellspacing="1" cellpadding="5" style="margin-left:-1px;">
                                        <tr>
                                            <td class="firts_img-1">Specific category task:</td>
                                        </tr>
                                        <tr id="task_nameTR">
                                            <td>
                                                <input type="hidden" value="<?php echo $task_id;?>" id="task_id" name="task_id" />
                                                <input name="task_name" type="text" class="select-width-2 form-control" style="margin-bottom:0px; float:left;" value="<?php echo $task_name;?>" id="task_name"/>
                                                
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="clear"></div>-->
                            <div class="margin-between-2"></div>
                            <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;" data-wow-delay="0.5s" class="span3 wow fadeIn animated">
                                <div class="">
                                	<table width="100%" border="0" cellspacing="1" cellpadding="5" style="margin-left:-1px;">
                                        <tr>
                                            <td class="firts_img-1">Project description:</td>
                                        </tr>
                                        <tr id="task_nameTR">
                                            <td>
                                                <textarea name="task_description" class="ntext form-control task-test task-test-10 select-width-3 select-width-3-1 select-width-3-112" style="float:left;" id="task_description" cols="73" rows="5" ><?php echo $task_description;?></textarea>
                                                <span id="task_description_symbol" style="float:left; height:30px; margin-left:5px;"></span><br />
                                                <span id="task_descriptionInfo" style="height:5px;"></span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div class="margin-between-2"></div>
                            <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;" data-wow-delay="0.5s" class="span3 wow fadeIn animated">
                                <div class="left-online">
                                    <div class="firts_img-1">Can it be done online?</div>
                                    <div class="yes-no-section">
                                        <div class="yes-no-section-1 left_round"><input type="radio" name="done_online" id="yes" value="1" <?php if($task_urgent==1) {?> checked="true" <?php } ?>/><label for="yes">Yes</label></div>
                                        <div class="yes-no-section-1 right_round"><input type="radio" name="done_online" id="no" value="0" <?php if($task_urgent==0) {?> checked="true" <?php } ?>/><label for="no">No</label></div>
                                    </div>
                                </div>
                                <div class="right-online">
                                    <div class="firts_img-1 firts_img-1-320">Attach files here</div>
                                    <div class="yes-no-section">
                                        <div class="yes-no-section-1 yes-no-section-2 right_round" id="file_open" style="overflow: hidden; width: 220px;">
                                        	<!--+ file Attach-->
                                            <input type="file" name="sheet_attachment" id="sheet_attachment"> 
                                        </div>
                                        <!--<input type="file" name="sheet_attachment" id="sheet_attachment" style="display:none"> -->
                                    </div>
                                </div>
                            </div>
                    	</div>
                        <div class="right-part">
                            <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;" data-wow-delay="0.5s" class="span3 wow fadeIn animated">
                                <div class="step-2-info">
                                    <!--<div class="fl count-number">3</div>-->
                                    <div class="fl step-2-title">What budget do you have in mind?</div>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;" data-wow-delay="0.5s" class="span3 wow fadeIn animated">
                                <div class="">
                                    <div class="implcr wid550 LH23" style="margin-top:10px; width:100%; margin-bottom:20px;">
                                          <div class="clear"></div>
                                              <table width="" border="0" cellspacing="1" cellpadding="5" class="price_info">
                                                  <tr>
                                                      <td class="firts_img-1 yes-no-section-1 right_round"><div style="padding-right:0px; padding-top:6px; text-align:center;">COP</div></td>
                                                      <td id="task_to_priceTR" class="form_text form_text-1115" style="width:70px;"> <label class="firts_img-1" style="padding-top:0px;">From <span id="req" style="color:red;">*</span> :</label></td>
                                                      <td  class="form_text_fild form_text_fild-112" style="width:120px;"><span id="lesf"><?php //echo $site_setting->currency_symbol;?></span><input name="task_to_price" id="task_to_price" style="margin-bottom:0; float:left;" class="form-control price-text select-width-2"  type="text" size="5" value="<?php if($task_to_price==0.00 || $task_to_price==0) { } else { echo $task_to_price; } ?>" />&nbsp;&nbsp;<p id="task_to_price_symbol" style="float:left; height:24px; margin-left:7px;"></p>&nbsp;<span id="task_to_priceInfo" style="height:5px;"></span></td>
                                                      <td id="task_to_priceTR" class="form_text form_text-1115" style="width:70px;"><label class="firts_img-1" style="padding-top:0px;">To <span id="req" style="color:red;">*</span> :</label></td>
                                                      <td  class="form_text_fild form_text_fild-112" style="width:120px;"><span id="lesf"><?php //echo $site_setting->currency_symbol;?></span><input name="task_price" id="task_price" style="margin-bottom:0; float:left;" class="form-control price-text select-width-2"  type="text" size="5" value="<?php if($task_price==0.00 || $task_price==0) { } else { echo $task_price; } ?>" />&nbsp;&nbsp;<p id="task_price_symbol" style="float:left; height:24px; margin-left:7px;"></p>&nbsp;<span id="task_priceInfo" style="height:5px;"></span></td>
                                                  </tr>
                                              </table>
                                          </div>
                                    <div class="clear"></div>
                                </div>  
                            </div>
                            <div class="margin-between"></div>
                            <div class="clear"></div>  
                            <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInRight;" data-wow-delay="0.5s" class="span3 wow fadeInRight animated dbright-task-1 dbright-task-13 dbright-task-135">
                                <div class="dbright-task dbright-task-one" style="text-align:left; margin-left:0px;">
                                    <?php echo $this->load->view($theme.'/layout/task/edit_task_side_bar',$data); ?>  
                                    <div class="clear"></div>
                                </div>
                            </div>
                                
                            <div class="clear"></div>
                            <div class="area-ph">
                            <div class="" style="text-align:right;">
                                <input type="submit" name="sub_step1" class="btn btn-default btn-post-btn btn-default-join-hiw"  value="Update" style="margin-top:0px;">            
                                <span id="req"></span>
                            </div>
                            <div style="padding-top:15px;">
                                    <div style="float:right;" class="need_help" id="open_help"><a href="javascript:void(0)" style="text-decoration:none;"><b>Need Help?</b></a></div>
                                    <div style="float:right; display:none;" class="need_help" id="close_help">
                                        <a class="more_option_need" href="<?php echo base_url(); ?>index.php/content/help" style="text-decoration:none;"><b>Visit our FAQ</b></a>
                                        <a class="more_option_need" href="<?php echo base_url(); ?>index.php/contact_us" style="text-decoration:none;"><b>Contact Us</b></a>
                                        <a class="more_option_need" id="hide_help" href="javascript:void(0)" style="text-decoration:none;"><b>Hide Help</b></a>
                                    </div>
                                </div>
                                    <script type="text/javascript">
									$(document).ready(function(){
										$("#open_help").click(function(){
											$("#open_help").css("display","none");
											$("#close_help").css("display","block");
										})
										$("#hide_help").click(function(){
											$("#close_help").css("display","none");
											$("#open_help").css("display","block");
										})
									})
								</script>
                    	</div>
					</div>
	            	</div>
                <div class="clear"></div>
    		</form>
    		</div>
            <div class="clear"></div>
		</div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>

<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/validation.js"></script>
