<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class gudang extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('pdf');
		$this->load->model('m_gudang');
	}

	public function index(){
		$cek = $this->session->userdata('status');
		if ($cek == 'admin') {
			$data['gudang'] = $this->m_gudang->get_gudang();
			$data['barang'] = $this->m_gudang->get_barang();

			$nama = $this->m_gudang->get_barangAll();
            foreach($nama as $row){
                $this->data['nama_barang'][$row->kode_barang] = $row->nama_barang;
            }

			$this->load->view('backend/gudang/index.php', $data, $this->data);
		}else{
			header("location:".base_url());
		}
	}

	public function do_add(){
		//$id_gudang 		= $_POST['id_gudang'];
		$kode_barang 	= $_POST['kode_barang'];	
		$stok			= $_POST['stok'];
		$now			= date("Y-m-d");
		
		$data = array(
			"kode_barang"	=> $kode_barang,
			"stok"			=> $stok,
			"created_at" 	=> $now
		);

		$q = $this->m_gudang->insert_data('gudang', $data);
		if($q >= 1){
			redirect('gudang/index');
		}
	}

	public function do_edit(){
		$id_gudang 		= $_POST['id_gudang'];
		$kode_barang	= $_POST['kode_barang'];
		$stok			= $_POST['stok'];
		$now			= date("Y-m-d");

		$data = array(
			"kode_barang"	=> $kode_barang,
			"stok"			=> $stok,
			"updated_at" 	=> $now
		);

		$where = array("id_gudang" => $id_gudang);

		$q = $this->m_gudang->update_data('gudang', $data, $where);
		if($q >= 1){
			redirect('gudang/index');
		}
	}

	public function do_delete(){
		$id_gudang 	 = $_POST['id_gudang'];
		$where		 = array("id_gudang" => $id_gudang);

		$q = $this->m_gudang->delete_data('gudang', $where);
		if($q >= 1){
			redirect('gudang/index');
		}
	}

	public function export_pdf(){
		$data['gudang'] = $this->m_gudang->get_gudang();
		$this->load->view('backend/gudang/export_pdf', $data);
	}

	public function export_excel(){
		$date = date("Y-m-d");
		$data = array('title' => 'Laporan-Gudang-'.$date, 'gudang' => $this->m_gudang->get_gudang());
		$this->load->view('backend/gudang/export_excel', $data);	
	}
}