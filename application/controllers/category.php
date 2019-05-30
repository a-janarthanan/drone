<?php
class Category extends ROCKERS_Controller {
	
	/*
	Function name :Category()
	Description :Its Default Constuctor which called when category object initialzie.its load necesary models
	*/
	
	function Category()
	{
		 parent::__construct();	
		$this->load->model('user_model');
		$this->load->model('category_model');	
	}
	
	
	/*
	Function name :category_list()
	Parameter : none
	Return : array list of all category details
	Use : user can see all category
	Description : user can see all category which called http://hostname/category/category_list	
				  SEO friendly URL which is declare in config route.php file  http://hostname/tags
	*/

	function category_list()
	{
		

		$all_categories = $this->category_model->browse_all_category();
		$data['all_categories']=$all_categories;

		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data['theme']=$theme;
		$meta_setting=meta_setting();
		
		$pageTitle='Browse Tasks - '.$meta_setting->title;
		$metaDescription='Browse Tasks - '.$meta_setting->meta_description;
		$metaKeyword='Browse Tasks - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/category/browse_all_category',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
		
	}
	public function subcategory_list()
	{
		
		$cat_id=$this->uri->segment(3);

		$data['maincategoriesdetails']=$this->category_model->prentcat_details($cat_id);

		$all_subcategories = $this->category_model->browse_all_subcategory($cat_id);
		$data['all_subcategories']=$all_subcategories;

		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data['theme']=$theme;
		$meta_setting=meta_setting();
		
		$pageTitle='Browse Tasks - '.$meta_setting->title;
		$metaDescription='Browse Tasks - '.$meta_setting->meta_description;
		$metaKeyword='Browse Tasks - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/category/browse_subcategory_list',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
		
	}
	
	
	/*
	Function name :category_task()
	Parameter : $name (Category url name), $offset(for paging)
	Return : array of tasks related categoty
	Use : user can see all tasks details related to category
	Description : user can see all tasks details related to category which called http://hostname/category/category_task/$name	
				  SEO friendly URL which is declare in config route.php file  http://hostname/tags/$name
	*/

	public function category_task($name,$offset=0)
	{
		
		
		//if(!check_user_authentication()) {  redirect('login'); }
		
		$data['cityname'] ='';
		
		$city_id=0;
		
		if(get_authenticateUserID()!='')
		{
			$city_id=getCurrentCity();
			$current_city_name=getCityName($city_id);
			if(isset($current_city_name)) {  $data['cityname']=$current_city_name; }
		}
		
		$data['city_id']=$city_id;
		
		
		$category_name=$this->category_model->get_category_name($name);
		
		if(!$category_name)
		{
			redirect('home');
		}
		
		
		$data['category_name']=$category_name;
		$category_id = $category_name->task_category_id;
		
		
		
		$data['category_url_name']=$name;
		
		$all_categories = $this->category_model->gel_all_category($name);
		$data['all_categories']=$all_categories;
		
		
		
		$category_infos=$this->category_model->get_category_info($name);
		$data['category_infos']=$category_infos;
		
		
		$limit=10;
		$data['offset']=$offset;
		
		$this->load->library('pagination');
		
		//$config['uri_segment']='4';
		$config['base_url'] = site_url('tags/'.$name);
		$config['total_rows'] = $this->category_model->get_total_category_task_list($category_id,$city_id);
		$config['per_page'] = $limit;
				
		$this->pagination->initialize($config);		
		
		$data['page_link'] = $this->pagination->create_links();
		$data['tasks_info'] =$this->category_model->get_category_task_list($category_id,$city_id,$limit,$offset);
		
		$data['total_rows']=$config['total_rows'];
		
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data['theme']=$theme;
		$meta_setting=meta_setting();
		$pageTitle='Browse Tasks - '.$meta_setting->title;
		$metaDescription='Browse Tasks - '.$meta_setting->meta_description;
		$metaKeyword='Browse Tasks - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/category/task_list',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	
	
	/*** Category details
	*	
	**/
	
	/*
	Function name :category_task_in()
	Parameter : $name (Category url name), $city_name (City name), $offset(for paging)
	Return : array of tasks related categoty in particular city
	Use : user can see all tasks details related to category in particular city
	Description : user can see all tasks details related to category in particular city which called http://hostname/category/category_task_in/$name/$city_name
				  SEO friendly URL which is declare in config route.php file  http://hostname/tags/$name/in/$city_name
	*/
	public function category_task_in($name,$city_name,$offset=0)
	{
		
		
		
		$data['cityname'] ='';
		
		$city_id=0;
		
		
		if($city_name != '')
		{ 
		
			if($city_name == 'all')
			{ 
				$data['cityname'] = 'all';
				
			} else {
				$city_id = getCityId(urldecode($city_name));
				$data['cityname'] = urldecode($city_name);
			}

		} else {
		
			if(get_authenticateUserID()!='')
			{
				$city_id=getCurrentCity();
				$current_city_name=getCityName($city_id);
				if(isset($current_city_name)) {  $data['cityname']=$current_city_name; }
			}
		
		}
		
		$data['city_id']=$city_id;
		
		$data['category_url_name']=$name;
		
		$all_categories = $this->category_model->gel_all_category($name);
		$data['all_categories']=$all_categories;
		
		$category_name=$this->category_model->get_category_name($name);
		$data['category_name']=$category_name;
		$category_id = $category_name->task_category_id;
		
		$category_infos=$this->category_model->get_category_info($name);
		$data['category_infos']=$category_infos;
		
		
		$limit=10;
		$data['offset']=$offset;
		
		$this->load->library('pagination');
		
		
		
		
		if($offset>0)
		{
			$config['uri_segment']='5';
		}
		else
		{
			$config['uri_segment']='4';
		}
		
		
		
		
		$config['base_url'] = site_url('tags/'.$name.'/in/'.$data['cityname']);
		$config['total_rows'] = $this->category_model->get_total_category_task_list($category_id,$city_id);
		$config['per_page'] = $limit;
				
		$this->pagination->initialize($config);		
		
		$data['page_link'] = $this->pagination->create_links();
		$data['tasks_info'] =$this->category_model->get_category_task_list($category_id,$city_id,$limit,$offset);
		
		$data['total_rows']=$config['total_rows'];
		
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data['theme']=$theme;
		$meta_setting=meta_setting();
		$pageTitle='Browse Tasks - '.$meta_setting->title;
		$metaDescription='Browse Tasks - '.$meta_setting->meta_description;
		$metaKeyword='Browse Tasks - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/category/task_list',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	function city()
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data['theme']=$theme;
		$meta_setting=meta_setting();
		
		$pageTitle='Browse Tasks - '.$meta_setting->title;
		$metaDescription='Browse Tasks - '.$meta_setting->meta_description;
		$metaKeyword='Browse Tasks - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/category/browse_all_city',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
		
	}
	
	
}

?>