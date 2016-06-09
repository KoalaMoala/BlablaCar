<?php

class Migration_Trips extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
          'id' => array(
              'type' => 'INT',
              'constraint' => 11,
              'auto_increment' => TRUE
          ),
          'owner_id' => array(
              'type' => 'INT',
              'constraint' => 11
          ),
          'departure' => array(
              'type' => 'VARCHAR',
              'constraint' => 100
          ),
          'destination' => array(
              'type' => 'VARCHAR',
              'constraint' => 100
          )
          ,
          'car_model' => array(
              'type' => 'VARCHAR',
              'constraint' => 150
          ),
          'car_capacity' => array(
              'type' => 'SMALLINT',
              'constraint' => 8
          )
          ,
          'remaining_seats' => array(
              'type' => 'INT',
              'constraint' => 11
          )
          ,
          'preferences' => array(
              'type' => 'VARCHAR',
              'constraint' => 350
          )
          ,
          'price' => array(
              'type' => 'INT',
              'constraint' => 11
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
              'type' => 'DATETIME'
          )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (owner_id) REFERENCES users(id)');
        $this->dbforge->create_table('trips');
    }

    public function down() {
        $this->dbforge->drop_table('trips');
    }

}
