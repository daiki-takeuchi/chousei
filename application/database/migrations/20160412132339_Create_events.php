<?php
/**
 * Migration: Create_events
 *
 * Created by: Cli for CodeIgniter <https://github.com/kenjis/codeigniter-cli>
 * Created on: 2016/04/12 13:23:39
 */
class Migration_Create_events extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'bigserial',
				'auto_increment' => TRUE
			),
			'title' => array(
				'type' => 'varchar',
				'constraint' => '255',
			),
			'place' => array(
				'type' => 'varchar',
				'constraint' => '255',
				'null' => TRUE
			),
			'description' => array(
				'type' => 'varchar',
				'constraint' => '2000',
				'null' => TRUE
			),
			'start_time' => array(
				'type' => 'TIMESTAMP',
				'null' => TRUE
			),
			'end_time' => array(
				'type' => 'TIMESTAMP',
				'null' => TRUE
			),
			'number_of_people' => array(
				'type' => 'INT',
				'null' => TRUE
			),
			'created_at' => array(
				'type' => 'TIMESTAMP'
			),
			'updated_at' => array(
				'type' => 'TIMESTAMP'
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('events');
	}

	public function down()
	{
		$this->dbforge->drop_table('events');
	}
}
