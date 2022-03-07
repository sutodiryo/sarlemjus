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
    }
    $this->load->model('Transaction_data');
    $this->load->model('member/Dashboard_data');
    // require_once dirname(__DIR__) . '/libraries/Midtrans/Midtrans.php';
  }

  function index()
  {
    // $data['page']   = 'dashboard';
    // $data['title']  = 'Member Area | Dashboard';

    $data['page']     = array(
      "id" => "dashboard",
      "title" => "Member Area | Dashboard",
      "stok" => "A",
      "rowiderror" => "",
      "realstock" => "",
      "name" => ""
    );
    $id = $this->session->userdata('log_id');

    $data['notice'] = $this->Dashboard_data->get_notice_list();

    $data['top'] = $this->Transaction_data->get_top_buyer();

    $this->load->view('member/dashboard', $data);
  }
}
