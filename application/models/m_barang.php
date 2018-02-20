<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_barang extends CI_Model {

	public function get_barang(){
		$this->db->select("brg.kode_barang, js.kode_jenis, js.nama_jenis, brg.nama_barang, brg.unit,					brg.created_at, brg.updated_at");
		$this->db->from("barang brg");
		$this->db->join("jenis js", "js.kode_jenis = brg.kode_jenis", "LEFT");
		$this->db->order_by('brg.kode_barang', 'DESC');

		$query = $this->db->get();
		return $query;
	}

	public function get_jenis(){
		$query = $this->db->query("select * from jenis order by kode_jenis desc");
		return $query;
	}

	public function get_unit(){
		$query = $this->db->query("select unit from barang");
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
