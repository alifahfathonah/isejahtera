<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_laporan_masuk extends CI_Model {

	public function get_laporan_masuk(){
		$this->db->select("bm.trans_masuk, brg.nama_barang, bm.jumlah_masuk, bm.tanggal_masuk, bm.created_at, 						bm.updated_at");
		$this->db->from("barang_masuk bm");
		$this->db->join("barang brg", "bm.kode_barang = brg.kode_barang", "LEFT");
		$this->db->order_by('bm.trans_masuk', 'DESC');

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

	public function filter($dari, $sampai){
		//$dari 	= '2017-09-26';
		//$sampai	= '2017-10-02';

		$this->db->select("*");
		$this->db->from("barang_masuk bm");
		$this->db->where('tanggal_masuk >=', $dari);
		$this->db->where('tanggal_masuk <=', $sampai);
		$this->db->order_by('bm.trans_masuk', 'DESC');

		$query = $this->db->get();
		// echo "<pre>";
		// print_r($query);
		// echo "</pre>";
		// exit();
		return $query->result();
	}
}
