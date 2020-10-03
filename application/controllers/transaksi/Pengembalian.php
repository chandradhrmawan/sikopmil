<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembalian extends CI_Controller {

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
		$data['breadcump'] 		   = "Pengembalian";
		$data['title_page']		   = "Pengembalian";
		$data['content_view']	   = "transaksi/list_pengembalian";
		$data['data_pengembalian'] = $this->transaksi_model->getDataPengembalian($this->session->userdata('id_user'));
		$data['data_sewa'] 		   = $this->transaksi_model->getDataSewaByIdSupir($this->session->userdata('id_user'));
		$data['data_supir']  	   = $this->master_model->getAllSupir();
		$this->load->view('layout_admin/index',$data);	
	}

	public function doSavePengembalian()
	{	

		$data = array('id_sewa' 	=> $this->input->post('id_sewa'),
					  'total_biaya' => $this->input->post('total_biaya'),
					  'lampiran' 	=> $this->input->post('lampiran'),
					  'km_selesai'  => $this->input->post('km_selesai'),
					  'id_supir' 	=> $this->input->post('id_supir'),
					  'tgl_pengembalian' => date('Y-m-d h:i:s'),
					  'lampiran' 	=> $this->_uploadImage(date('dmYhis'))
		);

		$insert = $this->transaksi_model->savePengembalian($data);
		$update = $this->transaksi_model->updatePengembalian($data);

		if($insert && $update){
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


	public function _uploadImage($name)
    {
    	if (!empty($_FILES["bukti"]["name"])) {

	        $config['upload_path']          = './uploads/pengembalian';
	        $config['allowed_types']        = 'gif|jpg|png';
	        $config['file_name']            = $name;
		    $config['overwrite']			= true;
		    $config['max_size']             = 10024; // 10MB

	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('bukti'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            return null;
	        }
	        else
	        {
	            $data = array('upload_data' => $this->upload->data());
	            return $data['upload_data']['file_name'];
	        }
	    }else{
	    	return null;
	    }
    }

    public function file($id_sewa)
	{
		$data['data_sewa']			= $this->transaksi_model->getDetailSewaByIdSewa($id_sewa);
		$data['data_pengembalian'] 	= $this->transaksi_model->getDataPengembalianByIdSewa($id_sewa);
		$this->load->view('transaksi/surat_perjalaan',$data);	
	}

}
