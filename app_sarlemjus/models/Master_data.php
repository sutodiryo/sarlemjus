<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_data extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_product_list($status)
    {
        $q = "SELECT    p.id,brand,p.name,slug,description,category,unit,free_delivery,weight,length,width,height,p.status,p.selling_price,
                        (SELECT SUM(psp.stock_update) FROM product_stock psp WHERE psp.id_product=p.id AND psp.type=1) AS stock_plus,
                        (SELECT SUM(psp.stock_update) FROM product_stock psp WHERE psp.id_product=p.id AND psp.type!=1) AS stock_min,
                        pc.name AS category_name,
                        pb.name AS brand_name,
                        (SELECT image FROM product_image WHERE id_product=p.id LIMIT 1) AS image
                FROM product p
                LEFT JOIN product_category pc ON p.category=pc.id
                LEFT JOIN product_brand pb ON p.brand=pb.id";

        if ($status == "all") {
            $product = "$q ORDER BY name ASC";
        } else {
            $product = "$q WHERE p.status='$status' ORDER BY name ASC";
        }

        return $this->db->query($product)->result();
    }

    function get_product_by_id($id_product)
    {
        return $this->db->query("SELECT * FROM product WHERE id='$id_product'")->row();
    }

    function get_product_brand()
    {
        return $this->db->query("SELECT * FROM product_brand")->result();
    }

    function get_product_category()
    {
        return $this->db->query("SELECT * FROM product_category")->result();
    }

    function get_product_unit()
    {
        return $this->db->query("SELECT * FROM product_unit")->result();
    }

    function get_bonus_list()
    {
        return  $this->db->query("SELECT * FROM bonus")->result();
    }


    function get_course_category_list()
    {
        return $this->db->query("SELECT id,name,cover,status FROM course_category")->result();
        // (SELECT COUNT(*) FROM course_acces WHERE id_course_category=course_category.id) AS tot_access
        // FROM course_category")->result();
    }

    function get_notice_list()
    {
        return  $this->db->query("SELECT    id,title,content,date_start,date_end,status,
                                            (SELECT COUNT(*) FROM notice_target WHERE id_notice=notice.id) AS tot_target
                                    FROM notice")->result();
    }

    function get_course_category_by_id($id_category)
    {
        return $this->db->query("SELECT id,name FROM course_category WHERE id='$id_category'")->row();
    }

    function get_course_list($id_category)
    {
        return $this->db->query("SELECT * FROM course WHERE category='$id_category'")->result();
    }

    function get_member_level()
    {
        return $this->db->query("SELECT * FROM member_level ORDER BY id DESC")->result();
    }
}
