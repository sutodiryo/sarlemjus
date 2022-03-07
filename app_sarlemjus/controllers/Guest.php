<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guest extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
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
}
