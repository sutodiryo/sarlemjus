<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('log_valid') == FALSE) {
      $this->session->set_flashdata("report", "<div class='alert alert-danger alert-dismissible fade show' role='alert'><small>Anda harus login terlebih dahulu.</small><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>");
      redirect(base_url('login'));
    }
    $this->load->model('Course_data');
  }

  function index()
  {
    $data['page'] = array(
      "id" => "course",
      "title" => "Member Area | Course Access | ",
      "header" => "Course Access | ",
      "a" => array("icon" => "fas fa-tachometer-alt", "link" => "dashboard", "title" => "Dashboard"),
      "b" => array("link" => "course", "title" => "Course Access"),
      "c" => ""
    );

    $data['course'] = $this->Course_data->get_course_list();
    $this->load->view('member/course/list_course', $data);
  }

  function detail($slug)
  {
    $data['page'] = array(
      "id" => "course",
      "title" => "Member Area | Course Access | ",
      "header" => "Course Detail | ",
      "a" => array("icon" => "fas fa-tachometer-alt", "link" => "dashboard", "title" => "Dashboard"),
      "b" => array("link" => "member/course", "title" => "Course Access"),
      "c" => array("link" => "member/course/detail/" . $slug . "", "title" => "Course Detail")
    );

    $data['course'] = $this->Course_data->get_course_detail($slug);
    $this->load->view('member/course/detail_course', $data);
  }

  function list($id_category)
  {
    $access = $this->Course_data->get_course_access($id_category);
    if ($access > 0) {

      $data['page'] = array(
        "id" => "course",
        "title" => "Member Area | Course Access | ",
        "header" => "Course Access | ",
        "a" => array("icon" => "fas fa-tachometer-alt", "link" => "dashboard", "title" => "Dashboard"),
        "b" => array("link" => "course", "title" => "Course Access"),
        "c" => ""
      );

      $data['course_category'] = $this->Course_data->get_course_category_by_id($id_category);
      $data['course'] = $this->Course_data->get_course_list($id_category);
      $this->load->view('member/course/list_course', $data);
    } else {

      $this->alert('danger', 'Mohon maaf, anda tidak punya izin akses ke kelas tersebut...');
      redirect(base_url('member/course'));
    }
  }

  // Flashdata Report
  function alert($x, $y)
  {
    // $x : warna
    // $y : pesan
    return $this->session->set_flashdata("report", "<div class='alert alert-$x alert-dismissible fade show' role='alert'><strong>$y</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>");
  }
}
