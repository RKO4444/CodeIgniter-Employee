<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LocationController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('LocationModel');
    }

    public function getStates() {
        $states = $this->LocationModel->getStates();
        echo json_encode($states);
    }

    public function getCities() {
        $state_id = $this->input->post('state_id');
        $cities = $this->LocationModel->getCitiesByState($state_id);
        echo json_encode($cities);
    }
}
