<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {
    
    public function insertUser($data) {
        return $this->db->insert('users', $data);
    }

    public function getUserByEmail($email) {
        return $this->db->get_where('users', ['email' => $email])->row();
    }
}
