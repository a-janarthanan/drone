<!-- aToolTip css -->
<link type="text/css" href="<?php echo base_url().getThemeName(); ?>/css/atooltip_new.css" rel="stylesheet"  media="screen" />
<!-- aToolTip js -->
<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/jquery.atooltip.js"></script>
<script type="text/javascript">
$(document).ready(function() {	
	
	$("#various3").fancybox();
	$("#various4").fancybox();
	$("#various5").fancybox();
	
	$("#selmycity").fancybox();


});
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
	
	
	

	jQuery('#prino').click(function (){
		jQuery('#dialog-form-sprino').fadeIn("fast");
		jQuery('.wrap').show();
	});
	jQuery('#closesprino').click(function (){
		jQuery('#dialog-form-sprino').fadeOut("fast");
		jQuery('.wrap').hide();	
	});
	
	
	
	jQuery('#addpnote').click(function (){
	if(jQuery('#showpnote').css('display')=='none'){
		jQuery('#showpnote').show("fast");
	}
	else if(jQuery('#showpnote').css('display')=='block'){
		jQuery('#showpnote').hide("fast");
	}
	
	});
	
	$('#file_open').click(function(){
		$('#sheet_attachment').trigger('click');
		return false;
	});
	
	

});

</script>
<script type="text/javascript">
	$(function(){ 
		$('a.normalTip').aToolTip();
		$('a.normalTip1').aToolTip();
		$('a.ext').aToolTip();
		$('a.normalTip2').aToolTip();
	
	}); 
</script>
<style>
.ntext {
font-size: 13px;
width: 40%;
border: #CCC 1px solid;
padding: 5px;
}
.m15 {
margin: 15px;
}
.questions {
background: url(<?php echo base_url().getThemeName(); ?>/images/ques.png) no-repeat;
width: 16px;
height: 16px;
}
.under {
padding: 10px 0px;
}
.addright {
float: right;
width: 300px;
}
.estim {
font-size: 16px;
color: #27668b;
font-weight: bold;
font-family: Arial, Helvetica, sans-serif;
}
.morede {
margin-top: 5px;
margin-bottom: 15px;
padding: 5px 0px;
border-bottom: 1px solid #c1e3fe;
border-top: 1px solid #c1e3fe;
}
.morede ul {
float: left;
width: 92%;
padding: 0 0 0 15px;
margin: 0;
list-style: none;
}
.morede li {
border-bottom: 1px solid #c1e3fe;
list-style: none;
padding: 5px 0px;
}
.posrel {
position: relative;
}


</style>
<!--banner-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->

<div>
<div>

