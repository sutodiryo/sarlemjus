<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guest extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Master_data');
		$this->load->model('Transaction_data');
	}

	function index()
	{
		$data['page'] = "homepage";
		$this->load->view('guest/homepage', $data);
	}

	function join()
	{
		$data['page'] = "join";
		$this->load->view('guest/join', $data);
	}

	function about()
	{
		$data['page'] = "about";
		$this->load->view('guest/about', $data);
	}

	function shop()
	{
		$data['page'] = "shop";
		$data['product'] = $this->Master_data->get_product_list('1');
		$this->load->view('guest/shop', $data);
	}

	function contact()
	{
		$data['page'] = "contact";
		$this->load->view('guest/contact', $data);
	}

	function join_us()
	{
		$data['page'] = "join_us";
		$this->load->view('guest/join_us', $data);
	}


	function cart_add()
	{
		// $member_id  = $this->session->userdata('log_id');
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

	function cart_qty()
	{
		$tot_qty = array_sum(array_column($this->cart->contents(), 'qty'));
		$output     = '';
		$output .= '<strong>' . $tot_qty . '</strong>';

		echo $output;

		// echo $this->cart_show(0);
	}

	function cart_qty_value()
	{
		$tot_qty = array_sum(array_column($this->cart->contents(), 'qty'));

		echo $tot_qty;
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

		$member_id  = $this->session->userdata('log_id');
		$q          = $this->Transaction_data->get_product_purchase_cart($member_id, $id_produk);
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
		$member_id  = $this->session->userdata('log_id');

		$output     = '';
		$no         = 0;
		$tot_qty    = array_sum(array_column($this->cart->contents(), 'qty'));

		if ($tot_qty > 0) {
			$member_shipping_default  = $this->Transaction_data->get_member_shipping_default($member_id);

			$str        = "'";
			foreach ($this->cart->contents() as $items) {
				$no++;

				$id_produk  =  $items['id'];
				$member_id  = $this->session->userdata('log_id');
				$q = $this->Transaction_data->get_product_purchase_cart($member_id, $id_produk);

				$stock = $q->stock_plus - $q->stock_min;

				$output .= '<tr>
					  <td><a href="#" id="' . $items['rowid'] . '" class="hapus_cart btn btn-danger btn-outline">&times;</a></td>
					  <td title="' . $items['name'] . '">' . substr($items['name'], 0, 20) . '</td>
					  <td>' . number_format($items['price'], 0, ',', ',') . '</td>
					  <td class="text-center"><input id="qty' . $items['rowid'] . '" onchange="updateQty(' . $str . '' . $items['rowid'] . '' . $str . ',' . $str . '' . $items['id'] . '' . $str . ');" class="form-control form-control-sm" type="number" name="num-product' . $no++ . '" value="' . $items['qty'] . '" min="1" max="' . $stock . '"></td>
					  <td style="text-align:right; padding-right:20px;"><p>' . number_format($items['subtotal'], 0, ',', ',') . '</p></td>
					</tr>';
			}

			$total_cart = $this->cart->total();
			if ($total_cart != 0) {
				$discount = $this->Transaction_data->get_member_discount();
				$discount_value = $this->Transaction_data->get_member_discount_value();
				$total = $total_cart - $discount_value;
			} else {
				$discount = 0;
				$discount_value = 0;
				$total = 0;
			}

			$output .= '<tr>
						<td colspan="4">
						<table class="table table-borderless">
							<tbody>
							<tr>
								<th style="text-align:right;">
								<p style="color:orange;">Subtotal :</p>
								<p style="color:green;">Discount (' . $discount . '%) :</p>
								<p style="color:orange;">Biaya Pengiriman :</p>
								</th>
							</tr>
							<tr>
								<th style="text-align:right;">
								<p style="color:red;"><b>Total Tagihan :</b></p>
								</th>
							</tr>
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
					</tr>
					<tr>
					<td colspan="5">
					<table class="table table-striped">
					<tbody>';
			if (!empty($member_shipping_default)) {

				$tb_gram    = $this->get_weight('return');
				$tb_kg      = $tb_gram / 1000;

				$output .= '<tr style="border:1px;">
					  <th>
						<label class="form-control-label" for="alamat"> Alamat Penerima</label>
						<h4 class="mb-0">' . $member_shipping_default->recipients_name . '</h4>
						<input type="hidden" name="shipping_selected_name" id="shipping_selected_name" value="' . $member_shipping_default->recipients_name . '">
						<input type="hidden" name="shipping_selected_no_hp" id="shipping_selected_no_hp" value="' . $member_shipping_default->recipients_phone . '">
						<input type="hidden" name="subdistrict_id" id="subdistrict_id" value="' . $member_shipping_default->subdistrict_id . '">
						<small>' . $member_shipping_default->recipients_phone . '</small>
						<br>
						<textarea class="form-control" style="padding: 0px; outline: none !important; border:0px ; font-size: 12px; background-color:transparent;" disabled>' . $member_shipping_default->home_detail . ', ' . $member_shipping_default->village_name . ', ' . $member_shipping_default->subdistrict_name . ', ' . $member_shipping_default->district_name . ', ' . $member_shipping_default->province_name . ' - ' . $member_shipping_default->postal_code . '</textarea>
					  </th>
					</tr>
					<tr>
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
				$output .= '<tr id="add_new_address_form">
					  <div>
						<th style="text-align:right;"><small><font color="red" >Anda belum mengatur alamat pengiriman</font></small></th>
						<th style="text-align:right;"><button onclick="add_new_address()" title="Tambah Alamat Pengiriman" class="btn btn-info"><i class="feather icon-map-pin"></i> Tambah Alamat</button></th>
					  </div>
					</tr>';
			}
			$output .= '  </tbody>
					</table>
					</td>
					</tr>';
		} else {
			$output .= '<tr>
					  <td class="text-center" colspan="5">
						<h2>Keranjang anda masih kosong...</h2>
						<a href="' . base_url('shop') . '"><h2 class="text-info">Silahkan pilih produk disini...</h2></a>
					  </td>
					</tr>';
		}

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

	function get_cost($cour, $des)
	{
		// $member_id  = $this->session->userdata('log_id');
		// $q          = $this->Transaction_data->get_member_shipping_default($member_id);
		// $des = $q->subdistrict_id;
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
		date_default_timezone_set('Asia/Jakarta');
		$now = date("Y-m-d H:i:s");
		$name = htmlspecialchars($this->input->post('full_name', TRUE));
		$phone = htmlspecialchars($this->input->post('phone', TRUE));

		$data_member = [
			'name' => $name,
			'phone' => $phone,
			'password' => md5(($this->input->post('password'))),
			'img' => 'profile.jpg',
			'registration_date' => $now,
			'notif_admin' => 1
		];

		$this->db->insert('member', $data_member);
		$member_id = $this->db->insert_id();

		$data = [
			'member_id' => $member_id,
			'recipients_name' => $name,
			'recipients_phone' => $phone,
			'province_id' => $this->input->post('province_id'),
			'district_id' => $this->input->post('district_id'),
			'subdistrict_id' => $this->input->post('subdistrict_id'),
			'province_name' => $this->input->post('province_name'),
			'district_name' => $this->input->post('district_name'),
			'subdistrict_name' => $this->input->post('subdistrict_name'),
			'village_name' => $this->input->post('village_name'),
			'home_detail' => $this->input->post('home_detail'),
			'date_created' => $now,
			'status' => 1
		];
		$this->db->insert('member_shipping', $data);

		$shipping_costs = $this->input->post('shipping_costs');
		$courier_name = $this->input->post('courier_name');

		$data_trans = $this->Transaction_data->transaction_calculation_new($member_id, $shipping_costs, $courier_name);
		$this->db->insert('transaction', $data_trans);
		$insert_id = $this->db->insert_id();

		$transaction_product = array();
		foreach ($this->cart->contents() as $cart) {
			$product_id  = $cart['id'];
			$q = $this->db->query("SELECT p.name FROM product p WHERE p.id='$product_id'")->row();
			$transaction_product[] = array(
				'transaction_id' => $insert_id,
				'product_id' => $product_id,
				'product_name' => $q->name,
				'price' => $cart['price'],
				'quantity' => $cart['qty'],
			);
		}

		$this->db->insert_batch('transaction_product', $transaction_product);

		$this->cart->destroy();

		$q = $this->db->query("SELECT t.invoice_number FROM transaction t WHERE t.id='$insert_id'")->row();

		// $to = "yoxgii@gmail.com";
		// $subject = "-----------";
		// $message = "------------";
		// $from = "noreply.dev.std@gmail.com";
		// $nama = "aaa";

		// $this->load->library('Email');
		// $email = new Email;
		// $data = $email->send($to, $subject, $message, $from, $nama);
		// $data = json_decode($data, true);

		// $this->load->config('email');
        // $this->load->library('email');
        
        // $from = $this->config->item('smtp_user');
        // $to = "yoxgii@gmail.com";
        // $subject = "Judul";
        // $message = "Isi pesan nya";

        // $this->email->set_newline("\r\n");
        // $this->email->from($from);
        // $this->email->to($to);
        // $this->email->subject($subject);
        // $this->email->message($message);

        // if ($this->email->send()) {
        //     echo 'Your Email has successfully been sent.';
        // } else {
        //     show_error($this->email->print_debugger());
        // }

		$this->alert('info', 'Pesanan berhasil disimpan! Segera lunasi tagihan lalu tunggu konfirmasi dari admin....');
		redirect(base_url('invoice/' . $q->invoice_number . ''));
	}

	function invoice($invoice_number)
	{
	  $data['page'] = array(
		"id" => "transaction",
		"title" => "Member Area | Transaksi",
		"header" => "Transaksi",
		"a" => array("icon" => "fas fa-tachometer-alt", "link" => "dashboard", "title" => "Dashboard"),
		"b" => array("link" => "member/transaction", "title" => "Transaksi"),
		"c" => ""
	  );
  
	  $inv = $this->Transaction_data->get_invoice_detail($invoice_number);
	  $data['inv'] = $inv;
	  $data['items'] = $this->Transaction_data->get_invoice_items($inv->id);
  
	  $this->load->view('member/transaction/invoice_detail_guest', $data);
	}

	// Flashdata Report
	function alert($x, $y)
	{
		// $x : warna
		// $y : pesan
		return $this->session->set_flashdata("report", "<div class='alert alert-$x alert-dismissible fade show' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>$y</strong></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>??</span></button></div>");
	}
}
