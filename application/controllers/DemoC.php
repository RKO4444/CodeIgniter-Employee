<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DemoC extends CI_Controller {

	public function index()
	{
		echo "I am best";
	}

    public function demo()
	{
		echo "I am demo";
	}

    public function blog($id = 999999)
	{
		echo $id;
	}
}
