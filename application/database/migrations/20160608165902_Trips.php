<?php

class Migration_Trips extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
          'id' => array(
              'type' => 'INT',
              'constraint' => 11,
              'auto_increment' => TRUE
          ),
          'departure' => array(
              'type' => 'VARCHAR',
              'constraint' => 100,
              'null' => FALSE
          ),
          'destination' => array(
              'type' => 'VARCHAR',
              'constraint' => 100,
              'null' => FALSE
          )
          ,
          'car_model' => array(
              'type' => 'VARCHAR',
              'constraint' => 150
          ),
          'car_capacity' => array(
              'type' => 'SMALLINT',
              'constraint' => 8,
              'null' => FALSE
          )
          ,
          'remaining_seats' => array(
              'type' => 'INT',
              'constraint' => 11,
              'null' => FALSE
          )
          ,
          'preferences' => array(
              'type' => 'VARCHAR',
              'constraint' => 350
          )
          ,
          'price' => array(
              'type' => 'INT',
              'constraint' => 11,
              'null' => FALSE
          )
          ,
          'created_from_ip' => array(
              'type' => 'VARCHAR',
              'constraint' => 100
          ),
          'updated_from_ip' => array(
              'type' => 'VARCHAR',
              'constraint' => 100
          )
          ,
          'date_created' => array(
              'type' => 'DATETIME'
          ),
          'date_updated' => array(
              'type' => 'DATETIME'
          ),
          'date_departure' => array(
              'type' => 'DATETIME',
              'null' => FALSE
          )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('trips');
    }

    public function down() {
        $this->dbforge->drop_table('trips');
    }

}
