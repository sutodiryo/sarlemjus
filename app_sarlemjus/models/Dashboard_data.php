<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_data extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_monthly_income($date)
    {
        if ($date == 'now') {
            $period = "MONTH(t.date_created) = MONTH(CURRENT_DATE()) AND YEAR(t.date_created) = YEAR(CURRENT_DATE())";
        } else {

            $d = date_parse_from_format("Y-m-d", date($date));
            $m = $d["month"];
            $y = $d["year"];

            $period = "MONTH(t.date_created) = $m AND YEAR(t.date_created) = $y";
        }

        return $this->db->query("SELECT     IFNULL(SUM(t.total),0) AS total,
                                            IFNULL(SUM(t.shipping_costs),0) AS shipping_costs,
                                            IFNULL(SUM(t.discount_value),0) AS discount_value
                                    FROM transaction t
                                    WHERE t.status > 0
                                    AND $period")->row();
    }

    function get_stat_member_dashboard()
    {
        return $this->db->query("SELECT id FROM member")->num_rows();
    }

    function get_stat_product_sales_dashboard()
    {
        return $this->db->query("SELECT   IFNULL(SUM(tp.quantity),0) AS quantity
                                    FROM transaction_product tp
                                    LEFT JOIN transaction t ON t.id=tp.transaction_id
                                    WHERE t.status > 0")->row();
    }

    function get_last_sales_list_dashboard()
    {
        return $this->db->query("SELECT     t.id,t.invoice_number,t.member_id,t.total,t.date_created,t.receipt,t.date_paid,t.date_accepted,t.status,t.shipping_costs,t.discount_value,t.type,
                                            m.name AS member_name
                                    FROM transaction t
                                    LEFT JOIN member m ON t.member_id=m.id
                                    ORDER BY date_created ASC
                                    LIMIT 10")->result();
    }

    function get_stat_sales_dashboard()
    {
        return $this->db->query("SELECT   SUM(total) AS tot,
                                            MONTH(tgl_pesan) AS bulan,
                                            YEAR(tgl_pesan) AS th
                                    FROM transaksi
                                    WHERE YEAR(tgl_pesan)=YEAR(CURDATE()) AND status IN (3,4)
                                    GROUP BY bulan,th ORDER BY th ASC, bulan ASC")->result();
    }

    function get_member_list()
    {
        $q = "SELECT    m1.id_member,m1.username,m1.nama,m1.no_hp,m1.status,m1.tgl_reg,m1.kota,m1.alamat,m1.id_location,m1.level,m1.no_rekening,m1.nama_rekening,m1.kode_bank,m1.email,
                        (SELECT nama_bank FROM bank WHERE bank.kode_bank=m1.kode_bank LIMIT 1) AS bank,
                        (SELECT COUNT(*) FROM member m2 WHERE m2.id_upline=m1.id_member) AS downline,
                        -- (SELECT location_name FROM location WHERE id_location=m1.id_location) AS kota2,
                        (SELECT nama_level FROM member_level WHERE id_member_level=m1.level) AS nama_level,
                        (SELECT id_member FROM member m2 WHERE m2.id_member=m1.id_upline) AS id_member_up
                    FROM member m1";
        return $q;
    }
}
