<div class="body_cont">
        	<div>
				<!--banner-->
                <div id="acc-banners-ph" class="banner-contain">
                </div>
				<!--banner ends-->
                
			</div>	
        </div>
	</div>
    <div id="find-placing" class="find-trust trust-safety">
        <div class="red-subtitle top-red-subtitle">Contact Us</div>
        <div class="profile_back">
        	<div class="container">
            	<div class="db-rightinfo db-rightinfo-inner db-contact-main-inner" style="margin:0px 0 0 0; padding:30px; min-height:330px;">
                    <div class="contact-left-block pull-left">
                        <div class="elevio-box-warning">
                            <p>Before you submit your query, please check to see if your question has already been answered in our knowledge base FAQ.</p>
                            <div><a class="btn btn-default" href="http://demoplace.co.in/newsite/index.php/content/help">Visit FAQ</a></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                	<div class="contact-right-block pull-right">
                        <div class="contact-form-main">
                        	<?php
                        $attributes = array('name'=>'frm_contact','id'=>'frm_contact');
                        echo form_open_multipart('business_con',$attributes);
                    
                    ?>
                            	<div class="contact-form-r1">
                                	<label class="contact-form-r1-title">Name</label>
                                    <div class="">
                                        <div class="contact-field1 pull-left">
                                            <input type="text" name="fname" placeholder="First Name" onblur="placeholder='First Name'" onclick="placeholder=''" />
                                        </div>
                                        <div class="contact-field1 pull-right">
                                            <input type="text" name="lname" placeholder="Last Name" onblur="placeholder='Last Name'" onclick="placeholder=''" />
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="contact-form-r1">
                                	<label class="contact-form-r1-title">Email</label>
                                    <div class="">
                                        <div class="contact-field1 contact-field-email">
                                            <input type="text" name="email" placeholder="Email" onblur="placeholder='Email'" onclick="placeholder=''" />
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="contact-form-r1">
                                	<label class="contact-form-r1-title">Subject</label>
                                    <div class="">
                                        <div class="contact-field1 contact-field-email">
                                            <input type="text" name="sub" placeholder="Subject" onblur="placeholder='Subject'" onclick="placeholder=''" />
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="contact-form-r1">
                                	<label class="contact-form-r1-title">Message</label>
                                    <div class="">
                                        <div class="contact-massage-field">
                                            <textarea cols="1" rows="1" name="mess" placeholder="Describe your issue here..." onblur="placeholder='Describe your issue here...'" onclick="placeholder=''" ></textarea>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="form-submit-btn">
                                    <input type="submit" name="sub" class="btn btn-default btn-contact-ticket" value="Submit query">
                                	
                                </div>
                            </form>
                        </div>
                        <div class="clear"></div>
                    </div>
            	</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    
    