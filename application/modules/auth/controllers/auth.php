<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        log_message('debug', 'CI My Admin : Auth class loaded');
    }

    public function index() {
        if ($this->ion_auth->logged_in()) {
            redirect('admin/dashboard', 'refresh');
        } else {
            $data['page'] = $this->config->item('ci_my_admin_template_dir_public') . "login_form";
            $data['module'] = 'auth';

            $this->load->view($this->_container, $data);
        }
    }

    public function login() {
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == true) {
            $remember = (bool) $this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'), $remember)) {
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('/admin/dashboard', 'refresh');
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('auth', 'refresh');
            }
        } else {
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $data['page'] = $this->config->item('ci_my_admin_template_dir_public') . "login_form";
            $data['module'] = 'auth';
            //$data['message'] = $this->data['message'];

            $this->load->view($this->_container, $data);
        }
    }

    public function logout() {
        $this->ion_auth->logout();

        redirect('auth', 'refresh');
    }

}

/* End of file auth.php */
/* Location: ./modules/auth/controllers/auth.php */
