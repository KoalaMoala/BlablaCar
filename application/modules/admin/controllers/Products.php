<?php

class Products extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library(array('ion_auth'));

        if (!$this->ion_auth->logged_in()) {
            redirect('/auth', 'refresh');
        }

        $this->load->model(array('admin/brand'));
        $this->load->model(array('admin/category'));
        $this->load->model(array('admin/product'));
    }

    public function index() {
        $products = $this->product->get_all();

        $data['products'] = $products;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "products_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {
        if ($this->input->post('name')) {
            $data['name'] = $this->input->post('name');
            $data['price'] = $this->input->post('price');
            $data['model'] = $this->input->post('model');
            $data['brand_id'] = $this->input->post('brand_id');
            $data['category_id'] = $this->input->post('category_id');
            $data['tag_line'] = $this->input->post('tag_line');
            $data['features'] = $this->input->post('features');

            $this->product->insert($data);

            redirect('/admin/products', 'refresh');
        }

        $brands = $this->brand->get_all();
        $categories = $this->category->get_all();

        $data['brands'] = $brands;
        $data['categories'] = $categories;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "products_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {
        if ($this->input->post('name')) {
            $data['name'] = $this->input->post('name');
            $data['price'] = $this->input->post('price');
            $data['model'] = $this->input->post('model');
            $data['brand_id'] = $this->input->post('brand_id');
            $data['category_id'] = $this->input->post('category_id');
            $data['tag_line'] = $this->input->post('tag_line');
            $data['features'] = $this->input->post('features');
            $this->product->update($data, $id);

            redirect('/admin/products', 'refresh');
        }

        $product = $this->product->get($id);
        $brands = $this->brand->get_all();
        $categories = $this->category->get_all();

        $data['brands'] = $brands;
        $data['categories'] = $categories;
        $data['product'] = $product;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "products_edit";
        $this->load->view($this->_container, $data);
    }

    public function delete($id) {
        $this->product->delete($id);

        redirect('/admin/products', 'refresh');
    }

}
