<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->library('session');
    }

    public function register() {
        $this->load->view('template/header');
        $this->load->view('auth/register');
        $this->load->view('template/footer');
    }

    public function store() {
        extract_csrf_from_raw_input();

        if ($this->security->get_csrf_hash() !== $this->input->post($this->security->get_csrf_token_name())) {
            show_error("CSRF Token Mismatch! Please refresh and try again.", 403);
        }

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->register();
        } else {
            $data = [
                'name' => $this->input->post('name', TRUE),
                'email' => $this->input->post('email', TRUE),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            ];
            $this->UserModel->insertUser($data);
            $this->session->set_flashdata('status', 'Registration Successful! Please log in.');
            redirect(base_url('login'));
        }
    }


    public function login() {
        $this->load->view('template/header');
        $this->load->view('auth/login');
        $this->load->view('template/footer');
    }


    public function authenticate() {

        extract_csrf_from_raw_input();

        if ($this->security->get_csrf_hash() !== $this->input->post($this->security->get_csrf_token_name())) {
            show_error("CSRF Token Mismatch! Please refresh and try again.", 403);
        }

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->login();
        } else {
            $user = $this->UserModel->getUserByEmail($this->input->post('email', TRUE));

            if ($user && password_verify($this->input->post('password'), $user->password)) {
                $this->session->set_userdata('user_id', $user->id);
                $this->session->set_userdata('user_name', $user->name);

                $this->output->set_header('X-CSRF-Token: ' . $this->security->get_csrf_hash());

                redirect(base_url('employee'));
            } else {
                $this->session->set_flashdata('status_type', 'error');
                $this->session->set_flashdata('status', 'Invalid Email or Password');
                redirect(base_url('login'));
            }
        }
    }

    public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_name');
        $this->session->set_flashdata('status', 'Logged out successfully');
        redirect(base_url('login'));
    }
}
