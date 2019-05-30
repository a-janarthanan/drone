<?php


class Suspend extends CI_Controller {
	
	
	function Suspend()
	{
		parent::__construct();	
		$this->load->model('suspend_model');
		
	}
	
	
	function index($user_id,$offset=0,$msg='')
	{
	
	 		 if($user_id=='')
			  {
			  	redirect('user/list_suspend_user'); 			  
			  }
		    
			$data['user_id']=$user_id;    
         
			   
               $theme = getThemeName();
               $this->template->set_master_template($theme .'/template.php');
			   
			    $this->load->library('pagination');
		
				$limit = '10';
				$config['uri_segment']='4';
				$config['base_url'] = site_url('suspend/index/'.$user_id);
				$config['total_rows'] = $this->suspend_model->get_total_message($user_id);
				$config['per_page'] = $limit;
						
				$this->pagination->initialize($config);		
				
				$data['page_link'] = $this->pagination->create_links();
				$data['result'] = $this->suspend_model->get_all_suspend_message($user_id,$limit,$offset);
				$data['total_rows']=$config['total_rows'];
		
				$data['error']='';
				$data['comment'] ='';
				
				$data['offset']=$offset;
				
               $data['site_setting']=site_setting();
               $data['theme']=$theme;
             

              
               
           
             $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
               $this->template->write_view('center',$theme .'/layout/suspend/index',$data,TRUE);
               $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
               $this->template->render();        
               
       
	
	}
	
	
	function new_message($user_id,$user_suspend_id)
	{
		
		  
			   
			  if($user_suspend_id=='' || $user_id=='')
			  {
			  	redirect('user/list_suspend_user'); 			  
			  }
            
					$data['user_id']=$user_id;    
				
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
			
					$apply=$this->suspend_model->new_comment($user_id,$user_suspend_id);
					
					
					$data['error']='';
					
				}
				$offset =$this->input->post('offset');;
				
				$data['offset']=$offset;
				
				 $theme = getThemeName();
               $this->template->set_master_template($theme .'/template.php');
			   
			    $this->load->library('pagination');
		
				$limit = '10';
				$config['uri_segment']='4';
				$config['base_url'] = site_url('suspend/index/');
				$config['total_rows'] = $this->suspend_model->get_total_message($user_id);
				$config['per_page'] = $limit;
						
				$this->pagination->initialize($config);		
				
				$data['page_link'] = $this->pagination->create_links();
				$data['result'] = $this->suspend_model->get_all_suspend_message($user_id,$limit,$offset);
				$data['total_rows']=$config['total_rows'];
		
				
               $data['site_setting']=site_setting();
               $data['theme']=$theme;
             

           
           	   $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
               $this->template->write_view('center',$theme .'/layout/suspend/index',$data,TRUE);
               $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
               $this->template->render();        
               
				
		
	}
	
	
	
	
	function remove_suspend($user_id,$user_suspend_id)
	{
		$this->suspend_model->remove_suspend($user_id,$user_suspend_id);
		
		redirect('user/list_suspend_user');
	}
	
	
	function make_permanent_suspend($user_id,$user_suspend_id)
	{
		$this->suspend_model->make_permanent_suspend($user_id,$user_suspend_id);
		
		redirect('user/list_suspend_user');
	}
	
	
}

?>