<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaksi_model extends CI_Model {

	public function getAllKendaraan($limit,$start,$where)
	{	
		$this->db->select("*");
		$this->db->from("mst_kendaraan a");
		$this->db->join("mst_jenis b","a.id_jenis = b.id_jenis");
		$this->db->join("mst_merk c","a.id_merk = c.id_merk");
		$this->db->join("mst_tipe d","a.id_tipe = d.id_tipe");
		$this->db->limit($start,$limit);

		if(!empty($where['keyword'])){
			$this->db->where('a.judul', $where['keyword']);	
		}
		if(!empty($where['id_jenis'])){
			$this->db->where('a.id_jenis', $where['id_jenis']);	
		}
		if(!empty($where['id_merk'])){
			$this->db->where('a.id_merk', $where['id_merk']);	
		}

		$this->db->order_by("a.judul","asc");
		return $this->db->get()->result();
	}

	public function countAllKendaraan()
	{	
		$this->db->select("*");
		$this->db->from("mst_kendaraan a");
		$this->db->join("mst_jenis b","a.id_jenis = b.id_jenis");
		$this->db->join("mst_merk c","a.id_merk = c.id_merk");
		$this->db->join("mst_tipe d","a.id_tipe = d.id_tipe");
		$this->db->order_by("a.judul","asc");
		return $this->db->get()->num_rows();
	}


	public function getDetailByIdkendaraan($id_kendaraan)
	{
		$this->db->select("*");
		$this->db->from("mst_kendaraan a");
		$this->db->join("mst_jenis b","a.id_jenis = b.id_jenis");
		$this->db->join("mst_merk c","a.id_merk = c.id_merk");
		$this->db->join("mst_tipe d","a.id_tipe = d.id_tipe");
		$this->db->where("a.id_kendaraan",$id_kendaraan);
		return $this->db->get()->row();
	}
	
	public function doSavePesanan($data)
	{
		$this->db->insert('tx_sewa', $data);
		return true;
	}

	public function savePengembalian($data)
	{
		$this->db->insert('tx_pengembalian', $data);
		return true;
	}

	public function saveHdrService($data)
	{
		$this->db->insert('tx_hdr_service', $data);
		return $this->db->insert_id();
	}

	public function saveDtlService($data)
	{
		$this->db->insert('tx_dtl_service', $data);
		return $this->db->insert_id();
	}

	public function updateTotalHdrService($id,$total)
	{
		$dtService = array(
	        'total' => $total
		);
		$this->db->where('id_hdr_service', $id);
		$this->db->update('tx_hdr_service', $dtService);
		return true;
	}

	public function getRiwayatSewaByIduser($id_user)
	{
		$this->db->select("*");
		$this->db->from("tx_sewa a");
		$this->db->join("mst_users b","b.id_user = a.id_user");
		$this->db->join("mst_kendaraan c","c.id_kendaraan = a.id_kendaraan");
		$this->db->join("mst_supir d","d.id_supir = a.id_supir","left");
		$this->db->where("a.id_user",$id_user);
		return $this->db->get()->result();
	}

	public function getAllRiwayatSewa()
	{
		$this->db->select("*");
		$this->db->from("tx_sewa a");
		$this->db->join("mst_users b","b.id_user = a.id_user");
		$this->db->join("mst_kendaraan c","c.id_kendaraan = a.id_kendaraan");
		// $this->db->join("mst_supir d","d.id_supir = a.id_supir","left");
		$this->db->order_by("a.id_sewa","desc");
		return $this->db->get()->result();
	}

	public function updateStatusSewa($id_sewa,$data)
	{
		$this->db->where('id_sewa', $id_sewa);
		$this->db->update('tx_sewa', $data);
		return true;
	}

	public function updateStatusSupir($id_supir,$data)
	{
		$this->db->where('id_supir', $id_supir);
		$this->db->update('mst_supir', $data);
		return true;
	}

	public function getDetailSewaByIdSewa($id_sewa)
	{
		$this->db->select("*,d.nama as nama_supir");
		$this->db->from("tx_sewa a");
		$this->db->join("mst_users b","b.id_user = a.id_user");
		$this->db->join("mst_users d","d.id_user = a.id_supir");
		$this->db->join("mst_kendaraan c","c.id_kendaraan = a.id_kendaraan");
		$this->db->where("a.id_sewa",$id_sewa);
		return $this->db->get()->row();
	}

	public function getAllRiwayatSewaByIdSupir($id_supir)
	{
		$this->db->select("*");
		$this->db->from("tx_sewa a");
		$this->db->join("mst_users b","b.id_user = a.id_user");
		$this->db->join("mst_kendaraan c","c.id_kendaraan = a.id_kendaraan");
		$this->db->where("a.id_supir",$id_supir);
		$this->db->order_by("a.id_sewa","desc");
		return $this->db->get()->result();
	}

	public function getDataSewaByIdSupir($id_supir)
	{
		$this->db->select("a.id_sewa,c.no_plat");
		$this->db->from("tx_sewa a");
		$this->db->join("mst_users b","b.id_user = a.id_user");
		$this->db->join("mst_kendaraan c","c.id_kendaraan = a.id_kendaraan");
		$this->db->where("a.id_supir",$id_supir);
		$this->db->order_by("a.id_sewa","desc");
		return $this->db->get()->result();
	}

	public function getDataPengembalian($id_supir)
	{
		$this->db->select("*");
		$this->db->from("tx_pengembalian a");
		$this->db->join("mst_users b","b.id_user = a.id_supir");
		$this->db->join("tx_sewa d","d.id_sewa = a.id_sewa");
		$this->db->join("mst_kendaraan c","c.id_kendaraan = d.id_kendaraan");
		$this->db->where("a.id_supir",$id_supir);
		$this->db->order_by("a.id_pengembalian","desc");
		return $this->db->get()->result();
	}

	public function getDataPengembalianByIdSewa($id_sewa)
	{
		$this->db->select("*");
		$this->db->from("tx_pengembalian a");
		$this->db->join("mst_users b","b.id_user = a.id_supir");
		$this->db->join("tx_sewa d","d.id_sewa = a.id_sewa");
		$this->db->join("mst_kendaraan c","c.id_kendaraan = d.id_kendaraan");
		$this->db->where("a.id_sewa",$id_sewa);
		$this->db->order_by("a.id_pengembalian","desc");
		return $this->db->get()->row();
	}

	public function updatePengembalian($data)
	{
		
		$dataSewa = $this->getDetailSewaByIdSewa($data['id_sewa']);
		$km_old = $dataSewa->km_akhir;

		$dtKendaraan = array(
	        'km_akhir' => $km_old + $data['km_selesai']
		);
		$this->db->where('id_kendaraan', $dataSewa->id_kendaraan);
		$this->db->update('mst_kendaraan', $dtKendaraan);

		$dtSewa = array(
	        'status_sewa' => 4
		);
		$this->db->where('id_sewa', $data['id_sewa']);
		$this->db->update('tx_sewa', $dtSewa);

		return true;
	}

	public function getDataService()
	{
		$this->db->select("*");
		$this->db->from("tx_hdr_service a");
		$this->db->join("mst_kendaraan b","a.id_kendaraan = b.id_kendaraan","inner");
		return $this->db->get()->result();
	}

	public function getReportService($where)
	{
		$this->db->select("*");
		$this->db->from("tx_hdr_service a");
		$this->db->join("mst_kendaraan b","a.id_kendaraan = b.id_kendaraan","inner");
		if(!empty($where['tgl_awal']) && !empty($where['tgl_akhir'])){
			$this->db->where('a.tgl_service >= ', $where['tgl_awal']);
			$this->db->where('a.tgl_service <= ', $where['tgl_akhir']);	
		}
		return $this->db->get()->result();
	}

	public function getDataHdrService($id_hdr_service)
	{
		$this->db->select("*");
		$this->db->from("tx_hdr_service a");
		$this->db->join("mst_kendaraan b","a.id_kendaraan = b.id_kendaraan","inner");
		$this->db->where("a.id_hdr_service",$id_hdr_service);
		return $this->db->get()->row();
	}

	public function getDataDtlService($id_hdr_service)
	{
		$this->db->select("*");
		$this->db->from("tx_dtl_service a");
		$this->db->where("a.id_hdr_service",$id_hdr_service);
		return $this->db->get()->result();
	}

	public function getReportKendaraan($where)
	{
		$this->db->select("*");
		$this->db->from("mst_kendaraan a");
		$this->db->join("mst_jenis b","a.id_jenis = b.id_jenis");
		$this->db->join("mst_merk c","a.id_merk = c.id_merk");
		$this->db->join("mst_tipe d","a.id_tipe = d.id_tipe");
		
		if(!empty($where['id_jenis'])){
			$this->db->where('a.id_jenis', $where['id_jenis']);	
		}
		if(!empty($where['id_merk'])){
			$this->db->where('a.id_merk', $where['id_merk']);	
		}
		if(!empty($where['model'])){
			$this->db->where('a.model', $where['model']);	
		}

		$this->db->order_by("a.judul","asc");
		return $this->db->get()->result();
	}

	public function getReportSewa($where)
	{
		$this->db->select("*");
		$this->db->from("tx_sewa a");
		$this->db->join("mst_kendaraan b","a.id_kendaraan = b.id_kendaraan");
		$this->db->join("mst_users c","c.id_user = a.id_user");
		
		if(!empty($where['tgl_awal']) && !empty($where['tgl_akhir'])){
			$this->db->where('a.tgl_sewa >= ', $where['tgl_awal']);
			$this->db->where('a.tgl_sewa <= ', $where['tgl_akhir']);	
		}
		
		$this->db->order_by("a.id_sewa","desc");
		return $this->db->get()->result();
	}

	public function getReportUsers($where)
	{
		$this->db->select("*");
		$this->db->from("mst_users a");
		$this->db->join("mst_jabatan b","a.id_jabatan = b.id_jabatan");
		$this->db->join("mst_role c","c.id_role = a.id_role");
		
		if(!empty($where['id_jabatan'])){
			$this->db->where('a.id_jabatan', $where['id_jabatan']);	
		}
		if(!empty($where['id_role'])){
			$this->db->where('a.id_role', $where['id_role']);	
		}
		if(!empty($where['status'])){
			$this->db->where('a.status', $where['status']);	
		}
		$this->db->order_by("a.id_user","desc");
		return $this->db->get()->result();
	}

	public function getReportSupir($where)
	{
		$this->db->select("*");
		$this->db->from("mst_users a");
		$this->db->join("mst_jabatan b","a.id_jabatan = b.id_jabatan");
		$this->db->join("mst_role c","c.id_role = a.id_role");
		
		if(!empty($where['nip'])){
			$this->db->where('a.nip', $where['nip']);	
		}

		$this->db->where('a.id_role',4);	
		
		$this->db->order_by("a.id_user","desc");
		return $this->db->get()->result();
	}

	public function getBarChartData($year)
	{
		$sql = "SELECT 
				(SELECT COUNT(id_sewa) from tx_sewa where MONTH(tgl_sewa) = 1 AND YEAR(tgl_sewa) = 2020) as JANUARI,
				(SELECT COUNT(id_sewa) from tx_sewa where MONTH(tgl_sewa) = 2 AND YEAR(tgl_sewa) = 2020) as FEBRUARI,
				(SELECT COUNT(id_sewa) from tx_sewa where MONTH(tgl_sewa) = 3 AND YEAR(tgl_sewa) = 2020) as MARET,
				(SELECT COUNT(id_sewa) from tx_sewa where MONTH(tgl_sewa) = 4 AND YEAR(tgl_sewa) = 2020) as APRIL,
				(SELECT COUNT(id_sewa) from tx_sewa where MONTH(tgl_sewa) = 5 AND YEAR(tgl_sewa) = 2020) as MEI,
				(SELECT COUNT(id_sewa) from tx_sewa where MONTH(tgl_sewa) = 6 AND YEAR(tgl_sewa) = 2020) as JUNI,
				(SELECT COUNT(id_sewa) from tx_sewa where MONTH(tgl_sewa) = 7 AND YEAR(tgl_sewa) = 2020) as JULI,
				(SELECT COUNT(id_sewa) from tx_sewa where MONTH(tgl_sewa) = 8 AND YEAR(tgl_sewa) = 2020) as AGUSTUS,
				(SELECT COUNT(id_sewa) from tx_sewa where MONTH(tgl_sewa) = 9 AND YEAR(tgl_sewa) = 2020) as SEPTEMBER,
				(SELECT COUNT(id_sewa) from tx_sewa where MONTH(tgl_sewa) = 10 AND YEAR(tgl_sewa) = 2020) as OKTOBER,
				(SELECT COUNT(id_sewa) from tx_sewa where MONTH(tgl_sewa) = 11 AND YEAR(tgl_sewa) = 2020) as NOVEMBER,
				(SELECT COUNT(id_sewa) from tx_sewa where MONTH(tgl_sewa) = 12 AND YEAR(tgl_sewa) = 2020) as DESEMBER
			FROM
				DUAL";
		return $this->db->query($sql)->row();
	}

	public function getChartKendaraan()
	{
		$sql = "SELECT
					count( model ) jml,
					model AS tahun,
					( round( count( model ) / ( SELECT count( * ) FROM mst_kendaraan ) * 100 ) ) AS persen 
				FROM
					mst_kendaraan 
				GROUP BY
					model";
		return $this->db->query($sql)->result();
	}	

	public function getChartTipe()
	{
		$sql = "SELECT
				count( a.id_tipe ) jml,
				b.nm_tipe,
				( round( count( a.id_tipe ) / ( SELECT count( * ) FROM mst_kendaraan ) * 100 ) ) AS persen 
			FROM
				mst_kendaraan a
				left join mst_tipe b on a.id_tipe = b.id_tipe
			GROUP BY
				a.id_tipe";
		return $this->db->query($sql)->result();
	}
}
