<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_CallSQL');

		if($this->session->userdata('status') != "Login"){
			redirect(base_url("welcome"));
		}
	}
	
	function index(){
		$data = $this->M_CallSQL->sessdata();
		$this->load->view('template/v_header', $data);
		$this->load->view('content/v_main', $data);
		$this->load->view('template/v_footer');
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('welcome'));
	}
}
