<?php
class Transaction extends CI_Controller {
	function Transaction()
	{
		parent::__construct();	
		$this->load->model('transaction_model');
		$this->load->model('worker_model');
		
	}
	
	function index()
	{
		redirect('transaction/list_escrow');
		
	}
	
	function list_escrow($limit=20,$option='',$keyword='',$offset=0)
	{
	
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_transaction');
		
		if($check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		$this->load->library('pagination');
		
		if($_POST)
		{			
			$option=$this->input->post('option');
			$keyword=$this->input->post('keyword');
			$data['search_type']='search';
			
			$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',trim($keyword)));
			
			$config['uri_segment']='5';
			$config['base_url'] = base_url().'transaction/list_escrow/'.$limit.'/'.$option.'/'.$keyword.'/';
			$config['total_rows'] = $this->transaction_model->get_total_search_escrow_count($option,$keyword);
			$config['per_page'] = $limit;		
			$this->pagination->initialize($config);		
			$data['page_link'] = $this->pagination->create_links();
			
			$data['result'] = $this->transaction_model->get_search_escrow_result($option,$keyword,$offset,$limit);
			
			
			
		} else {

			if($option!='' && $keyword!='') {
			
				if($offset>0)
				{
					$config['uri_segment']='6';
				}
				else
				{
					$config['uri_segment']='5';
				}
				
			    $config['base_url'] = base_url().'transaction/list_escrow/'.$limit.'/'.$option.'/'.$keyword.'/';
				$config['total_rows'] = $this->transaction_model->get_total_search_escrow_count($option,$keyword);
				$data['result'] = $this->transaction_model->get_search_escrow_result($option,$keyword,$offset,$limit);
				
				$data['search_type']='search';
			 } else {
			
				$config['uri_segment']='4';
				$config['base_url'] = base_url().'transaction/list_escrow/'.$limit.'/';	
				$config['total_rows'] = $this->transaction_model->get_total_transaction_count();
				$data['result'] = $this->transaction_model->get_transaction_result($offset, $limit);

				$data['search_type']='normal';
			}
			
			
			$config['per_page'] = $limit;		
			$this->pagination->initialize($config);		
			$data['page_link'] = $this->pagination->create_links();

			$option=$option;
			$keyword=$keyword;
		
		}
		
		$data['offset'] = $offset;
		$data['limit']= $limit;
		$data['option']=$option;
		$data['keyword']=$keyword;
		
		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/transaction/list_escrow',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	function list_earning($limit=20,$option='',$keyword='',$offset=0)
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_transaction');
		
		if($check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		$this->load->library('pagination');
		
		if($_POST)
		{			
			$option=$this->input->post('option');
			$keyword=$this->input->post('keyword');
			$data['search_type']='search';
			
			$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',trim($keyword)));
			$this->load->library('pagination');
			$config['uri_segment']='5';
			$config['base_url'] = base_url().'transaction/list_earning/'.$limit.'/'.$option.'/'.$keyword.'/';
			$config['total_rows'] = $this->transaction_model->get_total_search_escrow_count($option,$keyword);
			$config['per_page'] = $limit;		
			$this->pagination->initialize($config);		
			$data['page_link'] = $this->pagination->create_links();
			
			$data['result'] = $this->transaction_model->get_search_escrow_result($option,$keyword,$offset,$limit);
			
			
			
		} else {
		
			if($option!='' && $keyword!='') {
			
				if($offset>0)
				{
					$config['uri_segment']='6';
				}
				else
				{
					$config['uri_segment']='5';
				}
				
			    $config['base_url'] = base_url().'transaction/list_earning/'.$limit.'/'.$option.'/'.$keyword.'/';
				$config['total_rows'] = $this->transaction_model->get_total_search_escrow_count($option,$keyword);
				$data['result'] = $this->transaction_model->get_search_escrow_result($option,$keyword,$offset,$limit);
				
				$data['search_type']='search';
			 } else {

				$config['uri_segment']='4';
				$config['base_url'] = base_url().'transaction/list_earning/'.$limit.'/';
				$config['total_rows'] = $this->transaction_model->get_total_transaction_count();
				$data['result'] = $this->transaction_model->get_transaction_result($offset, $limit);

				$data['search_type']='normal';
			}

			$config['per_page'] = $limit;		
			$this->pagination->initialize($config);		
			$data['page_link'] = $this->pagination->create_links();

			$option=$option;
			$keyword=$keyword;
			
		}
		
		$data['offset'] = $offset;
		$data['limit']= $limit;
		$data['option']=$option;
		$data['keyword']=$keyword;

		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/transaction/list_earning',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}

	function list_refund($limit=20,$offset=0)
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_transaction');
		
		if($check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		$this->load->library('pagination');

		$config['uri_segment']='4';
		$config['base_url'] = base_url().'transaction/list_refund_transaction/'.$limit.'/';
		$config['total_rows'] = $this->transaction_model->get_total_refund_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->transaction_model->get_refund_result($offset, $limit);
		//echo '<pre>'; print_r($data['result']);


		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/transaction/list_refund_transaction',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
		
	
	function list_paying($limit=20,$option='',$keyword='',$offset=0)
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_transaction');
		
		if($check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		$this->load->library('pagination');
		
		if($_POST)
		{			
			$option=$this->input->post('option');
			$keyword=$this->input->post('keyword');
			$data['search_type']='search';
			
			$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',trim($keyword)));
			$this->load->library('pagination');
			$config['uri_segment']='5';
			$config['base_url'] = base_url().'transaction/list_paying/'.$limit.'/'.$option.'/'.$keyword.'/';
			$config['total_rows'] = $this->transaction_model->get_total_search_paying_count($option,$keyword);
			$config['per_page'] = $limit;		
			$this->pagination->initialize($config);		
			$data['page_link'] = $this->pagination->create_links();
			
			$data['result'] = $this->transaction_model->get_search_paying_result($option,$keyword,$offset,$limit);
			
			
			
		} else {
		
			if($option!='' && $keyword!='') {
			
				if($offset>0)
				{
					$config['uri_segment']='6';
				}
				else
				{
					$config['uri_segment']='5';
				}
				
			    $config['base_url'] = base_url().'transaction/list_paying/'.$limit.'/'.$option.'/'.$keyword.'/';
				$config['total_rows'] = $this->transaction_model->get_total_search_paying_count($option,$keyword);
				$data['result'] = $this->transaction_model->get_search_paying_result($option,$keyword,$offset,$limit);
				
				$data['search_type']='search';
			 } else {

				$config['uri_segment']='4';
				$config['base_url'] = base_url().'transaction/list_paying/'.$limit.'/';
				$config['total_rows'] = $this->transaction_model->get_total_paying_count();
				$data['result'] = $this->transaction_model->get_paying_result($offset, $limit);

				$data['search_type']='normal';
			}

			$config['per_page'] = $limit;		
			$this->pagination->initialize($config);		
			$data['page_link'] = $this->pagination->create_links();

			$option=$option;
			$keyword=$keyword;
			
		}
		
		$data['offset'] = $offset;
		$data['limit']= $limit;
		$data['option']=$option;
		$data['keyword']=$keyword;

		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/transaction/list_paying',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
}
?>