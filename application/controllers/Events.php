<?php

/**
 * Class Users
 *
 * @property Events_model $events_model
 */
class Events extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('events_model');

        // ログインしていない場合はログインページに移動
        if(!$this->is_login) {
            redirect(site_url());
        }
    }

    public function index()
    {
        // 管理者じゃない場合はログインページに移動
        if (!$this->admin) {
            redirect(site_url());
        }

        $offset = $this->uri->segment(3 ,0);
        // 登録されているデータを全件取得
        $data['events'] = $this->events_model->get_events($offset);

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

    public function view($id = NULL)
    {
        $data['event_item'] = $this->events_model->find($id);

        if (empty($data['event_item'])) {
            $this->display('events/not_found.tpl');
            return;
        }

        $data['title'] = $data['event_item']['title'];

        $this->smarty->assign($data);
        $this->display('events/view.tpl');

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
        $data['title'] = $this->_get_title($event);

        if ($_POST) {
            $this->_save_event($event);
        }
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
            return '予定登録';
        } else {
            return '予定編集';
        }
    }

    private function _save_event(&$event)
    {
        $mode = $this->uri->segment(2 ,0);

        $event['title'] = $this->input->post('title');
        $event['description'] = $this->input->post('description');

//        if ($this->form_validation->run('events/'.$mode) !== FALSE) {
            $this->events_model->save($event);
            redirect('/events/' . $event['id'], 'refresh');
//        }
    }
}