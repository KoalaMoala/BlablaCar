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
                $credit = $this->ion_auth->user()->row()->credit;
                $this->session->set_userdata(["credit" => $credit]);
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


    	// create a new user
    	function create_user()
        {
            $this->data['title'] = "Create User";

            /* We want to keep this public
            if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
            {
                redirect('auth', 'refresh');
            }
            */

            $tables = $this->config->item('tables','ion_auth');
            $identity_column = $this->config->item('identity','ion_auth');
            $this->data['identity_column'] = $identity_column;

            // validate form input
            $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
            $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
            if($identity_column!=='email')
            {
                $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
                $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
            }
            else
            {
                $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
            }
            $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
            $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
            $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
            $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

            if ($this->form_validation->run() == true)
            {
                $email    = strtolower($this->input->post('email'));
                $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
                $password = $this->input->post('password');

                $additional_data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name'  => $this->input->post('last_name'),
                    'company'    => $this->input->post('company'),
                    'phone'      => $this->input->post('phone'),
                );
            }
            if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data))
            {
                // check to see if we are creating the user
                // redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("auth", 'refresh');
            }
            else
            {
                // display the create user form
                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

                $this->data['first_name'] = array(
                    'name'  => 'first_name',
                    'id'    => 'first_name',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('first_name'),
                );
                $this->data['last_name'] = array(
                    'name'  => 'last_name',
                    'id'    => 'last_name',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('last_name'),
                );
                $this->data['identity'] = array(
                    'name'  => 'identity',
                    'id'    => 'identity',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('identity
                    '),
                );
                $this->data['email'] = array(
                    'name'  => 'email',
                    'id'    => 'email',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('email'),
                );
                $this->data['company'] = array(
                    'name'  => 'company',
                    'id'    => 'company',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('company'),
                );
                $this->data['phone'] = array(
                    'name'  => 'phone',
                    'id'    => 'phone',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('phone'),
                );
                $this->data['password'] = array(
                    'name'  => 'password',
                    'id'    => 'password',
                    'type'  => 'password',
                    'value' => $this->form_validation->set_value('password'),
                );
                $this->data['password_confirm'] = array(
                    'name'  => 'password_confirm',
                    'id'    => 'password_confirm',
                    'type'  => 'password',
                    'value' => $this->form_validation->set_value('password_confirm'),
                );

                $this->_render_page($this->config->item('ci_my_admin_template_dir_public') . 'create_user', $this->data);
            }
        }

        function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
      	{

      		$this->viewdata = (empty($data)) ? $this->data: $data;

      		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

      		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
      	}
}

/* End of file auth.php */
/* Location: ./modules/auth/controllers/auth.php */
