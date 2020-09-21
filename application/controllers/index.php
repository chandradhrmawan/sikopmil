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
		$data['breadcump'] 		= "List Kendaraan";
		$data['title_page']		= "List Kendaraan";
		$data['list_kendaraan'] = $this->transaksi_model->getAllKendaraan();
		$this->load->view('frontend/grid_kendaraan',$data);	
	}

	public function form_pesan($id_kendaraan)
	{
		$data['breadcump'] 		= "Form Pesan";
		$data['title_page']		= "Form Pesan";
		$data['detail_kendaraan'] = $this->transaksi_model->getDetailByIdkendaraan($id_kendaraan);
		$data['location'] 		= $this->general_model->getStartPoint();
		$this->load->view('frontend/form_pesan',$data);	
	}

	public function riwayat_sewa()
	{	
		$data['breadcump'] 		= "Riwayat Sewa";
		$data['title_page']		= "Riwayat Sewa";
		$data['list_data'] 		= $this->transaksi_model->getRiwayatSewaByIduser($this->session->userdata('id_user'));
		$this->load->view('frontend/riwayat_sewa',$data);	

	}

	public function login()
	{
		if($this->session->has_userdata('id_user')){
			$this->index();
		}else{
			$this->load->view('frontend/login');
		}
	}

	public function doLogout()
	{
		session_destroy();
		redirect(base_url().'index', 'refresh');
	}

	public function doLogin()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));

		$isValid = $this->general_model->doLogin($username,$password);

		if(isset($isValid)){
			$this->session->set_userdata($isValid);
			$ret = array(
		        'status' 	=> TRUE,
		        'message'   => 'Sukses',
		        'data'  	=> $isValid,
			);
		}else{
			$ret = array(
		        'status' 	=> FALSE,
		        'message'   => 'Username / Password Salah'
			);
		}
		echo json_encode($ret);
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
