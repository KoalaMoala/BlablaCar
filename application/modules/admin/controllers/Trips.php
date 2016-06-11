<?php

class trips extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library(array('ion_auth'));

        if (!$this->ion_auth->logged_in()) {
            redirect('/auth', 'refresh');
        }

        $this->load->model(array('admin/trip'));
        $this->load->model(array('admin/trip_participant'));
        $this->load->helper('date');
        $this->load->helper('form_validator');
    }

    public function index() {
        $trips = $this->trip->get_all();

        $data['trips'] = $trips;
        $data['user_id'] = $this->ion_auth->get_user_id();
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "trips_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {

        $inputs = ['departure', 'destination', 'car_capacity', 'price', 'preferences', 'date'];
        if ( not_null($this->input->post(), $inputs)) {

            $data['owner_id'] = $this->ion_auth->get_user_id();
            $data['departure'] = $this->input->post('departure');
            $data['destination'] = $this->input->post('destination');
            $data['car_capacity'] = $this->input->post('car_capacity');
            $data['remaining_seats'] = $this->input->post('car_capacity');
            $data['price'] = $this->input->post('price');
            $data['preferences'] = $this->input->post('preferences');

            //format date
            $timestamp = (new DateTime(str_replace("/" ,"-", $this->input->post('date'))) )->getTimestamp();
            $data['date_departure'] = date("Y-m-d\TH:i:sO", $timestamp);
            $trip_id = $this->trip->insert($data);

            redirect('/admin/trips', 'refresh');
        }

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "trips_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {
        if ($this->input->post('description')) {
            $data['description'] = $this->input->post('description');
            $this->trip->update($data, $id);

            redirect('/admin/trips', 'refresh');
        }

        $trip = $this->trip->get($id);

        $data['trip'] = $trip;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "trips_edit";
        $this->load->view($this->_container, $data);
    }

    public function reservation($id)
    {
        $trip = $this->trip->get($id);

        if($trip['remaining_seats'] > 0)
        {
          $trip['remaining_seats'] = $trip['remaining_seats'] - 1;
        }

        //TODO
    }

    public function delete($id) {
        $this->trip->delete($id);

        redirect('/admin/trips', 'refresh');
    }

}
