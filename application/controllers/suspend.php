<?php
class Suspend extends ROCKERS_Controller 
{
	
	/*
	Function name :Suspend()
	Description :Its Default Constuctor which called when suspend object initialzie.its load necesary models
	*/
	function Suspend()
	{
		parent::__construct();	
		$this->load->model('suspend_model');
		$this->load->model('user_model');	
	}
	
	
	/*
	Function name :index()
	Parameter : $offset(for paging), $msg(custom message)
	Return : none
	Use : when user suspend at time conversation with administrator done from here
	Description : when user suspend at time conversation with administrator done from here which is called by the http://hostname/suspend
	*/
	
	function index($offset=0,$msg='')
	{
		        
		if(!check_user_authentication()) {  redirect('sign_up'); } 
	   
	
	   
	   $theme = getThemeName();
	   $this->template->set_master_template($theme .'/template.php');
	   
		$this->load->library('pagination');

		$limit = '10';
		$config['uri_segment']='3';
		$config['base_url'] = site_url('suspend/index/');
		$config['total_rows'] = $this->suspend_model->get_total_message();
		$config['per_page'] = $limit;
				
		$this->pagination->initialize($config);		
		
		$data['page_link'] = $this->pagination->create_links();
		$data['result'] = $this->suspend_model->get_all_suspend_message($limit,$offset);
		$data['total_rows']=$config['total_rows'];

		$data['error']='';
		$data['comment'] ='';
		
		$data['offset']=$offset;
		
	   $data['site_setting']=site_setting();
	   $data['theme']=$theme;
	   $meta_setting=meta_setting();

	   
	   $pageTitle='Suspend - '.$meta_setting->title;
	   $metaDescription='Suspend - '.$meta_setting->meta_description;
	   $metaKeyword='Suspend - '.$meta_setting->meta_keyword;
	   
	   $this->template->write('pageTitle',$pageTitle,TRUE);
	   $this->template->write('metaDescription',$metaDescription,TRUE);
	   $this->template->write('metaKeyword',$metaKeyword,TRUE);
	   $this->template->write_view('header',$theme .'/layout/suspend/header_suspend',$data,TRUE);
	   $this->template->write_view('content_center',$theme .'/layout/suspend/index',$data,TRUE);
	   $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
	   $this->template->render();        
               
       
	
	}
	
	
	/*
	Function name :new_message()
	Parameter : $user_suspend_id(user suspend id)
	Return : none
	Use : add new conversation message from here
	Description : new conversation message from here which is called by the http://hostname/suspend/new_message
	*/
	function new_message($user_suspend_id)
	{
		
		   if(!check_user_authentication()) {  redirect('sign_up'); } 
			   
			  if($user_suspend_id=='')
			  {
			  	redirect('sign_up'); 			  
			  }
            
				
				
				 $this->form_validation->set_rules('comment', 'Comment', 'trim|required');
			  
			   
			   if($this->form_validation->run() == FALSE){
			
					if(validation_errors())
					{
						$data["error"] = validation_errors();
					}else{
						$data["error"] = "";
					}
					
					$data['comment'] = $this->input->post('comment');
					
					

				} else {
			
					$apply=$this->suspend_model->new_comment($user_suspend_id);
					
					
					$data['error']='';
					
				}
				$offset =$this->input->post('offset');;
				
				$data['offset']=$offset;
				
				 $theme = getThemeName();
               $this->template->set_master_template($theme .'/template.php');
			   
			    $this->load->library('pagination');
		
				$limit = '10';
				$config['uri_segment']='3';
				$config['base_url'] = site_url('suspend/index/');
				$config['total_rows'] = $this->suspend_model->get_total_message();
				$config['per_page'] = $limit;
						
				$this->pagination->initialize($config);		
				
				$data['page_link'] = $this->pagination->create_links();
				$data['result'] = $this->suspend_model->get_all_suspend_message($limit,$offset);
				$data['total_rows']=$config['total_rows'];
		
				
               $data['site_setting']=site_setting();
               $data['theme']=$theme;
               $meta_setting=meta_setting();

               
               $pageTitle='Suspend - '.$meta_setting->title;
               $metaDescription='Suspend - '.$meta_setting->meta_description;
               $metaKeyword='Suspend - '.$meta_setting->meta_keyword;
               
               $this->template->write('pageTitle',$pageTitle,TRUE);
               $this->template->write('metaDescription',$metaDescription,TRUE);
               $this->template->write('metaKeyword',$metaKeyword,TRUE);
               $this->template->write_view('header',$theme .'/layout/suspend/header_suspend',$data,TRUE);
               $this->template->write_view('content_center',$theme .'/layout/suspend/index',$data,TRUE);
               $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
               $this->template->render();        
               
				
		
	}
	
}

?>