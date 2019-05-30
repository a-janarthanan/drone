<?php
class Wallet extends ROCKERS_Controller 
{
	
	/*
	Function name :wallet()
	Description :Its Default Constuctor which called when wallet object initialzie.its load necesary models
	*/
	
	function Wallet()
	{
		parent::__construct();	
		$this->load->model('wallet_model');	
		$this->load->model('home_model');	
		$this->load->model('user_model');	
		$this->load->model('task_model');
		$this->load->model('worker_model');
		$this->load->model('user_other_model');	
	}
	
	/*
	Function name :index()
	Parameter : $offset (for paging) , $msg (custom message)
	Return : array list of all user wallet transaction
	Use : User wallet history
	Description :its default function which called http://hostname/wallet	
	*/
	
	public function index($offset=0,$msg='')
	{
		
		if(!check_user_authentication()) {  redirect('sign_up'); } 
		
		$user_info=$this->user_model->get_user_info(get_authenticateUserID());
		$wallet_setting=wallet_setting();		
		if($wallet_setting->wallet_enable==0)
		{
			redirect('dashboard');
		}
		
		
		
		$this->load->library('pagination');		
		$limit = '15';
		//$config['uri_segment']='4';
		$config['base_url'] = site_url('wallet/index');
		$config['total_rows'] = $this->wallet_model->get_total_my_wallet_list();
		$config['per_page'] = $limit;				
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();		
		$data['limit']=$limit;
		$data['total_rows']=$config['total_rows'];	
		$data['offset']=$offset;			
		$data['wallet_details']=$this->wallet_model->my_wallet_list($offset,$limit);		
		$data['total_wallet_amount']=$this->wallet_model->my_wallet_amount(); 		
		$data['wallet_setting']=$wallet_setting;		
		$data['msg']=$msg;		
		$theme = getThemeName();
		$data['site_setting']=site_setting();
		$this->template->set_master_template($theme .'/template.php');
		
		$data['theme']=$theme;		
		$meta_setting=meta_setting();		
		$pageTitle='Wallet History-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->title;
		$metaDescription='Wallet History-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_description;
		$metaKeyword='Wallet History-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_keyword;		
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/wallet/index',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();	
		
	}
	
	
	/*
	Function name :add_wallet()
	Parameter : none
	Return : none, redirect to payment gateway function
	Use : User can add amount in wallet using any active installed payment gateway 
	Description : user can add amount in his/her wallet using this function which called http://hostname/add_wallet
	*/
	
	
	function add_wallet()
	{	
		if(!check_user_authentication()) {  redirect('sign_up'); } 
		
	    $site_setting=site_setting();
		$wallet_setting=$this->wallet_model->wallet_setting();		
		if($wallet_setting->wallet_enable==0)
		{
			redirect('dashboard');
		}		
		
		
		$minimum_amount=$wallet_setting->wallet_minimum_amount;		
		$chk_amt=$this->input->post('credit');		
		$amount_error='success';		
		if($this->input->post('credit')) 
		{
		
			if($chk_amt<$minimum_amount)
			{
				$amount_error='fail';			
			}
		
		}
		
		$this->load->library('form_validation');		
		$this->form_validation->set_rules('credit', "Amount", 'required|numeric');
		$this->form_validation->set_rules('gateway_type', "Gateway Type", 'required');
		
		if($this->form_validation->run() == FALSE || $amount_error=='fail')
		{	
				if($amount_error=='fail')
				{
					$amount_error="<p>"."You can not add less then amount ".$site_setting->currency_symbol.$minimum_amount." in wallet.</p>";
				}
				else
				{
					$amount_error='';
				}	
			
				if(validation_errors() || $amount_error!='')
				{
					$data['error'] = validation_errors().$amount_error;
							
				} else{
					$data["error"] = "";
				}	
		
				$data['payment'] = $this->wallet_model->get_paymentact_result();				
				$data['wallet_setting']=$wallet_setting;		
				$data["credit"] = $this->input->post('credit');
				$data["gateway_type"] = $this->input->post('gateway_type');				
				$data['total_wallet_amount']=$this->wallet_model->my_wallet_amount(); 			
				
			
				$theme = getThemeName();
				$data['site_setting']=site_setting();
				$this->template->set_master_template($theme .'/template.php');				
				$data['theme']=$theme;				
				$meta_setting=meta_setting();
				$user_info = $this->user_model->get_user_info(get_authenticateUserID());				
				$pageTitle='Deposit-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->title;
				$metaDescription='Deposit-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_description;
				$metaKeyword='Deposit-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_keyword;	
				$this->template->write('pageTitle',$pageTitle,TRUE);
				$this->template->write('metaDescription',$metaDescription,TRUE);
				$this->template->write('metaKeyword',$metaKeyword,TRUE);
				$this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
				$this->template->write_view('content_center',$theme .'/layout/wallet/add_wallet',$data,TRUE);
				$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
				$this->template->render();	
			}
			else
			{	
				$gateway_id=$this->input->post('gateway_type');	
				$wallet_add_fees=$wallet_setting->wallet_add_fees;
				$amount=$this->input->post('credit');
		    	//$add_fees= number_format((($amount * $wallet_add_fees)/100),2);
				//$total= number_format(($add_fees + $amount),2);				
				
				$total=$amount;
				
				$total= str_replace(',','',$total);
				
				$modname='wallet';
			    $pay=$this->wallet_model->get_paymentid_result($gateway_id);	
				//var_dump($pay);exit;
				redirect('/wallet/'.trim($pay->function_name).'/'.$pay->id.'/'.$total);		
				
			}
	}
	
	
	
	
	///---------VCSPAY transaction function start from here
	/*
	Function name :auth_bcspay()
	Parameter : $id (payment gateway unquie ID), $amt (user added amount), $task_id (use for pay amount for user posted task), $task_comment_id (used for getting runner offer price)
	Return : redirect to virtual transection
	Use : User total amount and othet paypal setting which is set by administrator for adding amount in admin live paypal account
	Description : user added amount pass to paypal.com where user pay amount or cancel transaction
	*/
	
	
	function auth_bcspay($id,$amt,$task_id=0,$task_comment_id=0)
	{
			
			if(!check_user_authentication()) {  redirect('sign_up'); } 
			
			
			$num='WL'.randomCode();
			
			$this->load->library('bcspay_lib');
			
			$url=$this->wallet_model->get_gateway_result($id,'url');			
			$p1=$this->wallet_model->get_gateway_result($id,'p1');
			$hash=$this->wallet_model->get_gateway_result($id,'hash');
			$hash=(array) $hash;
			$p1=(array) $p1;
			
				$wallet_setting=$this->wallet_model->wallet_setting();			
				$wallet_add_fees=$wallet_setting->wallet_add_fees;
				
				
				if($task_id!=0 && $task_id>0 && $task_comment_id!=0 && $task_comment_id>0)
				{
						
						$task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
						
						if($task_detail)
						{
						
							///////==========total amount====
				
							$task_setting=task_setting();
							
							$total=0;
							
							if($task_detail->extra_cost>0) {
							
							$total=$total+$task_detail->extra_cost;
							
							}
							
							
							
							////===get worker offer price=====
					
							$worker_id='';
							
							$get_worker_detail=$this->db->query("select * from ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up, ".$this->db->dbprefix('worker')." wrk, ".$this->db->dbprefix('worker_comment')." cmt where cmt.comment_post_user_id=us.user_id and us.user_id=up.user_id and us.user_id=wrk.user_id and cmt.task_comment_id='".$task_comment_id."'");
							
							
							if($get_worker_detail->num_rows()>0)
							{
							
								$comment_detail=$get_worker_detail->row();
								
								$worker_id=$comment_detail->worker_id;
							
									
								$total=$total+$comment_detail->offer_amount;
							 
							}
							 
							 ///////=======
					 
							 
							 
							 if($task_setting->task_post_fee>0) {
							 
							 $task_site_fee=number_format((($task_setting->task_post_fee*$total) / 100),2); 
						
								 $total=$total+$task_site_fee;
						
							}
								 
								 
								  $total=number_format($total,2);
								
								
						
								$amt=$total;		
		
		
				///////==========total amount====
				
						}
						
						
				
				}
				
				
				$amount=$amt;	
				
			$add_fees= number_format((($amount * $wallet_add_fees)/100),2);
			$total= number_format(($add_fees + $amount),2);
			
			$total= str_replace(',','',$total);
				
			
			$date=date('Y-m-d H:i:s');
			$ip=$_SERVER['REMOTE_ADDR'];		
			$user_id=get_authenticateUserID();
			$payer_status='';
			$gateway_id=$id;
						
			$admin_status='Review';
			
		  	$data=array(
				'debit' => $amount,
				'user_id' => $user_id,
				'status' => $payer_status,
				'admin_status' => $admin_status,
				'wallet_date' => $date,
				'wallet_transaction_id' => $num,
				'wallet_ip' => $ip	,
				'gateway_id' => $gateway_id				
			);					
			$add_wallet=$this->db->insert('wallet',$data);
			$_SESSION["add_wallet"]=$this->db->insert_id();
			$meta_setting=meta_setting();
			$user_info = $this->user_model->get_user_info(get_authenticateUserID());
			$data['site_setting']=(array)site_setting();
			$user_detail=(array)$user_info;
			$site_setting=$data['site_setting'];
			$comment='Wallet on TASKIT.com';
			$this->bcspay_lib->add_field('p5',$site_setting['currency_code']);
			$this->bcspay_lib->add_field('p3', $comment);
			$this->bcspay_lib->add_field('p1', $p1["value"]);
			$this->bcspay_lib->add_field('p2', $num);
			$this->bcspay_lib->add_field('p4', $total);
			$hashval=md5($p1["value"].$num.$comment.$total.$site_setting['currency_code']);
			//$this->bcspay_lib->add_field('hash', $hashval);
			//$this->bcspay_lib->add_field('p11', $email);
			$this->bcspay_lib->button('Add Amount to wallet');
			
			$data['bcspay_form'] = $this->bcspay_lib->bcspay_auto_form();
			
	}
	function bcspaysuccess($id,$task_id=0,$task_comment_id=0)
	{	
		$msg= "add";
		$admin_status='Review';
		$gateway_details=get_payment_gateway_details_by_id($id);
		if($gateway_details)
		{
			if($gateway_details->auto_confirm==1)
			{
				$admin_status='Confirm';
			}
		}
		$add_wallet=$_SESSION["add_wallet"];unset($_SESSION["add_wallet"]);
		$data = array(			
			'admin_status' => $admin_status
		);
		$this->db->where('id',$add_wallet);
		$this->db->update('wallet',$data);
		
		if($task_id!=0 && $task_id>0 && $task_comment_id!=0 && $task_comment_id>0)
		{
				
				$task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
				
				if($task_detail)
				{
					redirect('task/accept_offer/'.$task_id.'/'.$task_comment_id);
				}
				else
				{
					redirect('wallet/index/0/'.$msg);	
				}
				
		}
		else
		{
			redirect('wallet/index/0/'.$msg);	
		}
    }	
	function bcspaycancel($task_id=0,$task_comment_id=0)
	{		
		$msg= "fail";
		$add_wallet=$_SESSION["add_wallet"];unset($_SESSION["add_wallet"]);
		$query = $this->db->query("delete from ".$this->db->dbprefix('wallet')." where id='".$add_wallet."'");
			if($task_id!=0 && $task_id>0 && $task_comment_id!=0 && $task_comment_id>0)
			{
					
					$task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
					
					if($task_detail)
					{
						redirect('tasks/'.$task_detail->task_url_name);
					}
					else
					{
						redirect('wallet/index/0/'.$msg);	
					}
					
			}
			else
			{
				redirect('wallet/index/0/'.$msg);		
			}
	}
	
