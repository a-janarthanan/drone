<?php
class Newsletter extends CI_Controller {
	
	function Newsletter()
	{
		parent::__construct();
		$this->load->model('newsletter_model');
		$this->load->model('home_model');	
	}
	
	function index()
	{
		redirect('newsletter/list_newsletter');
	}
	
	
	function list_newsletter($limit='20',$offset=0,$msg='')
	{
	  
	  $data = array();
		$check_rights= get_rights('list_newsletter');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
			
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		$this->load->library('pagination');

		//$limit = '10';
		$config['uri_segment']='4';
		$config['base_url'] = base_url().'newsletter/list_newsletter/'.$limit.'/';
		$config['total_rows'] = $this->newsletter_model->get_total_template_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->newsletter_model->get_template_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = site_setting();
		
		
	     	 $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/newsletter/list_newsletter',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
	}
	
	function search_newsletter($limit=20,$option='',$keyword='',$offset=0,$msg='')
	{
		
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_newsletter');
	     if($check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
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
		
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));
		
		$this->load->library('pagination');

		//$limit = '10';
		
		$config['uri_segment']='6';
		
		$config['base_url'] = base_url().'newsletter/search_newsletter/'.$limit.'/'.$option.'/'.$keyword.'/';
		$config['total_rows'] = $this->newsletter_model->get_total_search_template_count($option,$keyword);
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->newsletter_model->get_search_template_result($option,$keyword,$offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		$data['limit']=$limit;
		$data['option']=$option;
		$data['keyword']=$keyword;
		$data['search_type']='search';
		
	
		
		$data['site_setting'] = site_setting();
		
		
		
		     $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/newsletter/list_newsletter',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
	
	}
	
	
	function get_project_template($pid)
	{
		if($pid=='')
		{
			return false;
		}
		
		else
		{	
			
			
			$data['site_setting'] = site_setting();
			
			$data['project']=$this->project_category_model->get_one_project($pid);
			$data['project_gallery']=$this->project_category_model->get_all_project_gallery($pid);
			
			return $this->load->view('newsletter/project_template',$data);		
		}
		
		
	}
	
	function add_newsletter($limit=20)
	{
		
		$check_rights= get_rights('list_newsletter');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}	
			
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		
		
				
		
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			$data["newsletter_id"] = $this->input->post('newsletter_id');
			$data["subject"] = $this->input->post('subject');
			
			
			
			
			$data["file_up"] = $this->input->post('file_up');
			$data["prev_attach_file"] = $this->input->post('prev_attach_file');
			
			$data["allow_subscribe_link"] = $this->input->post('allow_subscribe_link');
			$data["allow_unsubscribe_link"] = $this->input->post('allow_unsubscribe_link');
			//$data["project_id"] = $this->input->post('project_id');	
			
			$data['subscribe_to']=$this->input->post('subscribe_to');				
			
			
			$data['site_setting'] = site_setting();
			
			$data["template_content"] = $this->input->post('template_content');
			
			
			if($this->input->post('offset')=="")
			{
				$limit = '10';
				$totalRows = $this->newsletter_model->get_total_template_count();
				$data["offset"] = (int)($totalRows/$limit)*$limit;
			}else{
				$data["offset"] = $this->input->post('offset');
			}
			
			 
			 
