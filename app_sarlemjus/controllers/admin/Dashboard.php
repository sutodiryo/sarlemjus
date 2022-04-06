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
    $this->load->model('Dashboard_data');
  }

  function index()
  {
    $data['title'] = 'Dashboard Admin';
    $data['page'] = 'dashboard';

    $data['monthly_income'] = $this->Dashboard_data->get_monthly_income('now');
    $data['member_stat'] = $this->Dashboard_data->get_stat_member_dashboard();
    $data['produk_stat'] = $this->Dashboard_data->get_stat_product_sales_dashboard();
    $data['last_sales'] = $this->Dashboard_data->get_last_sales_list_dashboard();
    // $data['sales_stat'] = $this->Transaction_data->get_stat_sales_dashboard();

    // $data['sales_stat']     = $this->Admin_model->get_stat_sales_dashboard();
    // $data['produk']       = $this->db->query("SELECT * FROM produk")->result();

    $this->load->view('admin/dashboard', $data);
  }
}
