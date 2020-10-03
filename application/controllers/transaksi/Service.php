<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

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
		$data['breadcump'] 			= "Service";
		$data['title_page']			= "Service";
		$data['content_view']		= "transaksi/list_service";
		$data['data_service']  		= $this->transaksi_model->getDataService();
		$this->load->view('layout_admin/index',$data);	
	}

	public function formAdd()
	{
		$data['breadcump'] 			= "Service";
		$data['title_page']			= "Service";
		$data['content_view']		= "transaksi/form_service";
		$data['data_kendaraan'] 	= $this->master_model->getAll('mst_kendaraan');
		$this->load->view('layout_admin/index',$data);	
	}

	public function detail($id_hdr_service)
	{
		$data['breadcump'] 			= "View Data Service";
		$data['title_page']			= "View Data Service";
		$data['content_view']		= "transaksi/form_service_view";
		$data['data_hdr_service'] 	= $this->transaksi_model->getDataHdrService($id_hdr_service);
		$data['data_dtl_service'] 	= $this->transaksi_model->getDataDtlService($id_hdr_service);
		$data['data_kendaraan'] 	= $this->master_model->getAll('mst_kendaraan');
		$this->load->view('layout_admin/index',$data);	
	}

	public function printService($id_hdr_service)
	{	
		$data['breadcump'] 			= "Print Preview Service";
		$data['title_page']			= "Print Preview Service";
		$data['data_hdr_service'] 	= $this->transaksi_model->getDataHdrService($id_hdr_service);
		$data['data_dtl_service'] 	= $this->transaksi_model->getDataDtlService($id_hdr_service);
		$data['content_view']		= "transaksi/print_service";
		$this->load->view('layout_admin/index',$data);
	}

	public function doSaveService()
	{	

		$dataHdr = array('id_kendaraan' => $this->input->post('no_polisi'),
						  'tgl_service' => date('Y-m-d h:i:s'),
						  'note' 		=> $this->input->post('keperluan'),
						  'status' 		=> 1
		);

		$insertHdr = $this->transaksi_model->saveHdrService($dataHdr);

		if(!empty($insertHdr)){
			$arrDtl = $this->input->post('nama_service');
			$grand_total = 0;
			foreach ($arrDtl as $key => $value) {
				$dataDtl = array(
					'id_hdr_service' => $insertHdr,
					'nama_service' 	 => $value,
					'jumlah' 		 => $_POST['jumlah'][$key],
					'harga'			 => $_POST['harga'][$key],
					'sub_total' 	 => $_POST['sub_total'][$key]
				);
				$grand_total += $_POST['sub_total'][$key];
				$insertDtl = $this->transaksi_model->saveDtlService($dataDtl);
			}
			$updateTotal = $this->transaksi_model->updateTotalHdrService($insertHdr,$grand_total);

			$ret = array (
				'status' => TRUE,
				'data' 	 => $insertHdr,
			);
			echo  json_encode($ret);
		}else{
			$ret = array (
				'status' => FALSE,
				'data' 	 => $insertHdr,
			);
			echo  json_encode($ret);
		}
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
