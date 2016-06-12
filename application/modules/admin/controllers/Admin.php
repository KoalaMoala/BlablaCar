<?php

class Admin extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library(array('ion_auth'));
        $this->load->model(array('admin/trip'));
        $this->load->model(array('admin/trip_participant'));

        if (!$this->ion_auth->logged_in()) {
            redirect('/auth', 'refresh');
        }
    }

    public function index() {
        $user_id = $this->ion_auth->get_user_id();
        $trips = $this->trip->get_all('', ["owner_id" => $user_id]);

        $trips_partipant = $this->trip_participant->get_all('', ["user_id" => $user_id]);


        foreach($trips_partipant as $trip_participant)
        {
          $trip = (array) $this->trip->get(intval($trip_participant['trip_id']));
          array_push($trips, $trip);
        }

        $data['trips'] = $trips;
        $data['user_id'] = $user_id;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "dashboard";
        $this->load->view($this->_container, $data);
    }

}
