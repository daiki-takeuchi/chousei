<?php

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $this->db->delete('users', array('email' => 'admin@admin.com'));

        $data = [
            'email' => 'admin@admin.com',
            'name' => '管理者ユーザー',
            'password' => sha1('admin@admin.com'.'admin'),
            'admin' => true,
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        ];
        $this->db->insert('users', $data);
    }
}