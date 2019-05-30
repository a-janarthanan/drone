<?php

class Site_setting extends CI_Controller {


	function Site_setting()
	{
		parent::__construct();	
		$this->load->model('site_setting_model');
	}
	
	/*** site setting home page
	**/
	function index()
	{
		redirect('site_setting/add_site_setting');	
	}
	
	
	
	/** admin site setting display and update function
	* var integer $site_setting_id
	* var integer $site_online
	* var integer $captcha_enable
	* var string $site_name
	* var integer $site_version
	* var integer $site_language
	* var string $currency_code
	* var string $date_format
	* var string $time_format
	* var string $date_time_format
	* var string $site_tracker
	* var text $how_it_works_video
	* var integer $zipcode_min
	* var integer $zipcode_max
	* var string $error			
	**/
	function add_site_setting()
	{
		$data = array();
		$check_rights= get_rights('add_site_setting');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('site_name', 'SITE NAME', 'required');
		//$this->form_validation->set_rules('zipcode_min', 'ZIPCODE MANIMUM', 'required|numeric');
		//$this->form_validation->set_rules('zipcode_max', 'ZIPCODE MAXIMUM', 'required|numeric');
		$this->form_validation->set_rules('date_format', 'DATE FORMAT', 'required');
		$this->form_validation->set_rules('time_format', 'TIME FORMAT', 'required');
		$this->form_validation->set_rules('site_tracker', 'GOOGLE ANALYTICS CODE', 'required');
		
		$this->form_validation->set_rules('google_map_key', 'GOOGLE MAP KEY', 'required');
		$this->form_validation->set_rules('default_latitude', 'Default Latitude', 'required');
		$this->form_validation->set_rules('default_longitude', 'Default Longitude', 'required');
		
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			if($this->input->post('site_setting_id'))
			{
				$one_site_setting = site_setting(); 
				
				$data["site_setting_id"] = $this->input->post('site_setting_id');
				$data["site_online"] = $this->input->post('site_online');
				$data["captcha_enable"] = $this->input->post('captcha_enable');
				$data["site_name"] = $this->input->post('site_name');
				$data["site_version"] = $this->input->post('site_version');
				$data["site_language"] = $this->input->post('site_language');
				$data["currency_code"] = $this->input->post('currency_code');
				$data["date_format"] = $this->input->post('date_format');
				$data["time_format"] = $this->input->post('time_format');	
				$data["date_time_format"] = $this->input->post('date_time_format');	
				$data["site_tracker"] = $this->input->post('site_tracker');
				$data["how_it_works_video"] = $this->input->post('how_it_works_video');
				$data["zipcode_min"] = $this->input->post('zipcode_min');	
				$data["zipcode_max"] = $this->input->post('zipcode_max');
				$data["site_timezone"] = $this->input->post('site_timezone');
				
				$data["google_map_key"] = $this->input->post('google_map_key');
				$data["default_latitude"] = $this->input->post('default_latitude');
				$data["default_longitude"] = $this->input->post('default_longitude');
				$data["subscription_price"] = $this->input->post('subscription_price');
				$data["subscription_time"] = $this->input->post('subscription_time');
				$data["subscription_need"] = $this->input->post('subscription_need');
				$data["credit_need"] = $this->input->post('credit_need');
				
			}else{
				$one_site_setting = site_setting(); 

				$data["site_setting_id"] = $one_site_setting->site_setting_id;
				$data["site_online"] = $one_site_setting->site_online;
				$data["captcha_enable"] = $one_site_setting->captcha_enable;
				$data["site_name"] = $one_site_setting->site_name;
				$data["site_version"] = $one_site_setting->site_version;
				$data["site_language"] = $one_site_setting->site_language;
				$data["currency_code"] = $one_site_setting->currency_code;
				$data["date_format"] = $one_site_setting->date_format;
				$data["time_format"] = $one_site_setting->time_format;
				$data["date_time_format"] = $one_site_setting->date_time_format;	
				$data["site_tracker"] = $one_site_setting->site_tracker;
				$data["how_it_works_video"] = $one_site_setting->how_it_works_video;
				$data["zipcode_min"] = $one_site_setting->zipcode_min;
				$data["zipcode_max"] = $one_site_setting->zipcode_max;
				$data["site_timezone"] = $one_site_setting->site_timezone;
				
				$data["google_map_key"] = $one_site_setting->google_map_key;
				$data["default_latitude"] = $one_site_setting->default_latitude;
				$data["default_longitude"] = $one_site_setting->default_longitude;
				$data["subscription_price"] =$one_site_setting->subscription_price;
				$data["subscription_time"] = $one_site_setting->subscription_time;
				$data["subscription_need"] = $one_site_setting->transection_need;
				$data["credit_need"] = $one_site_setting->credit_need;
				
				
				
			}

			$data['language'] = get_languages();
			$data['currency'] = get_currency();
			$data['site_setting'] = site_setting(); 
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			$this->template->write_view('center',$theme .'/layout/setting/add_site_setting',$data,TRUE);
			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			$this->template->render();
		}else{
				$this->site_setting_model->site_setting_update();
				$one_site_setting = site_setting(); 
				
				$data["error"] = "Site settings updated successfully.";
				$data["site_setting_id"] = $this->input->post('site_setting_id');
				$data["site_online"] = $this->input->post('site_online');
				$data["captcha_enable"] = $this->input->post('captcha_enable');
				$data["site_name"] = $this->input->post('site_name');
				$data["site_version"] = $this->input->post('site_version');
				$data["site_language"] = $this->input->post('site_language');
				$data["currency_code"] = $this->input->post('currency_code');
				$data["date_format"] = $this->input->post('date_format');
				$data["time_format"] = $this->input->post('time_format');
				$data["date_time_format"] = $this->input->post('date_time_format');	
				$data["site_tracker"] = $this->input->post('site_tracker');
				$data["how_it_works_video"] = $this->input->post('how_it_works_video');
				$data["zipcode_min"] = $this->input->post('zipcode_min');
				$data["zipcode_max"] = $this->input->post('zipcode_max');
				$data["site_timezone"] = $this->input->post('site_timezone');
				
				$data["google_map_key"] = $this->input->post('google_map_key');
				$data["default_latitude"] = $this->input->post('default_latitude');
				$data["default_longitude"] = $this->input->post('default_longitude');
				$data["subscription_price"] = $this->input->post('subscription_price');
				$data["subscription_time"] = $this->input->post('subscription_time');
				$data["subscription_need"] = $this->input->post('subscription_need');
				$data["credit_need"] = $this->input->post('credit_need');
				
				$data['language'] = get_languages();
				$data['site_setting'] = site_setting();
				$data['currency'] = get_currency();	
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			$this->template->write_view('center',$theme .'/layout/setting/add_site_setting',$data,TRUE);
			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			$this->template->render();
		}				
	}
	
	/** admin image size setting display and update function
	* var integer $p_width
	* var integer $p_height
	* var integer $u_width
	* var integer $u_height
	* var string $error			
	**/
	function add_image_setting()
	{
		$data = array();
		$check_rights=get_rights('add_image_setting');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		$this->load->library('form_validation');
		
		
		$this->form_validation->set_rules('user_width', 'User Image Width', 'required');
		$this->form_validation->set_rules('user_height', 'User Image Height', 'required');
		$this->form_validation->set_rules('category_width', 'Categoty Image width', 'required');
		$this->form_validation->set_rules('category_height', 'Category Image Height', 'required');

		$err = '';
		
		if($_POST)
		{
			
			if($this->input->post('user_width') <= 0){
				$err.='<p>User Thumbnail Width should be greator than Zero.</p>';
			}
			if($this->input->post('user_height') <= 0){
				$err.='<p>User Thumbnail Height should be greator than Zero.</p>';
			}
		}
		
		if($this->form_validation->run() == FALSE || $err!=''){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			if($err!=''){
				$data["error"] .= $err;
			}
			if($this->input->post('image_setting_id'))
			{
				$data["image_setting_id"] = $this->input->post('image_setting_id');
				$data["user_width"] = $this->input->post('user_width');
				$data["user_height"] = $this->input->post('user_height');	
				$data["category_width"] = $this->input->post('category_width');
				$data["category_height"] = $this->input->post('category_height');
				
			}else{
				$one_img_setting = $this->site_setting_model->get_one_img_setting();
				
				$data["image_setting_id"] = $one_img_setting->image_setting_id;
				$data["user_width"] = $one_img_setting->user_width;
				$data["user_height"] = $one_img_setting->user_height;
				$data["category_width"] = $one_img_setting->category_width;
				$data["category_height"] = $one_img_setting->category_height;
			}
			$data['site_setting'] = site_setting();

			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			$this->template->write_view('center',$theme .'/layout/setting/add_image_setting',$data,TRUE);
			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			$this->template->render();
		}else{
			$this->site_setting_model->img_setting_update();

			$data["error"] = "Image size settings updated successfully.";
			$data["image_setting_id"] = $this->input->post('image_setting_id');
			$data["user_width"] = $this->input->post('user_width');
			$data["user_height"] = $this->input->post('user_height');
			$data["category_width"] = $this->input->post('category_width');
			$data["category_height"] = $this->input->post('category_height');
	
			$data['site_setting'] = site_setting();	
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			$this->template->write_view('center',$theme .'/layout/setting/add_image_setting',$data,TRUE);
			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			$this->template->render();
		}					
	}
}
?>