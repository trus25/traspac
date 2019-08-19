<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_CallSQL');

		if($this->session->userdata('status') != "Login"){
			redirect(base_url("welcome"));
		}
		if($this->session->userdata('tipe') != "atasan"){
			redirect(base_url("main"));
		}
	}
	
	function index(){
		$data = $this->M_CallSQL->sessdata();
		$data['cuti']= $this->M_CallSQL->get_cuti()->result();
		$this->load->view('template/v_header', $data);
		$this->load->view('content/v_verifikasi', $data);
		$this->load->view('template/v_footer');
	}

   function download($file){
		$pdf = 'uploads/'.$file;
    	force_download($pdf, NULL);
	}

}
