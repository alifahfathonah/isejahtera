<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jenis extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('pdf');
		$this->load->model('m_jenis');
	}

	public function index(){
		$cek = $this->session->userdata('status');
		if ($cek == 'admin') {
			$this->load->model('m_jenis');
			$data = $this->m_jenis->get_jenis();
			$this->load->view('backend/jenis/index.php', array('data' => $data));
		}else{
			header("location:".base_url());
		}
	}

	public function do_add(){
		$kode_jenis = $_POST['kode_jenis'];
		$nama_jenis = $_POST['nama_jenis'];	
		$now		= date("Y-m-d");
		
		$data = array(
			"kode_jenis" => $kode_jenis,
			"nama_jenis" => $nama_jenis,
			"created_at" => $now
		);

		$this->load->model('m_jenis');
		$q = $this->m_jenis->insert_data('jenis', $data);
		if($q >= 1){
			redirect('jenis/index');
		}
	}

	public function do_edit(){
		$kode_jenis = $_POST['kode_jenis'];
		$nama_jenis = $_POST['nama_jenis'];
		$now		= date("Y-m-d");

		$data = array(
			"nama_jenis" => $nama_jenis,
			"updated_at" => $now
		);

		$where = array("kode_jenis" => $kode_jenis);

		$this->load->model('m_jenis');
		$q = $this->m_jenis->update_data('jenis', $data, $where);
		if($q >= 1){
			redirect('jenis/index');
		}
	}

	public function do_delete(){
		$kode_jenis = $_POST['kode_jenis'];

		$where		= array("kode_jenis" => $kode_jenis);

		$this->load->model('m_jenis');
		$q = $this->m_jenis->delete_data('jenis', $where);
		if($q >= 1){
			redirect('jenis/index');
		}
	}

	public function export_pdf(){
		$data['jenis'] = $this->m_jenis->get_jenis();
		$this->load->view('backend/jenis/export_pdf', $data);
	}

	public function export_excel(){
		$date = date("Y-m-d");
		$data = array('title' => 'Laporan-Jenis-'.$date, 'jenis' => $this->m_jenis->get_jenis());
		$this->load->view('backend/jenis/export_excel', $data);	
	}
}
