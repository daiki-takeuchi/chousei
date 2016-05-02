<?php

/**
 * Class Events
 *
 * @property Events_model $events_model
 * @property Users_model $users_model
 */
class Events extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('events_model');
        $this->load->model('users_model');

        if(!$this->is_login && !$this->input->is_ajax_request()) {
            redirect(site_url());
        }
        $this->events_model->setAdmin($this->admin);
        $this->events_model->setUserId($this->user_id);
    }

    public function index()
    {
        $offset = $this->uri->segment(3 ,0);
        if($this->admin) {
            // 登録されているデータを全件取得
            $data['events'] = $this->events_model->get_events($offset);
        } else {
            // 自分が参加できるデータを取得
            $data['events'] = $this->events_model->find_by_user_id($this->user_id, $offset);
        }

        // paginationの作成
        $data['pagination'] = $this->events_model->get_pagination();

        $data['title'] = '予定一覧';

        // 各種viewを呼び出す
        $this->smarty->assign($data);
        $this->display('events/index.tpl');
    }

    public function pages()
    {
        $this->index();
    }

    public function create()
    {
        $this->edit();
    }

    public function edit($id = NULL)
    {
        // 管理者じゃない場合はログインページに移動
        if (!$this->admin) {
            redirect(site_url());
        }

        $event = $this->_get_event($id);
        if(empty($event) && !empty($id)) {
            $this->display('events/not_found.tpl');
            return;
        }

        $data['users'] = $this->users_model->get_users();
        $data['title'] = $this->_get_title($event);
        $data['status'] = array('0' => '未回答', '1' => '参加', '2' => '欠席',);

        if ($_POST) {
            $this->_save_event($event);
        }
        $this->events_model->get_attendee($event);
        $data['event_item'] = $event;

        $this->smarty->assign($data);
        $this->display('events/event_form.tpl');
    }

    public function delete($id = NULL)
    {
        // 管理者じゃない場合はログインページに移動
        if (!$this->admin) {
            redirect(site_url());
        }

        $event = $this->_get_event($id);
        if(isset($event['id'])) {
            $this->events_model->delete($event);
        }
        redirect('/events', 'refresh');
    }

    public function update_status()
    {
        // Ajax通信の場合のみ処理する
        if($this->input->is_ajax_request() && $this->is_login) {
            $event_id = $this->input->post('event_id');
            $status = $this->input->post('status') == null ? null:$this->input->post('status');
            $user_id = $this->user_id;

            $this->events_model->updateState($event_id, $user_id, $status);
        } else {
            echo json_encode(array('message' => 'エラーが発生しました。再度ログインして実施してください。'));
        }
    }

    private function _get_event($id = NULL)
    {
        if ($id === NULL) {
            $event = array();
        } else {
            $event = $this->events_model->find($id);
        }
        return $event;
    }

    private function _get_title($user)
    {
        if (!isset($user['id'])) {
            $title = '予定登録';
        } else {
            $title = '予定編集';
        }
        return $title;
    }

    private function _save_event(&$event)
    {
        $mode = $this->uri->segment(2 ,0);
        $event['title'] = $this->input->post('title');
        if($this->input->post('date')) {
            $event['start_time'] = $this->input->post('date') . ' ' . $this->input->post('start_time');
            $event['end_time'] = $this->input->post('date') . ' ' . $this->input->post('end_time');
        }
        $event['place'] = $this->input->post('place');
        $event['number_of_people'] = $this->input->post('number_of_people');
        $event['description'] = $this->input->post('description');

        if ($this->form_validation->run('events') !== FALSE) {
            $this->events_model->save($event);

            $invite_users = $this->input->post('invite_users');
            foreach ((array)$invite_users as $invite_user) {
                $invitation = array(
                    'event_id' => $event['id'],
                    'user_id' => $invite_user['id'],
                    'user_name' => $invite_user['name'],
                    'status' => 0);
                $this->events_model->saveInvitation($invitation);
            }
            redirect('/events', 'refresh');
        }
    }
}