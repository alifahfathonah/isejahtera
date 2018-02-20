<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_admin extends CI_Model {

	public function count_masuk(){
		$now = date("Y-m-d");

		$this->db->select("count(*) as count_masuk");
		$this->db->from("barang_masuk brm");
		$this->db->where('brm.tanggal_masuk', $now);

		$query = $this->db->get();

		if ($query->num_rows() > 0){	
			foreach ($query->result_array() as $row){
					return $row['count_masuk'];
			}
        }else{
            return FALSE;
        }
	}

	public function count_keluar(){
		$now = date("Y-m-d");

		$this->db->select("count(*) as count_keluar");
		$this->db->from("barang_keluar brk");
		$this->db->where('brk.tanggal_keluar', $now);

		$query = $this->db->get();

		if ($query->num_rows() > 0){	
			foreach ($query->result_array() as $row){
					return $row['count_keluar'];
			}
        }else{
            return FALSE;
        }
	}
}
