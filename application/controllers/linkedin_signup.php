<?php
//error_reporting(E_ALL);
//ini_set("display_errors",1);
class Linkedin_signup extends CI_Controller{
    function __construct()
    {
	    parent::__construct();
	    $this->load->library('encrypt');
	    $this->load->library('session');
	    $this->load->model('linkedin_model');	//home_model
	    $this->load->model('home_model');
	    $this->load->helper('url');
	    
    }
    function index()
    {
       //$this->load->view('includes/header');
    }
    
    function initiate()
    {
        ########## Linkedin Settings.. Client ID, Client Secret #############
        $linkedin_config = array(
		'appKey' => '75p1dhj3xx8zln',//'753btmryamp3yk',
		'appSecret' => 'iFIcfMZ1Vjs1Mzvr',//'5yflOGeRSpgglFWg',
		'callbackUrl' => base_url().'index.php/linkedin_signup/data/'
		);	
		
        
        $this->load->library('linkedin', $linkedin_config);
		
		$this->linkedin->setResponseFormat(LINKEDIN::_RESPONSE_JSON);
		$token = $this->linkedin->retrieveTokenRequest();
		
		//echo $token['linkedin']['oauth_token_secret'];
		$this->session->set_flashdata('oauth_request_token_secret', $token['linkedin']['oauth_token_secret']);
		            
    
		$this->session->set_flashdata('oauth_request_token', $token['linkedin']['oauth_token']);
	  // print_r($this->session->all_userdata())."$##";die();
	  
		$link = "https://api.linkedin.com/uas/oauth/authorize?oauth_token=" . $token['linkedin']['oauth_token'];
		redirect($link);

		
        //# First step is to initialize with your consumer key and secret. We'll use an out-of-band oauth_callback
        //$linkedin = new LinkedIn($config['linkedin_access'], $config['linkedin_secret'], $config['base_url']);
        //
        //# Now we retrieve a request token. It will be set as $linkedin->request_token
        //$check=$linkedin->getRequestToken();
        //$requestToken = serialize($linkedin->request_token);
        //$this->session->set_userdata('requestToken',$requestToken);
        ////$_SESSION['requestToken'] = serialize($linkedin->request_token);
        //
        //# With a request token in hand, we can generate an authorization URL, which we'll direct the user to
        //## echo "Authorization URL: " . $linkedin->generateAuthorizeUrl() . "\n\n";
        //header("Location: " . $linkedin->generateAuthorizeUrl());
    }
	
	function data()
	{ 
	    //echo base_url();die();
		$linkedin_config = array(
			'appKey' => '75p1dhj3xx8zln',//'753btmryamp3yk',
			'appSecret' => 'iFIcfMZ1Vjs1Mzvr',//'5yflOGeRSpgglFWg',
			'callbackUrl' => base_url().'index.php/linkedin_signup/data/'
		);
	   
		$this->load->library('linkedin', $linkedin_config);
		$this->linkedin->setResponseFormat(LINKEDIN::_RESPONSE_JSON);
				
		$oauth_token = $this->session->flashdata('oauth_request_token');
		$oauth_token_secret = $this->session->flashdata('oauth_request_token_secret');
		$oauth_verifier = $this->input->get('oauth_verifier');
		
		$response = $this->linkedin->retrieveTokenAccess($oauth_token, $oauth_token_secret, $oauth_verifier);
	   
	  //print_r($response);die();
		// ok if we are good then proceed to retrieve the data from Linkedin
		if ($response['success'] === TRUE)
		{			
			// From this part onward it is up to you on how you want to store/manipulate the data 
			$oauth_expires_in = $response['linkedin']['oauth_expires_in'];
			$oauth_authorization_expires_in = $response['linkedin']['oauth_authorization_expires_in'];
		   
			$response = $this->linkedin->setTokenAccess($response['linkedin']);
			$profile = $this->linkedin->profile('~:(id,first-name,last-name,picture-url,email-address)');
			$profile_connections = $this->linkedin->profile('~/connections:(id,first-name,last-name,picture-url,industry)');
			$user = json_decode($profile['linkedin']);
			$user_array = array('linkedin_id' => $user->id, 'second_name' => $user->lastName, 'profile_picture' => $user->pictureUrl, 'first_name' => $user->firstName);
			// Example of company data
			$company = $this->linkedin->company('1337:(id,name,ticker,description,logo-url,locations:(address,is-headquarters))');
			// For example, print out user data
			
			
			//if($user->emailAddress != '')
			//{
				$data_arr = array(
						'social_id'         => $user->id,
						'full_name'=>$user->firstName." ".$user->lastName,
						'first_name'         => $user->firstName,
						'last_name'         	=> $user->lastName,
						'email'             => $user->emailAddress,
						'profile_image_url'	=> $user->pictureUrl
						);
				
				//print_r($data_arr);die();
				$data = $this->linkedin_model->linkedin_login_here($data_arr);
				
				if($data == 1)
				{	
				    $this->session->set_userdata('success_msg', 'Register successfully');
				    redirect('dashboard');//home
				}
				else if($data == 'already_has') {
				    redirect('dashboard');//home
				}
				else{
				    $this->session->set_userdata('error_msg', 'Your linkedin email id blocked by admin.');
				    redirect('home');
				}
			//}
			//else
			//{
				/*$data_arr = array(
				    'social_id'         => $user->id,
				    'firstName'         => $user->firstName,
				    'lastName'         	=> $user->lastName,
				    'profile_image_url'	=> $user->pictureUrl
				);
				
				$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
				$this->template->write_view('press_release',$theme .'/layout/common/contact_us',$data,TRUE);
				$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			}*/
			
		}
		else
		{
			// bad token request, display diagnostic information
			echo "Request token retrieval failed:<br /><br />RESPONSE:<br /><br />" . print_r($response, TRUE);
		}
	}
}
?>
