<?php defined('BASEPATH') or exit('No direct script access allowed');

// Integer to IDR format
function idr($v)
{
    return "Rp" . number_format($v, 0, ',', '.') . "";
}

// menampilkan hasil output status header & response ke json
function json_output($statusHeader, $response)
{
    $ci = &get_instance();
    $ci->output->set_content_type('application/json');
    $ci->output->set_status_header($statusHeader);
    $ci->output->set_output(json_encode($response));
}
