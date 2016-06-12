<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Trip_Participant extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_by_user_and_trip($user_id, $trip_id) {
        return $this->db->get_where($this->table_name, array('user_id' => $user_id, 'trip_id' => $trip_id))->row();
    }
}
