<?php

class Users extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
    }

    public function index()
    {
        // 管理者じゃない場合はログインページに移動
        if (!$this->admin) {
            redirect(site_url());
        }

        $offset = $this->uri->segment(3 ,0);
        // 登録されているデータを全件取得
        $data['users'] = $this->users_model->get_users($offset);

        // paginationの作成
        $data['pagination'] = $this->users_model->get_pagination();

        $data['title'] = 'ユーザー一覧';

        // 各種viewを呼び出す
        $this->smarty->assign($data);
        $this->display('users/index.tpl');
    }

    public function pages()
    {
        $this->index();
    }

    public function view($id = NULL)
    {
        // ログインしていない場合はログインページに移動
        if(!$this->is_login) {
            redirect(site_url());
        }

        // 管理者じゃなくて自分以外のidの場合はログインページに移動
        if (!$this->admin && $this->user_id !== $id) {
            redirect(site_url());
        }

        $data['user_item'] = $this->users_model->find($id);

        if (empty($data['user_item'])) {
            $this->display('users/not_found.tpl');
            return;
        }

        $data['title'] = $data['user_item']['name'];

        $this->smarty->assign($data);
        $this->display('users/view.tpl');

    }

    public function create()
    {
        $this->edit();
    }

    public function edit($id = NULL)
    {
        // ログインしていなくて特定のユーザーの編集をしようとしている場合はログインページに移動
        if(!$this->is_login && !empty($id)) {
            redirect(site_url());
        }
        // 管理者じゃなくて自分以外のidの場合はホームに移動
        if (!$this->admin && $this->user_id != $id && !empty($id)) {
            redirect(site_url().'home');
        }

        $user = $this->_get_user($id);
        $data['title'] = $this->_get_title($user);

        if ($_POST) {
            $this->_save_user($user);
        }
        $data['user_item'] = $user;

        $this->smarty->assign($data);
        $this->display('users/user_form.tpl');
    }

    public function delete($id = NULL)
    {
        $user = $this->_get_user($id);
        if(isset($user['id'])) {
            $this->users_model->delete($user);
        }
        redirect('/users', 'refresh');
    }

    private function _get_user($id = NULL)
    {
        if ($id === NULL) {
            $user = array();
        } else {
            $user = $this->users_model->find($id);
        }
        return $user;
    }

    private function _get_title($user)
    {
        if (!isset($user['id'])) {
            return 'ユーザー登録';
        } else {
            return 'ユーザー編集';
        }
    }

    private function _save_user(&$user)
    {
        $user['email'] = $this->input->post('email');
        $user['name'] = $this->input->post('name');
        $user['password'] = sha1($this->input->post('email').$this->input->post('password'));

        if ($this->form_validation->run('user') !== FALSE) {
            $this->users_model->save($user);
            if(!$this->is_login) {
                $data = array("user" => $user, "is_logged_in" => 1);
                $this->session->set_userdata($data);
            }
            redirect('/users/' . $user['id'], 'refresh');
        }
    }
}