	///---------VCSPAY transaction function start from here
	/*
	Function name :auth_payu()
	Parameter : $id (payment gateway unquie ID), $amt (user added amount), $task_id (use for pay amount for user posted task), $task_comment_id (used for getting runner offer price)
	Return : redirect to virtual transection
	Use : User total amount and othet payu setting which is set by administrator for adding amount in admin live paypal account
	Description : user added amount pass to www.payu.co.za where user pay amount or cancel transaction
	*/
	
	
	function auth_payu($id,$amt,$task_id=0,$task_comment_id=0)
	{
			error_reporting(E_ALL);
			ini_set('display_errors', 1);
			ob_start();
			if(!check_user_authentication()) {  redirect('sign_up'); } 
			
			
			$num='WL'.randomCode();
			
			//$this->load->library('payu_lib');
			
			$safeKey=$this->wallet_model->get_gateway_result($id,'safeKey');			
			$soapUsername=$this->wallet_model->get_gateway_result($id,'soapUsername');
			$soapPassword=$this->wallet_model->get_gateway_result($id,'soapPassword');
			$safeKey=(array) $safeKey;
			$soapUsername=(array) $soapUsername;
			$soapPassword=(array) $soapPassword;
			
				$wallet_setting=$this->wallet_model->wallet_setting();			
				$wallet_add_fees=$wallet_setting->wallet_add_fees;
				
				
				if($task_id!=0 && $task_id>0 && $task_comment_id!=0 && $task_comment_id>0)
				{
						
						$task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
						
						if($task_detail)
						{
						
							///////==========total amount====
				
							$task_setting=task_setting();
							
							$total=0;
							
							if($task_detail->extra_cost>0) {
							
							$total=$total+$task_detail->extra_cost;
							
							}
							
							
							
							////===get worker offer price=====
					
							$worker_id='';
							
							$get_worker_detail=$this->db->query("select * from ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up, ".$this->db->dbprefix('worker')." wrk, ".$this->db->dbprefix('worker_comment')." cmt where cmt.comment_post_user_id=us.user_id and us.user_id=up.user_id and us.user_id=wrk.user_id and cmt.task_comment_id='".$task_comment_id."'");
							
							
							if($get_worker_detail->num_rows()>0)
							{
							
								$comment_detail=$get_worker_detail->row();
								
								$worker_id=$comment_detail->worker_id;
							
									
								$total=$total+$comment_detail->offer_amount;
							 
							}
							 
							 ///////=======
					 
							 
							 
							 if($task_setting->task_post_fee>0) {
							 
							 $task_site_fee=number_format((($task_setting->task_post_fee*$total) / 100),2); 
						
								 $total=$total+$task_site_fee;
						
							}
								 
								 
								  $total=number_format($total,2);
								
								
						
								$amt=$total;		
		
		
				///////==========total amount====
				
						}
						
						
				
				}
				
				
				$amount=$amt;	
				
			$add_fees= number_format((($amount * $wallet_add_fees)/100),2);
			$total= number_format(($add_fees + $amount),2);
			
			$total= str_replace(',','',$total);
				
			
			$date=date('Y-m-d H:i:s');
			$ip=$_SERVER['REMOTE_ADDR'];		
			$user_id=get_authenticateUserID();
			$payer_status='';
			$gateway_id=$id;
						
			$admin_status='Review';
			
		  	$data=array(
				'debit' => $amount,
				'user_id' => $user_id,
				'status' => $payer_status,
				'admin_status' => $admin_status,
				'wallet_date' => $date,
				'wallet_transaction_id' => $num,
				'wallet_ip' => $ip	,
				'gateway_id' => $gateway_id				
			);					
			$add_wallet=$this->db->insert('wallet',$data);
			$_SESSION["add_wallet"]=$this->db->insert_id();
			$meta_setting=meta_setting();
			$user_info = $this->user_model->get_user_info(get_authenticateUserID());
			$data['site_setting']=(array)site_setting();
			$user_detail=(array)$user_info;
			$site_setting=$data['site_setting'];
			$comment='Wallet on TASKIT.com';
			
			
			
			//-------------------------------------------------------------------
			//-------------------------------------------------------------------
			//-------
			//-------      Configs comes here
			//-------
			//-------------------------------------------------------------------
			//-------------------------------------------------------------------
			
			$baseUrl = 'https://staging.payu.co.za'; //staging environment URL
			//$baseUrl = 'https://secure.payu.co.za'; //production environment URL
			$soapWdslUrl = $baseUrl.'/service/PayUAPI?wsdl';
			$payuRppUrl = $baseUrl.'/rpp.do?PayUReference=';
			$apiVersion = 'ONE_ZERO';
			
			//set value != 1 if you dont want to auto redirect topayment page
			$doAutoRedirectToPaymentPage = 1;
			/*
			Store config details
			*/
			$safeKey = $safeKey['value'];
			$soapUsername = $soapUsername['value'];
			$soapPassword = $soapPassword['value'];
			
			
			
				
				// 1. Building the Soap array  of data to send    
				$setTransactionArray = array();    
				$setTransactionArray['Api'] = $apiVersion;
				$setTransactionArray['Safekey'] = $safeKey;
				$setTransactionArray['TransactionType'] = 'PAYMENT';		    
			
				$setTransactionArray['AdditionalInformation']['merchantReference'] = 10330456340;    
				$setTransactionArray['AdditionalInformation']['cancelUrl'] = site_url('wallet/payucancel/'.$task_id.'/'.$task_comment_id);
				$setTransactionArray['AdditionalInformation']['returnUrl'] = site_url('wallet/payusuccess/'.$task_id.'/'.$task_comment_id);
				$setTransactionArray['AdditionalInformation']['supportedPaymentMethods'] = 'CREDITCARD';
				
				$setTransactionArray['Basket']['description'] = "Add Amount to wallet";
				$setTransactionArray['Basket']['amountInCents'] = $total;
				$setTransactionArray['Basket']['currencyCode'] = $site_setting['currency_code'];
			
				$setTransactionArray['Customer']['merchantUserId'] = get_authenticateUserID();
				$setTransactionArray['Customer']['email'] = "john@doe.com";
				$setTransactionArray['Customer']['firstName'] = $user_detail['first_name'];
				$setTransactionArray['Customer']['lastName'] = $user_detail['last_name'];
				$setTransactionArray['Customer']['mobile'] = '0211234567';
				$setTransactionArray['Customer']['regionalId'] = '1234512345122';
				$setTransactionArray['Customer']['countryCode'] = $site_setting['currency_code'];
				
				// 2. Creating a XML header for sending in the soap heaeder (creating it raw a.k.a xml mode)
				$headerXml = '<wsse:Security SOAP-ENV:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">';
				$headerXml .= '<wsse:UsernameToken wsu:Id="UsernameToken-9" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">';
				$headerXml .= '<wsse:Username>'.$soapUsername.'</wsse:Username>';
				$headerXml .= '<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">'.$soapPassword.'</wsse:Password>';
				$headerXml .= '</wsse:UsernameToken>';
				$headerXml .= '</wsse:Security>';
				$headerbody = new SoapVar($headerXml, XSD_ANYXML, null, null, null);
			
				// 3. Create Soap Header.        
				$ns = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd'; //Namespace of the WS. 
				$header = new SOAPHeader($ns, 'Security', $headerbody, true);        
			
				// 4. Make new instance of the PHP Soap client
				$soap_client = new SoapClient($soapWdslUrl, array("trace" => 1, "exception" => 0)); 
			
				// 5. Set the Headers of soap client. 
				$soap_client->__setSoapHeaders($header); 
			
				// 6. Do the setTransaction soap call to PayU
				$soapCallResult = $soap_client->setTransaction($setTransactionArray); 
			
				// 7. Decode the Soap Call Result
				$returnData = json_decode(json_encode($soapCallResult),true);
				
				print "<br />-----------------------------------------------<br />\r\n";
				print "Return data decoded:<br />\r\n";
				print "-----------------------------------------------<br />\r\n";  
				print "<pre>";
				var_dump($returnData);
				print "</pre>";  
				if(isset($doAutoRedirectToPaymentPage) && ($doAutoRedirectToPaymentPage == 1) ) {
					if( (isset($returnData['return']['successful']) && ($returnData['return']['successful'] === true) && isset($returnData['return']['payUReference']) ) ) {			
						//Redirecting to payment page
						header('Location: '.$payuRppUrl.$returnData['return']['payUReference']);
						die();
					}
				}
					
			
			
			/*$this->bcspay_lib->add_field('p5',$site_setting['currency_code']);
			$this->bcspay_lib->add_field('p3', $comment);
			$this->bcspay_lib->add_field('p1', $p1["value"]);
			$this->bcspay_lib->add_field('p2', $num);
			$this->bcspay_lib->add_field('p4', $total);
			$hashval=md5($p1["value"].$num.$comment.$total.$site_setting['currency_code']);
			//$this->bcspay_lib->add_field('hash', $hashval);
			//$this->bcspay_lib->add_field('p11', $email);
			$this->bcspay_lib->button('Add Amount to wallet');
			
			$data['bcspay_form'] = $this->bcspay_lib->bcspay_auto_form();*/
			
	}
	function payusuccess($id,$task_id=0,$task_comment_id=0)
	{	
		$msg= "add";
		$admin_status='Review';
		//-------------------------------------------------------------------
		//-------------------------------------------------------------------
		//-------
		//-------      Checking response
		//-------
		//-------------------------------------------------------------------
		//-------------------------------------------------------------------
		if(is_object($soap_client)) {    
			
			print "<br />-----------------------------------------------<br />\r\n";
			print "Request in XML:<br />\r\n";
			print "-----------------------------------------------<br />\r\n";                
			echo str_replace( '&gt;&lt;' , '&gt;<br />&lt;', htmlspecialchars( $soap_client->__getLastRequest(), ENT_QUOTES));     
			print "\r\n<br />";
			print "-----------------------------------------------<br />\r\n";
			print "Response in XML:<br />\r\n";
			print "-----------------------------------------------<br />\r\n";
			echo str_replace( '&gt;&lt;' , '&gt;<br />&lt;', htmlspecialchars( $soap_client->__getLastResponse(), ENT_QUOTES));         
		} 
		$gateway_details=get_payment_gateway_details_by_id($id);
		if($gateway_details)
		{
			if($gateway_details->auto_confirm==1)
			{
				$admin_status='Confirm';
			}
		}
		$add_wallet=$_SESSION["add_wallet"];unset($_SESSION["add_wallet"]);
		$data = array(			
			'admin_status' => $admin_status
		);
		$this->db->where('id',$add_wallet);
		$this->db->update('wallet',$data);
		
		if($task_id!=0 && $task_id>0 && $task_comment_id!=0 && $task_comment_id>0)
		{
				
				$task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
				
				if($task_detail)
				{
					redirect('task/accept_offer/'.$task_id.'/'.$task_comment_id);
				}
				else
				{
					redirect('wallet/index/0/'.$msg);	
				}
				
		}
		else
		{
			redirect('wallet/index/0/'.$msg);	
		}
    }	
	function payucancel($task_id=0,$task_comment_id=0)
	{		
		$msg= "fail";
		$add_wallet=$_SESSION["add_wallet"];unset($_SESSION["add_wallet"]);
		$query = $this->db->query("delete from ".$this->db->dbprefix('wallet')." where id='".$add_wallet."'");
		if($task_id!=0 && $task_id>0 && $task_comment_id!=0 && $task_comment_id>0)
		{
				
				$task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
				
				if($task_detail)
				{
					redirect('tasks/'.$task_detail->task_url_name);
				}
				else
				{
					redirect('wallet/index/0/'.$msg);	
				}
				
		}
		else
		{
			redirect('wallet/index/0/'.$msg);		
		}
	}
	
	
	///---------paypal transaction function start from here
	/*
	Function name :paypal()
	Parameter : $id (payment gateway unquie ID), $amt (user added amount), $task_id (use for pay amount for user posted task), $task_comment_id (used for getting runner offer price)
	Return : redirect to paypal.com
	Use : User total amount and othet paypal setting which is set by administrator for adding amount in admin live paypal account
	Description : user added amount pass to paypal.com where user pay amount or cancel transaction
	*/
	
	
	
