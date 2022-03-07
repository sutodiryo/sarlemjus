<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('log_valid') == FALSE) {
      $this->session->set_flashdata("report", "<div class='alert alert-danger alert-dismissible fade show' role='alert'><small>Anda harus login terlebih dahulu.</small><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>");
      redirect(base_url('login'));
    } elseif ($this->session->userdata('log_admin') == FALSE) {
      // echo "Akses ditolak";
      $this->alert('danger', 'Akses ditolak');
      redirect(base_url('member'));
    }
    $this->load->model('Master_data');
  }

  function product($x)
  {
    $data['page'] = 'product';

    if ($x == 'all') {
      $data['title'] = 'Master Produk';
    }

    $data['product'] = $this->Master_data->get_product_list($x); //Import struktur data product dari ilufa
    $this->load->view('admin/master/product/list', $data);
  }

  function product_stock($id_product)
  {
    $data['page'] = 'product';
    $data['title'] = 'Stok Produk';

    $data['product'] = $this->Master_data->get_product_by_id($id_product);
    $data['product_stock'] = $this->Master_data->get_product_stock($id_product); //Import struktur data product dari ilufa
    $this->load->view('admin/master/product/stock', $data);
  }

  function product_brand()
  {
    $data['page'] = 'product';
    $data['title'] = 'Brand Produk';

    $data['brand'] = $this->Master_data->get_product_brand();
    $this->load->view('admin/master/product/brand', $data);
  }

  function product_category()
  {
    $data['page'] = 'product';
    $data['title'] = 'Kategori Produk';

    $data['brand'] = $this->Master_data->get_product_category();
    $this->load->view('admin/master/product/category', $data);
  }

  function product_unit()
  {
    $data['page'] = 'product';
    $data['title'] = 'Satuan Produk';

    $data['brand'] = $this->Master_data->get_product_unit();
    $this->load->view('admin/master/product/unit', $data);
  }

  function bonus()
  {
    $data['page'] = 'bonus';

    $data['title'] = 'Master Data Bonus';

    $data['bonus'] = $this->Master_data->get_bonus_list();
    $this->load->view('admin/master/bonus/list', $data);
  }

  function course()
  {
    $data['page'] = 'course';

    $data['title'] = 'Master Data Kategori Course';

    $data['course'] = $this->Master_data->get_course_category_list();
    $data['member_level'] = $this->db->query("SELECT id,name FROM member_level")->result();
    $this->load->view('admin/master/course/list_category', $data);
  }

  function course_list($id_category)
  {
    $data['page'] = 'course';

    $data['title'] = 'Master Data Course';

    $data['course'] = $this->Master_data->get_course_category_by_id($id_category);
    $data['course_youtube'] = $this->Master_data->get_course_list($id_category);
    $this->load->view('admin/master/course/list_course', $data);
  }

  function notice()
  {
    $data['page'] = 'notice';

    $data['title'] = 'Master Data Pengumuman';

    $data['notice'] = $this->Master_data->get_notice_list();
    $data['member_level'] = $this->db->query("SELECT id,name FROM member_level")->result();
    $this->load->view('admin/master/notice/list', $data);
  }

  //ACT
  function add($x)
  {
    date_default_timezone_set('Asia/Jakarta');
    $now = date("Y-m-d h:i:s");

    if ($x == "member") {
      date_default_timezone_set('Asia/Jakarta');
      $now     = date("Y-m-d h:i:s");
      $data     = array(
        'nama' => $this->input->post('nama'),
        'id_upline' => $this->input->post('id_upline'),
        'no_hp' => $this->input->post('no_hp'),
        'email' => $this->input->post('email'),
        'password' => "e10adc3949ba59abbe56e057f20f883e",
        'id_location' => $this->input->post('id_location'),
        'level' => $this->input->post('level'),
        'alamat' => $this->input->post('alamat'),
        'tgl_reg' => $now,
        'notif_admin' => 1,
        'status' => 1
      );

      $this->db->insert('member', $data);

      $this->alert('info', 'Member berhasil ditambahkan...');
      redirect(base_url('admin/member/all'));
    } elseif ($x == "product") {

      $data['page'] = 'product';
      $data['title'] = 'Tambah Produk';
      
      $data['brand'] = $this->db->query("SELECT id,name FROM product_brand")->result();
      $data['level'] = $this->db->query("SELECT id,name FROM member_level ORDER BY id ASC")->result();
      $data['bank'] = $this->db->query("SELECT id,name FROM bank ORDER BY id ASC")->result();

      $this->form_validation->set_rules('name', 'Nama', 'required', ['required' => 'Nama member belum diisi!']);
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|trim|is_unique[member.email]', ['required' => 'Email belum diisi!', 'valid_email' => 'Format email salah!', 'is_unique' => 'Email sudah terdaftar']);
      $this->form_validation->set_rules('phone', 'Nomor Handphone', 'required|trim|is_unique[member.phone]', ['required' => 'Nomor Handphone belum diisi!', 'is_unique' => 'Nomor Handphone sudah terdaftar']);
      $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required', ['required' => 'Anda belum memilih jenis kelamin!']);
      $this->form_validation->set_rules('nik', 'NIK', 'required|trim|is_unique[member.nik]', ['required' => 'NIK Handphone belum diisi!', 'is_unique' => 'NIK sudah terdaftar']);
      $this->form_validation->set_rules('level', 'Level Member', 'required', ['required' => 'Anda belum memilih level member!']);

      if ($this->form_validation->run() == false) {
        $this->alert('warning', 'Ada beberapa field yang tidak sesuai...');
        // $this->add('new');
        // die('aaa');
        $this->load->view('admin/master/product/add', $data);

        // redirect('admin/member/add/new');
      } else {
        $config['upload_path']      = './public/upload/member/';
        $config['allowed_types']    = 'jpg|jpeg|png|PNG|JPG';
        $config['max_size']         = 1024;
        $config['encrypt_name']     = TRUE;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('img')) {

          // $error = $this->upload->display_errors();
          // $this->alert('danger', $error);

          // redirect('admin/member/add/new');
          $img = "profile.jpg";
        } else {
          $up = $this->upload->data();
          $img = $up['file_name'];
        }

        date_default_timezone_set('Asia/Jakarta');
        $now = date("Y-m-d h:i:s");

        $data = array(
          'name' => $this->input->post('name'),
          'upline' => $this->input->post('upline'),
          'phone' => $this->input->post('phone'),
          'email' => $this->input->post('email'),
          'password' => "e10adc3949ba59abbe56e057f20f883e",
          'gender' => $this->input->post('gender'),
          // 'img' => $this->input->post('img'),
          'img' => $img, //file upload foto
          'nik' => $this->input->post('nik'),
          'nik_name' => $this->input->post('nik_name'),
          'npwp' => $this->input->post('npwp'),
          'npwp_name' => $this->input->post('npwp_name'),
          'bank' => $this->input->post('bank'),
          'bank_account' => $this->input->post('bank_account'),
          'bank_account_name' => $this->input->post('bank_account_name'),
          'province' => $this->input->post('province'),
          'district' => $this->input->post('district'),
          'subdistrict' => $this->input->post('subdistrict'),
          'village' => $this->input->post('village'),
          'postal_code' => $this->input->post('postal_code'),
          'work' => $this->input->post('work'),
          'level' => $this->input->post('level'),
          'address' => $this->input->post('address'),
          'registration_date' => $now,
          'notif_admin' => 1,
          'status' => 1
        );

        $this->db->insert('member', $data);

        $this->alert('info', 'Member berhasil ditambahkan...');
        redirect(base_url('admin/member/all'));
      }
    } elseif ($x == "produk_harga") {
      $data = array(
        'id_produk' => $this->input->post('id_produk'),
        'id_member_level' => $this->input->post('id_member_level'),
        'harga' => $this->input->post('harga')
      );

      $this->db->insert('produk_harga', $data);

      $this->alert('info', 'Harga berhasil ditambahkan...');
      $referred_from = $this->session->userdata('referred_add_price');
      redirect($referred_from);
    } elseif ($x == "produk_stock") {
      $data = array(
        'id_admin' => $this->session->userdata('log_id'),
        'stock_update' => $this->input->post('stock_update'),
        'note' => $this->input->post('note'),
        'id_produk' => $this->input->post('id_produk')
      );

      $this->db->insert('produk_stok', $data);

      $this->alert('info', 'Stok berhasil ditambahkan...');
      $referred_from = $this->session->userdata('referred_add_stock');
      redirect($referred_from);
    } elseif ($x == "transaction") {
      $im = $this->input->post('id_member');
      $ip = $this->input->post('id_promo');
      $date = $this->input->post('date');
      $ongkir = $this->input->post('ongkir');
      $tipe = 0; //pembelian member

      $data = $this->Admin_model->transaction_add($im, $ip, $date, $ongkir, $tipe);

      $this->db->insert('transaksi', $data);
      $insert_id = $this->db->insert_id();

      $transaksi_produk = array();
      foreach ($this->cart->contents() as $cart) {
        $id = $cart['id'];
        $q = $this->db->query("SELECT nilai FROM produk WHERE id_produk='$id'")->row();
        $ppv = $q->nilai;
        $transaksi_produk[] = array(
          'id_transaksi' => $insert_id,
          'id_produk' => $id,
          'quantity' => $cart['qty'],
          'price' => $cart['price'],
          'pv' => $cart['qty'] * $ppv
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
    } elseif ($x == "bonus") {
      $data = array(
        'name' => $this->input->post('name'),
        'poin' => $this->input->post('poin')
      );

      $this->db->insert('bonus', $data);

      $this->alert('info', 'Bonus berhasil ditambahkan...');
      redirect(base_url('admin/master/bonus'));
    } elseif ($x == "courier") {
      $data = array(
        'nama_kurir'    => $this->input->post('nama_kurir'),
        'status'         => 1,
        'keterangan'      => $this->input->post('keterangan')
      );

      $this->db->insert('kurir', $data);

      $this->alert('info', 'Kurir berhasil ditambahkan...');
      redirect(base_url('admin/master/courier'));
    } elseif ($x == "promo") {
      $data = array(
        'kode_promo'    => $this->input->post('kode_promo'),
        'nama_promo'    => $this->input->post('nama_promo'),
        'nilai'         => $this->input->post('nilai'),
        'tipe'             => $this->input->post('tipe'),
        'status'         => 1,
        'keterangan'      => $this->input->post('keterangan')
      );

      $this->db->insert('promo', $data);

      $this->alert('info', 'Promo berhasil ditambahkan...');
      redirect(base_url('admin/master/promo'));
    } elseif ($x == "notice") {
      $data = array(
        'title'    => $this->input->post('title'),
        'content'     => $this->input->post('content'),
        'date_start'     => $this->input->post('date_start'),
        'date_end'         => $this->input->post('date_end'),
        'status'        => 1
      );

      $this->db->insert($x, $data);

      $this->alert('info', 'Pengumuman berhasil ditambahkan...');
      redirect(base_url('admin/master/notice'));
    } elseif ($x == "promo_level") {
      $data = array(
        'id_promo'         => $this->input->post('id_promo'),
        'id_member_level'     => $this->input->post('id_member_level'),
        'date_start'              => $this->input->post('date_start'),
        'date_end'              => $this->input->post('date_end'),
        'status'              => $this->input->post('status')
      );

      $this->db->insert('promo_level', $data);

      $this->alert('info', 'Data berhasil ditambahkan...');
      $referred_from = $this->session->userdata('referred_add_promo_level');
      redirect($referred_from);
    } elseif ($x == "push_notification_msg") {

      date_default_timezone_set('Asia/Jakarta');
      $now = date("Y-m-d h:i:s");

      $data = array(
        'title'     => $this->input->post('title'),
        'body'              => $this->input->post('body'),
        'icon'              => 'favicon.png',
        'action_link'              => $this->input->post('action_link'),
        'last_update'              => $now
      );

      $this->db->insert('push_notification_msg', $data);

      $this->alert('info', 'Data berhasil ditambahkan...');
      redirect('admin/push_notification_msg');
    }
  }

  function edit($x, $y)
  {
    if ($x == "produk") {
      $data['page']         = 'product';
      $data['title']         = 'Edit Produk';
      $data['produk']     = $this->db->query("SELECT * FROM produk WHERE id_produk='$y'")->row();
      $this->load->view('admin/product/edit', $data);
    } elseif ($x == "member") {
      $data['page']         = 'member';
      $data['title']         = 'Edit Member';
      $data['member']     = $this->db->query("SELECT * FROM member WHERE id_member='$y'")->result();
      // $data['video'] 		= $this->db->query("SELECT id_produk_link,id_produk,nama_link,link,deskripsi,status FROM produk_link WHERE id_produk='$y' AND status=1")->result();
      $this->load->view('admin/member/edit', $data);
    } elseif ($x == "produk_harga") {
      $data['page']             = 'product';
      $data['title']             = 'Harga Produk';
      $data['produk']         = $this->db->query("SELECT id_produk,nama_produk FROM produk WHERE id_produk='$y'")->row();

      $data['harga_produk']    = $this->db->query("SELECT 	id_produk,id_member_level,harga,
																	(SELECT nama_produk FROM produk WHERE id_produk=produk_harga.id_produk) AS produk,
																	(SELECT nama_level FROM member_level WHERE id_member_level=produk_harga.id_member_level) AS nama_level
															FROM produk_harga WHERE id_produk='$y'")->result();
      $data['member_level']     = $this->db->query("SELECT * FROM member_level
															WHERE id_member_level NOT IN (SELECT id_member_level FROM produk_harga WHERE id_produk='$y')")->result();
      $data['member_level_edt']     = $this->db->query("SELECT * FROM member_level")->result();

      $this->load->view('admin/product/harga', $data);
    } elseif ($x == "produk_stock") {
      $data['page']             = 'product';
      $data['title']             = 'Stok Produk';
      $data['produk']         = $this->db->query("SELECT id_produk,nama_produk FROM produk WHERE id_produk='$y'")->row();
      $data['stat']             = $this->db->query("SELECT SUM(stock_update) AS tot FROM produk_stok WHERE produk_stok.id_produk='$y'")->row();

      $data['stock_produk']    = $this->db->query("SELECT 		id_produk,id_produk_stok,id_admin,id_produk,stock_update,note,update_time,
																	(SELECT name FROM admin WHERE id_admin=produk_stok.id_admin) AS admin,
																	(SELECT satuan FROM produk WHERE id_produk=produk_stok.id_produk) AS satuan
														FROM produk_stok WHERE id_produk='$y'")->result();

      $this->load->view('admin/product/stock', $data);
    } elseif ($x == "promo_level") {
      $data['page']             = 'promo';
      $data['title']             = 'Promo';
      $data['promo']             = $this->db->query("SELECT id_promo,kode_promo,nama_promo FROM promo WHERE id_promo='$y'")->row();

      $data['promo_level']    = $this->db->query("SELECT 	id_promo,id_member_level,date_start,date_end,status,
																	(SELECT nama_promo FROM promo WHERE id_promo=promo_level.id_promo) AS promo,
																	(SELECT kode_promo FROM promo WHERE id_promo=promo_level.id_promo) AS kode_promo,
																	(SELECT nama_level FROM member_level WHERE id_member_level=promo_level.id_member_level) AS nama_level
															FROM promo_level WHERE id_promo='$y'")->result();
      $data['member_level']     = $this->db->query("SELECT * FROM member_level
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

      $q         = $this->db->query("	SELECT 	t1.id_member,t1.total,t1.commission,t1.status,
																					(SELECT id_upline FROM member WHERE member.id_member=t1.id_member) AS idu,
																					(SELECT nilai FROM member_level WHERE id_member_level=(SELECT level FROM member WHERE id_member=t1.id_member)) AS mv,
																					(SELECT	COUNT(t2.id_transaksi) FROM (SELECT * FROM transaksi) AS t2 WHERE t2.id_member=t1.id_member) AS tr
																			FROM transaksi t1
																			WHERE t1.id_transaksi='$z'")->row();
      $tot        = $q->total;
      $com1        = $q->commission;
      $status = $q->status;
      $idu         = $q->idu;
      $mv            = $q->mv;
      $tr         = $q->tr;

      if (!empty($idu)) {
        if ($y == 1) {
          if ($status == 0) {
            if ($tr > 1) {
              $com     = ((5 / 100) * $tot) * $mv;
              $st     = $y;
            } else {
              $com     = ((10 / 100) * $tot) * $mv;
              $st     = 4;
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
            $com     = ((5 / 100) * $tot) * $mv;
            $uc     = ($com1 - $com);

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
          $com2     = ((10 / 100) * $tot) * $mv;
          $uc     = ($com1 - $com2);

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
          $com2     = ((10 / 100) * $tot) * $mv;
          $uc     = ($com1 - $com2);

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

      $q         = $this->db->query("	SELECT 	t1.id_member,t1.total,t1.commission,t1.status,
													(SELECT id_upline FROM member WHERE member.id_member=t1.id_member) AS idu,
													(SELECT nilai FROM member_level WHERE id_member_level=(SELECT level FROM member WHERE id_member=t1.id_member)) AS mv,
													(SELECT	COUNT(t2.id_transaksi) FROM (SELECT * FROM transaksi) AS t2 WHERE t2.id_member=t1.id_member) AS tr
											FROM transaksi t1
											WHERE t1.id_transaksi='$z'")->row();
      $tot    = $q->total;
      $com1    = $q->commission;
      $status = $q->status;
      $idu     = $q->idu;
      $mv        = $q->mv;
      $tr     = $q->tr;

      if (!empty($idu)) {
        if ($y == 1) {
          $this->db->query("UPDATE transaksi SET status = '$y' WHERE id_transaksi = '$z'");
        } elseif ($y == 2) {
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
      $im     = $this->input->post('id_member');
      $ip     = $this->input->post('id_produk');
      $pq     = $this->input->post('product_quantity');
      $date     = $this->input->post('date');
      $tipe     = $this->input->post('tipe');

      $data     = $this->transaction_f($im, $ip, $pq, $date, $tipe);

      $id_transaksi = $this->input->post('id_transaksi');
      $this->db->update("transaksi", $data, array('id_transaksi'  => $id_transaksi));

      $this->alert('success', 'Data berhasil diupdate...');
      redirect(base_url('admin/transaction/all'));
    } elseif ($x == "update_product") {

      $referred_from = $this->session->userdata('ref_edit_product');
      $data = array(
        'slug'                         => $this->input->post('slug'),
        'nama_produk'             => $this->input->post('nama_produk'),
        'harga'                          => $this->input->post('harga'),
        'satuan'                      => $this->input->post('satuan'),
        'berat'                          => $this->input->post('berat'),
        'nilai'                          => $this->input->post('nilai'),
        'keterangan'              => $this->input->post('keterangan')
      );

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
        'nama'             => $this->input->post('nama'),
        'id_upline'     => $this->input->post('id_upline'),
        'no_hp'         => $this->input->post('no_hp'),
        'email'         => $this->input->post('email'),
        'id_location'   => $this->input->post('kota'),
        'level'          => $this->input->post('level'),
        'alamat'          => $this->input->post('alamat')
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

      $no_hp     = $this->input->post('no_hp');
      $resi    = $this->input->post('resi');

      $data = array(
        'status'    => 2,
        'resi'        => $resi,
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
        'nilai'         => $this->input->post('nilai'),
        'smp'             => $this->input->post('smp'),
        'diskon'         => $this->input->post('diskon'),
        'keterangan'      => $this->input->post('keterangan')
      );

      $id_member_level = $this->input->post('id_member_level');
      $this->db->update("member_level", $data, array('id_member_level'  => $id_member_level));

      $this->alert('success', 'Level Member berhasil diubah...');
      redirect(base_url('admin/master/level_member'));
    } elseif ($x == "update_bonus") {
      $data = array(
        'name' => $this->input->post('name'),
        'poin' => $this->input->post('poin')
      );

      $id = $this->input->post('id');
      $this->db->update("bonus", $data, array('id'  => $id));

      $this->alert('info', 'Bonus berhasil diubah...');
      redirect(base_url('admin/master/bonus'));
    } elseif ($x == "update_promo") {
      $data = array(
        'kode_promo'    => $this->input->post('kode_promo_edt'),
        'nama_promo'    => $this->input->post('nama_promo_edt'),
        'nilai'         => $this->input->post('nilai_edt'),
        'tipe'             => $this->input->post('tipe_edt'),
        'status'         => 1,
        'keterangan'      => $this->input->post('keterangan_edt')
      );

      $id_promo = $this->input->post('id_promo');
      $this->db->update("promo", $data, array('id_promo'  => $id_promo));

      $this->alert('success', 'Promo berhasil diubah...');
      redirect(base_url('admin/master/promo'));
    } elseif ($x == "update_courier") {
      $data = array(
        'nama_kurir'    => $this->input->post('nama_kurir_edt'),
        'status'         => 1,
        'keterangan'      => $this->input->post('keterangan_edt')
      );
      $id_kurir = $this->input->post('id_kurir');
      $this->db->update("kurir", $data, array('id_kurir'  => $id_kurir));

      $this->alert('success', 'Kurir berhasil diubah...');
      redirect(base_url('admin/master/courier'));
    } elseif ($x == "update_notice") {
      $data = array(
        'title'    => $this->input->post('title'),
        'content'     => $this->input->post('content'),
        'date_start'     => $this->input->post('date_start'),
        'date_end'         => $this->input->post('date_end'),
        'status'        => 1
      );

      $id = $this->input->post('id');
      $this->db->update("notice", $data, array('id'  => $id));

      $this->alert('info', 'Pengumuman berhasil diubah...');
      redirect(base_url('admin/master/notice'));
    } elseif ($x == "add_notice_target") {
      $id = $this->input->post('id');

      $data = array();
      foreach ($this->input->post('member_level') as $ml) {
        $data[] = array(
          'id_notice' => $id,
          'id_member_level' => $ml
        );
      }
      $this->db->insert_batch('notice_target', $data);

      $this->alert('info', 'Target Pengumuman berhasil diupdate...');
      redirect(base_url('admin/master/notice'));
    } elseif ($x == "add_course_category") {
      $config['upload_path']      = './public/upload/course/category/';
      $config['allowed_types']    = 'jpg|jpeg|png|PNG|JPG';
      $config['max_size']         = 1024;
      $config['encrypt_name']     = TRUE;
      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('cover')) {

        $error = $this->upload->display_errors();
        $this->alert('danger', $error);

        redirect('admin/master/course');
      } else {
        $up = $this->upload->data();
        $cover = $up['file_name'];
      }
      $data = array(
        'name' => $this->input->post('name'),
        'cover' => $cover, //file upload cover
        'status' => 1
      );

      $this->db->insert('course_category', $data);

      $this->alert('info', 'Kategori kelas berhasil ditambahkan...');
      redirect(base_url('admin/master/course'));
    } elseif ($x == "add_course_category_access") {
      $id = $this->input->post('id');

      $data = array();
      foreach ($this->input->post('member_level') as $ml) {
        $data[] = array(
          'id_course_category' => $id,
          'id_member_level' => $ml
        );
      }
      $this->db->insert_batch('course_acces', $data);

      $this->alert('info', 'Akses Kategori Kelas berhasil diupdate...');
      redirect(base_url('admin/master/course'));
    } elseif ($x == "add_course") {

      $data = array(
        'slug' => $this->input->post('slug'),
        'title' => $this->input->post('title'),
        'category' => $id,
        'media_link' => $this->input->post('media_link'),
        'description' => $this->input->post('description'),
        'tipe' => 1 //default
      );

      $this->db->insert('course', $data);

      $this->alert('info', 'Kelas berhasil ditambahkan...');
      $referred_link = $this->session->userdata('referred_course_category');
      redirect($referred_link);
    } elseif ($x == "update_course") {
      $data = array(
        'slug' => $this->input->post('slug_edit'),
        'title' => $this->input->post('title_edit'),
        'media_link' => $this->input->post('media_link'),
        'description' => $this->input->post('description')
      );
      $slug = $this->input->post('slug');
      $this->db->update("course", $data, array('slug'  => $slug));

      $this->alert('info', 'Kelas berhasil diubah...');
      $referred_link = $this->session->userdata('referred_course_category');
      redirect($referred_link);
    }
  }


  // DELETE
  function del($x, $id)
  {
    if ($x == "member_level") {
      $this->db->delete($x, array('id_member_level'  => $id));

      $this->alert('danger', 'Level member telah dihapus...');
      redirect(base_url('admin/master/level_member'));
    } elseif ($x == "bonus") {
      $this->db->delete($x, array('id'  => $id));

      $this->alert('danger', 'Bonus telah dihapus...');
      redirect(base_url('admin/master/bonus'));
    } elseif ($x == "promo") {
      $this->db->delete($x, array('id_promo'  => $id));

      $this->alert('danger', 'Promo telah dihapus...');
      redirect(base_url('admin/master/bonus'));
    } elseif ($x == "courier") {
      $this->db->delete('kurir', array('id_kurir'  => $id));

      $this->alert('danger', 'Kurir telah dihapus...');
      redirect(base_url('admin/master/courier'));
    } elseif ($x == "notice") {
      $this->db->delete('notice', array('id'  => $id));

      $this->alert('danger', 'Pengumuman telah dihapus...');
      redirect(base_url('admin/master/notice'));
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

      $q     = $this->db->query("	SELECT	commission,
													(SELECT id_upline FROM member WHERE id_member=transaksi.id_member) AS idu
											FROM transaksi
											WHERE id_transaksi='$id'")->row();
      $idu  = $q->idu;
      $com  = $q->commission;

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
    } elseif ($x == "course") {
      $this->db->delete('course', array('slug'  => $id));

      $this->alert('danger', 'Kelas berhasil dihapus...');
      $referred_link = $this->session->userdata('referred_course_category');
      redirect($referred_link);
    }
  }
}
