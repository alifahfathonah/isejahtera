<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_barang_keluar extends CI_Model {

	public function get_barang_keluar(){
		$this->db->select("bk.trans_keluar, brg.nama_barang, bk.jumlah_keluar, bk.jumlah_reject, bk.tanggal_keluar, 							bk.created_at, bk.updated_at");
		$this->db->from("barang_keluar bk");
		$this->db->join("barang brg", "bk.kode_barang = brg.kode_barang", "LEFT");
		$this->db->order_by('bk.trans_keluar', 'DESC');

		$query = $this->db->get();
		return $query;
	}

	public function get_barang(){
		$query = $this->db->query("select * from barang order by kode_barang desc");
		return $query->result_array();
	}

	public function get_supplier(){
		$query = $this->db->query("select * from supplier order by kode_supplier desc");
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
