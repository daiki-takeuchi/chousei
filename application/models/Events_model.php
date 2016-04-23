<?php

class Events_model extends MY_Model
{
    protected $table = 'events';
    protected $has_one = array('invitation' => 'events.id = invitation.event_id');
    protected $per_page = 10;

    function __construct(){
        parent::__construct();
    }

    public function find_by_user_id($user_id)
    {
        $this->db->from($this->table);
        $this->db->join('invitation', $this->has_one['invitation']);
        $this->db->where(array('user_id' => $user_id));
        $this->db->order_by('start_time', 'desc');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_events($offset = FALSE)
    {
        $this->db->order_by('start_time', 'desc');
        if($offset !== FALSE){
            $this->db->limit($this->per_page, $offset);
        }
        return $this->find();
    }
}