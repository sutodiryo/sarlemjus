<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shipping extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('log_valid') == FALSE) {
      redirect(base_url('login'));
    }
    $this->load->model('Transaction_data');
  }

  #cek resi
  function cek_resi()
  {
    $captcha_code = $this->input->post('captcha_code', TRUE);
    $current_captcha = $this->session->userdata('captcha_code');
    if ($captcha_code != $current_captcha) {
      $result['status'] = 0;
      $result['message'] = "Wrong Captcha";
      $result['result'] = false;
    } else {
      $resi = $this->input->post('resi', TRUE);
      $courier = $this->input->post('courier', TRUE);
      if (empty($resi) && empty($courier)) {
        $result['status'] = 0;
        $result['message'] = "Please, fill all field data";
        $result['result'] = false;
      } else {

        $this->load->library('Rajaongkir');
        $rajaongkir = new Rajaongkir;
        $data = $rajaongkir->_api_waybill($resi, $courier);
        $data = json_decode($data, true);
        $result['status'] = 1;
        $result['message'] = "Success";
        $result['result'] = $data['rajaongkir'];
      }
    }
    header('Content-type: text/javascript');
    echo json_encode($result);
  }

  function result_waybill()
  {
    $data = $this->input->post('data');
    $data['data'] = $data['result']['result'];
    $this->load->view('frontend/result_cek_resi', $data);
  }

  function get_provinsi()
  {
    $this->load->library('Rajaongkir');
    $rajaongkir = new Rajaongkir;
    $provinsi = $rajaongkir->_api_ongkir('province');
    $data = json_decode($provinsi, true);
    echo json_encode($data['rajaongkir']['results']);
  }

  function get_kota($provinsi = "")
  {
    $this->load->library('Rajaongkir');
    $rajaongkir = new Rajaongkir;
    if (!empty($provinsi)) {
      if (is_numeric($provinsi)) {
        $kota = $rajaongkir->_api_ongkir('city?province=' . $provinsi);
        $data = json_decode($kota, true);
        echo json_encode($data['rajaongkir']['results']);
      } else {
        show_404();
      }
    } else {
      show_404();
    }
  }

  function get_kecamatan($kota = "")
  {
    $this->load->library('Rajaongkir');
    $rajaongkir = new Rajaongkir;
    if (!empty($kota)) {
      if (is_numeric($kota)) {
        $kec = $rajaongkir->_api_ongkir('subdistrict?city=' . $kota);
        $data = json_decode($kec, true);
        echo json_encode($data['rajaongkir']['results']);
      } else {
        show_404();
      }
    } else {
      show_404();
    }
  }

  function get_nama_kecamatan($kec, $kota)
  {
    $this->load->library('Rajaongkir');
    $rajaongkir = new Rajaongkir;
    $kecname = $rajaongkir->_api_ongkir('subdistrict?id=' . $kec . '&city=' . $kota . '');
    $data = json_decode($kecname, true);
    $result = json_encode($data['rajaongkir']['results']['subdistrict_name']);
    return str_replace('"', " ", $result);
  }

  function get_nama_provinsi($provinsi)
  {
    $this->load->library('Rajaongkir');
    $rajaongkir = new Rajaongkir;
    $provinsiname = $rajaongkir->_api_ongkir('province?id=' . $provinsi . '');
    $data = json_decode($provinsiname, true);
    $result = json_encode($data['rajaongkir']['results']['province']);
    return str_replace('"', " ", $result);
  }

  function get_nama_kota($kota, $provinsi)
  {
    $this->load->library('Rajaongkir');
    $rajaongkir = new Rajaongkir;
    $kotaname = $rajaongkir->_api_ongkir('city?id=' . $kota . '&province=' . $provinsi . '');
    $data = json_decode($kotaname, true);
    $result = json_encode($data['rajaongkir']['results']['city_name']);
    return str_replace('"', " ", $result);
  }


  function store_origin_shiping()
  {
    $id = 1; //change by param if more than one gateway
    $idprovinsi = $this->input->post('provinsi');
    $idkota = $this->input->post('kotaorigin');

    $data = array(
      'originProvinceCode' => $idprovinsi,
      'originCityCode' => $idkota,
      'originProvinceName' => $this->get_nama_provinsi($idprovinsi),
      'originCityName' => $this->get_nama_kota($idkota, $idprovinsi)
    );
    $this->M_shiping_gateway->update_shiping_gateway($id, $data);
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
    }
  }

  function add_shipping_address()
  {
    $id = $this->session->userdata('log_id');
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
