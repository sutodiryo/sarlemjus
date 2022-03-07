<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function check_username_availablity()
  {
    $username = strtolower(trim($this->input->post('username')));
    // $username = strtolower($username);

    $query = $this->db->query("SELECT * FROM member WHERE username='$username'");
    if ($query->num_rows() > 0)
      return false;
    else
      return true;
  }

  public function check_email_availablity()
  {
    $email = strtolower(trim($this->input->post('email')));
    // $email = strtolower($email);

    $query = $this->db->query("SELECT * FROM member WHERE email='$email'");
    if ($query->num_rows() > 0)
      return false;
    else
      return true;
  }

  public function add($table, $data)
  {
    $this->db->insert($table, $data);
  }

  public function add_member_checkout($data)
  {
    $this->db->insert('member', $data);
    $id_member = $this->db->insert_id();
    return $id_member;
  }

  public function add_guest_trans($data)
  {
    $this->db->insert('transaksi', $data);
  }
  
}
