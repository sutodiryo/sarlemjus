<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reg extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('email');
        $this->load->model('Auth_model');
    }

    function index()
    {
        $this->reg(0);
    }

    public function reg($id)
    {
        // $data['id_upline'] = $id;
        // $data['level'] = $this->db->query("SELECT * FROM member_level ORDER BY nilai DESC, nama_level DESC")->result();
        $data['title'] = 'Form Pendaftaran - Najah Network';

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

            $this->db->insert_id();
            // $insert_id = $this->db->insert_id();

            // $q 		= $this->db->query("SELECT id_member FROM member WHERE no_hp='$no_hp'")->row();
            // $idm 	= $q->id_member;			

            $this->session->set_flashdata('report', '<div class="alert alert-success" role="alert">Selamat!<br>Akun anda berhasil dibuat<br>Anda bisa login sekarang</div>');
            // redirect('login');
            redirect(base_url('login'));
        }
    }
}
