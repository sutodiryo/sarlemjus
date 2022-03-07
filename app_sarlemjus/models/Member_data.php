<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member_data extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_stat_member_dashboard()
    {
        date_default_timezone_set('Asia/Jakarta');
        // $now 	= date("Y-m-d h:i:s");
        // $now     = "MONTH(registration_date) = MONTH(CURRENT_DATE())";
        // $total     = "SELECT SUM(total) FROM transaksi WHERE transaksi.id_member=member.id";
        // $tnow     = " AND MONTH(tgl_pesan) = MONTH(CURRENT_DATE())";
        // $tm1     = " AND MONTH(tgl_pesan) IN ( (MONTH(CURRENT_DATE()) -1),(MONTH(CURRENT_DATE()) -2) ) ";
        // $tm2     = " AND MONTH(tgl_pesan) IN ( MONTH(CURRENT_DATE()),(MONTH(CURRENT_DATE()) -1),(MONTH(CURRENT_DATE()) -2) ) ";

        return $this->db->query("SELECT COUNT(*) AS member")->row();
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

    function get_member_stat()
    {
        return $this->db->query("SELECT   id,name,
                                            (SELECT COUNT(id) FROM member WHERE level=member_level.id AND status != 9) AS total
                                    FROM member_level
                                    ORDER BY id ASC")->result();
    }

    function get_member_level_detail($id)
    {
        return $this->db->query("SELECT * FROM member_level WHERE id='$id'")->row();
    }

    function get_member_list()
    {
        return "SELECT    m1.id,m1.username,m1.name,m1.phone,m1.status,m1.registration_date,m1.gender,m1.level,m1.email,m1.address,m1.img,
                        (SELECT name FROM member_level WHERE id=m1.level) AS level_name,
                        (SELECT name FROM location_district WHERE id=m1.district) AS district_name,
                        (SELECT id FROM member m2 WHERE m2.id=m1.upline) AS id_member_up
                    FROM member m1
                    WHERE status != 9";
    }

    function get_city()
    {
        return $this->db->query("SELECT * FROM location
                                        WHERE CHAR_LENGTH(id_location)=5
                                        ORDER BY location_name ASC")->result();
    }

    function get_member_detail($id)
    {
        return $this->db->query("SELECT   m1.id,m1.username,m1.name,m1.phone,m1.status,m1.registration_date,m1.gender,m1.address,m1.province,m1.district,m1.subdistrict,m1.village,m1.postal_code,m1.level,m1.bank_account,m1.bank_account_name,m1.bank,m1.email,m1.registration_date,m1.img,
                                        (SELECT name FROM bank WHERE bank.id=m1.bank LIMIT 1) AS bank,
                                        (SELECT COUNT(*) FROM member m2 WHERE m2.upline=m1.id) AS downline,
                                        (SELECT name FROM member_level WHERE id=m1.level) AS level_name,
                                        (SELECT name FROM location_village WHERE id=m1.village) AS village_name,
                                        (SELECT name FROM location_subdistrict WHERE id=m1.subdistrict) AS subdistrict_name,
                                        (SELECT name FROM location_district WHERE id=m1.district) AS district_name,
                                        (SELECT name FROM location_province WHERE id=m1.province) AS province_name,
                                        (SELECT id FROM member m2 WHERE m2.id=m1.upline) AS id_member_up
                                    FROM member m1 WHERE id='$id'")->row();
        
    }
    
    function get_member_downline($id)
    {
        return $this->db->query("SELECT id,name,level,img,status,
                                        (SELECT name FROM member_level WHERE id=member.level) AS level_name
                                    FROM member WHERE upline=$id")->result();
    }

    function get_member_level_list()
    {
        return $this->db->query("SELECT * FROM member_level ORDER BY id DESC")->result();
    }

    

    function get_product_purchase_cart($idm,$idp)
    {
        return  $this->db->query("SELECT  id_produk,nama_produk,satuan,nilai,img_1,img_2,keterangan,waktu_input,status,berat,
                                            (SELECT harga FROM produk_harga WHERE id_produk=produk.id_produk AND produk_harga.id_member_level=(SELECT level FROM member WHERE member.id_member='$idm')) AS harga,
                                            ((SELECT SUM(stock_update) FROM produk_stok WHERE id_produk=produk.id_produk)) AS stok,
                                            (SELECT SUM(quantity) FROM transaksi_produk WHERE transaksi_produk.id_produk=produk.id_produk AND id_transaksi IN (SELECT id_transaksi FROM transaksi WHERE status IN (3,4))) AS stok_
                                        FROM produk
                                        WHERE produk.id_produk='$idp' AND produk.status=1")->row();
        
    }
}
