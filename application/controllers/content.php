<?php
class Content extends ROCKERS_Controller {
	
	/*
	Function name :Content()
	Description :Its Default Constuctor which called when content object initialzie.its load necesary models
	*/
	function Content()
	{
		parent::__construct();	
		$this->load->model('content_model');
	}
	
	
	/*
	Function name :terms_of_use()
	Parameter : none
	Return : none
	Use : user can see Terms of use page content
	Description : user can see Terms of use page content which called http://hostname/ontent/terms_of_use			 
	*/
	function terms_of_use()
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
		$this->template->write_view('content_center',$theme .'/layout/content/terms_of_use',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();		
			
	}
	function terms_and_use()
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
		$this->template->write_view('content_center',$theme .'/layout/content/terms_of_use',$data,TRUE);
		$this->template->render();		
			
	}
	
	function marketplace_rules()
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		$data['theme']=$theme;
		$data['content']=$this->content_model->get_content_by_id(1);
		$meta_setting=meta_setting();
		$pageTitle='Marketplace Rules - '.$meta_setting->title;
		$metaDescription='Marketplace Rules - '.$meta_setting->meta_description;
		$metaKeyword='Marketplace Rules - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/content/marketplace_rules',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();		
			
	}
	
	function payments()
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		$data['theme']=$theme;
		$data['content']=$this->content_model->get_content_by_id(1);
		$meta_setting=meta_setting();
		$pageTitle='Payments - '.$meta_setting->title;
		$metaDescription='Payments - '.$meta_setting->meta_description;
		$metaKeyword='Payments - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/content/payments',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();		
			
	}
	
	
	/*
		Function name : about_us()
		Parameter : none
		Return : none
		Use : display how its work page
		Description : user can see how its work page by this function which is called by http://hostname/worker/how_it_works
					  or SEO friendly URL for this http://hostname/about_us
		*/
	
		function about_us()
		{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		$data['theme']=$theme;
		$data['content']=$this->content_model->get_content_by_id(2);
		$meta_setting=meta_setting();
		$pageTitle='About us - '.$meta_setting->title;
		$metaDescription='About us - '.$meta_setting->meta_description;
		$metaKeyword='About us - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/content/about_us',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
		}
		/*
		Function name : terms()
		Parameter : none
		Return : none
		Use : display how its work page
		Description : user can see how its work page by this function which is called by http://hostname/worker/how_it_works
					  or SEO friendly URL for this http://hostname/terms
		*/
	
		function terms()
		{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		$data['theme']=$theme;
		$data['content']=$this->content_model->get_content_by_id(3);
		$meta_setting=meta_setting();
		$pageTitle='terms - '.$meta_setting->title;
		$metaDescription='terms - '.$meta_setting->meta_description;
		$metaKeyword='terms - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/content/terms',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
		}
		/*
		Function name : privacy()
		Parameter : none
		Return : none
		Use : display how its work page
		Description : user can see how its work page by this function which is called by http://hostname/worker/how_it_works
					  or SEO friendly URL for this http://hostname/privacy
		*/
	
		function privacy()
		{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		$data['theme']=$theme;
		$data['content']=$this->content_model->get_content_by_id(5);
		$meta_setting=meta_setting();
		$pageTitle='privacy - '.$meta_setting->title;
		$metaDescription='privacy - '.$meta_setting->meta_description;
		$metaKeyword='privacy - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/content/privacy',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
		}
		/*
		Function name : trustsafety()
		Parameter : none
		Return : none
		Use : display how its work page
		Description : user can see how its work page by this function which is called by http://hostname/worker/how_it_works
					  or SEO friendly URL for this http://hostname/trustsafety
		*/
	
		function trustsafety()
		{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		$data['theme']=$theme;
		$data['content']=$this->content_model->get_content_by_id(3);
		$meta_setting=meta_setting();
		$pageTitle='trust and safety - '.$meta_setting->title;
		$metaDescription='trust and safety - '.$meta_setting->meta_description;
		$metaKeyword='trust and safety - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/content/trust-safety',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
		}
		/*
		Function name : help()
		Parameter : none
		Return : none
		Use : display how its work page
		Description : user can see how its work page by this function which is called by http://hostname/worker/how_it_works
					  or SEO friendly URL for this http://hostname/help
		*/
	
		function help()
		{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		$data['theme']=$theme;
		$data['content']=$this->content_model->get_content_by_id(4);
		$meta_setting=meta_setting();
		$pageTitle='help - '.$meta_setting->title;
		$metaDescription='help - '.$meta_setting->meta_description;
		$metaKeyword='help - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/content/help',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
		}
	
}

?>