<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaksi_model extends CI_Model {

	public function getAllKendaraan()
	{	
		$this->db->select("*");
		$this->db->from("mst_kendaraan a");
		$this->db->join("mst_jenis b","a.id_jenis = b.id_jenis");
		$this->db->join("mst_merk c","a.id_merk = c.id_merk");
		$this->db->join("mst_tipe d","a.id_tipe = d.id_tipe");
		return $this->db->get()->result();
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
}
