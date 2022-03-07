<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Get extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('log_valid') == FALSE) {
            $this->session->set_flashdata("report", "<div class='alert alert-danger alert-dismissible fade show' role='alert'><small>Anda harus login terlebih dahulu.</small><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>");
            redirect(base_url('login'));
        } elseif ($this->session->userdata('log_admin') == FALSE) {
            echo "Akses ditolak";
        }
        $this->load->model('admin/Master_data');
        $this->load->model('admin/Transaction_data');
    }

    public function index($x, $id)
    {
        $data = $this->db->query("SELECT * FROM $x WHERE id = '$id'")->row();
        echo json_encode($data);
    }

    public function slug()
    {
        echo strtolower(url_title($this->input->post('slug')));
    }

    public function course($tipe, $slug)
    {
        if ($tipe == "y") {
            echo json_encode($this->db->query("SELECT * FROM course WHERE slug = '$slug'")->row());
        }
    }

    
    function sel_product()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $inputan  = $this->input->post('inputan');
            $q        = $this->db->query(" SELECT id,brand,name,slug,description,category,bundled,status,unit_price,
            (SELECT SUM(stock_update) FROM product_stock WHERE id_product=product.id AND type=1) stock_plus,
            (SELECT SUM(stock_update) FROM product_stock WHERE id_product=product.id AND type=2) stock_min
            FROM product 
                                            WHERE product.name LIKE '%$inputan%'
                                            ORDER BY product.name ASC")->result_array();

            $resp       = array();
            foreach ($q as $product) {
                $resp[] = array("id" => $product['id'], "text" => "" . $product['name'] . " - (Rp " . number_format($product['unit_price'], 0, ",", ".") . ")");
                //<img src='".$product['product_image']."'>
                json_output(200, $resp);
            }
        }
    }
}
