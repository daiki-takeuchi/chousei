<?php
/**
 * Migration: Add_admin_to_users
 *
 * Created by: Cli for CodeIgniter <https://github.com/kenjis/codeigniter-cli>
 * Created on: 2016/04/11 19:29:17
 */
class Migration_Add_admin_to_users extends CI_Migration {

	public function up()
	{
		// Adding a Column to a Table
		$fields = array(
			'admin' => array('type' => 'BOOLEAN'),
		);
		$this->dbforge->add_column('users', $fields);
	}

	public function down()
	{
		// Dropping a Column From a Table
		$this->dbforge->drop_column('users', 'admin');
	}
}
