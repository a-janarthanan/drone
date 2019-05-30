<?php 
class Search extends ROCKERS_Controller 
{
	
	/*
	Function name :Search()
	Description :Its Default Constuctor which called when search object initialzie.its load necesary models
	*/
	function Search()
	{
		 parent::__construct();	
		$this->load->model('user_model');
		$this->load->model('worker_model');
		$this->load->model('category_model');	
		$this->load->model('search_model');
	}



	/*
	Function name :index()
	Parameter :$search (search keyword) $offset(for paging)
	Return : array of all searched tasks
	Use : get all serached task list
	Description : user can search the task by task name , descrption , runner name, by city this function called by http://hostname/search
	*/
	
	function index($search = '',$offset=0)
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
	
	
		$data['cityname'] ='';
		
		$city_id='';
		
		if(get_authenticateUserID()!='')
		{
			$city_id=getCurrentCity();
			$current_city_name=getCityName($city_id);
			if(isset($current_city_name)) {  $data['cityname']=$current_city_name; }
		}

		if($search != ''){
			$data['search'] = $search;
		} else {
			$data['search'] = $this->input->post('search');
		}
		
		 $keyword = $data['search'];		
		
		
		$this->load->library('pagination');
		
		$limit = '10';
		$config['uri_segment']='3';
		$config['base_url'] = site_url('search/'.$keyword.'/');
		$config['total_rows'] = $this->search_model->get_count_search_result($keyword,$city_id);
		$config['per_page'] = $limit;
				
		$this->pagination->initialize($config);		
		
		$data['page_link'] = $this->pagination->create_links();
		$data['result'] =$this->search_model->get_search_result($keyword,$city_id,$offset,$limit);
		$data['total_rows']=$config['total_rows'];
		
		
		
		
		

		$data['theme']=$theme;
		$meta_setting=meta_setting();
		
