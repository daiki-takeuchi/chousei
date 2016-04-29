<?php

/**
 * Class Events_model
 *
 * @property Invitations_model $invitations_model
 */
class Events_model extends MY_Model
{
    protected $table = 'events';
    protected $has_one = array('invitations' => 'events.id = invitations.event_id');
    protected $per_page = 10;
    private $count;
    private $admin;
    private $user_id;

    function __construct(){
        parent::__construct();
        $this->load->model('invitations_model');
    }

    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
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
        $this->_get_all_attendee($events);
        return $events;
    }

    public function get_events($offset = FALSE)
    {
        $this->db->order_by('start_time', 'desc');
        if($offset !== FALSE){
            $this->db->limit($this->per_page, $offset);
        }
        $events = $this->find();
        $this->_get_all_attendee($events);
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

    public function get_attendee(&$event)
    {
        $event["attendee"] = $this->invitations_model->get_attendee($event["id"]);
        $event["attend_count"] = 0;
        foreach ($event["attendee"] as $item) {
            if($item["user_id"] == $this->user_id) {
                $event["status"] = $item["status"];
                if($item["status"] === '0') {
                    $event["btn-attendance"] = 'default';
                    $event["btn-absence"] = 'default';
                } elseif ($item["status"] === '1') {
                    $event["btn-attendance"] = 'primary';
                    $event["btn-absence"] = 'default';
                } elseif ($item["status"] === '2') {
                    $event["btn-attendance"] = 'default';
                    $event["btn-absence"] = 'primary';
                }
            }
            if($item["status"] === '1') {
                $event["attend_count"]++;
            }
        }
    }

    public function updateState($event_id, $user_id, $status) {
        $this->db->trans_begin();
        $this->lock_table();
        $this->invitations_model->lock_table();
        $event = $this->find($event_id);
        $this->get_attendee($event);

        $message = '募集人数がいっぱいです。';
        if($event['number_of_people'] - $event['attend_count'] > 0 || $status !== '1') {
            $this->invitations_model->updateState($event_id, $user_id, $status);
            $message = '';
        }
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }
        $this->get_attendee($event);

        echo json_encode(array('number_of_people' => $event['number_of_people'], 'remain' => $event['number_of_people'] - $event['attend_count'], 'message' => $message));
    }
    
    public function saveInvitation($invitation)
    {
        $this->invitations_model->save($invitation);
    }

    private function _user_query($user_id) {
        $this->db->select($this->table . '.*');
        $this->db->from($this->table);
        $this->db->join('invitations', $this->has_one['invitations']);
        $this->db->where(array('user_id' => $user_id));
        $this->db->order_by('start_time', 'desc');
    }

    private function _get_all_attendee(&$events) {
        foreach ($events as &$event) {
            $this->get_attendee($event);
        }
    }
}