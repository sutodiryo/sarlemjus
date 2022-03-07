<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
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
		$this->session->mark_as_temp('report', 1);
		$this->load->model('Member_data');
	}

	function list($x)
	{
		$data['page'] = 'member';

		$data['member_stat'] = $this->Member_data->get_member_stat();
		$q = $this->Member_data->get_member_list();
		if ($x == "all") {
			$data['title'] = 'Daftar Semua Member';
			$data['title2'] = '';
			$data['member'] = $this->db->query("$q ORDER BY level ASC, name ASC")->result();
		} else {
			$data['title'] = 'Daftar Member';
			$data['title2'] = $this->Member_data->get_member_level_detail($x);
			$data['member'] = $this->db->query("$q AND level=$x ORDER BY name ASC")->result();
		}
		$this->load->view('admin/member/list', $data);
	}

	function detail($id)
	{
		$data['page'] = 'member';
		$data['title'] = 'Detail Member';
		$data['member'] = $this->Member_data->get_member_detail($id);
		$data['downline'] = $this->Member_data->get_member_downline($id);
		$this->load->view('admin/member/detail', $data);
	}

	function add($x)
	{
		if ($x == "new") {

			$data['page'] = 'member';
			$data['title'] = 'Tambah Member Baru';
			$data['upline'] = $this->db->query("SELECT member.id,member.name,member.phone FROM member ORDER BY member.name ASC")->result();
			$data['level'] = $this->db->query("SELECT id,name FROM member_level ORDER BY id ASC")->result();
			$data['bank'] = $this->db->query("SELECT id,name FROM bank ORDER BY id ASC")->result();

			$this->form_validation->set_rules('name', 'Nama', 'required', ['required' => 'Nama member belum diisi!']);
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|trim|is_unique[member.email]', ['required' => 'Email belum diisi!', 'valid_email' => 'Format email salah!', 'is_unique' => 'Email sudah terdaftar']);
			$this->form_validation->set_rules('phone', 'Nomor Handphone', 'required|trim|is_unique[member.phone]', ['required' => 'Nomor Handphone belum diisi!', 'is_unique' => 'Nomor Handphone sudah terdaftar']);
			$this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required', ['required' => 'Anda belum memilih jenis kelamin!']);
			$this->form_validation->set_rules('nik', 'NIK', 'required|trim|is_unique[member.nik]', ['required' => 'NIK Handphone belum diisi!', 'is_unique' => 'NIK sudah terdaftar']);
			$this->form_validation->set_rules('level', 'Level Member', 'required', ['required' => 'Anda belum memilih level member!']);

			if ($this->form_validation->run() == false) {
				// $this->alert('warning', 'Ada beberapa field yang tidak sesuai...');
				// $this->add('new');
				// die('aaa');
				$this->load->view('admin/member/add', $data);

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
				redirect(base_url('admin/member/list/all'));
			}
		} elseif ($x == "level") {

			$data = array(
				'name' => $this->input->post('name'),
				'min_trans' => $this->input->post('min_trans'),
				'discount' => $this->input->post('discount'),
				'note' => $this->input->post('note')
			);

			$this->db->insert('member_level', $data);

			$this->alert('info', 'Level Member berhasil ditambahkan...');
			redirect(base_url('admin/member/level'));
		}
	}

	function level()
	{

		$data['page'] = 'member';
		$data['title'] = 'Level Member';
		$data['level'] = $this->Member_data->get_member_level_list();
		$this->load->view('admin/member/level', $data);
	}

	function edit($x, $y)
	{
		if ($x == "member") {
			$data['page'] 		= 'member';
			$data['title'] 		= 'Edit Member';
			$data['member'] 	= $this->db->query("SELECT * FROM member WHERE id_member='$y'")->result();
			// $data['video'] 		= $this->db->query("SELECT id_produk_link,id_produk,nama_link,link,deskripsi,status FROM produk_link WHERE id_produk='$y' AND status=1")->result();
			$this->load->view('admin/member/edit', $data);
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
		} elseif ($x == "upline") {
			$id_upline = $this->input->post('id_upline');
			$this->db->query("UPDATE $y SET id_upline = '$id_upline' WHERE id_member ='$z'");
			$page = "base_url('admin/member/list/all')";
		}

		$this->alert('warning', 'Data berhasil diupdate...');
		redirect($page);
	}

	function act($x, $id)
	{
		date_default_timezone_set('Asia/Jakarta');
		$now = date("Y-m-d h:i:s");

		if ($x == "update_member") {
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
			redirect(base_url('admin/member/list/all'));
		} elseif ($x == "password_member") {
			$data = array(
				'password' => "e10adc3949ba59abbe56e057f20f883e"
			);
			$this->db->update("member", $data, array('id_member'  => $id));

			$this->alert('warning', 'Password member berhasil direset menjadi (123456)');
			$referred_from = $this->session->userdata('ref_member');
			redirect($referred_from);
		} elseif ($x == "update_member_level") {
			
			$data = array(
				'name' => $this->input->post('name'),
				'min_trans' => $this->input->post('min_trans'),
				'discount' => $this->input->post('discount'),
				'note' => $this->input->post('note')
			);

			$id = $this->input->post('id');
			$this->db->update("member_level", $data, array('id'  => $id));

			$this->alert('info', 'Level Member berhasil diubah...');
			redirect(base_url('admin/member/level'));
		}
	}

	// JSON
	public function get($x, $id)
	{
		$data = $this->db->query("SELECT * FROM $x WHERE id_$x = '$id'")->row();
		echo json_encode($data);
	}

	function del($id)
	{
		$this->db->query("UPDATE member SET status = 9 WHERE member.id = '$id'");

		$this->alert('danger', 'Member berhasil dihapus...');
		redirect(base_url('admin/member/list/all'));
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
}
