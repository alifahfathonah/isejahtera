<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class barang_masuk extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('pdf');
		$this->load->model('m_barang_masuk');
	}

	public function index(){
		$cek = $this->session->userdata('status');
		if ($cek == 'admin') {
			$data['barang_masuk'] = $this->m_barang_masuk->get_barang_masuk();
			$data['barang'] = $this->m_barang_masuk->get_barang();
			
			$this->load->view('backend/barang_masuk/index.php', $data);
		}else{
			header("location:".base_url());
		}
	}

	public function detail(){
		$cek = $this->session->userdata('status');
		if ($cek == 'admin') {
			$data['barang_masuk'] 	= $this->m_barang_masuk->get_barang_masuk();
			$data['barang'] 		= $this->m_barang_masuk->get_barang();
			$data['supplier'] 		= $this->m_barang_masuk->get_supplier();
			
			$this->load->view('backend/barang_masuk/detail.php', $data);
		}else{
			header("location:".base_url());
		}
	}

	public function do_add(){
		$trans_masuk	= $_POST['trans_masuk'];
		$kode_barang 	= $_POST['kode_barang'];	
		$jumlah_masuk	= $_POST['jumlah_masuk'];
		$tanggal_masuk	= $_POST['tanggal_masuk'];
		$now			= date("Y-m-d");

		$data = array(
			"trans_masuk"	=> $trans_masuk,
			"kode_barang"	=> $kode_barang,
			"jumlah_masuk"	=> $jumlah_masuk,
			"tanggal_masuk"	=> $tanggal_masuk,
			"created_at" 	=> $now
		);

		$q = $this->m_barang_masuk->insert_data('barang_masuk', $data);
		if($q >= 1){
			redirect('barang_masuk/index');
		}
	}

	public function do_edit(){
		$trans_masuk	= $_POST['trans_masuk'];
		$kode_barang	= $_POST['kode_barang'];
		$tanggal_masuk	= $_POST['tanggal_masuk'];
		$jumlah_masuk	= $_POST['jumlah_masuk'];
		$now			= date("Y-m-d");

		$data = array(
			"kode_barang"	=> $kode_barang,
			"tanggal_masuk"	=> $tanggal_masuk,
			"jumlah_masuk"	=> $jumlah_masuk,
			"updated_at" 	=> $now
		);

		$where = array("trans_masuk" => $trans_masuk);

		$q = $this->m_barang_masuk->update_data('barang_masuk', $data, $where);
		if($q >= 1){
			redirect('barang_masuk/index');
		}
	}

	public function do_delete(){
		$trans_masuk = $_POST['trans_masuk'];
		$where		 = array("trans_masuk" => $trans_masuk);

		$q = $this->m_barang_masuk->delete_data('barang_masuk', $where);
		if($q >= 1){
			redirect('barang_masuk/index');
		}
	}

	public function export_pdf(){
		$data['barang_masuk'] = $this->m_barang_masuk->get_barang_masuk();
		$this->load->view('backend/barang_masuk/export_pdf', $data);
	}

	public function export_excel(){
		$date = date("Y-m-d");
		$data = array('title' => 'Laporan-Barang-Masuk-'.$date, 'barang_masuk' => $this->m_barang_masuk->get_barang_masuk());
		$this->load->view('backend/barang_masuk/export_excel', $data);	
	}
}