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
		$data['breadcump'] 			= "Laporan Pemakaian";
		$data['title_page']			= "Laporan Pemakaian";
		$data['content_view']		= "laporan/sewa";
		$this->load->view('layout_admin/index',$data);	
	}

	public function listData()
	{
		$data =	array(
			'tgl_awal'  => formatDate($this->input->get('tgl_awal')),
			'tgl_akhir' => formatDate($this->input->get('tgl_akhir'))
		);
		$result = $this->transaksi_model->getReportSewa($data);
		$content = "";
		foreach ($result as $key => $value) {
			$no = $key+1;
			$tgl_sewa = view_date_hi($value->tgl_sewa);
			$tgl_pinjam = view_date_hi($value->tgl_pinjam);
			$tgl_kembali = view_date_hi($value->tgl_kembali);

			$content .= "
			<tr>
				<td>$no</td>
				<td>$value->nama</td>
				<td>$value->no_plat</td>
				<td>$value->judul</td>
				<td>$tgl_sewa</td>
				<td>$tgl_pinjam</td>
				<td>$tgl_kembali</td>
				<td>$value->tujuan_perjalanan</td>
				<td>$value->lokasi_tujuan</td>
				<td>$value->jarak</td>
				<td>$value->km_akhir</td>
			</tr>";
		}

		$date_now = date('d-m-Y h:i:s');
		$html = "
		<h3><center>Laporan Data Pemakaian Sikopmil</center></h3>
		<h4><center>$date_now</center></h4>
		<div class='table-responsive'>
		<table class='table table-striped table-hover table-bordered table-sm'>
              <thead>
              <tr>
                <th>No</th>
                <th>Nama Penyewa</th>
                <th>No Plat</th>
                <th>Nama Kendaraan</th>
                <th>Tanggal Sewa</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Keperjuan Perjalanan</th>
                <th>Lokasi Tujuan</th>
                <th>Jarak</th>
                <th>Km Akhir</th>
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
            </div>
        </div>";
        echo json_encode($html);
	}

	public function exportExcel()
	{	
		$data =	array(
			'tgl_awal'  => formatDate($this->input->get('tgl_awal')),
			'tgl_akhir' => formatDate($this->input->get('tgl_akhir'))
		);
		$data['listData'] = $this->transaksi_model->getReportSewa($data);
		$this->load->view('laporan/excel/sewa',$data);
	}
}
