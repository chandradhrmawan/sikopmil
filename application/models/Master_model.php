<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master_model extends CI_Model {

	public function getAll($table)
	{	
		$this->db->select("*");
		$this->db->from($table);
		return $this->db->get()->result();
	}

	public function jmlData($table)
	{
		$this->db->select("*");
		$this->db->from($table);
		return $this->db->get()->num_rows();
	}

	public function TotalService()
	{
		$this->db->select("sum(total) as total");
		$this->db->from('tx_hdr_service');
		return $this->db->get()->row();
	}

	public function getAllSupir()
	{
		$this->db->select("*");
		$this->db->from("mst_users");
		$this->db->where("id_role",4);
		return $this->db->get()->result();
	}

	public function getModelKendaraan()
	{
		$sql = "SELECT DISTINCT(model) as model from mst_kendaraan";
		return $this->db->query($sql)->result();
	}

	public function getTahunTransaksi()
	{
		$sql = "SELECT DISTINCT(YEAR(tgl_sewa)) as tahun from tx_sewa";
		return $this->db->query($sql)->result();
	}
	
}