		$pageTitle='Search Task - '.$meta_setting->title;
		$metaDescription='Search Task - '.$meta_setting->meta_description;
		$metaKeyword='Search Task - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/search/search',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	
	}
	
	
	/*
	Function name :in()
	Parameter : $city(city name), $search (search keyword) $offset(for paging)
	Return : array of all searched tasks in particular city
	Use : get particular city all serached task list
	Description : user can search the task by task name , descrption , runner name, by city this function called by http://hostname/search/in/cityname/search_word
	*/
	
	
	function in($city='', $search = '',$offset=0)
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
	
	
		$data['cityname'] ='';
		
		if($city != '')
		{ 
		
			if($city == 'all'){ 
				$city_id='';
				$data['cityname'] = 'all';
			} else {
				$city_id = getCityId(urldecode($city));
				$data['cityname'] = urldecode($city);
			}

		} else {
			
			if(get_authenticateUserID()!='')
			{
				$city_id=getCurrentCity();
				$current_city_name=getCityName($city_id);
				if(isset($current_city_name)) {  $data['cityname']=$current_city_name; }
			}
		}
		
		
		
		if($search != ''){
			$data['search'] = $search;
		} else {
			$data['search'] = $this->input->post('search');
		}
		
		
		
		 $keyword = urldecode($data['search']);
		
		$city=urldecode($data['cityname']);
		
		
		$this->load->library('pagination');
		
		$limit = '10';
		
		if($keyword=='')
		{
			$config['uri_segment']='3';
		
		} else{
			
			if($offset>0)
			{
				$config['uri_segment']='5';
			}
			else
			{
				$config['uri_segment']='4';
			}
		}	
		
		
	
		$config['base_url'] = site_url('search/in/'.$city.'/'.$keyword.'/');
		$config['total_rows'] = $this->search_model->get_count_search_result($keyword,$city_id);
		$config['per_page'] = $limit;
				
		$this->pagination->initialize($config);		
		
		$data['page_link'] = $this->pagination->create_links();
		$data['result'] =$this->search_model->get_search_result($keyword,$city_id,$offset,$limit);
		$data['total_rows']=$config['total_rows'];
		
		
		
		
		

		$data['theme']=$theme;
		$meta_setting=meta_setting();
		
		$pageTitle='Search Task - '.$meta_setting->title;
		$metaDescription='Search Task - '.$meta_setting->meta_description;
		$metaKeyword='Search Task - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/search/search',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	
	}


	/*
	Function name :top()
	Parameter : $city(city name),  $offset(for paging)
	Return : array of all top tasks in particular city
	Use : get particular city all top task list
	Description : user can see the top task by task name , descrption , runner name, by city this function called by http://hostname/search/top/cityname/
	*/
	

	function top($city='', $offset=0)
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		$data['cityname'] ='';
		if($city != ''){ 
		
			if($city == 'all'){ 
				$city_id='';
				$data['cityname'] = 'all';
			} else {
				$city_id = getCityId(urldecode($city));
				$data['cityname'] = urldecode($city);
			}

		} else {
			$city_id=getCurrentCity();
			$current_city_name=getCityName($city_id);
			if(isset($current_city_name)) {  $data['cityname']=$current_city_name; }
		}

		
			$data['search'] = $this->input->post('search');
		
		
		$keyword = $data['search'];
		
		
	
		
		
		
		$this->load->library('pagination');
		
		$limit = '10';
		
		
		$keyword = urldecode($data['search']);
		
		$city=urldecode($data['cityname']);
		
		
		$this->load->library('pagination');
		
		
		
		if($city=='')
		{
			$config['uri_segment']='3';
		
		} else{
			
			if($offset>0)
			{
				$config['uri_segment']='4';
			}
			else
			{
				$config['uri_segment']='3';
			}
		}	
		
		
		
		$config['base_url'] = site_url('search/top/'.$city.'/');
		$config['total_rows'] = $this->search_model->get_count_search_result($keyword,$city_id);
		$config['per_page'] = $limit;
				
		$this->pagination->initialize($config);		
		
		$data['page_link'] = $this->pagination->create_links();
		$data['result'] =$this->search_model->get_search_result($keyword,$city_id,$offset,$limit);
		$data['total_rows']=$config['total_rows'];
		
		
		
		
		

		$data['theme']=$theme;
		$meta_setting=meta_setting();
		
		$pageTitle='Search Top Task - '.$meta_setting->title;
		$metaDescription='Search Top Task - '.$meta_setting->meta_description;
		$metaKeyword='Search Top Task - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/search/search',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	
	}
	
	
	/*
	Function name :newest()
	Parameter : $city(city name),  $offset(for paging)
	Return : array of all newest tasks in particular city
	Use : get particular city all newest task list
	Description : user can see the newest task by task name , descrption , runner name, by city this function called by http://hostname/search/newest/cityname/
	*/
	
	
	function newest($city='', $offset=0)
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		$data['cityname'] ='';
		if($city != ''){ 
		
			if($city == 'all'){ 
				$city_id='';
				$data['cityname'] = 'all';
			} else {
				$city_id = getCityId(urldecode($city));
				$data['cityname'] = urldecode($city);
			}

		} else {
			$city_id=getCurrentCity();
			$current_city_name=getCityName($city_id);
			if(isset($current_city_name)) {  $data['cityname']=$current_city_name; }
		}

		
			$data['search'] = $this->input->post('search');
		
		
		$keyword = $data['search'];
		
		
	
		
		
		
		$this->load->library('pagination');
		
		$limit = '10';
		
		
		$keyword = urldecode($data['search']);
		
		$city=urldecode($data['cityname']);
		
		
		$this->load->library('pagination');
		
		
		
		if($city=='')
		{
			$config['uri_segment']='3';
		
		} else{
			
			if($offset>0)
			{
				$config['uri_segment']='4';
			}
			else
			{
				$config['uri_segment']='3';
			}
		}	
		
		
		$config['base_url'] = site_url('search/newest/'.$city.'/');
		$config['total_rows'] = $this->search_model->get_count_search_result($keyword,$city_id);
		$config['per_page'] = $limit;
				
		$this->pagination->initialize($config);		
		
		$data['page_link'] = $this->pagination->create_links();
		$data['result'] =$this->search_model->get_search_result($keyword,$city_id,$offset,$limit);
		$data['total_rows']=$config['total_rows'];
		
		
		
		
		

		$data['theme']=$theme;
		$meta_setting=meta_setting();
		
		$pageTitle='Search Newset Task - '.$meta_setting->title;
		$metaDescription='Search Newset Task - '.$meta_setting->meta_description;
		$metaKeyword='Search Newset Task - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/search/search',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	
	}
	
	
}

?>