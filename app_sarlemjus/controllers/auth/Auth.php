<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');
		$this->load->model('Auth_model');
	}

	function index()
	{
		$this->load->view('auth/login');
	}

	function forgot_password()
	{
		$this->load->view('auth/forgot');
	}

	public function login()
	{
		$username 	= $this->security->xss_clean($this->input->post('username'));
		$password 	= md5($this->security->xss_clean($this->input->post('password')));

		$member     = $this->db->query("SELECT * FROM member WHERE password = '" . $password . "' AND (no_hp= '" . $username . "' OR email = '" . $username . "')");
		$member_cek	= $member->num_rows();
		$member_row	= $member->row();

		$admin		= $this->db->query("SELECT * FROM admin WHERE password = '" . $password . "' AND (username = '" . $username . "' OR email = '" . $username . "')");
		$admin_cek	= $admin->num_rows();
		$admin_row	= $admin->row();

		if ($member_cek == 1) {
			$data_login = array(
				'log_id'        => $member_row->id_member,
				'log_user'      => $member_row->username,
				'log_name'      => $member_row->nama,
				'log_email'  	=> $member_row->email,
				'log_no_hp'  	=> $member_row->no_hp,
				'log_status'    => $member_row->status,
				'log_level'    	=> $member_row->level,
				'log_admin'    	=> FALSE,
				'log_valid'     => TRUE
			);

			$this->session->set_userdata($data_login);

			// $login = $this->input->post('login');
			// if ($login == "checkout") {
			// 	$referred_from = $this->session->userdata('referred_checkout');
			// 	redirect($referred_from);
			// } elseif ($login == "invoice") {
			// 	redirect(base_url('member/transaksi/beli'));
			// } else {

			redirect(base_url('member/index'));
			// }
		} elseif ($admin_cek == 1) {
			$data_login = array(
				'log_id'        => $admin_row->id_admin,
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
			$this->session->set_flashdata("report", "<div><h3>Invalid login</h3> <p>Akun atau Password yang anda masukkan Salah!!!</p></div>");
			redirect(base_url('login'));
		}
	}

	function check_email()
	{
		$email   = $this->input->post('email');
		$row     = $this->db->query("SELECT email FROM member WHERE email='$email'")->num_rows();

		if ($row == 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	// REGISTER
	function register()
	{
		$this->reg(0);
	}

	public function reg($id)
	{
		$data['id_upline']	= $id;
		$data['level']		= $this->db->query("SELECT * FROM member_level ORDER BY nilai DESC, nama_level DESC")->result();
		$data['title']   	= 'Form Pendaftaran - Najah Network';

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', ['required' => 'Nama belum diisi!']);
		$this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'required|trim|is_unique[member.no_hp]', ['required' => 'Nomor Handphone belum diisi!', 'is_unique' => 'Nomor Handphone sudah terdaftar']);
		$this->form_validation->set_rules('level', 'Level', 'required', ['required' => 'Anda belum memilih level membership!']);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|trim|is_unique[member.email]', ['required' => 'Email belum diisi!', 'valid_email' => 'Format email salah!', 'is_unique' => 'Email sudah terdaftar']);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[4]', ['required' => 'Password belum diisi!', 'min_length' => 'Password minimal terdiri dari 4 karakter']);
		$this->form_validation->set_rules('confirm_password', 'Password Repeat', 'required|trim|matches[password]', ['required' => 'Ulangi password!', 'matches' => 'Password tidak sama!']);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('auth/reg', $data);
		} else {
			$level 	= htmlspecialchars($this->input->post('level', TRUE));
			$no_hp 	= htmlspecialchars($this->input->post('no_hp', TRUE));

			date_default_timezone_set('Asia/Jakarta');
			$now   = date("Y-m-d");

			$data 	= [
				'id_upline'    	=> $id,
				'password'     	=> md5(($this->input->post('confirm_password'))),
				'nama'         	=> htmlspecialchars($this->input->post('nama', TRUE)),
				'no_hp'        	=> $no_hp,
				'email'        	=> htmlspecialchars($this->input->post('email', TRUE)),
				'tgl_reg'      	=> $now,
				'notif_admin'	=> 1,
				'level'        	=> $level
			];

			$this->db->insert('member', $data);

			$insert_id = $this->db->insert_id();

			// $q 		= $this->db->query("SELECT id_member FROM member WHERE no_hp='$no_hp'")->row();
			// $idm 	= $q->id_member;			

			// $this->session->set_flashdata('report', '<div class="alert alert-success" role="alert">Selamat!<br>Akun anda berhasil dibuat<br>Anda bisa login sekarang</div>');
			// redirect('login');
			redirect(base_url() . 'beli/' . $insert_id);
		}
	}

	function add_affiliate()
	{
		$username   = $this->input->post('username');
		$nama       = $this->input->post('nama');
		$id_upline  = $this->input->post('id_upline');
		$email      = $this->input->post('email');
		$no_hp      = $this->input->post('no_hp');
		$password   = md5($this->input->post('password'));

		$this->db->query("INSERT INTO `member` (`id_member`, `id_upline`, `username`, `password`, `nama`, `no_hp`, `email`, `id_bank`, `no_rekening`, `nama_rekening`, `alamat`, `pekerjaan`, `tgl_reg`, `level`, `status`) VALUES (NULL, '$id_upline', '$username', '$password', '$nama', '$no_hp', '$email', '', '', '', '', '', NOW(), 1, '0')");
		$this->session->set_flashdata("report", "<div class='form-group'><div class='alert alert-success'><strong>Registrasi Reseller Berhasil!! </strong>Anda dapat login sekarang...</div></div>");
		redirect(base_url('auth'));
	}

	public function check_no_hp_availablity()
	{
		$get_result = $this->Auth_model->check_username_availablity();
		if (!$get_result)
			echo '<div class="form-group"><div class="alert alert-danger"><strong>Sayang sekali!</strong> Username sudah dipakai...</div></div>';
		else
			echo '<div class="form-group"><div class="alert alert-success"><strong>Selamat!</strong> Username masih tersedia...</div></div>';
	}

	public function check_username_availablity()
	{
		$get_result = $this->Auth_model->check_username_availablity();
		if (!$get_result)
			echo '<div class="form-group"><div class="alert alert-danger"><strong>Sayang sekali!</strong> Username sudah dipakai...</div></div>';
		else
			echo '<div class="form-group"><div class="alert alert-success"><strong>Selamat!</strong> Username masih tersedia...</div></div>';
	}

	public function check_email_availablity()
	{
		$get_result = $this->Auth_model->check_email_availablity();
		if (!$get_result)
			echo '<div class="form-group"><div class="alert alert-danger"><strong></strong> Email sudah terdaftar...</div></div>';
		else
			echo '<div class="form-group"><div class="alert alert-success"><strong></strong> Email masih tersedia...</div></div>';
	}

	function member()
	{
		$username   = $this->input->post('username');
		$nama       = $this->input->post('nama');
		$id_upline  = $this->input->post('id_upline');
		$email      = $this->input->post('email');
		$no_hp      = $this->input->post('no_hp');
		$password   = md5($this->input->post('password'));
		// echo $username, $nama, $id_upline, $email, $no_hp, $password;

		$this->db->query("INSERT INTO `member` (`id_member`, `username`, `password`, `nama`, `no_hp`, `email`, `id_bank`, `no_rekening`, `nama_rekening`, `alamat`, `pekerjaan`, `tgl_reg`, `level`, `status`) VALUES (NULL, '$username', '$password', '$nama', '$no_hp', '$email', '', '', '', '', '', NOW(), 1, '0')");
		// INSERT INTO `member` (`id_member`, `username`, `nama`, `no_ktp`, `alamat`, `kota`, `no_hp`, `email`, `password`, `id_bank`, `no_rekening`, `tgl_daftar`, `id_upline`, `status`) VALUES (NULL, '', '', '', '', '', '', '', '', '0', '', NOW(), '$id_upline', '0')");

		$this->session->set_flashdata("report", "<div class='form-group'><div class='alert alert-success'><strong>Registrasi Berhasil!! </strong>Anda dapat login sekarang...</div></div>");

		redirect(base_url('auth'));
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}
