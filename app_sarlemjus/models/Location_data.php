<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Location_data extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $this->load->helper('date');
  }

  public function get_province()
  {
    return $this->db->query("SELECT * FROM location_province ORDER BY name ASC")->result();
  }

  public function get_village($subdistrict)
  {
    return $this->db->query("SELECT lv.id,lv.subdistrict,lv.name,lv.type,
                                    ls.name AS subdistrict_name
                              FROM location_village lv
                              LEFT JOIN location_subdistrict ls ON lv.subdistrict=ls.id
                              WHERE ls.name='$subdistrict' ORDER BY name ASC")->result();
  }

}
