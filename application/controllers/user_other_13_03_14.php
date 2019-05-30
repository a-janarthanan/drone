<?php
class User_other extends ROCKERS_Controller 
{
	
	/*
	Function name :User_other()
	Description :Its Default Constuctor which called when user_other object initialzie.its load necesary models
	*/
	function User_other()
	{
		parent::__construct();	
		$this->load->model('home_model');	
		$this->load->model('user_model');	
		$this->load->model('task_model');
		$this->load->model('worker_model');
		$this->load->model('user_other_model');
		$this->load->model('search_model');
	}
	
	/*
	Function name :index()
	Parameter :none
	Return : none
	Use : redirect to user dashboard
	Description : none
	*/
	
	
	public function index()
	{
		redirect('user/dashboard');
	}
	
	/*
	Function name :locations()
	Parameter :$msg(for custom message)
	Return : array of user all location
	Use : get user all location records
	Description : get user all location  this function called by http://hostname/user_other/locations
	*/
	
   function locations($msg= '')
   {        
		   
	   $theme = getThemeName();
	   $this->template->set_master_template($theme .'/template.php');
	   
		$this->load->library('pagination');
		
		$limit = '10';
		//$config['uri_segment']='4';
		$config['base_url'] = site_url('user_other/locations');
		$config['total_rows'] = $this->user_other_model->get_total_locations();
		$config['per_page'] = $limit;
	
		$this->pagination->initialize($config);		
		
		$data['page_link'] = $this->pagination->create_links();
		$data['result'] = $this->user_other_model->get_locations_list();
		$data['total_rows']=$config['total_rows'];
		
	   $data['msg'] = $msg;
	   $data['theme']=$theme;
	   $meta_setting=meta_setting();
	   
	   $pageTitle='Locations - '.$meta_setting->title;
	   $metaDescription='Locations - '.$meta_setting->meta_description;
	   $metaKeyword='Locations - '.$meta_setting->meta_keyword;
	   
	   $this->template->write('pageTitle',$pageTitle,TRUE);
	   $this->template->write('metaDescription',$metaDescription,TRUE);
	   $this->template->write('metaKeyword',$metaKeyword,TRUE);
	   $this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
	   $this->template->write_view('content_center',$theme .'/layout/user_other/locations',$data,TRUE);
	   $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
	   $this->template->render();        
		   
   }
   
   /*
	Function name :new_location()
	Parameter :none
	Return : none
	Use : add new user location
	Description : add new user location  this function called by http://hostname/user_other/new_location
	*/
	
	
	function new_location()
   {        
		   
	   $theme = getThemeName();
	   $this->template->set_master_template($theme .'/template.php');
	   $site_setting=site_setting();
	   
	   $this->form_validation->set_rules('location_name', 'Locaton Name', 'required');
	   $this->form_validation->set_rules('location_address', 'Locaton Address', 'required');
	   $this->form_validation->set_rules('location_city', 'Locaton City', 'required|alpha_space');
	   $this->form_validation->set_rules('location_state', 'Locaton State', 'required|alpha_space');
	   $this->form_validation->set_rules('location_zipcode', 'Locaton Postal Code', 'required|alpha_numeric|min_length['.$site_setting->zipcode_min.']|max_length['.$site_setting->zipcode_max.']');
	   
	   if($this->form_validation->run() == FALSE){
	
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			
			$data['location_name'] = $this->input->post('location_name');
			$data['location_address'] = $this->input->post('location_address');
			$data['location_city'] = $this->input->post('location_city');
			$data['location_state'] = $this->input->post('location_state');
			$data['location_zipcode'] = $this->input->post('location_zipcode');
		
		} else {
	
			$apply=$this->user_other_model->new_location();

			$data['location_name'] = $this->input->post('location_name');
			$data['location_address'] = $this->input->post('location_address');
			$data['location_city'] = $this->input->post('location_city');
			$data['location_state'] = $this->input->post('location_state');
			$data['location_zipcode'] = $this->input->post('location_zipcode');
			
			redirect('user_other/locations/add');
		}

	   
	   
	   $data['theme']=$theme;
	   $meta_setting=meta_setting();
	   
	   $pageTitle='Create a location - '.$meta_setting->title;
	   $metaDescription='Create a location - '.$meta_setting->meta_description;
	   $metaKeyword='Create a location - '.$meta_setting->meta_keyword;
	   
	   $this->template->write('pageTitle',$pageTitle,TRUE);
	   $this->template->write('metaDescription',$metaDescription,TRUE);
	   $this->template->write('metaKeyword',$metaKeyword,TRUE);
	   $this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
	   $this->template->write_view('content_center',$theme .'/layout/user_other/new_location',$data,TRUE);
	   $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
	   $this->template->render();        
		   
   }
   
   
     /*
	Function name :locations_home_set()
	Parameter :none
	Return : none
	Use : set user location as a home location
	Description : set user location as a home location  this function called by http://hostname/user_other/locations_home_set
	*/
	
	
	