	function paypal($id,$amt,$task_id=0,$task_comment_id=0)
	{
			
			if(!check_user_authentication()) {  redirect('sign_up'); } 
			
			
			$num='WL'.randomCode();
			
			$this->load->library('paypal_lib');
			
			$Paypal_Email=$this->wallet_model->get_gateway_result($id,'paypal_email');			
			$Paypal_Status=$this->wallet_model->get_gateway_result($id,'site_status');
			$Paypal_Status=(array) $Paypal_Status;
			$Paypal_Email=(array) $Paypal_Email;
			
			$Paypal_Url='https://www.sandbox.paypal.com/cgi-bin/webscri';
			
			if($Paypal_Status['value']=='sandbox')
			{
				$Paypal_Url='https://www.sandbox.paypal.com/cgi-bin/webscri';
			}
			if($Paypal_Status['value']=='live')
			{
				$Paypal_Url='https://www.paypal.com/cgi-bin/webscri';
			}
			
			
			
				$wallet_setting=$this->wallet_model->wallet_setting();			
				$wallet_add_fees=$wallet_setting->wallet_add_fees;
				
				
				if($task_id!=0 && $task_id>0 && $task_comment_id!=0 && $task_comment_id>0)
				{
						
						$task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
						
						if($task_detail)
						{
						
							///////==========total amount====
				
							$task_setting=task_setting();
							
							$total=0;
							
							if($task_detail->extra_cost>0) {
							
							$total=$total+$task_detail->extra_cost;
							
							}
							
							
							
							////===get worker offer price=====
					
							$worker_id='';
							
							$get_worker_detail=$this->db->query("select * from ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up, ".$this->db->dbprefix('worker')." wrk, ".$this->db->dbprefix('worker_comment')." cmt where cmt.comment_post_user_id=us.user_id and us.user_id=up.user_id and us.user_id=wrk.user_id and cmt.task_comment_id='".$task_comment_id."'");
							
							
							if($get_worker_detail->num_rows()>0)
							{
							
								$comment_detail=$get_worker_detail->row();
								
								$worker_id=$comment_detail->worker_id;
							
									
								$total=$total+$comment_detail->offer_amount;
							 
							}
							 
							 ///////=======
					 
							 
							 
							 if($task_setting->task_post_fee>0) {
							 
							 $task_site_fee=number_format((($task_setting->task_post_fee*$total) / 100),2); 
						
								 $total=$total+$task_site_fee;
						
							}
								 
								 
								  $total=number_format($total,2);
								
								
						
								$amt=$total;		
		
		
				///////==========total amount====
				
						}
						
						
				
				}
				
				
				$amount=$amt;	
				
				
				
		    	$add_fees= number_format((($amount * $wallet_add_fees)/100),2);
				$total= number_format(($add_fees + $amount),2);
				
				$total= str_replace(',','',$total);
				
			
			$meta_setting=meta_setting();
			$user_info = $this->user_model->get_user_info(get_authenticateUserID());
			$data['site_setting']=(array)site_setting();
			$user_detail=(array)$user_info;
			$site_setting=$data['site_setting'];
			$this->paypal_lib->add_field('currency_code',$site_setting['currency_code']);
			$this->paypal_lib->add_field('business', $Paypal_Email['value']);
			$this->paypal_lib->add_field('return', site_url('wallet/paypalsuccess/'.$task_id.'/'.$task_comment_id));
			$this->paypal_lib->add_field('cancel_return', site_url('wallet/paypalcancel/'.$task_id.'/'.$task_comment_id));
			$this->paypal_lib->add_field('notify_url', site_url('wallet/paypalipn/')); // <-- IPN url
			$this->paypal_lib->add_field('custom', $amt.'#'.$id.'#'.get_authenticateUserID()); // <-- Verify return
			$this->paypal_lib->paypal_url= $Paypal_Url;			
						
			$this->paypal_lib->add_field('item_name', 'New Fund added in the Wallet in '.$site_setting['site_name'].' by '.$user_detail['first_name'].' '.$user_detail['last_name']);
			$this->paypal_lib->add_field('item_number', $num);
			$this->paypal_lib->add_field('amount', $total);
	
			$this->paypal_lib->button('Add Amount to wallet');
			
			$data['paypal_form'] = $this->paypal_lib->paypal_auto_form();
			
	}
	
	
	
	
	/*
	Function name :paypalsuccess()
	Parameter : $task_id (use for pay amount for user posted task), $task_comment_id (used for getting runner offer price)
	Return : redirect to wallet history page function or task detail page
	Use : When user successfully paid amount on paypal then user will redirect here.
	Description : paypal.com redirect to this function which called http://hostname/paypalsuccess
	*/
	
	
	
		
	function paypalsuccess($task_id=0,$task_comment_id=0)
	{
			
			$msg= "add";
			
				if($task_id!=0 && $task_id>0 && $task_comment_id!=0 && $task_comment_id>0)
				{
						
						$task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
						
						if($task_detail)
						{
							redirect('task/accept_offer/'.$task_id.'/'.$task_comment_id);
						}
						else
						{
							redirect('wallet/index/0/'.$msg);	
						}
						
				}
				else
				{
					redirect('wallet/index/0/'.$msg);	
				}
			
    }	
	
	
	
