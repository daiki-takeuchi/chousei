<?php

class Events3UserToParticipateSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'title' => 'タイトル変更前',
            'place' => '場所変更前',
            'description' => '説明変更前',
            'start_time' => date('Y/m/d') . ' 18:00',
            'end_time' => date('Y/m/d') . ' 20:00',
            'number_of_people' => 15,
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        ];
        $this->db->insert('events', $data);
        $event_id = $this->db->insert_id();

        $query = $this->db->get('users');
        $users = $query->result_array();
        $i = 0;
        foreach ($users as $user) {
            // 実行する処理
            $data = [
                'event_id' => $event_id,
                'user_id' => $user['id'],
                'user_name' => $user['name'],
                'status' => $i < 3 ? '1' : '0',
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s')
            ];
            $this->db->insert('invitations', $data);
            $i++;
        }
    }
}