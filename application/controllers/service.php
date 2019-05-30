<?php
class Service extends ROCKERS_Controller {
	
	/*
	Function name :Service()
	Description :Its Default Constuctor which called when content object initialzie.its load necesary models
	*/
	function Service()
	{
		parent::__construct();	
		$this->load->model('content_model');
		$this->load->model('service_model');
	}
	
	
	/*
	Function name :terms_of_use()
	Parameter : none
	Return : none
	Use : user can see Terms of use page content
	Description : user can see Terms of use page content which called http://hostname/ontent/terms_of_use			 
	*/
	function home()
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		$data['theme']=$theme;
		$data['content']=$this->content_model->get_content_by_id(1);
		$meta_setting=meta_setting();
		$pageTitle='Terms of Use - '.$meta_setting->title;
		$metaDescription='Terms of Use - '.$meta_setting->meta_description;
		$metaKeyword='Terms of Use - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/service/home',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();		
			
	}
	function service_list()
	{
		
		$data['all_service_list']=$this->service_model->all_service_list();

        $all_categories = $this->service_model->perent_category();
		$data['all_categories']=$all_categories;

		
		

		

		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		$data['theme']=$theme;
		$data['content']=$this->content_model->get_content_by_id(1);
		$meta_setting=meta_setting();
		$pageTitle='Terms of Use - '.$meta_setting->title;
		$metaDescription='Terms of Use - '.$meta_setting->meta_description;
		$metaKeyword='Terms of Use - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/service/service_list',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();	
			
	}
	
	function service_details()
	{
		
		$serviceid=$this->uri->segment(3);

		$all_categories = $this->service_model->perent_category();
		$data['all_categories']=$all_categories;

		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		$data['theme']=$theme;
		$data['service_details']=$this->service_model->get_service_details($serviceid);
		$meta_setting=meta_setting();
		$pageTitle='Marketplace Rules - '.$meta_setting->title;
		$metaDescription='Marketplace Rules - '.$meta_setting->meta_description;
		$metaKeyword='Marketplace Rules - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/service/service_details',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();		
			
	}
	function service_add()
	{
		if(!check_user_authentication()) { redirect('login'); }

		$data['categories'] = $this->service_model->get_all_categories();

		$all_categories = $this->service_model->perent_category();
		$data['all_categories']=$all_categories;
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		$data['theme']=$theme;
		$data['content']=$this->content_model->get_content_by_id(1);
		$meta_setting=meta_setting();
		$pageTitle='Service - '.$meta_setting->title;
		$metaDescription='Service - '.$meta_setting->meta_description;
		$metaKeyword='Service - '.$meta_setting->meta_keyword;

		$addservice= $this->service_model->add_service();
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/service/service_add',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();	
			
	}
	
	
	
}

?>