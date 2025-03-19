<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BlogModel extends CI_Model {

    public function getBlogsByUser($user_id) {
        return $this->db->where('user_id', $user_id)->order_by('created_at', 'DESC')->get('blogs')->result();
    }

    public function insertBlog($data) {
        return $this->db->insert('blogs', $data);
    }

    public function getBlogById($id) {
        return $this->db->where('id', $id)->get('blogs')->row();
    }

    public function updateBlog($id, $data) {
        return $this->db->where('id', $id)->update('blogs', $data);
    }

    public function deleteBlog($id) {
        return $this->db->where('id', $id)->delete('blogs');
    }
}
