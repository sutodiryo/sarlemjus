<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Store extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('log_valid') == FALSE) {
      $this->session->set_flashdata("report", "<div class='alert alert-danger alert-dismissible fade show' role='alert'><small>Anda harus login terlebih dahulu.</small><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>");
      redirect(base_url('login'));
    }
    $this->load->model('Transaction_data');
    $this->load->model('Master_data');
  }

  function index()
  {
    $data['page'] = array(
      "id" => "store",
      "title" => "Member Area | Store",
      "header" => "Belanja Sarlemus",
      "a" => array("icon" => "fas fa-tachometer-alt", "link" => "dashboard", "title" => "Dashboard"),
      "b" => array("link" => "store", "title" => "Store"),
      "c" => ""
    );

    $id = $this->session->userdata('log_id');

    $product = $this->Master_data->get_product_list('1');

    $data['product'] = $product;

    $this->load->view('member/store/index', $data);
  }


  function cart_add()
  {
    // $id_member  = $this->session->userdata('log_id');
    $qty = $this->input->post('quantity');
    $id_produk  = $this->input->post('id_produk');
    $q = $this->Transaction_data->get_product_purchase_cart($qty, $id_produk);
    // die(var_dump($q));
    $data = array(
      'id'    => $id_produk,
      'qty'   => $qty,
      'price' => $q->price,
      'name'  => $q->name,
      'weight'  => $q->weight,
      'options' => array(
        'image' => $q->image
      )
    );
    $this->cart->insert($data);
    echo $this->cart_show(0); //tampilkan cart setelah added
  }

  function cart_load()
  {
    echo $this->cart_show(0);
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
    $q          = $this->Transaction_data->get_product_purchase_cart($id_member, $id_produk);
    $stock      = $q->stock_plus - $q->stock_min;
    if ($stock < $qty) {
      // $this->alert('warning', 'Gagal, Anda melebih stok yang ada...');
      echo '<div><script>alert("Gagal, Anda melebih stok yang ada");</script></div>';
    } else {
      $this->cart->update($data);
    }
    echo $this->cart_show(0); //tampilkan cart setelah added
  }

  function cart_del()
  {
    $data = array(
      'rowid' => $this->input->post('row_id'),
      'qty' => 0,
    );
    $this->cart->update($data);
    echo $this->cart_show(0);
  }

  function cart_show()
  {
    $id_member  = $this->session->userdata('log_id');

    $output     = '';
    $no         = 0;
    $tot_qty    = array_sum(array_column($this->cart->contents(), 'qty'));

    $member_shipping_default  = $this->Transaction_data->get_member_shipping_default($id_member);

    $str        = "'";
    foreach ($this->cart->contents() as $items) {
      $no++;

      $id_produk  =  $items['id'];
      $id_member  = $this->session->userdata('log_id');
      $q = $this->Transaction_data->get_product_purchase_cart($id_member, $id_produk);

      $stock = $q->stock_plus - $q->stock_min;

      $output .= '<tr>
                    <td title="' . $items['name'] . '">' . substr($items['name'], 0, 20) . '</td>
                    <td>' . number_format($items['price'], 0, ',', ',') . '</td>
                    <td class="text-center"><input id="qty' . $items['rowid'] . '" onchange="updateQty(' . $str . '' . $items['rowid'] . '' . $str . ',' . $str . '' . $items['id'] . '' . $str . ');" class="form-control form-control-sm" type="number" name="num-product' . $no++ . '" value="' . $items['qty'] . '" min="1" max="' . $stock . '"></td>
                    <td style="text-align:right; padding-right:20px;"><p>' . number_format($items['subtotal'], 0, ',', ',') . '</p></td>
                    <td><a href="#" id="' . $items['rowid'] . '" class="hapus_cart table-action table-action-delete"><i class="fas fa-trash"></i></a></td>
                  </tr>';
    }

    $output .= '<tr>
                  <td colspan="2">
                  <table class="table table-striped">
                  <tbody>';
    if (!empty($member_shipping_default)) {

      $output .= '<tr style="border:1px;">
                    <th>
                      <label class="form-control-label" for="alamat"> Alamat Penerima</label>
                      <h4 class="mb-0">' . $member_shipping_default->nama_penerima . '</h4>
                      <input type="hidden" name="shipping_selected_name" id="shipping_selected_name" value="' . $member_shipping_default->nama_penerima . '">
                      <input type="hidden" name="shipping_selected_no_hp" id="shipping_selected_no_hp" value="' . $member_shipping_default->no_hp_penerima . '">
                      <input type="hidden" name="id_subdistrict" id="id_subdistrict" value="' . $member_shipping_default->id_subdistrict . '">
                      <small>' . $member_shipping_default->no_hp_penerima . '</small>
                      <br>
                      <textarea class="form-control" style="padding: 0px; outline: none !important; border:0px ; font-size: 12px; background-color:transparent;" disabled>' . $member_shipping_default->full_address . ' - ' . $member_shipping_default->postal_code . '</textarea>
                    </th>
                  </tr>';

      $tb_gram    = $this->get_weight('return');
      $tb_kg      = $tb_gram / 1000;

      $output .= '<tr>
                    <th>
                      <label class="form-control-label" for="id_kurir">Pilih Jasa Pengiriman <small><font id="total_weight" color="blue">Total Berat : (' . $tb_kg . ' Kg)</font></small></label>
                      <select class="form-control form-control-sm" id="kurir" onchange="set_kurir()" required="">
                        <option value=""> Pilih Kurir</option>
                        <option value="anteraja">Anteraja</option>
                        <option value="jne">JNE - Jalur Nugraha Ekakurir</option>
                        <option value="jnt">JNT</option>
                        <option value="ninja">Ninja Express</option>
                        <option value="pos">POS Indonesia</option>
                        <option value="sicepat">Sicepat</option>
                        <option value="tiki">Tiki - Titipan Kilat</option>
                      </select>
                      <br>
                      <div id="datakurir"></div>
                    </th>
                  <tr>';
    } else {

      $output .= '<tr>
                    <th style="text-align:right;"><small><font color="red" >Anda belum mengatur alamat pengiriman</font></small></th>
                    <th style="text-align:right;">
                    <a data-toggle="modal" href="' . base_url('member/profile/address') . '" title="Tambah Alamat Pengiriman" class="btn btn-sm btn-default"><small>Tambah Alamat</small></a>
                    </th>
                  </tr>';
    }

    $total_cart = $this->cart->total();

    $discount = $this->Transaction_data->get_member_discount();
    $discount_value = $this->Transaction_data->get_member_discount_value();
    $total = $total_cart - $discount_value;

    $output .= '  </tbody>
                  </table>
                  </td>
                  <td>
                    <table class="table table-borderless">
                      <tbody>
                        <tr><th style="text-align:right;"><p style="color:orange;">Subtotal :</p>
                        <p style="color:green;">Discount Level (' . $discount . '%) :</p>
                        <p style="color:orange;">Biaya Pengiriman :</p></th></tr>
                        <tr><th style="text-align:right;"><p style="color:red;"><b>Total Tagihan :</b></p></th></tr>
                      </tbody>
                    </table>
                  </td>
                  <td>
                    <table class="table table-borderless">
                      <tbody>
                        <tr>
                          <th style="text-align:right;">
                            <p style="color:orange;">' . 'Rp ' . number_format($this->cart->total(), 0, ',', ',') . '</p>
                            <p style="color:green;">' . 'Rp ' . number_format($discount_value, 0, ',', ',') . '</p>
                            <p id="shipping_costs_text" style="color:orange;">0</p>
                          </th>
                        </tr>
                        <tr>
                          <th style="text-align:right;"><h4 style="color:red;" id="total_tagihan"><strong>' . 'Rp ' . number_format($total, 0, ',', ',') . '</strong></h4></th>
                          <input type="hidden" id="discount" value="' . $discount . '">
                          <input type="hidden" id="discount_value" value="' . $discount_value . '">
                          <input type="hidden" name="shipping_costs" id="shipping_costs">
                          <input type="hidden" name="shipingdesc" id="shipingdesc">
                          <input type="hidden" name="nilai_subtotal" id="nilai_subtotal" value="' . $total_cart . '">
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>';

    return $output;
  }

  function get_weight($x)
  {
    $tot_berat = array();
    foreach ($this->cart->contents() as $items) {
      $qty            = (float) $items['qty'];
      $wg             = (float) $items['weight'];

      $tot_berat[]    = $qty * $wg;
    }

    $tb_gram  = (array_sum($tot_berat));


    if ($x == 'return') {
      return (int) $tb_gram;
    } elseif ($x == 'echo') {
      echo (int) $tb_gram;
    }
  }

  function get_cost($cour)
  {
    $id_member  = $this->session->userdata('log_id');
    $q          = $this->Transaction_data->get_member_shipping_default($id_member);

    $des = $q->id_subdistrict;
    $weight = $this->get_weight('return');

    // $gatewayname = "Raja Ongkir";
    // $origin = $this->M_shiping_gateway->data_shiping_gateway_by_name($gatewayname)->row();
    $this->load->library('Rajaongkir');
    $rajaongkir = new Rajaongkir;
    $tarif = $rajaongkir->_api_ongkir_post(135, $des, $weight, $cour);
    $data = json_decode($tarif, true);
    // die($data);

    echo json_encode($data);
    // echo "$des - $weight - $cour";
  }

  function act_add_transaction()
  {
    $shipping_costs = $this->input->post('shipping_costs');
    $courier_name = $this->input->post('courier_name'); //nama kurir

    $data = $this->Transaction_data->transaction_calculation($shipping_costs, $courier_name);

    $this->db->insert('transaction', $data);
    $insert_id = $this->db->insert_id();

    $transaction_product = array();
    foreach ($this->cart->contents() as $cart) {
      $product_id  = $cart['id'];
      $q = $this->db->query("SELECT p.name FROM product p WHERE p.id='$product_id'")->row();
      // $ppv        = $q->nilai;
      $transaction_product[] = array(
        'transaction_id' => $insert_id,
        'product_id' => $product_id,
        'product_name' => $q->name,
        'price' => $cart['price'],
        'quantity' => $cart['qty'],
        // 'point'            => $cart['qty'] * $ppv
      );
    }
    $this->db->insert_batch('transaction_product', $transaction_product);

    $this->cart->destroy();

    $q = $this->db->query("SELECT t.invoice_number FROM transaction t WHERE t.id='$insert_id'")->row();
    $this->alert('info', 'Pesanan berhasil disimpan! Segera lunasi tagihan lalu tunggu konfirmasi dari admin...');
    redirect(base_url('member/transaction/invoice/' . $q->invoice_number . ''));
  }

  // Flashdata Report
  function alert($x, $y)
  {
    // $x : warna
    // $y : pesan
    return $this->session->set_flashdata("report", "<div class='alert alert-$x alert-dismissible fade show' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>$y</strong></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>");
  }
}
