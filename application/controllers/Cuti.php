<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuti extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_CallSQL');

		if($this->session->userdata('status') != "Login"){
			redirect(base_url("welcome"));
		}
	}
	
	function index(){
		$data = $this->M_CallSQL->sessdata();
		$data['cuti']= $this->M_CallSQL->get_cuti($data['id'])->result();
		
		$this->load->view('template/v_header', $data);
		$this->load->view('content/v_daftarcuti', $data);
		$this->load->view('template/v_footer');
	}

	function detail($detil){
		$data = $this->M_CallSQL->sessdata();
		$data['cuti']= $this->M_CallSQL->get_cuti_detail($detil)->row();
		$data['verifikator']= $this->M_CallSQL->get_profile($data['cuti']->c_atasan)->row();
		$data['pengaju']= $this->M_CallSQL->get_profile($data['cuti']->p_id)->row();
		$this->load->view('template/v_header', $data);
		$this->load->view('content/v_detailcuti', $data);
		$this->load->view('template/v_footer');
	}

	function add(){
		// Post value
		$data = $this->M_CallSQL->sessdata();
		$data['list'] = $this->M_CallSQL->get_atasan()->result();
			$jenis = $this->input->post('jenis');
			$dari = $this->input->post('dari');
			$sampai = $this->input->post('sampai');
			$lama = $this->input->post('lama');
			$tempat = $this->input->post('tempat');
			$keperluan = $this->input->post('keperluan');
			$kontak = $this->input->post('kontak');
			$atasan = $this->input->post('id_atasan');
			// Input
			if($jenis!=''|| $dari!=''|| $sampai!=''|| $lama!=''|| $tempat!=''|| $keperluan!=''|| $kontak!=''){
				// Jika data sudah ada ada
				if(!$atasan){
					$this->session->set_flashdata('gagal_tambah', 'Harap pilih atasan terlebih dahulu.');
					redirect(base_url('cuti/add'));
				}else if($dari < date('Y-m-d') || $sampai < date('Y-m-d')){
					$this->session->set_flashdata('gagal_tambah', 'Input tanggal salah, silahkan cek kembali pengisian dokumen.');
					redirect(base_url('cuti/add'));
				}else if($lama > $data['jatah']){
					$this->session->set_flashdata('gagal_tambah', 'Saldo cuti tidak cukup.');
					redirect(base_url('cuti/add'));
				}else {

					$config['upload_path']          = './uploads/';
					$config['allowed_types']        = 'gif|jpg|png|pdf';
					$config['max_size']				= 950;
					$new_name = time().$this->file_ext;
					$config['file_name'] = $new_name;
					$this->load->library('upload', $config);
					if((!$this->upload->do_upload('berkas') && $_FILES['berkas']['size'] != 0) || $_FILES['berkas']['error']==1) {
						$this->session->set_flashdata('gagal_tambah', 'Gagal mengupload Dokumen. Silahkan cek kembali file dokumen.');
						redirect(base_url('cuti/add'));
					} 
					else {
						if($_FILES['berkas']['size'] != 0 && !empty($_FILES['berkas'])){
							$dokumen = array(
								'p_id' => $data['id'],
								'c_jenis' => $jenis,
								'c_dari' => $dari,
								'c_sampai' => $sampai,
								'c_lama' => $lama,
								'c_tempat' => $tempat,
								'c_keperluan' => $keperluan,
								'c_kontak' => $kontak,
								'c_file' => $this->upload->data('file_name'),
								'c_status' => 'new',
								'c_atasan' => $atasan,
								'c_tanggal' => date('Y-m-d H:i:s')
								//'d_status' => $this->upload->data('file_name'),
								//'d_status_role' => $this->upload->data('file_name'),
							);
							// $this->session->set_flashdata('berhasil_tambah', 'Data dokumen sudah ditambahkan2.');
						} else {
							$dokumen = array(
								'p_id' => $data['id'],
								'c_jenis' => $jenis,
								'c_dari' => $dari,
								'c_sampai' => $sampai,
								'c_lama' => $lama,
								'c_tempat' => $tempat,
								'c_keperluan' => $keperluan,
								'c_kontak' => $kontak,
								'c_file' => $this->upload->data('file_name'),
								'c_status' => 'new',
								'c_atasan' => $atasan,
								'c_tanggal' => date('Y-m-d H:i:s')
								//'d_status' => $this->upload->data('file_name'),
								//'d_status_role' => $this->upload->data('file_name'),
							);
							// $this->session->set_flashdata('berhasil_tambah', 'Data dokumen sudah ditambahkan3.');
						}
						$this->M_CallSQL->input_data($dokumen,'tr_cuti');
					}				
					$this->session->set_flashdata('berhasil_tambah', 'Data pengajuan sudah ditambahkan.');
					redirect(base_url('cuti/add'));
				}	
			} else {
				$view = array(
					$this->load->view('template/v_header', $data),
					$this->load->view('content/v_addcuti', $data),
					$this->load->view('template/v_footer')
				);
					return $view;
			}
	}

	function get_data_atasan($id) { 
       $data = $this->M_CallSQL->get_profile($id)->row();
	   $this->load->view('content/v_addcuti_atasan', $data);
   }

   function download($file){
		$pdf = 'uploads/'.$file;
    	force_download($pdf, NULL);
	}

	public function pdf($id){
		// $data = $this->M_CallSQL->sessdata();
		// $data['cuti']= $this->M_CallSQL->get_cuti_detail($id)->row();
		// $data['verifikator']= $this->M_CallSQL->get_profile($data['cuti']->c_atasan)->row();
  //       $this->load->view('content/v_pdf', $data);
  //       // // Get output html
  //       $html = $this->output->get_output();
  //       // // Load pdf library
  //       $this->load->library('pdf');
  //       // // Load HTML content
  //        $this->tcpdf->WriteHTML();
  //       // // (Optional) Setup the paper size and orientation
  //       // $this->dompdf->setPaper('A5', 'landscape');
  //       // // Render the HTML as PDF
  //       // $this->dompdf->render();
  //       // // Output the generated PDF (1 = download and 0 = preview)
  //       // $this->dompdf->stream('barcode_'.$data['dokumen'][0]->d_nomor.'.pdf', array("Attachment"=>0));
		// Load autoloader (using Composer)
		$data = $this->M_CallSQL->sessdata();
		$data['cuti']= $this->M_CallSQL->get_cuti_detail($id)->row();
		$data['verifikator']= $this->M_CallSQL->get_profile($data['cuti']->c_atasan)->row();
		$data['pengaju']= $this->M_CallSQL->get_profile($data['cuti']->p_id)->row();
		$this->load->library('Pdf');
		$this->load->view('content/v_printdetil',$data);
	}

	function laporan(){ 
		$data = $this->M_CallSQL->sessdata();
		$data['cuti']= $this->M_CallSQL->get_cuti($data['id'])->result();
		$this->load->view('content/v_laporan',$data);
	}
}