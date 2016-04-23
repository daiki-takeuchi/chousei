<?php

/**
 * Class Events_model
 *
 * @property Invitation_model $invitation_model
 */
class Events_model extends MY_Model
{
    protected $table = 'events';
    protected $has_one = array('invitation' => 'events.id = invitation.event_id');
    protected $per_page = 10;
    private $count;

    function __construct(){
        parent::__construct();
        $this->load->model('invitation_model');
    }

    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    public function find_by_user_id($user_id, $offset = FALSE)
    {
        $this->_user_query($user_id);
        $query = $this->db->get();
        $this->count = $query->num_rows();

        $this->_user_query($user_id);
        if($offset !== FALSE){
            $this->db->limit($this->per_page, $offset);
        }
        $query = $this->db->get();
        $events = $query->result_array();
        $this->_get_attendee($events);
        return $events;
    }

    public function get_events($offset = FALSE)
    {
        $this->db->order_by('start_time', 'desc');
        if($offset !== FALSE){
            $this->db->limit($this->per_page, $offset);
        }
        $events = $this->find();
        $this->_get_attendee($events);
        return $events;
    }

    public function get_count_all()
    {
        if($this->admin) {
            $count = parent::get_count_all();
        } else {
            $count = $this->count;
        }
        return $count;
    }

    private function _user_query($user_id) {
        $this->db->select($this->table . '.*');
        $this->db->from($this->table);
        $this->db->join('invitation', $this->has_one['invitation']);
        $this->db->where(array('user_id' => $user_id));
        $this->db->order_by('start_time', 'desc');
    }

    private function _get_attendee(&$events) {
        foreach ($events as &$event) {
            $event["attendee"] = $this->invitation_model->get_attendee($event["id"]);
        }
    }
}