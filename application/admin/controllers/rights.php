<?php
class Rights extends CI_Controller {
	function Rights()
	{
		parent::__construct();	
		$this->load->model('rights_model');
	}
	
	
	
	function assign_rights($id,$offset=0)
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		if($id=='')
		{
			redirect('admin/list_admin');
		}
		
			
			$data['admin_id']=$id;
			$data['offset']=$offset;
		
			$data['assign_rights']=$this->rights_model->get_assign_rights($id);
			$data['rights']=$this->rights_model->get_rights();	
				
			$data['site_setting'] = site_setting();

			
			$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
			$this->template->write_view('center',$theme .'/layout/rights/assign_rights',$data,TRUE);
			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			$this->template->render();
		
	}
	
	function add_rights($id)
	{
		
		$this->rights_model->add_rights();
		
		//redirect('admin/list_admin/'.$this->input->post('offset').'/rights');
		redirect('admin/list_admin');
	
	}
	
	
	
}

?>