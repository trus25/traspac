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
		$cond = array(
			'c_atasan' => $data['id'],
		);
		$data['cuti']= $this->M_CallSQL->get_verif($cond)->result();
		$this->load->view('template/v_header', $data);
		$this->load->view('content/v_verifikasi', $data);
		$this->load->view('template/v_footer');
	}

	function acc($id){
		$data = $this->M_CallSQL->sessdata();
		$cek = $this->M_CallSQL->get_cuti_detail($id)->row();
		if($cek->c_status =='new'){
			$update = array(
				'c_status' => 'acc',
			);
			$this->M_CallSQL->update_data(array('c_id' =>$id),$update,"tr_cuti");
			$update_jatah = array(
				'p_cuti' => $data['jatah'] - $cek->c_lama,
			);
			$this->M_CallSQL->update_data(array('p_id' =>$cek->p_id),$update_jatah,"tr_pengguna");
			$this->session->set_flashdata('berhasil_tambah', 'Pengajuan cuti berhasil disetujui');
			redirect(base_url("verifikasi"));
		}else{
			$this->session->set_flashdata('gagal_tambah', 'Pengajuan sudah di verifikasi');
			redirect(base_url("verifikasi"));
		}
	}
	function rjct($id){
		$data = $this->M_CallSQL->sessdata();
		$cek = $this->M_CallSQL->get_cuti_detail($id)->row();
		if($cek->c_status =='new'){
			$update = array(
				'c_status' => 'rjct',
			);
			$this->M_CallSQL->update_data(array('c_id' =>$id),$update,"tr_cuti");
			$this->session->set_flashdata('berhasil_tambah', 'Pengajuan cuti berhasil ditolak');
			redirect(base_url("verifikasi"));
		}else{
			$this->session->set_flashdata('gagal_tambah', 'Pengajuan sudah di verifikasi');
			redirect(base_url("verifikasi"));
		}
	}


    function download($file){
		$pdf = 'uploads/'.$file;
    	force_download($pdf, NULL);
	}

}
