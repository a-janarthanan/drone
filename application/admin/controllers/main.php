<?php 
echo "Inside Main";
defined('BASEPATH') OR exit('No Direct Script Access allowed');


class Main extends CI_Controller
{
	public function index()
	{
		$this->load->view("login");
	}
}
?>