			 $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/newsletter/add_newsletter',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
			
		}
		else{
			
			
			//$CI =& get_instance();	
			//$base_url = $CI->config->slash_item('base_url_site');											
			//$base_path = $CI->config->slash_item('base_path');
			
			
			if($this->input->post('newsletter_id'))
			{						
				$this->newsletter_model->newsletter_update();				
				$msg = "update";
				
			}else{
				
				$this->newsletter_model->newsletter_insert();
				$msg = "insert";
			}
			$offset = $this->input->post('offset');
			redirect('newsletter/list_newsletter/'.$limit.'/'.$offset.'/'.$msg);
		}				
		
		
	
	}
	
	
	function edit_newsletter($id=0,$offset=0)
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
			 
		$check_rights= get_rights('list_newsletter');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}	
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		if($id==0 || $id=='')
		{
			redirect('newsletter/list_newsletter/');
		}			
		
		$one_newsletter = $this->newsletter_model->get_one_newsletter($id);
		$data["error"] = "";
		$data["newsletter_id"] = $id;
		
		$data["subject"] = $one_newsletter->subject;
		$data["template_content"] =
		
		$data["file_up"] = '';
		$data["prev_attach_file"] = $one_newsletter->attach_file;
		
		$data["allow_subscribe_link"] = $one_newsletter->allow_subscribe_link;
		$data["allow_unsubscribe_link"] = $one_newsletter->allow_unsubscribe_link;
		$data["project_id"] = $one_newsletter->project_id;
	
		
		
		$data['site_setting'] = site_setting();
		
		
		//$data['all_project'] = $this->newsletter_model->all_project();
		
		
		$data["template_content"] = $one_newsletter->template_content;
		
		
		$data['subscribe_to']='';
				
		$data["offset"] = $offset;
		
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
	    $this->template->write_view('center',$theme .'/layout/newsletter/add_newsletter',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	
	function action_newsletter()
	{
		
		$check_rights= get_rights('list_newsletter');

		$limit=20;
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		$offset=$this->input->post('offset');
		$action=$this->input->post('action');
		$newsletter_id=$this->input->post('chk');
		
					
		
		if($action=='delete')
		{			
			foreach($newsletter_id as $id)
			{
				$this->newsletter_model->delete_newsletter($id);
			}
			
			$offset = $this->input->post('offset');
			redirect('newsletter/list_newsletter/'.$limit.'/'.$offset.'/delete');
		}
		
		
	
	}
	
	
	//////////////////===============subscriber part====================
	
	
	function show_all_subscriber($nwid,$offset=0,$msg='')
	{
		
		$data = array();
		$check_rights= get_rights('list_newsletter_user');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		if($nwid=='')
		{		
			redirect('newsletter/list_newsletter');
		}
		
		
		
		$this->load->library('pagination');

		$limit = '10';
		$config['uri_segment']='4';
		$config['base_url'] = base_url().'newsletter/show_all_subscriber/'.$nwid.'/';
		$config['total_rows'] = $this->newsletter_model->get_total_newsletter_user_count($nwid);
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->newsletter_model->get_newsletter_user_result($nwid,$offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		$data['newsletter_id']=$nwid;
		
		
		
		$data['site_setting'] = site_setting();
		
		$newsletter=$this->newsletter_model->get_one_newsletter($nwid);
		
		
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
	    $this->template->write_view('center',$theme .'/layout/newsletter/list_newsletter_subscriber',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	
	}
	
	
	function search_subscriber_user($nwid,$option='',$keyword='',$offset=0,$msg='')
	{
	$data = array();
		$check_rights= get_rights('list_newsletter_user');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		if($nwid=='')
		{		
			redirect('newsletter/list_newsletter');
		}
		
		
		
		
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
		
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));
			
		
		
		$this->load->library('pagination');

		$limit = '10';
		
		$config['uri_segment']='6';
		
		$config['base_url'] = base_url().'newsletter/search_subscriber_user/'.$nwid.'/'.$option.'/'.$keyword.'/';
		$config['total_rows'] = $this->newsletter_model->get_total_search_newsletter_user_count($nwid,$option,$keyword);
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->newsletter_model->get_search_newsletter_user_result($nwid,$option,$keyword, $offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		$data['newsletter_id']=$nwid;
		
		
		
		$data['site_setting'] = site_setting();
		
		$newsletter=$this->newsletter_model->get_one_newsletter($nwid);
		
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/newsletter/list_newsletter_subscriber',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
	
	}
	
	
	function action_newsletter_subscriber()
	{
		
		$check_rights= get_rights('list_newsletter');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}	
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		$offset=$this->input->post('offset');
		$action=$this->input->post('action');
		$newsletter_user_id=$this->input->post('chk');
		
		$newsletter_id = $this->input->post('newsletter_id');
					
		
		if($action=='delete')
		{			
			foreach($newsletter_user_id as $id)
			{
				$this->newsletter_model->delete_user_subscription($id,$newsletter_id);
			}
			
			$offset = $this->input->post('offset');
			
			
			redirect('newsletter/show_all_subscriber/'.$newsletter_id.'/'.$offset.'/delete');
		}
	}
	
	//////////////////===============subscriber part====================
	
	
	
	
	////////////////////=============Newsletter User=================
	
	
	function list_newsletter_user($limit='20',$offset=0,$msg='')
	{
		
		$data = array();
		$check_rights= get_rights('list_newsletter_user');

		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		$this->load->library('pagination');

		//$limit = '10';
		$config['uri_segment']='4';
		$config['base_url'] = base_url().'newsletter/list_newsletter_user/'.$limit.'/';
		$config['total_rows'] = $this->newsletter_model->get_total_user_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->newsletter_model->get_user_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		
		
		$data['site_setting'] = site_setting();
		
		
	
	   
		     $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/newsletter/list_newsletter_user',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
	
	}
	
	
	
	
	
	function search_newsletter_user($limit=20,$option='',$keyword='',$offset=0,$msg='')
	{
		
		$data = array();
		$check_rights= get_rights('list_newsletter_user');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
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
		
		//$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));
		
		$this->load->library('pagination');

		//$limit = '10';
		
		$config['uri_segment']='6';
		
		$config['base_url'] = base_url().'newsletter/search_newsletter_user/'.$limit.'/'.$option.'/'.$keyword.'/';
		$config['total_rows'] = $this->newsletter_model->get_total_search_user_count($option,$keyword);
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->newsletter_model->get_search_user_result($option,$keyword,$offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		$data['limit']=$limit;
		$data['option']=$option;
		$data['keyword']=$keyword;
		$data['search_type']='search';
		
		
		
		$data['site_setting'] = site_setting();
		
		
		
		  
		     $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/newsletter/list_newsletter_user',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
	
	}
	
	
	
	function email_check($email)
	{
		$username = $this->newsletter_model->user_unique($email);
		if($username == TRUE)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('email_check', 'There is an existing account associated with this Email');
			return FALSE;
		}
	}	
	
	
	
	function add_newsletter_user($limit=20)
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
	   $check_rights= get_rights('list_newsletter_user');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
			
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
		$this->form_validation->set_rules('user_name', 'User Name', 'required|alpha_space');
		
		
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			$data["newsletter_user_id"] = $this->input->post('newsletter_user_id');
			$data["email"] = $this->input->post('email');
			$data["user_name"] = $this->input->post('user_name');
				
			
			
			$data['site_setting'] = site_setting();
			$data['all_newsletter'] = $this->newsletter_model->get_all_newsletter_templates();
			
			
			if($this->input->post('newsletter_user_id')=='')
			{
				$data['all_subscription'] = '';
			}
			else
			{			
				$data['all_subscription'] = $this->newsletter_model->get_all_subscription($this->input->post('newsletter_user_id'));
			}
			
			
			if($this->input->post('offset')=="")
			{
				$limit = '10';
				$totalRows = $this->newsletter_model->get_total_user_count();
				$data["offset"] = (int)($totalRows/$limit)*$limit;
			}else{
				$data["offset"] = $this->input->post('offset');
			}
			
			
			
		     $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/newsletter/add_user',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
			 
		}
		else
		{
			
			
			$CI =& get_instance();	
			$base_url = $CI->config->slash_item('base_url_site');											
			$base_path = $CI->config->slash_item('base_path');
			
			
			if($this->input->post('newsletter_user_id'))
			{					
				$this->newsletter_model->user_update();				
				$msg = "update";
				
			}else{
				
				$this->newsletter_model->user_insert();
				$msg = "insert";
			}
			$offset = $this->input->post('offset');
			redirect('newsletter/list_newsletter_user/'.$limit.'/'.$offset.'/'.$msg);
		}				
		
		
	
	}
	
	
	function edit_newsletter_user($id=0,$offset=0)
	{
		
		
		
		$data = array();
		$check_rights= get_rights('list_newsletter_user');
		
		if(	$check_rights==0) {			
		redirect('home/dashboard/no_rights');	
		}
				
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$one_user = $this->newsletter_model->get_one_user($id);
		$data["error"] = "";
		$data["newsletter_user_id"] = $id;
		$data["email"] = $one_user['email'];
		$data["user_name"] = $one_user['user_name'];
			
		$data['all_newsletter'] = $this->newsletter_model->get_all_newsletter_templates();
		
		
		$data['site_setting'] = site_setting();
		
		$data['all_subscription'] = $this->newsletter_model->get_all_subscription($id);
		
		$data["offset"] = $offset;
		
		
		
		      $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/newsletter/add_user',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
	}
	
	
	function action_newsletter_user()
	{
		
		$check_rights=$this->home_model->get_rights('list_newsletter_user');
			
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		$offset=$this->input->post('offset');
		$action=$this->input->post('action');
		$newsletter_user_id=$this->input->post('chk');
		
					
		$limit=20;	
		//if($action=='delete')
		//{	
			
			foreach($newsletter_user_id as $id)
			{
				$this->newsletter_model->delete_newsletter_user($id);
			}
			
			$offset = $this->input->post('offset');
			redirect('newsletter/list_newsletter_user/'.$limit.'/'.$offset.'/delete');
		//}
		
		
	
	}
	
	
	//////===========CSV ======PART============
	    
	
	function force_download($filename = '', $data = false, $enable_partial = true, $speedlimit = 0)
    {
        if ($filename == '')
        {
            return FALSE;
        }
        
        if($data === false && !file_exists($filename))
            return FALSE;

        // Try to determine if the filename includes a file extension.
        // We need it in order to set the MIME type
        if (FALSE === strpos($filename, '.'))
        {
            return FALSE;
        }
    
        // Grab the file extension
        $x = explode('.', $filename);
        $extension = end($x);

        // Load the mime types
        @include(APPPATH.'config/mimes'.EXT);
    
        // Set a default mime if we can't find it
        if ( ! isset($mimes[$extension]))
        {
            if (ereg('Opera(/| )([0-9].[0-9]{1,2})', $_SERVER['HTTP_USER_AGENT']))
                $UserBrowser = "Opera";
            elseif (ereg('MSIE ([0-9].[0-9]{1,2})', $_SERVER['HTTP_USER_AGENT']))
                $UserBrowser = "IE";
            else
                $UserBrowser = '';
            
            $mime = ($UserBrowser == 'IE' || $UserBrowser == 'Opera') ? 'application/octetstream' : 'application/octet-stream';
        }
        else
        {
            $mime = (is_array($mimes[$extension])) ? $mimes[$extension][0] : $mimes[$extension];
        }
        
        $size = $data === false ? filesize($filename) : strlen($data);
        
        if($data === false)
        {
            $info = pathinfo($filename);
            $name = $info['basename'];
        }
        else
        {
            $name = $filename;
        }
        
        // Clean data in cache if exists
        @ob_end_clean();
        
        // Check for partial download
        if(isset($_SERVER['HTTP_RANGE']) && $enable_partial)
        {
            list($a, $range) = explode("=", $_SERVER['HTTP_RANGE']);
            list($fbyte, $lbyte) = explode("-", $range);
            
            if(!$lbyte)
                $lbyte = $size - 1;
            
            $new_length = $lbyte - $fbyte;
            
            header("HTTP/1.1 206 Partial Content", true);
            header("Content-Length: $new_length", true);
            header("Content-Range: bytes $fbyte-$lbyte/$size", true);
        }
        else
        {
            header("Content-Length: " . $size);
        }
        
        // Common headers
        header('Content-Type: ' . $mime, true);
        header('Content-Disposition: attachment; filename="' . $name . '"', true);
        header("Expires: 0", true);
        header('Accept-Ranges: bytes', true);
        header("Cache-control: private", true);
        header('Pragma: private', true);header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        
        // Open file
        if($data === false) {
            $file = fopen($filename, 'r');
            
            if(!$file)
                return FALSE;
        }
        
        // Cut data for partial download
        if(isset($_SERVER['HTTP_RANGE']) && $enable_partial)
            if($data === false)
                fseek($file, $range);
            else
                $data = substr($data, $range);
        
        // Disable script time limit
        @set_time_limit(0);
        
        // Check for speed limit or file optimize
        if($speedlimit > 0 || $data === false)
        {
            if($data === false)
            {
                $chunksize = $speedlimit > 0 ? $speedlimit * 1024 : 512 * 1024;
            
                while(!feof($file) and (connection_status() == 0))
                {
                    $buffer = fread($file, $chunksize);
                    echo $buffer;
                    flush();
                    
                    if($speedlimit > 0)
                        sleep(1);
                }
                
                fclose($file);
            }
            else
            {
                $index = 0;
                $speedlimit *= 1024; //convert to kb
                
                while($index < $size and (connection_status() == 0))
                {
                    $left = $size - $index;
                    $buffersize = min($left, $speedlimit);
                    
                    $buffer = substr($data, $index, $buffersize);
                    $index += $buffersize;
                    
                    echo $buffer;
                    flush();
                    sleep(1);
                }
            }
        }
        else
        {
            echo $data;
        }
		
		$this->db->cache_delete_all();
		ob_clean();
        flush();
		
    } 
	
	
	
	function export_newsletter_user($time='')
	{
		
		$data = array();
		$check_rights= get_rights('list_newsletter_user');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		$this->load->dbutil();
		$query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('newsletter_user')." ");		
		
		$delimiter = ",";
		$newline = "\r\n";

		$csv= $this->dbutil->csv_from_result($query, $delimiter, $newline);
		
		 $file_name = "newsletter_user_".date('d-m-Y').".csv";
   		 $this->force_download($file_name,$csv);
		$this->db->cache_delete_all();	
	}
	
	function import_newsletter_user()
	{
			
			$data = array();
		$check_rights= get_rights('list_newsletter_user');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$data['error']='';
		
		$data['site_setting'] = site_setting();
		
		
		
		     $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/newsletter/add_csv_user',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
		
				
	}
	
	
	function add_csv_upload()
	{
		$data = array();
		$check_rights= get_rights('list_newsletter_user');
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
			
			$CI =& get_instance();
			$base_path = $CI->config->slash_item('base_path');
		
		
		
			
				$this->load->library('upload');
				$rand=rand(0,100000);

		
		  
			
				$_FILES['userfile']['name']     =   $_FILES['upcsv']['name'];
				$_FILES['userfile']['type']     =   $_FILES['upcsv']['type'];
				$_FILES['userfile']['tmp_name'] =   $_FILES['upcsv']['tmp_name'];
				$_FILES['userfile']['error']    =   $_FILES['upcsv']['error'];
				$_FILES['userfile']['size']     =   $_FILES['upcsv']['size']; 
				
				
			$config['file_name']     =$rand.'coupon';
			$config['upload_path'] = $base_path.'admin/upload_csv/'; /* NB! create this dir! */			
			$config['allowed_types'] = 'csv';
			$config['max_size'] = '300';
			
			
			 $this->upload->initialize($config);
			 
			 
			if (!$this->upload->do_upload())
			{		
				
				$error = array('error' => $this->upload->display_errors());
				$err = str_replace("<p>","",$error['error']);
				$err = str_replace("</p>","",$err);
				$data['error'] = $err;
				
				$data['site_setting'] = site_setting();
				
				
				
				   $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			       $this->template->write_view('center',$theme .'/layout/newsletter/add_csv_user',$data,TRUE);
			       $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			       $this->template->render();
			   
			}
			
			$picture = $this->upload->data();
								
				  
				   $file_name=$base_path.'admin/upload_csv/'.$picture['file_name'];
				  					
						
						$fp = fopen("$file_name", "r");//for open uploaded file
						$data = fgetcsv($fp, 500, ",");
						$cnt = 1;
						$users = array();
						while (($data = fgetcsv($fp, 500, ",")) != FALSE) //for get content
						{
																
									if($data[0]!='')
									{
									
									$chk_user=$this->newsletter_model->user_unique(trim($data[1]));
									
										if($chk_user== TRUE)
										{
										
										
										$email_name=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$data[0]));
										
							$this->db->query("insert into newsletter_user(`user_name`,`email`,`user_date`,`user_ip`)values('".$email_name."','".trim($data[1])."','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."')");									
										}
									
									}
								
							
								
						}
			
			
					fclose($fp);
					
					if(is_file($base_path.'admin/upload_csv/'.$picture['file_name']))
					{
		
						unlink($base_path.'admin/upload_csv/'.$picture['file_name']);
					}
					
					$limit=20;
					redirect('newsletter/list_newsletter_user/'.$limit.'/0/insert');
					
		
		
	}
	
	
	//////===========CSV ======PART============
	
	
	
	////////////////////=============Newsletter Job=================
	
	
	
	function newsletter_job($limit = '20',$offset=0,$msg='')
	{
		
		$data = array();
		$check_rights= get_rights('newsletter_job');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
				
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
				
		$this->load->library('pagination');

		//$limit = '10';
		$config['uri_segment']='4';
		$config['base_url'] = base_url().'newsletter/newsletter_job/'.$limit.'/';
		$config['total_rows'] = $this->newsletter_model->get_count_newsletter_job();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->newsletter_model->get_all_newsletter_job($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		
		
		$data['site_setting'] = site_setting();
		
		
	
	         $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/newsletter/list_newsletter_job',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
			 
		
		
	}
	
	
	
	function search_newsletter_job($limit=20,$option='',$keyword='',$offset=0,$msg='')
	{
		$data = array();
		$check_rights= get_rights('newsletter_job');
		
		if(	$check_rights==0) {			
		redirect('home/dashboard/no_rights');	
		}
				
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
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
		
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));
		
		$this->load->library('pagination');

		//$limit = '10';
		
		$config['uri_segment']='6';
		
		$config['base_url'] = base_url().'newsletter/search_newsletter_job/'.$limit.'/'.$option.'/'.$keyword.'/';
		$config['total_rows'] = $this->newsletter_model->get_total_search_job_count($option,$keyword);
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->newsletter_model->get_search_job_result($option,$keyword,$offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		$data['limit']=$limit;
		$data['option']=$option;
		$data['keyword']=$keyword;
		$data['search_type']='search';
		
		
		
		$data['site_setting'] = site_setting();
		
		
		       $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/newsletter/list_newsletter_job',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
	
	}
	
	
	function add_newsletter_job($limit=20)
	{
		$data = array();
		$check_rights= get_rights('newsletter_job');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
				
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('newsletter_id', 'Select Newsletter', 'required');
		$this->form_validation->set_rules('job_start_date', 'Job Start Date', 'required');
			
		
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			$data["newsletter_id"] = $this->input->post('newsletter_id');
			$data['job_start_date'] = $this->input->post('job_start_date');
			
				
			
			
			$data['site_setting'] = site_setting();
			$data['all_newsletter'] = $this->newsletter_model->get_all_newsletter_templates();
						
			
			if($this->input->post('offset')=="")
			{
				$limit = '10';
				$totalRows = $this->newsletter_model->get_count_newsletter_job();
				$data["offset"] = (int)($totalRows/$limit)*$limit;
			}else{
				$data["offset"] = $this->input->post('offset');
			}
		
			
			  $this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/newsletter/add_newsletter_job',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
		}
		else
		{
			
				
				$this->newsletter_model->add_new_job();
				$msg = "insert";
			
			$offset = $this->input->post('offset');
			redirect('newsletter/newsletter_job/'.$limit.'/'.$offset.'/'.$msg);
		}				
	
	
	}
	
	
	function action_newsletter_job()
	{
		$data = array();
		$check_rights= get_rights('newsletter_job');
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');

		$limit=20;
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		$offset=$this->input->post('offset');
		$action=$this->input->post('action');
		$job_id=$this->input->post('chk');
		
					
		
		if($action=='delete')
		{			
			foreach($job_id as $id)
			{
				$this->newsletter_model->delete_newsletter_job($id);
			}
			
			$offset = $this->input->post('offset');
			redirect('newsletter/newsletter_job/'.$limit.'/'.$offset.'/delete');
		}
		
		
	
	}
	
	
	
	function newsletter_statistics($job_id,$newsletter_id)
	{
		$data = array();
		
		$check_rights= get_rights('newsletter_job');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
				
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$data['newsletter']=$this->newsletter_model->get_one_newsletter($newsletter_id);
		$data['job']=$this->newsletter_model->get_one_job($job_id);
		$data['total_subscription']=$this->newsletter_model->get_total_subscription($newsletter_id);
		$data['total_send']=$this->newsletter_model->get_total_job_send($job_id);
		$data['total_read']=$this->newsletter_model->get_total_job_open($job_id);
		$data['total_fail']=$this->newsletter_model->get_total_job_fail($job_id);
		
		
		$data['site_setting'] = site_setting();
		
		$this->template->write_view('center',$theme .'/layout/newsletter/job_report',$data,TRUE);
		$this->template->render();
	
	}
	
	
	
	
	
	///////////////////=============setting part========================
	
	
	function newsletter_setting()
	{
		
		$check_rights= get_rights('newsletter_setting');
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		$theme = getThemeName();
		
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('newsletter_from_name', 'From Name', 'required|alpha_space');
		$this->form_validation->set_rules('newsletter_from_address', 'From Email Address', 'required|valid_email');
		
		$this->form_validation->set_rules('newsletter_reply_name', 'Reply Name', 'required|alpha_space');
		$this->form_validation->set_rules('newsletter_reply_address', 'Reply Email Address', 'required|valid_email');
		
		$this->form_validation->set_rules('new_subscribe_email', 'New Subscribe Email', 'required|valid_email');
		$this->form_validation->set_rules('unsubscribe_email', 'Unsubscriber Email', 'required|valid_email');
		
		$this->form_validation->set_rules('new_subscribe_to', 'User Default Newsletter', 'required');
		
		if($this->input->post('new_subscribe_to')=='selected')
		{
			$this->form_validation->set_rules('selected_newsletter_id', 'Newsletter', 'required|is_natural_no_zero');
		}
		
		
		$this->form_validation->set_rules('number_of_email_send', 'Number Of Email Send', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('break_between_email', 'Break Between No. Email Send', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('break_type', 'Break Type', 'required');
		
		
		$this->form_validation->set_rules('mailer', 'Mailer', 'required');
		
		if($this->input->post('mailer')=='sendmail')
		{
			$this->form_validation->set_rules('sendmail_path', 'Sendmail Path', 'required');
		}
		
		
		if($this->input->post('mailer')=='smtp')
		{
			$this->form_validation->set_rules('smtp_port', 'Smtp Port', 'required|is_natural_no_zero');
			$this->form_validation->set_rules('smtp_host', 'Smtp Host', 'required');
			$this->form_validation->set_rules('smtp_email', 'Smtp Email', 'required|valid_email');
			$this->form_validation->set_rules('smtp_password', 'Smtp Password', 'required');
		}
		
		
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			if($this->input->post('newsletter_setting_id'))
			{
				
				$newsletter_setting = $this->newsletter_model->get_newsletter_setting();
				
				$data["newsletter_setting_id"] = $this->input->post('newsletter_setting_id');
				
				$data["newsletter_from_name"] = $this->input->post('newsletter_from_name');	
				$data["newsletter_from_address"] = $this->input->post('newsletter_from_address');	
							
				$data["newsletter_reply_name"] = $this->input->post('newsletter_reply_name');
				$data["newsletter_reply_address"] = $this->input->post('newsletter_reply_address');				
				
				$data["new_subscribe_email"] = $this->input->post('new_subscribe_email');
				$data["unsubscribe_email"] = $this->input->post('unsubscribe_email');
				
				$data["new_subscribe_to"] = $this->input->post('new_subscribe_to');
				$data["selected_newsletter_id"] = $this->input->post('selected_newsletter_id');
				
				
				$data["number_of_email_send"] = $this->input->post('number_of_email_send');			
				$data["break_between_email"] = $this->input->post('break_between_email');
				$data["break_type"] = $this->input->post('break_type');
								
				$data["mailer"] = $this->input->post('mailer');
				$data["sendmail_path"] = $this->input->post('sendmail_path');
				$data["smtp_port"] = $this->input->post('smtp_port');
				$data["smtp_host"] = $this->input->post('smtp_host');
				$data["smtp_email"] = $this->input->post('smtp_email');
				$data["smtp_password"] = $this->input->post('smtp_password');
				
				
				
			}else{
				$newsletter_setting = $this->newsletter_model->get_newsletter_setting();
				
				$data["newsletter_setting_id"] = $newsletter_setting->newsletter_setting_id;
				
				$data["newsletter_from_name"] = $newsletter_setting->newsletter_from_name;	
				$data["newsletter_from_address"] = $newsletter_setting->newsletter_from_address;	
							
				$data["newsletter_reply_name"] = $newsletter_setting->newsletter_reply_name;
				$data["newsletter_reply_address"] = $newsletter_setting->newsletter_reply_address;				
				
				$data["new_subscribe_email"] = $newsletter_setting->new_subscribe_email;
				$data["unsubscribe_email"] = $newsletter_setting->unsubscribe_email;
				
				$data["new_subscribe_to"] = $newsletter_setting->new_subscribe_to;
				$data["selected_newsletter_id"] = $newsletter_setting->selected_newsletter_id;
				
				
				$data["number_of_email_send"] = $newsletter_setting->number_of_email_send;			
				$data["break_between_email"] = $newsletter_setting->break_between_email;
				$data["break_type"] = $newsletter_setting->break_type;
								
				$data["mailer"] = $newsletter_setting->mailer;
				$data["sendmail_path"] = $newsletter_setting->sendmail_path;
				$data["smtp_port"] = $newsletter_setting->smtp_port;
				$data["smtp_host"] = $newsletter_setting->smtp_host;
				$data["smtp_email"] = $newsletter_setting->smtp_email;
				$data["smtp_password"] = $newsletter_setting->smtp_password;
				
				
				
			}
			
			
			$data['all_newsletter'] = $this->newsletter_model->get_all_newsletter_templates();
			
			
			
			$data['site_setting'] = site_setting();
			
			
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/newsletter/newsletter_setting',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
		}
		else{
			
			
			$this->newsletter_model->newsletter_setting_update();		
			
			
			$data["error"] = "Newsletter settings updated successfully.";
			
			$newsletter_setting = $this->newsletter_model->get_newsletter_setting();
				
				$data["newsletter_setting_id"] = $newsletter_setting->newsletter_setting_id;
				
				$data["newsletter_from_name"] = $newsletter_setting->newsletter_from_name;	
				$data["newsletter_from_address"] = $newsletter_setting->newsletter_from_address;	
							
				$data["newsletter_reply_name"] = $newsletter_setting->newsletter_reply_name;
				$data["newsletter_reply_address"] = $newsletter_setting->newsletter_reply_address;				
				
				$data["new_subscribe_email"] = $newsletter_setting->new_subscribe_email;
				$data["unsubscribe_email"] = $newsletter_setting->unsubscribe_email;
				
				$data["new_subscribe_to"] = $newsletter_setting->new_subscribe_to;
				$data["selected_newsletter_id"] = $newsletter_setting->selected_newsletter_id;
				
				
				$data["number_of_email_send"] = $newsletter_setting->number_of_email_send;			
				$data["break_between_email"] = $newsletter_setting->break_between_email;
				$data["break_type"] = $newsletter_setting->break_type;
								
				$data["mailer"] = $newsletter_setting->mailer;
				$data["sendmail_path"] = $newsletter_setting->sendmail_path;
				$data["smtp_port"] = $newsletter_setting->smtp_port;
				$data["smtp_host"] = $newsletter_setting->smtp_host;
				$data["smtp_email"] = $newsletter_setting->smtp_email;
				$data["smtp_password"] = $newsletter_setting->smtp_password;
				
				
							
				
			
			$data['site_setting'] = site_setting();
			
			$data['all_newsletter'] = $this->newsletter_model->get_all_newsletter_templates();	
			
			
			
			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			 $this->template->write_view('center',$theme .'/layout/newsletter/newsletter_setting',$data,TRUE);
			 $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			 $this->template->render();
		}			
		
		
		
	
	}
	
	
}

?>