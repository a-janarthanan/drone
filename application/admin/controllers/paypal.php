<?php
class Paypal extends CI_Controller {
	function Paypal()
	{
		parent::__construct();	
		$this->load->model('paypal_model');
	}
	
	function index()
	{
		redirect('paypal/list_paypal');
		
	}

/*******PayPal*****/


	function list_paypal($offset=0,$msg='')
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		//$check_rights=get_rights('list_paypal');
		
		//if(	$check_rights==0) {			
			//redirect('home/dashboard/no_rights');	
		//}
		
		$this->load->library('pagination');

		$limit = '5';
		$config['base_url'] = base_url().'paypal/list_paypal/';
		$config['total_rows'] = $this->paypal_model->get_total_paypal_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->paypal_model->get_paypal_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/paypal/list_paypal',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}


	function add_paypal()
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
			
		//$check_rights=get_rights('list_paypal');
		
		//if(	$check_rights==0) {			
			//redirect('home/dashboard/no_rights');	
		//}
		
		
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('site_status', 'Site Status', 'required');
			$this->form_validation->set_rules('application_id', 'Paypal Application Id', 'required');
			$this->form_validation->set_rules('paypal_email', 'Email', 'required');
			$this->form_validation->set_rules('paypal_username', 'Username', 'required');
			$this->form_validation->set_rules('preapproval', 'Preapproval', 'required');
			$this->form_validation->set_rules('gateway_status', 'Gateway Status', 'required');
			$this->form_validation->set_rules('paypal_password', 'Password', 'required');
			$this->form_validation->set_rules('paypal_signature', 'Signature', 'required');
			$this->form_validation->set_rules('transaction_fees', 'Commission Fees', 'required');
			
			if($this->form_validation->run() == FALSE){			
				if(validation_errors())
				{
					$data["error"] = validation_errors();
				}else{
					$data["error"] = "";
				}
				$data["id"] = $this->input->post('id');
				$data["site_status"] = $this->input->post('site_status');
				$data["application_id"] = $this->input->post('application_id');
				$data["paypal_email"] = $this->input->post('paypal_email');
				$data["paypal_username"] = $this->input->post('paypal_username');
				$data["paypal_password"] = $this->input->post('paypal_password');
				$data["paypal_signature"] = $this->input->post('paypal_signature');
				$data["preapproval"] = $this->input->post('preapproval');
				$data["fees_taken_from"] = $this->input->post('fees_taken_from');
				$data["transaction_fees"] = $this->input->post('transaction_fees');
				$data["gateway_status"] = $this->input->post('gateway_status');
				
				
				$data['site_setting'] = site_setting();
				
				
				if($this->input->post('offset')=="")
				{
					$limit = '5';
					$totalRows = $this->paypal_model->get_total_paypal_count();
					$data["offset"] = (int)($totalRows/$limit)*$limit;
				}else{
					$data["offset"] = $this->input->post('offset');
				}
				/*$this->template->write('title', 'Paypal Adaptive Payment Gateway', '', TRUE);
				$this->template->write_view('header', 'header', $data, TRUE);
				$this->template->write_view('main_content', 'add_paypal', $data, TRUE);
				$this->template->write_view('footer', 'footer', '', TRUE);
				$this->template->render();*/
				
				$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
				$this->template->write_view('center',$theme .'/layout/paypal/add_paypal',$data,TRUE);
				$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
				$this->template->render();
			}else{
				if($this->input->post('id'))
				{
					$this->paypal_model->paypal_update();
					$msg = "update";
				}else{
					$this->paypal_model->paypal_insert();
					$msg = "insert";
				}
				$offset = $this->input->post('offset');
				redirect('paypal/list_paypal/'.$offset.'/'.$msg);
			}				
		}

	
	function edit_paypal($id=0,$offset=0)
	{
		
		//$check_rights=get_rights('list_paypal');
		
		//if(	$check_rights==0) {			
			//redirect('home/dashboard/no_rights');	
		//}
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$one_paypal = $this->paypal_model->get_one_paypal($id);
		$data["error"] = "";
		$data["id"] = $id;
		$data["site_status"] = $one_paypal['site_status'];
		$data["application_id"] = $one_paypal['application_id'];
		$data["paypal_email"] = $one_paypal['paypal_email'];
		$data["paypal_username"] = $one_paypal['paypal_username'];
		$data["paypal_password"] = $one_paypal['paypal_password'];
		$data["paypal_signature"] = $one_paypal['paypal_signature'];
		$data["preapproval"] = $one_paypal['preapproval'];
		$data["fees_taken_from"] = $one_paypal['fees_taken_from'];
		$data["transaction_fees"] = $one_paypal['transaction_fees'];
		$data["gateway_status"] = $one_paypal['gateway_status'];
		
		$site_setting = site_setting();
	
		
		$data['site_setting'] = $site_setting;
		$data["offset"] = $offset;

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/paypal/add_paypal',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
		
		

}
?>