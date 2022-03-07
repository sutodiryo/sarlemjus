<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('log_valid') == FALSE) {
      $this->session->set_flashdata("report", "<div class='alert alert-danger alert-dismissible fade show' role='alert'><small>Anda harus login terlebih dahulu.</small><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>");
      redirect(base_url('login'));
    }
    $this->load->model('Transaction_data');
    $this->load->model('Master_data');
  }

  function index()
  {
    $data['page'] = array(
      "id" => "transaction",
      "title" => "Member Area | Transaksi",
      "header" => "Transaksi",
      "a" => array("icon" => "fas fa-tachometer-alt", "link" => "dashboard", "title" => "Dashboard"),
      "b" => array("link" => "member/transaction", "title" => "Transaksi"),
      "c" => ""
    );

    $id = $this->session->userdata('log_id');
    $data['trans'] = $this->Transaction_data->get_transaction_list_by_member_id($id);

    $this->load->view('member/transaction/list', $data);
  }

  function invoice($invoice_number)
  {
    $data['page'] = array(
      "id" => "transaction",
      "title" => "Member Area | Transaksi",
      "header" => "Transaksi",
      "a" => array("icon" => "fas fa-tachometer-alt", "link" => "dashboard", "title" => "Dashboard"),
      "b" => array("link" => "member/transaction", "title" => "Transaksi"),
      "c" => ""
    );

    // $id = $this->session->userdata('log_id');
    $inv = $this->Transaction_data->get_invoice_detail($invoice_number);
    $data['inv'] = $inv;
    $data['items'] = $this->Transaction_data->get_invoice_items($inv->id);
    // $data['address'] = $this->Transaction_data->get_member_shipping_default($id);

    $this->load->view('member/transaction/invoice_detail', $data);
    // echo $invoice_number;
  }
}
