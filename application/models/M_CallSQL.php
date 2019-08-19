<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_CallSQL extends CI_Model{	
	function where($table,$where){		
		return $this->db->get_where($table,$where);
	}
	
	function cekrole($role){
		return $this->db->get_where("tr_role",array('r_id'=> $role));
	}

	function cekgol($gol){
		return $this->db->get_where("tr_golongan",array('g_id'=> $gol));
	}

	function sessdata(){
		$data['id'] = $this->session->userdata('id');
		$data['username'] = $this->session->userdata('username');
		$data['name'] = $this->session->userdata('name');
		$data['status'] = $this->session->userdata('status');
		$data['role'] = $this->session->userdata('role');
		$data['tipe'] = $this->session->userdata('tipe');
		$data['golongan'] = $this->session->userdata('golongan');
		$data['jatah'] = $this->session->userdata('jatah');
		$data['unit'] = $this->session->userdata('unit');			
		return $data;
	}

	function input_data($data,$table){
		$this->db->insert($table,$data);
	}

	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	function get_profile($data){
		$this->db->select('*');
		$this->db->from('tr_pengguna');
		$this->db->join('tr_role', 'tr_pengguna.r_id = tr_role.r_id');
		$this->db->join('tr_golongan', 'tr_pengguna.g_id = tr_golongan.g_id');
		$this->db->where('tr_pengguna.p_id', $data);

		$query = $this->db->get();
		return $query;
	}

	function get_atasan(){
		$this->db->select('*');
		$this->db->from('tr_pengguna');
		$this->db->join('tr_role', 'tr_pengguna.r_id = tr_role.r_id');
		$this->db->join('tr_golongan', 'tr_pengguna.g_id = tr_golongan.g_id');
		$this->db->where('tr_role.r_tipe', "atasan");

		$query = $this->db->get();
		return $query;
	}

	function get_cuti(){
		$this->db->select('*');
		$this->db->from('tr_cuti');
		$this->db->join('tr_pengguna', 'tr_pengguna.p_id = tr_cuti.p_id');
		$this->db->join('tr_role', 'tr_role.r_id = tr_pengguna.r_id');
		$this->db->order_by('c_id', 'ASC');
		$query = $this->db->get();
		return $query;
	}

}