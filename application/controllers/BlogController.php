<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BlogController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect(base_url('login'));
        }
        $this->load->model('BlogModel', 'bm');
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        $data['blogs'] = $this->bm->getBlogsByUser($user_id);

        $this->load->view('template/header');
        $this->load->view('frontend/blogs', $data);
        $this->load->view('template/footer');
    }

    public function create() {
        $this->load->view('template/header');
        $this->load->view('frontend/create_blog');
        $this->load->view('template/footer');
    }

    public function store() {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'user_id' => $this->session->userdata('user_id'),
                'title' => $this->input->post('title', TRUE),
                'content' => $this->input->post('content', TRUE)
            ];
            $this->bm->insertBlog($data);
            $this->session->set_flashdata('status_type', 'success');
            $this->session->set_flashdata('status', 'Blog Added Successfully');
            redirect(base_url('blogs'));
        } else {
            $errors = $this->getErrors();
            $this->session->set_flashdata('validation_errors', $errors);
            $this->create();
        }
    }

    public function edit($id) {
        $data['blog'] = $this->bm->getBlogById($id);
        $this->load->view('template/header');
        $this->load->view('frontend/edit_blog', $data);
        $this->load->view('template/footer');
    }

    public function update($id) {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'title' => $this->input->post('title', TRUE),
                'content' => $this->input->post('content', TRUE)
            ];
            $this->bm->updateBlog($id, $data);
            $this->session->set_flashdata('status_type', 'success');
            $this->session->set_flashdata('status', 'Blog Updated Successfully');
            redirect(base_url('blogs'));
        } else {
            $errors = $this->getErrors();
            $this->session->set_flashdata('validation_errors', $errors);
            $this->edit($id);
        }
    }

    public function delete($id) {
        $this->bm->deleteBlog($id);
        $this->session->set_flashdata('status', 'Blog Deleted Successfully');
        redirect(base_url('blogs'));
    }

    public function getErrors() {
        $errors= [];
        if (empty($this->input->post('title'))) {
            $errors['title'] = "Blog Title is required.";
        }
        if (empty($this->input->post('content'))) {
            $errors['content'] = "Blog Content is required.";
        }
        return $errors;
    }
}
