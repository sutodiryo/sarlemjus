<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_data extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_notice_list()
    {
        $level = $this->session->userdata('log_level');
        return $this->db->query("   SELECT * FROM notice")->result();
                                    // WHERE id IN (SELECT id_notice FROM notice_target WHERE id_member_level=$level)
                                    // AND date_start <= CURRENT_DATE()
                                    // AND date_end >= CURRENT_DATE()
                                    // ORDER BY date_start DESC")->result();
    }
}
