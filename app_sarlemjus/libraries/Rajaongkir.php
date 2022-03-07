<?php

/**
 * RajaOngkir CodeIgniter Library
 * Digunakan untuk mengkonsumsi API RajaOngkir dengan mudah
 *
 * @author Damar Riyadi <damar@tahutek.net>
 */
defined('BASEPATH') or exit('No direct script access allowed');
require_once 'RajaOngkir/Endpoints.php';

class RajaOngkir extends Endpoints
{

    private $ci;
    private $api_key;
    private $account_type;

    public function __construct()
    {
        // Pastikan bahwa PHP mendukung cURL
        if (!function_exists('curl_init')) {
            log_message('error', 'cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.');
        }
        $this->_ci = &get_instance();
        $this->_ci->load->config('rajaongkir', TRUE);
        // Pastikan Anda sudah memasukkan API Key di application/config/rajaongkir.php
        if ($this->_ci->config->item('rajaongkir_api_key', 'rajaongkir') == "") {
            log_message("error", "Harap masukkan API KEY Anda di config.");
        } else {
            $this->api_key = $this->_ci->config->item('rajaongkir_api_key', 'rajaongkir');
            $this->account_type = $this->_ci->config->item('rajaongkir_account_type', 'rajaongkir');
        }
        parent::__construct($this->api_key, $this->account_type);
    }



    function _api_ongkir_post($origin, $des, $qty, $cour)
    {
        // $apikey =  $this->CI->M_shiping_gateway->data_shiping_gateway('Raja Ongkir')->row();

        $this->_ci = &get_instance();
        $this->_ci->load->config('rajaongkir', TRUE);

        if ($this->_ci->config->item('rajaongkir_api_key', 'rajaongkir') == "") {
            log_message("error", "Harap masukkan API KEY Anda di config.");
        } else {
            $this->api_key = $this->_ci->config->item('rajaongkir_api_key', 'rajaongkir');
            $api_key = $this->api_key;
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=" . $origin . "&originType=city&destination=" . $des . "&destinationType=subdistrict&weight=" . $qty . "&courier=" . $cour,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: $api_key "
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }
}
