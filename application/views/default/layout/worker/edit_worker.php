<style>
.form_design{ float: left;
 padding-left: 0;
 width: 100%;
}
.fieldset{
 border: 0 none;
    float: left;
    margin-top: 20px;
    padding: 0;
    width: 100%;
}
.mcats li {
list-style: none;
float: left;
width: 150px;
}
ul.mcats, ul.apque {
float: left;
width: 100%;
padding: 0;
margin: 0;
}
ul.mcats li, ul.apque li {
float: left;
width: 15%;
list-style: none;
padding: 4px;
margin: 0 0 10px 0;
font-family: Arial, Helvetica, sans-serif;
font-size: 12px;
}
ul.apque li {
width: 30%;
}
a.fpass {
padding: 8px 16px;
background: #d83a37;
color: #fff;
text-decoration: none;
margin: 0 10px 0 0;
font-family: Arial, Helvetica, sans-serif;
font-size: 12px;
border-radius: 5px;
}
</style>
<!--banner-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->

		<script type="application/javascript">
        function setchecked(elemName,status)
        {
            elem = document.getElementsByName(elemName);
            for(i=0;i<elem.length;i++){
                elem[i].checked=status;
            }
        }
        
        
        function showbgdiv(i)
        {
            if(i==1)
            {
                document.getElementById('add_more2').style.display='block';
                document.getElementById('addimg').style.display='block';
            }
            else
            {
                document.getElementById('add_more2').style.display='none';
                document.getElementById('addimg').style.display='none';
                document.getElementById('err1').style.display='none';
            }
            
        }
        
        function append_div2()
        {
            var tmp_div2 = document.createElement("div");
            tmp_div2.className = "";								
            
            var glry_cnt=document.getElementById('glry_cnt').value;
            
            if(glry_cnt<5)
            {
                document.getElementById('glry_cnt').value=parseInt(glry_cnt)+1;
                var num=parseInt(glry_cnt)+1;
                
                tmp_div2.id='galry'+num;
                
                var content='<div class="padB10 clear"></div>';		
                content=content + document.getElementById('more2').innerHTML;
                var str = '<div onclick="remove_gallery_div('+num+')" class="fr" style="text-align:left;float:left !important;font-weight:bold;cursor:pointer;color:#ec6600;">Remove</div><div class="clear"></div>';			
                tmp_div2.innerHTML = content +str;	
            
                document.getElementById('add_more2').appendChild(tmp_div2);
                
                if(parseInt(glry_cnt)+1>=5)
                {
                    document.getElementById('addimg').style.display='none';
                }
            }
            else
            {
                document.getElementById('addimg').style.display='none';
            }
                                    
            
        }
        
        
        function remove_gallery_div(id)
        {						
                var element = document.getElementById('galry'+id);
                var add_more = parent.document.getElementById('add_more2');
                
                var add_parent=add_more.parentNode.offsetHeight;			
                var remove_height=parseInt(element.offsetHeight)+20;		
                var final_height=add_parent - remove_height;	
                
                element.parentNode.removeChild(element);
                add_more.parentNode.style.height = final_height+'px';
                
                var glry_cnt=document.getElementById('glry_cnt').value;
                document.getElementById('glry_cnt').value=parseInt(glry_cnt)-1;
                    
                document.getElementById('addimg').style.display='block';
            
            }
        
        
        function submitattachment_valid()
        {
            
            var bgchk=document.workerApplyForm.worker_background[0].checked;
            var check=false;
            
            var glry_cnt=document.getElementById('glry_cnt').value;
        
            if(bgchk==true)
            {
            
                var chks = document.getElementsByName('file_up[]');
         
                var hasChecked = false;
             
                
                if(glry_cnt==1)
                {
                
                    for (var i = 0; i < chks.length; i++)
                    {
                            if (chks[i].value=='')
                            {
                                    check=false;
                                    var dv = document.getElementById('err1');
                                    
                                    dv.className = "error";
                                    dv.style.clear = "both";
                                    dv.style.minWidth = "110px";
                                    dv.style.margin = "5px";
                                    dv.innerHTML ='<ul><p>Attachment is required.</p></ul>';
                                    dv.style.display='block';						
                                    hasChecked = true;                        
                                    
                            }
                            else 
                            {						
                                    value = chks[i].value;
                                    t1 = value.substring(value.lastIndexOf('.') + 1,value.length);
                                    if( t1=='jpg' || t1=='jpeg' || t1=='gif' || t1=='png' || t1=='JPEG' || t1=='JPG'  ||  t1=='PNG' || t1=='GIF' || t1=='pdf' || t1=='PDF')
                                    {
                                        document.getElementById('err1').style.display='none';
                                        check=true;
                                    }
                                    else
                                    {							
                                        check=false;
                                        var dv = document.getElementById('err1');
                                        
                                        dv.className = "error";
                                        dv.style.clear = "both";
                                        dv.style.minWidth = "110px";
                                        dv.style.margin = "5px";
                                        dv.innerHTML = '<ul><p>Attachment type is not valid.</p></ul>';
                                        dv.style.display='block';
                                        hasChecked = true;							
                                                    
                                    }
                            
                            }
                                            
                    }
                
                }
                else
                {
                    check=true;
                }
                
                if(check==false)
                {
                    return false;
                }
                else { return true; }
                
            } else {   return true; } 
                
             
             
             
        }
        
        
        $(document).ready(function(){
            $('#apply').click(function(){
             validate_apply();	
            });
                
            validate_apply();
            
            function validate_apply()
            {
                var form = $("#workerApplyForm");
                var alphanum=/^[a-zA-Z0-9]+$/;
                
                var worker_cities_symbol = $("#worker_cities_symbol");
                var worker_cities = $("#worker_cities");
                var worker_citiesInfo = $("#worker_citiesInfo");
                
                var worker_location_name_symbol = $("#worker_location_name_symbol");
                var worker_location_name = $("#worker_location_name");
                var worker_location_nameInfo = $("#worker_location_nameInfo");
                
                var worker_zipcode_symbol = $("#worker_zipcode_symbol");
                var worker_zipcode = $("#worker_zipcode");
                var worker_zipcodeInfo = $("#worker_zipcodeInfo");
                
                var worker_address_symbol = $("#worker_address_symbol");
                var worker_address = $("#worker_address");
                var worker_addressInfo = $("#worker_addressInfo");
                
                var worker_city_symbol = $("#worker_city_symbol");
                var worker_city = $("#worker_city");
                var worker_cityInfo = $("#worker_cityInfo");
                
                var worker_state_symbol = $("#worker_state_symbol");
                var worker_state = $("#worker_state");
                var worker_stateInfo = $("#worker_stateInfo");
                
                var travel_range_symbol = $("#travel_range_symbol");
                var travel_range = $("#worker_home_neighborhood");
                var travel_rangeInfo = $("#travel_rangeInfo");
                
                var worker_task_type_symbol = $("#worker_task_type_symbol");
                var worker_task_typeInfo = $("#worker_task_typeInfo");
                
                var worker_transportation_symbol = $("#worker_transportation_symbol");
                var worker_transportationInfo = $("#worker_transportationInfo");
                
                var worker_skills_symbol = $("#worker_skills_symbol");
                var worker_skills = $("#worker_skills");
                var worker_skillsInfo = $("#worker_skillsInfo");
                
                var worker_devices_symbol = $("#worker_devices_symbol");
                var worker_devicesInfo = $("#worker_devicesInfo");
                
                var worker_Internet_symbol = $("#worker_Internet_symbol");
                var worker_Internet = $("#worker_Internet");
                var worker_InternetInfo = $("#worker_InternetInfo");
                
                var worker_available_day_symbol = $("#worker_available_day_symbol");
                var worker_available_dayInfo = $("#worker_available_dayInfo");
                
                var worker_available_time_symbol = $("#worker_available_time_symbol");
                var worker_available_timeInfo = $("#worker_available_timeInfo");
                
                var worker_availability_symbol = $("#worker_availability_symbol");
                var worker_availability = $("#worker_availability");
                var worker_availabilityInfo = $("#worker_availabilityInfo");
                
                var worker_hear_about_symbol = $("#worker_hear_about_symbol");
                var worker_hear_aboutInfo = $("#worker_hear_aboutInfo");
                
                //On click
                
                //On blur
                worker_cities.blur(validate_worker_cities);
                worker_location_name.blur(validate_worker_location_name);
                worker_zipcode.blur(validate_worker_zipcode);
                worker_address.blur(validate_worker_address);
                worker_city.blur(validate_worker_city);
                worker_state.blur(validate_worker_state);
                travel_range.blur(validate_travel_range);
                worker_skills.blur(validate_worker_skills);
                worker_availability.blur(validate_worker_availability);
                
                //On key up
                worker_cities.click(validate_worker_cities);
                worker_location_name.keyup(validate_worker_location_name);
                worker_zipcode.keyup(validate_worker_zipcode);
                worker_address.keyup(validate_worker_address);
                worker_city.keyup(validate_worker_city);
                worker_state.keyup(validate_worker_state);
                travel_range.change(validate_travel_range);
                $("#not_select").click(validate_worker_task_type);
                $("#all_select").click(validate_worker_task_type);
                $('input[name="worker_task_type[]"]').click(validate_worker_task_type);
                $('input[name="worker_transportation[]"]').click(validate_worker_transportation);
                worker_skills.keyup(validate_worker_skills);
                $('input[name="worker_devices[]"]').click(validate_worker_devices);
                $('input[name=worker_Internet]').click(validate_worker_Internet);
                $('input[name="worker_available_day[]"]').click(validate_worker_available_day);
                $('input[name="worker_available_time[]"]').click(validate_worker_available_time);
                worker_availability.keyup(validate_worker_availability);
                $('input[name="worker_hear_about[]"]').click(validate_worker_hear_about);
                
                //On Submitting
                form.submit(function(){
                   if(validate_worker_cities() & validate_worker_location_name() &  validate_worker_address() & validate_worker_city() & validate_worker_task_type() & validate_worker_transportation() & validate_worker_skills()  & validate_worker_available_day() & validate_worker_available_time())
                        return true
                   else
                        return false;
                });
                
                //validation functions
                function validate_worker_cities()
                {	
                    if(worker_cities.val()=='')
                    {
                        worker_cities_symbol.removeClass("tick_mark");
                        worker_cities_symbol.removeClass("cross_mark");
                        worker_cities.addClass("error1");
                        worker_citiesInfo.text("Please choose Cities!");
                        worker_citiesInfo.addClass("error1");
                        
                        return false;
                    }
                    //if it's valid
                    else
                    {
                        worker_cities.removeClass("error1");
                        worker_citiesInfo.text("");
                        worker_citiesInfo.removeClass("error1");
                        worker_citiesInfo.addClass("success");
                        worker_cities_symbol.removeClass("cross_mark");
                        worker_cities_symbol.addClass("tick_mark");
                        return true;
                        
                    }
                }
                
                function validate_worker_location_name()
                {	
                    if(worker_location_name.val()=='')
                    {
                        worker_location_name_symbol.removeClass("tick_mark");
                        worker_location_name_symbol.removeClass("cross_mark");
                        worker_location_name.addClass("error1");
                        worker_location_nameInfo.text("Enter Location name!");
                        worker_location_nameInfo.addClass("error1");
                        
                        return false;
                    }
                    //if it's NOT valid
                    else if(worker_location_name.val().length < 4)
                    {
                        worker_location_name.addClass("error1");
                        worker_location_nameInfo.text("4 letters minimum required!");
                        worker_location_nameInfo.addClass("error1");
                        worker_location_name_symbol.removeClass("tick_mark");
                        worker_location_name_symbol.addClass("cross_mark");
                        return false;
                    }
                    //if it's valid
                    else
                    {
                        worker_location_name.removeClass("error1");
                        worker_location_nameInfo.text("");
                        worker_location_nameInfo.removeClass("error1");
                        worker_location_nameInfo.addClass("success");
                        worker_location_name_symbol.removeClass("cross_mark");
                        worker_location_name_symbol.addClass("tick_mark");
                        return true;
                        
                    }
                }
                
                function validate_worker_zipcode()
                {	
                    var a = $("#worker_zipcode").val();
                    var filter = alphanum;
                
                    if(worker_zipcode.val()=='')
                    {
                        worker_zipcode_symbol.removeClass("tick_mark");
                        worker_zipcode_symbol.removeClass("cross_mark");
                        worker_zipcode.addClass("error1");
                        worker_zipcodeInfo.text("Enter Post code!");
                        worker_zipcodeInfo.addClass("error1");
                        
                        return false;
                    }
                    //if it's NOT valid
                    else if(worker_zipcode.val().length < 4)
                    {
                        worker_zipcode.addClass("error1");
                        worker_zipcodeInfo.text("4 letters minimum required!");
                        worker_zipcodeInfo.addClass("error1");
                        worker_zipcode_symbol.removeClass("tick_mark");
                        worker_zipcode_symbol.addClass("cross_mark");
                        return false;
                    }
                    else 
                    {
                        //if it's valid number
                        if(filter.test(a))
                        {
                            worker_zipcode.removeClass("error1");
                            worker_zipcodeInfo.text("");
                            worker_zipcodeInfo.removeClass("error1");	
                            worker_zipcodeInfo.addClass("success");
                            worker_zipcode_symbol.removeClass("cross_mark");
                            worker_zipcode_symbol.addClass("tick_mark");
                            return true;
                        }
                        //if it's NOT valid
                        else
                        {
                            worker_zipcode.addClass("error1");
                            worker_zipcodeInfo.text("Enter valid post code without any space.");
                            worker_zipcodeInfo.addClass("error1");
                            worker_zipcode_symbol.removeClass("tick_mark");
                            worker_zipcode_symbol.addClass("cross_mark");
                            return false;
                        }
                    }
                }
                
                function validate_worker_address()
                {	
                    if(worker_address.val()=='')
                    {
                        worker_address_symbol.removeClass("tick_mark");
                        worker_address_symbol.removeClass("cross_mark");
                        worker_address.addClass("error1");
                        worker_addressInfo.text("Enter Address!");
                        worker_addressInfo.addClass("error1");
                        
                        return false;
                    }
                    //if it's NOT valid
                    else if(worker_address.val().length < 2)
                    {
                        worker_address.addClass("error1");
                        worker_addressInfo.text("2 letters minimum required!");
                        worker_addressInfo.addClass("error1");
                        worker_address_symbol.removeClass("tick_mark");
                        worker_address_symbol.addClass("cross_mark");
                        return false;
                    }
                    //if it's valid
                    else
                    {
                        worker_address.removeClass("error1");
                        worker_addressInfo.text("");
                        worker_addressInfo.removeClass("error1");
                        worker_addressInfo.addClass("success");
                        worker_address_symbol.removeClass("cross_mark");
                        worker_address_symbol.addClass("tick_mark");
                        return true;
                    }
                }
                
                function validate_worker_city()
                {	
                    if(worker_city.val()=='')
                    {
                        worker_city_symbol.removeClass("tick_mark");
                        worker_city_symbol.removeClass("cross_mark");
                        worker_city.addClass("error1");
                        worker_cityInfo.text("Enter City!");
                        worker_cityInfo.addClass("error1");
                        
                        return false;
                    }
                    //if it's NOT valid
                    else if(worker_city.val().length < 2)
                    {
                        worker_city.addClass("error1");
                        worker_cityInfo.text("2 letters minimum required!");
                        worker_cityInfo.addClass("error1");
                        worker_city_symbol.removeClass("tick_mark");
                        worker_city_symbol.addClass("cross_mark");
                        return false;
                    }
                    //if it's valid
                    else
                    {
                        worker_city.removeClass("error1");
                        worker_cityInfo.text("");
                        worker_cityInfo.removeClass("error1");
                        worker_cityInfo.addClass("success");
                        worker_city_symbol.removeClass("cross_mark");
                        worker_city_symbol.addClass("tick_mark");
                        return true;
                        
                    }
                }
                
                function validate_worker_state()
                {	
                    if(worker_state.val()=='')
                    {
                        worker_state_symbol.removeClass("tick_mark");
                        worker_state_symbol.removeClass("cross_mark");
                        worker_state.addClass("error1");
                        worker_stateInfo.text("Enter State!");
                        worker_stateInfo.addClass("error1");
                        
                        return false;
                    }
                    //if it's NOT valid
                    else if(worker_state.val().length < 2)
                    {
                        worker_state.addClass("error1");
                        worker_stateInfo.text("2 letters minimum required!");
                        worker_stateInfo.addClass("error1");
                        worker_state_symbol.removeClass("tick_mark");
                        worker_state_symbol.addClass("cross_mark");
                        return false;
                    }
                    //if it's valid
                    else
                    {
                        worker_state.removeClass("error1");
                        worker_stateInfo.text("");
                        worker_stateInfo.removeClass("error1");
                        worker_stateInfo.addClass("success");
                        worker_state_symbol.removeClass("cross_mark");
                        worker_state_symbol.addClass("tick_mark");
                        return true;
                        
                    }
                }
                
                function validate_travel_range()
                {	
                    if(travel_range.val()=='')
                    {
                        travel_range_symbol.removeClass("tick_mark");
                        travel_range_symbol.removeClass("cross_mark");
                        travel_range.addClass("error1");
                        travel_rangeInfo.text("Please select Travel range!");
                        travel_rangeInfo.addClass("error1");
                        
                        return false;
                    }
                    //if it's valid
                    else
                    {
                        travel_range.removeClass("error1");
                        travel_rangeInfo.text("");
                        travel_rangeInfo.removeClass("error1");
                        travel_rangeInfo.addClass("success");
                        travel_range_symbol.removeClass("cross_mark");
                        travel_range_symbol.addClass("tick_mark");
                        return true;
                        
                    }
                }
                
                function validate_worker_task_type()
                {	
                    var checked_num = $('input[name="worker_task_type[]"]:checked').length > 0;
                    if (!checked_num)
                    {
                        worker_task_type_symbol.removeClass("tick_mark");
                        worker_task_type_symbol.removeClass("cross_mark");
                        worker_task_typeInfo.text("At least one Task types has to be selected!");
                        worker_task_typeInfo.addClass("error1");
                        
                        return false;
                        
                    }
                    //if it's valid
                    else
                    {
                        worker_task_typeInfo.text("");
                        worker_task_typeInfo.removeClass("error1");
                        worker_task_typeInfo.addClass("success");
                        worker_task_type_symbol.removeClass("cross_mark");
                        worker_task_type_symbol.addClass("tick_mark");
                        return true;
                        
                    }
                }
                
                function validate_worker_transportation()
                {	
                    var checked_num = $('input[name="worker_transportation[]"]:checked').length > 0;
                    if (!checked_num)
                    {
                        worker_transportation_symbol.removeClass("tick_mark");
                        worker_transportation_symbol.removeClass("cross_mark");
                        worker_transportationInfo.text("At least one Transportation has to be selected!");
                        worker_transportationInfo.addClass("error1");
                        
                        return false;
                        
                    }
                    //if it's valid
                    else
                    {
                        worker_transportationInfo.text("");
                        worker_transportationInfo.removeClass("error1");
                        worker_transportationInfo.addClass("success");
                        worker_transportation_symbol.removeClass("cross_mark");
                        worker_transportation_symbol.addClass("tick_mark");
                        return true;
                        
                    }
                }
                
                function validate_worker_skills()
                {	
                    if(worker_skills.val()=='')
                    {
                        worker_skills_symbol.removeClass("tick_mark");
                        worker_skills_symbol.removeClass("cross_mark");
                        worker_skills.addClass("error1");
                        worker_skillsInfo.text("Enter Talents, skills, and qualities contribute!");
                        worker_skillsInfo.addClass("error1");
                        
                        return false;
                    }
                    //if it's NOT valid
                    else if(worker_skills.val().length < 20)
                    {
                        worker_skills.addClass("error1");
                        worker_skillsInfo.text("20 characters minimum required!");
                        worker_skillsInfo.addClass("error1");
                        worker_skills_symbol.removeClass("tick_mark");
                        worker_skills_symbol.addClass("cross_mark");
                        return false;
                    }
                    //if it's valid
                    else
                    {
                        worker_skills.removeClass("error1");
                        worker_skillsInfo.text("");
                        worker_skillsInfo.removeClass("error1");
                        worker_skillsInfo.addClass("success");
                        worker_skills_symbol.removeClass("cross_mark");
                        worker_skills_symbol.addClass("tick_mark");
                        return true;
                        
                    }
                }
                
                function validate_worker_devices()
                {	
                    var checked_num = $('input[name="worker_devices[]"]:checked').length > 0;
                    if (!checked_num)
                    {
                        worker_devices_symbol.removeClass("tick_mark");
                        worker_devices_symbol.removeClass("cross_mark");
                        worker_devicesInfo.text("At least one Device has to be selected!");
                        worker_devicesInfo.addClass("error1");
                        
                        return false;
                        
                    }
                    //if it's valid
                    else
                    {
                        worker_devicesInfo.text("");
                        worker_devicesInfo.removeClass("error1");
                        worker_devicesInfo.addClass("success");
                        worker_devices_symbol.removeClass("cross_mark");
                        worker_devices_symbol.addClass("tick_mark");
                        return true;
                        
                    }
                }
                
                function validate_worker_Internet()
                {
                    if($('input[name=worker_Internet]:checked').length<=0)
                    {
                        worker_Internet_symbol.removeClass("tick_mark");
                        worker_Internet_symbol.removeClass("cross_mark");
                        worker_Internet.addClass("error1");
                        worker_InternetInfo.text("At least one Comfortable Internet field has to be selected!");
                        worker_InternetInfo.addClass("error1");
                        
                        return false;
                    }
                    //if it's valid
                    else
                    {
                        worker_Internet.removeClass("error1");
                        worker_InternetInfo.text("");
                        worker_InternetInfo.removeClass("error1");
                        worker_InternetInfo.addClass("success");
                        worker_Internet_symbol.removeClass("cross_mark");
                        worker_Internet_symbol.addClass("tick_mark");
                        return true;
                        
                    }
                }
                
                function validate_worker_available_day()
                {	
                    var checked_num = $('input[name="worker_available_day[]"]:checked').length > 0;
                    if (!checked_num)
                    {
                        worker_available_day_symbol.removeClass("tick_mark");
                        worker_available_day_symbol.removeClass("cross_mark");
                        worker_available_dayInfo.text("At least one Available Day has to be selected!");
                        worker_available_dayInfo.addClass("error1");
                        
                        return false;
                        
                    }
                    //if it's valid
                    else
                    {
                        worker_available_dayInfo.text("");
                        worker_available_dayInfo.removeClass("error1");
                        worker_available_dayInfo.addClass("success");
                        worker_available_day_symbol.removeClass("cross_mark");
                        worker_available_day_symbol.addClass("tick_mark");
                        return true;
                        
                    }
                }
                
                function validate_worker_available_time()
                {	
                    var checked_num = $('input[name="worker_available_time[]"]:checked').length > 0;
                    if (!checked_num)
                    {
                        worker_available_time_symbol.removeClass("tick_mark");
                        worker_available_time_symbol.removeClass("cross_mark");
                        worker_available_timeInfo.text("At least one Available Time has to be selected!");
                        worker_available_timeInfo.addClass("error1");
                        
                        return false;
                        
                    }
                    //if it's valid
                    else
                    {
                        worker_available_timeInfo.text("");
                        worker_available_timeInfo.removeClass("error1");
                        worker_available_timeInfo.addClass("success");
                        worker_available_time_symbol.removeClass("cross_mark");
                        worker_available_time_symbol.addClass("tick_mark");
                        return true;
                        
                    }
                }
                
                function validate_worker_availability()
                {	
                    if(worker_availability.val()=='')
                    {
                        worker_availability_symbol.removeClass("tick_mark");
                        worker_availability_symbol.removeClass("cross_mark");
                        worker_availability.addClass("error1");
                        worker_availabilityInfo.text("Enter Anything else you would like us to know about your availability!");
                        worker_availabilityInfo.addClass("error1");
                        
                        return false;
                    }
                    //if it's NOT valid
                    else if(worker_availability.val().length < 20)
                    {
                        worker_availability.addClass("error1");
                        worker_availabilityInfo.text("20 characters minimum required!");
                        worker_availabilityInfo.addClass("error1");
                        worker_availability_symbol.removeClass("tick_mark");
                        worker_availability_symbol.addClass("cross_mark");
                        return false;
                    }
                    //if it's valid
                    else
                    {
                        worker_availability.removeClass("error1");
                        worker_availabilityInfo.text("");
                        worker_availabilityInfo.removeClass("error1");
                        worker_availabilityInfo.addClass("success");
                        worker_availability_symbol.removeClass("cross_mark");
                        worker_availability_symbol.addClass("tick_mark");
                        return true;
                    }
                }
                
                function validate_worker_hear_about()
                {	
                    var checked_num = $('input[name="worker_hear_about[]"]:checked').length > 0;
                    if (!checked_num)
                    {
                        worker_hear_about_symbol.removeClass("tick_mark");
                        worker_hear_about_symbol.removeClass("cross_mark");
                        worker_hear_aboutInfo.text("At least one field has to be selected!");
                        worker_hear_aboutInfo.addClass("error1");
                        
                        return false;
                    }
                    //if it's valid
                    else
                    {
                        worker_hear_aboutInfo.text("");
                        worker_hear_aboutInfo.removeClass("error1");
                        worker_hear_aboutInfo.addClass("success");
                        worker_hear_about_symbol.removeClass("cross_mark");
                        worker_hear_about_symbol.addClass("tick_mark");
                        return true;
                    }
                }
                
                
            }
        
        });
        </script>
		<?php 
		$site_setting=site_setting();
		//$attributes = array('name'=>'workerApplyForm','id'=>'workerApplyForm','onsubmit'=>'return submitattachment_valid()');
		$attributes = array('name'=>'workerApplyForm','id'=>'workerApplyForm','class'=>'form_design','onsubmit'=>'return submitattachment_valid()');
		echo form_open_multipart('worker/edit',$attributes);
		?>
        <div class="red-subtitle top-red-subtitle">TASKER APPLICATION FORM : <?php echo $this->session->userdata('full_name'); ?></div>
    	<div class="profile_back">
            <div class="container" style="padding-top:20px; padding-bottom:20px;">
                <div class="" style="background:#e7e7e7 !important; overflow:hidden; border-radius:10px;">
                    <div class="">
                        <!--<ul class="appul">
                        	<h1 class="social-login-title" style="margin-top:75px; margin-bottom:20px;"><b>Welcome to the Tasker  application process!</b></h1>
                            <li>
                            	<div class="container">
                                    <div style="float:left; width:100%; margin:0px 0 85px 0">
                                        <ul class="three-columnar three-columnar-new">
                                            <div class="span3 wow fadeIn animated animated" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;">
                                                <li class="left">
                                                    <div class="process-step">
                                                        <div class="round-number">01</div>
                                                        <h2 style="margin:0; float:left; width:100%; text-align:center; font-size:24px" class="how-business">APPLY ONLINE</h2>
                                                        <div class="blogger-comment">Fill in this application form.</div>
                                                    </div>
                                                </li>	
                                            </div>
                                            <div class="span3 wow fadeIn animated arrow arrow-2 animated" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;"></div>
                                            <div class="span3 wow fadeIn animated animated" data-wow-delay="0.7s" style="visibility: visible; animation-delay: 0.7s; animation-name: fadeIn;">	
                                                <li class="center">
                                                	<div class="process-step">
                                                        <div class="round-number">02</div>
                                                        
                                                        <h2 style="margin:0; float:left; width:100%; text-align:center; font-size:24px" class="how-business">GET VERIFIED</h2>
                                                        <div class="blogger-comment">We're big on trust and safety, so we require identity verification and appropriate documentation before we can approve your Tasker application.</div>
                                                    </div>
                                                </li>
                                            </div>
                                            <div class="span3 wow fadeIn animated arrow arrow-2 animated" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeIn;"></div>
                                            <div class="span3 wow fadeIn animated animated" data-wow-delay="1s" style="visibility: visible; animation-delay: 1s; animation-name: fadeIn;">
                                                <li class="right">
                                                	<div class="process-step">
                                                        <div class="round-number">03</div>
                                                        
                                                        <h2 style="margin:0; float:left; width:100%; text-align:center; font-size:24px" class="how-business">START TASKING</h2>
                                                        <div class="blogger-comment">Specify your skills and interests and connect with local people who want to work with you. Once approved you can start working!</div>
                                                    </div>
                                                </li>	
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>-->
                        <div class="clear"></div>
                        <div class="red-subtitle top-red-subtitle">Section 1</div>
                        <ul class="appul">
                            <li>   
								<?php if($error != '') { ?>     
                                <div id="error"> 
                                        <div class="follfi">There were problems with the following fields:</div>
                                        <ul>
                                            <?php echo $error; ?>
                                        </ul>
                                </div>
                                <?php } ?>
           	 				</li> 
                            <?php if($this->uri->segment(3)=="msg") { ?> 
                            <li>
                               <div style="text-align: center;color: green;font-size: 20px;">Your Tasker profile has been updated successfully</div>
                                
                            </li>
                            <?php 
                            header("Refresh:5;url=".base_url()."dashboard");
                            } ?>
                       	</ul>
                        <div class="clear"></div>
                        <div class="container data-info">
                            <div class="span3 wow fadeInLeft center animated animated" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInLeft;">
                                <div class="right-block" style="float:left; padding-left:25px;">
                                    <ul class="appul">                   
                                        <li>
                                            <h3 class="home-title">Details from your <a href="<?php echo base_url(); ?>account">account</a></h3>
                                        </li>
                                        <table width="100%" border="0" cellspacing="1" cellpadding="5" class="apptab1 apptab1-1">
                                            <tr>
                                                <td width="25%" style="float:left;"><h4>Email : </h4></td>
                                                <td width="54%" style="float:left;"><?php echo $user_info->email; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" height="15"></td>
                                            </tr>
                                            <tr>
                                                <td width="25%" style="float:left;"><h4>First Name : </h4></td>
                                                <td width="54%" style="float:left;"><?php echo $user_info->first_name; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" height="15"></td>
                                            </tr>
                                            <tr>
                                                <td width="25%" style="float:left;"><h4>Last Name : </h4></td>
                                                <td width="54%" style="float:left;"><?php echo $user_info->last_name; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" height="15"></td>
                                            </tr>
                                            <tr>
                                                <td width="25%" style="float:left;"><h4>Mobile Phone : </h4></td>
                                                <td width="54%" style="float:left;"><?php echo $user_info->mobile_no; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" height="15"></td>
                                            </tr>
                                            
                                        </table>
                                    </ul>
                                </div>
                            </div>
                            <div class="span3 wow fadeInRight center animated animated" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInRight;">
                                <div class="left-block left-block-15" style="float:right; padding-right:25px;">
                                    <ul class="appul">
                                        <li>
                                            <h3 class="home-title">Home Address</h3>
                                            <table width="100%" border="0" cellspacing="1" cellpadding="5" class="apptab1 apptab1-1">
                                               <tr>
                                                <td width="25%" style="float:left;"><h4>Location <span id="req" style="color:red;">*</span> : </h4></td>
                                                <td width="69%" style="float:left;"><input name="worker_location_name" id="worker_location_name" type="text" class="ntexttf form-control" value="<?php echo $worker_location_name; ?>" style="width:300px;"/><span id="worker_location_name_symbol" style="float:right; height:20px;"></span><br /><span id="worker_location_nameInfo" style="height:20px; display:block;"></span></td>
                                              </tr>
                                              
                                             <!-- <tr>
                                                <td width="25%" style="float:left;"><h4>Postal Code  : </h4></td>
                                                <td width="69%" style="float:left;"><input name="worker_zipcode" id="worker_zipcode" type="text" class="ntexttf form-control" value="<?php echo $worker_zipcode; ?>" style="width:300px;"/><span id="worker_zipcode_symbol" style="float:right; height:20px;"></span><br /><span id="worker_zipcodeInfo" style="height:20px; display:block;"></span></td>
                                              </tr>-->
                                              
                                               <tr>
                                                <td width="25%" style="float:left;"><h4>Address <span id="req" style="color:red;">*</span> : </h4></td>
                                                <td width="69%" style="float:left;"><input name="worker_address" type="text" class="ntexttf form-control" value="<?php echo $worker_address; ?>" id="worker_address" style="width:300px;"/><span id="worker_address_symbol" style="float:right; height:20px;"></span><br /><span id="worker_addressInfo" style="height:20px; display:block;"></span></td>
                                              </tr>
                                              
                                              <tr>
                                                <td width="25%" style="float:left;"><h4>City <span id="req" style="color:red;">*</span> : </h4></td>
                                                <td width="69%" style="float:left;"><input name="worker_city" type="text" class="ntexttf form-control" value="<?php echo $worker_city; ?>" id="worker_city" style="width:300px;"/><span id="worker_city_symbol" style="float:right; height:20px;"></span><br /><span id="worker_cityInfo" style="height:20px; display:block;"></span></td>
                                              </tr>
                                              
                                              <tr>
                                                <td width="25%" style="float:left;"><h4>State : </h4></td>
                                                <td width="69%" style="float:left;"><input name="worker_state" type="text" class="ntexttf form-control" value="<?php echo $worker_state; ?>" id="worker_state" style="width:300px;"/><span id="worker_state_symbol" style="float:right; height:20px;"></span><br /><span id="worker_stateInfo" style="height:20px; display:block;"></span></td>
                                              </tr>
                                              
                                             <?php /*?> <tr>
                                                <td class="selhov">
                                                  <label>
                                                    <input type="checkbox" name="save_location" value="1" id="save_location" <?php if($save_location==1) { ?> checked="checked" <?php } ?> />
                                                    Save this location</label>
                                                </td>
                                              </tr><?php */?>
                                              
                                              
                                              
                                             <!-- <tr>
                                                <td><h4>Work neighborhood</h4><input name="worker_work_neighborhood" type="text" class="ntexttf" value="<?php echo $worker_work_neighborhood; ?>" id="worker_work_neighborhood"/></td>
                                              </tr>-->
                                              </table>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                        <div class="clear"></div>
                        <div class="red-subtitle top-red-subtitle">Section 2</div>
                        <div class="container data-block-2">
                            <ul class="appul" style="margin-top:0px; padding-left:25px; padding-right:25px;">
                                <li>
                                	<div class="span3 wow fadeIn animated animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                                	<table width="100%" border="0" cellspacing="1" cellpadding="5" class="apptab1 apptab1-1">
                                    	<script type='text/javascript'>
											function get_city(city_id)
											{
													
													jQuery.ajax({
																type:'POST',
																url:'<?php echo base_url()?>task/task_city/',
																data:{'state_id':city_id},
																success:function(list){
																	if(list.search(/\S/)!=-1){
																		list1 = '<option value="">Select City</option>'+list;
																		jQuery('#worker_cities').html(list1);
																		}
																	}
															});
			
			
											}
			
											</script>
                                      <tr>
                                        <td colspan="2">
                                            <h4 class="home-title home-title-2">Please select the areas that you are able to work, you may select multiple town/cities</h4><br />
                                        </td>
                                    </tr>
                                      <tr>
                                          <td width="12%" style="float:left; padding-top:6px; color:#565656;"><h4>Country : </h4></td>
                                          <td width="54%" style="float:left;">
                                              <select name="task_state_id" id="task_state_id" class="selboxwi200 form-control" style="margin-bottom:0px; width:200px; float:left;" onchange="get_city(this.value)">
                                                  <option value="" >--Please Select Country--</option>
                                                  <?php 
                                                      if($state_list){
                                                          foreach($state_list as $key=>$val){
                                                  ?>
                                                  <option value="<?php echo $val['state_id']; ?>" <?php if($task_state_id==$val['state_id']) { ?> selected="selected" <?php }  ?>><?php echo ucfirst($val['state_name']); ?></option>
                                                  <?php
                                                          }
                                                      }
                                                  ?>
                                              </select>
                                              <p id="worker_cities_symbol" style="float:left; padding-left:10px; padding-top:13px;"></p><span id="worker_citiesInfo" style=" display:block; clear:both;"></span>
                                          </td>
                                      </tr>
                                      <?php //echo $worker_sate_citys;?>

                                      <tr>
                                          <td width="12%" style="float:left; padding-top:10px; color:#565656"><h4>Cities : </h4></td>
                                          <td width="74%" style="float:left;">
                                              <select name="worker_cities[]" id="worker_cities" class="selboxwi200" multiple="multiple"  style="height:90px; margin-top:10px; float:left;width:200px;" >
                                      <option value=""  selected="selected">--Select--</option>
                                      <?php 
                                          
                                          foreach ($worker_sate_citys as $wcity){  ?>
                                          
                                              <option value="<?php echo $wcity['city_id'];?>" <?php if($worker_citys) {  if(in_array($wcity['city_id'],$worker_cities)) { ?> selected="selected" <?php } }  ?>><?php echo $wcity['city_name'];?></option>
                                          <?php } 
                                      ?>
                                      </select>
                                      <div class="clear"></div>
                                          <span id="req" style="color:red; margin-left:-11px;">*</span><span style="font-weight:normal; font-size:14px;">(You can select multiple cities by holding Ctrl key)</span>
                                              <p id="worker_cities_symbol" style="float:left; height:20px; padding-left:10px;"></p><br /><span id="worker_citiesInfo" style="height:20px; display:block;"></span>
                                          </td>
                                      </tr>
                                      <tr>
                                                <td width="12%" style="float:left; padding-top:6px; color:#565656;"><h4>Travel range <span id="req" style="color:red;">*</span> : </h4></td>
                                                <td width="54%" style="float:left;">
                                                <select name="worker_home_neighborhood" id="worker_home_neighborhood" class="form-control select-control">
                                                    <option value="" <?php if($worker_home_neighborhood=="") echo 'selected'; ?>>--Select--</option>
                                                    <option value="1" <?php if($worker_home_neighborhood==1) echo 'selected'; ?>>Up to 10 kilometers</option>
                                                    <option value="2" <?php if($worker_home_neighborhood==2) echo 'selected'; ?>>Up to 20 kilometers</option>
                                                    <option value="3" <?php if($worker_home_neighborhood==3) echo 'selected'; ?>>Up to 30 kilometers</option>
                                                </select><span id="travel_range_symbol" style="float:left; height:20px; padding:10px 0 0 10px;"></span><br /><span id="travel_rangeInfo" style="height:20px; display:block;"></span>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td colspan="2" height="15"></td>
                                            </tr>
                                    </table>
                                    </div>
                                    <table width="100%" border="0" cellspacing="1" cellpadding="5" class="apptab1">
                                       
                                       <tr>
                                        <td>
                                    
                                      
                                        <div class="span3 wow fadeIn animated animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                                        <h4 class="home-title home-title-2">Select the type of Tasks you would like to do  you will be notified when someone posts a matching Task (you can edit this later)<span id="req" style="color:red;">*</span></h4><br />
                                    
                                         <a href="javascript:void(0)" onclick="javascript:setchecked('worker_task_type[]',1)" class="btn btn-default">Select all</a> ,  <a href="javascript:void(0)" onclick="javascript:setchecked('worker_task_type[]',0)" class="btn btn-default">Select none</a><span id="worker_task_type_symbol" style="float:right; height:20px; margin-right:740px;"></span><span id="worker_task_typeInfo" style="height:20px;padding-top:10px; display:block;"></span>
                                    
                                    		<div class="clear"></div>
                                            <ul class="mcats">
                                                <?php 
                                                
                                                $post_worker_task_type=array();
                                                
                                                if($worker_task_type)
                                                {
                                                    $post_worker_task_type=$worker_task_type;
                                                }
                                            
                                                    $cou = 0;
                                                    $categories = get_all_category();
                                                    if($categories) { 
                                                        foreach ($categories as $category){
															$cou++;
                                                            if(in_array($category->task_category_id,$post_worker_task_type)){  $checked= 'checked="checked"';} else { $checked=''; }
                                                            
                                                            echo '<li style="margin-bottom:10px; width:auto;"><label style="background: #ec6600; color: #fff; cursor: pointer; display: block; font-size: 14px;  margin: 0; padding: 10px; border-radius:10px;"><input name="worker_task_type[]" id="worker_task_type" type="checkbox" value="'.$category->task_category_id.'" '.$checked.' /> '.$category->category_name.'</label></li>';
															if($cou == 6)
															{
																//echo "</ul><ul class='mcats'>";
																$cou = 0;
															}
                                                        } 
                                                    }
                                    
                                                ?>
                                                <div class="clear"></div>
                                            </ul> 
                                            <div class="clear"></div>   
                                            </div>        
                                        </td>
                                      </tr>  
                                      <tr>
                                      	<td height="15"></td>
                                      </tr>
                                      <tr>
                                        <td>
                                        <div class="span3 wow fadeIn animated animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                                        <h4 style="float:left;" class="question">1.What means of transportation would you use to complete Tasks? <span id="req" style="color:red;">*</span></h4><p id="worker_transportation_symbol" style="float:left; height:12px; padding-left:10px;"></p><span id="worker_transportationInfo" style="display:block;"></span>
                                        <ul class="apque">
                                            <?php 
                                            
                                            $post_worker_transportation=array();
                                                
                                                if($worker_transportation)
                                                {
                                                    $post_worker_transportation=$worker_transportation;
                                                }
                                            
                                            
                                            
                                                    foreach ($transportations as $transportation){ 
                                                        if(in_array($transportation->transportation_id,$post_worker_transportation)){  $checked= 'checked="checked"';} else { $checked=''; }
                                                        
                                                        echo  '<li><label><input type="checkbox" name="worker_transportation[]" id="worker_transportation" value="'.$transportation->transportation_id.'" '.$checked.'/>&nbsp;&nbsp;'.$transportation->name.'</label></li>';
                                                    } 
                                            ?>
                                        </ul>
                                        </div>
                                       </td>
                                      </tr>
                                      <tr>
                                      	<td height="15"></td>
                                      </tr>
                                      <tr>
                                        <td>
                                        <div class="span3 wow fadeIn animated animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                                            <h4 class="question">2.mini- resume (write some things about yourself and your work carrier.) <span id="req" style="color:red;">*</span></h4>
                                            <textarea name="worker_skills" cols="72" rows="3" id="worker_skills" style="margin: 0px 0px 16px; width: 678px; height: 96px;"><?php echo $worker_skills; ?></textarea><span id="worker_skills_symbol" style="float:right; margin-right:315px"></span><br /><span id="worker_skillsInfo" style=" display:block;"></span>
                                            </div>
                                        </td>
                                      </tr>
                                      <tr>
                                      	<td height="15"></td>
                                      </tr>
                                      <!--<tr>
                                        <td>
                                        	<div class="span3 wow fadeIn animated animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                                        <h4 style="float:left;" class="question">3.What devices do you use in your everyday life? <span id="req" style="color:red;">*</span></h4><p id="worker_devices_symbol" style="float:left; height:12px; padding-left:10px;"></p><span id="worker_devicesInfo" style="display:block;"></span>
                                            <ul class="apque">
                                            
                                            <?php 
                                                    $post_worker_devices=array();
                                                
                                                if($worker_devices)
                                                {
                                                    $post_worker_devices=$worker_devices;
                                                }
                                                
                                                
                                                foreach ($devices as $device){ 
                                                    
                                                        if(in_array($device->device_id,$post_worker_devices)){  $checked= 'checked="checked"';} else { $checked=''; }
                                                        
                                                        echo  '<li><label><input type="checkbox" name="worker_devices[]" id="worker_devices" value="'.$device->device_id.'" '.$checked.'  />&nbsp;&nbsp;'.$device->device_name.'</label></li>';
                                                        
                                                    } 
                                            ?>
                                           
                                            </ul>
                                            </div>
                                        </td>
                                      </tr>
                                      <tr>
                                      	<td height="15"></td>
                                      </tr>-->
                                      <!--<tr>
                                        <td>
                                        	<div class="span3 wow fadeIn animated animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                                        <h4 style="float:left;" class="question">4. How comfortable are you in your use of the Internet? <span id="req" style="color:red;">*</span></h4><p id="worker_Internet_symbol" style="float:left; height:12px; padding-left:10px;"></p><span id="worker_InternetInfo" style="display:block;"></span>
                                            <ul class="apque">
                                            <li><label><input type="radio" name="worker_Internet" value="Novice" id="worker_Internet" <?php if($worker_Internet == 'Novice'){ echo 'checked="checked"';} ?> />&nbsp;&nbsp;Novice</label></li>
                                            <li><label><input type="radio" name="worker_Internet" value="Intermediate" id="worker_Internet" <?php if($worker_Internet == 'Intermediate'){ echo 'checked="checked"';} ?> />&nbsp;&nbsp;Intermediate</label></li>
                                            <li><label><input type="radio" name="worker_Internet" value="Advanced" id="worker_Internet" <?php if($worker_Internet == 'Advanced'){ echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Advanced</label></li>
                                            <li><label><input type="radio" name="worker_Internet" value="Hacker" id="worker_Internet" <?php if($worker_Internet == 'Hacker'){ echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Hacker</label></li>
                                            </ul>
                                            </div>
                                        </td>
                                      </tr> 
                                      <tr>
                                      	<td height="15"></td>
                                      </tr>-->
                                      <tr>
                                        <td>
                                        <?php 
                                        
                                        $post_worker_available_day=array();
                                                
                                                if($worker_available_day)
                                                {
                                                    $post_worker_available_day=$worker_available_day;
                                                }
                                                
                                                ?>
                                                <div class="span3 wow fadeIn animated animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                                        <h4 style="float:left;" class="question">3. What day of the week are you generally available ? <span id="req" style="color:red;">*</span></h4><p id="worker_available_day_symbol" style="float:left; height:12px; padding-left:10px;"></p><span id="worker_available_dayInfo" style="display:block;"></span>
                                        	<br />
                                        	<!--  <select name="worker_available_day[]" style="margin-bottom:0px; width:200px; float:left; clear:both;" class="selboxwi200 form-control">
                                                  <option value="Sunday">Sunday</option>
                                                  <option value="Monday">Monday</option>
                                                  <option value="Tuesday">Tuesday</option>
                                                  <option value="Wednesday">Wednesday</option>
                                                  <option value="Thursday">Thursday</option>
                                                  <option value="Friday">Friday</option>
                                                  <option value="Saturday">Saturday</option>
                                              </select>-->
                                        		<ul class="apque">
                                            <li><label><input type="checkbox" name="worker_available_day[]" value="Sunday" id="worker_available_day" <?php if(in_array('Sunday',$post_worker_available_day)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Sunday</label></li>
                                            
                                            <li><label><input type="checkbox" name="worker_available_day[]" value="Monday" id="worker_available_day" <?php if(in_array('Monday',$post_worker_available_day)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Monday</label></li>
                                            
                                            <li><label><input type="checkbox" name="worker_available_day[]" value="Tuesday" id="worker_available_day" <?php if(in_array('Tuesday',$post_worker_available_day)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Tuesday</label></li>
                                            
                                            <li><label><input type="checkbox" name="worker_available_day[]" value="Wednesday" id="worker_available_day" <?php if(in_array('Wednesday',$post_worker_available_day)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Wednesday</label></li>
                                            
                                            <li><label><input type="checkbox" name="worker_available_day[]" value="Thursday" id="worker_available_day" <?php if(in_array('Thursday',$post_worker_available_day)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Thursday</label></li>
                                            
                                            <li><label><input type="checkbox" name="worker_available_day[]" value="Friday" id="worker_available_day" <?php if(in_array('Friday',$post_worker_available_day)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Friday</label></li>
                                            
                                            <li><label><input type="checkbox" name="worker_available_day[]" value="Saturday" id="worker_available_day" <?php if(in_array('Saturday',$post_worker_available_day)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Saturday</label></li>
                                        </ul>
                                        </div>
                                        </td>
                                      </tr> 
                                      <tr>
                                      	<td height="15"></td>
                                      </tr>
                                      <tr>
                                        <td>
                                        
                                           <?php 
                                        
                                        $post_worker_available_time=array();
                                                
                                                if($worker_available_time)
                                                {
                                                    $post_worker_available_time=$worker_available_time;
                                                }
                                                
                                                ?>
                                                
                                           <div class="span3 wow fadeIn animated animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">     
                                        <h4 style="float:left;" class="question">4. What time of the day? <span id="req" style="color:red;">*</span></h4><p id="worker_available_time_symbol" style="float:left; height:12px; padding-left:10px;"></p><span id="worker_available_timeInfo" style="display:block;"></span>
                                        <ul class="apque">
                                            <li><label><input type="checkbox" name="worker_available_time[]" value="Morning" id="worker_available_time" <?php if(in_array('Morning',$post_worker_available_time)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Morning</label></li>
                                            
                                            <li><label><input type="checkbox" name="worker_available_time[]" value="Midday" id="worker_available_time" <?php if(in_array('Midday',$post_worker_available_time)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Midday</label></li>
                                            
                                            <li><label><input type="checkbox" name="worker_available_time[]" value="Afternoon" id="worker_available_time" <?php if(in_array('Afternoon',$post_worker_available_time)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Afternoon</label></li>
                                            
                                            <li><label><input type="checkbox" name="worker_available_time[]" value="Evening" id="worker_available_time" <?php if(in_array('Evening',$post_worker_available_time)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Evening</label></li>
                                            
                                            <li><label><input type="checkbox" name="worker_available_time[]" value="Last Night" id="worker_available_time" <?php if(in_array('Last Night',$post_worker_available_time)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Night</label></li>
                                        </ul>
                                        </div>
                                        </td>
                                      </tr> 
                                      <tr>
                                      	<td height="15"></td>
                                      </tr>
                                      <!--<tr>
                                        <td>
                                        <div class="span3 wow fadeIn animated animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                                            <h4 class="question">7. Anything else you&acute;d like us to know about your availability to do tasks? <span id="req" style="color:red;">*</span></h4>
                                            <textarea name="worker_availability" cols="72" rows="3" id="worker_availability"><?php echo $worker_availability; ?></textarea><p id="worker_availability_symbol" style="float:right; margin-right:315px"></p><br /><span id="worker_availabilityInfo" style=" display:block;"></span>
                                            </div>
                                        </td>
                                      </tr>
                                      <tr>
                                      	<td height="15"></td>
                                      </tr>-->
                                      <!--<tr>
                                        <td>
                                        <div class="span3 wow fadeIn animated animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                                    <h4 style="float:left;" class="question">8. How did you hear about Entowork <?php //echo $site_setting->site_name; ?>?</h4><p id="worker_hear_about_symbol" style="float:left; height:12px; padding-left:10px;"></p><span id="worker_hear_aboutInfo" style="display:block;"></span>
                                    
                                       <?php 
                                        
                                        $post_worker_hear_about=array();
                                                
                                                if($worker_hear_about)
                                                {
                                                    $post_worker_available_time=$worker_hear_about;
                                                }
                                                
                                            
                                                ?>
                                                
                                                
                                    <ul class="apque">
                                    
                                        
                                        
                                        <li><label><input type="checkbox" name="worker_hear_about[]" value="Daily Deal Site (Groupon, Living Social, etc.)" id="worker_hear_about"  <?php if(in_array('Daily Deal Site (Groupon, Living Social, etc.)',$post_worker_hear_about)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Daily Deal Site (Groupon, Living Social, etc.)</label></li>
                                        
                                        <li><label><input type="checkbox" name="worker_hear_about[]" value="Email Marketing" id="worker_hear_about"  <?php if(in_array('Email Marketing',$post_worker_hear_about)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Email Marketing</label></li>
                                        
                                        <li><label><input type="checkbox" name="worker_hear_about[]" value="Social Media (Facebook, Twitter)" id="worker_hear_about"  <?php if(in_array('Social Media (Facebook, Twitter)',$post_worker_hear_about)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Social Media (Facebook, Twitter)</label></li>
                                        
                                        <li><label><input type="checkbox" name="worker_hear_about[]" value="Magazine/Newspaper" id="worker_hear_about"  <?php if(in_array('Magazine/Newspaper',$post_worker_hear_about)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Magazine/Newspaper</label></li>
                                        
                                        <li><label><input type="checkbox" name="worker_hear_about[]" value="Website (TechCrunch, Gigaom, blog, etc.)" id="worker_hear_about"  <?php if(in_array('Website (TechCrunch, Gigaom, blog, etc.)',$post_worker_hear_about)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;Website (TechCrunch, Gigaom, blog, etc.)</label></li>
                                        
                                        <li><label><input type="checkbox" name="worker_hear_about[]" value="From a friend / Overheard from someone" id="worker_hear_about"  <?php if(in_array('From a friend / Overheard from someone',$post_worker_hear_about)){  echo 'checked="checked"';} ?>/>&nbsp;&nbsp;From a friend / Overheard from someone</label></li>
                                    </ul>  
                                    </div>
                                        </td>
                                      </tr> 
                                      <tr>
                                      	<td height="15"></td>
                                      </tr>-->
                                      <tr>
                                        <td>
                                        <div class="span3 wow fadeIn animated animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                                        <h4 class="question">5.Document Id</h4>
                                            <ul class="apque">
                                            <li><input type="text" name="worker_securitynum" class="form-control" value="<?php echo $worker_securitynum ?>" /></li>
                                            </ul>
                                            </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                        	<table cellpadding="0" cellspacing="0" width="100%">
                                            	<tr>
                                                	<td width="10%" valign="middle" class="birth-title"><h4 class="question" style="margin-top:-17px;">Birthdate : </h4></td>
                                                    <td align="left" valign="top" class="birthday-tab">
                                                    	<ul class="apque">
                                            <li style="width:100%">
                                                <select name="bobyear" id="" class="form-control" style="width:90px; margin-right:10px; float:left;">
                                                <?php
                                                    for($i=1950;$i<=date('Y');$i++)
                                                    {
                                                ?>
                                                <option value="<?php echo $i; ?>"  <?php if($bobyear ==  $i){ echo 'selected';} ?>  ><?php echo $i; ?></option>
                                                <?php
                                                    }
                                                ?>
                                                </select>
                                                
                                                <select name="bobmonth" id="" class="form-control" style="width:120px; margin-right:10px; float:left;">
                                                <option value="1" <?php if($bobmonth == '1'){ echo 'selected';} ?>>January</option>
                                                <option value="2" <?php if($bobmonth == '2'){ echo 'selected';} ?>>February</option>
                                                <option value="3" <?php if($bobmonth == '3'){ echo 'selected';} ?>>March</option>
                                                <option value="4" <?php if($bobmonth == '4'){ echo 'selected';} ?>>April</option>
                                                <option value="5" <?php if($bobmonth == '5'){ echo 'selected';} ?>>May</option>
                                                <option value="6" <?php if($bobmonth == '6'){ echo 'selected';} ?>>June</option>
                                                <option value="7" <?php if($bobmonth == '7'){ echo 'selected';} ?>>July</option>
                                                <option value="8" <?php if($bobmonth == '8'){ echo 'selected';} ?>>August</option>
                                                <option value="9" <?php if($bobmonth == '9'){ echo 'selected';} ?>>September</option>
                                                <option value="10" <?php if($bobmonth == '10'){ echo 'selected';} ?>>October</option>
                                                <option value="11" <?php if($bobmonth == '11'){ echo 'selected';} ?>>November</option>
                                                <option value="12" <?php if($bobmonth == '12'){ echo 'selected';} ?>>December</option>
                                                </select>
                                                
                                                <select name="bobday" id="" class="form-control" style="width:80px; float:left;">
                                                <?php
                                                    for($i=1;$i<=31;$i++)
                                                    {
                                                ?>
                                                <option value="<?php echo $i; ?>" <?php if($bobday ==  $i){ echo 'selected';} ?>><?php echo $i; ?></option>
                                                <?php
                                                    }
                                                ?>	
                                                </select>
                                            </li>
                                            </ul>
                                                    </td>
                                                </tr>
                                        	</table>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                        <div class="span3 wow fadeIn animated animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                                        <h4 class="question"> Attach your resume ( optional ) </h4>
                                            
                                            </div>
                                        </td>
                                      </tr>
                                      <tr>
                                      <td>
                                      <div class="span3 wow fadeIn animated animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                                      <div id="err1" style="display:none;"></div>		
                                      
                                      <div id="add_more2" style="display:block; font-size:15px; color:#565656;"> 
                                            
                                            <?php $dcnt=1;
                                            
                                                 if($worker_document) { 
                                            
                                                    foreach($worker_document as $doc) { 
                                                    
                                                    if(file_exists(base_path().'upload/worker_doc/'.$doc->worker_document)) {
                                                        
                                                    ?>
                                                
                                                <div> <b><?php echo $dcnt.')&nbsp;&nbsp;';?><a target="_blank" style="color:#565656;" href="<?php echo base_url();?>upload/worker_doc/<?php echo $doc->worker_document; ?>"><?php echo $doc->worker_document; ?></a></div>
                                                
                                                
                                                <?php $dcnt++;    }  }  } ?>
                                                
                                            
                                            
                                            
                                            
                                            
                                            
                                                     <div id="more2" style="margin-top:10px;">
                                                      
                                                          <div class="fl" style="font-weight:normal;">Attachment : </div>                        
                                                             
                                                          <div class="fl"><input name="file_up[]" type="file" /></div>
                                                      
                                                    </div>
                                                    
                                        </div>
                                                    <div class="clear"></div>
                                                        <input type="hidden" name="glry_cnt" id="glry_cnt" value="<?php echo $dcnt; ?>" />
                                                <div id="addimg" style="display:block;"><img src="<?php echo base_url().$theme; ?>/images/add.png" height="16" width="16" border="0" title="add more" onclick="append_div2();" style="cursor:pointer;" /></div>
                                                
                                      </div>
                                      <div class="clear"></div>
                                      <p style="margin-top:15px;"><span class="colora"><b>NOTE :</b></span> Only PDF, PNG, JPG, GIF file extension are allowed.<br /><br /></p>
                                      </td>
                                      </tr>
                                      <tr>
                                      	<td height="15"></td>
                                      </tr> 
                                      
                                      
                                    </table>
                                </li>
                            </ul>    
                        </div>
                        <div class="clear"></div>
                        <div class="red-subtitle top-red-subtitle" style="font-size:18px; margin-bottom:25px;">
                        	<div class="container" style="text-align:center; text-transform:none; padding-right:15px; padding-left:15px; width:90%;">
                        		We often have a waiting list to become a Tasker. When this is the case, it may take some time to move through this process. We very much appreciate your patience, we are expanding our capabilities as fast as we can. Please answer ALL questions in complete sentences and be as descriptive as possible, the more information that supports your application the better.... <br /> <span style="padding-top:10px;">If you are cool, tell us!</span>
                            </div>
                        </div>
                        <div class="area-ph" style="text-align:center; margin-bottom:30px;"> 
                            <input type="submit" name="worker_apply" class="btn btn-default btn-default-join btn-app" value="Update">   
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
		<?php if($worker_background=='' || $worker_background=='Yes'){ $setselc=1; } else {  $setselc=0; } ?>
		<script type="text/javascript">
    
    var setselc=<?php echo $setselc; ?>;
    
    function setattach()
    {
        
        if(setselc=='1')
        {
            
            
                document.getElementById('add_more2').style.display='block';
                document.getElementById('addimg').style.display='block';
            
                document.workerApplyForm.worker_background[0].checked=true;	
            
        }
        
        if(setselc=='0')
        {
            
            document.getElementById('add_more2').style.display='none';
                document.getElementById('addimg').style.display='none';
            
                document.workerApplyForm.worker_background[1].checked=true;	
        }
        
    }
    
    
    
    
    
    window.onload= function() {  
     
     setattach();
     
     };
     
     </script>