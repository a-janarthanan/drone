<?php
class Newsletter extends ROCKERS_Controller 
{
	
	/*
	Function name :Newsletter()
	Description :Its Default Constuctor which called when newsletter object initialzie.its load necesary models
	*/
	
	function Newsletter()
	{
		parent::__construct();	
		$this->load->model('newsletter_model');
		$this->load->model('user_model');		
	}
	
	/*
	Function name :index()
	Parameter :none
	Return : none
	Use : redirect to home
	Description : none
	*/
	
	function index()
	{
		redirect('home/');	
	}
	
	
	/*
	Function name :subscribe()
	Parameter :$subscribe_email( visitor email address), $newsletter_id(newsletter id)
	Return : none
	Use : user can subscribe for newsletter
	Description : user can subscribe for newsletter by posting the email address
	*/
	
	function subscribe($subscribe_email='',$newsletter_id='')
	{		
						
		if($subscribe_email=='')
		{
			if($this->input->post('subscribe_email')=='')
			{
				redirect('home');
			}
			else
			{
				$subscribe_email=$this->input->post('subscribe_email');
			}
		}
				
		$make_subscribe=$this->newsletter_model->make_new_subscription($subscribe_email,$newsletter_id='');
		
		if($make_subscribe==2)
		{
			$data['error']='user_exists';
		}
		
		if($make_subscribe==1)
		{
			$data['error']='successfull';
		}
		
		if($make_subscribe==3)
		{
			$data['error']='not_found';
		}
		
		$data['subscribe_email']=$subscribe_email;
		
		
	
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data['theme']=$theme;
		$meta_setting=meta_setting();
		
		
		$pageTitle='Newsletter Subscription - '.$meta_setting->title;
		$metaDescription='Newsletter Subscription - '.$meta_setting->meta_description;
		$metaKeyword='Newsletter Subscription - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/newsletter/subscribe',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();	
		
	
	
	}
	
	
	/*
	Function name :unsubscribe()
	Parameter :$subscribe_email( visitor email address), $newsletter_id(newsletter id)
	Return : none
	Use : user can unsubscribe for newsletter
	Description : user can unsubscribe for newsletter by this function which called by http://hostname/newsletter/unsubscribe
	*/
	
	
	function unsubscribe($subscribe_email,$newsletter_id='')
	{
		if($subscribe_email=='')
		{
			if($this->input->post('subscribe_email')=='')
			{
				redirect('home');
			}
			else
			{
				$subscribe_email=$this->input->post('subscribe_email');
			}
		}
				
		$make_unsubscribe=$this->newsletter_model->make_unsubscribe($subscribe_email,$newsletter_id='');
		
		
		
		if($make_unsubscribe==1)
		{
			$data['error']='successfull';
		}
		
		if($make_unsubscribe==3)
		{
			$data['error']='not_found';
		}
		
		$data['subscribe_email']=$subscribe_email;
		
		
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data['theme']=$theme;
		$meta_setting=meta_setting();
		
		
		$pageTitle='Newsletter Unsubscription - '.$meta_setting->title;
		$metaDescription='Newsletter Unsubscription - '.$meta_setting->meta_description;
		$metaKeyword='Newsletter Unsubscription - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/newsletter/unsubscribe',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();	
		
	}	
	
	
	/*
	Function name :open()
	Parameter :$report_id(report id)
	Return : none
	Use : user open the email in thier open account at that we track the total open email
	Description : user open the newsletter in his/her account and we track by this function which called by http://hostname/newsletter/open
	*/
	
	function open($report_id='')
	{
		if($report_id!='')
		{
			$this->newsletter_model->track_report($report_id);
		}
	}
	
	
}

?>