<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

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
		$data['breadcump'] 		= "Index";
		$data['title_page']		= "Index";
		$this->load->view('frontend/home',$data);	
	}

	public function list_kendaraan()
	{				
		$data['breadcump'] 		= "Index";
		$data['title_page']		= "Index";
		$data['list_kendaraan'] = $this->transaksi_model->getAllKendaraan();
		$this->load->view('frontend/grid_kendaraan',$data);	
	}

	public function form_pesan()
	{
		$data['breadcump'] 		= "Index";
		$data['title_page']		= "Index";
		$data['detail_kendaraan'] = $this->transaksi_model->getDetailByIdkendaraan(1);
		$data['location'] 		= $this->general_model->getStartPoint();
		$this->load->view('frontend/form_pesan',$data);	
	}

	public function savePesanan()
	{
		$post = $this->input->post('data');
		$data = array('id_user' => $this->session->userdata('id_user'),
			'id_kendaraan' 		=> $post['id_kendaraan'],
			'tgl_sewa' 			=> date('Y/m/d H:i:s'),
			'tgl_pinjam' 		=> formatDate($post['tgl_pesan']),
			'tgl_kembali' 		=> formatDate($post['tgl_kembali']),
			'tujuan_perjalanan' => $post['tujuan_perjalanan'],
			'lokasi_tujuan' 	=> $post['addr'],
			'lon' 				=> $post['lon'],
			'lat' 				=> $post['lat'],
			'jarak' 			=> $post['jarak'],
			'status_sewa' 		=> '1'
		);

		$insert = $this->transaksi_model->doSavePesanan($data);

		if($insert){
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

		echo  json_encode($ret);
	}
}
