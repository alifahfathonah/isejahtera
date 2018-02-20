<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class supplier extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('pdf');
		$this->load->model('m_supplier');
	}

	public function index(){
		$cek = $this->session->userdata('status');
		if ($cek == 'admin') {
			$data['supplier'] = $this->m_supplier->get_supplier();
			$this->load->view('backend/supplier/index.php', $data);
		}else{
			header("location:".base_url());
		}
	}

	public function do_add(){
		$kode_supplier 	= $_POST['kode_supplier'];
		$nama_supplier	= $_POST['nama_supplier'];
		$no_telp		= $_POST['no_telp'];
		$alamat			= $_POST['alamat'];
		$now			= date("Y-m-d");
		
		$data = array(
			"kode_supplier"	=> $kode_supplier,
			"nama_supplier"	=> $nama_supplier,
			"no_telp"		=> $no_telp,
			"alamat"		=> $alamat,
			"created_at" 	=> $now
		);

		$q = $this->m_supplier->insert_data('supplier', $data);
		if($q >= 1){
			redirect('supplier/index');
		}
	}

	public function do_edit(){
		$kode_supplier 	= $_POST['kode_supplier'];
		$nama_supplier	= $_POST['nama_supplier'];
		$no_telp		= $_POST['no_telp'];
		$alamat			= $_POST['alamat'];
		$now			= date("Y-m-d");
		
		$data = array(
			"nama_supplier"	=> $nama_supplier,
			"no_telp"		=> $no_telp,
			"alamat"		=> $alamat,
			"updated_at" 	=> $now
		);

		$where = array("kode_supplier" => $kode_supplier);

		$q = $this->m_supplier->update_data('supplier', $data, $where);
		if($q >= 1){
			redirect('supplier/index');
		}
	}

	public function do_delete(){
		$kode_supplier 	= $_POST['kode_supplier'];
		$where		 	= array("kode_supplier" => $kode_supplier);

		$q = $this->m_supplier->delete_data('supplier', $where);
		if($q >= 1){
			redirect('supplier/index');
		}
	}

	public function export_pdf(){
		$data['supplier'] = $this->m_supplier->get_supplier();
		$this->load->view('backend/supplier/export_pdf', $data);
	}

	public function export_excel(){
		$date = date("Y-m-d");
		$data = array('title' => 'Laporan-Supplier-'.$date, 'supplier' => $this->m_supplier->get_supplier());
		$this->load->view('backend/supplier/export_excel', $data);	
	}
}


// UPDATE gudang SET stok = stok + new.jumlah_masuk
// WHERE kode_barang = new.kode_barang