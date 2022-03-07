<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
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
        // $now     = "MONTH(tgl_reg) = MONTH(CURRENT_DATE())";
        // $total     = "SELECT SUM(total) FROM transaksi WHERE transaksi.id_member=member.id_member";
        // $tnow     = " AND MONTH(tgl_pesan) = MONTH(CURRENT_DATE())";
        // $tm1     = " AND MONTH(tgl_pesan) IN ( (MONTH(CURRENT_DATE()) -1),(MONTH(CURRENT_DATE()) -2) ) ";
        // $tm2     = " AND MONTH(tgl_pesan) IN ( MONTH(CURRENT_DATE()),(MONTH(CURRENT_DATE()) -1),(MONTH(CURRENT_DATE()) -2) ) ";

        $query = $this->db->query("SELECT COUNT(*) AS member")->row();

        return $query;
    }

    function get_stat_sales_dashboard()
    {
        $query = $this->db->query("SELECT   SUM(total) AS tot,
                                            MONTH(tgl_pesan) AS bulan,
                                            YEAR(tgl_pesan) AS th
                                    FROM transaksi
                                    WHERE YEAR(tgl_pesan)=YEAR(CURDATE()) AND status IN (3,4)
                                    GROUP BY bulan,th ORDER BY th ASC, bulan ASC")->result();

        return $query;
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

    function get_city()
    {
        $q = $this->db->query("SELECT * FROM location
                                        WHERE CHAR_LENGTH(id_location)=5
                                        ORDER BY location_name ASC")->result();
        return $q;
    }

    function get_member_detail($id)
    {
        $q = $this->db->query("SELECT   m1.id_member,m1.username,m1.nama,m1.no_hp,m1.email,m1.status,m1.tgl_reg,m1.kota,m1.alamat,m1.id_location,level,
                                        (SELECT COUNT(*) FROM member m2 WHERE m2.id_upline=m1.id_member) AS downline,
                                        (SELECT location_name FROM location WHERE id_location=m1.id_location) AS kota2,
                                        (SELECT nama_level FROM member_level WHERE id_member_level=m1.level) AS nama_level,
                                        (SELECT id_member FROM member m2 WHERE m2.id_member=m1.id_upline) AS id_member_up
                                FROM member m1 WHERE id_member='$id'")->row();
        return $q;
    }

    function get_transaction_list()
    {
        $query = "SELECT    id_transaksi,id_member,nama_promo,nilai_promo,ongkir,total,status,resi,id_kurir,tgl_pesan,tipe,bukti_transfer,
                            (SELECT IF((transaksi.tipe=1), (SELECT nama FROM member WHERE id_member=transaksi.id_member_to), 0)) AS member_to,
                            (SELECT nama FROM member WHERE id_member=transaksi.id_member) AS member,
                            (SELECT no_hp FROM member WHERE id_member=transaksi.id_member) AS no_hp
                    FROM transaksi";

        return $query;
    }

    function get_transaction_detail($id)
    {
        $query = $this->db->query("SELECT 	id_transaksi,id_member,nama_promo,nilai_promo,ongkir,total,status,resi,id_kurir,tgl_pesan,tipe,bukti_transfer,
                                            (SELECT nama_kurir FROM kurir WHERE id_kurir=transaksi.id_kurir) AS kurir,
                                            (SELECT IF((transaksi.tipe=1), (SELECT nama FROM member WHERE id_member=transaksi.id_member_to), 0)) AS member_to,
                                            (SELECT nama FROM member WHERE id_member=transaksi.id_member) AS member,
                                            (SELECT no_hp FROM member WHERE id_member=transaksi.id_member) AS no_hp
                                    FROM transaksi WHERE id_transaksi='$id'")->row();

        return $query;
    }

    function transaction_add($im, $ip, $date, $ongkir, $tipe)
    {
        if (empty($date)) {
            date_default_timezone_set('Asia/Jakarta');
            $now     = date("Y-m-d h:i:s");
        } else {
            $now = $date;
        }

        $pr     = $this->db->query("SELECT nama_promo,nilai FROM promo WHERE id_promo='$ip'")->row();
        $np     = $pr->nama_promo;
        $npr    = $pr->nilai;
        $tot     = $this->cart->total();

        $q2     = $this->db->query("	SELECT	id_upline AS idu,
												(SELECT nilai FROM member_level WHERE id_member_level=member.level) AS mv,
												(SELECT nilai FROM produk WHERE id_produk='$ip') AS pv
										FROM member
										WHERE id_member='$im'")->row();
        $idu     = $q2->idu;
        $mv        = $q2->mv;

        if (!empty($idu)) {

            $q3 = $this->db->query("	SELECT	COUNT(id_transaksi) AS tr
										FROM transaksi
										WHERE id_member='$im'")->row();
            $tr = $q3->tr;
            if ($tr > 0) {

                if ($mv >= 1) {
                    $com    = ((5 / 100) * $tot) * $mv;
                } else {
                    $com = 0;
                }
                $st = 1;
            } else {
                if ($mv >= 1) {
                    $com    = ((10 / 100) * $tot) * $mv;
                } else {
                    $com = 0;
                }
                $st = 4;
            }

            // Tambah nilai komisi di table member
            // $this->db->query("	UPDATE member m1 SET 	m1.commission = m1.commission + $com,
            // 											m1.commission_update='$now'
            // 					WHERE m1.id_member=(SELECT m2.id_upline FROM (SELECT * FROM member) AS m2 WHERE m2.id_member='$im')");
        } else {
            $com     = 0;
            $st     = 1;
        }

        // die(var_dump($pv));
        $data     = array(
            'id_member'         => $im,
            'nama_promo'          => $np,
            'nilai_promo'          => $npr,
            'ongkir'              => $ongkir,
            'total'              => $tot,
            'commission'          => $com,
            'tgl_pesan'          => $now,
            'tgl_bayar'          => $now,
            'tipe'              => $tipe,
            'status'              => $st
        );

        return $data;
    }

    function get_commission($date)
    {
        $d      = date_parse_from_format("Y-m-d", date($date));
        $bulan  = $d["month"];
        $tahun  = $d["year"];
        $mitra  = "WHERE transaksi.id_member IN (SELECT m2.id_member FROM member m2 WHERE id_upline=m1.id_member)";

        if (empty($date)) {
            $period     = "MONTH(transaksi.tgl_pesan) = MONTH(CURRENT_DATE()) AND YEAR(transaksi.tgl_pesan) = YEAR(CURRENT_DATE())";
        } else {
            $period     = "MONTH(transaksi.tgl_pesan) = $bulan AND YEAR(transaksi.tgl_pesan) = $tahun";
        }

        $where          = "$mitra AND $period";
        $where_m        = "WHERE transaksi.id_member=m1.id_member AND $period";
        $where_t        = "WHERE status IN (3,4) AND transaksi.id_member=m1.id_member AND $period";
        $where_pvt_bp   = "WHERE transaksi.id_member IN (SELECT id_member FROM member m2 WHERE m2.id_upline=m1.id_member) OR transaksi.id_member IN (SELECT id_member FROM member m3 WHERE m3.id_upline IN (SELECT id_member FROM member m2 WHERE m2.id_upline=m1.id_member)) AND $period";
        $where_pvt_bm   = "WHERE transaksi.id_member_to IN (SELECT id_member FROM member m2 WHERE m2.id_upline=m1.id_member) OR transaksi.id_member_to IN (SELECT id_member FROM member m3 WHERE m3.id_upline IN (SELECT id_member FROM member m2 WHERE m2.id_upline=m1.id_member)) AND $period";

        $query = "SELECT m1.id_member,m1.nama,m1.level,
                        (SELECT SUM(commission) FROM transaksi $where AND status = 3) AS tct,
                        (SELECT SUM(commission) FROM transaksi $where AND status = 4) AS tcg,
                        (SELECT SUM(total) FROM transaksi $where AND status IN (3,4)) AS tot,
                        (SELECT SUM(pv) FROM transaksi $where_m AND tipe=0 AND status IN (3,4)) AS pvm,
                        (SELECT SUM(pv) FROM transaksi $where_pvt_bp AND status IN (3,4) AND tipe=0) AS pvt_bp,
                        (SELECT SUM(pv) FROM transaksi $where_pvt_bm AND status IN (3,4) AND tipe=1) AS pvt_bm,
                        (SELECT SUM(total) FROM transaksi $where_t) AS trans,
                        (SELECT IF((SUM(total))>=(SELECT smp FROM member_level WHERE id_member_level=m1.level), 'info', 'danger') FROM transaksi $where_t) AS color
                FROM member m1
                WHERE
                (SELECT SUM(commission) FROM transaksi $where AND status = 3) OR
                (SELECT SUM(commission) FROM transaksi $where AND status = 4) OR
                (SELECT SUM(total) FROM transaksi $where AND status IN (3,4)) OR
                (SELECT SUM(pv) FROM transaksi $where_m AND tipe=0 AND status IN (3,4)) OR
                (SELECT SUM(pv) FROM transaksi $where_pvt_bp AND status IN (3,4) AND tipe=0) OR
                (SELECT SUM(pv) FROM transaksi $where_pvt_bm AND status IN (3,4) AND tipe=1)
                IS NOT NULL

                ORDER BY tot DESC, pvt_bp + pvt_bm DESC, pvm DESC, trans DESC, nama ASC";

        return $query;
    }

    function get_commission_detail($id)
    {
        $query = "SELECT    id_transaksi,id_member,total,commission,tgl_pesan,product_quantity,pv,
                            (SELECT nilai FROM member_level WHERE id_member_level=(SELECT level FROM member WHERE member.id_member=transaksi.id_member)) AS mv,
                            (SELECT nama_level FROM member_level WHERE id_member_level=(SELECT level FROM member WHERE member.id_member=transaksi.id_member)) AS nama_level,
                            (SELECT nilai FROM produk WHERE id_produk=transaksi.id_produk) AS pp,
                            (SELECT nama FROM member WHERE id_member=(SELECT id_member FROM member WHERE id_member=transaksi.id_member)) AS member,
                            (SELECT nama_produk FROM produk WHERE id_produk=transaksi.id_produk) AS produk
                    FROM transaksi
                    WHERE commission!=0
                    AND id_member IN (SELECT id_member FROM member WHERE id_upline='$id')";

        return $query;
    }

    function get_location_5()
    {
        $query = $this->db->query("SELECT * FROM location
                                            WHERE CHAR_LENGTH(id_location)=5
                                            ORDER BY location_name ASC")->result();

        return $query;
    }

    function get_all_event()
    {
        $query = $this->db->query("SELECT   id_event_schedule,event_name,id_location,lat,lng,address,note,date_start,date_end,status,tipe,
                                            (SELECT location_name FROM location WHERE id_location=event_schedule.id_location) AS city
                                            FROM event_schedule
                                            ORDER BY date_start DESC, date_end DESC")->result();

        return $query;
    }

    function get_product_purchase_cart($idm, $idp)
    {
        $query =  $this->db->query("SELECT  id_produk,nama_produk,satuan,nilai,img_1,img_2,keterangan,waktu_input,status,berat,
                                            (SELECT harga FROM produk_harga WHERE id_produk=produk.id_produk AND produk_harga.id_member_level=(SELECT level FROM member WHERE member.id_member='$idm')) AS harga,
                                            ((SELECT SUM(stock_update) FROM produk_stok WHERE id_produk=produk.id_produk)) AS stok,
                                            (SELECT SUM(quantity) FROM transaksi_produk WHERE transaksi_produk.id_produk=produk.id_produk AND id_transaksi IN (SELECT id_transaksi FROM transaksi WHERE status IN (3,4))) AS stok_
                                        FROM produk
                                        WHERE produk.id_produk='$idp' AND produk.status=1")->row();
        return $query;
    }
}
