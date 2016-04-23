<?php

class EventsSeeder_30 extends Seeder
{
    public function run()
    {
        $this->db->truncate('events');

        for ($i = 1; $i <= 30; $i++){
            // 実行する処理
            $data = [
                'title' => 'イベント' . $i,
                'place' => '場所' . $i,
                'description' => '説明' . $i,
                'start_time' => date("Y/m/d", strtotime('+' . $i . ' day')) . ' 18:00',
                'end_time' => date("Y/m/d", strtotime('+' . $i . ' day')) . ' 20:00',
                'number_of_people' => 15,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s')
            ];
            $this->db->insert('events', $data);
        }
    }
}