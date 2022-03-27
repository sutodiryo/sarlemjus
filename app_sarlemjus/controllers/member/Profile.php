<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('log_valid') == FALSE) {
      $this->session->set_flashdata("report", "<div class='alert alert-danger alert-dismissible fade show' role='alert'><small>Anda harus login terlebih dahulu.</small><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>");
      redirect(base_url('login'));
    }
    $this->load->model('Member_data');
    $this->load->model('Location_data');
  }

  function index()
  {
    $data['title']    = 'Profile Member';
    $data['page']     = 'profile';

    $data['page']     = array(
      "id" => "profile",
      "title" => "Profile Member",
      "header" => "Course Access",
      "a" => array("icon" => "fas fa-tachometer-alt", "link" => "dashboard", "title" => "Dashboard"),
      "b" => array("link" => "profile", "title" => "Profile"),
      "c" => ""
    );

    $id = $this->session->userdata('log_id');

    $data['member'] = $this->Member_data->get_member_detail($id);
    $data['province'] = $this->Location_data->get_province($id);
    $data['downline'] = $this->Member_data->get_member_downline($id);

    $this->load->view('member/profile/index', $data);
  }

  public function update_1()
  {
    $id = $this->session->userdata('log_id');
    $data['title'] = 'Form Pendaftaran - Sarlemjus';

    $this->form_validation->set_rules('nama', 'Nama', 'required|trim', ['required' => 'Nama belum diisi!']);
    $this->form_validation->set_rules('phone', 'Nomor Handphone', 'required|trim|is_unique[member.phone]', ['required' => 'Nomor Handphone belum diisi!', 'is_unique' => 'Nomor Handphone sudah terdaftar']);
    // $this->form_validation->set_rules('level', 'Level', 'required', ['required' => 'Anda belum memilih level membership!']);
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|trim|is_unique[member.email]', ['required' => 'Email belum diisi!', 'valid_email' => 'Format email salah!', 'is_unique' => 'Email sudah terdaftar']);
    $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[4]', ['required' => 'Password belum diisi!', 'min_length' => 'Password minimal terdiri dari 4 karakter']);
    // $this->form_validation->set_rules('confirm_password', 'Password Repeat', 'required|trim|matches[password]', ['required' => 'Ulangi password!', 'matches' => 'Password tidak sama!']);

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('auth/reg', $data);
    } else {
      // $level = htmlspecialchars($this->input->post('level', TRUE));
      $phone = htmlspecialchars($this->input->post('phone', TRUE));

      date_default_timezone_set('Asia/Jakarta');
      $now = date("Y-m-d H:i:s");

      $data = [
        // 'id_upline' => 0,
        'name' => htmlspecialchars($this->input->post('nama', TRUE)),
        'email' => htmlspecialchars($this->input->post('email', TRUE)),
        'phone' => $phone,
        'password' => md5(($this->input->post('password'))),
        // 'password' => md5(($this->input->post('confirm_password'))),
        'img' => 'profile.jpg',
        'registration_date' => $now,
        'notif_admin' => 1
        // 'level' => $level
      ];

      $this->db->insert('member', $data);

      // $this->db->insert_id();
      // $insert_id = $this->db->insert_id();

      // $q 		= $this->db->query("SELECT id_member FROM member WHERE no_hp='$no_hp'")->row();
      // $idm 	= $q->id_member;			

      $this->session->set_flashdata('report', '<div class="alert alert-success" role="alert">Selamat!<br>Akun anda berhasil dibuat<br>Anda bisa login sekarang</div>');
      // redirect('login');
      redirect(base_url('login'));
    }
  }

  public function update_2()
  { }

  public function act_add_address()
  {
    $id = $this->session->userdata('log_id');
    // $data['title'] = 'Form Pendaftaran - Sarlemjus';

    // $this->form_validation->set_rules('nama', 'Nama', 'required|trim', ['required' => 'Nama belum diisi!']);
    // $this->form_validation->set_rules('phone', 'Nomor Handphone', 'required|trim|is_unique[member.phone]', ['required' => 'Nomor Handphone belum diisi!', 'is_unique' => 'Nomor Handphone sudah terdaftar']);
    // $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|trim|is_unique[member.email]', ['required' => 'Email belum diisi!', 'valid_email' => 'Format email salah!', 'is_unique' => 'Email sudah terdaftar']);
    // $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[4]', ['required' => 'Password belum diisi!', 'min_length' => 'Password minimal terdiri dari 4 karakter']);

    // if ($this->form_validation->run() == FALSE) {
    //   $this->load->view('auth/reg', $data);
    // } else {
    //   $phone = htmlspecialchars($this->input->post('phone', TRUE));

    date_default_timezone_set('Asia/Jakarta');
    $now = date("Y-m-d H:i:s");

    $data = [
      'province_id' => $this->input->post('province_id'),
      'district_id' => $this->input->post('district_id'),
      'subdistrict_id' => $this->input->post('subdistrict_id'),
      'province_name' => $this->input->post('province_name'),
      'district_name' => $this->input->post('district_name'),
      'subdistrict_name' => $this->input->post('subdistrict_name'),
      'village_name' => $this->input->post('village_name'),
      'home_detail' => $this->input->post('home_detail')
    ];

    // $data = array('status' => $y);

    $this->db->update('member_shipping', array('id'  => $id), $data);
    // $this->db->update('member', array('id'  => $id), $data);
    // }
  }
}
