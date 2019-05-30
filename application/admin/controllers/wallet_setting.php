<?php
class Wallet_setting extends CI_Controller {
	function Wallet_setting()
	{
		parent::__construct();	
		$this->load->model('wallet_setting_model');
		$this->load->model('home_model');
		
	}
	
	function index()
	{
		redirect('wallet_setting/add_wallet_setting');
	}
	
	function add_wallet_setting()
	{
		$check_rights=get_rights('add_wallet_setting');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
	     $theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_gateway_detail');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('wallet_add_fees', 'Wallet Add Fees', 'required');
		$this->form_validation->set_rules('wallet_donation_fees', 'Wallet Donation Fees', 'required');
		$this->form_validation->set_rules('wallet_enable', 'Wallet Status', 'required');
		$this->form_validation->set_rules('wallet_minimum_amount', 'Wallet Minimum', 'required');
		$this->form_validation->set_rules('no_payment_after_auto_confirm', 'No Payment After Auto Confirm', 'required|integer');
		
		
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			if($this->input->post('wallet_id'))
			{
				$data["wallet_id"] = $this->input->post('wallet_id');
				$data["wallet_add_fees"] = $this->input->post('wallet_add_fees');
				$data["wallet_donation_fees"] = $this->input->post('wallet_donation_fees');
				$data["wallet_enable"] = $this->input->post('wallet_enable');
				$data["wallet_minimum_amount"] = $this->input->post('wallet_minimum_amount');
				$data["no_payment_after_auto_confirm"] = $this->input->post('no_payment_after_auto_confirm');
								
				
			}else{
				$one_wallet_setting = $this->wallet_setting_model->get_one_wallet_setting();
				$data["wallet_id"] = $one_wallet_setting['wallet_id'];
				$data["wallet_add_fees"] = $one_wallet_setting['wallet_add_fees'];
				$data["wallet_donation_fees"] = $one_wallet_setting['wallet_donation_fees'];
				$data["wallet_enable"] = $one_wallet_setting['wallet_enable'];
				$data["wallet_minimum_amount"] = $one_wallet_setting['wallet_minimum_amount'];
				$data["no_payment_after_auto_confirm"] =  $one_wallet_setting['no_payment_after_auto_confirm'];
				
			}
			
			$data['site_setting'] = site_setting();
		
			
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		    $this->template->write_view('center',$theme .'/layout/wallet/add_wallet_setting',$data,TRUE);
		    $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		    $this->template->render();
		}
		else{
			$this->wallet_setting_model->wallet_setting_update();
			$data["error"] = "Wallet settings updated successfully";
			$data["wallet_id"] = $this->input->post('wallet_id');
			$data["wallet_add_fees"] = $this->input->post('wallet_add_fees');
			$data["wallet_donation_fees"] = $this->input->post('wallet_donation_fees');
			$data["wallet_enable"] = $this->input->post('wallet_enable');
			$data["wallet_minimum_amount"] = $this->input->post('wallet_minimum_amount');
			$data["no_payment_after_auto_confirm"] = $this->input->post('no_payment_after_auto_confirm');
			
			$data['site_setting'] = site_setting();
		
			
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		    $this->template->write_view('center',$theme .'/layout/wallet/add_wallet_setting',$data,TRUE);
		    $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		    $this->template->render();
		}				
	}
	
}
?>