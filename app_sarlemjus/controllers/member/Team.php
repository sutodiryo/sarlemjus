<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Team extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('log_valid') == FALSE) {
      $this->session->set_flashdata("report", "<div class='alert alert-danger alert-dismissible fade show' role='alert'><small>Anda harus login terlebih dahulu.</small><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>");
      redirect(base_url('login'));
    }
    $this->load->model('Member_data');
  }

  function index()
  {
    $data['page'] = array(
      "id" => "team",
      "title" => "Member Area | My Team",
      "header" => "My Team",
      "a" => array("icon" => "fas fa-tachometer-alt", "link" => "dashboard", "title" => "Dashboard"),
      "b" => array("link" => "team", "title" => "My Team"),
      "c" => ""
    );

    $id = $this->session->userdata('log_id');
    $q = $this->Member_data->get_member_list();
    $member = "$q AND upline=$id ORDER BY name ASC";

    $data['member_tot'] = $this->db->query($member)->num_rows();
    $data['member'] = $this->db->query($member)->result();

    $this->load->view('member/team/list', $data);
  }
}
