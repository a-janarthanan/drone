$(document).ready(function(){	
	
		$('#post_new_task').click(function(){		
		//alert("hi");
		 validate_post_new_task();	
		});

	
	var email_reg_exp= /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
	var LetNumSpec=/^[0-9a-zA-Z_-]+$/;
	var number=/^[0-9]+$/;
	var amount=/^[0-9.]+$/;
	var alpha=/^[a-zA-Z]+$/;
	var alphanum=/^[a-zA-Z0-9]+$/;
	var alphaspace=/^[a-z A-Z]+$/;
	
	var content_email=/^\b\w+\@\w+[\.\w+]+\b$/;
	
	 validate_post_new_task();
	 validate_signup();
	 validate_quicksignup();
	 validate_login();
	 validate_forget();
	 validate_reset();
	 validate_edit_account();
	 validate_change_passsword();
	 validate_offer_task();
	 validate_askquestion();
	 validate_postmessage();
	   
	
	//global vars
$('#quicksign_up').click( function() {		
		alert("hi");
		 validate_quicksignup();	
 });
 
$('#sign_up').click( function() {		
		
		 validate_signup();	
 });

$('#loginbtn').click( function() {		
		
		 validate_login();	
 });
$('#forgetbtn').click( function() {		
		
		 validate_forget();	
 });	
	
$('#resetbtn').click( function() {		
		
		 validate_reset();	
 });	
	
	
	
$('#editbtn').click( function() {		
		
		 validate_edit_account();	
 });	
	
$('#changepasswordbtn').click( function() {		
		
		 validate_change_passsword();	
 });	

$('#offerTaskbtn').click( function() {		
		
		 validate_offer_task();	
 });	

$('#askQuestionbtn').click( function() {		
		
		 validate_askquestion();	
 });

$('#posMessagebtn').click( function() {		
		
		 validate_postmessage();	
 });
	
	function validate_quicksignup()
	{
		var form = $("#quicksignupForm");
		var email = $("#email");
		var zip_code = $("#zip_code");
		
		
		email.focus(function() {  
			
			emailTR.addClass('field_main'); 
			zip_codeTR.removeClass('field_main');
			passwordTR.removeClass('field_main');
			full_nameTR.removeClass('field_main');
			mobile_noTR.removeClass('field_main'); 
		} );
		
		zip_code.focus(function() {  
			zip_codeTR.addClass('field_main');  
			emailTR.removeClass('field_main');
			passwordTR.removeClass('field_main');
			full_nameTR.removeClass('field_main');
			mobile_noTR.removeClass('field_main'); 
		} );
				
		email.blur(validateEmail);
		zip_code.blur(validateZipcode);
		
		//On key up		
		email.keyup(validateEmail);
		zip_code.keyup(validateZipcode);
		
		form.submit(function(){
			if(validateEmail() & validateZipcode())
				return true
			else
				return false;
		});
	}
	
	function validate_post_new_task()
	{
		var form = $("#frm_new_task");
		
		var task_name_symbol = $("#task_name_symbol");
		var task_name = $("#task_name");
		var task_nameInfo = $("#task_nameInfo");
		var task_nameTR = $("#task_nameTR");
		
		var task_description_symbol = $("#task_description_symbol");
		var task_description = $("#task_description");
		var task_descriptionInfo = $("#task_descriptionInfo");
		var task_descriptionTR = $("#task_descriptionTR");
		
		var address1_symbol = $("#address1_symbol");
		var address1 = $("#address1");
		var address1Info = $("#address1Info");
		var address1TR = $("#address1TR");
		
		var zipcode_symbol = $("#zipcode_symbol");
		var zipcode = $("#zipcode");
		var zipcodeInfo = $("#zipcodeInfo");
		var zipcodeTR = $("#zipcodeTR");
		
		var locationname_symbol = $("#locationname_symbol");
		var locationname = $("#locationname");
		var locationnameInfo = $("#locationnameInfo");
		var locationnameTR = $("#locationnameTR");
		
		var task_to_price_symbol = $("#task_to_price_symbol");
		var task_to_price = $("#task_to_price");
		var task_to_priceInfo = $("#task_to_priceInfo");
		var task_to_priceTR = $("#task_to_priceTR");
		
		var task_price_symbol = $("#task_price_symbol");
		var task_price = $("#task_price");
		var task_priceInfo = $("#task_priceInfo");
		var task_priceTR = $("#task_priceTR");
		
		//On click	
		task_name.focus(function(){  
			task_nameTR.addClass('field_main');
		});
		task_description.focus(function(){  
			task_descriptionTR.addClass('field_main');
		});
		address1.focus(function(){  
			address1TR.addClass('field_main');
		});
		zipcode.focus(function(){  
			zipcodeTR.addClass('field_main');
		});
		locationname.focus(function(){  
			locationnameTR.addClass('field_main');
		});
		task_to_price.focus(function(){  
			task_to_priceTR.addClass('field_main');
		});
		task_price.focus(function(){  
			task_priceTR.addClass('field_main');
		});
		
		//On blur
		task_name.blur(validate_task_name);
		task_description.blur(validate_task_description);
		address1.blur(validate_address1);
		zipcode.blur(validate_zipcode);
		locationname.blur(validate_locationname);
		task_to_price.blur(validate_task_to_price);
		task_price.blur(validate_task_price);
		
		//On key up
		task_name.keyup(validate_task_name);
		task_description.keyup(validate_task_description);
		address1.keyup(validate_address1);
		zipcode.keyup(validate_zipcode);
		locationname.keyup(validate_locationname);
		task_to_price.keyup(validate_task_to_price);
		task_price.keyup(validate_task_price);
		
		//On Submitting
		form.submit(function(){
			if(validate_task_name() & validate_task_description() & validate_address1() & validate_zipcode() & validate_locationname() & validate_task_to_price() & validate_task_price())
				return true
			else
				return false;
		});
		
		//validation functions
		function validate_task_name()
		{	
			if(task_name.val()=='')
			{
				task_name_symbol.removeClass("tick_mark");
				task_name_symbol.removeClass("cross_mark");
				task_name.addClass("error1");
				task_nameInfo.text("Enter Task Title!");
				task_nameInfo.addClass("error1");
				
				return false;
			}
			//if it's NOT valid
			else if(task_name.val().length < 10)
			{
				task_name.addClass("error1");
				task_nameInfo.text("10 letters minimum required!");
				task_nameInfo.addClass("error1");
				task_name_symbol.removeClass("tick_mark");
				task_name_symbol.addClass("cross_mark");
				return false;
			}
			//if it's valid
			else
			{
				task_name.removeClass("error1");
				task_nameInfo.text("");
				task_nameInfo.removeClass("error1");
				task_nameInfo.addClass("success");
				task_name_symbol.removeClass("cross_mark");
				task_name_symbol.addClass("tick_mark");
				return true;
				
			}
		}
		
		function validate_task_description()
		{
			if(task_description.val()=='')
			{
				task_description_symbol.removeClass("tick_mark");
				task_description_symbol.removeClass("cross_mark");
				task_description.addClass("error1");
				task_descriptionInfo.text("Enter Task Description!");
				task_descriptionInfo.addClass("error1");
				
				return false;
			}
			//if it's NOT valid
			else if(task_description.val().length < 10)
			{
				task_description.addClass("error1");
				task_descriptionInfo.text("10 letters minimum required!");
				task_descriptionInfo.addClass("error1");
				task_description_symbol.removeClass("tick_mark");
				task_description_symbol.addClass("cross_mark");
				return false;
			}
			//if it's valid
			else
			{
				task_description.removeClass("error1");
				task_descriptionInfo.text("");
				task_descriptionInfo.removeClass("error1");
				task_descriptionInfo.addClass("success");
				task_description_symbol.removeClass("cross_mark");
				task_description_symbol.addClass("tick_mark");
				return true;
			}
		}
		
		function validate_address1()
		{	
			if(address1.val()=='')
			{
				address1_symbol.removeClass("tick_mark");
				address1_symbol.removeClass("cross_mark");
				address1.addClass("error1");
				address1Info.text("Enter Address!");
				address1Info.addClass("error1");
				
				return false;
			}
			//if it's NOT valid
			else if(address1.val().length < 1)
			{
				address1.addClass("error1");
				address1Info.text("1 letters minimum required!");
				address1Info.addClass("error1");
				address1_symbol.removeClass("tick_mark");
				address1_symbol.addClass("cross_mark");
				return false;
			}
			//if it's valid
			else
			{
				address1.removeClass("error1");
				address1Info.text("");
				address1Info.removeClass("error1");
				address1Info.addClass("success");
				address1_symbol.removeClass("cross_mark");
				address1_symbol.addClass("tick_mark");
				return true;
			}
		}
		
		function validate_zipcode()
		{	
			if(zipcode.val()=='')
			{
				zipcode_symbol.removeClass("tick_mark");
				zipcode_symbol.removeClass("cross_mark");
				zipcode.addClass("error1");
				zipcodeInfo.text("Enter Postal Code!");
				zipcodeInfo.addClass("error1");
				
				return false;
			}
			//if it's NOT valid
			else if(zipcode.val().length < 4)
			{
				zipcode.addClass("error1");
				zipcodeInfo.text("4 letters minimum required!");
				zipcodeInfo.addClass("error1");
				zipcode_symbol.removeClass("tick_mark");
				zipcode_symbol.addClass("cross_mark");
				return false;
			}
			//if it's valid
			else
			{
				zipcode.removeClass("error1");
				zipcodeInfo.text("");
				zipcodeInfo.removeClass("error1");
				zipcodeInfo.addClass("success");
				zipcode_symbol.removeClass("cross_mark");
				zipcode_symbol.addClass("tick_mark");
				return true;
			}
		}
		
		function validate_locationname()
		{		
			if(locationname.val()=='')
			{
				locationname_symbol.removeClass("tick_mark");
				locationname_symbol.removeClass("cross_mark");
				locationname.addClass("error1");
				locationnameInfo.text("Enter Location Name!");
				locationnameInfo.addClass("error1");
				
				return false;
			}
			//if it's NOT valid
			else if(locationname.val().length < 2)
			{
				locationname.addClass("error1");
				locationnameInfo.text("2 letters minimum required!");
				locationnameInfo.addClass("error1");
				locationname_symbol.removeClass("tick_mark");
				locationname_symbol.addClass("cross_mark");
				return false;
			}
			//if it's valid
			else
			{
				locationname.removeClass("error1");
				locationnameInfo.text("");
				locationnameInfo.removeClass("error1");
				locationnameInfo.addClass("success");
				locationname_symbol.removeClass("cross_mark");
				locationname_symbol.addClass("tick_mark");
				return true;
			}
		}
		
		function validate_task_to_price()
		{	
			if(task_to_price.val()=='')
			{
				task_to_price_symbol.removeClass("tick_mark");
				task_to_price_symbol.removeClass("cross_mark");
				task_to_price.addClass("error1");
				task_to_priceInfo.text("Enter From Amount field!");
				task_to_priceInfo.addClass("error1");
				
				return false;
			}
			//if it's NOT valid
			else if(task_to_price.val().length < 1)
			{
				task_to_price.addClass("error1");
				task_to_priceInfo.text("1 letters minimum required!");
				task_to_priceInfo.addClass("error1");
				task_to_price_symbol.removeClass("tick_mark");
				task_to_price_symbol.addClass("cross_mark");
				return false;
			}
			//if it's valid
			else
			{
				task_to_price.removeClass("error1");
				task_to_priceInfo.text("");
				task_to_priceInfo.removeClass("error1");
				task_to_priceInfo.addClass("success");
				task_to_price_symbol.removeClass("cross_mark");
				task_to_price_symbol.addClass("tick_mark");
				return true;
			}
		}
		
		function validate_task_price()
		{		
			if(task_price.val()=='')
			{
				task_price_symbol.removeClass("tick_mark");
				task_price_symbol.removeClass("cross_mark");
				task_price.addClass("error1");
				task_priceInfo.text("Enter To Amount field!");
				task_priceInfo.addClass("error1");
				
				return false;
			}
			//if it's NOT valid
			else if(task_price.val().length < 1)
			{
				task_price.addClass("error1");
				task_priceInfo.text("1 letters minimum required!");
				task_priceInfo.addClass("error1");
				task_price_symbol.removeClass("tick_mark");
				task_price_symbol.addClass("cross_mark");
				return false;
			}
			//if it's valid
			else
			{
				task_price.removeClass("error1");
				task_priceInfo.text("");
				task_priceInfo.removeClass("error1");
				task_priceInfo.addClass("success");
				task_price_symbol.removeClass("cross_mark");
				task_price_symbol.addClass("tick_mark");
				return true;
			}
		}
	}
	
	
	
	function validate_signup()
	{
	
	
		
		var form = $("#signupForm");
		
		var full_name_symbol = $("#full_name_symbol");
		var zip_code_symbol = $("#zip_code_symbol");
		var mobile_no_symbol = $("#mobile_no_symbol");
		var email_symbol = $("#email_symbol");
		var password_symbol = $("#password_symbol");
		
		var full_name = $("#full_name");
		var full_nameInfo = $("#full_nameInfo");
		var full_nameTR = $("#full_nameTR");
				
		var zip_code = $("#zip_code");
		var zip_codeInfo = $("#zip_codeInfo");
		var zip_codeTR = $("#zip_codeTR");
		
		var mobile_no = $("#mobile_no");
		var mobile_noInfo = $("#mobile_noInfo");		
		var mobile_noTR = $("#mobile_noTR");		
		
		var email = $("#email");
		var emailInfo = $("#emailInfo");
		var emailTR = $("#emailTR");
		
		var password = $("#password");
		var passwordInfo = $("#passwordInfo");
		var passwordTR = $("#passwordTR");
		
		
		//On click		
		email.focus(function() {  
			
			emailTR.addClass('field_main'); 
			zip_codeTR.removeClass('field_main');
			passwordTR.removeClass('field_main');
			full_nameTR.removeClass('field_main');
			mobile_noTR.removeClass('field_main'); 
		} );
		
		password.focus(function() {  
			passwordTR.addClass('field_main'); 
			zip_codeTR.removeClass('field_main');
			emailTR.removeClass('field_main');	
			full_nameTR.removeClass('field_main');
			mobile_noTR.removeClass('field_main');  
		} );
		
		mobile_no.focus(function() {  
			mobile_noTR.addClass('field_main'); 
			zip_codeTR.removeClass('field_main');
			emailTR.removeClass('field_main');
			passwordTR.removeClass('field_main');
			full_nameTR.removeClass('field_main');
 		} );
		
		
		zip_code.focus(function() {  
			zip_codeTR.addClass('field_main');  
			emailTR.removeClass('field_main');
			passwordTR.removeClass('field_main');
			full_nameTR.removeClass('field_main');
			mobile_noTR.removeClass('field_main'); 
		} );
		
		full_name.focus(function() {  
			full_nameTR.addClass('field_main'); 
			zip_codeTR.removeClass('field_main');
			emailTR.removeClass('field_main');
			passwordTR.removeClass('field_main');
			mobile_noTR.removeClass('field_main');  
	} );
		
		
		
		//On blur
		full_name.blur(validateFullName);		
		zip_code.blur(validateZipcode);
		mobile_no.blur(validateMobile);
		email.blur(validateEmail);
		password.blur(validatePassword);
		
		
		//On key up
		full_name.keyup(validateFullName);		
		zip_code.keyup(validateZipcode);
		mobile_no.keyup(validateMobile);
		//email.keyup(validateEmail);
		password.keyup(validatePassword);
		
		
		
		
		//On Submitting
		form.submit(function(){
			if(validateFullName() & validateEmail() & validatePassword() & validateZipcode() & validateMobile())
				return true
			else
				return false;
		});
		
	
	
	
	
	//validation functions
	
	
	
	
	
	function checkAvailability()
	{	
		
		var email = $("#email");
		var emailInfo = $("#emailInfo");
	
           
                // show our holding text in the validation message space
                emailInfo.removeClass('error1');
				emailInfo.html('<img src="'+baseThemeUrl+'/images/ajax-loader.gif" height="16" width="16" /> checking availability...');
				
			
          var res = $.ajax({						
						type: 'POST',
                        url: baseUrl+'home/checkemailavailability',
                        data: 'email=' + email.val(),
                        dataType: 'json', 
						cache: false,
						async: false                     
                    }).responseText;
		  
	
				return res;	
              
        
	}
	
	
	function validateEmail()
	{
	
		//testing regular expression
		var a = $("#email").val();
		var filter = email_reg_exp;
		//if it's valid email
		
		if(email.val()=='')
		{
			email_symbol.removeClass("tick_mark");
			email_symbol.removeClass("cross_mark");
			email.addClass("error1");
			emailInfo.text("Enter E-mail address!");
			emailInfo.addClass("error1");
			
			return false;
			
		}
		else
		{
			if(filter.test(a)){
				email_symbol.removeClass("cross_mark");
				email_symbol.addClass("tick_mark");
				email.removeClass("error1");
				//emailInfo.text("E-mail address is valid!");
				emailInfo.text("");
				emailInfo.removeClass("error1");
				emailInfo.addClass("success");
				
				
				var chk=checkAvailability();
				
				var obj = jQuery.parseJSON(chk);
	
				if(obj.ok==true)
				{				
					email_symbol.removeClass("cross_mark");
					email_symbol.addClass("tick_mark");
					email.removeClass("error1");
					//emailInfo.text("E-mail address is available!");
					emailInfo.text("");
					emailInfo.addClass("success");
					
					return true;
				}
				else
				{
					email.addClass("error1");
					emailInfo.text("E-mail address is not available!");
					emailInfo.addClass("error1");
					email_symbol.removeClass("tick_mark");
					email_symbol.addClass("cross_mark");
					return false;
				}
				
				
			}
			
			//if it's NOT valid
			else{
				email.addClass("error1");
				emailInfo.text("Type a valid e-mail please :P");
				emailInfo.addClass("error1");
				email_symbol.removeClass("tick_mark");
				email_symbol.addClass("cross_mark");
				return false;
			}
		}
	}
	
	
	
	function validatePassword()
	{
		
		var a = $("#password");	

		//it's NOT valid
		if(password.val()=='')
		{
			password_symbol.removeClass("tick_mark");
			password_symbol.removeClass("cross_mark");
			password.addClass("error1");
			passwordInfo.text("Enter password!");
			passwordInfo.addClass("error1");
			
			return false;
			
		}
		else
		{
			if(password.val().length <8){
				password.addClass("error1");
				passwordInfo.text("At least 8 characters is required");
				passwordInfo.addClass("error1");
				password_symbol.removeClass("tick_mark");
				password_symbol.addClass("cross_mark");
				return false;
			}
			//it's valid
			else{			
				password.removeClass("error1");
				//passwordInfo.text("Remember your password");
				passwordInfo.text("");
				passwordInfo.removeClass("error1");
				passwordInfo.addClass("success");
				password_symbol.removeClass("cross_mark");
				password_symbol.addClass("tick_mark");
				return true;
			}
		}
	}
	
	
	function validateFullName()
	{	
		
		var a = $("#full_name").val();
		var filter = alphaspace;
			
		if(full_name.val()=='')
		{
			full_name_symbol.removeClass("tick_mark");
			full_name_symbol.removeClass("cross_mark");
			full_name.addClass("error1");
			full_nameInfo.text("Enter Full name!");
			full_nameInfo.addClass("error1");
			
			return false;
			
		}
		//if it's NOT valid
		else if(full_name.val().length < 4){
			full_name.addClass("error1");
			//full_nameInfo.text("We want names with more than 4 letters!");
			full_nameInfo.text("4 letters minimum required!");
			full_nameInfo.addClass("error1");
			full_name_symbol.removeClass("tick_mark");
			full_name_symbol.addClass("cross_mark");
			return false;
		}
		
		
		//if it's valid
		else{
			
			
			
			//if it's valid number
			if(filter.test(a)){
				full_name.removeClass("error1");
				full_nameInfo.text("");
				full_nameInfo.removeClass("error1");
				full_nameInfo.addClass("success");
				full_name_symbol.removeClass("cross_mark");
				full_name_symbol.addClass("tick_mark");
				return true;
			}
			//if it's NOT valid
			else{
				full_name.addClass("error1");
				full_nameInfo.text("Enter valid full name.");
				full_nameInfo.addClass("error1");
				full_name_symbol.removeClass("tick_mark");
				full_name_symbol.addClass("cross_mark");
				return false;
			}
			
			
		}
	}
	
	
	
	function validateMobile()
	{
		
		//testing regular expression
		var a = $("#mobile_no").val();
		var filter = number;
		
		if(mobile_no.val()!='')
		{
		
		/*if(mobile_no.val()=='')
		{
			mobile_no.addClass("error1");
			mobile_noInfo.text("Enter valid 10 digit mobile number!");
			mobile_noInfo.addClass("error1");
			
			return false;
			
		}
	
		else*/ if(mobile_no.val().length <= 10 )
		{		
			mobile_no.addClass("error1");
			mobile_noInfo.text("Enter valid 11 digit mobile number!");
			mobile_noInfo.addClass("error1");
			mobile_no_symbol.removeClass("tick_mark");
			mobile_no_symbol.addClass("cross_mark");
			return false;
		} 
		
		else if(mobile_no.val().length > 11 )
		{		
			mobile_no.addClass("error1");
			mobile_noInfo.text("Enter valid 11 digit mobile number!");
			mobile_noInfo.addClass("error1");
			mobile_no_symbol.removeClass("tick_mark");
			mobile_no_symbol.addClass("cross_mark");
			return false;
		} 
		
		else {
			
			//if it's valid number
			if(filter.test(a)){
				mobile_no.removeClass("error1");
				mobile_noInfo.text("");
				mobile_noInfo.removeClass("error1");		
				mobile_noInfo.addClass("success");
				mobile_no_symbol.removeClass("cross_mark");
				mobile_no_symbol.addClass("tick_mark");
				return true;
			}
			//if it's NOT valid
			else{
				mobile_no.addClass("error1");
				mobile_noInfo.text("Enter valid 11 digit mobile number.");
				mobile_noInfo.addClass("error1");
				return false;
			}
		}
		
		
		} else {  return true; }	
	}
	
	
	function validateZipcode()
	{
		
		//testing regular expression
		var a = $("#zip_code").val();
		var filter = alphanum;
		
		if(zip_code.val()=='')
		{
			zip_code_symbol.removeClass("tick_mark");
			zip_code_symbol.removeClass("cross_mark");
			zip_code.addClass("error1");
			zip_codeInfo.text("Enter valid post code number!");
			zip_codeInfo.addClass("error1");
			
			return false;
			
		}
	
		else if(zip_code.val().length < 4 )
		{		
			zip_code.addClass("error1");
			zip_codeInfo.text("Enter valid post code number!");
			zip_codeInfo.addClass("error1");
			zip_code_symbol.removeClass("tick_mark");
			zip_code_symbol.addClass("cross_mark");
			return false;
		} 
		
		else {
			
			//if it's valid number
			if(filter.test(a)){
				zip_code.removeClass("error1");
				zip_codeInfo.text("");
				zip_codeInfo.removeClass("error1");	
				zip_codeInfo.addClass("success");
				zip_code_symbol.removeClass("cross_mark");
				zip_code_symbol.addClass("tick_mark");
				return true;
			}
			//if it's NOT valid
			else{
				zip_code.addClass("error1");
				zip_codeInfo.text("Enter valid post code number.");
				zip_codeInfo.addClass("error1");
				zip_code_symbol.removeClass("tick_mark");
				zip_code_symbol.addClass("cross_mark");
				return false;
			}
		}
	}
	

	
	
	
	}
	
	
	function validate_login()
	{
	
	
		
		var form = $("#loginForm");	
		
	
		var login_email = $("#login_email");
		var loginemailInfo = $("#loginemailInfo");
		var loginEmailTR = $("#loginEmailTR");
		
		var login_password = $("#login_password");
		var loginPasswordInfo = $("#loginPasswordInfo");
		var loginPasswordTR = $("#loginPasswordTR");
		
		
		
		//On click		
		login_email.focus(function() {  
			
			loginEmailTR.addClass('field_main'); 
			loginPasswordTR.removeClass('field_main');
		} );
		
		login_password.focus(function() {  
			loginEmailTR.removeClass('field_main'); 
			loginPasswordTR.addClass('field_main');
		} );
		
		
		
		
		//On blur
		
		login_email.blur(validateEmail);
		login_password.blur(validatePassword);
	
		login_password.keyup(validatePassword);
		
		
		//On Submitting
		form.submit(function(){
			if(validateEmail() & validatePassword())
				return true
			else
				return false;
		});
		
	
	
	
	
	
	
	//validation functions
	function validateEmail(){
		//testing regular expression
		var a = $("#login_email").val();
		var filter = email_reg_exp;
		//if it's valid email
		if(filter.test(a)){
			login_email.removeClass("error1");			
			loginemailInfo.text("E-mail address is valid!");
			loginemailInfo.removeClass("error1");
			loginemailInfo.addClass("success");
			return true;
		}
		//if it's NOT valid
		else{
			login_email.addClass("error1");
			loginemailInfo.text("Type a valid e-mail please :P");
			loginemailInfo.addClass("error1");
			return false;
		}
	}
	
	function validatePassword(){
		var a = $("#login_password");
	

		//it's NOT valid
		if(login_password.val().length <8){
			login_password.addClass("error1");
			loginPasswordInfo.text("At least 8 characters is required.");
			loginPasswordInfo.addClass("error1");
			return false;
		}
		//it's valid
		else{			
			login_password.removeClass("error1");
			loginPasswordInfo.text("Password is valid.");
			loginPasswordInfo.removeClass("error1");
			loginPasswordInfo.addClass("success");
			return true;
		}
	}
	
	
	
	
	}
	
	
	function validate_forget()
	{
	
	
		
		var form = $("#forgetForm");	
		
	
		var forget_email = $("#forget_email");
		var forgetEmailInfo = $("#forgetEmailInfo");
		var forgetEmailTR = $("#forgetEmailTR");
		
	
		
		//On click		
		forget_email.focus(function() {  
			
			forgetEmailTR.addClass('field_main'); 
		
		} );
		
		
		
		//On blur
		
		forget_email.blur(validateEmail);
		
	
	
		forget_email.keyup(validateEmail);
		
		
		//On Submitting
		form.submit(function(){
			if(validateEmail())
				return true
			else
				return false;
		});
		
	
	
	
	
	
	
	//validation functions
	function validateEmail(){
		//testing regular expression
		var a = $("#forget_email").val();
		var filter = email_reg_exp;
		//if it's valid email
		if(filter.test(a)){
			forget_email.removeClass("error1");			
			forgetEmailInfo.text("E-mail address is valid!");
			forgetEmailInfo.removeClass("error1");
			forgetEmailInfo.addClass("success");
			return true;
		}
		//if it's NOT valid
		else{
			forget_email.addClass("error1");
			forgetEmailInfo.text("Type a valid e-mail please :P");
			forgetEmailInfo.addClass("error1");
			return false;
		}
	}
	

	
	}
	
	
	
	function validate_reset()
	{
		
		
		
		
		var form = $("#resetForm");	
		
	
		var new_password = $("#new_password");
		var newpasswordInfo = $("#newpasswordInfo");
		var newpasswordTR = $("#newpasswordTR");
		
		
		var confirm_password = $("#confirm_password");
		var confirmpasswordInfo = $("#confirmpasswordInfo");
		var confirmpasswordTR = $("#confirmpasswordTR");
		
	
		
		//On click		
		new_password.focus(function() {  
			
			newpasswordTR.addClass('field_main'); 
			confirmpasswordTR.removeClass('field_main'); 
		
		} );
		
		confirm_password.focus(function() {  
			
			confirmpasswordTR.addClass('field_main'); 
			newpasswordTR.removeClass('field_main'); 
		
		} );
		
		
		
		//On blur
		
		new_password.blur(validatePass1);
		confirm_password.blur(validatePass2);
		
	
	
		new_password.keyup(validatePass1);
		confirm_password.keyup(validatePass2);
		
		
		//On Submitting
		form.submit(function(){
			if(validatePass1() & validatePass2())
				return true
			else
				return false;
		});
		
	
	
	
	
		
		function validatePass1(){
		var a = $("#new_password");
		var b = $("#confirm_password");

		//it's NOT valid
		if(new_password.val().length <7){
			new_password.addClass("error1");
			newpasswordInfo.text("At least 8 characters is required.");
			newpasswordInfo.addClass("error1");
			return false;
		}
		//it's valid
		else{			
			new_password.removeClass("error1");
			newpasswordInfo.text("New Password is valid.");
			newpasswordInfo.removeClass("error1");
			newpasswordInfo.addClass("success");
			validatePass2();
			return true;
		}
	}
	function validatePass2(){
		var a = $("#new_password");
		var b = $("#confirm_password");
		//are NOT valid
		if( new_password.val() != confirm_password.val() ){
			confirm_password.addClass("error1");
			confirmpasswordInfo.text("Passwords doesn't match!");
			confirmpasswordInfo.addClass("error1");
			return false;
		}
		//are valid
		else{
			confirm_password.removeClass("error1");
			confirmpasswordInfo.text("Confirm password is match.");
			confirmpasswordInfo.removeClass("error1");
			confirmpasswordInfo.addClass("success");
			return true;
		}
	}
	
	
		
	}
	
	
	
	
	function validate_edit_account()
	{
	
	
		
		var form = $("#editForm");
		
		var first_name = $("#first_name");
		var first_nameInfo = $("#first_nameInfo");
		var first_nameTR = $("#first_nameTR");
		
		
		var last_name = $("#last_name");
		var last_nameInfo = $("#last_nameInfo");
		var last_nameTR = $("#last_nameTR");
				
		var zip_code = $("#zip_code");
		var zip_codeInfo = $("#zip_codeInfo");
		var zip_codeTR = $("#zip_codeTR");
		
		var mobile_no = $("#mobile_no");
		var mobile_noInfo = $("#mobile_noInfo");		
		var mobile_noTR = $("#mobile_noTR");		
		
		var email = $("#email");
		var emailInfo = $("#emailInfo");
		var emailTR = $("#emailTR");
		
		var phone_no = $("#phone_no");
		var phone_noInfo = $("#phone_noInfo");
		var phone_noTR = $("#phone_noTR");
		
		
		//On click		
		email.focus(function() {  
			
			emailTR.addClass('field_main'); 
			zip_codeTR.removeClass('field_main');
			first_nameTR.removeClass('field_main');
			last_nameTR.removeClass('field_main');
			mobile_noTR.removeClass('field_main'); 
			phone_noTR.removeClass('field_main'); 
		} );
		
		last_name.focus(function() {  
			emailTR.removeClass('field_main'); 
			zip_codeTR.removeClass('field_main');
			first_nameTR.removeClass('field_main');
			last_nameTR.addClass('field_main');
			mobile_noTR.removeClass('field_main'); 
			phone_noTR.removeClass('field_main'); 
		} );
		
		first_name.focus(function() {  
			emailTR.removeClass('field_main'); 
			zip_codeTR.removeClass('field_main');
			first_nameTR.addClass('field_main');
			last_nameTR.removeClass('field_main');
			mobile_noTR.removeClass('field_main'); 
			phone_noTR.removeClass('field_main'); 
		} );
		
		mobile_no.focus(function() {  
			emailTR.removeClass('field_main'); 
			zip_codeTR.removeClass('field_main');
			first_nameTR.removeClass('field_main');
			last_nameTR.removeClass('field_main');
			mobile_noTR.addClass('field_main'); 
			phone_noTR.removeClass('field_main'); 
 		} );
		
		
		phone_no.focus(function() {  
			emailTR.removeClass('field_main'); 
			zip_codeTR.removeClass('field_main');
			first_nameTR.removeClass('field_main');
			last_nameTR.removeClass('field_main');
			mobile_noTR.removeClass('field_main'); 
			phone_noTR.addClass('field_main'); 
 		} );
		
		
		zip_code.focus(function() {  
			zip_codeTR.addClass('field_main');  
			emailTR.removeClass('field_main'); 
			first_nameTR.removeClass('field_main');
			last_nameTR.removeClass('field_main');
			mobile_noTR.removeClass('field_main'); 
			phone_noTR.removeClass('field_main'); 
		} );
		
		
		
		
		
		//On blur
		first_name.blur(validateFirstName);		
		last_name.blur(validateLastName);		
		zip_code.blur(validateZipcode);
		mobile_no.blur(validateMobile);
		phone_no.blur(validatePhone);
		email.blur(validateEmail);
		
		
		
		//On key up
		first_name.keyup(validateFirstName);		
		last_name.keyup(validateLastName);		
		zip_code.keyup(validateZipcode);
		mobile_no.keyup(validateMobile);
		phone_no.keyup(validatePhone);
		email.keyup(validateEmail);
	
		
		
		
		
		//On Submitting
		form.submit(function(){
			if(validateFirstName() & validateLastName()  & validateEmail() & validatePhone() & validateZipcode() & validateMobile())
				return true
			else
				return false;
		});
		
	
	
	
	
	//validation functions
	
	
	
	
	
	
	function validateEmail()
	{
	
		//testing regular expression
		var a = $("#email").val();
		var filter = email_reg_exp;
		//if it's valid email
		if(filter.test(a)){
			email.removeClass("error1");
			emailInfo.text("E-mail address is valid!");
			emailInfo.removeClass("error1");
			emailInfo.addClass("success");
			
			return true;
		
			
			
		}
		
		//if it's NOT valid
		else{
			email.addClass("error1");
			emailInfo.text("Type a valid e-mail please :P");
			emailInfo.addClass("error1");
			return false;
		}
	}
	
	
	
	
	
	function validateFirstName()
	{	
		
		var a = $("#first_name").val();
		var filter = alpha;
			
		if(first_name.val()=='')
		{
			first_name.addClass("error1");
			first_nameInfo.text("Enter First name!");
			first_nameInfo.addClass("error1");
			
			return false;
			
		}
		//if it's NOT valid
		else if(first_name.val().length < 4){
			first_name.addClass("error1");
			first_nameInfo.text("We want names with more than 4 letters!");
			first_nameInfo.addClass("error1");
			return false;
		}
		
		
		//if it's valid
		else{
			
			
			
			//if it's valid number
			if(filter.test(a)){
				first_name.removeClass("error1");
				first_nameInfo.text("First name is valid");
				first_nameInfo.removeClass("error1");
				first_nameInfo.addClass("success");
				return true;
			}
			//if it's NOT valid
			else{
				first_name.addClass("error1");
				first_nameInfo.text("Enter valid first name.");
				first_nameInfo.addClass("error1");
				return false;
			}
			
			
		}
	}
	
	
	
	function validateLastName()
	{	
		
		var a = $("#last_name").val();
		var filter = alpha;
			
		if(last_name.val()=='')
		{
			last_name.addClass("error1");
			last_nameInfo.text("Enter Last name!");
			last_nameInfo.addClass("error1");
			
			return false;
			
		}
		//if it's NOT valid
		else if(last_name.val().length < 4){
			last_name.addClass("error1");
			last_nameInfo.text("We want names with more than 4 letters!");
			last_nameInfo.addClass("error1");
			return false;
		}
		
		
		//if it's valid
		else{
			
			
			
			//if it's valid number
			if(filter.test(a)){
				last_name.removeClass("error1");
				last_nameInfo.text("Last name is valid");
				last_nameInfo.removeClass("error1");
				last_nameInfo.addClass("success");
				return true;
			}
			//if it's NOT valid
			else{
				last_name.addClass("error1");
				last_nameInfo.text("Enter valid Last name.");
				last_nameInfo.addClass("error1");
				return false;
			}
			
			
		}
	}
	
	
	
	
	
	function validateMobile()
	{
		
		//testing regular expression
		var a = $("#mobile_no").val();
		var filter = number;
		
		if(mobile_no.val()!='')
		{
		/*if(mobile_no.val()=='')
		{
			mobile_no.addClass("error1");
			mobile_noInfo.text("Enter valid 10 digit mobile number!");
			mobile_noInfo.addClass("error1");
			
			return false;
			
		}
	
		else*/ if(mobile_no.val().length <= 9 )
		{		
			mobile_no.addClass("error1");
			mobile_noInfo.text("Enter valid 10 digit mobile number!");
			mobile_noInfo.addClass("error1");
			return false;
		} 
		
		else if(mobile_no.val().length > 10 )
		{		
			mobile_no.addClass("error1");
			mobile_noInfo.text("Enter valid 10 digit mobile number!");
			mobile_noInfo.addClass("error1");
			return false;
		} 
		
		else {
			
			//if it's valid number
			if(filter.test(a)){
				mobile_no.removeClass("error1");
				mobile_noInfo.text("Valid mobile number.");
				mobile_noInfo.removeClass("error1");		
				mobile_noInfo.addClass("success");
				return true;
			}
			//if it's NOT valid
			else{
				mobile_no.addClass("error1");
				mobile_noInfo.text("Enter valid 10 digit mobile number.");
				mobile_noInfo.addClass("error1");
				return false;
			}
		}
		
		} else { return true; }
	}
	
	function validatePhone()
	{
		
		//testing regular expression
		var a = $("#phone_no").val();
		var filter = number;
		
		
	
		
		
		
	 if(phone_no.val().length > 1 )
	 {
			//if it's valid number
			if(filter.test(a))
			{
				
				
				
				 if(phone_no.val().length > 15 )
				{		
					phone_no.addClass("error1");
					phone_noInfo.text("Enter valid and less than 15 digit phone number!");
					phone_noInfo.addClass("error1");
					return false;
				} 
				
				
				 else { phone_no.removeClass("error1");
						phone_noInfo.text("Valid phone number.");
						phone_noInfo.removeClass("error1");		
						phone_noInfo.addClass("success");
						return true;
						
				 }
		
		   }
		   //if it's NOT valid
			else{
				phone_no.addClass("error1");
				phone_noInfo.text("Enter valid phone number.");
				phone_noInfo.addClass("error1");
				return false;
			}
		   
		
		}
		
		else
		{
			return true;	
		}
			
		
	}
	
	
	function validateZipcode()
	{
		
		//testing regular expression
		var a = $("#zip_code").val();
		var filter = alphanum;
		
		if(zip_code.val()=='')
		{
			zip_code.addClass("error1");
			zip_codeInfo.text("Enter valid postal code number!");
			zip_codeInfo.addClass("error1");
			
			return false;
			
		}
	
		else if(zip_code.val().length < 4 )
		{		
			zip_code.addClass("error1");
			zip_codeInfo.text("Enter valid postal code number!");
			zip_codeInfo.addClass("error1");
			return false;
		} 
		
		else {
			
			//if it's valid number
			if(filter.test(a)){
				zip_code.removeClass("error1");
				zip_codeInfo.text("Valid postal code number.");
				zip_codeInfo.removeClass("error1");	
				zip_codeInfo.addClass("success");
				return true;
			}
			//if it's NOT valid
			else{
				zip_code.addClass("error1");
				zip_codeInfo.text("Enter valid postal code number.");
				zip_codeInfo.addClass("error1");
				return false;
			}
		}
	}
	

	
	
	
	}
	
	
	
		function validate_change_passsword()
	{
	
	
		
		var form = $("#changepasswordForm");
		
		
		
		var password = $("#password");
		var passwordInfo = $("#passwordInfo");
		var passwordTR = $("#passwordTR");
		
		
		//On click		
		
		password.focus(function() {  
			passwordTR.addClass('field_main'); 
			 
		} );
		
	
		
		//On blur
		
		password.blur(validatePassword);
		
		
		//On key up
	
		password.keyup(validatePassword);
		
		
		
		
		//On Submitting
		form.submit(function(){
			if(validatePassword())
				return true
			else
				return false;
		});
		
	
	
	//validation functions
	
	function validatePassword()
	{
		
		var a = $("#password");	

		//it's NOT valid
		if(password.val().length <8){
			password.addClass("error1");
			passwordInfo.text("At least 8 characters is required");
			passwordInfo.addClass("error1");
			return false;
		}
		//it's valid
		else{			
			password.removeClass("error1");
			passwordInfo.text("Ey! Remember: your password");
			passwordInfo.removeClass("error1");
			passwordInfo.addClass("success");
			return true;
		}
	}
	
	
	
	
	}
	
	
	
	function validate_offer_task()
	{
		
		
		
		var form = $("#offerTaskForm");	
		
	
		var offer_amount = $("#offer_amount");
		var offer_amountInfo = $("#offer_amountInfo");
		var offer_amountTR = $("#offer_amountTR");
		
		var task_comment = $("#task_comment");
		var task_commentInfo = $("#task_commentInfo");
		var task_commentTR = $("#task_commentTR");
		
		
		
		//On click		
		offer_amount.focus(function() {  
			
			offer_amountTR.addClass('field_main'); 
			task_commentTR.removeClass('field_main');
		} );
		
		task_comment.focus(function() {  
			offer_amountTR.removeClass('field_main'); 
			task_commentTR.addClass('field_main');
		} );
		
		
		
		
		//On blur
		
		offer_amount.blur(validateAmount);
		//task_comment.blur(validateComment);
	
		offer_amount.keyup(validateAmount);
		//task_comment.keyup(validateComment);
		
		
		
		//On Submitting
		form.submit(function(){
			if(validateAmount() & validateComment())
				return true
			else
				return false;
		});
		
	
	
		
	
	
	
		function validateAmount()
		{
		
		//testing regular expression
		var a = $("#offer_amount").val();
		var filter = amount;
		
		if(offer_amount.val()=='')
		{
			offer_amount.addClass("error1");
			offer_amountInfo.text("Enter valid offer amount!");
			offer_amountInfo.addClass("error1");
			
			return false;
			
		}
	
		else if(offer_amount.val().length < 1 )
		{		
			offer_amount.addClass("error1");
			offer_amountInfo.text("Enter valid offer amount!");
			offer_amountInfo.addClass("error1");
			return false;
		} 
		
		
		
		else {
			
			//if it's valid number
			if(filter.test(a)){
				offer_amount.removeClass("error1");
				offer_amountInfo.text("Valid offer amount.");
				offer_amountInfo.removeClass("error1");		
				offer_amountInfo.addClass("success");
				return true;
			}
			//if it's NOT valid
			else{
				offer_amount.addClass("error1");
				offer_amountInfo.text("Enter valid offer amount.");
				offer_amountInfo.addClass("error1");
				return false;
			}
		}
	}
	
	
	
		function checkcontentemail()
		{	
			
				var task_comment = $("#task_comment");
				var task_commentInfo = $("#task_commentInfo");
		
			   
					// show our holding text in the validation message space
					
				
			  var res = $.ajax({						
							type: 'POST',
							url: baseUrl+'task/checkcontentemail',
							data: 'task_comment=' + task_comment.val(),
							dataType: 'json', 
							cache: false,
							async: false                     
						}).responseText;
			  
		
					return res;	
				  
			
		}
	
	
	
		function validateComment()
		{
			//it's NOT valid
			if(trim(task_comment.val()).length < 10){
				task_commentInfo.addClass("error1");
				task_commentInfo.text("Enter valid Description.");
				return false;
			}
			//it's valid
			else{		
			
			
					   	
			var chk=checkcontentemail();
			
			var obj = jQuery.parseJSON(chk);
			
			
			
				if(obj.ok==false)
				{	
				
						task_commentInfo.addClass("error1");
						task_commentInfo.text("You can not write email address in message!");
						task_commentInfo.addClass("error1");					
						
						return false;
					
					
					
				}
				else
				{
					
					task_commentInfo.removeClass("error1");
					task_commentInfo.text("Offer Description is valid.");
					task_commentInfo.addClass("success");
					return true;
				}
				
				
				
			}
		}
		
	}
	
	
	function validate_askquestion()
	{
		
		
		
		var form = $("#askQuestionForm");	
		
	
	
		
		var task_comment = $("#task_comment");
		var task_commentInfo = $("#task_commentInfo");
		var task_commentTR = $("#task_commentTR");
		
		
		
	
		task_comment.focus(function() {  
			task_commentTR.addClass('field_main');
		} );
		
		
		
		
		//On blur
		
		
		//task_comment.blur(validateComment);
	
		
		//task_comment.keyup(validateComment);
		
		
		
		//On Submitting
		form.submit(function(){
			if(validateComment())
				return true
			else
				return false;
		});
		
		
		
		
		function checkcontentemail()
		{	
			
			var task_comment = $("#task_comment");
			var task_commentInfo = $("#task_commentInfo");
		
			   
					// show our holding text in the validation message space
					
				
			  var res = $.ajax({						
							type: 'POST',
							url: baseUrl+'task/checkcontentemail',
							data: 'task_comment=' + task_comment.val(),
							dataType: 'json', 
							cache: false,
							async: false                     
						}).responseText;
			  
		
					return res;	
				  
			
		}
	
	
		function validateComment()
		{
			
			var a = task_comment.val();
			var filter = content_email;
		
			
			//it's NOT valid
			if(trim(task_comment.val()).length < 10){
				task_commentInfo.addClass("error1");
				task_commentInfo.text("Enter valid Comment.");
				return false;
			}
		
			
			//it's valid
			else{		
			
			
			   	
			var chk=checkcontentemail();
			
			var obj = jQuery.parseJSON(chk);
			
			
			
				if(obj.ok==false)
				{	
				
					task_commentInfo.addClass("error1");
						task_commentInfo.text("You can not write email address in message!");
						task_commentInfo.addClass("error1");
						
						
						return false;
					
					
					
				}
				else
				{
					
						task_commentInfo.removeClass("error1");
						task_commentInfo.text("Comment is valid.");
						task_commentInfo.addClass("success");
						return true;
						
				}
			}
		}
		
	}
	
	
	function validate_postmessage()
	{
		
		
		
		var form = $("#posMessageForm");	
		
	
	
		
		var task_comment = $("#task_comment");
		var task_commentInfo = $("#task_commentInfo");
		var task_commentTR = $("#task_commentTR");
		
		
		
	
		task_comment.focus(function() {  
			task_commentTR.addClass('field_main');
		} );
		
		
		
		
		//On blur
		
		
	//	task_comment.blur(validateComment);
	
		
		//task_comment.keyup(validateComment);
		
		
		
		//On Submitting
		form.submit(function(){
			if(validateComment())
				return true
			else
				return false;
		});
		
	
	
	
		function validateComment()
		{
			//it's NOT valid
			if(trim(task_comment.val()).length < 10){
				task_commentInfo.addClass("error1");
				task_commentInfo.text("Enter valid Comment.");
				return false;
			}
			//it's valid
			else{			
				task_commentInfo.removeClass("error1");
				task_commentInfo.text("Comment is valid.");
				task_commentInfo.addClass("success");
				return true;
			}
		}
		
	}
	
	

});