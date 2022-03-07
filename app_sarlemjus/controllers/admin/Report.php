<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('log_valid') == FALSE) {
            $this->session->set_flashdata("report", "<div class='alert alert-danger alert-dismissible fade show' role='alert'><small>Anda harus login terlebih dahulu.</small><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>");
            redirect(base_url('login'));
        } elseif ($this->session->userdata('log_admin') == FALSE) {
            echo "Akses ditolak";
        }
        $this->load->model('Member_data');
    }

    function index()
    {
        $data['page'] = 'report';
        $data['title'] = 'Laporan Admin';

        $this->load->view('admin/report/index', $data);
    }
}
