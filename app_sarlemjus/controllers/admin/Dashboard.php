<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
    $this->load->model('Transaction_data');
  }

  function index()
  {
    $data['title']    = 'Dashboard Admin';
    $data['page']     = 'dashboard';

    $data['member_stat']    = $this->Member_data->get_stat_member_dashboard();
    // $data['sales_stat']     = $this->Admin_model->get_stat_sales_dashboard();
    // $data['produk_stat']  = $this->db->query("SELECT id_produk,nama_produk,img_1,satuan FROM produk WHERE status=1")->result();
    // $data['produk']       = $this->db->query("SELECT * FROM produk")->result();

    $this->load->view('admin/dashboard', $data);
  }
}
