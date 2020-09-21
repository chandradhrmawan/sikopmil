<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sewa extends CI_Controller {

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
		$data['breadcump'] 		= "Kendaraan";
		$data['title_page']		= "Kendaraan";
		$data['content_view']	= "transaksi/list_kendaraan";
		$data['list_kendaraan'] = $this->transaksi_model->getAllKendaraan();
		$this->load->view('layout_admin/index',$data);	
	}

	public function pesan($id_kendaraan)
	{
		$data['breadcump'] 		  = "Form Pesan Kendaraan";
		$data['title_page']		  = "Form Pesan Kendaraan";
		$data['content_view']	  = "transaksi/form_pesan_kendaraan";
		$data['detail_kendaraan'] = $this->transaksi_model->getDetailByIdkendaraan($id_kendaraan);
		$this->load->view('layout_admin/index',$data);	
	}

	public function getDetailDataKendaraan($id_kendaraan)
	{
		$data = $this->transaksi_model->getDetailByIdkendaraan($id_kendaraan);
		echo json_encode($data); 
	}

	public function example()
	{
		$this->load->view('transaksi/example');	
	}

	public function data()
	{
		$pages_array = array(
		     array(
		         'name' => 'Indonesia',
		         'code' => 'Id'
		     ),

		     array(
		         'name' => 'Jakarta',
		         'code' => 'CGK'
		     ),

		     array(
		         'name' => 'Bandung',
		         'code' => 'CGK'
		     )
		);
		echo json_encode($pages_array);
	}

	public function getJarak($latitude1, $longitude1, $latitude2, $longitude2, $unit)
	{
		echo json_encode(getDistanceBetween($latitude1, $longitude1, $latitude2, $longitude2,'Km'));
	}
}
