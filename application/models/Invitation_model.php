<?php

class Invitation_model extends MY_Model
{
    protected $table = 'invitation';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * 出席者を取得
     * 
     * @param $event_id
     */
    public function get_attendee($event_id)
    {
        $this->db->where(array('event_id' => $event_id));
        $this->db->order_by('user_id');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
}