<?php
class Wallet extends CI_Controller {
	function Wallet()
	{
		parent::__construct();	
		$this->load->model('wallet_model');
		$this->load->model('home_model'); 
		$this->load->model('user_model'); 
		
	}
	
	function index()
	{
		
		
	
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_wallet_withdraw');
		
		if(	$check_rights_withdraw==1) {			
			redirect('wallet/list_wallet_withdraw');
		}
		else
		{
			
			
			
			$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_wallet_withdraw');
			
			
			
			if(	$check_rights_review==1) {			
				redirect('wallet/list_wallet_review');
			}
			else
			{
				redirect('home/dashboard/no_rights');
			}
		
		
		}
		
		
		
		
	}

	
	function list_wallet_review($offset=0,$msg='')
	{
		
		
		//$check_rights=$this->home_model->get_rights('list_wallet_review');
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_wallet_review');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		$this->load->library('pagination');

		$limit = '15';
		
		
		$config['base_url'] = base_url().'wallet/list_wallet_review/';
		$config['total_rows'] =$this->wallet_model->get_total_wallet_review_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->wallet_model->get_wallet_review_result($offset, $limit);
		//echo "<pre>";
		//print_r($data['result']);
		//exit;
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		$data['site_setting'] = site_setting();
		
		/*$this->template->write('title', 'Wallet Review', '', TRUE);
		$this->template->write_view('header', 'header', $data, TRUE);
		$this->template->write_view('main_content', 'wallet/list_wallet_review', $data, TRUE);
		$this->template->write_view('footer', 'footer', '', TRUE);
		$this->template->render();*/
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/wallet/list_wallet_review',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	

	function list_buy_credit($offset=0,$msg='')
	{
		
		
		//$check_rights=$this->home_model->get_rights('list_wallet_review');
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		//$check_rights=get_rights('list_wallet_review');
		
		/*if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}*/
		
		
		
		$this->load->library('pagination');

		$limit = '15';
		
		
		$config['base_url'] = base_url().'wallet/list_buy_credit/';
		$config['total_rows'] =$this->wallet_model->get_total_buy_credit_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->wallet_model->get_buy_credit_result($offset, $limit);
		//echo "<pre>";
		//print_r($data['result']);
		//exit;
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		$data['site_setting'] = site_setting();
		
		/*$this->template->write('title', 'Wallet Review', '', TRUE);
		$this->template->write_view('header', 'header', $data, TRUE);
		$this->template->write_view('main_content', 'wallet/list_wallet_review', $data, TRUE);
		$this->template->write_view('footer', 'footer', '', TRUE);
		$this->template->render();*/
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/wallet/list_buy_credit',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	

	function list_buy_creditonline($offset=0,$msg='')
	{
		
		
		//$check_rights=$this->home_model->get_rights('list_wallet_review');
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		//$check_rights=get_rights('list_wallet_review');
		
		/*if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}*/
		
		
		
		$this->load->library('pagination');

		$limit = '15';
		
		
		$config['base_url'] = base_url().'wallet/list_buy_credit/';
		$config['total_rows'] =$this->wallet_model->get_total_buy_onlinecredit_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->wallet_model->get_buy_onlinecredit_result($offset, $limit);
		//echo "<pre>";
		//print_r($data['result']);
		//exit;
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		$data['site_setting'] = site_setting();
		
		/*$this->template->write('title', 'Wallet Review', '', TRUE);
		$this->template->write_view('header', 'header', $data, TRUE);
		$this->template->write_view('main_content', 'wallet/list_wallet_review', $data, TRUE);
		$this->template->write_view('footer', 'footer', '', TRUE);
		$this->template->render();*/
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/wallet/list_buy_creditonline',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	
	
	function search_walletreview($option='',$keyword='',$offset=0,$msg='')
	{
		
		//$check_rights=$this->home_model->get_rights('list_wallet_review');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_wallet_review');

		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
			
		
		$this->load->library('pagination');

		$limit = '15';
		
		if($_POST)
		{		
			$option=$this->input->post('option');
			$keyword=$this->input->post('keyword');
		}
		else
		{
			$option=$option;
			$keyword=$keyword;			
		}
		
		
		 $keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","@","(",")",":",";",">","<","/"),'',$keyword));
	
		$config['uri_segment']='5';
		$config['base_url'] = base_url().'wallet/search_walletreview/'.$option.'/'.$keyword.'/';
			
			
		$config['total_rows'] =$this->wallet_model->get_total_search_wallet_review_count($option,$keyword);
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->wallet_model->get_search_wallet_review_result($option,$keyword,$offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		$data['wallet_setting']=$this->wallet_model->wallet_setting();
		
		$data['site_setting'] = site_setting();
		
		/*$this->template->write('title', 'Wallet Review', '', TRUE);
		$this->template->write_view('header', 'header', $data, TRUE);
		$this->template->write_view('main_content', 'wallet/list_wallet_review', $data, TRUE);
		$this->template->write_view('footer', 'footer', '', TRUE);
		$this->template->render();*/
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
	    $this->template->write_view('center',$theme .'/layout/wallet/list_wallet_review',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
			
	}
	
	
	function action_review()
	{
		
		
		//$check_rights=$this->home_model->get_rights('list_wallet_review');
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_wallet_review');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		 $offset=$this->input->post('offset');
		 $action=$this->input->post('action');
		 $trans_id=$this->input->post('chk');
		//print_r($trans_id);
		//exit;
		if($action=='delete')
		{	
			foreach($trans_id as $id)
			{
				$this->db->delete('wallet',array('id' =>$id));
			}
			
			redirect('wallet/list_wallet_review/'.$offset.'/delete');
		}
		
		if($action=='Confirm')
		{	
			foreach($trans_id as $id)
			{
				$this->db->query("update ".$this->db->dbprefix('wallet')." set admin_status='Confirm' where id='".$id."'");				
			}
			
			redirect('wallet/list_wallet_review/'.$offset.'/confirm');
		}
		
		if($action=='Review')
		{
			foreach($trans_id as $id)
			{
				$this->db->query("update ".$this->db->dbprefix('wallet')." set admin_status='Review' where id='".$id."'");		
			}
			
			redirect('wallet/list_wallet_review/'.$offset.'/review');
		}
	}
	
	
	
	
	
	
	function list_wallet_withdraw($offset=0,$msg='')
	{
		
		
		//$check_rights=$this->home_model->get_rights('list_wallet_withdraw');
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_wallet_withdraw');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		
		
		$this->load->library('pagination');

		$limit = '15';
		
		
		$config['base_url'] = base_url().'wallet/list_wallet_withdraw/';
		$config['total_rows'] =$this->wallet_model->get_total_withdraw_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->wallet_model->get_withdraw_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		$data['wallet_setting']=$this->wallet_model->wallet_setting();
		
		$data['site_setting'] = site_setting();
		
		/*$this->template->write('title', 'Wallet Review', '', TRUE);
		$this->template->write_view('header', 'header', $data, TRUE);
		$this->template->write_view('main_content', 'wallet/list_wallet_withdraw', $data, TRUE);
		$this->template->write_view('footer', 'footer', '', TRUE);
		$this->template->render();*/
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		    $this->template->write_view('center',$theme .'/layout/wallet/list_wallet_withdraw',$data,TRUE);
		    $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		    $this->template->render();
	}	
	
	
	
	function search_withdrawal($option='',$keyword='',$offset=0,$msg='')
	{
		
		//$check_rights=$this->home_model->get_rights('list_wallet_withdraw');
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_wallet_withdraw');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
			
		
		$this->load->library('pagination');

		$limit = '15';
		
		if($_POST)
		{		
			$option=$this->input->post('option');
			$keyword=$this->input->post('keyword');
		}
		else
		{
			$option=$option;
			$keyword=$keyword;			
		}
		
		
		 $keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","@","(",")",":",";",">","<","/"),'',$keyword));
	
		$config['uri_segment']='5';
		$config['base_url'] = base_url().'wallet/search_withdrawal/'.$option.'/'.$keyword.'/';
			
			
		$config['total_rows'] =$this->wallet_model->get_total_search_withdraw_count($option,$keyword);
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->wallet_model->get_search_withdraw_result($option,$keyword,$offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		$data['wallet_setting']=$this->wallet_model->wallet_setting();
		
		$data['site_setting'] = site_setting();
		
		/*$this->template->write('title', 'Wallet Review', '', TRUE);
		$this->template->write_view('header', 'header', $data, TRUE);
		$this->template->write_view('main_content', 'wallet/list_wallet_withdraw', $data, TRUE);
		$this->template->write_view('footer', 'footer', '', TRUE);
		$this->template->render();*/
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		    $this->template->write_view('center',$theme .'/layout/wallet/list_wallet_withdraw',$data,TRUE);
		    $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		    $this->template->render();
			
	}
	
	function action_withdraw()
	{
		
		//$check_rights=$this->home_model->get_rights('list_wallet_withdraw');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_wallet_withdraw');
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		$offset=$this->input->post('offset');
		$action=$this->input->post('action');
		$trans_id=$this->input->post('chk');
		
		if($action=='delete')
		{	
			foreach($trans_id as $id)
			{
				$this->db->delete('wallet_withdraw',array('withdraw_id' =>$id));
			}
			
			redirect('wallet/list_wallet_withdraw/'.$offset.'/delete');
		}
		
		if($action=='Confirm')
		{	
			foreach($trans_id as $id)
			{
				
				$details=$this->db->query("select * from ".$this->db->dbprefix('wallet_withdraw')." where withdraw_id='".$id."'");		
				$withdraw_details=$details->row();
				
				if($withdraw_details->withdraw_status != 'confirm'){
				


					$insert_owner_wallet=$this->db->query("insert into ".$this->db->dbprefix('wallet')." (`credit`,`user_id`,`admin_status`,`wallet_date`,`wallet_transaction_id`,`wallet_payee_email`,`wallet_ip`,`gateway_id`)values('".$withdraw_details->withdraw_amount."','".$withdraw_details->user_id."','Confirm','".date("Y-m-d H:i:s")."','Administrator','Administrator','Anonymous','0')");
					
					
					$this->db->query("update ".$this->db->dbprefix('wallet_withdraw')." set withdraw_status='confirm' where withdraw_id='".$id."'");	
				
				
									
					$query = $this->db->get_where('admin');
					$res_admin = $query->row_array();
					$email_address_from = $res_admin['email'];					
				
					$user_detail=$this->db->query("select * from ".$this->db->dbprefix('user')." where user_id='".$withdraw_details->user_id."'");	
					$login_user=$user_detail->row_array();
					
					
					
					$str = "Hello ".$login_user['full_name'].",\n\nYour withdrawal payment process is successed.\n\n\nThank You.";
				
							
					$this->load->library('email');
					$this->email->from($email_address_from);
					$this->email->to($login_user['email']);
					$this->email->subject("Withdrawal Payment Process Successed");
					$this->email->message($str);
					$this->email->send();
				}	
					
							
			}
			
			redirect('wallet/list_wallet_withdraw/'.$offset.'/confirm');
		}
		
		
	}
	
	
	
	
	
	
	
	function withdraw_detail($id)
	{
		
		
		//$check_rights=$this->home_model->get_rights('list_wallet_withdraw');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_wallet_withdraw');
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		$withdraw_detail=$this->wallet_model->get_withdraw_detail($id);
		
		
		$data['total_current_amount']=$this->wallet_model->user_current_wallet_amount($withdraw_detail->user_id);
		
		$data['withdraw_method']=$withdraw_detail->withdraw_method;
		$data['amount']=$withdraw_detail->withdraw_amount;
		
		$data['full_name']=$withdraw_detail->full_name;
		$data['last_name']=$withdraw_detail->last_name;
		$data['email']=$withdraw_detail->email;
		
		$bank_detail=$this->wallet_model->get_withdraw_method_detail($id,'bank');
		$check_detail=$this->wallet_model->get_withdraw_method_detail($id,'check');				
		$gateway_detail=$this->wallet_model->get_withdraw_method_detail($id,'gateway');
		
		if($bank_detail)
		{		
			$data['bank_name']=$bank_detail->bank_name;
			$data['bank_branch']=$bank_detail->bank_branch;
			$data['bank_ifsc_code']=$bank_detail->bank_ifsc_code;
			$data['bank_address']=$bank_detail->bank_address;
			$data['bank_city']=$bank_detail->bank_city;
			$data['bank_state']=$bank_detail->bank_state;
			$data['bank_country']=$bank_detail->bank_country;
			$data['bank_zipcode']=$bank_detail->bank_zipcode;
			$data['bank_account_holder_name']=$bank_detail->bank_account_holder_name;
			$data['bank_account_number']=$bank_detail->bank_account_number;
		
		}
		else
		{
			$data['bank_name']='';
			$data['bank_branch']='';
			$data['bank_ifsc_code']='';
			$data['bank_address']='';
			$data['bank_city']='';
			$data['bank_state']='';
			$data['bank_country']='';
			$data['bank_zipcode']='';
			$data['bank_account_holder_name']='';
			$data['bank_account_number']='';
		}
		
		
		if($check_detail)
		{
			$data['check_name']=$check_detail->bank_name;
			$data['check_branch']=$check_detail->bank_branch;
			$data['check_unique_id']=$check_detail->bank_unique_id;
			$data['check_address']=$check_detail->bank_address;
			$data['check_city']=$check_detail->bank_city;
			$data['check_state']=$check_detail->bank_state;
			$data['check_country']=$check_detail->bank_country;
			$data['check_zipcode']=$check_detail->bank_zipcode;
			$data['check_account_holder_name']=$check_detail->bank_account_holder_name;
			$data['check_account_number']=$check_detail->bank_account_number;
		}
		else
		{
			$data['check_name']='';
			$data['check_branch']='';
			$data['check_unique_id']='';
			$data['check_address']='';
			$data['check_city']='';
			$data['check_state']='';
			$data['check_country']='';
			$data['check_zipcode']='';
			$data['check_account_holder_name']='';
			$data['check_account_number']='';
		
		}
		
		if($gateway_detail)
		{					
		
			$data['gateway_name']=$gateway_detail->gateway_name;
			$data['gateway_account']=$gateway_detail->gateway_account;
			$data['gateway_city']=$gateway_detail->gateway_city;
			$data['gateway_state']=$gateway_detail->gateway_state;
			$data['gateway_country']=$gateway_detail->gateway_country;
			$data['gateway_zip']=$gateway_detail->gateway_zip;
				
		}
		
		else
		{
			$data['gateway_name']='';
			$data['gateway_account']='';
			$data['gateway_city']='';
			$data['gateway_state']='';
			$data['gateway_country']='';
			$data['gateway_zip']='';
		}	
		
		
		$data['site_setting'] = site_setting();
		
		$data['wallet_setting']=$this->wallet_model->wallet_setting();
		
		//$this->load->view('wallet/withdrawal_detail',$data);
		
		//$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		    $this->template->write_view('center',$theme .'/layout/wallet/withdrawal_detail',$data,TRUE);
		   // $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		    $this->template->render();
		
				
	
		
	}

	function action_credit_review()
	{
		
		
		//$check_rights=$this->home_model->get_rights('list_wallet_review');
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		/*$check_rights=get_rights('list_wallet_review');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}*/
		
		
		
		 $offset=$this->input->post('offset');
		 $action=$this->input->post('action');
		 $trans_id=$this->input->post('chk');
		//print_r($trans_id);
		//exit;
		
		
		if($action=='Confirm')
		{	
			foreach($trans_id as $id)
			{

				//echo "hhh".$id;
                                $userid=$this->wallet_model->getNameTable("trc_credit_bankinfo","user_id","id",$id);
				$pckid=$this->wallet_model->getNameTable("trc_credit_bankinfo","package_id","id",$id);
				$numbid=$this->wallet_model->getNameTable("trc_membership","numbid","id",$pckid);
				$avbid=$this->wallet_model->getNameTable("trc_user","avilable_bid","user_id",$userid);

				$newbid  =$avbid+$numbid;



				$this->db->query("update ".$this->db->dbprefix('user')." set avilable_bid='".$newbid."' where user_id='".$userid."'");
				$this->db->query("update ".$this->db->dbprefix('credit_bankinfo')." set status='1' where id='".$id."'");				
			
				//exit;
			}
			
			redirect('wallet/list_buy_credit/'.$offset.'/confirm');
		}
		
		
	}
	
	
	
	
}

?>