<div id="two-columnar-section" class="top-cont-main-dash">
   <div class="db-rightinfo-dash" >
        <div class="container">
        	<div class="red-subtitle"><div class="count-number-1">2</div>Detaljer om uppdraget</div>
            <div class="home-signpost-content dashboard-box1 dashboard-box1-1">
    			<?php if($error != '') { ?>     
      				<div id="error"> 
                    	<div class="follfi">There were problems with the following fields:</div>
                        <ul>
                            <?php echo $error; ?>
                        </ul>
                   	</div>
    			<?php } ?>
				<?php
                $attributes = array('name'=>'frm_new_task','id'=>'frm_new_task','class'=>'form_design');
                echo form_open_multipart('task/step_one/'.$task_id,$attributes);
                $site_setting=site_setting();
                $data['task_detail']=$task_detail;
                $category_image=base_url().'upload/category/no_image.png';
                if($task_detail->category_image!='') {      
                    if(file_exists(base_path().'upload/category_orig/'.$task_detail->category_image)) { 
                        $category_image=base_url().'upload/category_orig/'.$task_detail->category_image;
                    }
                }
                $data['category_image']=$category_image;
                ?>
                <div class="dbleft" style="padding:0px 0px 0 0px; width:100%; border:0; margin-left:0px; margin:0;">
                    <div class="tabs1">
                    	<div class="left-part">
                            <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;" data-wow-delay="0.5s" class="span3 wow fadeIn animated">
                                <div class="step-2-info">
                                    <div class="fl count-number">1</div>
                                    <div class="fl step-2-title">Välj kategori</div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;" data-wow-delay="0.5s" class="span3 wow fadeIn animated">
                                <div id="container-cat-fancy" class="bottom-selection" style="margin-top:0px; padding-top:0px;">
                                    
                                    <select name="task_category_id" class="form-control select-width-5" >
									<option value="" <?php if($task_category_id=="") { ?> selected <?php } ?>>--Vänligen välj kategori--</option>
                                        <?php 
                                        $cat_arr=array();
                                        if($categories){ $ic=1; $putval=0;
                                            foreach($categories as $c){
                                        ?>
                                            <option value="c<?php echo $c->task_category_id; ?>" <?php if($task_category_id==$c->task_category_id) { ?> selected <?php } ?>><?php echo ucfirst($c->category_name); ?></option>
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
                            <div class="margin-between"></div>
                            <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;" data-wow-delay="0.5s" class="span3 wow fadeIn animated">
                                <div class="step-2-info">
                                    <div class="fl count-number">2</div>
                                    <div class="fl step-2-title step-2-title-on">Berätta mer om uppdraget!</div>
                                </div>
                            </div>
                            <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;" data-wow-delay="0.5s" class="span3 wow fadeIn animated">
                                <div class="">
                                    <table width="100%" border="0" cellspacing="1" cellpadding="5" style="margin-left:-1px;">
                                        <tr>
                                            <td class="firts_img-1">Titel på uppdrag:</td>
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
                                            <td class="firts_img-1">Beskrivning av arbetet (uppskatta även arbetstid): </td>
                                        </tr>
                                        <tr id="task_nameTR">
                                            <td>
                                                <textarea name="task_description" class="ntext form-control task-test task-test-10 select-width-3" style="float:left;" id="task_description" cols="73" rows="5" ><?php echo $task_description;?></textarea>
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
                                <!--<div class="left-online">
                                    <div class="firts_img-1 firts_img-1-320">Kan det utföras online?</div>
                                    <div class="yes-no-section">
                                        <div class="yes-no-section-1 left_round"><input type="radio" name="done_online" id="Ja" value="1" <?php if($task_urgent==1) {?> checked="true" <?php } ?>/><label for="yes">Ja</label></div>
                                        <div class="yes-no-section-1 right_round"><input type="radio" name="done_online" id="Nej" value="0" <?php if($task_urgent==0) {?> checked="true" <?php } ?>/><label for="no">Nej</label></div>
                                    </div>
                                </div>-->
                                <div class="left-online">
                                    <div class="firts_img-1 firts_img-1-320">Bifoga fil (valfritt)</div>
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
                                    <div class="fl count-number">3</div>
                                    <div class="fl step-2-title">Hur mycket vill du betala för uppdraget?</div>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;" data-wow-delay="0.5s" class="span3 wow fadeIn animated">
                                <div class="">
                                    <div class="implcr wid550 LH23" style="margin-top:10px; width:100%; margin-bottom:20px;">
                                          <div class="clear"></div>
                                              <table width="" border="0" cellspacing="1" cellpadding="5" class="price_info">
                                                  <tr>
                                                      <td class="firts_img-1 yes-no-section-1 right_round"><div style="padding-right:0px; padding-top:6px; text-align:center;">SEK</div></td>
                                                      <td id="task_to_priceTR" class="form_text form_text-1115" style="width:70px;"> <label class="firts_img-1" style="padding-top:0px;">Från <span id="req" style="color:red;">*</span> :</label></td>
                                                      <td  class="form_text_fild form_text_fild-112" style="width:120px;"><span id="lesf"><?php //echo $site_setting->currency_symbol;?></span><input name="task_to_price" id="task_to_price" style="margin-bottom:0; float:left;" class="form-control price-text select-width-2"  type="text" size="5" value="<?php if($task_to_price==0.00 || $task_to_price==0) { } else { echo $task_to_price; } ?>" />&nbsp;&nbsp;<p id="task_to_price_symbol" style="float:left; height:24px; margin-left:7px;"></p>&nbsp;<span id="task_to_priceInfo" style="height:5px;"></span></td>
                                                      <td id="task_to_priceTR" class="form_text form_text-1115" style="width:70px;"><label class="firts_img-1" style="padding-top:0px;">Till <span id="req" style="color:red;">*</span> :</label></td>
                                                      <td  class="form_text_fild form_text_fild-112" style="width:120px;"><span id="lesf"><?php //echo $site_setting->currency_symbol;?></span><input name="task_price" id="task_price" style="margin-bottom:0; float:left;" class="form-control price-text select-width-2"  type="text" size="5" value="<?php if($task_price==0.00 || $task_price==0) { } else { echo $task_price; } ?>" />&nbsp;&nbsp;<p id="task_price_symbol" style="float:left; height:24px; margin-left:7px;"></p>&nbsp;<span id="task_priceInfo" style="height:5px;"></span></td>
                                                  </tr>
                                              </table>
                                          </div>
                                    <div class="clear"></div>
                                </div>  
                            </div>
                            <div class="margin-between"></div>
                                <div class="clear"></div>
                                <div style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInRight;" data-wow-delay="0.5s" class="span3 wow fadeInRight animated dbright-task-1 dbright-task-13">
                                    <div class="dbright-task dbright-task-one dbright-task-one---1" style="text-align:left; margin-left:0px;">
                                        <?php echo $this->load->view($theme.'/layout/task/step_one_side_bar',$data); ?>  
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                
                                <div class="clear"></div>
                                <div class="area-ph">
                                <div class="" style="text-align:right;">
                                    <input type="submit" name="sub_step1" class="btn btn-default btn-post-btn" id="post_new_task" value="Fortsätt" style="margin-top:0px;">            
                                    
                                </div>
                            </div>
                    	</div>
					</div>
                </div>
                
                <div class="clear"></div>
	        </form>
    	    </div>
		</div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/validation.js"></script>
<link href="<?php echo base_url().getThemeName(); ?>/css/new_me.css" rel="stylesheet" type="text/css">
