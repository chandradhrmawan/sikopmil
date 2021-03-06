<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

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
		$data['breadcump'] 			= "Laporan Jabatan";
		$data['title_page']			= "Laporan Jabatan";
		$data['content_view']		= "laporan/jabatan";
		$this->load->view('layout_admin/index',$data);	
	}

	public function listData()
	{
		$data =	array(
			'nm_jabatan'  	=> $this->input->get('nm_jabatan')
		);
		$result = $this->transaksi_model->getReportJabatan($data);
		$content = "";
		foreach ($result as $key => $value) {
			$no = $key+1;
			$content .= "
			<tr>
				<td>$no</td>
				<td>$value->nm_jabatan</td>
			</tr>";
		}

		$date_now = date('d-m-Y h:i:s');
		$html = "
		<h3><center>Laporan Data Jabatan Sikopmil</center></h3>
		<h4><center>$date_now</center></h4>
		<div class='table-responsive'>
		<table class='table table-striped table-hover table-bordered table-sm'>
              <thead>
              <tr>
                <th>No</th>
                <th>Nama Jabatan</th>
              </tr>
              </thead>
              <tbody>
              ".$content."
              </tbody>
            </table> 
            <div class='form-group'>
              <button type='button' id='btn-print' class='btn btn-info btn-flat' style='margin-right: 5px;' onclick='doPrint()'>
          <i class='fa fa-print'></i> Print Data
        </button>
        <button type='button' id='btn-excel' class='btn btn-success btn-flat' style='margin-right: 5px;' onclick='exportExcel()'>
              <i class='fa fa-file-excel-o'></i> Export Excel</button>
            </div>
        </div>";
        echo json_encode($html);
	}

	public function exportExcel()
	{	
		$data =	array(
			'nm_jabatan'  	=> $this->input->get('nm_jabatan')
		);
		$data['listData'] = $this->transaksi_model->getReportJabatan($data);
		$this->load->view('laporan/excel/jabatan',$data);
	}
}
