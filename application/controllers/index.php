<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->CI =& get_instance();
		$this->load->model("general_model");
		$this->load->model("master_model");
		$this->load->model("crud_model");
	}

	public function index()
	{				
		$data['breadcump'] 		= "Index";
		$data['title_page']		= "Index";
		$data['content_view']	= "main/index";
		$this->load->view('layout_admin/index',$data);	
	}
}
