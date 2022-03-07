<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course_data extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_course_access($id)
    {
        $level = $this->session->userdata('log_level');
        return $this->db->query("   SELECT id
                                    FROM course_category
                                    WHERE id=$id")->num_rows();
    }

    function get_course_category_list()
    {

        $level = $this->session->userdata('log_level');
        return $this->db->query("   SELECT  id,name,cover,status,
                                            (SELECT COUNT(*) FROM course_acces WHERE id_course_category=course_category.id) AS tot_access
                                    FROM course_category")->result();
    }

    function get_course_category_by_id($id_category)
    {
        return $this->db->query("SELECT id,name FROM course_category WHERE id='$id_category'")->row();
    }

    function get_course_list()
    {
        return $this->db->query("SELECT * FROM course")->result();
    }

    function get_course_list_by_cat($id_category)
    {
        return $this->db->query("SELECT * FROM course WHERE category='$id_category'")->result();
    }
    
    function get_course_detail($slug)
    {
        return $this->db->query("SELECT * FROM course WHERE slug='$slug'")->result();
    }
}
