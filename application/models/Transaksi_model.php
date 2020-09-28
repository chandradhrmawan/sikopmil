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
		$this->db->join("mst_supir d","d.id_supir = a.id_supir","left");
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
		$this->db->select("*");
		$this->db->from("tx_sewa a");
		$this->db->join("mst_users b","b.id_user = a.id_user");
		$this->db->join("mst_kendaraan c","c.id_kendaraan = a.id_kendaraan");
		$this->db->join("mst_supir d","d.id_supir = a.id_supir","left");
		$this->db->where("a.id_sewa",$id_sewa);
		return $this->db->get()->row();
	}
}
