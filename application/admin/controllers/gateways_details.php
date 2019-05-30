<?php
class Gateways_details extends CI_Controller {
	function Gateways_details()
	{
		parent::__construct();	
		$this->load->model('gateways_detail_model');
		$this->load->model('home_model');
			
	}
	
	function index()
	{
		redirect('gateways_details/list_gateway_detail');
	}
	
	function add_detail($id)
	{

		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_gateway_detail');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('payment_gateway_id', 'Payment Gateway', 'required|numeric');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('value', 'Value', 'required');
		$this->form_validation->set_rules('label', 'Label', 'required');
		
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			$data["id"] = $this->input->post('id');
			$data["name"] = $this->input->post('name');
			$data["payment_gateway_id"] = $id;
			$data["value"] = $this->input->post('value');
			$data["label"] = $this->input->post('label');
			$data["description"] = $this->input->post('description');
			$data['payment'] = $this->gateways_detail_model->get_payment_result($id);
			
			$data['site_setting'] = site_setting();
			
			if($this->input->post('offset')=="")
			{
				$limit = '10';
				$totalRows = $this->gateways_detail_model->get_total_detail_count($id);
				$data["offset"] = (int)($totalRows/$limit)*$limit;
			}else{
				$data["offset"] = $this->input->post('offset');
			}
			
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		    $this->template->write_view('center',$theme .'/layout/wallet/add_gateway_detail',$data,TRUE);
		    $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		    $this->template->render();
		}else{
			if($this->input->post('id'))
			{
				$this->gateways_detail_model->detail_update();
				$msg = "update";
			}else{
				$this->gateways_detail_model->detail_insert();
				$msg = "insert";
			}
			$offset = $this->input->post('offset');
			$payid= $this->input->post('payment_gateway_id');
			
			redirect('gateways_details/list_gateway_detail/'.$payid);
		}				
	}
	
	function edit_detail($id=0,$payid=0,$offset=0)
	{
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_gateway_detail');

		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('payment_gateway_id', 'Payment Gateway', 'required|numeric');
		$this->form_validation->set_rules('description', 'Description', 'required');
		
		
		if($this->form_validation->run() == FALSE){			
			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			
		$one_pay = $this->gateways_detail_model->get_one_detail($id);
		
		$data["error"] = "";
		$data["id"] = $id;
	 	$data["name"] = $one_pay['name'];
		
		$data["payment_gateway_id"] = $one_pay['payment_gateway_id'];
		$data["description"] = $one_pay['description'];
		$data["value"] = $one_pay['value'];
		$data["label"] = $one_pay['label'];
		$data['payment'] = $this->gateways_detail_model->get_payment_result($payid);
		
		$data['site_setting'] = site_setting();
		
		$data["offset"] = $offset;
		
		
		    $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		    $this->template->write_view('center',$theme .'/layout/wallet/edit_gateway_detail',$data,TRUE);
		    $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		    $this->template->render();
		}
		else{
			if($this->input->post('id'))
			{
				$this->gateways_detail_model->detail_update();
				$msg = "update";
			}
			
			$offset = $this->input->post('offset');
			$payid= $this->input->post('payment_gateway_id');
			redirect('gateways_details/list_gateway_detail/'.$payid.'/'.$offset.'/'.$msg);
		}
	}
	
	function delete_detail($id=0,$pay=0,$offset=0)
	{
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_gateway_detail');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$this->db->delete('gateways_details',array('id'=>$id));
		redirect('gateways_details/list_gateway_detail/'.$pay.'/'.$offset.'/delete');
	}
	
	function list_gateway_detail($id=0,$offset=0,$msg='')
	{
		
	
	
	   $theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_gateway_detail');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		
		$this->load->library('pagination');

		$limit = '10';
		
				
		$config['base_url'] = base_url().'gateways_details/list_gateway_detail/'.$id.'/';
		$config['total_rows'] = $this->gateways_detail_model->get_total_detail_count($id);
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		$data['pay']= $this->gateways_detail_model->get_payment_result($id);
		
		
		$data['result'] = $this->gateways_detail_model->get_detail_result($id,$offset, $limit);
		
		$data['site_setting'] = site_setting();
		
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		$data['payid'] = $id;
		
		
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		    $this->template->write_view('center',$theme .'/layout/wallet/list_gateway_detail',$data,TRUE);
		    $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		    $this->template->render();
	}
	
}
?>