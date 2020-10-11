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
		if($this->session->userdata('id_role') == 1){
			$this->dashboard();
		}else{
			$this->dashboardUser();
		}
	}

	public function dashboard()
	{	
		$year  					= date('Y');
		$data['breadcump'] 		= "Dashboard";
		$data['title_page']		= "Dashboard";
		$data['content_view']	= "main/index";
		$data['tahun'] 			= $this->master_model->getTahunTransaksi();
		$data['chart_data'] 	= $this->gantiTahun($year);
		$data['pie_tahun'] 	 	= $this->dataTahun();
		$data['pie_jenis'] 	 	= $this->dataJenis();
		$data['jml_sewa'] 		= $this->master_model->jmlData('tx_sewa');
		$data['jml_kendaraan'] 	= $this->master_model->jmlData('mst_kendaraan');
		$data['jml_users'] 		= $this->master_model->jmlData('mst_users');
		$data['jml_service'] 	= $this->master_model->TotalService()->total;
		$this->load->view('layout_admin/index',$data);
	}

	public function dashboardUser()
	{
		$year  					= date('Y');
		$data['breadcump'] 		= "Dashboard";
		$data['title_page']		= "Dashboard";
		$data['content_view']	= "main/indexUser";
		$this->load->view('layout_admin/index',$data);
	}

	public function gantiTahun($year)
	{
		$result = $this->transaksi_model->getBarChartData($year);
		foreach ($result as $key => $value) {
			$data['name'] = $key;
			$data['y'] 	= (int)$value;
			$row[] = $data;
		}
		return $row;
	}

	public function listData()
	{
		$year   = $this->input->post('tahun');
		$result = $this->gantiTahun($year);
		echo json_encode($result);
	}

	public function dataTahun()
	{
		$result = $this->transaksi_model->getChartKendaraan();
		$jml  	= 0;
		foreach ($result as $key => $value) {
			$data['name'] = $value->tahun;
			$data['y'] 	= (int)$value->persen;
			$row[] = $data;
		}
		return $row;
	}

	public function dataJenis()
	{
		$result = $this->transaksi_model->getChartTipe();
		$jml  	= 0;
		foreach ($result as $key => $value) {
			$data['name'] = $value->nm_tipe;
			$data['y'] 	= (int)$value->persen;
			$row[] = $data;
		}
		return $row;

	}


}
