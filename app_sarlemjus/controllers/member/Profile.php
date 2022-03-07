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
  }

  function index()
  {
    $data['title']    = 'Profile - ';
    $data['page']     = 'profile';

    $data['page']     = array(
      "id" => "profile",
      "title" => "Profile - ",
      "header" => "Course Access",
      "a" => array("icon" => "fas fa-tachometer-alt", "link" => "dashboard", "title" => "Dashboard"),
      "b" => array("link" => "profile", "title" => "Profile"),
      "c" => ""
    );

    $id = $this->session->userdata('log_id');

		$data['member'] = $this->Member_data->get_member_detail($id);
		$data['downline'] = $this->Member_data->get_member_downline($id);

    $this->load->view('member/profile/index', $data);
  }
}
