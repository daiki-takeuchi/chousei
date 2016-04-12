<?php

class EventsSeeder extends Seeder
{
    public function run()
    {
        $this->db->truncate('events');

        $data = [
            'title' => 'イベント１',
            'place' => '場所１',
            'description' => '説明１',
            'start_time' => '2016/4/12 18:00',
            'end_time' => '2016/4/12 20:00',
            'number_of_people' => 15,
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        ];
        $this->db->insert('events', $data);

        $data = [
            'title' => 'イベント２',
            'place' => '場所２',
            'description' => '説明２',
            'start_time' => '2016/4/13 18:00',
            'end_time' => '2016/4/13 20:00',
            'number_of_people' => 15,
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        ];
        $this->db->insert('events', $data);

        $data = [
            'title' => 'イベント３',
            'place' => '場所３',
            'description' => '説明３',
            'start_time' => '2016/4/14 18:00',
            'end_time' => '2016/4/14 20:00',
            'number_of_people' => 15,
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        ];
        $this->db->insert('events', $data);
    }
}