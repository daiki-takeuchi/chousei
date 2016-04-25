<?php

class Invitations_model extends MY_Model
{
    protected $table = 'invitations';

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
    
    public function updateState($event_id, $user_id, $status)
    {
        $this->db->where(array('event_id' => $event_id, 'user_id' => $user_id));
        $query = $this->db->get($this->table);
        $invitation = $query->row_array();

        if(!empty($invitation)) {
            $invitation['status'] = $status;
            $this->save($invitation);
        }
    }
}