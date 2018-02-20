<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function _construct(){
		session_start();
	}

	public function index(){
		$this->load->view('frontend/index');
	}

	public function login(){
		$cek = $this->session->userdata("status");

		if(empty($cek)){
			$this->load->view('frontend/login');
		}else{
			$status = $this->session->userdata("status");
			if($status == "admin"){
				header("location: ".base_url()."dashboard");
			}else{
				header("lcoation: ".base_url()."user");
			}
		}
	}

	public function logout(){
		$cek = $this->session->userdata("username");
		if(empty($cek)) {
			header("location:".base_url());
		}else{
			$this->session->sess_destroy();
			header("location:".base_url());
		}
	}
}
