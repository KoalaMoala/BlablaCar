<?php

class Categories extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library(array('ion_auth'));

        if (!$this->ion_auth->logged_in()) {
            redirect('/auth', 'refresh');
        }

        $this->load->model(array('admin/category'));
    }

    public function index() {
        $categories = $this->category->get_all();

        $data['categories'] = $categories;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "categories_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {
        if ($this->input->post('description')) {
            $data['description'] = $this->input->post('description');
            $this->category->insert($data);

            redirect('/admin/categories', 'refresh');
        }

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "categories_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {
        if ($this->input->post('description')) {
            $data['description'] = $this->input->post('description');
            $this->category->update($data, $id);

            redirect('/admin/categories', 'refresh');
        }

        $category = $this->category->get($id);

        $data['category'] = $category;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "categories_edit";
        $this->load->view($this->_container, $data);
    }

    public function delete($id) {
        $this->category->delete($id);

        redirect('/admin/categories', 'refresh');
    }

}
