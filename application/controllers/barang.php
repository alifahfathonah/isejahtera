<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class barang extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('pdf');
		$this->load->model('m_barang');
	}

	public function index(){
		$cek = $this->session->userdata('status');
		if ($cek == 'admin') {
			$data['barang'] = $this->m_barang->get_barang();
			$data['jenis'] = $this->m_barang->get_jenis();
			$data['unit'] = $this->m_barang->get_unit()->result();
			
			$this->load->view('backend/barang/index.php', $data);
		}else{
			header("location:".base_url());
		}
	}

	public function do_add(){
		$kode_barang 	= $_POST['kode_barang'];
		$kode_jenis 	= $_POST['kode_jenis'];	
		$nama_barang	= $_POST['nama_barang'];
		$unit			= $_POST['unit'];
		$now			= date("Y-m-d");
		
		$data = array(
			"kode_barang"	=> $kode_barang,
			"kode_jenis" 	=> $kode_jenis,
			"nama_barang" 	=> $nama_barang,
			"unit"			=> $unit,
			"created_at" 	=> $now
		);

		$q = $this->m_barang->insert_data('barang', $data);
		if($q >= 1){
			redirect('barang/index');
		}
	}

	public function do_edit(){
		$kode_barang 	= $_POST['kode_barang'];
		$kode_jenis 	= $_POST['kode_jenis'];
		$nama_barang	= $_POST['nama_barang'];
		$unit			= $_POST['unit'];
		$now			= date("Y-m-d");

		$data = array(
			"kode_jenis" 	=> $kode_jenis,
			"nama_barang"	=> $nama_barang,
			"unit"			=> $unit,
			"updated_at" 	=> $now
		);

		$where = array("kode_barang" => $kode_barang);

		$q = $this->m_barang->update_data('barang', $data, $where);
		if($q >= 1){
			redirect('barang/index');
		}
	}

	public function do_delete(){
		$kode_barang = $_POST['kode_barang'];
		$where		 = array("kode_barang" => $kode_barang);

		$q = $this->m_barang->delete_data('barang', $where);
		if($q >= 1){
			redirect('barang/index');
		}
	}

	public function export_pdf(){
		$data['barang'] = $this->m_barang->get_barang();
		$this->load->view('backend/barang/export_pdf', $data);
	}

	public function export_excel(){
		$date = date("Y-m-d");
		$data = array('title' => 'Laporan-Barang-'.$date, 'barang' => $this->m_barang->get_barang());
		$this->load->view('backend/barang/export_excel', $data);	
	}
}


// UPDATE gudang SET stok = stok + new.jumlah_masuk
// WHERE kode_barang = new.kode_barang