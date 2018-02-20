<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_masuk extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('pdf');
		$this->load->model('m_laporan_masuk');
	}

	public function index(){
		$cek = $this->session->userdata('status');
		if ($cek == 'admin') {
			$data['laporan_masuk'] 	= $this->m_laporan_masuk->get_laporan_masuk();
			$data['barang'] 		= $this->m_laporan_masuk->get_barang();

			$this->load->view('backend/laporan_masuk/index', $data);
		}else{
			header("location:".base_url());
		}
	}

	public function do_add(){
		$trans_keluar	= $_POST['trans_keluar'];
		$kode_barang 	= $_POST['kode_barang'];	
		$jumlah_keluar	= $_POST['jumlah_keluar'];
		$tanggal_keluar	= $_POST['tanggal_keluar'];
		$now			= date("Y-m-d");

		$data = array(
			"trans_keluar"	 => $trans_keluar,
			"kode_barang"	 => $kode_barang,
			"jumlah_keluar"	 => $jumlah_keluar,
			"tanggal_keluar" => $tanggal_keluar,
			"created_at" 	 => $now
		);

		$q = $this->m_barang_keluar->insert_data('barang_keluar', $data);
		if($q >= 1){
			redirect('barang_keluar/index');
		}
	}

	public function do_edit(){
		$trans_keluar	= $_POST['trans_keluar'];
		$kode_barang 	= $_POST['kode_barang'];	
		$jumlah_keluar	= $_POST['jumlah_keluar'];
		$tanggal_keluar	= $_POST['tanggal_keluar'];
		$now			= date("Y-m-d");

		$data = array(
			"kode_barang"	 => $kode_barang,
			"jumlah_keluar"	 => $jumlah_keluar,
			"tanggal_keluar" => $tanggal_keluar,
			"updated_at" 	 => $now
		);

		$where = array("trans_keluar" => $trans_keluar);

		$q = $this->m_barang_keluar->update_data('barang_keluar', $data, $where);
		if($q >= 1){
			redirect('barang_keluar/index');
		}
	}

	public function do_delete(){
		$trans_keluar = $_POST['trans_keluar'];
		$where		 = array("trans_keluar" => $trans_keluar);

		$q = $this->m_barang_keluar->delete_data('barang_keluar', $where);
		if($q >= 1){
			redirect('barang_keluar/index');
		}
	}

	public function export_pdf($dari,$sampai){
		$data['laporan_masuk'] = $this->m_laporan_masuk->filter($dari,$sampai);
		$this->load->view('backend/laporan_masuk/export_pdf', $data);
	}

	public function export_excel(){
		$date = date("Y-m-d");
		$data = array('title' => 'Laporan-Barang-Keluar-'.$date, 'barang_keluar' => $this->m_barang_keluar->get_barang_keluar());
		$this->load->view('backend/barang_keluar/export_excel', $data);	
	}
}