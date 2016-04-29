<?php

class InvitationsSeeder_Admin extends Seeder
{
    public function run()
    {
        $this->db->truncate('invitations');

        $query = $this->db->get('events');
        $events = $query->result_array();

        $this->db->where('email','admin@admin.com');
        $query = $this->db->get('users');
        $admin_user = $query->row_array();

        foreach ($events as $event) {

            // 実行する処理
            $data = [
                'event_id' => $event['id'],
                'user_id' => $admin_user['id'],
                'user_name' => $admin_user['name'],
                'status' => '0',
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s')
            ];
            $this->db->insert('invitations', $data);
        }
    }
}