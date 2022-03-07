<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('log_valid') == FALSE) {
            $this->session->set_flashdata("report", "<div><p>Anda harus login terlebih dahulu...</p></div>");
            redirect(base_url('login'));
        }
        $this->load->model('Member_model');
        require_once dirname(__DIR__) . '/libraries/Midtrans/Midtrans.php';
    }

    // Kurang : ketika update password harus memasukkan password lama

    function index()
    {
        $data['page']   = 'dashboard';
        $data['title']  = 'Dashboard Member';
        $id             = $this->session->userdata('log_id');

        $data['stat']   = $this->Member_model->get_stat($id);

        // $data['member'] = $this->Member_model->get_team_dashboard($id);

        $this->load->view('member/dashboard', $data);
    }

    function products()
    {
        $data['page']   = 'product';
        $data['title']  = 'Semua Produk';

        $data['produk'] = $this->db->query("SELECT  id_produk,slug,nama_produk,harga,nilai,img_1,img_2,keterangan,waktu_input,status,
                                                    (SELECT GROUP_CONCAT(harga SEPARATOR ', ') FROM produk_harga WHERE id_produk=produk.id_produk) as harga_member
                                            FROM produk")->result();

        $this->load->view('member/product', $data);
    }

    // function product_stock()
    function product()
    {
        $data['page']   = 'product';
        $data['title']  = 'Stok Produk Saya';

        $id = $this->session->userdata('log_id');

        $data['produk'] = $this->Member_model->get_product($id);

        $this->load->view('member/product_stock', $data);
    }

    function team()
    {
        $data['page']   = 'team';
        $data['title']  = 'Team Saya';

        $id             = $this->session->userdata('log_id');

        $data['level']  = $this->db->query("SELECT id_member_level,nama_level FROM member_level ORDER BY nilai DESC")->result();
        $data['lokasi'] = $this->db->query("SELECT * FROM location
											WHERE CHAR_LENGTH(id_location)=5
											ORDER BY location_name ASC")->result();

        $data['bank']   = $this->db->query("SELECT * FROM bank ORDER BY kode_bank ASC")->result();
        $data['stat']   = $this->Member_model->get_team_stat($id);

        $data['member'] = $this->Member_model->get_team($id);

        $this->load->view('member/team', $data);
    }

    function transaction($x)
    {
        $data['page']           = 'transaction';
        $data['title']          = 'Daftar Transaksi';
        $data['sel_product']    = $this->db->query("SELECT id_produk,nama_produk FROM produk")->result();
        $data['sel_member']     = $this->db->query("SELECT id_member,nama,no_hp FROM member ORDER BY nama ASC")->result();

        $id     = $this->session->userdata('log_id');
        $date   = $this->input->post('date');

        $data['stat'] = $this->Member_model->get_transaction_stat($id, $date);

        $q = $this->Member_model->get_transaction_list($id, $date);
        if (!empty($date)) {
            $data['date']   = date($this->input->post('date'));
        }

        if ($x == "all") {
            $data['title']          = 'Daftar Transaksi';
            $data['transaction']    = $this->db->query("$q ORDER BY tgl_pesan DESC, status ASC")->result();
        } elseif ($x == "purchase") {
            $data['title']          = 'Daftar Transaksi Pembelian';
            $data['transaction']    = $this->db->query("$q AND tipe=0 ORDER BY tgl_pesan DESC, status ASC")->result();
        } elseif ($x == "sales") {
            $data['title']          = 'Daftar Transaksi Penjualan';
            $data['transaction']    = $this->db->query("$q AND tipe=1 ORDER BY tgl_pesan DESC, status ASC")->result();
        }

        $this->load->view('member/transaction/list', $data);
    }

    function add_purchase()
    {
        $data['page']   = 'transaction';
        $data['title']  = 'Transaksi Pembelian';
        // $id_member              = $this->session->userdata('log_id');
        // $data['sel_member']     = $this->db->query("SELECT id_member,nama,no_hp FROM member ORDER BY nama ASC")->result();
        // $data['sel_product']    = $this->db->query("SELECT id_produk, nama_produk FROM produk")->result();
        // $data['sel_promo']      = $this->db->query("SELECT id_promo,nama_promo,nilai FROM promo")->result();

        // $data['ongkir']     = 0;

        // $data['title']      = 'Transaksi Pembelian';
        // $data['product']    = $this->Member_model->get_product_purchase($id_member);
        // $this->load->view('member/transaction/purchase', $data);

        date_default_timezone_set('Asia/Jakarta');

        $date = date("Y-m-d H:i:s");

        $id_member    = $this->session->userdata('log_id');
        $date         = new DateTime($date);
        $date         = $date->format(DateTime::ATOM);

        $data['date']       = $date;
        $data['id_member']  = $id_member;
        $data['ongkir']     = 0;

        $data['product']                    = $this->Member_model->get_product_purchase($id_member);
        $data['member_shipping_default']    = $this->Member_model->get_member_shipping_default($id_member);
        $data['member_shipping_list']       = $this->Member_model->get_member_shipping($id_member);
        $this->load->view('member/transaction/purchase', $data);
    }

    function cart()
    {
        $data['page']   = 'transaction';
        $data['title']  = 'Keranjang Pembelian';

        $this->load->view('member/transaction/cart', $data);
    }

    function checkout()
    {
        $data['page']   = 'transaction';
        $data['title']  = 'Keranjang Pembelian';

        date_default_timezone_set('Asia/Jakarta');

        $date = date("Y-m-d H:i:s");

        $id_member    = $this->session->userdata('log_id');
        $date         = new DateTime($date);
        $date         = $date->format(DateTime::ATOM);

        $data['date']               = $date;
        $data['id_member']          = $id_member;

        $this->load->view('member/transaction/checkout', $data);
    }

    function act_checkout()
    {
        // echo "okkk";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sandbox.ipaymu.com/payment',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('key' => 'C2FDD0CD-4555-4F01-B5C0-9A0531BBE0FE', 'action' => 'payment', 'product[]' => 'Baju Kemeja', 'product[]' => 'Baju Kaos Polos', 'price[]' => '100000', 'price[]' => '50000', 'quantity[]' => '1', 'quantity[]' => '5', 'comments[]' => 'Keterangan Produk 1', 'comments[]' => 'Keterangan Produk 2', 'ureturn' => 'http://websiteanda.com/return.php?q=return', 'unotify' => 'https://webhook.site/7eb8cb45-b340-4c8d-aaab-277a934b4fad', 'ucancel' => 'http://websiteanda.com/cancel.php', 'format' => 'json', 'weight' => '1', 'dimensi' => '1:2:1', 'postal_code' => '10110', 'address' => 'Jalan raya Kuta, No. 88 R, Badung, Bali', 'auto_redirect' => '10', 'expired' => '24', 'buyer_name' => 'Alex', 'buyer_phone' => '08123456789', 'buyer_email' => 'buyer@mail.com', 'cod_province' => 'bali', 'cod_city' => 'gianyar', 'reference_id' => 'ID1234'),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    function cart_add()
    {
        $id_member  = $this->session->userdata('log_id');
        $id_produk  = $this->input->post('id_produk');
        $q = $this->Member_model->get_product_purchase_cart($id_member, $id_produk);

        $data = array(
            'id'    => $id_produk,
            'qty'   => $this->input->post('quantity'),
            'price' => $q->harga,
            'name'  => $q->nama_produk,
            'weight'  => $q->berat,
            'options' => array(
                'image' => $q->img_1,
                'note' => $q->keterangan
            )
        );
        $this->cart->insert($data);
        echo $this->cart_show(0, 0); //tampilkan cart setelah added
    }

    function update_qty_cart()
    {
        $qty        = $this->input->post('qty');
        $id_produk  = $this->input->post('id_produk');
        $data = array(
            'rowid' => $this->input->post('rowid'),
            'qty' => $qty
        );

        $id_member  = $this->session->userdata('log_id');
        $q          = $this->Member_model->get_product_purchase_cart($id_member, $id_produk);
        $stock      = $q->stok - $q->stok_;
        if ($stock < $qty) {
            // $this->alert('warning', 'Gagal, Anda melebih stok yang ada...');
            echo '<div><script>alert("Gagal, Anda melebih stok yang ada");</script></div>';
        } else {
            $this->cart->update($data);
        }
        echo $this->cart_show(0, 0); //tampilkan cart setelah added
    }

    function cek_stok()
    {
        $data = array();
        foreach ($this->cart->contents() as $value) {
            $datatmp = $this->M_product->product_by_id($value['id'])->row();
            if ($datatmp->quantityStock < $value['qty']) {
                array_push($data, array(
                    "id_produk" => $value['id'],
                    "status" => "error",
                    "stok" => $datatmp->quantityStock . " < " . $value['qty'],
                    "rowiderror" => $value['rowid'],
                    "realstock" => $datatmp->quantityStock,
                    "name" => $value['name']
                ));
            } else {
                array_push($data, array(
                    "id_produk" => $value['id'],
                    "status" => "ok  ",
                    "stok" => $datatmp->quantityStock . " < " . $value['qty'],
                    "rowiderror" => $value['rowid'],
                    "realstock" => $datatmp->quantityStock,
                    "name" => $value['name']
                ));
            }
        }
        foreach ($data as $value) {
            if ($value['status'] == "error") {
                $this->update_real_stock($value['rowiderror'], $value['realstock']);
                echo '<script>swal("' . $value['name'] . '", "Gagal ditambahkan ke keranjang belanja!. melebihi batas stok (' . $value['stok'] . ')", "error");</script>';
            } else {
                echo '<script>swal({
                                title: "",
                                text: "' . $value['name'] . ' ditambahkan ke keranjang belanja !",
                                type: "success",
                                showCancelButton: true,
                                confirmButtonColor: "#008000",
                                confirmButtonText: "Lihat Keranjang",
                                showLoaderOnConfirm: true,
                                closeOnConfirm: false,
                                closeOnCancel: true,
                                showCancelButton: true
                            },
                                    function (isConfirm) {
                                        if (isConfirm) {
                                            window.location.href="' . base_url('pages/cart/') . '";
                                        }
                                    });</script>';
            }
        }
    }

    function update_real_stock($rowid, $qty)
    {
        $data = [];
        foreach ($this->cart->contents() as $key) {
            $tmp['rowid'] = $rowid;
            $tmp['qty'] = $qty;
            array_push($data, $tmp);
        }
        $this->cart->update($data);
    }


    function cart_show($id_promo, $id_kurir)
    {
        $id_member  = $this->session->userdata('log_id');

        $output     = '';
        $no         = 0;
        $tot_qty    = array_sum(array_column($this->cart->contents(), 'qty'));

        $member_shipping_default    = $this->Member_model->get_member_shipping_default($id_member);
        // $member_shipping_list       = $this->Member_model->get_member_shipping($id_member);

        // $tot_weight    = array_sum(array_column($this->cart->contents(), 'weight'));
        $tot_berat  = [];
        $str        = "'";
        foreach ($this->cart->contents() as $items) {
            $no++;

            $id_produk  =  $items['id'];
            $id_member  = $this->session->userdata('log_id');
            $q = $this->Member_model->get_product_purchase_cart($id_member, $id_produk);

            $stock = $q->stok - $q->stok_;

            $output .= '<tr>
                            <td title="' . $items['name'] . '">' . substr($items['name'], 0, 20) . '</td>
                            <td>' . number_format($items['price'], 0, '.', '.') . '</td>
					        <td class="text-center"><input id="qty' . $items['rowid'] . '" onchange="updateQty(' . $str . '' . $items['rowid'] . '' . $str . ',' . $str . '' . $items['id'] . '' . $str . ');" class="form-control form-control-sm" type="number" name="num-product' . $no++ . '" value="' . $items['qty'] . '" min="1" max="' . $stock . '"></td>
                            <td style="text-align:right;">' . number_format($items['subtotal'], 0, '.', '.') . '</td>
                            <td><a href="#" id="' . $items['rowid'] . '" class="hapus_cart table-action table-action-delete"><i class="fas fa-trash"></i></a></td>
                        </tr>';

            $tot_berat[] = $items['qty'] * $items['weight'];
        }

        $output .= '<tr>
                        <th colspan="2" style="text-align:right;">Subtotal :</th>
                        <th colspan="2" style="text-align:right;">' . 'Rp ' . number_format($this->cart->total(), 0, '.', '.') . '</th>
                    </tr>';

        if (!empty($member_shipping_default)) {

            $output .= '<tr id="member_shipping_address_selected" style="border:1px;">
                            <th colspan="4">
                            <label class="form-control-label" for="alamat"> Alamat Penerima</label>
                            <h4 class="mb-0">' . $member_shipping_default->nama_penerima . '';

            if ($member_shipping_default->status == 1) {
                $output .= '<font color="red"><small> [Utama]</small></font>';
            }

            $output .= '</h4>
                        <small>' . $member_shipping_default->no_hp_penerima . '</small>
                        <br>
                        <textarea class="form-control" style="padding: 0px; outline: none !important; border:0px ; font-size: 12px;" disabled>' . $member_shipping_default->full_address . ' - ' . $member_shipping_default->postal_code . '</textarea>
                        
                        <br>
                        <input type="hidden" name="id_subdistrict" id="id_subdistrict" value="' . $member_shipping_default->id_subdistrict . '">
                        <a data-toggle="modal" href="#modal_shipping_address" title="Ganti Alamat Pengiriman" class="btn btn-sm btn-default">Ganti Alamat</a>
                        </th>
                </tr>
                ';

            $output .= '<tr>
                            <th colspan="3">
                            <label class="form-control-label" for="id_kurir">Kurir</label>
                            <select class="form-control form-control-sm" id="kurir" onchange="set_kurir()" required="">
                                <option value=""> Pilih Kurir</option>
                                <option value="tiki">Tiki - Titipan Kilat</option>
                                <option value="sicepat">Sicepat</option>
                                <option value="jne">JNE - Jalur Nugraha Ekakurir</option>
                                <option value="pos">POS Indonesia</option>
                                <option value="wahana">Wahana Prestasi Logistik</option>
                                <option value="jnt">JNT</option>
                                <option value="jet">JET Express</option>
                                <option value="ninja">Ninja Express</option>
                                <option value="lion">Lion Parcel</option>
                                <option value="anteraja">Anteraja</option>
                            </select>
                      </tr>
                      <tr><th colspan="3" id="datakurir"></th></tr>';
        } else {

            $output .= '<tr>
                            <th colspan="3" style="text-align:right;"><small><font color="red" >Anda belum mengatur alamat pengiriman</font></small></th>
                            <th style="text-align:right;">
                                <a data-toggle="modal" href="#modal_shipping_address" title="Tambah Alamat Pengiriman" class="btn btn-sm btn-default"><small>Tambah Alamat</small></a>
                            </th>
                        </tr>';
        }

        if ($id_promo == 0) {
            $nama_promo = "-";
            $nilai      = 0;

            if ($tot_qty >= 100) {

                $output .= '<tr>
                                <th colspan="3">
                                    <div id="div_promo" class="form-group">
                                        <label class="form-control-label" for="kode_promo">Kode Promo</label>
                                        <input type="text" onkeyup="check_promo()" id="kode_promo" class="form-control form-control-sm" placeholder="Masukkan Kode Promo yang anda miliki" required="">
                                        <div id="feedback_promo" class="invalid-feedback"></div>
                                        <br>
                                        <input type="hidden" name="nilai_promo" id="nilai_promo" value="0">
                                    </div>
                                </th>
                            </tr>';
            }
        } else {

            $q             = $this->db->query("SELECT nama_promo,nilai FROM promo WHERE id_promo='$id_promo'")->row();
            $nama_promo    = $q->nama_promo;
            $nilai         = $q->nilai;
            $output     .= '<tr>
                                <th colspan="2" style="text-align:right;"><font color="orange">
                                <input type="hidden" name="id_promo" id="id_promo" value="' . $id_promo . '">' . $nama_promo . ' :</font></th>
                                <th colspan="2" style="text-align:right;"><font color="orange">' . '- Rp ' . number_format($nilai, 0, '.', '.') . '<br><a href="javascript:;" onclick="cartshow2()">Ganti</a></font></th>
                            </tr>';
        }

        $total_cart     = $this->cart->total();
        $tot_berat      = array_sum($tot_berat);

        // if ($id_kurir == 0) {
        //     $k = $this->db->query("SELECT harga_kg FROM kurir LIMIT 1")->row();
        // } else {
        //     $k = $this->db->query("SELECT harga_kg FROM kurir WHERE id_kurir='$id_kurir'")->row();
        // }

        // $per_gram       = $k->harga_kg;
        // $total_ongkir   = ($tot_berat / 1000) * $per_gram;
        // $total          = $total_cart + $total_ongkir;
        $total          = $total_cart;

        $output .= '<tr>
						<th colspan="2" style="text-align:right;"><font color="red">Total Tagihan :</font></th>
						<th colspan="2" style="text-align:right;">
                            <font color="red" id="total_tagihan">' . 'Rp ' . number_format($total - $nilai, 0, '.', '.') . '</font>
                            <input type="hidden" name="tot_berat" id="tot_berat" value="' . $tot_berat . '">
                            <input type="hidden" name="total_ongkir" id="total_ongkir">
                            <input type="hidden" name="shipingdesc" id="shipingdesc">
                            <input type="hidden" name="nilai_subtotal" id="nilai_subtotal" value="' . $total_cart . '">
                        </th>
					</tr>';

        if ($this->cart->total() == 0) {
            $output .= '<tr>
							<td colspan="5">
							<button type="submit" id="submit" form="save" class="btn btn-success btn-lg btn-block" disabled>Simpan <i class="fa fa-arrow-right"></i></button>
						</tr>';
        } else {
            $output .= '<tr>
							<td colspan="5">
							<button type="submit" id="submit" form="save" class="btn btn-success btn-lg btn-block">Simpan <i class="fa fa-arrow-right"></i></button>
						</tr>';
        }

        return $output;
    }


    function get_weight()
    {
        foreach ($this->cart->contents() as $items) {
            $qty[] = $items['qty'];
            $tot_berat[]  = $items['qty'] * $items['weight'];
            $total_cart     = $this->cart->total();
            $tot_qty        = array_sum($qty);
            $tot_berat      = (array_sum($tot_berat) / 1000);
        }
        echo $tot_berat;
    }

    function select_promo($id_promo)
    {
        $output = '';

        if ($id_promo == 0) {
            $output     .= '<div id="div_promo" class="form-group">
                                <label class="form-control-label" for="exampleFormControlSelect1">Kode Promo</label>
                                    <input type="text" onkeyup="check_promo()" id="kode_promo" class="form-control " placeholder="Kode Promo" required="">
                                <div id="feedback_promo" class="invalid-feedback"></div>
                            </div>';
        } else {
            $q             = $this->db->query("SELECT nama_promo,nilai FROM promo WHERE id_promo='$id_promo'")->row();
            $nama_promo    = $q->nama_promo;
            $nilai         = $q->nilai;
            $output     .= '<div class="form-group">
                                <label class="form-control-label" for="exampleFormControlSelect1">Kode Promo</label>
                                <br>
                                <tr>
                                    <th colspan="2" style="text-align:right;"><font color="green">' . $nama_promo . ' :</font></th>
                                    <th colspan="2" style="text-align:right;"><font color="green">' . '- Rp ' . number_format($nilai, 0, '.', '.') . '<br><a href="javascript:;" onclick="reset_promo()">Ganti</a></font></th>
                                </tr>
                            </div>';
        }

        echo $output;
    }

    function cart_load()
    {
        echo $this->cart_show(0, 0);
    }

    public function check($x, $kode_promo)
    {
        $id_member    = $this->session->userdata('log_id');

        if ($x == 'promo') {
            $q = $this->db->query("SELECT level FROM member WHERE id_member='$id_member'")->row();
            $lv = $q->level;
            $data = $this->db->query("SELECT    id_promo,
                                                (SELECT nama_promo FROM promo WHERE id_promo=promo_level.id_promo) AS nama_promo,
                                                (SELECT nilai FROM promo WHERE id_promo=promo_level.id_promo) AS nilai
                                        FROM promo_level
                                        WHERE id_promo=(SELECT id_promo FROM promo WHERE promo.kode_promo = '$kode_promo') AND status=1 AND id_member_level='$lv'")->row();
            echo json_encode($data);
        } else { }
    }

    function load_qty_cart()
    {
        $newarray = array();
        foreach ($this->cart->contents() as $key) {
            $tmp['qty'] = $key['qty'];
            array_push($newarray, $tmp);
        }
        echo array_sum(array_column($newarray, 'qty'));
    }

    function load_list_cart()
    {
        $list = '';
        // $list .= '';
        foreach ($this->cart->contents() as $items) {
            $list .= '
            <span href="#!" class="list-group-item list-group-item-action">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img alt="Image placeholder" src="' . base_url() . 'public/back/produk/' . $items['options']['image'] . '" class="avatar rounded-circle">
                    </div>
                    <div class="col ml--2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0 text-sm">' . $items['name'] . '</h4>
                            </div>
                        </div>
                        <p class="text-sm mb-0">Rp ' . number_format($items['price'], 0, '.', '.') . ' x ' . $items['qty'] . '</p>
                    </div>
                </div>
            </span>';
        }
        $list .= '<div class="px-3 py-3 float-right">'
            . '<h6 class="text-sm text-muted m-0 text-center">Total: <strong class="text-primary">' . 'Rp ' . number_format($this->cart->total(), 0, '.', '.') . '</strong></h6>'
            . '</div>';
        echo $list;
    }

    function load_shipping_address($idsa)
    {
        $id_member  = $this->session->userdata('log_id');
        $q          = $this->Member_model->get_member_shipping_by_id($id_member, $idsa);
        $data       = '';

        $data .= '
        <th colspan="4" style="text-align:right;"><h4 class="mb-0">' . $q->nama_penerima . '';
        if ($q->status == 1) {
            $data .= '<font color="red"><small> [Utama]</small></font>';
        }

        $data .= '</h4>
                        <small>' . $q->no_hp_penerima . '</small>
                        <br>
                        <textarea class="form-control" style="padding: 0px; outline: none !important; border:0px ; font-size: 12px;" disabled>' . $q->full_address . ' - ' . $q->postal_code . '</textarea>
                        <br>
                        <input type="hidden" name="id_subdistrict" id="id_subdistrict" value="' . $q->id_subdistrict . '">
                        <a data-toggle="modal" href="#modal_shipping_address" title="Ganti Alamat Pengiriman" class="btn btn-sm btn-default">Ganti Alamat</a>
                        </th>';
        echo $data;
    }

    function cart_del()
    {
        $data = array(
            'rowid' => $this->input->post('row_id'),
            'qty' => 0,
        );
        $this->cart->update($data);
        echo $this->cart_show(0, 0);
    }


    // SALES
    function add_sales()
    {
        $id_member = $this->session->userdata('log_id');

        $data['page']           = 'transaction';
        $data['sel_member']     = $this->db->query("SELECT id_member,nama,no_hp FROM member WHERE id_member!='$id_member' ORDER BY nama ASC")->result();
        date_default_timezone_set('Asia/Jakarta');

        $date         = date("Y-m-d H:i:s");
        $id_member_to = $this->input->post('id_member_to');
        $date         = new DateTime($date);
        $date         = $date->format(DateTime::ATOM);

        $data['date']       = $date;
        $data['id_member']  = $id_member;
        if (!empty($id_member_to)) {
            $data['id_member_to']  = $id_member_to;
        } else {
            $data['id_member_to']  = 0;
        }
        $stock_plus_buy         = "SELECT SUM(quantity) AS q FROM transaksi_produk WHERE id_produk=produk.id_produk AND id_transaksi IN (SELECT id_transaksi FROM transaksi WHERE status IN (3,4) AND id_member='$id_member' AND tipe=0)";
        $stock_plus_buy_member  = "SELECT SUM(quantity) AS q FROM transaksi_produk WHERE id_produk=produk.id_produk AND id_transaksi IN (SELECT id_transaksi FROM transaksi WHERE status IN (3,4) AND id_member_to='$id_member' AND tipe=1)";

        $stock_min_sell_member  = "SELECT SUM(quantity) AS q FROM transaksi_produk WHERE id_produk=produk.id_produk AND id_transaksi IN (SELECT id_transaksi FROM transaksi WHERE status IN (3,4) AND id_member='$id_member' AND tipe=1)";
        $stock_min_broken       = "SELECT SUM(quantity) AS q FROM transaksi_produk WHERE id_produk=produk.id_produk AND id_member='$id_member'";

        $q = "	SELECT 	id_produk,nama_produk,satuan,nilai,img_1,img_2,keterangan,waktu_input,status,
							(SELECT harga FROM produk_harga WHERE id_produk=produk.id_produk AND produk_harga.id_member_level=(SELECT level FROM member WHERE member.id_member='$id_member_to')) AS harga,
                            ($stock_plus_buy) AS stock_plus_buy,
                            ($stock_plus_buy_member) AS stock_plus_buy_member,
                            ($stock_min_sell_member) AS stock_min_sell_member,
                            ($stock_min_broken) AS stock_min_broken
							-- ((SELECT SUM(quantity) FROM transaksi.produk WHERE id_produk=produk.id_produk AND id_transaksi IN (SELECT))-(SELECT SUM(quantity) FROM transaksi_produk WHERE transaksi_produk.id_produk=produk.id_produk)) AS stock
					FROM produk";

        $data['title']      = 'Transaksi Penjualan';
        $data['product']    = $this->db->query($q)->result();
        $this->load->view('member/transaction/sales', $data);
    }

    function cart_add_sales()
    {
        $data = array(
            'id'    => $this->input->post('id_produk'),
            'qty'   => $this->input->post('quantity'),
            'price' => $this->input->post('harga_produk'),
            'name'  => $this->input->post('nama_produk')
        );
        $this->cart->insert($data);
        echo $this->cart_show_sales(); //tampilkan cart setelah added
    }

    function cart_show_sales()
    {
        $output     = '';
        $no         = 0;
        foreach ($this->cart->contents() as $items) {
            $no++;
            $output .= '
				<tr>
					<td>' . $items['name'] . '</td>
					<td>' . number_format($items['price'], 0, '.', '.') . '</td>
					<td>' . $items['qty'] . '</td>
					<td style="text-align:right;">' . number_format($items['subtotal'], 0, '.', '.') . '</td>
					<td><a href="#" id="' . $items['rowid'] . '" class="hapus_cart table-action table-action-delete"><i class="fas fa-trash"></i></a></td>
				</tr>';
        }

        $total = $this->cart->total();

        $output .= '
			<tr>
				<th colspan="2" style="text-align:right;"><font color="red">Total :</font></th>
				<th colspan="2" style="text-align:right;"><font color="red">' . 'Rp ' . number_format($total, 0, '.', '.') . '</font></th>
			</tr>';

        if (($total) <= 0) {
            $output .= '<tr>
							<td colspan="5">
							<button type="submit" id="submit" form="save" class="btn btn-success btn-lg btn-block" disabled>Simpan <i class="fa fa-arrow-right"></i></button>
                            </td>
						</tr>';
        } else {
            $output .= '<tr>
                            <td colspan="2" style="text-align:right;"><font color="black">Bukti Transfer :</font><br><font color="red"><small>Max 1 MB (jpg/png)</small></font></td>
                            <td colspan="3"">
                            <input type="file" name="bukti_transfer" class="form-control" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                            <button type="submit" id="submit" form="save" class="btn btn-success btn-lg btn-block">Simpan <i class="fa fa-arrow-right"></i></button>
                            </td>
                        </tr>';
        }

        return $output;
    }

    function cart_load_sales()
    {
        echo $this->cart_show_sales();
    }

    function cart_del_sales()
    {
        $data = array(
            'rowid' => $this->input->post('row_id'),
            'qty' => 0,
        );
        $this->cart->update($data);
        echo $this->cart_show_sales();
    }

    function commission($x)
    {
        $id = $this->session->userdata('log_id');
        $data['page'] = 'commission';

        if ($x == "list") {
            $data['title']          = 'Komisi Penjualan';
            $data['commission']     = $this->db->query("SELECT * FROM komisi WHERE id_member='$id' ORDER BY tgl_pengajuan DESC")->result();

            $this->load->view('member/commission/list', $data);
        } elseif ($x == "withdrawal") {
            # code...
        }
    }

    function profile()
    {
        $data['page']   = 'profile';
        $data['title']  = 'Profile';
        $id             = $this->session->userdata('log_id');

        $data['profile']            = $this->Member_model->get_profile($id);
        $data['lokasi']             = $this->db->query("SELECT * FROM location WHERE CHAR_LENGTH(id_location)=5 ORDER BY location_name ASC")->result();
        $data['bank']               = $this->db->query("SELECT * FROM bank ORDER BY kode_bank ASC")->result();
        $data['member_shipping']    = $this->Member_model->get_member_shipping($id);
        $this->load->view('member/profile', $data);
    }

    function get($x, $y)
    {
        $this->_ci = &get_instance();
        $this->_ci->load->config('rajaongkir', TRUE);
        $output = '';

        if ($this->_ci->config->item('rajaongkir_api_key', 'rajaongkir') == "") {
            log_message("error", "Harap masukkan API KEY Anda di config.");
        } else {
            $this->api_key = $this->_ci->config->item('rajaongkir_api_key', 'rajaongkir');
            $api_key = $this->api_key;
        }

        if ($x == "province") {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "" . base_url('public/back/province.json') . "",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            $data = json_decode($response, true);
            for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
                echo "<option></option>";
                echo "<option value='" . $data['rajaongkir']['results'][$i]['province_id'] . "'>" . $data['rajaongkir']['results'][$i]['province'] . "</option>";
            }
        } elseif ($x == "district") {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://pro.rajaongkir.com/api/city?province=$y",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "key: $api_key"
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            $data = json_decode($response, true);
            for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
                echo "<option></option>";
                echo "<option value='" . $data['rajaongkir']['results'][$i]['city_id'] . "'>" . $data['rajaongkir']['results'][$i]['type'] . " " . $data['rajaongkir']['results'][$i]['city_name'] . "</option>";
            }
        } elseif ($x == "subdistrict") {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=$y",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "key: $api_key"
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            $data = json_decode($response, true);
            for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
                echo "<option></option>";
                echo "<option value='" . $data['rajaongkir']['results'][$i]['subdistrict_id'] . "'>Kecamatan " . $data['rajaongkir']['results'][$i]['subdistrict_name'] . "</option>";
            }
        } elseif ($x == "cost") {
            $origin = $this->input->post('origin');
            $destination = $this->input->post('destination');
            $weight = $this->input->post('berat'); //gram
            $courier = $this->input->post('courier');

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL             => "https://pro.rajaongkir.com/api/cost",
                CURLOPT_RETURNTRANSFER  => true,
                CURLOPT_ENCODING        => "",
                CURLOPT_MAXREDIRS       => 10,
                CURLOPT_TIMEOUT         => 30,
                CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST   => "POST",
                CURLOPT_POSTFIELDS      => "origin=$origin&originType=city&destination=$destination&destinationType=subdistrict&weight=$weight&courier=$courier",
                CURLOPT_HTTPHEADER      => array(
                    "content-type: application/x-www-form-urlencoded",
                    "key: $api_key"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            $data = json_decode($response, true);
            // $kurir = $data['rajaongkir']['results'][0]['name'];
            // $kotaasal = $data['rajaongkir']['origin_details']['city_name'];
            // $provinsiasal = $data['rajaongkir']['origin_details']['province'];
            // $kotatujuan = $data['rajaongkir']['destination_details']['city_name'];
            // $provinsitujuan = $data['rajaongkir']['destination_details']['province'];
            // $berat = $data['rajaongkir']['query']['weight'] / 1000;

            $output .= '<tr>
                            <td colspan="2" style="text-align:right;"><font color="black">Bukti Transfer :</font><br><font color="red"><small>Max 1 MB (jpg/png)</small></font></td>
                            <td colspan="3"">
                            <input type="file" name="bukti_transfer" class="form-control" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                            <button type="submit" id="submit" form="save" class="btn btn-success btn-lg btn-block">Simpan <i class="fa fa-arrow-right"></i></button>
                            </td>
                        </tr>';

            return $output;
        } elseif ($x == "shipping_address") {
            $data = $this->db->query("SELECT * FROM member_shipping WHERE id = '$y'")->row();
            echo json_encode($data);
        } elseif ($x == "cost") { }
    }

    function get_cost($des, $weight, $cour)
    {
        // $gatewayname = "Raja Ongkir";
        // $origin = $this->M_shiping_gateway->data_shiping_gateway_by_name($gatewayname)->row();
        $this->load->library('Rajaongkir');
        $rajaongkir = new Rajaongkir;
        $tarif = $rajaongkir->_api_ongkir_post(135, $des, $weight, $cour);
        $data = json_decode($tarif, true);
        echo json_encode($data);
    }

    function passwd()
    {
        $data['page']       = 'passwd';
        $data['title']      = 'Update Password';
        $id                 = $this->session->userdata('log_id');
        $data['passwd']     = $this->db->query("SELECT nama,password FROM member WHERE id_member='$id'")->result();
        $this->load->view('member/passwd', $data);
    }

    function search()
    {
        $keyword        = $this->input->post('cari');
        $data['key']    = $this->input->post('cari');
        $data['page']   = 'cari';
        $data['title']  = 'Pencarian';

        $kelas          = $this->db->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%'");
        $data['kelas']  = $kelas->result();
        $data['kelasr'] = $kelas->num_rows();

        $video          = $this->db->query("SELECT * FROM produk_link WHERE nama_link LIKE '%$keyword%'");
        $data['video']  = $video->result();
        $data['videor'] = $video->num_rows();

        $this->load->view('_/member/cari', $data);
    }

    function act($x)
    {
        $id = $this->session->userdata('log_id');

        if ($x == "update_passwd") {

            $pass = md5($this->input->post('confirm_password'));
            $this->db->query("UPDATE member SET password = '$pass' WHERE id_member = $id");
            $this->session->set_flashdata("report", "<div><h3>Password Berhasil direset</h3> <p>Password Berhasil direset, silahkan login menggunakan password baru anda...</p></div>");
            redirect(base_url('login'));
        } elseif ($x == "add_purchase") {
            $im         = $id;
            $ip         = $this->input->post('id_promo');
            $to         = $this->input->post('total_ongkir');
            $nk         = $this->input->post('shipingdesc'); //nama kurir
            $date       = $this->input->post('date');
            $tipe       = 0; //pembelian member

            $data       = $this->transaction_f($im, $ip, $to, $nk, $date, $tipe);

            $this->db->insert('transaksi', $data);
            $insert_id = $this->db->insert_id();

            $transaksi_produk = array();
            foreach ($this->cart->contents() as $cart) {
                $id_produk  = $cart['id'];
                $q          = $this->db->query("SELECT nilai FROM produk WHERE id_produk='$id_produk'")->row();
                $ppv        = $q->nilai;
                $transaksi_produk[] = array(
                    'id_transaksi'  => $insert_id,
                    'id_produk'     => $id_produk,
                    'quantity'      => $cart['qty'],
                    'price'         => $cart['price'],
                    'pv'            => $cart['qty'] * $ppv
                );
            }
            $this->db->insert_batch('transaksi_produk', $transaksi_produk);

            $this->cart->destroy();
            // $this->alert('info', 'Transaksi berhasil ditambahkan...');
            // redirect(base_url('admin/transaction/all'));

            $this->alert('info', 'Pesanan berhasil disimpan! Mohon tunggu konfirmasi dari admin...');
            redirect(base_url('member/transaction/all'));
        } elseif ($x == "add_sales") {
            $im         = $id;
            $imt        = $this->input->post('id_member_to');
            $date       = $this->input->post('date');
            $tipe       = 1; //Penjualan Antar Member

            $config['upload_path']      = './public/upload/bukti_transfer/';
            $config['allowed_types']    = 'jpg|jpeg|png|PNG|JPG';
            $config['max_size']         = 1024;
            $config['encrypt_name']     = TRUE;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('bukti_transfer')) {

                $error = $this->upload->display_errors();
                $this->alert('danger', $error);

                redirect('member/add_sales');
            } else {
                $up = $this->upload->data();
                $bt = $up['file_name'];
            }

            $data = $this->sales_f($im, $imt, $bt, $date, $tipe);

            $this->db->insert('transaksi', $data);
            $insert_id = $this->db->insert_id();

            $transaksi_produk = array();
            foreach ($this->cart->contents() as $cart) {
                $id     = $cart['id'];
                $q      = $this->db->query("SELECT nilai FROM produk WHERE id_produk='$id'")->row();
                $ppv    = $q->nilai;
                $transaksi_produk[] = array(
                    'id_transaksi'      => $insert_id,
                    'id_produk'         => $id,
                    'quantity'          => $cart['qty'],
                    'price'             => $cart['price'],
                    'pv'                => $cart['qty'] * $ppv
                );
            }
            $this->db->insert_batch('transaksi_produk', $transaksi_produk);

            $q2 = $this->db->query("SELECT	id_upline FROM member WHERE id_member='$imt'")->row();

            if (!empty($q2->id_upline)) {
                $q3 = $this->db->query("SELECT SUM(pv) AS pv FROM transaksi_produk WHERE id_transaksi='$insert_id'")->row();
                $pv = $q3->pv;
                $this->db->query("UPDATE transaksi SET pv = '$pv' WHERE id_transaksi ='$insert_id'");
            }

            $this->cart->destroy();
            // $this->alert('info', 'Transaksi berhasil ditambahkan...');
            // redirect(base_url('admin/transaction/all'));

            $this->alert('info', 'Pembelian berhasil disimpan! Mohon tunggu konfirmasi dari admin...');
            redirect(base_url('member/transaction/all'));
        } elseif ($x == "update_profile") {

            // if($this->input->post('user_name') != $original_value) {
            //     $is_unique =  '|is_unique[users.user_name]';
            //  } else {
            //     $is_unique =  '';
            //  }

            //  $this->form_validation->set_rules('user_name', 'User Name', 'required|trim|xss_clean'.$is_unique);


            $this->form_validation->set_rules('nama', 'Nama', 'required|trim', ['required' => 'Nama belum diisi!']);
            $this->form_validation->set_rules('username', 'Username', 'is_unique[member.username]', ['is_unique' => 'Username sudah dipakai']);
            $this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'required|trim|is_unique[member.no_hp]', ['required' => 'Nomor Handphone belum diisi!', 'is_unique' => 'Nomor Handphone sudah terdaftar']);
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|trim|is_unique[member.email]', ['required' => 'Email belum diisi!', 'valid_email' => 'Format email salah!', 'is_unique' => 'Email sudah terdaftar']);

            if ($this->form_validation->run() == false) {

                $this->alert('warning', 'Ada beberapa field yang perlu anda perbaiki...');
                $this->profile();
            } else {
                $data = array(
                    'username'      => $this->input->post('username'),
                    'nama'          => $this->input->post('nama'),
                    'no_hp'         => $this->input->post('no_hp'),
                    'email'         => $this->input->post('email'),
                    'kode_bank'     => $this->input->post('kode_bank'),
                    'no_rekening'   => $this->input->post('no_rekening'),
                    'nama_rekening' => $this->input->post('nama_rekening'),
                    'alamat'        => $this->input->post('alamat'),
                    'id_location'   => $this->input->post('id_location'),
                    'pekerjaan'     => $this->input->post('pekerjaan')

                );
                $this->db->update("member", $data, array('id_member' => $id));

                $this->alert('success', 'Profil anda berhasil diupdate...');
                redirect(base_url('member/profile'));
            }
        } elseif ($x == "add_team") {
            $data['id_upline']    = $id;

            $this->form_validation->set_rules('nama', 'Nama', 'required|trim', ['required' => 'Nama belum diisi!']);
            $this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'required|trim|is_unique[member.no_hp]', ['required' => 'Nomor Handphone belum diisi!', 'is_unique' => 'Nomor Handphone sudah terdaftar']);
            $this->form_validation->set_rules('level', 'Level', 'required', ['required' => 'Anda belum memilih level membership!']);
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|trim|is_unique[member.email]', ['required' => 'Email belum diisi!', 'valid_email' => 'Format email salah!', 'is_unique' => 'Email sudah terdaftar']);

            if ($this->form_validation->run() == FALSE) {
                $this->alert('danger', form_error('no_hp') . "" . form_error('email'));

                redirect('member/team');
            } else {
                $level     = htmlspecialchars($this->input->post('level', TRUE));
                $no_hp     = htmlspecialchars($this->input->post('no_hp', TRUE));

                date_default_timezone_set('Asia/Jakarta');
                $now        = date("Y-m-d");
                $data       = [
                    'id_upline'         => $id,
                    'password'          => md5('password'),
                    'nama'              => htmlspecialchars($this->input->post('nama', TRUE)),
                    'no_hp'             => $no_hp,
                    'email'             => htmlspecialchars($this->input->post('email', TRUE)),
                    'kode_bank'         => $this->input->post('kode_bank'),
                    'no_rekening'       => $this->input->post('no_rekening'),
                    'nama_rekening'     => $this->input->post('nama_rekening'),
                    'tgl_reg'           => $now,
                    'notif_admin'       => 1,
                    'level'             => $level
                ];

                $this->db->insert('member', $data);

                // $q 		= $this->db->query("SELECT id_member FROM member WHERE no_hp='$no_hp'")->row();
                // $idm 	= $q->id_member;			

                $this->alert('success', 'Selamat!<br>Akun Team anda berhasil dibuat<br>Team bisa login sekarang');
                redirect('member/team');
            }
        } elseif ($x == "add_broken_stock") {
            $data = [
                'id_member' => $id,
                'id_produk' => $this->input->post('id_produk'),
                'quantity'  => $this->input->post('quantity'),
                'status'    => 0
            ];

            $this->db->insert('transaksi_produk', $data);

            $this->alert('warning', 'Kerusakan Produk Berhasil Ditambahkan...');
            redirect('member/product');
        } elseif ($x == "add_token_id") {
            $token = $this->input->post('token');
            $tot_token = $this->db->query("SELECT * FROM push_notification WHERE token='$token'")->num_rows();
            if ($tot_token < 1) {
                $data = [
                    'id_member' => $id,
                    'token' => $token
                ];

                $this->db->insert('push_notification', $data);
            }

            // $this->alert('warning', 'Kerusakan Produk Berhasil Ditambahkan...');
            // redirect('member/product');
        } elseif ($x == "add_shipping_address") {

            $q = $this->db->query("SELECT * FROM member_shipping WHERE id_member='$id'")->num_rows();
            if ($q == 0) {
                $status = 1;
            } else {
                $status = 0;
            }

            $data = [
                'id' => "ms-" . $id . "-" . ($q + 1),
                'id_member' => $id,
                'nama_penerima' => $this->input->post('nama_penerima'),
                'no_hp_penerima'  => $this->input->post('no_hp_penerima'),
                'id_province'    => $this->input->post('id_province'),
                'id_district'    => $this->input->post('id_district'),
                'id_subdistrict' => $this->input->post('id_subdistrict'),
                'province_name'    => $this->input->post('province_name'),
                'district_name'    => $this->input->post('district_name'),
                'subdistrict_name'    => $this->input->post('subdistrict_name'),
                'postal_code'    => $this->input->post('postal_code'),
                'full_address'    => $this->input->post('full_address'),
                'status'    => $status
            ];

            $this->db->insert('member_shipping', $data);

            if ($this->input->post('cart') == 1) {
                $q = $this->db->query("SELECT id FROM member_shipping WHERE id_member='$id' ORDER BY date_created ASC LIMIT 1")->row();
                $idsa = $q->id;
                $this->load_shipping_address($idsa);
            } else {
                $this->alert('success', 'Alamat Pengiriman Baru Berhasil Ditambahkan...');
                redirect('member/profile');
            }
        }
    }

    function set($x, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date("Y-m-d h:i:s");
        $idm = $this->session->userdata('log_id');

        if ($x == "trans_done") {
            $q         = $this->db->query("	SELECT 	t1.commission,t1.status,t1.tipe,
													(SELECT id_upline FROM member WHERE member.id_member=t1.id_member) AS idu,
													(SELECT	COUNT(t2.id_transaksi) FROM (SELECT * FROM transaksi) AS t2 WHERE t2.id_member=t1.id_member) AS tr
											FROM transaksi t1
											WHERE t1.id_transaksi='$id'")->row();

            $com        = $q->commission;
            $status     = $q->status;
            $tipe       = $q->tipe;
            $idu        = $q->idu;
            $tr         = $q->tr;

            if ($tr > 1) {
                $new_status = 3;
            } elseif ($tr == 1) {
                $new_status = 4;
            }

            if ($status == 2 && $tipe == 0) {
                if (!empty($idu)) {
                    $this->db->query("	UPDATE member SET 	commission = (commission + $com),
															commission_update='$now' 
										WHERE id_member=(SELECT m.id_upline FROM (SELECT * FROM member) m WHERE m.id_member=(SELECT t.id_member FROM transaksi t WHERE t.id_transaksi=$id))");

                    $this->db->query("	UPDATE transaksi SET status  = '$new_status', tgl_terima = '$now' WHERE id_transaksi = '$id'");
                } else {
                    $this->db->query("UPDATE transaksi SET status = '$new_status', tgl_terima = '$now' WHERE id_transaksi = '$id'");
                }

                $this->alert('success', 'Data berhasil diupdate...');
            } else {
                $this->alert('danger', 'Data Gagal diupdate...');
            }

            $page = "member/transaction/all";
        } elseif ($x == "trans_cancel") {

            $q = $this->db->query("SELECT id_member,status,tipe FROM transaksi WHERE id_transaksi='$id'")->row();

            $id_member  = $q->id_member;
            $status     = $q->status;
            $tipe       = $q->tipe;

            if ($id_member == $idm) {
                if ($status != 5) {
                    $this->db->query("UPDATE transaksi SET status = '5' WHERE id_transaksi = '$id'");
                    $this->alert('success', 'Data berhasil diupdate...');
                }
            } else {
                $this->alert('danger', 'Data Gagal diupdate...');
            }

            $page = "member/transaction/all";
        }

        redirect($page);
    }

    // Hitung Transaksi

    function transaction_f($im, $ip, $to, $nk, $date, $tipe)
    {
        if (empty($date)) {
            date_default_timezone_set('Asia/Jakarta');
            $now = date("Y-m-d h:i:s");
        } else {
            $now = $date;
        }

        $pr     = $this->db->query("SELECT nama_promo,nilai FROM promo WHERE id_promo='$ip'")->row();
        $np     = $pr->nama_promo;
        $npr    = $pr->nilai;
        $tot    = $this->cart->total();

        $q2     = $this->db->query("SELECT  id_upline AS idu,
                                            (SELECT nilai FROM member_level WHERE id_member_level=member.level) AS mv
									FROM member
									WHERE id_member='$im'")->row();
        $idu    = $q2->idu;
        $mv     = $q2->mv;

        if (!empty($idu)) {

            $q3 = $this->db->query("SELECT	COUNT(id_transaksi) AS tr FROM transaksi WHERE id_member='$im'")->row();
            $tr = $q3->tr;
            if ($tr > 0) {
                $com = ((5 / 100) * $tot) * $mv;
            } else {
                if ($mv >= 1) {
                    $com    = ((10 / 100) * $tot) * $mv;
                } else {
                    $com = 0;
                }
            }

            // Tambah nilai komisi di table member
            // $this->db->query("	UPDATE member m1 SET 	m1.commission = m1.commission + $com,
            // 											m1.commission_update='$now'
            // 					WHERE m1.id_member=(SELECT m2.id_upline FROM (SELECT * FROM member) AS m2 WHERE m2.id_member='$im')");
        } else {
            $com = 0;
        }

        // die(var_dump($pv));
        $data     = array(
            'id_member'         => $im,
            'nama_promo'        => $np,
            'nilai_promo'       => $npr,
            'ongkir'            => $to,
            'nama_kurir'        => $nk,
            'total'             => $tot,
            'commission'        => $com,
            'tgl_pesan'         => $now,
            'tgl_bayar'         => $now,
            'tipe'              => $tipe,
            'notif_admin'       => $tipe + 1,
            'status'            => 0
        );

        return $data;
    }

    function check_stock($id_produk)
    {
        $id = $this->session->userdata('log_id');

        $stock_plus_buy         = $this->db->query("SELECT SUM(quantity) AS q FROM transaksi_produk WHERE id_produk='$id_produk' AND id_transaksi IN (SELECT id_transaksi FROM transaksi WHERE status IN (3,4) AND id_member='$id' AND tipe=0)")->row();
        $stock_plus_buy_member  = $this->db->query("SELECT SUM(quantity) AS q FROM transaksi_produk WHERE id_produk='$id_produk' AND id_transaksi IN (SELECT id_transaksi FROM transaksi WHERE status IN (3,4) AND id_member_to='$id' AND tipe=1)")->row();

        $stock_min_sell_member  = $this->db->query("SELECT SUM(quantity) AS q FROM transaksi_produk WHERE id_produk='$id_produk' AND id_transaksi IN (SELECT id_transaksi FROM transaksi WHERE status IN (3,4) AND id_member='$id' AND tipe=1)")->row();
        $stock_min_broken       = $this->db->query("SELECT SUM(quantity) AS q FROM transaksi_produk WHERE id_produk='$id_produk' AND id_member='$id'")->row();

        $stock = (($stock_plus_buy->q + $stock_plus_buy_member->q) - ($stock_min_sell_member->q + $stock_min_broken->q));

        return $stock;
        // echo $stock;
    }

    function sales_f($im, $imt, $bt, $date, $tipe)
    {
        if (empty($date)) {
            date_default_timezone_set('Asia/Jakarta');
            $now     = date("Y-m-d h:i:s");
        } else {
            $now = $date;
        }

        $tot    = $this->cart->total();

        $q2     = $this->db->query("	SELECT	m1.id_upline AS idu,
												(SELECT nilai FROM member_level WHERE id_member_level=(SELECT m2.level FROM member m2 WHERE m2.id_member=m1.id_upline)) AS mv
										FROM member m1
										WHERE m1.id_member='$imt'")->row();
        $idu     = $q2->idu;
        $mv      = $q2->mv;

        if (!empty($idu)) {

            $com    = ((5 / 100) * $tot) * $mv;
            $st     = 0;
            // Tambah nilai komisi di table member
            // $this->db->query("	UPDATE member m1 SET 	m1.commission = m1.commission + $com,
            // 											m1.commission_update='$now'
            // 					WHERE m1.id_member=(SELECT m2.id_upline FROM (SELECT * FROM member) AS m2 WHERE m2.id_member='$im')");
        } else {
            $com    = 0;
            $st     = 0;
        }

        // die(var_dump($pv));
        $data     = array(
            'id_member'     => $im,
            'id_member_to'  => $imt,
            'ongkir'        => 0,
            'total'         => $tot,
            'commission'    => $com,
            'tgl_pesan'     => $now,
            'tgl_bayar'     => $now,
            'bukti_transfer' => $bt,
            'tipe'          => $tipe,
            'notif_admin'   => $tipe + 1,
            'status'        => $st
        );

        return $data;
    }

    public function get_produk($id)
    {
        $data = $this->db->query("SELECT * FROM produk WHERE id_produk = '$id'")->row();
        echo json_encode($data);
    }

    public function get_kode_promo()
    {
        $kode_promo = $this->input->post('kode_promo', TRUE);

        $data = $this->db->query("SELECT kode_promo, nama_promo FROM promo WHERE kode_promo LIKE '%$kode_promo%' ORDER BY kode_promo ASC")->result();

        $kode_promo =  array();
        foreach ($data as $d) {
            $json_array             = array();
            $json_array['value']    = $d->kode_promo;
            $json_array['label']    = $d->kode_promo . " - " . $d->nama_promo;
            $kode_promo[]           = $json_array;
        }

        echo json_encode($kode_promo);
    }


    function del_shipping_address($id)
    {
        $this->db->delete('member_shipping', array('id'  => $id));

        $this->alert('danger', 'Alamat Pengiriman telah dihapus...');
        redirect(base_url('member/profile'));
    }


    // Flashdata Report
    function alert($x, $y)
    {
        // $x : warna
        // $y : pesan
        return $this->session->set_flashdata("report", "<div class='alert alert-$x alert-dismissible fade show' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>$y</strong></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>");
    }
}
