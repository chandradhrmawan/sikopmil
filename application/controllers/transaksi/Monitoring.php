<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->CI =& get_instance();
		$this->load->model("general_model");
		$this->load->model("master_model");
		$this->load->model("transaksi_model");
		$this->load->model("crud_model");
	}

	public function index()
	{				
		$data['breadcump'] 			= "Monitoring";
		$data['title_page']			= "Monitoring";
		$data['content_view']		= "transaksi/monitoring";
		$data['location'] 			= $this->general_model->getStartPoint();
		$data['data_service']  		= $this->transaksi_model->getDataService();
		$this->load->view('layout_admin/index',$data);	
	}

}
