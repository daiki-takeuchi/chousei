<?php

/**
 * Migration: Add_user_name_to_invitations
 *
 * Created by: Cli for CodeIgniter <https://github.com/kenjis/codeigniter-cli>
 * Created on: 2016/04/30 02:42:15
 */
class Migration_Add_user_name_to_invitations extends CI_Migration
{
    public function up()
    {
        // Adding a Column to a Table
        $fields = array(
            'user_name' => array(
                'type' => 'varchar',
                'constraint' => '255'
            ),
        );
        $this->dbforge->add_column('invitations', $fields);
    }

    public function down()
    {
        // Dropping a Column From a Table
        $this->dbforge->drop_column('invitations', 'user_name');
    }
}
