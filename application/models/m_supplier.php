<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_supplier extends CI_Model {

	public function get_supplier(){
		$query = $this->db->query("select * from supplier order by kode_supplier desc");
		return $query;
	}

	public function insert_data($table, $data){
		$temp = $this->db->insert($table, $data);
		return $temp;
	}

	public function update_data($table, $data, $where){
		$temp = $this->db->update($table, $data, $where);
		return $temp;
	}

	public function delete_data($table, $where){
		$temp = $this->db->delete($table, $where);
		return $temp;
	}
}
