<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master_model extends CI_Model {

	public function getAll($table)
	{	
		$this->db->select("*");
		$this->db->from($table);
		return $this->db->get()->result();
	}
	
}
