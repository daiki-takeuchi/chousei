<?php

/**
 * Created by PhpStorm.
 * User: DaikiTakeuchi
 * Date: 2015/09/26
 * Time: 23:27
 * @property Generate_pagination      $generate_pagination
 */
class MY_Model extends CI_Model
{
    protected $table;
    protected $per_page;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function find($id = FALSE)
    {
        if ($id === FALSE) {
            // SQLを実行
            $query = $this->db->get($this->table);
            log_message('info', $this->db->last_query());
            return $query->result_array();
        }

        $query = $this->db->get_where($this->table, array('id' => $id));
        return $query->row_array();
    }

    public function save(&$data)
    {
        if (!isset($data['id'])) {
            $data['created_at'] = $data['updated_at'] = date('Y/m/d H:i:s');
            $this->db->insert($this->table, $data);
            $data['id'] = $this->db->insert_id();
        } else {
            $data['updated_at'] = date('Y/m/d H:i:s');
            $this->db->where('id', $data['id']);
            $this->db->update($this->table, $data);
        }
        log_message('info', $this->db->last_query());
    }

    public function delete(&$data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete($this->table);

        // 空にする
        $data = array();
        log_message('info', $this->db->last_query());
    }

    public function get_count_all()
    {
        return $this->db->count_all_results($this->table);
    }

    public function get_pagination()
    {
        $this->load->library('Generate_pagination');
        $path = base_url() . "/" . $this->table . "/pages";
        $total_rows = $this->get_count_all();

        $pagination = $this->generate_pagination->get_links($path, $total_rows, $this->per_page);

        return $pagination;
    }

    public function get_max_id()
    {
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->row_array()['id'];
    }
    
    public function lock_table()
    {
        $sql = 'LOCK TABLE ' . $this->table . ' IN EXCLUSIVE MODE';
        $this->db->query($sql);
    }
}