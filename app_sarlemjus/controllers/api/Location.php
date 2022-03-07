<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Location extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Location_data');
    }

    function get_province()
    {
        // $q = $this->Location_data->get_province();
        // echo "<option disabled selected>Pilih Provinsi</option>";
        // foreach ($q as $prov) {
        //     echo "<option value='{$prov->id}'>{$prov->name}</option>";
        // }
        $json = file_get_contents(base_url('public/data/province.json'));

        $data = json_decode($json, true);
        echo "<option disabled selected>Pilih Provinsi</option>";
        for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
            echo "<option value='" . $data['rajaongkir']['results'][$i]['province_id'] . "'>" . $data['rajaongkir']['results'][$i]['province'] . "</option>";
        }
    }

    function get_district($id_province)
    {
        $json = file_get_contents(base_url('public/data/district.json'));

        $data = json_decode($json, true);

        echo "<option disabled selected>Pilih Kota/Kabupaten</option>";
        for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
            if ($data['rajaongkir']['results'][$i]['province_id'] == $id_province) {

                echo "<option value='" . $data['rajaongkir']['results'][$i]['city_id'] . "'>" . $data['rajaongkir']['results'][$i]['type'] . " " . $data['rajaongkir']['results'][$i]['city_name'] . "</option>";
            }
        }
    }

    public function get_subdistrict($id_district)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=$id_district",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key:4ccadcc57a7e40df217c9fe24e388f9b"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $data = json_decode($response, true);
        echo "<option disabled selected>Pilih Kecamatan</option>";
        for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
            echo "<option value='" . $data['rajaongkir']['results'][$i]['subdistrict_id'] . "'>" . $data['rajaongkir']['results'][$i]['subdistrict_name'] . "</option>";
        }
    }

    // public function get_postal_code($id_district)
    // {
    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?id=$id_district",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 30,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "GET",
    //         CURLOPT_HTTPHEADER => array(
    //             "key:4ccadcc57a7e40df217c9fe24e388f9b"
    //         ),
    //     ));
    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);
    //     curl_close($curl);
    //     $data = json_decode($response, true);
    //     for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
    //         echo "value='" . $data['rajaongkir']['results'][$i]['subdistrict_id'] . "'";
    //     }
    // }

    public function get_village($subdistrict)
    {
        $q = $this->Location_data->get_village($subdistrict);
        echo "<option disabled selected>Pilih Desa/Kelurahan</option>";
        foreach ($q as $v) {
            if ($v->type == 4) {
                $tipe = "Desa";
            } elseif ($v->type == 3) {
                $tipe = "Kelurahan";
            }

            echo "<option value='{$v->id}'>$tipe {$v->name}</option>";
        }
    }
}
