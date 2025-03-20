<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeController extends CI_Controller {

    private $age_limit = false;

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect(base_url('login'));
        }
        $this->load->model('EmployeeModel','em');
    }

    public function index()
    {
        $this->load->view('template/header');
        $this->load->view('frontend/employee');
        $this->load->view('template/footer');
    }

    public function getEmployees()
    {

        $page = $this->input->get('page', TRUE) ?? 1;
        $limit = $this->input->get('rows', TRUE) ?? 10;
        $start = ($page - 1) * $limit;

        $sortBy = $this->input->get('sidx', TRUE) ?? 'id';
        $sortOrder = $this->input->get('sord', TRUE) ?? 'asc';

        $this->db->from('employee');

        $filters = $this->input->get('filters', TRUE);
        if (!empty($filters)) {
            $filters = json_decode($filters, TRUE);

            if (isset($filters['rules']) && is_array($filters['rules'])) {
                foreach ($filters['rules'] as $filter) {
                    $field = $filter['field'];
                    $operator = $filter['op'];
                    $value = $filter['data'];

                    switch ($operator) {
                        case 'eq':
                            $this->db->where($field, $value);
                            break;
                        case 'cn':
                            $this->db->like($field, $value);
                            break;
                        case 'bw':
                            $this->db->like($field, $value, 'after');
                            break;
                        case 'ew':
                            $this->db->like($field, $value, 'before');
                            break;
                        case 'lt':
                            $this->db->where("$field <", $value);
                            break;
                        case 'gt':
                            $this->db->where("$field >", $value);
                            break;
                    }
                }
            }
        }

        $totalRecords = $this->db->count_all_results('', FALSE);
        $this->db->order_by($sortBy, $sortOrder);
        $this->db->limit($limit, $start);
        $employees = $this->db->get()->result_array();

        $totalPages = ($totalRecords > 0) ? ceil($totalRecords / $limit) : 1;

        $response = [
            'page' => $page,
            'total' => $totalPages,
            'records' => $totalRecords,
            'data' => $employees
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function create()
    {
        $this->load->view('template/header');
        $this->load->view('frontend/create');
        $this->load->view('template/footer');
    }

    public function store()
    {
        $this->formValidationRules();

        $errors = [];

        $email = $this->input->post('email', TRUE);

        $emailExists = $this->em->checkEmailExists($email);

        if($this->form_validation->run() && !$emailExists) {

            $upload_path = './uploads/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            }

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $this->load->library('upload', $config);

            $profile_photo = '';
            if ($this->upload->do_upload('profile_photo')) {
                $profile_photo = $this->upload->data('file_name');
            }
            $data = [
                'first_name' => $this->input->post('first_name', TRUE),
                'last_name' => $this->input->post('last_name', TRUE),
                'email' => $this->input->post('email', TRUE),
                'phone' => $this->input->post('phone', TRUE),
                'department' => $this->input->post('department', TRUE),
                'state' => $this->input->post('state', TRUE),
                'city' => $this->input->post('city', TRUE),
                'dob' => $this->input->post('dob', TRUE),
                'profile_photo' => $profile_photo
            ];

            $this->em->insertEmployee($data);
            $this->session->set_flashdata('status_type', 'success');
            $this->session->set_flashdata('status','Employee Added Successfully');
            redirect(base_url('employee'));
        }
        else {
            $errors = $this->getErrors($emailExists);
            $this->session->set_flashdata('old_values', $this->input->post());
            $this->session->set_flashdata('validation_errors', $errors);
            $this->create();
        }
    }
    public function edit($id)
    {
        $this->load->view('template/header');

        $data['employee'] =  $this->em->editEmployee($id);
        $this->load->view('frontend/edit',$data);
        $this->load->view('template/footer');

    }

    public function update($id)
    {
        $this->formValidationRules();

        $errors = [];

        $email = $this->input->post('email', TRUE);

        $emailExists = $this->em->checkEmailExists($email,$id);

    
        if ($this->form_validation->run() && !$emailExists) {
            $oldProfilePhoto = $this->input->post('old_profile_photo');
    
            $profile_photo = $oldProfilePhoto;
            if (!empty($_FILES['profile_photo']['name'])) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048;
                $config['file_name'] = time() . '_' . $_FILES['profile_photo']['name'];
    
                $this->load->library('upload', $config);
    
                if ($this->upload->do_upload('profile_photo')) {
                    $upload_data = $this->upload->data();
                    $profile_photo = $upload_data['file_name'];
    
                    if (!empty($oldProfilePhoto) && file_exists('./uploads/' . $oldProfilePhoto)) {
                        unlink('./uploads/' . $oldProfilePhoto);
                    }
                }
            }
    
            $data = [
                'first_name' => $this->input->post('first_name', TRUE),
                'last_name' => $this->input->post('last_name', TRUE),
                'email' => $this->input->post('email', TRUE),
                'phone' => $this->input->post('phone', TRUE),
                'department' => $this->input->post('department', TRUE),
                'state' => $this->input->post('state', TRUE),
                'city' => $this->input->post('city', TRUE),
                'dob' => $this->input->post('dob', TRUE),
                'profile_photo' => $profile_photo
            ];
    
            $this->em->updateEmployee($id, $data);
            $this->session->set_flashdata('status_type', 'success');
            $this->session->set_flashdata('status', 'Employee Updated Successfully');
            redirect(base_url('employee'));
        } else {
            $errors = $this->getErrors($emailExists);
            $this->session->set_flashdata('old_values', $this->input->post());
            $this->session->set_flashdata('validation_errors', $errors);
            $this->edit($id);
        }
        
    }

    public function delete($id)
    {
        $this->em->deleteEmployee($id);
        $this->session->set_flashdata('status','Data Deleted Successfully');
        redirect(base_url('employee'));
    }

    public function formValidationRules()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('department', 'Department', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required|callback_validate_age');
    }

    public function getErrors($emailExists) {
        $errors= [];
        if (empty($this->input->post('first_name'))) {
            $errors['first_name'] = "First Name is required.";
        }
        if (empty($this->input->post('last_name'))) {
            $errors['last_name'] = "Last Name is required.";
        }
        if (empty($this->input->post('email')) || !filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Enter a valid Email.";
        }
        if (empty($this->input->post('phone')) || !preg_match('/^[0-9]{10}$/', $this->input->post('phone'))) {
            $errors['phone'] = "Enter a valid 10-digit phone number.";
        }
        if (empty($this->input->post('department'))) {
            $errors['department'] = "Department is required.";
        }
        if (empty($this->input->post('state'))) {
            $errors['state'] = "Please select a State.";
        }
        if (empty($this->input->post('city'))) {
            $errors['city'] = "Please select a City.";
        }
        if (empty($this->input->post('dob'))) {
            $errors['dob'] = "Date of Birth is required.";
        }

        if ($emailExists) {
            $errors['email'] = "This email is already registered.";
        }

        if ($this->age_limit) {
            $errors['dob'] = "You must be atleast 18 years old";
        }


        return $errors;
    }

    public function validate_age($dob)
    {
        $dob_timestamp = strtotime($dob);
        $age = date('Y') - date('Y', $dob_timestamp);

        if (date('md', $dob_timestamp) > date('md')) {
            $age--;
        }

        if ($age < 18) {
            $this->age_limit = true;
            return FALSE;
        }
        return TRUE;
    }
}
