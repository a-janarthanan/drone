<?php
class Stored_card extends ROCKERS_Controller 
{
	/*
	Function name :Stored_card()
	Description :Its Default Constuctor which called when stored_card object initialzie.its load necesary models
	*/
	
	function Stored_card()
	{
		parent::__construct();	
		$this->load->model('home_model');
		$this->load->model('worker_model');	
		$this->load->model('user_model');	
		$this->load->model('user_other_model');
		$this->load->model('stored_card_model');
		$this->load->model('wallet_model');	
	}
	
	
	/*
	Function name :index()
	Parameter :none
	Return : none
	Use : verify user identity using a credit card to protect our runner against mischievous users.
	Description : verify user identity using a credit card to protect our runner against mischievous users which is called by http://hostname/stored_card
	*/
	
	
	public function index()
	{
		
		$user_info=$this->user_model->get_user_info(get_authenticateUserID());
		$data['user_info']=$user_info;
		
		$site_setting=site_setting();
		
		
		$card_info=$this->stored_card_model->get_user_card_info();
		
		$data['card_info']=$card_info;
		
		
		
		$this->form_validation->set_rules('card_first_name', 'First Name', 'required|alpha');
		$this->form_validation->set_rules('card_last_name', 'Last Name', 'required|alpha');
		$this->form_validation->set_rules('cardnumber', 'Card Number', 'required|integer|numeric');	
		$this->form_validation->set_rules('cardtype', 'Card Type', 'required|alpha');
		
		$this->form_validation->set_rules('card_expiration_month', 'Expiration Month', 'required|integer');
		$this->form_validation->set_rules('card_expiration_year', 'Expiration Year', 'required|integer');
		
		if($this->input->post('user_location_id')!='' && $this->input->post('user_location_id')>0 && $this->input->post('user_location_id')!='other')
		{
		
		}
		
		else
		{
			$this->form_validation->set_rules('card_address', 'Address', 'required');
			$this->form_validation->set_rules('card_city', 'City', 'required|alpha_space');
			$this->form_validation->set_rules('card_state', 'State', 'required|alpha_space');
			$this->form_validation->set_rules('card_zipcode', 'Postal Code', 'required|alpha_numeric|min_length['.$site_setting->zipcode_min.']|max_length['.$site_setting->zipcode_max.']');	
			
		}
			
		
		
		
		if($this->form_validation->run() == FALSE)
		{
				if(validation_errors())
				{													
					$data["error"] = validation_errors();
				}
				else
				{		
					$data["error"] = "";							
				}
				
				
				if($_POST)
				{
				
					$data['card_first_name']=$this->input->post('card_first_name');
					$data['card_last_name']=$this->input->post('card_last_name');
					$data['cardnumber']=$this->input->post('cardnumber');
					$data['cardtype']=$this->input->post('cardtype');
					$data['card_expiration_month']=$this->input->post('card_expiration_month');
					$data['card_expiration_year']=$this->input->post('card_expiration_year');	
					
					$data['user_location_id']=$this->input->post('user_location_id');	
					$data['card_address']=$this->input->post('card_address');	
					$data['card_city']=$this->input->post('card_city');	
					$data['card_state']=$this->input->post('card_state');	
					$data['card_zipcode']=$this->input->post('card_zipcode');					
					
					$data['card_verify_status']='';
					
					$data['save_location']=$this->input->post('save_location');	
						
				
				}
				
				else
				{
					
					if($card_info)
					{	
						$data['card_first_name']=$card_info->card_first_name;
						$data['card_last_name']=$card_info->card_last_name;
						$data['cardnumber']=$card_info->card_number;
						$data['cardtype']=$card_info->card_type;
						$data['card_expiration_month']=$card_info->card_expiration_month;
						$data['card_expiration_year']=$card_info->card_expiration_year;						
						
						$data['user_location_id']=$card_info->user_location_id;
						$data['card_address']=$card_info->card_address;
						$data['card_city']=$card_info->card_city;
						$data['card_state']=$card_info->card_state;
						$data['card_zipcode']=$card_info->card_zipcode;
						$data['card_expiration_year']=$card_info->card_expiration_year;
						$data['card_verify_status']=$card_info->card_verify_status;
						
						$data['save_location']='';
						
						
					}
					
					else
					{
						
						$data['card_first_name']=$this->input->post('card_first_name');
						$data['card_last_name']=$this->input->post('card_last_name');
						$data['cardnumber']=$this->input->post('cardnumber');
						$data['cardtype']=$this->input->post('cardtype');
						$data['card_expiration_month']=$this->input->post('card_expiration_month');
						$data['card_expiration_year']=$this->input->post('card_expiration_year');	
						
						$data['user_location_id']=$this->input->post('user_location_id');	
						$data['card_address']=$this->input->post('card_address');	
						$data['card_city']=$this->input->post('card_city');	
						$data['card_state']=$this->input->post('card_state');	
						$data['card_zipcode']=$this->input->post('card_zipcode');	
						
						$data['card_verify_status']='';				
						
						$data['save_location']=$this->input->post('save_location');	
						
					}
					
				}
				
		
				
		} else	{
							
		
		
		
		
		$paymentType='Authorization';
		$gateway_id='3';
		$amount=0.1;
		
		////////////////////=============authorize part================
		
		
			$this->load->library('creditcard');		
			$gateways=$this->wallet_model->get_gateway_detailByid($gateway_id);	
			$config=array();		
			
			foreach($gateways as $gatewaydetail)
			{
			$gatewaydetail1=(array) $gatewaydetail;
			$config[$gatewaydetail1["name"]]=$gatewaydetail1["value"];
			
			}
			
			
			$crditobj=$this->creditcard->config($config);
			
			
			/**
			 * Get required parameters from the web form for the request
			 */
			$paymentType =urlencode( $paymentType);
			$firstName =urlencode( $_POST['card_first_name']);
			$lastName =urlencode( $_POST['card_last_name']);
			$creditCardType =urlencode( $_POST['cardtype']);
			$creditCardNumber = urlencode($_POST['cardnumber']);
			$expDateMonth =urlencode( $_POST['card_expiration_month']);
			
			// Month must be padded with leading zero
			$padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);
			
			$expDateYear =urlencode( $_POST['card_expiration_year']);
			//$cvv2Number = urlencode($_POST['cvv2Number']);
			$cvv2Number='';
			
			
			
			///////===location part====
			
			if($this->input->post('user_location_id')!='' && $this->input->post('user_location_id')>0)
			{
			
				$location_detail=$this->user_model->get_user_location_detail($this->input->post('user_location_id'));
				
				if($location_detail)
				{
					$address1 = urlencode($location_detail->location_address);		
					$city = urlencode($location_detail->location_city);
					$state =urlencode( $location_detail->location_state);
					$zip = urlencode($location_detail->location_zipcode);				
				}
				
				else
				{
				
					$address1 = urlencode($_POST['card_address']);		
					$city = urlencode($_POST['card_city']);
					$state =urlencode( $_POST['card_state']);
					$zip = urlencode($_POST['card_zipcode']);
				
				}
			
			}
			
			else
			{
			
				$address1 = urlencode($_POST['card_address']);		
				$city = urlencode($_POST['card_city']);
				$state =urlencode( $_POST['card_state']);
				$zip = urlencode($_POST['card_zipcode']);
			
			}
			
			
			
			$amount = urlencode($amount);
			$currencyCode="USD";
			$paymentType=urlencode($paymentType);
			
			/* Construct the request string that will be sent to PayPal.
			   The variable $nvpstr contains all the variables and is a
			   name value pair string with & as a delimiter */
			$nvpstr="&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".         $padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=$state".
			"&ZIP=$zip&COUNTRYCODE=US&CURRENCYCODE=$currencyCode";
			
			
			
			/* Make the API call to PayPal, using API signature.
			   The API response is stored in an associative array called $resArray */
			$resArray=$this->creditcard->hash_call("doDirectPayment",$nvpstr);
		//	var_dump($resArray);
			//exit;
			/* Display the API response back to the browser.
			   If the response from PayPal was a success, display the response parameters'
			   If the response was an error, display the errors received using APIError.php.
			   */
			$ack = strtoupper($resArray["ACK"]);
			
			  if($ack!="SUCCESS") 
			  {
				  	$data['error']="fail";
					
						$data['card_first_name']=$this->input->post('card_first_name');
						$data['card_last_name']=$this->input->post('card_last_name');
						$data['cardnumber']=$this->input->post('cardnumber');
						$data['cardtype']=$this->input->post('cardtype');
						$data['card_expiration_month']=$this->input->post('card_expiration_month');
						$data['card_expiration_year']=$this->input->post('card_expiration_year');	
						
						$data['user_location_id']=$this->input->post('user_location_id');	
						$data['card_address']=$this->input->post('card_address');	
						$data['card_city']=$this->input->post('card_city');	
						$data['card_state']=$this->input->post('card_state');	
						$data['card_zipcode']=$this->input->post('card_zipcode');					
						
						$data['save_location']=$this->input->post('save_location');	
						$data['card_verify_status']='';
			   }
			   else
			   {
				  
							
					$txnid=$resArray['TRANSACTIONID'];
				
				 $user_location_id='';
					 
					if($this->input->post('user_location_id')!='' && $this->input->post('user_location_id')>0 && $this->input->post('user_location_id')!='other') 
					{
				 		 $user_location_id=$this->input->post('user_location_id');
				  }
				  
				  
					
				 	 $data_card=array(
						'card_first_name' => $firstName,
						'user_id'=>get_authenticateUserID(),
						'card_last_name' =>  $lastName,
						'card_type' => $creditCardType,
						'card_number' => $creditCardNumber,
						'card_expiration_month' => $expDateMonth,
						'card_expiration_year' => $expDateYear,
						'user_location_id'=>$user_location_id,
						'card_address' => urldecode($address1),
						'card_city' => urldecode($city),
						'card_state' => urldecode($state),
						'card_zipcode'=>urldecode($zip),
						'card_transaction_id'=>$txnid,
						'card_verify_status'=>1,
						'card_date'=>date('Y-m-d H:i:s'),
						'card_ip'=>$_SERVER['REMOTE_ADDR']
					);	
					
					
					$check_record=$this->db->get_where('user_card_info',array('user_id'=>get_authenticateUserID()));
					
					if($check_record->num_rows()>0)
					{		
						$this->db->where('user_id',get_authenticateUserID());
						$update_card=$this->db->update('user_card_info',$data_card);		
					}
					else
					{
						$add_card=$this->db->insert('user_card_info',$data_card);		
					}
					
					
					
					$save_location=$this->input->post('save_location');
			
					if($save_location==1)
					{
					
						$data_location2=array(
							'user_id'=>get_authenticateUserID(),				
							'location_name' => 'Billing',
							'location_address' => urldecode($address1),
							'location_city' => urldecode($city),
							'location_state' => urldecode($state),
							'location_zipcode' => $zip,
							'location_date'=>date('Y-m-d H:i:s'),						
						);
						
						$this->db->insert('user_location',$data_location2);
					
					}
						
					
					$data['error']="update";
					
					
					$card_info=$this->stored_card_model->get_user_card_info();		
					$data['card_info']=$card_info;
		
		
				
					$data['card_first_name']=$card_info->card_first_name;
					$data['card_last_name']=$card_info->card_last_name;
					$data['cardnumber']=$card_info->card_number;
					$data['cardtype']=$card_info->card_type;
					$data['card_expiration_month']=$card_info->card_expiration_month;
					$data['card_expiration_year']=$card_info->card_expiration_year;						
					
					$data['user_location_id']=$card_info->user_location_id;
					$data['card_address']=$card_info->card_address;
					$data['card_city']=$card_info->card_city;
					$data['card_state']=$card_info->card_state;
					$data['card_zipcode']=$card_info->card_zipcode;
					$data['card_expiration_year']=$card_info->card_expiration_year;
					$data['card_verify_status']=$card_info->card_verify_status;
					$data['save_location']='';
				
				
				
			   }
		
		
		////////////////////=============authorize part================
		
		
		
		
			
			
			
			
			
	   }	
			   
			   
			   
		
		$data['user_location']= $this->user_other_model->get_locations_list();
		$data['activities']='';
			
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data['theme']=$theme;
		
		$meta_setting=meta_setting();
		
		$pageTitle='Set up your credit card - '.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->title;
		$metaDescription='Set up your credit card : '.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_description;
		$metaKeyword='Set up your credit card : '.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_keyword;
		
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/wallet/stored_card',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();	
		
	
		
		
	}
	
}

?>