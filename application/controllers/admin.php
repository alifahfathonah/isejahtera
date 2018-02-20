<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_admin');
	}

	public function index(){
		$cek = $this->session->userdata('status');
		if ($cek == 'admin') {
			$this->data['masuk'] 	= $this->m_admin->count_masuk();
			$this->data['keluar'] 	= $this->m_admin->count_keluar();

			$this->load->view('backend/admin/index', $this->data);
		}else{
			header("location:".base_url());
		}
	}
}
