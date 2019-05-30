<?php
class Payments_gateways extends CI_Controller {
	function Payments_gateways()
	{
		parent::__construct();	
		$this->load->model('payments_gateway_model');
		$this->load->model('home_model');
			
	}
	
	function index()
	{
		redirect('payments_gateways/list_payment_gateway');	
	}
	
	function add_payment()
	{

		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_payment_gateway');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		//$this->form_validation->set_rules('function_name', 'Function Name', 'required');
		//$this->form_validation->set_rules('suapport_masspayment', 'Suapport Masspayment', 'required');
		
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			$data["id"] = $this->input->post('id');
			$data["name"] = $this->input->post('name');
			$data["status"] = $this->input->post('status');
			$data["image"] = $this->input->post('image');
			$data["function_name"] = $this->input->post('function_name');
			$data["suapport_masspayment"] = $this->input->post('suapport_masspayment');
			$data["auto_confirm"] = $this->input->post('auto_confirm');
		
			if($this->input->post('offset')=="")
			{
				$limit = '10';
				$totalRows = $this->payments_gateway_model->get_total_payment_count();
				$data["offset"] = (int)($totalRows/$limit)*$limit;
			}else{
				$data["offset"] = $this->input->post('offset');
			}
			
			$data['site_setting'] = site_setting();
			
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		    $this->template->write_view('center',$theme .'/layout/wallet/add_payment_gateway',$data,TRUE);
		    $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		    $this->template->render();
		}else{
			if($this->input->post('id'))
			{
				$this->payments_gateway_model->payment_update();
				$msg = "update";
			}else{
				
				
				$this->payments_gateway_model->payment_insert();
				$msg = "insert";
			}
			$offset = $this->input->post('offset');
			redirect('payments_gateways/list_payment_gateway/'.$offset.'/'.$msg);
		}				
	}
	
	function edit_status($id=0,$offset=0)
	{
	
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_payment_gateway');

		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$one_pay = $this->payments_gateway_model->get_one_payment($id);
		
		if($one_pay['status']=='Active' or $one_pay['status']!='Inactive'){
		
		$this->db->query("UPDATE ".$this->db->dbprefix('payments_gateways')." SET `status`='Inactive' where `id`='".$id."'");		
		redirect('payments_gateways/list_payment_gateway/'.$offset.'/status');
		
		}
		
		else{
		
		$this->db->query("UPDATE ".$this->db->dbprefix('payments_gateways')." SET `status`='Active' where `id`='".$id."'");		
		redirect('payments_gateways/list_payment_gateway/'.$offset.'/status');
			
		}
		
		
	}
	
	function edit_payment($id=0,$offset=0)
	{
		
		
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_payment_gateway');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		
		$one_pay = $this->payments_gateway_model->get_one_payment($id);
		$data["error"] = "";
		$data["id"] = $id;
		$data["name"] = $one_pay['name'];
		$data["status"] = $one_pay['status'];
		$data["image"] = $one_pay['image'];
		$data["function_name"] = $one_pay['function_name'];
		$data["suapport_masspayment"] = $one_pay['suapport_masspayment'];
		$data["auto_confirm"] = $one_pay['auto_confirm'];
		
		
		$data['site_setting'] = site_setting();
		
		$data["offset"] = $offset;
		
		
		    $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		    $this->template->write_view('center',$theme .'/layout/wallet/add_payment_gateway',$data,TRUE);
		    $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		    $this->template->render();
	}
	
	function delete_payment($id=0,$offset=0)
	{
		
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_payment_gateway');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$this->payments_gateway_model->delete_payment_gateway($id);
		redirect('payments_gateways/list_payment_gateway/'.$offset.'/delete');
	}
	
	function list_payment_gateway($offset=0,$msg='')
	{
	
	    $theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_payment_gateway');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}

		$this->load->library('pagination');

		$limit = '10';
		
		$config['base_url'] = base_url().'payments_gateways/list_payment_gateway/';
		$config['total_rows'] = $this->payments_gateway_model->get_total_payment_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->payments_gateway_model->get_payment_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		$data['site_setting'] = site_setting();
		
	
		
		    $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		    $this->template->write_view('center',$theme .'/layout/wallet/list_payment_gateway',$data,TRUE);
		    $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		    $this->template->render();
	}
	
}
?>