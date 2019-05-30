<?php
class Wallet_report extends CI_Controller {
	function Wallet_report()
	{
		parent::__construct();	
		$this->load->model('wallet_report_model');
		$this->load->model('transaction_model');
		$this->load->model('worker_model');
		
	}
	
	function index()
	{
		redirect('wallet_report/daily_report');
	}
	
	function daily_report()
	{
		

		$check_rights=get_rights('list_daily_report');
		
		if($check_rights==0) {			
			echo "<script>window.location.href='".site_url('home/dashboard/no_rights')."'</script>";	
		}
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		//echo '<pre>'; print_r($_POST);
		
		
		if($_POST)
		{			
			$option=$this->input->post('option');
		} else {
			$option = 'five';
		}
		$data['option'] = $option;
		$data['result'] = $this->wallet_report_model->get_daily_result($option);
		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/wallet_report/daily_report',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	function monthly_report()
	{
		

		$check_rights=get_rights('list_monthly_report');
		
		if($check_rights==0) {			
			echo "<script>window.location.href='".site_url('home/dashboard/no_rights')."'</script>";	
		}
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		if($_POST)
		{			
			$option=$this->input->post('option');
		} else {
			$option = 'current';
		}
		$data['option'] = $option;
		$data['result'] = $this->wallet_report_model->get_monthly_result($option);
		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/wallet_report/monthly_report',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	function yearly_report()
	{
		
		$check_rights=get_rights('list_yearly_report');
		
		if($check_rights==0) {			
			echo "<script>window.location.href='".site_url('home/dashboard/no_rights')."'</script>";	
		}
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');


		if($_POST)
		{			
			$option=$this->input->post('option');
		} else {
			$option = 'current_year';
		}
		$data['option'] = $option;
		$data['result'] = $this->wallet_report_model->get_yearly_result($option);
		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/wallet_report/yearly_report',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
}	
?>	