   function locations_home_set()
   {
   
		$this->user_other_model->locations_home_set();
		redirect('user_other/locations/sethome');
   }
   
   
     /*
	Function name :delete_location()
	Parameter : $id(user location id)
	Return : none
	Use : delete user location 
	Description : delete user location this function called by http://hostname/user_other/delete_location
	*/
	
	
   function delete_location($id)
   {	
		$this->db->delete('user_location',array('user_location_id'=>$id));
		redirect('user_other/locations/delete');
   }
   
   
    /*
	Function name :favorites()
	Parameter : $offset(for paging), $msg(for custom message)
	Return : array of all user favorite runner list
	Use : get user favorite runner list
	Description :get user favorite runner list this function called by http://hostname/user_other/favorites
	*/
	
	function favorites($offset=0,$msg='')
   {        
		   
	   $theme = getThemeName();
	   $this->template->set_master_template($theme .'/template.php');
	   
		$this->load->library('pagination');
		
		$limit = '10';
		//$config['uri_segment']='4';
		$config['base_url'] = site_url('user_other/favorites');
		$config['total_rows'] = $this->user_other_model->get_total_favorites();
		$config['per_page'] = $limit;
				
		$this->pagination->initialize($config);		
		
		$data['page_link'] = $this->pagination->create_links();
		$data['result'] = $this->user_other_model->get_favorites_list($limit,$offset);
		$data['total_rows']=$config['total_rows'];
	 
	   $data['msg']=$msg;

		$data['offset']=$offset;




	   $data['theme']=$theme;
	   $meta_setting=meta_setting();
  
		
	   $pageTitle='Favorite Task - '.$meta_setting->title;
	   $metaDescription='Favorite Task - '.$meta_setting->meta_description;
	   $metaKeyword='Favorite Task - '.$meta_setting->meta_keyword;
	   
	   $this->template->write('pageTitle',$pageTitle,TRUE);
	   $this->template->write('metaDescription',$metaDescription,TRUE);
	   $this->template->write('metaKeyword',$metaKeyword,TRUE);
	   $this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
	   $this->template->write_view('content_center',$theme .'/layout/user_other/favorites',$data,TRUE);
	   $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
	   $this->template->render();        
		   
   }
   
   /*
	Function name :delete_favorite()
	Parameter : $favorite_id(favorite id), $offset(for paging)
	Return : none
	Use : delete user favorite runner 
	Description : delete user favorite runner this function called by http://hostname/user_other/delete_favorite
	*/
	
	function delete_favorite($favorite_id,$offset=0)
	{
		if(!check_user_authentication()) { redirect('sign_up'); }
		
		$this->user_other_model->delete_favorite($favorite_id);
		redirect('user_other/favorites/'.$offset.'/delete');
	
	}


 
 }
 
 ?>