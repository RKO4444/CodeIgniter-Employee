<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LocationModel extends CI_Model {

    public function getStates() {
        return $this->db->get('states')->result();
    }

    public function getCitiesByState($state_id) {
        return $this->db->get_where('cities', ['state_id' => $state_id])->result();
    }
}
