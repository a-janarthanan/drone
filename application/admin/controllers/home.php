<?php


class Home extends CI_Controller {
	
	
	function Home()
	{
		parent::__construct();	
		$this->load->model('home_model');	
		$this->load->model('user_model');	
		$this->load->model('worker_model');
		$this->load->model('task_model');
	}
	
	
	public function index($msg = '')
	{
		if(check_admin_authentication())
		{
			redirect('home/dashboard');
		}
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data=array();
		$data['msg'] = $msg; //login fail message

		$this->template->write_view('header',$theme .'/layout/common/header',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/common/login',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	//////////==========function check userername and password====
	function login()
	{	
		$login =$this->home_model->check_login();
		if($login == '1')
		{
			redirect("home/dashboard/valid");
		}else{
			redirect("home/index/invalid");
		}
	}
	
	
	
	function forgot_password()
	{
		
		
		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
					
		
		
		
		
		
		
		
		}
		
		else
		{
		
			$chk_mail=$this->home_model->forgot_email();
			
			if($chk_mail==0)
			{
					
				$data['error']='email_not_found';
				
			
			
			}
			elseif($chk_mail==2)
			{
				$data['error']='record_not_found';	
				
			
			}
			else
			{
				$data['error']='success';	
				
			
			}
			
		
		}
		
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
	

		$this->template->write_view('header',$theme .'/layout/common/header',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/common/forgot_password',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
		
		
		
		
	}
	
	
	
	
	
	function dashboard($msg='')
    {
	
	
        $theme = getThemeName();
        $this->template->set_master_template($theme .'/template.php');

       $data = array();
       $data['msg'] = $msg; //login success message
       $offset = 0; $limit =10;
       $data['users'] = $this->user_model->get_user_result($offset, $limit);
       $data['workers'] = $this->worker_model->get_worker_result($offset, $limit);
       $data['tasks'] = $this->task_model->get_post_task_result($offset, $limit);
	  
	   $data['city'] = $this->home_model->get_max_city($offset, $limit);
	   $data['min_city']=$this->home_model->get_min_city();
	   
	   $data['complete_task']=$this->task_model->get_complete_task_result($offset, $limit);
	   
	   //echo "<pre>";
       //print_r($data['city']);
        //exit;

       $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
       $this->template->write_view('center',$theme .'/layout/common/dashboard',$data,TRUE);
       $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
       $this->template->render();

}

	
	//function of logout
	function logout()
	{
		$this->session->sess_destroy();
		redirect("home/index/valid");
	}
	
	
	
}

?>