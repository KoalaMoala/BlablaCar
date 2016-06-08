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
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "trips_list";
        $this->load->view($this->_container, $data);
    }

    public function create() {
        $now = time();
        $human = unix_to_human($now, FALSE, 'eu');
        echo $human;
        $inputs = ['departure', 'destination', 'car_capacity', 'price', 'preferences', 'date'];
        if ( not_null($this->input->post(), $inputs)) {

            $data['departure'] = $this->input->post('departure');
            $data['destination'] = $this->input->post('destination');
            $data['car_capacity'] = $this->input->post('car_capacity');
            $data['remaining_seats'] = $this->input->post('car_capacity');
            $data['price'] = $this->input->post('price');
            $data['preferences'] = $this->input->post('preferences');

            //format date
            $data['date_departure'] = human_to_unix(str_replace("/" ,"-", $this->input->post('date')));
            $trip_id = $this->trip->insert($data);

            $data_p = [];
            $data_p['user_id'] = $this->ion_auth->get_user_id();
            $data_p['trip_id'] = $trip_id;
            $data_p['is_owner'] = TRUE;
            $this->trip_participant->insert($data_p);

            redirect('/admin/trips', 'refresh');
        }
        else {
          var_dump($this->input->post(NULL,TRUE));
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

    public function delete($id) {
        $this->trip->delete($id);

        redirect('/admin/trips', 'refresh');
    }

}
