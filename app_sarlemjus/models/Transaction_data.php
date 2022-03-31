<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction_data extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function transaction_calculation($shipping_costs, $courier_name)
    {
        $member_id = $this->session->userdata('log_id');
        date_default_timezone_set('Asia/Jakarta');
        $now = date("Y-m-d h:i:s");
        $my = date("mY"); // month year

        $trans = $this->db->query("SELECT id FROM transaction WHERE member_id='$member_id'");
        $count = $trans->num_rows();

        $invoice_number = "TR$member_id$my" . ($count + 1) . "";

        $total = $this->cart->total();

        // $q3 = $this->db->query("	SELECT	COUNT(id_transaction) AS tr
        // 								FROM transaction
        // 								WHERE member_id='$im'")->row();
        // $tr = $q3->tr;
        if ($count > 0) {

            $q = $this->db->query("SELECT ml.discount
                                    FROM member m
                                    LEFT JOIN member_level ml ON m.level=ml.id
                                    WHERE m.id='$member_id'")->row();

            $discount = $q->discount;
            $discount_value = $this->get_member_discount_value();
        } else {

            $q = $this->db->query("SELECT id,discount
                                    FROM member_level
                                    WHERE min_trans < $total
                                    ORDER BY min_trans DESC
                                    LIMIT 1")->row();

            $discount = $q->discount;
            $discount_value = ($discount / 100) * $total;

            $this->db->query("UPDATE member SET level = '$q->id' WHERE member.id = '$member_id'"); // uodate level member by first transaction
        }

        $data = array(
            'invoice_number' => $invoice_number,
            'member_id' => $member_id,
            'total' => $total,
            'shipping_costs' => $shipping_costs,
            'courier_name' => $courier_name,
            'discount' => $discount,
            'discount_value' => $discount_value,
            'date_created' => $now,
            'type' => 0,
            'notif_admin' => 1,
            'status' => 0
        );

        return $data;
    }

    function get_member_discount()
    {
        if ($this->session->userdata('log_valid') == TRUE) {
            $member_id = $this->session->userdata('log_id');

            $q = $this->db->query("SELECT ml.discount FROM member m
                                LEFT JOIN member_level ml ON m.level=ml.id
                                WHERE m.id='$member_id'")->row();
            $discount = $q->discount;
        } else {
            $discount = 0;
        }

        if ($discount > 0) {
            $discount = $q->discount;
        } else {
            $total = $this->cart->total();

            $q = $this->db->query("SELECT id,discount
                                    FROM member_level
                                    WHERE min_trans < $total
                                    ORDER BY min_trans DESC
                                    LIMIT 1")->row();
            $discount = $q->discount;
        }

        return $discount;
    }

    function get_member_discount_value()
    {
        $total = $this->cart->total();

        if ($this->session->userdata('log_valid') == TRUE) {
            $member_id = $this->session->userdata('log_id');
            $q = $this->db->query("SELECT ml.discount FROM member m
                                LEFT JOIN member_level ml ON m.level=ml.id
                                WHERE m.id='$member_id'")->row();
            $discount = $q->discount;
        } else {
            $discount = 0;
        }
        if ($discount > 0) {
            $discount_value = ($discount / 100) * $total;
        } else {

            $q = $this->db->query("SELECT id,discount
                                    FROM member_level
                                    WHERE min_trans < $total
                                    ORDER BY min_trans DESC
                                    LIMIT 1")->row();
            $discount = $q->discount;
            $discount_value = ($discount / 100) * $total;
        }

        return $discount_value;
    }

    function get_invoice_detail($invoice_number)
    {
        return $this->db->query("SELECT t.id,t.invoice_number,t.member_id,m.name AS member_name,t.total,t.shipping_costs,t.courier_name,t.discount,t.discount_value,t.receipt,t.point,t.date_created,t.status,
                                        ms.home_detail,ms.village_name,ms.subdistrict_name,ms.district_name,ms.province_name,ms.postal_code,ml.discount
                                        FROM transaction t
                                        LEFT JOIN member m ON t.member_id=m.id
                                        LEFT JOIN member_shipping ms ON t.member_id=ms.member_id AND ms.status=1
                                        LEFT JOIN member_level ml ON m.level=ml.id
                                    WHERE t.invoice_number='$invoice_number'")->row();
    }

    function get_invoice_items($id)
    {
        return $this->db->query("SELECT tp.transaction_id,tp.product_id,tp.product_name,tp.price,tp.quantity
                                    FROM transaction_product tp
                                    LEFT JOIN transaction t ON tp.transaction_id=t.id
                                    LEFT JOIN member m ON t.member_id=m.id
                                    WHERE tp.transaction_id='$id'")->result();
    }

    function get_member_list()
    {
        return $this->db->query("SELECT id,name,phone FROM member")->result();
    }

    function get_product_by_id($id)
    {
        return $this->db->query("SELECT id,name,
                                        (SELECT SUM(stock_update) FROM product_stock WHERE id_product=product.id AND type=1) stock_plus,
                                        (SELECT SUM(stock_update) FROM product_stock WHERE id_product=product.id AND type=2) stock_min
                                    FROM product WHERE id='$id'")->row();
    }

    function get_product_stock_list()
    {
        return $this->db->query("SELECT id,brand,name,slug,description,category,bundled,status,
                                        (SELECT SUM(stock_update) FROM product_stock WHERE id_product=product.id AND type=1) stock_plus,
                                        (SELECT SUM(stock_update) FROM product_stock WHERE id_product=product.id AND type=2) stock_min
                                        FROM product ORDER BY product.name ASC")->result();
    }

    function get_stock_by_product_id($id)
    {
        return $this->db->query("SELECT ps.id,ps.id_product,ps.id_admin,ps.type,ps.stock_update,ps.time,ps.note,
                                        p.name AS product
                                        -- ,(SELECT product_unit.name FROM product_unit WHERE product_unit.id=p.unit) AS unit
                                    FROM product_stock ps
                                    LEFT JOIN product p ON ps.id_product=p.id
                                    WHERE ps.id_product='$id'
                                    ORDER BY time DESC")->result();
    }

    function get_product_stock_by_id($id)
    {
        $q = $this->db->query("SELECT ps.id,ps.id_product,ps.id_admin,ps.type,ps.stock_update,ps.time,ps.note,
                                        p.name AS product
                                        -- ,(SELECT product_unit.name FROM product_unit WHERE product_unit.id=p.unit) AS unit
                                    FROM product_stock ps
                                    LEFT JOIN product p ON ps.id_product=p.id
                                    WHERE ps.id_product='$id'
                                    ORDER BY time DESC")->row();

        $stock = $q->stock_plus - $q->stock_min;
        return $stock;
    }


    function get_transaction_by_product($id)
    {
        return "SELECT    t.id,t.invoice_number,t.member_id,t.total,t.date_created,t.date_paid,t.date_accepted,t.status,t.type,
                            m.name AS member_name
                    FROM transaction t
                    LEFT JOIN member m ON t.member_id=m.id
                    WHERE id_product='$id'";
    }

    // End stock

    function get_product_list()
    {
        return $this->db->query("SELECT id,name FROM product")->result();
    }

    function get_stat_sales_dashboard()
    {
        return $this->db->query("SELECT   SUM(total) AS tot,
                                            MONTH(tgl_pesan) AS bulan,
                                            YEAR(tgl_pesan) AS th
                                    FROM transaction
                                    WHERE YEAR(tgl_pesan)=YEAR(CURDATE()) AND status IN (3,4)
                                    GROUP BY bulan,th ORDER BY th ASC, bulan ASC")->result();
    }

    function get_transaction_stat()
    {
        return $this->db->query("SELECT   id,name,
                                            (SELECT COUNT(id) FROM member WHERE level=member_level.id) AS total
                                    FROM member_level
                                    ORDER BY id ASC")->result();
    }

    function get_top_buyer() // Admin Dashboards
    {
        return $this->db->query("SELECT   m.id,m.name,ml.name AS level,
                                            (SELECT SUM(t.total) FROM transaction t WHERE t.member_id=m.id) AS total
                                    FROM member m
                                    LEFT JOIN member_level ml ON m.level=ml.id
                                    ORDER BY total DESC
                                    LIMIT 5")->result();
    }

    function get_transaction_list()
    {
        return "SELECT  t.id,t.invoice_number,t.member_id,t.total,t.date_created,t.receipt,t.date_paid,t.date_accepted,t.status,t.shipping_costs,t.discount_value,t.type,
                        m.name AS member_name
                    FROM transaction t
                    LEFT JOIN member m ON t.member_id=m.id";
    }

    function get_transaction_list_by_member_id($id)
    {
        return $this->db->query("SELECT t.id,t.invoice_number,t.member_id,t.total,t.date_created,t.receipt,t.date_paid,t.date_accepted,t.status,t.shipping_costs,t.discount_value,
                                        m.name AS member_name
                                FROM transaction t
                                LEFT JOIN member m ON t.member_id=m.id
                                WHERE t.member_id='$id'
                                ORDER BY t.date_created DESC")->result();
    }

    function get_transaction_detail($id)
    {
        return $this->db->query("SELECT 	id_transaction,member_id,nama_promo,nilai_promo,ongkir,total,status,resi,id_kurir,tgl_pesan,tipe,bukti_transfer,
                                            (SELECT nama_kurir FROM kurir WHERE id_kurir=transaction.id_kurir) AS kurir,
                                            (SELECT IF((transaction.tipe=1), (SELECT nama FROM member WHERE member_id=transaction.member_id_to), 0)) AS member_to,
                                            (SELECT nama FROM member WHERE member_id=transaction.member_id) AS member,
                                            (SELECT no_hp FROM member WHERE member_id=transaction.member_id) AS no_hp
                                    FROM transaction WHERE id_transaction='$id'")->row();
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
												(SELECT nilai FROM member_level WHERE member_id_level=member.level) AS mv,
												(SELECT nilai FROM product WHERE id_product='$ip') AS pv
										FROM member
										WHERE member_id='$im'")->row();
        $idu     = $q2->idu;
        $mv        = $q2->mv;

        if (!empty($idu)) {

            $q3 = $this->db->query("	SELECT	COUNT(id_transaction) AS tr
										FROM transaction
										WHERE member_id='$im'")->row();
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
            // 					WHERE m1.member_id=(SELECT m2.id_upline FROM (SELECT * FROM member) AS m2 WHERE m2.member_id='$im')");
        } else {
            $com     = 0;
            $st     = 1;
        }

        // die(var_dump($pv));
        $data     = array(
            'member_id'         => $im,
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
        $mitra  = "WHERE transaction.member_id IN (SELECT m2.member_id FROM member m2 WHERE id_upline=m1.member_id)";

        if (empty($date)) {
            $period     = "MONTH(transaction.tgl_pesan) = MONTH(CURRENT_DATE()) AND YEAR(transaction.tgl_pesan) = YEAR(CURRENT_DATE())";
        } else {
            $period     = "MONTH(transaction.tgl_pesan) = $bulan AND YEAR(transaction.tgl_pesan) = $tahun";
        }

        $where          = "$mitra AND $period";
        $where_m        = "WHERE transaction.member_id=m1.member_id AND $period";
        $where_t        = "WHERE status IN (3,4) AND transaction.member_id=m1.member_id AND $period";
        $where_pvt_bp   = "WHERE transaction.member_id IN (SELECT member_id FROM member m2 WHERE m2.id_upline=m1.member_id) OR transaction.member_id IN (SELECT member_id FROM member m3 WHERE m3.id_upline IN (SELECT member_id FROM member m2 WHERE m2.id_upline=m1.member_id)) AND $period";
        $where_pvt_bm   = "WHERE transaction.member_id_to IN (SELECT member_id FROM member m2 WHERE m2.id_upline=m1.member_id) OR transaction.member_id_to IN (SELECT member_id FROM member m3 WHERE m3.id_upline IN (SELECT member_id FROM member m2 WHERE m2.id_upline=m1.member_id)) AND $period";

        $query = "SELECT m1.member_id,m1.nama,m1.level,
                        (SELECT SUM(commission) FROM transaction $where AND status = 3) AS tct,
                        (SELECT SUM(commission) FROM transaction $where AND status = 4) AS tcg,
                        (SELECT SUM(total) FROM transaction $where AND status IN (3,4)) AS tot,
                        (SELECT SUM(pv) FROM transaction $where_m AND tipe=0 AND status IN (3,4)) AS pvm,
                        (SELECT SUM(pv) FROM transaction $where_pvt_bp AND status IN (3,4) AND tipe=0) AS pvt_bp,
                        (SELECT SUM(pv) FROM transaction $where_pvt_bm AND status IN (3,4) AND tipe=1) AS pvt_bm,
                        (SELECT SUM(total) FROM transaction $where_t) AS trans,
                        (SELECT IF((SUM(total))>=(SELECT smp FROM member_level WHERE member_id_level=m1.level), 'info', 'danger') FROM transaction $where_t) AS color
                FROM member m1
                WHERE
                (SELECT SUM(commission) FROM transaction $where AND status = 3) OR
                (SELECT SUM(commission) FROM transaction $where AND status = 4) OR
                (SELECT SUM(total) FROM transaction $where AND status IN (3,4)) OR
                (SELECT SUM(pv) FROM transaction $where_m AND tipe=0 AND status IN (3,4)) OR
                (SELECT SUM(pv) FROM transaction $where_pvt_bp AND status IN (3,4) AND tipe=0) OR
                (SELECT SUM(pv) FROM transaction $where_pvt_bm AND status IN (3,4) AND tipe=1)
                IS NOT NULL

                ORDER BY tot DESC, pvt_bp + pvt_bm DESC, pvm DESC, trans DESC, nama ASC";

        return $query;
    }

    function get_commission_detail($id)
    {
        $query = "SELECT    id_transaction,member_id,total,commission,tgl_pesan,product_quantity,pv,
                            (SELECT nilai FROM member_level WHERE member_id_level=(SELECT level FROM member WHERE member.member_id=transaction.member_id)) AS mv,
                            (SELECT nama_level FROM member_level WHERE member_id_level=(SELECT level FROM member WHERE member.member_id=transaction.member_id)) AS nama_level,
                            (SELECT nilai FROM product WHERE id_product=transaction.id_product) AS pp,
                            (SELECT nama FROM member WHERE member_id=(SELECT member_id FROM member WHERE member_id=transaction.member_id)) AS member,
                            (SELECT name FROM product WHERE id_product=transaction.id_product) AS product
                    FROM transaction
                    WHERE commission!=0
                    AND member_id IN (SELECT member_id FROM member WHERE id_upline='$id')";

        return $query;
    }

    function get_location_5()
    {
        return $this->db->query("SELECT * FROM location
                                            WHERE CHAR_LENGTH(id_location)=5
                                            ORDER BY location_name ASC")->result();
    }

    function get_all_event()
    {
        return $this->db->query("SELECT   id_event_schedule,event_name,id_location,lat,lng,address,note,date_start,date_end,status,tipe,
                                            (SELECT location_name FROM location WHERE id_location=event_schedule.id_location) AS city
                                            FROM event_schedule
                                            ORDER BY date_start DESC, date_end DESC")->result();
    }

    function get_product_purchase_cart($qty, $idp)
    {
        return  $this->db->query("SELECT      p.id,brand,p.name,slug,description,category,point,free_delivery,weight,length,width,height,p.status,p.selling_price,
                                                (SELECT price FROM product_price WHERE id_product=p.id) AS price,
                                                (SELECT SUM(psp.stock_update) FROM product_stock psp WHERE psp.id_product=p.id AND psp.type=1) AS stock_plus,
                                                (SELECT SUM(psp.stock_update) FROM product_stock psp WHERE psp.id_product=p.id AND psp.type!=1) AS stock_min,
                                                pc.name AS category_name,
                                                pb.name AS brand_name,
                                                (SELECT image FROM product_image WHERE id_product=p.id LIMIT 1) AS image
                                        FROM product p
                                        LEFT JOIN product_category pc ON p.category=pc.id
                                        LEFT JOIN product_brand pb ON p.brand=pb.id
                                        WHERE p.id='$idp' AND p.status=1")->row();
    }

    function get_member_shipping_default($id)
    {
        return $this->db->query("SELECT id,member_id,recipients_name,recipients_phone,province_id,district_id,subdistrict_id,province_name,district_name,subdistrict_name,village_name,home_detail,postal_code,status,date_created
                                    FROM member_shipping
                                    WHERE member_id='$id' AND status=1")->row();
    }

    function get_member_shipping_by_id($member_id, $idsa)
    {
        return $this->db->query("SELECT id,member_id,recipients_name,recipients_phone,province_id,district_id,subdistrict_id,province_name,district_name,subdistrict_name,village_name,home_detail,postal_code,status,date_created
                                    FROM member_shipping
                                    WHERE member_id='$member_id'
                                    AND id='$idsa'")->row();
    }
}
