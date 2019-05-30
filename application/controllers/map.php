<?php
class Map extends ROCKERS_Controller 
{
	
	/*
	Function name :Map()
	Description :Its Default Constuctor which called when map object initialzie.its load necesary models
	*/
	
	function Map()
	{
		parent::__construct();	
		$this->load->model('map_model');	
		$this->load->model('user_model');
		$this->load->model('worker_model');
		$this->load->model('category_model');	
	}
	
	/*
	Function name :index()
	Parameter :none
	Return : array of all city tasks list
	Use : visitor can see all city tasks in map 
	Description : visitor can search or view the tasks this function which called http://hostname/map
	*/
	
	
	public function index()
	{
				
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		$data['city'] = '';
		$tasklists=$this->map_model->get_city_alltask();
		$data['tasklists']=$tasklists;
		$all_categories = $this->category_model->browse_all_category();
		$data['all_categories']=$all_categories;
		
		$data['theme']=$theme;
		$meta_setting=meta_setting();
		$pageTitle='Recent Tasks in All Cities - '.$meta_setting->title;
		$metaDescription='Recent Tasks in All Cities - '.$meta_setting->meta_description;
		$metaKeyword='Recent Tasks in All Cities - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_map',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/map/allcitymap',$data,TRUE);
		$this->template->render();
	}
	public function ajaxsubcategory()
	{
		//echo $this->uri->segment(3);exit;		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		$data['cat_id'] = $this->uri->segment(3);
		$data['tasklists'] =$this->map_model->get_category_alltask($data['cat_id']);
		
		$all_categories = $this->category_model->browse_all_category();
		$data['all_categories']=$all_categories;
		
		$data['theme']=$theme;
		//$meta_setting=meta_setting();
		//$pageTitle='Recent Tasks in All Cities - '.$meta_setting->title;
		//$metaDescription='Recent Tasks in All Cities - '.$meta_setting->meta_description;
		//$metaKeyword='Recent Tasks in All Cities - '.$meta_setting->meta_keyword;
		
		//$this->template->write('pageTitle',$pageTitle,TRUE);
		//$this->template->write('metaDescription',$metaDescription,TRUE);
		//$this->template->write('metaKeyword',$metaKeyword,TRUE);
		//$this->template->write_view('header',$theme .'/layout/common/header_map',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/map/allcitysidebar',$data,TRUE);
		$this->template->render();
	}
	
	/*
	Function name :in()
	Parameter :$city (available city name)
	Return : array of particular city tasks list
	Use : visitor can see particule city tasks in map 
	Description : visitor can search or view the tasks of one city this function which called http://hostname/map/in/cityname
	*/
	
	public function in($city)
	{
		//$city = str_replace('%20','&nbsp;',$city);
		$city = urldecode($city);
		if($city == ''){ redirect('map'); }	
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
	
		$tasklists=$this->map_model->get_city_task($city);
		$data['tasklists']=$tasklists;
		$data['city'] = $city;
		$all_categories = $this->category_model->browse_all_category();
		$data['all_categories']=$all_categories;

		$data['theme']=$theme;
		$meta_setting=meta_setting();
		$pageTitle='Recent Tasks in All Cities - '.$meta_setting->title;
		$metaDescription='Recent Tasks in All Cities - '.$meta_setting->meta_description;
		$metaKeyword='Recent Tasks in All Cities - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_map',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/map/citymap',$data,TRUE);
		$this->template->render();
	}
	
	
	/*
	Function name :change_city()
	Parameter :none
	Return : none
	Use : visitor can change the city from map page
	Description : visitor can change the map city by clicking on the "Pick City" this function open in pop-up which called http://hostname/map/change_city
	*/
	
	function change_city()
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme . '/template.php');
		$data['theme'] = $theme;
		
	
		
		$this->load->view( $theme . '/layout/map/pick_city', $data);
		
	}
	
	
}

?>