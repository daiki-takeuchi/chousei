<?php

class UsersSeeder_30 extends Seeder
{
    public function run()
    {
        $this->db->truncate('users');

        for ($i = 1; $i <= 30; $i++){
            // 実行する処理
            $data = [
                'email' => 'email' . $i . '@example.com',
                'name' => '名前' . $i,
                'password' => sha1('email' . $i . '@example.com'.'password'),
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s')
            ];
            $this->db->insert('users', $data);
        }
    }
}