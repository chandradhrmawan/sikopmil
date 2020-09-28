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
		$data['breadcump'] 		= "Data Pemesanan";
		$data['title_page']		= "Data Pemesanan";
		$data['content_view']	= "transaksi/list_pemesanan";
		$data['data_pemesanan'] = $this->transaksi_model->getAllRiwayatSewa();
		$data['data_supir']  	= $this->master_model->getAll('mst_supir');
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

	public function updateStatusSewa()
	{
		$id_sewa =  $this->input->post('id_sewa');
		$data = array(
			'status_sewa' 	=> $this->input->post('status_sewa'),
			'id_supir' 		=> $this->input->post('id_supir'),
			'keterangan' 	=> $this->input->post('ket_reject'),
		);
		$data2 = array(
			'status' 	 	=> 1
		);
		$update 	= $this->transaksi_model->updateStatusSewa($id_sewa,$data);
		$data_supir = $this->transaksi_model->updateStatusSupir($this->input->post('id_supir'),$data2);
		
		if($update && $data_supir){
			$ret = array (
				'status' => TRUE,
				'data'   => $data
			);
		}else{
			$ret = array (
				'status' => FALSE,
				'data'   => $data
			);
		}
		echo json_encode($ret);

	}

	public function getJarak($latitude1, $longitude1, $latitude2, $longitude2, $unit)
	{
		echo json_encode(getDistanceBetween($latitude1, $longitude1, $latitude2, $longitude2,'Km'));
	}

}