	/*
	Function name :paypalcancel()
	Parameter : $task_id (use for pay amount for user posted task), $task_comment_id (used for getting runner offer price)
	Return : redirect to wallet history page function or task detail page
	Use : When user cancel transaction on paypal then user will redirect here.
	Description : paypal.com redirect to this function which called http://hostname/paypalcancel
	*/
	
	
	function paypalcancel($task_id=0,$task_comment_id=0)
	{		
			$msg= "fail";
			
				if($task_id!=0 && $task_id>0 && $task_comment_id!=0 && $task_comment_id>0)
				{
						
						$task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
						
						if($task_detail)
						{
							redirect('tasks/'.$task_detail->task_url_name);
						}
						else
						{
							redirect('wallet/index/0/'.$msg);	
						}
						
				}
				else
				{
					redirect('wallet/index/0/'.$msg);		
				}
	}
	
	
	/*
	Function name :paypalipn()
	Parameter : none
	Return : none
	Use : When user successfully paid amount on paypal then user transaction information send in this function.
	Description : paypal.com send user transaction information to this function which called http://hostname/paypalcancel
	*/

	function paypalipn()
	{	
		$vals = array();
		$strtemp='';
		foreach ($_POST as $key => $value) 
		{					
			$vals[$key] = $value;
			$strtemp.= $key."=".$value.",";
		}
		      
		$wallet_setting=wallet_setting();		
		
		
		$no_payment_after_auto_confirm=$wallet_setting->no_payment_after_auto_confirm;
		
			
			$status=$_POST['payment_status'];
			$custom=explode('#',$_POST['custom']);
			$gateway_id=$custom[1];
			$custom_amt=$custom[0];
			$pay_gross=$_POST['mc_gross'];
			$payee_email=$_POST['payer_email'];
			$payer_status =$_POST['payer_status'];
			$txn_id=$_POST['txn_id'];
			$date=date('Y-m-d H:i:s');
			$ip=$_SERVER['REMOTE_ADDR'];
			$user_id=$custom[2];
			$user_info = $this->user_model->get_user_info($user_id);
			$login_user=(array)$user_info;
			
			
			$chk_transaction_id=$this->wallet_model->check_unique_transaction($txn_id);
			
			
			$strtemp.= "chk_transaction_id=".$chk_transaction_id.",";
			
			
			log_message('error',"PAYPAL IPN DATA:".$strtemp);
			
			if((strtolower($status)=='completed' || strtolower($status)=='pending') && $pay_gross>=$custom_amt && $chk_transaction_id==0)
			{
				$admin_status='Review';
					
				$gateway_details=get_payment_gateway_details_by_id($gateway_id);
					
					if($gateway_details)
					{
						if($gateway_details->auto_confirm==1)
						{
							$admin_status='Confirm';
						}
					}
					
					
				  
				  
				    $chk_status_admin=$this->db->query("select * from ".$this->db->dbprefix('wallet')." where user_id='".$user_id."' and admin_status='Confirm'");
					
					
					if($chk_status_admin->num_rows()>$no_payment_after_auto_confirm)
					{
							$admin_status='Confirm';
					}
					
					
					
					
					
					$data=array(
					'debit' => $custom_amt,
					'user_id' => $user_id,
					'status' => $payer_status,
					'admin_status' => $admin_status,
					'wallet_date' => $date,
					'wallet_transaction_id' => $txn_id,
					'wallet_payee_email' => $payee_email,
					'wallet_ip' => $ip	,
					'gateway_id' => $gateway_id				
					);					
					$add_wallet=$this->db->insert('wallet',$data);										
			}
				
	}
	
	
	
	
	///---------paypal credit card function start from here
	
	
	
	
	/*
	Function name :creditcard()
	Parameter : $id (payment gateway unquie ID), $amt (user added amount), $task_id (use for pay amount for user posted task), $task_comment_id (used for getting runner offer price)
	Return : none
	Use : User total amount and othet credit card setting which is set by administrator used for adding amount in admin live account
	Description : user can enter his/her credit card information and pay amount or cancel transaction. This function which called http://hostname/creditcard
	
	NOTE : User Credit Card Information is not save any where in this script or database.
	*/
	
	
	function creditcard($id='',$amt='',$task_id='',$task_comment_id='')
	{
		
		if(!check_user_authentication()) {  redirect('sign_up'); } 
		
		$wallet_setting=wallet_setting();
		$data['wallet_setting']=$wallet_setting;
		
		$site_setting=site_setting();
			$data['site_setting']=site_setting();
		
		$this->load->library('form_validation');		
		$this->form_validation->set_rules('firstName', "firstName", 'required');
		$this->form_validation->set_rules('lastName', "lastName", 'required');
		
		$this->form_validation->set_rules('creditCardNumber', 'Card Number', 'required|integer|numeric');	
		$this->form_validation->set_rules('creditCardType', 'Card Type', 'required|alpha');
		
		$this->form_validation->set_rules('expDateMonth', 'Expiration Month', 'required|integer');
		$this->form_validation->set_rules('expDateYear', 'Expiration Year', 'required|integer');
		
	    $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');	
			
			
		$this->form_validation->set_rules('address1', 'Address1', 'required');
		$this->form_validation->set_rules('city', 'City', 'required|alpha_space');
		$this->form_validation->set_rules('state', 'State', 'required|alpha_space');
		$this->form_validation->set_rules('zip', 'Postal Code', 'required|alpha_numeric|min_length['.$site_setting->zipcode_min.']|max_length['.$site_setting->zipcode_max.']');	
		
		
		$data['paymentType']='Sale';
		$data['id']=$id;
		
		$data['task_id']=$task_id;
			$data['task_comment_id']=$task_comment_id;
		
		
		
		if($task_id!=0 && $task_id>0 && $task_comment_id!=0 && $task_comment_id>0)
		{
						
						$task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
						
						if($task_detail)
						{
						
							///////==========total amount====
				
							$task_setting=task_setting();
							
							$total=0;
							
							if($task_detail->extra_cost>0) {
							
							$total=$total+$task_detail->extra_cost;
							
							}
							
							
							
							////===get worker offer price=====
					
							$worker_id='';
							
							$get_worker_detail=$this->db->query("select * from ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up, ".$this->db->dbprefix('worker')." wrk, ".$this->db->dbprefix('worker_comment')." cmt where cmt.comment_post_user_id=us.user_id and us.user_id=up.user_id and us.user_id=wrk.user_id and cmt.task_comment_id='".$task_comment_id."'");
							
							
							if($get_worker_detail->num_rows()>0)
							{
							
								$comment_detail=$get_worker_detail->row();
								
								$worker_id=$comment_detail->worker_id;
							
									
								$total=$total+$comment_detail->offer_amount;
							 
							}
							 
							 ///////=======
					 
							 
							 
							 if($task_setting->task_post_fee>0) {
							 
							 $task_site_fee=number_format((($task_setting->task_post_fee*$total) / 100),2); 
						
								 $total=$total+$task_site_fee;
						
							}
								 
								 
								  $total=number_format($total,2);
								
								
						
								$amt=$total;		
		
		
				///////==========total amount====
				
						}
						
						
				
				}
				
		$data['amt']=$amt;		
				
				
		
		
		if($this->form_validation->run() == FALSE )
		{
		
		  	  if(validation_errors())
				{													
					$data["error"] = validation_errors();
				}
				else
				{		
					$data["error"] = "";							
				}
				
				
			    $theme = getThemeName();
			
				$this->template->set_master_template($theme .'/template.php');				
				$data['theme']=$theme;				
				$meta_setting=meta_setting();
				$user_info = $this->user_model->get_user_info(get_authenticateUserID());
				$data['first_name']=$user_info->first_name;		
				$data['last_name']=$user_info->last_name;		
				$data['total_wallet_amount']=$this->wallet_model->my_wallet_amount(); 	
				$pageTitle='Deposit-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->title;
				$metaDescription='Deposit-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_description;
				$metaKeyword='Deposit-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_keyword;	
				$this->template->write('pageTitle',$pageTitle,TRUE);
				$this->template->write('metaDescription',$metaDescription,TRUE);
				$this->template->write('metaKeyword',$metaKeyword,TRUE);
				$this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
				$this->template->write_view('content_center',$theme .'/layout/wallet/creditcard',$data,TRUE);
				$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
				$this->template->render();	
		}
		else
		{
			$num='WL'.randomCode();			
			$this->load->library('paypal_lib');		
			$this->load->library('creditcard');		
			$gateways=$this->wallet_model->get_gateway_detailByid($id);	
			$config=array();		
			//$gateways=(array) $gateways;
				//var_dump($gateways);
			//exit;
			foreach($gateways as $gatewaydetail)
			{
			$gatewaydetail1=(array) $gatewaydetail;
			$config[$gatewaydetail1["name"]]=$gatewaydetail1["value"];
			
			}
			$crditobj=$this->creditcard->config($config);
			//exit;
			/**
			 * Get required parameters from the web form for the request
			 */
			$paymentType =urlencode( $_POST['paymentType']);
			$firstName =urlencode( $_POST['firstName']);
			$lastName =urlencode( $_POST['lastName']);
			$creditCardType =urlencode( $_POST['creditCardType']);
			$creditCardNumber = urlencode($_POST['creditCardNumber']);
			$expDateMonth =urlencode( $_POST['expDateMonth']);
			
			// Month must be padded with leading zero
			$padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);
			
			$expDateYear =urlencode( $_POST['expDateYear']);
			$cvv2Number = urlencode($_POST['cvv2Number']);
			$address1 = urlencode($_POST['address1']);
			$address2 = urlencode($_POST['address2']);
			$city = urlencode($_POST['city']);
			$state =urlencode( $_POST['state']);
			$zip = urlencode($_POST['zip']);
			
			
			$amount = urlencode($_POST['amount']);
			
			
			if($task_id!=0 && $task_id>0 && $task_comment_id!=0 && $task_comment_id>0)
			{
						
						$task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
						
						if($task_detail)
						{
						
							///////==========total amount====
				
							$task_setting=task_setting();
							
							$total=0;
							
							if($task_detail->extra_cost>0) {
							
							$total=$total+$task_detail->extra_cost;
							
							}
							
							
							
							////===get worker offer price=====
					
							$worker_id='';
							
							$get_worker_detail=$this->db->query("select * from ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up, ".$this->db->dbprefix('worker')." wrk, ".$this->db->dbprefix('worker_comment')." cmt where cmt.comment_post_user_id=us.user_id and us.user_id=up.user_id and us.user_id=wrk.user_id and cmt.task_comment_id='".$task_comment_id."'");
							
							
							if($get_worker_detail->num_rows()>0)
							{
							
								$comment_detail=$get_worker_detail->row();
								
								$worker_id=$comment_detail->worker_id;
							
									
								$total=$total+$comment_detail->offer_amount;
							 
							}
							 
							 ///////=======
					 
							 
							 
							 if($task_setting->task_post_fee>0) {
							 
							 $task_site_fee=number_format((($task_setting->task_post_fee*$total) / 100),2); 
						
								 $total=$total+$task_site_fee;
						
							}
								 
								 
								  $total=number_format($total,2);
								
								
						
								$amount=$total;		
		
		
				///////==========total amount====
				
						}
						
						
				
				}
			
			
			
			
				$wallet_setting=$this->wallet_model->wallet_setting();			
				$wallet_add_fees=$wallet_setting->wallet_add_fees;
				
					
				
		    	$add_fees= number_format((($amount * $wallet_add_fees)/100),2);
				$total= number_format(($add_fees + $amount),2);
				
				$total= str_replace(',','',$total);
			
			
			
			
			
			//$currencyCode=urlencode($_POST['currency']);
			$currencyCode="USD";
			$paymentType=urlencode($_POST['paymentType']);
			
			/* Construct the request string that will be sent to PayPal.
			   The variable $nvpstr contains all the variables and is a
			   name value pair string with & as a delimiter */
			$nvpstr="&PAYMENTACTION=$paymentType&AMT=$total&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".         $padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=$state".
			"&ZIP=$zip&COUNTRYCODE=US&CURRENCYCODE=$currencyCode";
			
			
			
			/* Make the API call to PayPal, using API signature.
			   The API response is stored in an associative array called $resArray */
			$resArray=$this->creditcard->hash_call("doDirectPayment",$nvpstr);
			
			
			
			$strtemp='';
			foreach ($resArray as $key => $value) 
			{					
			
				$strtemp.= $key."=".$value.",";
			}
		      
		
			log_message('error',"CREDIT CARD IPN DATA:".$strtemp);
			
			
			//var_dump($resArray);
			//exit;
			/* Display the API response back to the browser.
			   If the response from PayPal was a success, display the response parameters'
			   If the response was an error, display the errors received using APIError.php.
			   */
			$ack = strtoupper($resArray["ACK"]);
			
			  if($ack!="SUCCESS") 
			  {
				  $msg= "fail";
				  
				 
				 
				  if($task_id!=0 && $task_id>0 && $task_comment_id!=0 && $task_comment_id>0)
					{
								
								$task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
								
								if($task_detail)
								{
					
				 					 redirect('tasks/'.$task_detail->task_url_name.'/fail');
								}
								else
								{				  
									 redirect('wallet/index/0/'.$msg);
								}
					
					}
					else
					{				  
			     		 redirect('wallet/index/0/'.$msg);
					}
					
			   }
			   else
			   {
				  
					$pay_gross=$resArray['AMT'];			
					$txnid=$resArray['TRANSACTIONID'];
					$date=date('Y-m-d H:i:s');
					$ip=$_SERVER['REMOTE_ADDR'];
					$payee_email=$creditCardNumber;
				
				    $user_id=get_authenticateUserID();
					$payer_status='';
					$gateway_id=$id;
					
					
					
					
					$wallet_setting2=wallet_setting();		
		
		
					$no_payment_after_auto_confirm=$wallet_setting2->no_payment_after_auto_confirm;
		
		
		
					
					$admin_status='Review';
					
					$gateway_details=get_payment_gateway_details_by_id($gateway_id);
					
					if($gateway_details)
					{
						if($gateway_details->auto_confirm==1)
						{
							$admin_status='Confirm';
						}
					}
					
					
					
					
				    $chk_status_admin=$this->db->query("select * from ".$this->db->dbprefix('wallet')." where user_id='".$user_id."' and admin_status='Confirm'");
					if($chk_status_admin->num_rows()>$no_payment_after_auto_confirm)
					{
							$admin_status='Confirm';
					}
					
					
				  $data=array(
					'debit' => $amount,
					'user_id' => $user_id,
					'status' => $payer_status,
					'admin_status' => $admin_status,
					'wallet_date' => $date,
					'wallet_transaction_id' => $txnid,
					'wallet_payee_email' => $payee_email,
					'wallet_ip' => $ip	,
					'gateway_id' => $gateway_id				
					);					
					$add_wallet=$this->db->insert('wallet',$data);		
				  $msg= "add";
					
					
					
					if($task_id!=0 && $task_id>0 && $task_comment_id!=0 && $task_comment_id>0)
					{
								
								$task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
								
								if($task_detail)
								{
					
									redirect('task/accept_offer/'.$task_id.'/'.$task_comment_id);
									
								}
								else
								{						
									redirect('wallet/index/0/'.$msg);	
								}
						}
						else
						{						
							redirect('wallet/index/0/'.$msg);	
						}
					
					
					
			   }
		}	
			
			   
	
	}
	
	
	///---------- wallet withdrawl part
	
	
	
	/*
	Function name :my_withdraw()
	Parameter : $offset (for paging), $msg (for custom message)
	Return : none
	Use : User can see his/her all withdrawal list on here.
	Description : user can enter withdrawal list using this function which called http://hostname/my_withdraw.
	*/
	
	
	function my_withdraw($offset=0,$msg='')
	{
		
		if(!check_user_authentication()) {  redirect('sign_up'); } 
		
		
		$wallet_setting=wallet_setting();
		
		if($wallet_setting->wallet_enable==0)
		{
			redirect('dashboard');
		}
		
		if(get_authenticateUserID()== '')
		{
			redirect('sign_up');
		}
		
	
		
		$this->load->library('pagination');
		
		$limit = '15';
		$config['uri_segment']='3';
		$config['base_url'] = site_url('wallet/my_withdraw/');
		$config['total_rows'] = $this->wallet_model->get_total_my_withdraw_list();
		$config['per_page'] = $limit;
				
		$this->pagination->initialize($config);		
		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['limit']=$limit;
		$data['total_rows']=$this->wallet_model->get_total_my_withdraw_list();	
		$data['offset']=$offset;	
		
		$data['withdraw_details']=$this->wallet_model->my_withdraw_list($offset,$limit);
		
		
		$data['total_wallet_amount']=$this->wallet_model->my_wallet_amount(); 		
		$data['wallet_setting']=wallet_setting();
		
		
		$data['error'] = "";
		$data['msg']=$msg;
		
		       $theme = getThemeName();
				$data['site_setting']=site_setting();
				$this->template->set_master_template($theme .'/template.php');				
				$data['theme']=$theme;				
				$meta_setting=meta_setting();
				$user_info = $this->user_model->get_user_info(get_authenticateUserID());
				$data['first_name']=$user_info->first_name;		
				$data['last_name']=$user_info->last_name;					
				$pageTitle='Withdrawal History-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->title;
				$metaDescription='Withdrawal History-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_description;
				$metaKeyword='Withdrawal History-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_keyword;	
				$this->template->write('pageTitle',$pageTitle,TRUE);
				$this->template->write('metaDescription',$metaDescription,TRUE);
				$this->template->write('metaKeyword',$metaKeyword,TRUE);
				$this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
				$this->template->write_view('content_center',$theme .'/layout/wallet/my_withdraw',$data,TRUE);
				$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
				$this->template->render();	

	
	}	
	
	
	
	/*
	Function name :withdraw_wallet()
	Parameter : none
	Return : boolean
	Use : User can withdraw amount from his/her wallet if user have sufficient amount in wallet.
	Description : user can withdraw amount using this function which called http://hostname/withdraw_wallet.
	*/
	
	function withdraw_wallet()
	{
		
		if(!check_user_authentication()) {  redirect('sign_up'); } 
		
		
			$wallet_setting=wallet_setting();
			$site_setting=site_setting();
	      $data['site_setting']=site_setting();
		
		
		if($wallet_setting->wallet_enable==0)
		{
			redirect('sign_up');
		}
		
		if($this->session->userdata('user_id')== '')
		{
			redirect('sign_up');
		}
		
		$total_wallet_amount=$this->wallet_model->my_wallet_amount(); 	
		$minimum_amount=$wallet_setting->wallet_minimum_amount;		
		
		$chk_amt=$this->input->post('amount');
		
		
		
		////check total amount=====
		
		$own_amount_error='success';
		
		if($this->input->post('amount')) {
		
			if($chk_amt>$total_wallet_amount)
			{
				$own_amount_error='fail';			
			}
		
		}
		
		/////=====check minimum amount
		
		$amount_error='success';
		
		if($this->input->post('amount')) {
		
			if($chk_amt<$minimum_amount)
			{
				$amount_error='fail';			
			}
		
		}
	
		
		$this->load->library('form_validation');		
		$this->form_validation->set_rules('amount', 'Amount', 'required|is_natural');
		$this->form_validation->set_rules('withdraw_method', 'Withdraw Method', 'required');
		
		if($this->input->post('withdraw_method')=='bank')
		{
			$this->form_validation->set_rules('bank_name', 'Bank Name', 'required|alpha_space');
			$this->form_validation->set_rules('bank_account_holder_name', 'Account Holder Name', 'required|alpha_space');			
			$this->form_validation->set_rules('bank_account_number', 'Bank Account Number', 'required|alpha_numeric');
			$this->form_validation->set_rules('bank_branch', 'Bank Branch', 'required|alpha_space');
			$this->form_validation->set_rules('bank_ifsc_code', 'Bank IFSC Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('bank_address', 'Bank Address', 'required');
			$this->form_validation->set_rules('bank_city', 'Bank City', 'required|alpha_space');
			$this->form_validation->set_rules('bank_state', 'Bank State', 'required|alpha_space');
			$this->form_validation->set_rules('bank_country', 'Bank Country', 'required|alpha_space');
			$this->form_validation->set_rules('bank_zipcode', 'Bank Postal Code', 'required|alpha_numeric');
					
		}
		
		if($this->input->post('withdraw_method')=='check')
		{
			$this->form_validation->set_rules('check_name', 'Bank Name', 'required|alpha_space');
			$this->form_validation->set_rules('check_account_holder_name', 'Bank Account Holder Name', 'required|alpha_space');			
			$this->form_validation->set_rules('check_account_number', 'Bank Account Number', 'required|alpha_numeric');
			$this->form_validation->set_rules('check_branch', 'Bank Branch', 'required|alpha_space');
			//$this->form_validation->set_rules('check_unique_id', 'Bank Unique Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('check_address', 'Bank Address', 'required');
			$this->form_validation->set_rules('check_city', 'Bank City', 'required|alpha_space');
			$this->form_validation->set_rules('check_state', 'Bank State', 'required|alpha_space');
			$this->form_validation->set_rules('check_country', 'Bank Country', 'required|alpha_space');
			$this->form_validation->set_rules('check_zipcode', 'Bank Postal Code', 'required|alpha_numeric');

		}
		
		if($this->input->post('withdraw_method')=='gateway')
		{
		
			$this->form_validation->set_rules('gateway_name', 'Gateway Name', 'required|alpha_space');
			$this->form_validation->set_rules('gateway_account', 'Gateway Account', 'required');
		
			$this->form_validation->set_rules('gateway_city', 'Gateway City', 'required|alpha_space');
			$this->form_validation->set_rules('gateway_state', 'Gateway State', 'required|alpha_space');			
			
			$this->form_validation->set_rules('gateway_country', 'Gateway Country', 'required|alpha_space');
			$this->form_validation->set_rules('gateway_zip', 'Gateway Postal Code', 'required|alpha_numeric');		
		
		}
		
		
		if($this->form_validation->run() == FALSE || $amount_error=='fail' || $own_amount_error=='fail'){			
			
			
			
				if($amount_error=='fail')
				{
					$amount_error="<p>You can not add amount less than ".$site_setting->currency_symbol.$minimum_amount.".</p>";
				}
				else
				{
					$amount_error='';
				}
				
				if($own_amount_error=='fail')
				{
					$own_error="<p>You can not withdraw amount greater than ".$site_setting->currency_symbol.$total_wallet_amount.".</p>";
				}
				else
				{
					$own_error='';
				}
			
			
				if(validation_errors() || $amount_error!=''  || $own_error!='')
				{
					$data['error'] = validation_errors().$amount_error.$own_error;
							
				} else
				{
					$data["error"] = "";
				}
		
		
		
		
		
					$data['total_wallet_amount']=$this->wallet_model->my_wallet_amount(); 		
					$data['wallet_setting']=$this->wallet_model->wallet_setting();
					
					$data['withdraw_method']=$this->input->post('withdraw_method');
					$data['amount']=$this->input->post('amount');
					
					$data['withdraw_id']=$this->input->post('withdraw_id');
					
					
					$data['bank_name']=$this->input->post('bank_name');
					$data['bank_branch']=$this->input->post('bank_branch');
					$data['bank_ifsc_code']=$this->input->post('bank_ifsc_code');
					$data['bank_address']=$this->input->post('bank_address');
					$data['bank_city']=$this->input->post('bank_city');
					$data['bank_state']=$this->input->post('bank_state');
					$data['bank_country']=$this->input->post('bank_country');
					$data['bank_zipcode']=$this->input->post('bank_zipcode');
					$data['bank_account_holder_name']=$this->input->post('bank_account_holder_name');
					$data['bank_account_number']=$this->input->post('bank_account_number');
					
					
					$data['check_name']=$this->input->post('check_name');
					$data['check_branch']=$this->input->post('check_branch');
					$data['check_unique_id']=$this->input->post('check_unique_id');
					$data['check_address']=$this->input->post('check_address');
					$data['check_city']=$this->input->post('check_city');
					$data['check_state']=$this->input->post('check_state');
					$data['check_country']=$this->input->post('check_country');
					$data['check_zipcode']=$this->input->post('check_zipcode');
					$data['check_account_holder_name']=$this->input->post('check_account_holder_name');
					$data['check_account_number']=$this->input->post('check_account_number');
										
					
					$data['gateway_name']=$this->input->post('gateway_name');
					$data['gateway_account']=$this->input->post('gateway_account');
					$data['gateway_city']=$this->input->post('gateway_city');
					$data['gateway_state']=$this->input->post('gateway_state');
					$data['gateway_country']=$this->input->post('gateway_country');
					$data['gateway_zip']=$this->input->post('gateway_zip');
										
				
				
		       $theme = getThemeName();
				
				$this->template->set_master_template($theme .'/template.php');				
				$data['theme']=$theme;				
				$meta_setting=meta_setting();
				$user_info = $this->user_model->get_user_info(get_authenticateUserID());
				$data['first_name']=$user_info->first_name;		
				$data['last_name']=$user_info->last_name;					
				$pageTitle='Withdraw-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->title;
				$metaDescription='Withdraw-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_description;
				$metaKeyword='Withdraw-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_keyword;	
				$this->template->write('pageTitle',$pageTitle,TRUE);
				$this->template->write('metaDescription',$metaDescription,TRUE);
				$this->template->write('metaKeyword',$metaKeyword,TRUE);
				$this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
				$this->template->write_view('content_center',$theme .'/layout/wallet/withdraw_wallet',$data,TRUE);
				$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
				$this->template->render();	
		
		
		
			}
			else
			{	
				
				if($this->input->post('withdraw_id')!='')
				{
					$this->wallet_model->update_withdraw_request();				
					$msg='update';				
				}
				
				else
				{				
					$this->wallet_model->add_withdraw_request();				
					$msg='success';
				}
					redirect('wallet/my_withdraw/0/'.$msg);		
					
				
			}
		
		
		
		
		
		
	
	}
	
	
	
	/*
	Function name :withdraw_details()
	Parameter : $id (withdrawal ID)
	Return : none
	Use : User can edit his/her withdrawal details untill administrator not confirmed request.
	Description : user can edit withdrawal details using this function which called http://hostname/withdraw_details/$id.
	*/
	
	
	function withdraw_details($id)
	{
	
	
		if(!check_user_authentication()) {  redirect('sign_up'); } 
		
		
		if($id=='' || $id==0)
		{
			redirect('wallet/my_withdraw');
		}
		
		
		$wallet_setting=wallet_setting();
		
		if($wallet_setting->wallet_enable==0)
		{
			redirect('dashboard');
		}
		
		
		$site_setting=site_setting();
		$data['site_setting']=$site_setting;
		
		
		$data['total_wallet_amount']=$this->wallet_model->my_wallet_amount(); 		
		$data['wallet_setting']=$wallet_setting;
		
		$data["error"] = "";
		$data['withdraw_id']=$id;
		
		$withdraw_detail=$this->wallet_model->get_withdraw_detail($id);
		
		
		
		
		$data['withdraw_method']=$withdraw_detail->withdraw_method;
		$data['amount']=str_replace('.00','',$withdraw_detail->withdraw_amount);
		
		
		$bank_detail=$this->wallet_model->get_withdraw_method_detail($id,'bank');
		$check_detail=$this->wallet_model->get_withdraw_method_detail($id,'check');				
		$gateway_detail=$this->wallet_model->get_withdraw_method_detail($id,'gateway');
		
		if($bank_detail)
		{		
			$data['bank_name']=$bank_detail->bank_name;
			$data['bank_branch']=$bank_detail->bank_branch;
			$data['bank_ifsc_code']=$bank_detail->bank_ifsc_code;
			$data['bank_address']=$bank_detail->bank_address;
			$data['bank_city']=$bank_detail->bank_city;
			$data['bank_state']=$bank_detail->bank_state;
			$data['bank_country']=$bank_detail->bank_country;
			$data['bank_zipcode']=$bank_detail->bank_zipcode;
			$data['bank_account_holder_name']=$bank_detail->bank_account_holder_name;
			$data['bank_account_number']=$bank_detail->bank_account_number;
		
		}
		else
		{
			$data['bank_name']='';
			$data['bank_branch']='';
			$data['bank_ifsc_code']='';
			$data['bank_address']='';
			$data['bank_city']='';
			$data['bank_state']='';
			$data['bank_country']='';
			$data['bank_zipcode']='';
			$data['bank_account_holder_name']='';
			$data['bank_account_number']='';
		}
		
		
		if($check_detail)
		{
			$data['check_name']=$check_detail->bank_name;
			$data['check_branch']=$check_detail->bank_branch;
			$data['check_unique_id']=$check_detail->bank_unique_id;
			$data['check_address']=$check_detail->bank_address;
			$data['check_city']=$check_detail->bank_city;
			$data['check_state']=$check_detail->bank_state;
			$data['check_country']=$check_detail->bank_country;
			$data['check_zipcode']=$check_detail->bank_zipcode;
			$data['check_account_holder_name']=$check_detail->bank_account_holder_name;
			$data['check_account_number']=$check_detail->bank_account_number;
		}
		else
		{
			$data['check_name']='';
			$data['check_branch']='';
			$data['check_unique_id']='';
			$data['check_address']='';
			$data['check_city']='';
			$data['check_state']='';
			$data['check_country']='';
			$data['check_zipcode']='';
			$data['check_account_holder_name']='';
			$data['check_account_number']='';
		
		}
		
		if($gateway_detail)
		{					
		
			$data['gateway_name']=$gateway_detail->gateway_name;
			$data['gateway_account']=$gateway_detail->gateway_account;
			$data['gateway_city']=$gateway_detail->gateway_city;
			$data['gateway_state']=$gateway_detail->gateway_state;
			$data['gateway_country']=$gateway_detail->gateway_country;
			$data['gateway_zip']=$gateway_detail->gateway_zip;
				
		}
		
		else
		{
			$data['gateway_name']='';
			$data['gateway_account']='';
			$data['gateway_city']='';
			$data['gateway_state']='';
			$data['gateway_country']='';
			$data['gateway_zip']='';
		}			
	
	
			 $theme = getThemeName();
				
				$this->template->set_master_template($theme .'/template.php');				
				$data['theme']=$theme;				
				$meta_setting=meta_setting();
				$user_info = $this->user_model->get_user_info(get_authenticateUserID());
				$data['first_name']=$user_info->first_name;		
				$data['last_name']=$user_info->last_name;					
				$pageTitle='Withdraw-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->title;
				$metaDescription='Withdraw-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_description;
				$metaKeyword='Withdraw-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_keyword;	
				$this->template->write('pageTitle',$pageTitle,TRUE);
				$this->template->write('metaDescription',$metaDescription,TRUE);
				$this->template->write('metaKeyword',$metaKeyword,TRUE);
				$this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
				$this->template->write_view('content_center',$theme .'/layout/wallet/withdraw_wallet',$data,TRUE);
				$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
				$this->template->render();	
		
		
	
	}	
	
	
	
	
	/*
	Function name :withdraw_detail()
	Parameter : $id (withdrawal ID)
	Return : none
	Use : User can see his/her withdrawal details.
	Description : user can see withdrawal details using this function which called http://hostname/withdraw_detail/$id.
	*/
	
	function withdrawal_detail($id)
	{
		
		
		if(!check_user_authentication()) {  redirect('sign_up'); } 
		
		
		if($id=='' || $id==0)
		{
			redirect('wallet/my_withdraw');
		}
		$wallet_setting=wallet_setting();
		
		if($wallet_setting->wallet_enable==0)
		{
			redirect('dashboard');
		}
		
		
			$site_setting=site_setting();
		$data['site_setting']=$site_setting;
		
		
		
		$data['total_wallet_amount']=$this->wallet_model->my_wallet_amount(); 		
		$data['wallet_setting']=wallet_setting();
		
		$data["error"] = "";
		$data['withdraw_id']=$id;
		
		$withdraw_detail=$this->wallet_model->get_withdraw_detail($id);
		
		
		
		
		$data['withdraw_method']=$withdraw_detail->withdraw_method;
		$data['amount']=str_replace('.00','',$withdraw_detail->withdraw_amount);
		
		
		$bank_detail=$this->wallet_model->get_withdraw_method_detail($id,'bank');
		$check_detail=$this->wallet_model->get_withdraw_method_detail($id,'check');				
		$gateway_detail=$this->wallet_model->get_withdraw_method_detail($id,'gateway');
		
		if($bank_detail)
		{		
			$data['bank_name']=$bank_detail->bank_name;
			$data['bank_branch']=$bank_detail->bank_branch;
			$data['bank_ifsc_code']=$bank_detail->bank_ifsc_code;
			$data['bank_address']=$bank_detail->bank_address;
			$data['bank_city']=$bank_detail->bank_city;
			$data['bank_state']=$bank_detail->bank_state;
			$data['bank_country']=$bank_detail->bank_country;
			$data['bank_zipcode']=$bank_detail->bank_zipcode;
			$data['bank_account_holder_name']=$bank_detail->bank_account_holder_name;
			$data['bank_account_number']=$bank_detail->bank_account_number;
		
		}
		else
		{
			$data['bank_name']='';
			$data['bank_branch']='';
			$data['bank_ifsc_code']='';
			$data['bank_address']='';
			$data['bank_city']='';
			$data['bank_state']='';
			$data['bank_country']='';
			$data['bank_zipcode']='';
			$data['bank_account_holder_name']='';
			$data['bank_account_number']='';
		}
		
		
		if($check_detail)
		{
			$data['check_name']=$check_detail->bank_name;
			$data['check_branch']=$check_detail->bank_branch;
			$data['check_unique_id']=$check_detail->bank_unique_id;
			$data['check_address']=$check_detail->bank_address;
			$data['check_city']=$check_detail->bank_city;
			$data['check_state']=$check_detail->bank_state;
			$data['check_country']=$check_detail->bank_country;
			$data['check_zipcode']=$check_detail->bank_zipcode;
			$data['check_account_holder_name']=$check_detail->bank_account_holder_name;
			$data['check_account_number']=$check_detail->bank_account_number;
		}
		else
		{
			$data['check_name']='';
			$data['check_branch']='';
			$data['check_unique_id']='';
			$data['check_address']='';
			$data['check_city']='';
			$data['check_state']='';
			$data['check_country']='';
			$data['check_zipcode']='';
			$data['check_account_holder_name']='';
			$data['check_account_number']='';
		
		}
		
		if($gateway_detail)
		{					
		
			$data['gateway_name']=$gateway_detail->gateway_name;
			$data['gateway_account']=$gateway_detail->gateway_account;
			$data['gateway_city']=$gateway_detail->gateway_city;
			$data['gateway_state']=$gateway_detail->gateway_state;
			$data['gateway_country']=$gateway_detail->gateway_country;
			$data['gateway_zip']=$gateway_detail->gateway_zip;
				
		}
		
		else
		{
			$data['gateway_name']='';
			$data['gateway_account']='';
			$data['gateway_city']='';
			$data['gateway_state']='';
			$data['gateway_country']='';
			$data['gateway_zip']='';
		}			
	
	
		
		
		
		
		 $theme = getThemeName();
				
		$this->template->set_master_template($theme .'/template.php');				
		$data['theme']=$theme;				
		$meta_setting=meta_setting();
		$user_info = $this->user_model->get_user_info(get_authenticateUserID());
		$data['first_name']=$user_info->first_name;		
		$data['last_name']=$user_info->last_name;					
		$pageTitle='Withdraw-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->title;
		$metaDescription='Withdraw-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_description;
		$metaKeyword='Withdraw-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_keyword;	
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/wallet/withdrawal_detail',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();	
				
				
	
	}
		
	
	
}

?>
