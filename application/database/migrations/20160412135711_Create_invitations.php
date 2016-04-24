<?php
/**
 * Migration: Create_invitation
 *
 * Created by: Cli for CodeIgniter <https://github.com/kenjis/codeigniter-cli>
 * Created on: 2016/04/12 13:57:11
 */
class Migration_Create_invitations extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'bigserial',
				'auto_increment' => TRUE
			),
			'event_id' => array(
				'type' => 'INT',
			),
			'user_id' => array(
				'type' => 'INT',
			),
			'status' => array(
				'type' => 'char',
				'constraint' => '1',
				'null' => TRUE
			),
			'comment' => array(
				'type' => 'varchar',
				'constraint' => '50',
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
		$this->dbforge->create_table('invitations');
	}

	public function down()
	{
		$this->dbforge->drop_table('invitations');
	}
}
