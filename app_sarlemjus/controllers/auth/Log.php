<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');
		$this->load->model('Auth_model');
	}

	function in()
	{
		$this->load->view('auth/login');
	}

	public function do_login()
	{
		$username 	= $this->security->xss_clean($this->input->post('username'));
		$password 	= md5($this->security->xss_clean($this->input->post('password')));

		$member     = $this->db->query("SELECT 	id,username,name,email,phone,status,level,
																						(SELECT name FROM member_level WHERE id=member.level) AS level_name
																		FROM member WHERE password = '" . $password . "' AND (phone= '" . $username . "' OR email = '" . $username . "') AND status != 9");
		$member_cek	= $member->num_rows();
		$member_row	= $member->row();

		$admin		= $this->db->query("SELECT * FROM admin WHERE password = '" . $password . "' AND (username = '" . $username . "' OR email = '" . $username . "')");
		$admin_cek	= $admin->num_rows();
		$admin_row	= $admin->row();
 
		if ($member_cek == 1) {
			$data_login = array(
				'log_id' => $member_row->id,
				'log_user' => $member_row->username,
				'log_name' => $member_row->name,
				'log_email' => $member_row->email,
				'log_phone' => $member_row->phone,
				'log_status' => $member_row->status,
				'log_level' => $member_row->level,
				'log_level_name' => $member_row->level_name,
				'log_admin' => FALSE,
				'log_valid' => TRUE
			);

			$this->session->set_userdata($data_login);

			// $login = $this->input->post('login');
			// if ($login == "checkout") {
			// 	$referred_from = $this->session->userdata('referred_checkout');
			// 	redirect($referred_from);
			// } elseif ($login == "invoice") {
			// 	redirect(base_url('member/transaksi/beli'));
			// } else {

			redirect(base_url('member'));
			// }
		} elseif ($admin_cek == 1) {
			$data_login = array(
				'log_id'        => $admin_row->id,
				'log_user'      => $admin_row->username,
				'log_name'      => $admin_row->name,
				'log_email'  	=> $admin_row->email,
				'log_level'     => $admin_row->level,
				'log_admin'     => TRUE,
				'log_valid'     => TRUE
			);
			$this->session->set_userdata($data_login);
			redirect(base_url('admin'));
		} else {
			$this->session->set_flashdata("report", "<div class='alert alert-danger alert-dismissible fade show' role='alert'><small>Akun atau Password yang anda masukkan salah!</small><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>");
     
			redirect(base_url('login'));
		}
	}
  
	public function out()
	{
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}

}