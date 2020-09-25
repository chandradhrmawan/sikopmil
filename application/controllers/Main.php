<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->CI =& get_instance();
		$this->load->model("general_model");
		$this->load->model("master_model");
		$this->load->model("transaksi_model");
	}

	public function index()
	{				

		if($this->session->has_userdata('id_user')){
			$this->isLogin();
		}else{
			$this->load->view('login/index');
		}
	}

	public function isLogin()
	{
		
		$data['breadcump'] 		= "Dashboard";
		$data['title_page']		= "Dashboard";
		$data['content_view']	= "main/index";
		$this->load->view('layout_admin/index',$data);
	}

}
