<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->database();
		$this->load->view('welcome_message');
	}

	public function demo() {
		$this->load->view('welcome_message');
	}
}
