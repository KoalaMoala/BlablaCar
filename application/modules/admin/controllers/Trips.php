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
        $this->load->library('session');

        $credit = $this->ion_auth->user()->row()->credit;
        $this->session->set_userdata(["credit" => $credit]);
    }

    public function index() {
        $trips = $this->trip->get_all();

        $data['trips'] = $trips;
        $data['user_id'] = $this->ion_auth->get_user_id();
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "trips_list";
        $this->load->view($this->_container, $data);
    }

    public function search()
    {
      $where = [];

      //departure
      if($this->input->post('departure') != null)
        $where['departure'] = $this->input->post('departure');

      //destination
      if($this->input->post('destination') != null)
        $where['destination'] = $this->input->post('destination');

      $trips = $this->trip->get_all('', $where);

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
            $datetime = new DateTime(str_replace("/" ,"-", $this->input->post('date')));
            $data['date_departure'] = date("Y-m-d\TH:i:sO", $datetime->getTimestamp());

            if($datetime > new DateTime() )
            {
                $trip_id = $this->trip->insert($data);
            }
            redirect('/admin/trips', 'refresh');
        }

        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "trips_create";
        $this->load->view($this->_container, $data);
    }

    public function edit($id) {
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
            $datetime = new DateTime(str_replace("/" ,"-", $this->input->post('date')));
            $data['date_departure'] = date("Y-m-d\TH:i:sO", $datetime->getTimestamp());

            if($datetime > new DateTime() )
            {
                $trip_id = $this->trip->update($data, $id);
            }
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
        $reservation = $this->trip_participant->get_by_user_and_trip($this->ion_auth->get_user_id(), $id);

        if($this->input->post('seats') != null)
        {
          $seats = $this->input->post('seats');

          $data['user_id'] = $this->ion_auth->get_user_id();
          $data['trip_id'] = $id;
          $data['seats'] = $seats;

          //make reservation
          if( $reservation == null )
          {
              //insert trip_participant
              $this->session->set_flashdata('msg', 'Reservation saved');
              $this->trip_participant->insert($data);

              //update trip (remaining_seats)
              $trip_data['remaining_seats'] = $trip->remaining_seats - $seats;
              $this->trip->update($trip_data, $id);
          }
          else if($seats == 0) {
              //update trip (remaining_seats)
              $trip_data['remaining_seats'] = $trip->remaining_seats + $reservation->seats;
              $this->trip->update($trip_data, $id);

              //delete trip_participant
              $this->trip_participant->delete($reservation->id);
          }
          else {
              //update trip (remaining_seats)
              $trip_data['remaining_seats'] = $trip->remaining_seats + $reservation->seats - $seats;
              $this->trip->update($trip_data, $id);

              $this->session->set_flashdata('msg', 'Reservation updated');
              $this->trip_participant->update($data, $reservation->id);
          }

          //update user credit
          $credit = $this->session->userdata("credit") - ($trip->remaining_seats - $trip_data['remaining_seats']) * $trip->price;
          $data_user['credit'] = $credit;
          $this->session->set_userdata(["credit" => $credit]);
          $this->ion_auth->update($this->ion_auth->get_user_id(), $data_user);

          if($seats == 0){ redirect('/admin/trips', 'refresh'); }
        }

        $trip = $this->trip->get($id);
        $reservation = $this->trip_participant->get_by_user_and_trip($this->ion_auth->get_user_id(), $id);

        $data['trip'] = $trip;
        $data['seats'] = $reservation == null ? 0 : $reservation->seats;
        $data['page'] = $this->config->item('ci_my_admin_template_dir_admin') . "trips_reservation";
        $this->load->view($this->_container, $data);
    }

    public function delete($id) {
        $this->trip->delete($id);

        redirect('/admin/trips', 'refresh');
    }

}
