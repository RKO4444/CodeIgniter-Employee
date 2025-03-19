<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeModel extends CI_Model {

    public function getEmployee()
    {
        return $this->db->get('employee')->result();
    }

    public function insertEmployee($data)
    {
        return $this->db->insert('employee', $data);
    }

    public function editEmployee($id)
    {
        return $this->db->get_where('employee', ['id' => $id])->row();
    }

    public function updateEmployee($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('employee', $data);
    }

    public function deleteEmployee($id)
    {
        return $this->db->delete('employee', ['id' => $id]);
    }

    public function checkEmailExists($email, $id = null)
{
    $this->db->where('email', $email);
    if ($id !== null) {
        $this->db->where('id !=', $id);
    }
    $query = $this->db->get('employee');

    return $query->num_rows() > 0;
}
}
