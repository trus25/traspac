<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_CallSQL');

		if($this->session->userdata('status') == "Login"){
			redirect(base_url("main"));
		}
	}
	
	function index(){
		$this->load->view('template/v_login');
	}

	function submit(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'p_username' => $username,
			'p_password' => $password
			);
			
		$check = $this->M_CallSQL->where("tr_pengguna",$where)->row();
		if($check){
			$role = $this->M_CallSQL->cekrole($check->r_id)->row();
			$gol = $this->M_CallSQL->cekgol($check->g_id)->row();
			$data_session = array(
					'id'=> $check->p_id,
					'username' => $username,
					'name' => $check->p_nama,					
					'status' => "Login",
					'role' => $role->r_nama,
					'tipe' => $role->r_tipe,
					'golongan' => $gol->g_tingkat,
					'jatah' => $check->p_cuti,
					'unit' => $check->p_unitkerja
					);
			$this->session->set_userdata($data_session);
			redirect(base_url("main"));
		} else {
			$this->session->set_flashdata('failed_login', 'Username atau Password Salah!');
			redirect(base_url('welcome'));
		}
	}
}
