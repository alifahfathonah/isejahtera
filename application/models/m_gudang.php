<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_gudang extends CI_Model {

	public function get_gudang(){
		$this->db->select("gd.id_gudang, js.nama_jenis, brg.nama_barang, gd.stok, gd.created_at, 						gd.updated_at");
		$this->db->from("gudang gd");
		$this->db->join("barang brg", "gd.kode_barang = brg.kode_barang", "LEFT");
		$this->db->join("jenis js", "js.kode_jenis = brg.kode_jenis", "LEFT");
		$this->db->order_by('gd.id_gudang', 'DESC');

		$query = $this->db->get();
		return $query;
	}

	public function get_barang(){
		$query = $this->db->query("select * from barang order by kode_barang desc");
		return $query->result_array();
	}

	public function get_barangAll(){
		$query = $this->db->query("select kode_barang, nama_barang from barang order by kode_barang desc");
		return $query->result();
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
