<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('log_valid') == FALSE) {
			redirect(base_url('auth'));
		}
		if ($this->session->userdata('log_admin') == FALSE) {
			redirect(base_url('member'));
		}
		$this->load->model('Admin_model');
	}

	function index()
	{
		$data['title'] 	= 'Dashboard Admin';
		$data['page'] 	= 'dashboard';

		$data['member_stat'] 	= $this->Admin_model->get_stat_member_dashboard();
		$data['sales_stat'] 	= $this->Admin_model->get_stat_sales_dashboard();

		$data['produk_stat']	= $this->db->query("SELECT id_produk,nama_produk,img_1,satuan FROM produk WHERE status=1")->result();

		$data['produk'] 			= $this->db->query("SELECT * FROM produk")->result();

		$this->load->view('admin/dashboard', $data);
	}

	function member($x)
	{
		$data['page'] 		= 'member';

		$data['all'] 		= $this->db->query("SELECT * FROM member")->num_rows();
		$data['stokies'] 	= $this->db->query("SELECT * FROM member WHERE level=4")->num_rows();
		$data['priority'] 	= $this->db->query("SELECT * FROM member WHERE level=0")->num_rows();
		$data['others'] 	= $this->db->query("SELECT * FROM member WHERE level != 0 AND level != 4")->num_rows();

		$q = $this->Admin_model->get_member_list();

		$data['sel_member']  	= $this->db->query("SELECT id_member,nama,no_hp FROM member ORDER BY nama ASC")->result();
		$data['level']  		= $this->db->query("SELECT id_member_level,nama_level FROM member_level ORDER BY nilai DESC")->result();
		$data['lokasi']			= $this->Admin_model->get_city();

		if ($x == "all") {
			$data['title'] 	 = 'Daftar Semua Mitra';
			$data['member']  = $this->db->query("$q ORDER BY downline DESC, level ASC, nama ASC")->result();
		} else {
			$data['title'] 	 = 'Daftar Mitra Priority';
			$data['member']  = $this->db->query("$q WHERE level=$x")->result();
		}
		$this->load->view('admin/member/list', $data);
	}

	
	function member_detail($id)
	{
		$data['page'] 	= 'member';
		$data['title'] 	= 'Detail Mitra';
		$data['member'] = $this->Admin_model->get_member_detail($id);
		$this->load->view('admin/member/detail', $data);
	}

	function product($x)
	{
		if ($x == "all") {

			$data['page'] 		= 'product';
			$data['title'] 		= 'Daftar Produk';
			$data['product'] 	= $this->db->query("	SELECT 	id_produk,nama_produk,harga,satuan,nilai,img_1,img_2,keterangan,waktu_input,status,
																((SELECT SUM(stock_update) FROM produk_stok WHERE id_produk=produk.id_produk)) AS stock,
																(SELECT SUM(quantity) FROM transaksi_produk WHERE transaksi_produk.id_produk=produk.id_produk) AS stock_
														FROM produk WHERE produk.status=1")->result();
			$this->load->view('admin/product/list', $data);
		} elseif ($x == "member") {

			$data['page'] 		= 'product';
			$data['title'] 		= 'Stok Member';
			$data['member'] 	= $this->db->query("SELECT 	id_member,nama,level,
															(SELECT SUM(quantity) FROM transaksi_produk WHERE status IS NULL AND id_transaksi IN (SELECT id_transaksi FROM transaksi WHERE id_member=member.id_member AND tipe=0)) AS stok,
															(SELECT nama_level FROM member_level WHERE id_member_level=member.level) AS nama_level
													FROM member ORDER BY stok DESC")->result();
			$this->load->view('admin/product/member', $data);
		} elseif ($x == "add") {

			$data['page'] 		= 'product';
			$data['title'] 		= 'Tambah Produk Baru';
			$data['product'] 	= $this->db->query("	SELECT	id_produk,nama_produk,harga,nilai,img_1,img_2,keterangan,waktu_input,status,
																(SELECT GROUP_CONCAT(harga SEPARATOR ', ') FROM produk_harga WHERE id_produk=produk.id_produk) AS harga_member
														FROM produk WHERE produk.status=1")->result();
			$this->load->view('admin/product/add', $data);
		} elseif ($x == "act_add") {

			$config['upload_path']      = './assets/upload/produk/';
			$config['allowed_types']    = 'gif|jpg|jpeg|png';
			$config['max_size']         = 1024;
			$config['encrypt_name']     = TRUE;
			$this->load->library('upload', $config);
			$this->upload->do_upload('img_1');
			$up 	= $this->upload->data();

			$data 	= array(
				'nama_produk'   => $this->input->post('nama_produk'),
				'harga'         => $this->input->post('harga'),
				'harga_'        => $this->input->post('harga_'),
				'keterangan'    => $this->input->post('keterangan'),
				'waktu_input'   => date('Y-m-d H:i:s'),
				'img_1'         => $up['file_name']
			);
			$this->upload->display_errors();
			$this->db->insert('produk', $data);
			redirect(base_url('admin/product/list'));
		}
	}

	function transaction($x)
	{
		$data['page'] 			= 'transaction';
		$data['idp'] 			= $x;
		$data['sel_product'] 	= $this->db->query("SELECT id_produk, nama_produk FROM produk")->result();
		$data['sel_member']  	= $this->db->query("SELECT id_member,nama,no_hp FROM member ORDER BY nama ASC")->result();

		$q = $this->Admin_model->get_transaction_list();

		$status	= $this->input->post('status');

		$date 	= $this->input->post('date');
		$d 		= date_parse_from_format("Y-m-d", date($date));
		$bulan 	= $d["month"];
		$tahun 	= $d["year"];

		if (empty($date)) {
			if (!isset($status)) {
				$where = "WHERE MONTH(tgl_pesan) = MONTH(CURDATE()) AND YEAR(tgl_pesan) = YEAR(CURDATE())";
			} else {
				$where = "WHERE MONTH(tgl_pesan) = MONTH(CURDATE()) AND YEAR(tgl_pesan) = YEAR(CURDATE()) AND status='$status'";
				$data['status']	= $status;
			}
		} else {
			if (!isset($status)) {
				$where 	= "WHERE MONTH(tgl_pesan) = $bulan AND YEAR(tgl_pesan) = $tahun";
			} else {
				$where 	= "WHERE MONTH(tgl_pesan) = $bulan AND YEAR(tgl_pesan) = $tahun  AND status='$status'";
				$data['status']	= $status;
			}
			$data['date']	= date($this->input->post('date'));
		}

		if ($x == "all") {

			$data['title'] 			= 'Daftar Transaksi';
			$data['transaction']  	= $this->db->query("$q $where ORDER BY status ASC, tgl_pesan DESC")->result();
		} elseif ($x == "new") {
			$data['title'] 			= 'Daftar Transaksi Baru';
			$data['transaction']  	= $this->db->query("$q $where AND notif_admin IN (1,2) ORDER BY status ASC, tgl_pesan DESC")->result();
		} elseif ($x == "purchase") {
			$data['title'] 			= 'Daftar Transaksi Pembelian';
			$data['transaction']  	= $this->db->query("$q $where AND tipe='0' ORDER BY status ASC, tgl_pesan DESC")->result();
		} elseif ($x == "sales") {
			$data['title'] 			= 'Daftar Transaksi Penjualan';
			$data['transaction']  	= $this->db->query("$q $where AND tipe='1' ORDER BY status ASC, tgl_pesan DESC")->result();
		}
		$this->load->view('admin/transaction/list', $data);
	}

	function transaction_detail($id)
	{
		$data['page'] 		= 'transaction';
		$data['title'] 		= 'Detail Transaksi';
		$data['trans'] 		= $this->Admin_model->get_transaction_detail($id);
		$data['trans_p'] 	= $this->db->query("SELECT 	id_transaksi,quantity,price,pv,id_produk,
																									(SELECT nama_produk FROM produk WHERE id_produk=transaksi_produk.id_produk) AS produk
																							FROM transaksi_produk WHERE status IS NULL AND id_transaksi='$id'")->result();

		$data['sel_kurir'] 	= $this->db->query("SELECT id_kurir,nama_kurir FROM kurir")->result();
		$this->db->query("UPDATE transaksi SET notif_admin='0' WHERE id_transaksi ='$id'");

		$this->load->view('admin/transaction/detail', $data);
	}

	function add_transaction($x)
	{
		$data['page'] 			= 'transaction';
		$data['idp'] 			= 'add_transaction';
		$data['sel_member']  	= $this->db->query("SELECT id_member,nama,no_hp FROM member ORDER BY nama ASC")->result();
		$data['sel_product'] 	= $this->db->query("SELECT id_produk, nama_produk FROM produk")->result();
		$data['sel_promo'] 		= $this->db->query("SELECT id_promo,nama_promo,nilai FROM promo")->result();

		$date 	= $this->input->post('date');
		$ongkir = $this->input->post('ongkir');
		if (!empty($date)) {
			$id_member	= $this->input->post('id_member');
			$date 		= new DateTime($date);
			$date 		= $date->format(DateTime::ATOM);

			$data['date']		= $date;
			$data['id_member']	= $id_member;
			$data['id_promo']	= $this->input->post('id_promo');
			if (!empty($ongkir)) {
				$data['ongkir']	= $this->input->post('ongkir');
			} else {
				$data['ongkir']	= 0;
			}
			$q = "	SELECT 	id_produk,nama_produk,satuan,nilai,img_1,img_2,keterangan,waktu_input,status,
							(SELECT harga FROM produk_harga WHERE id_produk=produk.id_produk AND produk_harga.id_member_level=(SELECT level FROM member WHERE member.id_member='$id_member')) AS harga,
							((SELECT SUM(stock_update) FROM produk_stok WHERE id_produk=produk.id_produk)) AS stock,
							(SELECT SUM(quantity) FROM transaksi_produk WHERE transaksi_produk.id_produk=produk.id_produk) AS stock_
					FROM produk
					WHERE produk.status=1
					ORDER BY nama_produk ASC";
		} else {
			$q = "	SELECT 	id_produk,nama_produk,harga,satuan,nilai,img_1,img_2,keterangan,waktu_input,status,
							(SELECT SUM(stock_update) FROM produk_stok WHERE id_produk=produk.id_produk) AS stock
					FROM produk
					WHERE produk.status=1
					ORDER BY nama_produk ASC";
		}
		if ($x == "cart") {
			$data['title'] 		= 'Transaksi Baru';
			$data['product'] 	= $this->db->query($q)->result();
			$this->load->view('admin/transaction/add', $data);
		}
	}

	function cart_add($id_promo, $ongkir)
	{

		$data = array(
			'id' 	=> $this->input->post('id_produk'),
			'qty' 	=> $this->input->post('quantity'),
			'price'	=> $this->input->post('harga_produk'),
			'name' 	=> $this->input->post('nama_produk')
		);
		$this->cart->insert($data);
		echo $this->cart_show($id_promo, $ongkir); //tampilkan cart setelah added
	}

	function cart_show($id_promo, $ongkir)
	{
		// $c = $this->input->post('cart');
		// if (isset($c)) {
		// $data = array(
		// 	'id' 	=> $this->input->post('id_produk'),
		// 	'qty' 	=> $this->input->post('quantity'),
		// 	'price'	=> $this->input->post('harga_produk'),
		// 	'name' 	=> $this->input->post('nama_produk')
		// );
		// 	$this->cart->insert($c);
		// 	die('haha');
		// }
		$output 	= '';
		$no 		= 0;
		$str = "'";
		$tot_qty 	= array_sum(array_column($this->cart->contents(), 'qty'));
		foreach ($this->cart->contents() as $items) {
			$no++;

			$id_produk  =  $items['id'];
			$id_member  = $this->session->userdata('log_id');
			$q = $this->Admin_model->get_product_purchase_cart($id_member, $id_produk);

			$stock = $q->stok - $q->stok_;

			$output .= '
				<tr>
					<td>' . substr($items['name'], 0, 20) . '</td>
					<td>' . number_format($items['price'], 0, '.', '.') . '</td>
					
					<td class="text-center"><input id="qty' . $items['rowid'] . '" onchange="updateQty(' . $str . '' . $items['rowid'] . '' . $str . ',' . $str . '' . $items['id'] . '' . $str . ');" class="form-control form-control-sm" type="number" name="num-product' . $no++ . '" value="' . $items['qty'] . '" min="1" max="' . $stock . '"></td>

					<td style="text-align:right;">' . number_format($items['subtotal'], 0, '.', '.') . '</td>
					<td><a href="#" id="' . $items['rowid'] . '" class="hapus_cart table-action table-action-delete"><i class="fas fa-trash"></i></a></td>
				</tr>';
		}

		$output .= '<tr>
						<th colspan="2" style="text-align:right;">Total :</th>
						<th colspan="2" style="text-align:right;">' . 'Rp ' . number_format($this->cart->total(), 0, '.', '.') . '</th>
					</tr>
					<tr>
						<th colspan="2" style="text-align:right;"><font color="black">Ongkir :</font></th>
						<th colspan="2" style="text-align:right;"><font color="black">
						<input type="number" onchange="cartshow()"  min="0" value="' . $ongkir . '" name="ongkir" id="ongkir" class="ongkir form-control form-control-sm" placeholder="Rp"></font></th>
					</tr>';

		if ($id_promo == 0) {
			$nama_promo	= "-";
			$nilai 		= 0;

			// if ($tot_qty >= 100) {
				if ($tot_qty >= 0) {
				$output .= '<tr>
								<th style="text-align:right;"></th>
								<th colspan="3" style="text-align:right;">
								<select onchange="cartshow()" name="id_promo" id="promo" class="form-control form-control-sm" data-toggle="select" data-select2-promo="3" tabindex="-3" aria-hidden="true" required>
									<option value="0" selected disabled>Pilih Promo</option>';

				$sel_promo		= $this->db->query("SELECT id_promo,nama_promo,nilai FROM promo")->result();
				$no = 0;
				foreach ($sel_promo as $sp) {
					$no++;
					$output .= '<option data-select2-promo="' . $no . '" value="' . $sp->id_promo . '">' . $sp->nama_promo . ' - Rp ' . number_format($sp->nilai, 0, ',', '.') . '.</option>';
				}
				$output .= '</select></th>
							</tr>';
			}
		} else {

			$q 			= $this->db->query("SELECT nama_promo,nilai FROM promo WHERE id_promo='$id_promo'")->row();
			$nama_promo	= $q->nama_promo;
			$nilai 		= $q->nilai;
			$output 	.= '<tr>
								<th colspan="2" style="text-align:right;"><font color="orange">
								<input type="hidden" name="id_promo" id="id_promo" value="' . $id_promo . '">' . $nama_promo . ' :</font></th>
								<th colspan="2" style="text-align:right;"><font color="orange">' . '- Rp ' . number_format($nilai, 0, '.', '.') . '<br><a href="#" onclick="reset_cart()">Ganti</a></font></th>
							</tr>';
		}

		$tc 	= $this->cart->total();
		if ($ongkir != 0) {
			$total 	= $tc + $ongkir;
		} else {
			$total 	= $tc;
		}

		$output .= '<tr>
						<th colspan="2" style="text-align:right;"><font color="red">Tagihan :</font></th>
						<th colspan="2" style="text-align:right;"><font color="red">' . 'Rp ' . number_format($total - $nilai, 0, '.', '.') . '</font></th>
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

	function cart_load($id_promo, $ongkir)
	{
		echo $this->cart_show($id_promo, $ongkir);
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
			$q          = $this->Admin_model->get_product_purchase_cart($id_member, $id_produk);
			$stock      = $q->stok - $q->stok_;
			if ($stock < $qty) {
					// $this->alert('warning', 'Gagal, Anda melebih stok yang ada...');
					echo '<div><script>alert("Gagal, Anda melebih stok yang ada");</script></div>';
			} else {
					$this->cart->update($data);
			}
			echo $this->cart_show(0, 0); //tampilkan cart setelah added
	}

	function cart_ongkir($id_promo, $ongkir)
	{
		$data = array(
			'ongkir' => $this->input->post('ongkir'),
			'qty' => 0,
		);
		echo $this->cart_show($id_promo, $ongkir);
	}

	function cart_del($id_promo, $ongkir)
	{
		$data = array(
			'rowid' => $this->input->post('row_id'),
			'qty' => 0,
		);
		$this->cart->update($data);
		echo $this->cart_show($id_promo, $ongkir);
	}

	function commission($x)
	{
		$data['page'] 	= 'commission';

		$date 	= $this->input->post('date');
		if (!empty($date)) {
			$data['date']	= date($this->input->post('date'));
		}

		$q = $this->Admin_model->get_commission($date);

		if ($x == "all") {

			$data['title'] 			= 'Daftar Total Komisi';
			$data['commission']  	= $this->db->query("$q")->result();

			$this->load->view('admin/commission/list', $data);
		} elseif ($x == "withdrawal") {
			$d['page'] 	= 'commission';
			$d['title'] 	= 'Daftar Pencairan Komisi';
			$d['wd'] 		= $this->db->query("SELECT 	id_commission_wd,id_member,amount,id_bonus,note,date_update,tipe,status,
														(SELECT nama FROM member WHERE id_member=commission_wd.id_member) AS member,
														(SELECT nama_bonus FROM bonus WHERE id_bonus=commission_wd.id_bonus) AS bonus
												FROM commission_wd")->result();

			$this->load->view('admin/commission/withdrawal', $d);
		}
	}

	function commission_detail($x, $id)
	{
		$member 		= $this->db->query("SELECT nama FROM member WHERE id_member='$id'")->row();
		$data['page'] 	= 'commission';
		$data['idp'] 	= 'commission_detail/' . $x . '/' . $id . '';
		$q = $this->Admin_model->get_commission_detail($id);

		$date 	= $this->input->post('date');
		$d 		= date_parse_from_format("Y-m-d", date($date));
		$bulan 	= $d["month"];
		$tahun 	= $d["year"];

		if (empty($date)) {
			$where = "MONTH(transaksi.tgl_pesan) = MONTH(CURDATE()) AND YEAR(transaksi.tgl_pesan) = YEAR(CURDATE())";
		} else {
			$where 			= "MONTH(transaksi.tgl_pesan) = $bulan AND YEAR(transaksi.tgl_pesan) = $tahun";
			$data['date']	= date($this->input->post('date'));
		}

		if ($x == "team") {
			$data['title'] 	= 'Daftar Pendapatan Team - ' . $member->nama . '';
			$data['team']  	= $this->db->query("$q AND status = 3 AND $where ORDER BY tgl_pesan DESC")->result();

			$this->load->view('admin/commission/list_team', $data);
		} elseif ($x == "gm") {

			$data['title'] 	= 'Daftar Pendapatan Get Member - ' . $member->nama . '';
			$data['gm']  	= $this->db->query("$q AND status = 4 AND $where ORDER BY tgl_pesan DESC")->result();

			$this->load->view('admin/commission/list_gm', $data);
		} elseif ($x == "pv_m") {

			$data['title'] 	= 'Daftar Pendapatan Poin Pribadi - ' . $member->nama . '';
			$data['pv']  	= $this->db->query("	SELECT  id_transaksi,id_member,total,commission,tgl_pesan,product_quantity,pv,
															(SELECT nilai FROM member_level WHERE id_member_level=(SELECT level FROM member WHERE member.id_member=transaksi.id_member)) AS mv,
															(SELECT nama_level FROM member_level WHERE id_member_level=(SELECT level FROM member WHERE member.id_member=transaksi.id_member)) AS nama_level,
															(SELECT nilai FROM produk WHERE id_produk=transaksi.id_produk) AS pp,
															(SELECT nama FROM member WHERE id_member=(SELECT id_member FROM member WHERE id_member=transaksi.id_member)) AS member,
															(SELECT nama_produk FROM produk WHERE id_produk=transaksi.id_produk) AS produk
													FROM transaksi
													WHERE commission!=0
													AND id_member='$id' AND pv != 0 AND $where ORDER BY tgl_pesan DESC")->result();

			$this->load->view('admin/commission/list_pv_m', $data);
		} elseif ($x == "pv_team") {

			$data['title'] 	= 'Daftar Pendapatan Poin Team - ' . $member->nama . '';
			$data['pv']  	= $this->db->query("$q AND pv != 0 AND $where ORDER BY tgl_pesan DESC")->result();

			$this->load->view('admin/commission/list_pv_team', $data);
		} elseif ($x == "cwd") {
			// Detail withdrawing commission
			$data['title'] 	= 'Daftar Pencairan Komisi - ' . $member->nama . '';
			$data['cwd']  	= $this->db->query("	SELECT id_commission_wd,id_member,amount,date_update,status
													FROM commission_wd
													WHERE id_member='$id'
													ORDER BY date_update DESC")->result();

			$this->load->view('admin/commission/list_cwd', $data);
		} elseif ($x == "pwd") {
			// Detail withdrawing point
			$data['title'] 	= 'Daftar Pencairan Poin - ' . $member->nama . '';
			$data['pwd']  	= $this->db->query("$q AND pv != 0 ORDER BY tgl_pesan DESC")->result();

			$this->load->view('admin/commission/list_pwd', $data);
		} else {
			redirect(base_url('admin'));
		}
	}

	function push_notification_msg()
	{
		$data['page'] 		= 'push_notification_msg';
		$data['title'] 	 	= 'Pesan Notifikasi';
		$data['msg']  		= $this->db->query("SELECT 	id_push_notification_msg,title,body,icon,action_link,id_member_level,last_update,
																									(SELECT nama_level FROM member_level WHERE id_member_level=push_notification_msg.id_member_level) AS level_member
																						FROM push_notification_msg")->result();
		$data['level']  	= $this->db->query("SELECT * FROM member_level ORDER BY smp DESC")->result();
		$this->load->view('admin/push_notification_msg', $data);
	}

	function master($x)
	{
		if ($x == "level_member") {
			$data['page'] 		= 'level';
			$data['title'] 	 	= 'Master Level Member';
			$data['level']  	= $this->db->query("SELECT * FROM member_level ORDER BY smp DESC")->result();
			$this->load->view('admin/master/level_member', $data);
		} elseif ($x == "bonus") {
			$data['page'] 		= 'bonus';
			$data['title'] 	 	= 'Master Bonus';
			$data['bonus']  	= $this->db->query("SELECT * FROM bonus")->result();
			$this->load->view('admin/master/bonus', $data);
		} elseif ($x == "promo") {
			$data['page'] 		= 'promo';
			$data['title'] 	 	= 'Master Promo';
			$data['promo']  	= $this->db->query("SELECT * FROM promo")->result();
			$this->load->view('admin/master/promo', $data);
		} elseif ($x == "courier") {
			$data['page'] 		= 'courier';
			$data['title'] 	 	= 'Master Kurir';
			$data['kurir']  	= $this->db->query("SELECT * FROM kurir")->result();
			$this->load->view('admin/master/courier', $data);
		} elseif ($x == "event") {
			$data['page'] 		= 'event';
			$data['title'] 	 	= 'Event Schedule';
			$data['location']  	= $this->Admin_model->get_location_5();
			$data['event']  	= $this->Admin_model->get_all_event();
			$this->load->view('admin/master/event', $data);
		}
	}

	//ACT
	function add($x)
	{
		date_default_timezone_set('Asia/Jakarta');
		$now = date("Y-m-d h:i:s");

		if ($x == "member") {
			date_default_timezone_set('Asia/Jakarta');
			$now 	= date("Y-m-d h:i:s");
			$data 	= array(
				'nama'     		=> $this->input->post('nama'),
				'id_upline'     => $this->input->post('id_upline'),
				'no_hp'     	=> $this->input->post('no_hp'),
				'email' 		=> $this->input->post('email'),
				'password'		=> "e10adc3949ba59abbe56e057f20f883e",
				'id_location'   => $this->input->post('id_location'),
				'level'  		=> $this->input->post('level'),
				'alamat'  		=> $this->input->post('alamat'),
				'tgl_reg'		=> $now,
				'notif_admin' 	=> 1,
				'status'		=> 1
			);

			$this->db->insert('member', $data);

			$this->alert('info', 'Member berhasil ditambahkan...');
			redirect(base_url('admin/member/all'));
		} elseif ($x == "product") {
			$config['upload_path']      = './public/back/produk/';
			$config['allowed_types']    = 'jpg|jpeg|png|PNG|JPG';
			$config['max_size']         = 1024;
			$config['encrypt_name']     = FALSE;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('img_1')) {

				$error = $this->upload->display_errors();
				$this->alert('danger', $error);

				redirect('admin/product/add');
			} else {
				$up 	= $this->upload->data();
				$img 	= $up['file_name'];
			}

			$data = array(
				'slug'     					=> $this->input->post('slug'),
				'nama_produk' 			=> $this->input->post('nama_produk'),
				'harga'  						=> $this->input->post('harga'),
				'satuan'  					=> $this->input->post('satuan'),
				'berat'  						=> $this->input->post('berat'),
				'nilai'  						=> $this->input->post('nilai'),
				'waktu_input'  			=> $now,
				'status'  					=> 1,
				'keterangan'  			=> $this->input->post('keterangan'),
				'img_1'  						=> $img
			);

			$this->db->insert('produk', $data);

			$this->alert('info', 'Product berhasil ditambahkan...');
			redirect(base_url('admin/product/all'));
		} elseif ($x == "produk_harga") {
			$data = array(
				'id_produk'     	=> $this->input->post('id_produk'),
				'id_member_level' 	=> $this->input->post('id_member_level'),
				'harga'  			=> $this->input->post('harga')
			);

			$this->db->insert('produk_harga', $data);

			$this->alert('info', 'Harga berhasil ditambahkan...');
			$referred_from = $this->session->userdata('referred_add_price');
			redirect($referred_from);
		} elseif ($x == "produk_stock") {
			$data = array(
				'id_admin'     	=> $this->session->userdata('log_id'),
				'stock_update'	=> $this->input->post('stock_update'),
				'note'			=> $this->input->post('note'),
				'id_produk' 	=> $this->input->post('id_produk')
			);

			$this->db->insert('produk_stok', $data);

			$this->alert('info', 'Stok berhasil ditambahkan...');
			$referred_from = $this->session->userdata('referred_add_stock');
			redirect($referred_from);
		} elseif ($x == "transaction") {
			$im 	= $this->input->post('id_member');
			$ip 	= $this->input->post('id_promo');
			$date 	= $this->input->post('date');
			$ongkir = $this->input->post('ongkir');
			$tipe 	= 0; //pembelian member

			$data 	= $this->Admin_model->transaction_add($im, $ip, $date, $ongkir, $tipe);

			$this->db->insert('transaksi', $data);
			$insert_id = $this->db->insert_id();

			$transaksi_produk = array();
			foreach ($this->cart->contents() as $cart) {
				$id 	= $cart['id'];
				$q 		= $this->db->query("SELECT nilai FROM produk WHERE id_produk='$id'")->row();
				$ppv	= $q->nilai;
				$transaksi_produk[] = array(
					'id_transaksi' 	=> $insert_id,
					'id_produk' 	=> $id,
					'quantity' 		=> $cart['qty'],
					'price'			=> $cart['price'],
					'pv' 			=> $cart['qty'] * $ppv
				);
			}
			$this->db->insert_batch('transaksi_produk', $transaksi_produk);

			$q2 = $this->db->query("SELECT id_upline FROM member WHERE id_member='$im'")->row();

			if (!empty($q2->id_upline)) {
				$q3 = $this->db->query("SELECT SUM(pv) AS pv FROM transaksi_produk WHERE status IS NULL AND id_transaksi='$insert_id'")->row();
				$pv = $q3->pv;
				$this->db->query("UPDATE transaksi SET pv = '$pv' WHERE id_transaksi ='$insert_id'");
			}

			$this->cart->destroy();
			// $this->alert('info', 'Transaksi berhasil ditambahkan...');
			$this->session->set_flashdata("cetak", 1);
			redirect(base_url('admin/transaction_detail/' . $insert_id));
		} elseif ($x == "member_level") {
			$data = array(
				'nama_level'    => $this->input->post('nama_level'),
				'nilai' 		=> $this->input->post('nilai'),
				'smp' 			=> $this->input->post('smp'),
				'diskon' 		=> $this->input->post('diskon'),
				'keterangan'  	=> $this->input->post('keterangan')
			);

			$this->db->insert('member_level', $data);

			$this->alert('info', 'Level Member berhasil ditambahkan...');
			redirect(base_url('admin/master/level_member'));
		} elseif ($x == "bonus") {
			$data = array(
				'nama_bonus'    => $this->input->post('nama_bonus'),
				'total_pv' 		=> $this->input->post('total_pv'),
				'keterangan'  	=> $this->input->post('keterangan')
			);

			$this->db->insert('bonus', $data);

			$this->alert('info', 'Bonus berhasil ditambahkan...');
			redirect(base_url('admin/master/bonus'));
		} elseif ($x == "courier") {
			$data = array(
				'nama_kurir'    => $this->input->post('nama_kurir'),
				'status' 		=> 1,
				'keterangan'  	=> $this->input->post('keterangan')
			);

			$this->db->insert('kurir', $data);

			$this->alert('info', 'Kurir berhasil ditambahkan...');
			redirect(base_url('admin/master/courier'));
		} elseif ($x == "promo") {
			$data = array(
				'kode_promo'    => $this->input->post('kode_promo'),
				'nama_promo'    => $this->input->post('nama_promo'),
				'nilai' 		=> $this->input->post('nilai'),
				'tipe' 			=> $this->input->post('tipe'),
				'status' 		=> 1,
				'keterangan'  	=> $this->input->post('keterangan')
			);

			$this->db->insert('promo', $data);

			$this->alert('info', 'Promo berhasil ditambahkan...');
			redirect(base_url('admin/master/promo'));
		} elseif ($x == "event") {
			$data = array(
				'event_name'    => $this->input->post('event_name'),
				'date_start' 	=> $this->input->post('date_start'),
				'date_end' 		=> $this->input->post('date_end'),
				'id_location' 	=> $this->input->post('id_location'),
				'address' 		=> $this->input->post('address'),
				'note'  		=> $this->input->post('note'),
				'tipe'  		=> $this->input->post('tipe'),
				'status'		=> 0
			);

			$this->db->insert('event_schedule', $data);

			$this->alert('info', 'Event berhasil ditambahkan...');
			redirect(base_url('admin/master/event'));
		} elseif ($x == "promo_level") {
			$data = array(
				'id_promo'     	=> $this->input->post('id_promo'),
				'id_member_level' 	=> $this->input->post('id_member_level'),
				'date_start'  			=> $this->input->post('date_start'),
				'date_end'  			=> $this->input->post('date_end'),
				'status'  			=> $this->input->post('status')
			);

			$this->db->insert('promo_level', $data);

			$this->alert('info', 'Data berhasil ditambahkan...');
			$referred_from = $this->session->userdata('referred_add_promo_level');
			redirect($referred_from);
		} elseif ($x == "push_notification_msg") {

			date_default_timezone_set('Asia/Jakarta');
			$now = date("Y-m-d h:i:s");

			$data = array(
				'title' 	=> $this->input->post('title'),
				'body'  			=> $this->input->post('body'),
				'icon'  			=> 'favicon.png',
				'action_link'  			=> $this->input->post('action_link'),
				'last_update'  			=> $now
			);

			$this->db->insert('push_notification_msg', $data);

			$this->alert('info', 'Data berhasil ditambahkan...');
			redirect('admin/push_notification_msg');
		}
	}

	function edit($x, $y)
	{
		if ($x == "produk") {
			$data['page'] 		= 'product';
			$data['title'] 		= 'Edit Produk';
			$data['produk'] 	= $this->db->query("SELECT * FROM produk WHERE id_produk='$y'")->row();
			$this->load->view('admin/product/edit', $data);
		} elseif ($x == "member") {
			$data['page'] 		= 'member';
			$data['title'] 		= 'Edit Member';
			$data['member'] 	= $this->db->query("SELECT * FROM member WHERE id_member='$y'")->result();
			// $data['video'] 		= $this->db->query("SELECT id_produk_link,id_produk,nama_link,link,deskripsi,status FROM produk_link WHERE id_produk='$y' AND status=1")->result();
			$this->load->view('admin/member/edit', $data);
		} elseif ($x == "produk_harga") {
			$data['page'] 			= 'product';
			$data['title'] 			= 'Harga Produk';
			$data['produk'] 		= $this->db->query("SELECT id_produk,nama_produk FROM produk WHERE id_produk='$y'")->row();

			$data['harga_produk']	= $this->db->query("SELECT 	id_produk,id_member_level,harga,
																	(SELECT nama_produk FROM produk WHERE id_produk=produk_harga.id_produk) AS produk,
																	(SELECT nama_level FROM member_level WHERE id_member_level=produk_harga.id_member_level) AS nama_level
															FROM produk_harga WHERE id_produk='$y'")->result();
			$data['member_level'] 	= $this->db->query("SELECT * FROM member_level
															WHERE id_member_level NOT IN (SELECT id_member_level FROM produk_harga WHERE id_produk='$y')")->result();
			$data['member_level_edt'] 	= $this->db->query("SELECT * FROM member_level")->result();

			$this->load->view('admin/product/harga', $data);
		} elseif ($x == "produk_stock") {
			$data['page'] 			= 'product';
			$data['title'] 			= 'Stok Produk';
			$data['produk'] 		= $this->db->query("SELECT id_produk,nama_produk FROM produk WHERE id_produk='$y'")->row();
			$data['stat'] 			= $this->db->query("SELECT SUM(stock_update) AS tot FROM produk_stok WHERE produk_stok.id_produk='$y'")->row();

			$data['stock_produk']	= $this->db->query("SELECT 		id_produk,id_produk_stok,id_admin,id_produk,stock_update,note,update_time,
																	(SELECT name FROM admin WHERE id_admin=produk_stok.id_admin) AS admin,
																	(SELECT satuan FROM produk WHERE id_produk=produk_stok.id_produk) AS satuan
														FROM produk_stok WHERE id_produk='$y'")->result();

			$this->load->view('admin/product/stock', $data);
		} elseif ($x == "promo_level") {
			$data['page'] 			= 'promo';
			$data['title'] 			= 'Promo';
			$data['promo'] 			= $this->db->query("SELECT id_promo,kode_promo,nama_promo FROM promo WHERE id_promo='$y'")->row();

			$data['promo_level']	= $this->db->query("SELECT 	id_promo,id_member_level,date_start,date_end,status,
																	(SELECT nama_promo FROM promo WHERE id_promo=promo_level.id_promo) AS promo,
																	(SELECT kode_promo FROM promo WHERE id_promo=promo_level.id_promo) AS kode_promo,
																	(SELECT nama_level FROM member_level WHERE id_member_level=promo_level.id_member_level) AS nama_level
															FROM promo_level WHERE id_promo='$y'")->result();
			$data['member_level'] 	= $this->db->query("SELECT * FROM member_level
																									WHERE id_member_level NOT IN (SELECT id_member_level FROM promo_level WHERE id_promo='$y')")->result();

			$this->load->view('admin/master/promo_level', $data);
		}
	}

	function set($x, $y, $z)
	// $x = modul, $y = status, $z = id
	{
		date_default_timezone_set('Asia/Jakarta');
		$now = date("Y-m-d h:i:s");

		$data = array('status' => $y);

		if ($x == "member") {
			$this->db->update($x, array('id_member'  => $z), $data);
			$page = "base_url('admin/member/list')";
		} elseif ($x == "member_level") {
			$this->db->query("UPDATE member SET level = '$y' WHERE id_member ='$z'");
			$page = "base_url('admin/member/list')";
		} elseif ($x == "produk") {
			$this->db->update($x, array('id_produk'  => $z), $data);
			$page = "base_url('admin/produk/list')";
		} elseif ($x == "upline") {
			$id_upline = $this->input->post('id_upline');
			$this->db->query("UPDATE $y SET id_upline = '$id_upline' WHERE id_member ='$z'");
			$page = "base_url('admin/member/all')";
		} elseif ($x == "transaksi") {

			$q 		= $this->db->query("	SELECT 	t1.id_member,t1.total,t1.commission,t1.status,
																					(SELECT id_upline FROM member WHERE member.id_member=t1.id_member) AS idu,
																					(SELECT nilai FROM member_level WHERE id_member_level=(SELECT level FROM member WHERE id_member=t1.id_member)) AS mv,
																					(SELECT	COUNT(t2.id_transaksi) FROM (SELECT * FROM transaksi) AS t2 WHERE t2.id_member=t1.id_member) AS tr
																			FROM transaksi t1
																			WHERE t1.id_transaksi='$z'")->row();
			$tot		= $q->total;
			$com1		= $q->commission;
			$status = $q->status;
			$idu 		= $q->idu;
			$mv			= $q->mv;
			$tr 		= $q->tr;

			if (!empty($idu)) {
				if ($y == 1) {
					if ($status == 0) {
						if ($tr > 1) {
							$com 	= ((5 / 100) * $tot) * $mv;
							$st 	= $y;
						} else {
							$com 	= ((10 / 100) * $tot) * $mv;
							$st 	= 4;
						}

						$this->db->query("	UPDATE member SET 	commission = (commission + $com),
																commission_update='$now' 
											WHERE id_member=(SELECT m.id_upline FROM (SELECT * FROM member) m WHERE m.id_member=(SELECT t.id_member FROM transaksi t WHERE t.id_transaksi=$z))");

						$this->db->query("	UPDATE transaksi SET	status 		= '$st',
																	tgl_bayar 	= '$now',
																	commission 	= '$com'
											WHERE id_transaksi = '$z'");

						$this->db->query("UPDATE transaksi_produk SET	status = '1', id_transaksi='$z' WHERE id_member = (SELECT id_member FROM transaksi WHERE id_transaksi='$z')");
					} elseif ($status == 4) {
						$com 	= ((5 / 100) * $tot) * $mv;
						$uc 	= ($com1 - $com);

						// Tambah nilai komisi di table member
						$this->db->query("	UPDATE member SET 	commission = (commission - $uc),
																commission_update='$now' 
											WHERE id_member=(SELECT m.id_upline FROM (SELECT * FROM member) m WHERE m.id_member=(SELECT t.id_member FROM transaksi t WHERE t.id_transaksi=$z))");
						$this->db->query("	UPDATE 	transaksi SET 	status 		= '$y',
																	commission 	= '$com'
											WHERE id_transaksi = '$z'");
					}
				} elseif ($y == 2) {
					$this->db->query("UPDATE transaksi SET status = '$y' WHERE id_transaksi = '$z'");
				} elseif ($y == 4) {
					$com2 	= ((10 / 100) * $tot) * $mv;
					$uc 	= ($com1 - $com2);

					// Tambah nilai komisi di table member
					$this->db->query("	UPDATE member SET 	commission = (commission - $uc),
															commission_update='$now' 
										WHERE id_member=(SELECT m.id_upline FROM (SELECT * FROM member) m WHERE m.id_member=(SELECT t.id_member FROM transaksi t WHERE t.id_transaksi=$z))");

					$this->db->query("	UPDATE transaksi SET	status 		= '$y',
																tgl_bayar 	= '$now',
																commission 	= '$com2'
										WHERE id_transaksi = '$z'");

					$this->db->query("UPDATE transaksi SET status = '$y', tgl_bayar = '$now' WHERE id_transaksi = '$z'");
				} elseif ($y == 0 || $y == 3) {
					$com2 	= ((10 / 100) * $tot) * $mv;
					$uc 	= ($com1 - $com2);

					// Tambah nilai komisi di table member
					$this->db->query("	UPDATE member SET 	commission = (commission - $uc),
															commission_update='$now' 
										WHERE id_member=(SELECT m.id_upline FROM (SELECT * FROM member) m WHERE m.id_member=(SELECT t.id_member FROM transaksi t WHERE t.id_transaksi=$z))");

					$this->db->query("	UPDATE transaksi SET	status 		= '$y',
																tgl_bayar	= '$now',
																commission 	= '$com2'
										WHERE id_transaksi = '$z'");

					$this->db->query("UPDATE transaksi SET status = '$y', tgl_bayar = '$now' WHERE id_transaksi = '$z'");
				} elseif ($y == 5) {
					$this->db->query("UPDATE transaksi SET status = '$y' WHERE id_transaksi = '$z'");
				}
			} else {

				$this->db->query("UPDATE transaksi SET status = '$y' WHERE id_transaksi = '$z'");
			}

			if ($y != 5) {
				$page = $this->session->userdata('ref_detail_transaksi');
			} else {
				$page = "admin/transaction/all";
			}
		} elseif ($x == "sales") {

			date_default_timezone_set('Asia/Jakarta');
			$now = date("Y-m-d h:i:s");

			$q 		= $this->db->query("	SELECT 	t1.id_member,t1.total,t1.commission,t1.status,
													(SELECT id_upline FROM member WHERE member.id_member=t1.id_member) AS idu,
													(SELECT nilai FROM member_level WHERE id_member_level=(SELECT level FROM member WHERE id_member=t1.id_member)) AS mv,
													(SELECT	COUNT(t2.id_transaksi) FROM (SELECT * FROM transaksi) AS t2 WHERE t2.id_member=t1.id_member) AS tr
											FROM transaksi t1
											WHERE t1.id_transaksi='$z'")->row();
			$tot	= $q->total;
			$com1	= $q->commission;
			$status = $q->status;
			$idu 	= $q->idu;
			$mv		= $q->mv;
			$tr 	= $q->tr;

			if (!empty($idu)) {
				if ($y == 1) {
					$this->db->query("UPDATE transaksi SET status = '$y' WHERE id_transaksi = '$z'");
				} elseif ($y == 2) {
					$this->db->query("UPDATE transaksi SET status = '$y' WHERE id_transaksi = '$z'");
				} else {
					$this->db->query("UPDATE transaksi SET status = '$y' WHERE id_transaksi = '$z'");
				}
			} else {
				$this->db->query("UPDATE transaksi SET status = '$y' WHERE id_transaksi = '$z'");
			}

			// $page = "admin/transaction/all";
			$page = $this->session->userdata('ref_detail_transaksi');
		}

		$this->alert('warning', 'Data berhasil diupdate...');
		redirect($page);
	}

	function act($x, $id)
	{
		date_default_timezone_set('Asia/Jakarta');
		$now = date("Y-m-d h:i:s");

		if ($x == "update_transaction") {
			$im 	= $this->input->post('id_member');
			$ip 	= $this->input->post('id_produk');
			$pq 	= $this->input->post('product_quantity');
			$date 	= $this->input->post('date');
			$tipe 	= $this->input->post('tipe');

			$data 	= $this->transaction_f($im, $ip, $pq, $date, $tipe);

			$id_transaksi = $this->input->post('id_transaksi');
			$this->db->update("transaksi", $data, array('id_transaksi'  => $id_transaksi));

			$this->alert('success', 'Data berhasil diupdate...');
			redirect(base_url('admin/transaction/all'));
		} elseif ($x == "update_product") {

			$referred_from = $this->session->userdata('ref_edit_product');

			// if (empty($_FILES['userfile']['img_1'])) {
				// $data = array(
				// 	'slug'     					=> $this->input->post('slug'),
				// 	'nama_produk' 			=> $this->input->post('nama_produk'),
				// 	'harga'  						=> $this->input->post('harga'),
				// 	'satuan'  					=> $this->input->post('satuan'),
				// 	'berat'  						=> $this->input->post('berat'),
				// 	'nilai'  						=> $this->input->post('nilai'),
				// 	'keterangan'  			=> $this->input->post('keterangan')
				// );

			// 	$cek = "kosong";
			// } else {

				// $config['upload_path']      = './public/back/produk/';
				// $config['allowed_types']    = 'jpg|jpeg|png|PNG|JPG';
				// $config['max_size']         = 1024;
				// $config['encrypt_name']     = FALSE;
				// $this->load->library('upload', $config);

				// if (!$this->upload->do_upload('img_1')) {
				// 	$error = $this->upload->display_errors();
				// 	$this->alert('danger', $error);

				// 	redirect($referred_from);
				// } else {
				// 	$up 	= $this->upload->data();
				// 	$img 	= $up['file_name'];
				// }

				$data = array(
					'slug'     					=> $this->input->post('slug'),
					'nama_produk' 			=> $this->input->post('nama_produk'),
					'harga'  						=> $this->input->post('harga'),
					'satuan'  					=> $this->input->post('satuan'),
					'berat'  						=> $this->input->post('berat'),
					'nilai'  						=> $this->input->post('nilai'),
					// 'img_1'  						=> $img,
					'keterangan'  			=> $this->input->post('keterangan')
				);
			// 	$cek = "isi";
			// }
			// die($cek);

			$this->db->update("produk", $data, array('id_produk'  => $id));

			$this->alert('success', 'Product berhasil diubah...');
			redirect(base_url('admin/product/all'));
		} elseif ($x == "update_ongkir") {
			$ongkir = $this->input->post('ongkir');
			$this->db->query("UPDATE transaksi SET ongkir = '$ongkir' WHERE id_transaksi='$id'");

			$this->alert('success', 'Ongkir Berhasil Ditambahkan...');

			$referred_from = $this->session->userdata('ref_detail_transaksi');
			redirect($referred_from);
		} elseif ($x == "update_member") {
			$data = array(
				'nama'     		=> $this->input->post('nama'),
				'id_upline'     => $this->input->post('id_upline'),
				'no_hp'     	=> $this->input->post('no_hp'),
				'email' 		=> $this->input->post('email'),
				'id_location'   => $this->input->post('kota'),
				'level'  		=> $this->input->post('level'),
				'alamat'  		=> $this->input->post('alamat')
			);
			$id_member = $this->input->post('id_member');
			$this->db->update("member", $data, array('id_member'  => $id_member));

			$this->alert('success', 'Data berhasil diupdate...');
			redirect(base_url('admin/member/all'));
		} elseif ($x == "password_member") {
			$data = array(
				'password' => "e10adc3949ba59abbe56e057f20f883e"
			);
			$this->db->update("member", $data, array('id_member'  => $id));

			$this->alert('warning', 'Password member berhasil direset menjadi (123456)');
			$referred_from = $this->session->userdata('ref_member');
			redirect($referred_from);
		} elseif ($x == "update_resi") {

			$no_hp 	= $this->input->post('no_hp');
			$resi	= $this->input->post('resi');

			$data = array(
				'status'	=> 2,
				'resi'		=> $resi,
				'id_kurir'  => $this->input->post('id_kurir')
			);
			$this->db->update("transaksi", $data, array('id_transaksi'  => $id));

			// $link	= "https://api.whatsapp.com/send?phone=62$no_hp&text=Paket%20anda%20sudah%20kami%20kirim%20dengan%20nomor%20resi%20%3A%0A%0A%0A$resi%0A%0A%0ATerima%20Kasih";

			// redirect($link);

			$referred_from = $this->session->userdata('ref_detail_transaksi');
			redirect($referred_from);
		} elseif ($x == "update_member_level") {
			$data = array(
				'nama_level'    => $this->input->post('nama_level'),
				'nilai' 		=> $this->input->post('nilai'),
				'smp' 			=> $this->input->post('smp'),
				'diskon' 		=> $this->input->post('diskon'),
				'keterangan'  	=> $this->input->post('keterangan')
			);

			$id_member_level = $this->input->post('id_member_level');
			$this->db->update("member_level", $data, array('id_member_level'  => $id_member_level));

			$this->alert('success', 'Level Member berhasil diubah...');
			redirect(base_url('admin/master/level_member'));
		} elseif ($x == "update_bonus") {
			$data = array(
				'nama_bonus'    => $this->input->post('nama_bonus'),
				'total_pv' 		=> $this->input->post('total_pv'),
				'keterangan'  	=> $this->input->post('keterangan')
			);

			$id_bonus = $this->input->post('id_bonus');
			$this->db->update("bonus", $data, array('id_bonus'  => $id_bonus));

			$this->alert('success', 'Bonus berhasil diubah...');
			redirect(base_url('admin/master/bonus'));
		} elseif ($x == "update_promo") {
			$data = array(
				'kode_promo'    => $this->input->post('kode_promo_edt'),
				'nama_promo'    => $this->input->post('nama_promo_edt'),
				'nilai' 		=> $this->input->post('nilai_edt'),
				'tipe' 			=> $this->input->post('tipe_edt'),
				'status' 		=> 1,
				'keterangan'  	=> $this->input->post('keterangan_edt')
			);

			$id_promo = $this->input->post('id_promo');
			$this->db->update("promo", $data, array('id_promo'  => $id_promo));

			$this->alert('success', 'Promo berhasil diubah...');
			redirect(base_url('admin/master/promo'));
		} elseif ($x == "update_courier") {
			$data = array(
				'nama_kurir'    => $this->input->post('nama_kurir_edt'),
				'status' 		=> 1,
				'keterangan'  	=> $this->input->post('keterangan_edt')
			);
			$id_kurir = $this->input->post('id_kurir');
			$this->db->update("kurir", $data, array('id_kurir'  => $id_kurir));

			$this->alert('success', 'Kurir berhasil diubah...');
			redirect(base_url('admin/master/courier'));
		} elseif ($x == "update_event") {
			$data = array(
				'event_name'    => $this->input->post('event_name_edt'),
				'id_location' 	=> $this->input->post('id_location_edt'),
				'date_start' 	=> $this->input->post('date_start_edt'),
				'date_end' 		=> $this->input->post('date_end_edt'),
				'address' 		=> $this->input->post('address_edt'),
				'note'  		=> $this->input->post('note_edt'),
				'tipe'  		=> $this->input->post('tipe_edt'),
				'status'  		=> $this->input->post('status_edt')
			);
			$id_event_schedule = $this->input->post('id_event_schedule');
			$this->db->update("event_schedule", $data, array('id_event_schedule'  => $id_event_schedule));

			$this->alert('success', 'Event berhasil diubah...');
			redirect(base_url('admin/master/event'));
		}
	}

	function act_edit_produk_harga(){
	
			$id_produk 				= $this->input->post('id_produk');
			$id_member_level 	= $this->input->post('id_member_level_post');
			$harga 						= $this->input->post('harga_edt');
			$this->db->query("UPDATE produk_harga SET harga='$harga' WHERE id_produk='$id_produk' AND id_member_level='$id_member_level'");

			$this->alert('success', 'Harga berhasil diubah...');
			$referred_from = $this->session->userdata('referred_add_price');
			redirect($referred_from);
		
	}

	// JSON
	public function get($x, $id)
	{
		$data = $this->db->query("SELECT * FROM $x WHERE id_$x = '$id'")->row();
		echo json_encode($data);
	}

	public function get_produk_harga($idp, $iml)
	{
		$data = $this->db->query("SELECT * FROM produk_harga WHERE id_produk = '$idp' AND id_member_level='$iml'")->row();
		echo json_encode($data);
	}

	function get_location_search()
	{
		$inputan  = $this->input->post('inputan');
		$q        = $this->db->query("SELECT  * FROM location
                                                WHERE
                                                -- role=3 AND
                                                location_name like '%$inputan%'")->result_array();
		$resp     = array();
		foreach ($q as $loc) {
			$resp[] = array("id" => $loc['id_location'], "text" => $loc['location_name']);
			echo json_encode($resp);
		}
	}

	public function get_slug()
	{
		$data = strtolower(url_title($this->input->post('slug')));
		echo $data;
	}

	function del($x, $id)
	{
		if ($x == "member_level") {
			$this->db->delete($x, array('id_member_level'  => $id));

			$this->alert('danger', 'Level member telah dihapus...');
			redirect(base_url('admin/master/level_member'));
		} elseif ($x == "bonus") {
			$this->db->delete($x, array('id_bonus'  => $id));

			$this->alert('danger', 'Bonus member telah dihapus...');
			redirect(base_url('admin/master/bonus'));
		} elseif ($x == "promo") {
			$this->db->delete($x, array('id_promo'  => $id));

			$this->alert('danger', 'Promo telah dihapus...');
			redirect(base_url('admin/master/bonus'));
		} elseif ($x == "courier") {
			$this->db->delete('kurir', array('id_kurir'  => $id));

			$this->alert('danger', 'Kurir telah dihapus...');
			redirect(base_url('admin/master/courier'));
		} elseif ($x == "event") {
			$this->db->delete('event_schedule', array('id_event_schedule'  => $id));

			$this->alert('danger', 'Event telah dihapus...');
			redirect(base_url('admin/master/event'));
		} elseif ($x == "produk_stok") {
			$this->db->delete($x, array('id_produk_stok'  => $id));

			$this->alert('danger', 'Update Stok telah dihapus...');
			$referred_from = $this->session->userdata('referred_add_stock');
			redirect($referred_from);
		} elseif ($x == "produk_link") {

			$data = array(
				'status' => 3
			);
			$this->db->delete($x, array('id_produk_link'  => $id));

			$this->alert('danger', 'Link');
			$referred_from = $this->session->userdata('referred_edit_video');
			redirect($referred_from);
		} elseif ($x == "transaksi") {

			$q 		= $this->db->query("	SELECT	commission,
													(SELECT id_upline FROM member WHERE id_member=transaksi.id_member) AS idu
											FROM transaksi
											WHERE id_transaksi='$id'")->row();
			$idu	= $q->idu;
			$com	= $q->commission;

			if (!empty($idu)) {
				date_default_timezone_set('Asia/Jakarta');
				$now = date("Y-m-d h:i:s");
				// Update nilai komisi di table member
				$this->db->query("	UPDATE member m1 SET 	m1.commission = m1.commission - $com,
															m1.commission_update='$now'
									WHERE m1.id_member=(SELECT m2.id_upline FROM (SELECT * FROM member) m2 WHERE m2.id_member=(SELECT id_member FROM transaksi WHERE id_transaksi=$id))");
			}


			$this->db->query("DELETE FROM transaksi_produk WHERE transaksi_produk.id_transaksi = '$id'");
			$this->db->query("DELETE FROM transaksi WHERE transaksi.id_transaksi = '$id'");

			$this->alert('danger', 'Data transaksi berhasil dihapus...');
			redirect(base_url('admin/transaction/all'));
		} elseif ($x == "member") {
			$this->db->delete($x, array('id_member'  => $id));

			$this->alert('danger', 'Member berhasil dihapus...');
			redirect(base_url('admin/member/all'));
		} elseif ($x == "product") {
			$this->db->delete($x, array('id_produk'  => $id));

			$this->alert('danger', 'Produk berhasil dihapus...');
			redirect(base_url('admin/product/all'));
		}
	}

	// Cek komisi bulan ini valid
	function com_valid($id, $d1, $d2)
	{
		$q 	= $this->db->query("	SELECT	SUM(total) AS tot,
											SELECT IF(SUM(total)>=1000, 'info', 'danger') AS hrg
									FROM transaksi
									WHERE id_member='$id'")->row();
	}

	// REKAP
	public function report()
	{
		$data['page']     = 'report';

		$tgl_1            = $this->input->post('tgl_1');
		$tgl_2            = $this->input->post('tgl_2');
		$data['tgl_1']    = $tgl_1;
		$data['tgl_2']    = $tgl_2;
		$cetak            = $this->input->post('cetak');

		$date 		= $this->input->post('date');
		$d 			= date_parse_from_format("Y-m-d", date($date));
		// $d 			= date("Y-m-d",strtotime($date));
		$bulan 		= $d["month"];
		$tahun 		= $d["year"];
		$cek_idm	= "WHERE transaksi.id_member IN (SELECT m2.id_member FROM member m2 WHERE id_upline=m1.id_member) AND";

		if (empty($date)) {
			$where = "$cek_idm MONTH(transaksi.tgl_pesan) = MONTH(CURDATE()) AND YEAR(transaksi.tgl_pesan) = YEAR(CURDATE())";
			$where2 = "WHERE transaksi.id_member=m1.id_member AND MONTH(transaksi.tgl_pesan) = MONTH(CURDATE()) AND YEAR(transaksi.tgl_pesan) = YEAR(CURDATE())";
		} else {
			die('aaa');
			$where 			= "$cek_idm MONTH(transaksi.tgl_pesan) = $bulan AND YEAR(transaksi.tgl_pesan) = $tahun";
			$where2 		= "WHERE transaksi.id_member=m1.id_member AND MONTH(transaksi.tgl_pesan) = $bulan AND YEAR(transaksi.tgl_pesan) = $tahun";
			$data['date']	= date($this->input->post('date'));
		}

		if (empty($cetak)) {
			$data['title']    = 'Laporan Transaksi';
			$this->load->view("admin/report/index", $data);
		} else {
			if ($cetak == "bulanan") {

				$data['title']    	= 'Laporan Bulanan Najah NET';
				$data['bulanan']  	= $this->db->query("SELECT 	m1.nama,
																	(SELECT nama_level FROM member_level WHERE id_member_level=m1.level) AS lv,
																	(SELECT COUNT(*) FROM (SELECT * FROM member) AS m2 WHERE id_upline=m1.id_member) AS team,
																	(SELECT SUM(pv) FROM transaksi WHERE transaksi.id_member=m1.id_member) AS pv_m,
																	(SELECT SUM(pv) FROM transaksi $where) AS pv_team,
																	(SELECT SUM(total) FROM transaksi WHERE transaksi.id_member=m1.id_member) AS tp,
																	(SELECT SUM(total) FROM transaksi $where) AS tt,
																	(SELECT SUM(commission) FROM transaksi $where) AS com,
																	(SELECT IF((SUM(total))>=(SELECT smp FROM member_level WHERE id_member_level=m1.level), 'green', 'red')  FROM transaksi $where2) AS color
															FROM member m1
															ORDER BY com DESC, pv_m DESC, pv_team DESC, tp DESC, tt DESC, team DESC, level ASC, nama ASC")->result();

				$this->load->view('admin/report/print_monthly', $data);
			} elseif ($cetak == "bonus") {

				$data['title']    	= 'Laporan Bonus Najah NET';
				$data['bulanan']  	= $this->db->query("SELECT 	m1.nama,
																	(SELECT nama_level FROM member_level WHERE id_member_level=m1.level) AS lv,
																	(SELECT COUNT(*) FROM (SELECT * FROM member) AS m2 WHERE id_upline=m1.id_member) AS team,
																	(SELECT ((SELECT SUM(quantity*(SELECT harga FROM produk WHERE id_produk=transaksi_produk.id_produk)) FROM transaksi_produk WHERE status IS NULL AND id_transaksi IN (SELECT id_transaksi FROM transaksi $where2)) - (SUM(total))) FROM transaksi $where2) AS pl,
																	-- (SELECT ((SELECT SUM(quantity) FROM transaksi_produk WHERE status IS NULL AND id_transaksi IN (SELECT id_transaksi FROM transaksi $where2))*(SELECT harga FROM produk WHERE id_produk=transaksi.id_produk))) - (SUM(total))) FROM transaksi $where2) AS pl,
																	(SELECT SUM(commission) FROM transaksi $where AND status = 3) AS pgm,
																	(SELECT SUM(commission) FROM transaksi $where AND status = 4) AS pt,
																	(SELECT SUM(pv) FROM transaksi $where) AS pb,
																	(SELECT SUM(total) FROM transaksi $where) AS ps,
																	(SELECT IF((SUM(total))>=(SELECT smp FROM member_level WHERE id_member_level=m1.level), 'green', 'red')  FROM transaksi $where2) AS color
															FROM member m1
															ORDER BY ps DESC, pgm DESC, pt DESC, pb DESC, pl DESC, team DESC, level ASC, nama ASC")->result();

				$this->load->view('admin/report/print_bonus', $data);
			} elseif ($cetak == "team") {

				$data['title']  = 'Laporan Team Najah NET';
				$data['team']  	= $this->db->query("SELECT 	m1.nama,
																	(SELECT nama_level FROM member_level WHERE id_member_level=m1.level) AS lv,
																	
																	(SELECT SUM(total) FROM transaksi WHERE id_member=m1.id_member AND status IN (3,4) AND MONTH(tgl_pesan) = MONTH(CURDATE()) AND YEAR(tgl_pesan) = YEAR(CURDATE())) AS beli,
																	(SELECT smp FROM member_level WHERE member_level.id_member_level=m1.level) AS minim,
	
																	(SELECT COUNT(*) FROM member m2 WHERE m2.id_upline=m1.id_member) AS team,
																	(SELECT SUM(pv) FROM transaksi WHERE transaksi.id_member=m1.id_member) AS pv_m,
																	(SELECT SUM(pv) FROM transaksi $where) AS pv_team
															FROM member m1
															ORDER BY team DESC, pv_m DESC, pv_team DESC, nama ASC")->result();

				$this->load->view('admin/report/print_team', $data);
			} elseif ($cetak == "pv") {

				$data['title']	= 'Laporan Poin Penjualan (PV) Najah NET';
				$data['pv']  	= $this->db->query("SELECT 	m1.nama,
																	(SELECT nama_level FROM member_level WHERE id_member_level=m1.level) AS lv,
																	(SELECT COUNT(*) FROM member m2 WHERE m2.id_upline=m1.id_member) AS team,
																	(SELECT SUM(pv) FROM transaksi $where) AS pv_team,
																	(SELECT nama_bonus FROM bonus WHERE id_bonus=(SELECT id_bonus FROM commission_wd AS a WHERE date_update=(SELECT MAX(date_update) FROM commission_wd AS b WHERE a.id_member=m1.id_member AND a.tipe=0))) AS hadiah,
																	(SELECT status FROM commission_wd AS c WHERE date_update=(SELECT MAX(date_update) FROM commission_wd AS d WHERE c.id_member=m1.id_member AND c.tipe=0)) AS ket
															FROM member m1
															ORDER BY hadiah DESC, pv_team DESC, team DESC, nama ASC")->result();

				$this->load->view('admin/report/print_pv', $data);
			}
		}
	}

	function send_push_notification($x, $y, $z)
	{
		// $x : tipe notifikasi, $y : id_level_member, $z : id_pesan
		// Server key from Firebase Console
		define('API_ACCESS_KEY', 'AAAA0K7wIxo:APA91bHI8y3pt_qi9F1C-RMURTs8jA2MQLFbiLSrftD78rsDnU7N1ywrc7PwoZFLAAdpZU7nrBu-Y2CHV9hdWcm-RTJaSXSVrwjSHkbOW1Us2zcbU5jAdtRBhc6EbQ9e5j6l5yrBHlE3');

		if ($x == "send_now") {

			$member_to 	= $this->db->query("SELECT token FROM push_notification WHERE id_member IN (SELECT id_member FROM member WHERE level='$y')")->result();
			$message 		= $this->db->query("SELECT * FROM push_notification_msg WHERE id_push_notification_msg='$z'")->row();

			foreach ($member_to as $mt) {
				$data = array(
					"to" => "$mt->token",
					"notification" => array("title" => "$message->title", "body" => "$message->body", "icon" => "$message->icon", "click_action" => "$message->action_link")
				);
			}
		} elseif ($x == "send_periode") {
			$data = array(
				"to" => "cNf2---6Vs9",
				"notification" => array("title" => "Shareurcodes.com", "body" => "A Code Sharing Blog!", "icon" => "icon.png", "click_action" => "http://shareurcodes.com")
			);
		}

		$data_string = json_encode($data);
		// echo "The Json Data : " . $data_string;

		$headers = array(
			'Authorization: key=' . API_ACCESS_KEY,
			'Content-Type: application/json'
		);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

		$result = curl_exec($ch);

		curl_close($ch);

		// echo "<p>&nbsp;</p>";
		// echo "The Result : " . $result;

		$this->alert('info', 'JSON DATA : ' . $data_string . '<p>&nbsp;</p> RESULT : ' . $result . '');
		redirect('admin/push_notification_msg');
	}

	// Flashdata Report
	function alert($x, $y)
	{
		// $x : warna
		// $y : pesan
		return $this->session->set_flashdata("report", "<div class='alert alert-$x alert-dismissible fade show' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>$y</strong></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>");
	}
}
