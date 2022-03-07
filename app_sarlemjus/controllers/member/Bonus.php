<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bonus extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('log_valid') == FALSE) {
      $this->session->set_flashdata("report", "<div class='alert alert-danger alert-dismissible fade show' role='alert'><small>Anda harus login terlebih dahulu.</small><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>");
      redirect(base_url('login'));
    }
    $this->load->model('Member_model');
    // require_once dirname(__DIR__) . '/libraries/Midtrans/Midtrans.php';
  }

  function index()
  {
    $data['page']     = array(
      "id" => "bonus",
      "title" => "Member Area | Dashboard",
      "stok" => "A",
      "rowiderror" => "",
      "realstock" => "",
      "name" => ""
    );
    $id             = $this->session->userdata('log_id');
    $this->load->view('member/bonus/list', $data);
  }
}
